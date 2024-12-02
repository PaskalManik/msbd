<?php
session_start();
require 'inc/db_connect.php';

// Pastikan pengguna yang login adalah employee
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'employee') {
    header('Location: login.php');
    exit();
}

// Memproses aksi saat employee mengambil request
if (isset($_POST['take_action']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];
    
    // Update status request menjadi 'Dikerjakan'
    $sql = "UPDATE request SET status = 'Dikerjakan' WHERE request_id = '$request_id' AND status = 'pending'";

    if (mysqli_query($conn, $sql)) {
        // Jika sukses, redirect ke halaman index.php dengan status berhasil
        echo "<script>alert('Request berhasil diambil dan status telah diubah menjadi Dikerjakan.'); window.location.href = 'index.php';</script>";
    } else {
        // Jika gagal, beri peringatan
        echo "<script>alert('Terjadi kesalahan saat memperbarui status request.'); window.location.href = 'index.php';</script>";
    }
} else {
    // Jika tidak ada aksi yang diterima, redirect ke halaman utama
    header('Location: index.php');
    exit();
}
?>
