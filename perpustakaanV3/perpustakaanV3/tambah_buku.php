<?php
    include 'koneksi.php';

   // Memeriksa apakah permintaan (request) yang datang ke server adalah metode POST (dari formulir HTML).
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Mengambil data yang dikirimkan dari formulir HTML dan menyimpannya dalam variabel.
        $judul = $_POST['judul'];          
        $penulis = $_POST['penulis'];      
        $tahun_terbit = $_POST['tahun_terbit']; 
        $jumlah_buku = $_POST['jumlah_buku'];   

        // menyimpan sintaks sql
        $sql = "INSERT INTO buku (judul, penulis, tahun_terbit, jumlah_buku) VALUES ('$judul', '$penulis', '$tahun_terbit','$jumlah_buku')";
    
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
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="tambah_buku.php" method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku :</label>
                <input type="text" class="form-control" id="judul" name="judul">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis :</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit :</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit">
            </div>
            <div class="mb-3">
                <label for="jumlah_buku" class="form-label">Jumlah Buku :</label>
                <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</html>