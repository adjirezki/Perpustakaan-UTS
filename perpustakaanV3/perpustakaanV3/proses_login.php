<?php
session_start();
include 'koneksi.php';

// Tangkap data dari formulir login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa kecocokan username dan password di database
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login berhasil, buat sesi dan arahkan ke halaman utama (index)
    $_SESSION['username'] = $username;
    header("Location: index.php");
} else {
    // Login gagal, arahkan kembali ke halaman login dengan pesan error
    $_SESSION['login_error'] = "Username atau password salah.";
    header("Location: Login.php?error=true");
}

$conn->close();
?>
