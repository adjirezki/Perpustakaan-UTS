<?php
    include 'koneksi.php';

    // Mengambil ID buku yang akan dihapus dari parameter URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: index.php');
        exit();
    }

    // Menghapus data buku berdasarkan ID
    $sql_delete = "DELETE FROM buku WHERE buku_id = $id";

    if ($conn->query($sql_delete) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }

    $conn->close();
?>
