<?php
// Include file koneksi.php jika belum di-include
include 'koneksi.php';

// Check if mahasiswa_id and buku_id are provided in the URL
if (isset($_GET['mahasiswa_id']) && isset($_GET['buku_id'])) {
    // Mengambil data dari URL
    $buku_id = $_GET['buku_id'];
    $mahasiswa_id = $_GET['mahasiswa_id'];

    // Check if other required data is provided
    if (isset($_POST['tgl_pinjam']) && isset($_POST['tgl_kembali'])) {
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];
        $jumlah_peminjaman = $_POST['jumlah_peminjaman']; // Mengambil jumlah_peminjaman yang seharusnya

        // Validasi jumlah peminjaman
        if ($jumlah_peminjaman <= 0 && $jumlah_peminjaman > $jumlahBuku) {
            echo "Jumlah buku yang ingin dipinjam tidak valid.";
            exit();
        }

        // Update jumlah buku tersedia
        $queryUpdateBuku = "UPDATE buku SET jumlah_buku = jumlah_buku - $jumlah_peminjaman WHERE buku_id = $buku_id";

        if ($conn->query($queryUpdateBuku) === TRUE) {
            // Query untuk menyimpan data peminjaman ke dalam tabel peminjaman
            $query = "INSERT INTO peminjaman (mahasiswa_id, buku_id, tgl_pinjam, tgl_kembali, jumlah_peminjaman) VALUES ('$mahasiswa_id', '$buku_id', '$tgl_pinjam', '$tgl_kembali', $jumlah_peminjaman)";

            if ($conn->query($query) === TRUE) {
                echo "Peminjaman berhasil disimpan.";
                header("Location: index.php");
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        } else {
            echo "Error updating jumlah buku tersedia: " . $conn->error;
        }

        // Tutup koneksi database
        $conn->close();
    } else {
        echo "Data POST tidak ditemukan.";
    }
} else {
    echo "Data mahasiswa_id dan buku_id tidak ditemukan dalam URL.";
}
?>
