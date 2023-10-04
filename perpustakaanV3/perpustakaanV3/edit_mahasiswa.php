<?php
    include 'koneksi.php';

    // Mengambil ID mahasiswa yang akan diedit dari parameter URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: index.php');
        exit();
    }

    // Mendapatkan data mahasiswa yang akan diedit
    $sql = "SELECT * FROM mahasiswa WHERE mahasiswa_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $nim = $row['nim'];
        $alamat = $row['alamat'];
    } else {
        echo "Data mahasiswa tidak ditemukan.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_baru = $_POST['nama'];
        $nim_baru = $_POST['nim'];
        $alamat_baru = $_POST['alamat'];

        // Menyimpan sintaks SQL untuk mengupdate data mahasiswa
        $sql_update = "UPDATE mahasiswa SET nama='$nama_baru', nim='$nim_baru', alamat='$alamat_baru' WHERE mahasiswa_id = $id";
    
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
    <title>Edit mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit mahasiswa</h2>
        <form action="edit_mahasiswa.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-group">
                <label for="nama">Nama Mahasiswa:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
            </div>
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>">
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
