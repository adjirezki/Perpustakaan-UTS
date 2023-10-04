<?php
// Include file koneksi ke database (koneksi.php)
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir pendaftaran
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Lakukan validasi data di sini (misalnya, panjang username dan password minimum)

    // Contoh validasi panjang minimal username dan password
    if (strlen($new_username) < 4 || strlen($new_password) < 6) {
        // Username atau password tidak memenuhi syarat
        // Anda dapat menambahkan pesan kesalahan di sini jika diperlukan
        header("Location: registrasi.php?error=invalid"); // Redirect kembali ke halaman pendaftaran dengan pesan kesalahan
        exit(); // Hentikan eksekusi skrip
    }

    // Query untuk memasukkan pengguna baru ke dalam tabel (tanpa menghash password)
    $sql = "INSERT INTO user (username, password) VALUES ('$new_username', '$new_password')";

    if ($conn->query($sql) === TRUE) {
        // Pendaftaran berhasil, arahkan kembali ke halaman login
        header("Location: login.php");
        exit();
    } else {
        // Terjadi kesalahan saat memasukkan data ke dalam database
        // Anda dapat menambahkan pesan kesalahan di sini jika diperlukan
        header("Location: registrasi.php?error=database"); // Redirect kembali ke halaman pendaftaran dengan pesan kesalahan
        exit();
    }
}

$conn->close();
?>
