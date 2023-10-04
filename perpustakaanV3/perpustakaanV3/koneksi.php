<?php
$servername = "localhost";  // Nama host MySQL (biasanya localhost)
$username = "root";         // Nama pengguna MySQL
$password = "";             // Kata sandi MySQL
$dbname = "perpustakaan";    // Nama basis data yang ingin diakses

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>