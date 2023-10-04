<?php
    include 'koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $alamat = $_POST['alamat'];
        

        // menyimpan sintaks sql
        $sql = "INSERT INTO mahasiswa (nama, nim, alamat) VALUES ('$nama', '$nim', '$alamat')";
    
        // mengeksekusi sintaks sql
        if ($conn->query($sql) === TRUE) {
            header('Location:index.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="tambah_mahasiswa.php" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa :</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM :</label>
                <input type="text" class="form-control" id="nim" name="nim">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat :</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</html>