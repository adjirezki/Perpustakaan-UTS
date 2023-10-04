<?php
    session_start();

    // Cek apakah sesi username belum terbuat, jika belum, arahkan ke halaman login
    if (!isset($_SESSION['username'])) {
        header("Location: Login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 style="margin-top: 20px; margin-bottom: 20px">Perpustakaan</h2>
        <a href="tambah_buku.php" class="btn btn-primary">Tambah Buku +</a><br><br>

        <!-- Create a Bootstrap table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah Buku</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                $sql = "SELECT buku_id, judul, penulis, tahun_terbit, jumlah_buku FROM buku";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["judul"] . "</td>";
                        echo "<td>" . $row["penulis"] . "</td>";
                        echo "<td>" . $row["tahun_terbit"] . "</td>";
                        echo "<td>" . $row["jumlah_buku"] . "</td>";
                        echo "<td>
                        <a href='edit_buku.php?id=" . $row['buku_id'] . "' class='btn btn-info btn-sm'>Ubah Data</a>
                        <a href='delete_buku.php?id=" . $row['buku_id'] . "' class='btn btn-danger btn-sm'>Hapus Data</a>
                        <a href='mahasiswa_pinjam_buku.php?id=" . $row['buku_id'] . "' class='btn btn-primary btn-sm'>Pinjam Buku</a>
                    </td>
                    ";
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
                        echo "<td>
                        <a href='edit_mahasiswa.php?id=" . $row['mahasiswa_id'] . "' class='btn btn-info btn-sm'>Ubah Data</a>
                        <a href='delete_mahasiswa.php?id=" . $row['mahasiswa_id'] . "' class='btn btn-danger btn-sm'>Hapus Data</a>
                    </td>
                    ";
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

<!-- Tabel Peminjam -->
<br><br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>NIM</th>
            <th>Judul Buku</th>
            <th>Jumlah Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';

        $sql = "SELECT peminjaman_id, tgl_pinjam, tgl_kembali,jumlah_peminjaman, mahasiswa.nama AS nama_mahasiswa, mahasiswa.nim AS nim_mahasiswa, buku.judul AS judul_buku, buku.jumlah_buku AS jumlah_buku
                FROM peminjaman
                INNER JOIN mahasiswa ON peminjaman.mahasiswa_id = mahasiswa.mahasiswa_id
                INNER JOIN buku ON peminjaman.buku_id = buku.buku_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no . "</td>";
                echo "<td>" . $row["nama_mahasiswa"] . "</td>";
                echo "<td>" . $row["nim_mahasiswa"] . "</td>";
                echo "<td>" . $row["judul_buku"] . "</td>";
                echo "<td>" . $row["jumlah_peminjaman"] . "</td>";
                echo "<td>" . $row["tgl_pinjam"] . "</td>";
                echo "<td>" . $row["tgl_kembali"] . "</td>";
                echo "<td>
                    <a href='delete_peminjaman.php?id=" . $row['peminjaman_id'] . "' class='btn btn-danger btn-sm'>Hapus Data</a>
                </td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='8'>No results found.</td></tr>";
        }

        $conn->close(); 
        ?>
    </tbody>
</table>
<a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
