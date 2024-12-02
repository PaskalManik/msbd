<?php
session_start();
require 'inc/db_connect.php';  // Pastikan koneksi ke database sudah benar

// Periksa apakah user adalah employee
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'employee') {
    header('Location: login.php');  // Redirect ke login jika bukan employee
    exit();
}

// Ambil daftar request produk yang masih dalam status 'pending'
$query = "SELECT * FROM request WHERE status = 'pending'";
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
    <title>Employee - Request Produk</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Request Produk</h2>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ($row['gambar']): ?>
                            <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="Product Image">
                        <?php else: ?>
                            <img src="uploads/default.jpg" class="card-img-top" alt="Product Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['nama']); ?></h5>
                            <p class="card-text">
                                <strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan'; ?><br>
                                <strong>Ukuran Baju:</strong> <?php echo htmlspecialchars($row['ukuran_baju']); ?><br>
                                <strong>Ukuran Lengan:</strong> <?php echo htmlspecialchars($row['ukuran_lengan']); ?><br>
                                <strong>Jumlah:</strong> <?php echo $row['jumlah']; ?><br>
                            </p>
                            <form action="process_request.php" method="POST">
                                <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                <button type="submit" name="take_action" class="btn btn-primary btn-block">Ambil Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php
    include './inc/footer.php';
    ?>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
