<?php
ob_start();

include './inc/header.php';
include './inc/db_connect.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$uid = $_SESSION['user_id']; // Ambil user_id dari session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $ukuran_baju = $_POST['ukuran_baju'];
    $ukuran_lengan = $_POST['ukuran_lengan'];
    $jumlah = $_POST['jumlah'];
    $saran = $_POST['saran'];
    $gambar = ""; 

    // Menangani upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar_name = $_FILES['gambar']['name'];
        $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
        $gambar_size = $_FILES['gambar']['size'];
        $gambar_ext = pathinfo($gambar_name, PATHINFO_EXTENSION);

        // Menentukan folder tujuan
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar_name);

        // Validasi file
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($gambar_ext), $allowed_extensions) && $gambar_size <= 5000000) {
            // Memindahkan file gambar ke folder tujuan
            if (move_uploaded_file($gambar_tmp_name, $target_file)) {
                $gambar = $gambar_name;
            } else {
                echo "<script>alert('Gambar gagal diunggah.');</script>";
            }
        } else {
            echo "<script>alert('File gambar tidak valid.');</script>";
        }
    }

    // Menyimpan data ke tabel request
    $sql = "INSERT INTO request (nama, jenis_kelamin, ukuran_baju, ukuran_lengan, jumlah, saran, gambar, user_id)
            VALUES ('$nama', '$jenis_kelamin', '$ukuran_baju', '$ukuran_lengan', '$jumlah', '$saran', '$gambar', '$uid')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Pesanan Anda berhasil dikirim. Terima kasih!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan. Silakan coba lagi.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Product - Konveksi</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Formulir Pemesanan Baju</h2>

        <form action="request-product.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Jenis Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ukuran_baju">Ukuran Baju</label>
                <select class="form-control" id="ukuran_baju" name="ukuran_baju" required>
                    <option value="">Pilih Ukuran Baju</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ukuran_lengan">Ukuran Lengan</label>
                <select class="form-control" id="ukuran_lengan" name="ukuran_lengan" required>
                    <option value="">Pilih Ukuran Lengan</option>
                    <option value="Pendek">Pendek</option>
                    <option value="Panjang">Panjang</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
            </div>
            
            <div class="form-group">
                <label for="saran">Saran atau Permintaan Khusus (Opsional)</label>
                <textarea class="form-control" id="saran" name="saran" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="gambar">Upload Gambar (Opsional)</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar">
                <small class="form-text text-muted">Opsional, jika Anda ingin mengunggah gambar desain atau referensi produk.</small>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Kirim Pesanan</button>
        </form>
    </div>

    <footer class="text-center py-3">
        <p class="text-muted"> <small>&copy; 2024 Konveksi Usaha | Semua Hak Dilindungi</small> </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
