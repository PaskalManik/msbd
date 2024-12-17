<?php
// Mulai sesi dan aktifkan output buffering
ob_start();
session_start();

// Include koneksi database dan komponen lainnya
include './inc/db_connect.php'; // Koneksi ke database
include './inc/header.php'; // Include Header
include './inc/sidebar.php'; // Include Sidebar

// Cek apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Unauthorized access! Please log in as admin.');</script>";
    header('Location: ../login.php');
    exit();
}

// Ambil user ID dari sesi
$user_id = $_SESSION['user_id'];
mysqli_query($conn, "SET @user_id = $user_id");

// Fungsi Tambah Menu
if (isset($_POST['add_menu'])) {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga_barang = mysqli_real_escape_string($conn, $_POST['harga_barang']);

    if (!empty($nama_barang) && !empty($harga_barang)) {
        $add_query = "INSERT INTO menu (nama_barang, harga_barang) VALUES ('$nama_barang', '$harga_barang')";
        if (mysqli_query($conn, $add_query)) {
            echo "<script>alert('Menu berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Gagal menambahkan menu!');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom!');</script>";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fungsi Hapus Menu
if (isset($_GET['delete'])) {
    $menu_id = (int)$_GET['delete']; // Pastikan $menu_id berupa integer
    $delete_query = "DELETE FROM menu WHERE menu_id = $menu_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Menu berhasil dihapus!');</script>";
    } else {
        echo "<script>alert('Gagal menghapus menu!');</script>";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fungsi Update Menu
if (isset($_POST['update_menu'])) {
    $menu_id = (int)$_POST['menu_id']; // Pastikan $menu_id berupa integer
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga_barang = mysqli_real_escape_string($conn, $_POST['harga_barang']);

    if (!empty($nama_barang) && !empty($harga_barang)) {
        $update_query = "UPDATE menu SET nama_barang = '$nama_barang', harga_barang = '$harga_barang' WHERE menu_id = $menu_id";
        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Menu berhasil diperbarui!');</script>";
        } else {
            echo "<script>alert('Gagal memperbarui menu!');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua kolom!');</script>";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Ambil data menu dari database
$menu_query = "SELECT * FROM menu ORDER BY menu_id ASC";
$result = mysqli_query($conn, $menu_query);
?>

<!-- Content -->
<div class="container my-4">
    <h1 class="mb-4">Kelola Menu</h1>

    <!-- Form Tambah Menu -->
    <h2>Tambah Menu</h2>
    <form action="" method="POST" class="mb-4">
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga_barang">Harga Barang:</label>
            <input type="number" id="harga_barang" name="harga_barang" class="form-control" required>
        </div>
        <button type="submit" name="add_menu" class="btn btn-primary">Tambah Menu</button>
    </form>

    <hr>

    <!-- Tabel Menu -->
    <h2>Daftar Menu</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID Menu</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['menu_id']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td>Rp<?php echo number_format($row['harga_barang'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="?edit=<?php echo $row['menu_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?php echo $row['menu_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus menu ini?');">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Form Edit Menu -->
    <?php if (isset($_GET['edit'])): 
        $edit_id = (int)$_GET['edit'];
        $edit_query = "SELECT * FROM menu WHERE menu_id = $edit_id";
        $edit_result = mysqli_query($conn, $edit_query);
        $menu = mysqli_fetch_assoc($edit_result);
    ?>
        <hr>
        <h2>Edit Menu</h2>
        <form action="" method="POST">
            <input type="hidden" name="menu_id" value="<?php echo $menu['menu_id']; ?>">
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?php echo $menu['nama_barang']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_barang">Harga Barang:</label>
                <input type="number" id="harga_barang" name="harga_barang" class="form-control" value="<?php echo $menu['harga_barang']; ?>" required>
            </div>
            <button type="submit" name="update_menu" class="btn btn-success">Perbarui Menu</button>
            <a href="kelola_menu.php" class="btn btn-secondary">Batal</a>
        </form>
    <?php endif; ?>
</div>
