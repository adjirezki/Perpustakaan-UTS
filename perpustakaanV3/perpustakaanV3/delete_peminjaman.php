<?php
include 'koneksi.php';

// Mengambil ID peminjaman yang akan dihapus dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: index.php');
    exit();
}

// Mengambil data peminjaman untuk mendapatkan buku_id dan jumlah_peminjaman
$sql_select = "SELECT buku_id, jumlah_peminjaman FROM peminjaman WHERE peminjaman_id = $id";
$result = $conn->query($sql_select);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $buku_id = $row['buku_id'];
    $jumlah_peminjaman = $row['jumlah_peminjaman'];

    // Mengupdate jumlah buku pada tabel buku
    $sql_update = "UPDATE buku SET jumlah_buku = jumlah_buku + $jumlah_peminjaman WHERE buku_id = $buku_id";
    if ($conn->query($sql_update) === FALSE) {
        echo "Error updating jumlah buku: " . $conn->error;
    }

    // Menghapus data peminjaman berdasarkan ID
    $sql_delete = "DELETE FROM peminjaman WHERE peminjaman_id = $id";

    if ($conn->query($sql_delete) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error deleting peminjaman: " . $conn->error;
    }
} else {
    echo "Data peminjaman tidak ditemukan.";
}

$conn->close();
?>
