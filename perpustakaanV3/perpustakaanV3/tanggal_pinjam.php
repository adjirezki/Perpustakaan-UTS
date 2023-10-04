<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Data Peminjaman Buku</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $buku_id = $_POST['buku_id'];
                    $mahasiswa_id = $_POST['mahasiswa_id'];
                    // $jumlah_pinjam = $_POST['jumlah_pinjam']; // Mengambil jumlah_pinjam yang seharusnya

                    // cek-cek ges
                    // var_dump("buku id",$buku_id,"mahasiswa id",$mahasiswa_id,"jumlah buku", $jumlah_pinjam);

                    // Include file koneksi.php jika belum di-include
                    include 'koneksi.php';

                    // Query untuk mengambil data buku berdasarkan $buku_id
                    $queryBuku = "SELECT * FROM buku WHERE buku_id = $buku_id";
                    $resultBuku = $conn->query($queryBuku);

                    if ($resultBuku->num_rows == 1) {
                        // Data buku ditemukan, ambil informasi buku
                        $rowBuku = $resultBuku->fetch_assoc();
                        $judulBuku = $rowBuku['judul'];
                        $penulisBuku = $rowBuku['penulis'];
                        $tahunTerbitBuku = $rowBuku['tahun_terbit'];
                        $jumlahBuku = $rowBuku['jumlah_buku'];
                    } else {
                        echo "Data buku tidak ditemukan.";
                        exit();
                    }

                    

                    // Query untuk mengambil data mahasiswa berdasarkan $mahasiswa_id
                    $queryMahasiswa = "SELECT * FROM mahasiswa WHERE mahasiswa_id = $mahasiswa_id";
                    $resultMahasiswa = $conn->query($queryMahasiswa);

                    if ($resultMahasiswa->num_rows == 1) {
                        // Data mahasiswa ditemukan, ambil informasi mahasiswa
                        $rowMahasiswa = $resultMahasiswa->fetch_assoc();
                        $namaMahasiswa = $rowMahasiswa['nama'];
                        $nimMahasiswa = $rowMahasiswa['nim'];
                        $alamatMahasiswa = $rowMahasiswa['alamat'];
                    } else {
                        echo "Data mahasiswa tidak ditemukan.";
                        exit();
                    }

                    // Menampilkan informasi buku dan mahasiswa dalam satu kolom Bootstrap
                    echo "<h5 class='card-title'>Informasi Buku</h5>";
                    echo "<p class='card-text'><strong>Judul Buku:</strong> $judulBuku</p>";
                    echo "<p class='card-text'><strong>Penulis:</strong> $penulisBuku</p>";
                    echo "<p class='card-text'><strong>Tahun Terbit:</strong> $tahunTerbitBuku</p>";
                    echo "<p class='card-text'><strong>Jumlah Buku Tersedia:</strong> $jumlahBuku</p>";
                    echo "<h5 class='card-title'>Informasi Mahasiswa</h5>";
                    echo "<p class='card-text'><strong>Nama Mahasiswa:</strong> $namaMahasiswa</p>";
                    echo "<p class='card-text'><strong>NIM:</strong> $nimMahasiswa</p>";
                    echo "<p class='card-text'><strong>Alamat:</strong> $alamatMahasiswa</p>";

                    // Tutup koneksi database
                    $conn->close();
                } else {
                    echo "Data POST tidak ditemukan.";
                }
                ?>

                <form action="proses_peminjaman.php?mahasiswa_id=<?php echo $mahasiswa_id; ?>&buku_id=<?php echo $buku_id; ?>" method="POST">

                    <div class="md-1">
                        <label for="jumlah_peminjaman" class="form-label">Jumlah Buku Dipinjam:</label>
                        <input type="number" class="form-control" id="jumlah_peminjaman" name="jumlah_peminjaman">
                    </div>

                        
                    <div class="form-row">
                        <div class="col-md-6 mx-auto">
                            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam:</label>
                            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
                        </div>

                        <div class="col-md-6 mx-auto">
                            <label for="tgl_kembali" class="form-label">Tanggal Berakhir:</label>
                            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali">
                            <?php "<input type='hidden' name='buku_id' value='" . $buku_id . "'"?>
                            <?php "<input type='hidden' name='mahasiswa_id' value='" . $mahasiswa_id . "'"?>
                        </div>

                    </div>
                    <button type="button" class="btn btn-primary mt-3" id="submitBtn">Pinjam Buku</button>

                    <script>
                    document.getElementById("submitBtn").addEventListener("click", function() {
                        // Mendapatkan nilai jumlah_peminjaman dari input
                        var jumlah_peminjaman = document.getElementById("jumlah_peminjaman").value;
                        
                        // Mendapatkan nilai tanggal_pinjam dan tanggal_kembali dari input
                        var tanggal_pinjam = document.getElementById("tgl_pinjam").value;
                        var tanggal_kembali = document.getElementById("tgl_kembali").value;
                        
                        // Mengambil jumlahBuku dari PHP dan mengonversinya menjadi angka
                        var jumlahBuku = <?php echo $jumlahBuku; ?>;
                        
                        // Melakukan validasi
                        if (jumlah_peminjaman >= 1 && jumlah_peminjaman <= jumlahBuku && tanggal_pinjam && tanggal_kembali) {
                            // Jika valid, kirimkan formulir
                            document.forms[0].submit();
                        } else {
                            // Jika tidak valid, tampilkan pesan kesalahan
                            alert("Harap isi semua bidang dengan benar.");
                        }
                    });
                    </script>
 
                </form>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
