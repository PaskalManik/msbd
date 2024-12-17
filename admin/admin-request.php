<?php
session_start();
require 'inc/db_connect.php';

// Pastikan user adalah admin
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Ambil data request
$query = "SELECT * FROM request";
$result = mysqli_query($conn, $query);

// Ambil data bukti penyelesaian dari request_log
$log_query = "SELECT rl.log_id, rl.bukti_selesai, r.nama 
              FROM request_log rl
              INNER JOIN request r ON rl.request_id = r.request_id
              WHERE rl.status = 'waiting_admin'";
$log_result = mysqli_query($conn, $log_query);

include './inc/header.php';
include './inc/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - Requests</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Request</h2>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Detail Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal<?php echo $row['request_id']; ?>">Detail</button>
                        </td>
                        <td>
                            <?php if ($row['status'] === 'pending'): ?>
                                <form action="assign_employee.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                    <button class="btn btn-primary btn-sm" type="submit" name="action" value="assign">Approve</button>
                                </form>
                                <form action="cancel_request.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($row['request_id']); ?>">
                                    <button class="btn btn-danger btn-sm" type="submit" name="action" value="cancel">Cancel</button>
                                </form>
                            <?php elseif ($row['status'] === 'completed'): ?>
                                <button class="btn btn-success btn-sm" disabled>Order Selesai</button>
                            <?php else: ?>
                                <span class="text-muted"><?php echo htmlspecialchars($row['status']); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal<?php echo $row['request_id']; ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Request</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Request ID: <?php echo htmlspecialchars($row['request_id']); ?></p>
                                    <p>Nama Produk: <?php echo htmlspecialchars($row['nama']); ?></p>
                                    <p>Status: <?php echo htmlspecialchars($row['status']); ?></p>
                                    <p><strong>Ukuran Baju:</strong> <?php echo htmlspecialchars($row['ukuran_baju']); ?></p>
                                    <p><strong>Ukuran Lengan:</strong> <?php echo htmlspecialchars($row['ukuran_lengan']); ?></p>
                                    <p><strong>Jumlah:</strong> <?php echo htmlspecialchars($row['jumlah']); ?></p>
                                    <p><strong>Saran:</strong> <?php echo htmlspecialchars($row['saran']); ?></p>
                                    <p><strong>Gambar:</strong></p>
                                    <?php if (!empty($row['gambar'])): ?>
                                        <img src="../img/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar Produk" class="img-fluid" style="max-width: 200px;">
                                    <?php else: ?>
                                        <img src="../img/default.jpg" class="img-thumbnail" style="max-width: 200px;" alt="Default Image">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>