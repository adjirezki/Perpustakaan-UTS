<?php
    include 'koneksi.php';

    // Mengambil ID buku yang akan diedit dari parameter URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: index.php');
        exit();
    }

    // Mendapatkan data buku yang akan diedit
    $sql = "SELECT * FROM buku WHERE buku_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $judul = $row['judul'];
        $penulis = $row['penulis'];
        $tahun_terbit = $row['tahun_terbit'];
        $jumlah_buku = $row['jumlah_buku'];
    } else {
        echo "Data buku tidak ditemukan.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $judul_baru = $_POST['judul'];
        $penulis_baru = $_POST['penulis'];
        $tahun_terbit_baru = $_POST['tahun_terbit'];
        $jumlah_buku_baru = $_POST['jumlah_buku'];
        
        // Menyimpan sintaks SQL untuk mengupdate data buku
        $sql_update = "UPDATE buku SET judul='$judul_baru', penulis='$penulis_baru', tahun_terbit='$tahun_terbit_baru', jumlah_buku='$jumlah_buku_baru' WHERE buku_id = $id";
    
        // Mengeksekusi sintaks SQL
        if ($conn->query($sql_update) === TRUE) {
            header('Location: index.php');
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Buku</h2>
        <form action="edit_buku.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="judul">Judul Buku:</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>">
            </div>
            <div class="form-group">
                <label for="penulis">Penulis:</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $penulis; ?>">
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit:</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $tahun_terbit; ?>">
            </div>
            <div class="form-group">
                <label for="jumlah_buku">Jumlah Buku:</label>
                <input type="text" class="form-control" id="jumlah_buku" name="jumlah_buku" value="<?php echo $jumlah_buku; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
