<?php
session_start();
require 'inc/db_connect.php';

// Pastikan pengguna yang login adalah employee
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'employee') {
    header('Location: login.php');
    exit();
}

// Memproses perubahan status request menjadi "Siap"
if (isset($_POST['mark_ready']) && isset($_POST['request_id'])) {
    $request_id = $_POST['request_id'];

    // Update status request menjadi 'Siap'
    $sql = "UPDATE request SET status = 'Siap' WHERE request_id = '$request_id' AND status = 'Dikerjakan'";

    if (mysqli_query($conn, $sql)) {
        // Jika berhasil, beri notifikasi dan redirect ke halaman work-progress.php
        echo "<script>alert('Request berhasil ditandai siap.'); window.location.href = 'work-progress.php';</script>";
    } else {
        // Jika gagal, beri peringatan
        echo "<script>alert('Terjadi kesalahan saat memperbarui status request.'); window.location.href = 'work-progress.php';</script>";
    }
} else {
    // Jika tidak ada aksi yang diterima, redirect ke halaman work-progress.php
    header('Location: work-progress.php');
    exit();
}
?>
