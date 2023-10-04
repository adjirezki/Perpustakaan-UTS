<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <!-- Tambahkan Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Registrasi</h2>
        <?php
        // Tambahkan pesan kesalahan jika diperlukan
        if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
            echo '<div class="alert alert-danger mt-3">Username atau Password tidak memenuhi syarat. Username minimal 4 karakter dan password minimal 6 karakter.</div>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 'database') {
            echo '<div class="alert alert-danger mt-3">Terjadi kesalahan saat mendaftar. Silakan coba lagi.</div>';
        }
        ?>
        <form action="proses_registrasi.php" method="POST">
            <div class="form-group">
                <label for="new_username">Username Baru:</label>
                <input type="text" class="form-control" id="new_username" name="new_username" placeholder="Masukan Username Anda" required>
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Masukan Password Anda" required>
            </div>
            <button type="submit" class="btn btn-success">Daftar</button>
        </form>

        <!-- Tautan untuk Kembali ke Halaman Login -->
        <div class="mt-2">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery if needed -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>
