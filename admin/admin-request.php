<?php
// Mulai session
session_start();

// Pastikan admin yang login
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke login jika tidak login sebagai admin
    exit();
}

require './inc/db_connect.php';

// Query untuk mengambil semua data dari tabel 'request'
$query = "SELECT * FROM request ORDER BY tanggal_request DESC";
$result = mysqli_query($conn, $query);

include './inc/header.php';
include './inc/sidebar.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Request Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
    <div class="container my-4">
        <h3 class="text-center">Daftar Permintaan Produk</h3>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Ukuran Baju</th>
                    <th>Ukuran Lengan</th>
                    <th>Jumlah</th>
                    <th>Saran</th>
                    <th>Gambar</th>
                    <th>Tanggal Request</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data request
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . ($row['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan') . "</td>";
                    echo "<td>" . htmlspecialchars($row['ukuran_baju']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ukuran_lengan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['saran']) . "</td>";
                    echo "<td>";
                    if ($row['gambar']) {
                        echo "<img src='uploads/" . htmlspecialchars($row['gambar']) . "' width='100'>";
                    } else {
                        echo "-";
                    }
                    echo "</td>";
                    echo "<td>" . $row['tanggal_request'] . "</td>";
                    echo "<td>
                            <a href='process_request.php?id=" . $row['id'] . "' class='btn btn-success btn-sm'>Proses</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
   <?php
   include './inc/footer.php';
   ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
