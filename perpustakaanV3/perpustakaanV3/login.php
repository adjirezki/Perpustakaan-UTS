<?php
session_start();

// Cek apakah sesi username sudah terbuat, jika sudah, arahkan ke halaman lain
if (isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Tambahkan Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Login</h2>
        <?php
        // Cek apakah terdapat pesan error dari proses_login.php
        if (isset($_GET['error']) && $_GET['error'] == 'true') {
            echo '<div class="alert alert-danger mt-3">Username atau Password salah. Silakan coba lagi.</div>';
        }
        ?>
        <form action="proses_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label> 
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Anda" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <!-- Tombol untuk Registrasi -->
        <div class="mt-2">
            <p>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery if needed -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>
