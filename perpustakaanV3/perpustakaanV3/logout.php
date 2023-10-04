<?php
session_start();

// Hapus sesi username
unset($_SESSION['username']);

// Redirect ke halaman login
header("Location: login.php");
exit();
?>
