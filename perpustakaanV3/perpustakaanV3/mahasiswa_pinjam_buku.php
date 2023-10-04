<?php
include 'koneksi.php';

// Mengambil ID buku yang akan ditampilkan dari parameter URL
if (isset($_GET['id'])) {
    $buku_id = $_GET['id'];

    // Mendapatkan data buku yang akan ditampilkan
    $sql = "SELECT * FROM buku WHERE buku_id = $buku_id";
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Mahasiswa Peminjam</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Data Mahasiswa Peminjam</h2>
        <!-- Form untuk tampilkan Buku -->
        <form>
            <div class="form-row">
                <div class="form-group col">
                    <label for="judul">Judul Buku:</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>" readonly>
                </div>
                <div class="form-group col">
                    <label for="penulis">Penulis:</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $penulis; ?>" readonly>
                </div>
                <div class="form-group col">
                    <label for="tahun_terbit">Tahun Terbit:</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $tahun_terbit; ?>" readonly>
                </div>
                <div class="form-group col">
                    <label for="jumlah_buku">Jumlah Buku:</label>
                    <input type="number" class="form-control" id="jumlah_buku" name="jumlah_buku" value="<?php echo $jumlah_buku; ?>" readonly>
                </div>
            </div>
        </form>

<!-- Tabel Mahasiswa Peminjam -->
<a href="tambah_mahasiswa.php" class="btn btn-primary">Tambah Mahasiswa +</a><br><br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';

        $sql = "SELECT mahasiswa_id, nama, nim, alamat FROM mahasiswa";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["nim"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>";
                echo "<form action='tanggal_pinjam.php' method='POST'>";
                echo "<input type='hidden' name='buku_id' value='" . $buku_id . "'>";
                echo "<input type='hidden' name='mahasiswa_id' value='" . $row['mahasiswa_id'] . "'>";
                echo "<button type='submit' class='btn btn-success btn-sm'>Pinjam Buku</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='5'>No results found.</td></tr>";
        }

        $conn->close(); 
        ?>
    </tbody>
</table>

    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
