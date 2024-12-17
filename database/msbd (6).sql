-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Des 2024 pada 16.24
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msbd`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`` PROCEDURE `insert_request` (IN `in_nama_barang` VARCHAR(255), IN `in_jenis_kelamin` ENUM('Laki-laki','Perempuan'), IN `in_ukuran_baju` ENUM('S','M','L','XL','XXL'), IN `in_ukuran_lengan` ENUM('Pendek','Panjang'), IN `in_jumlah` INT, IN `in_saran` TEXT, IN `in_gambar` VARCHAR(255), IN `in_user_id` INT, IN `in_menu_id` INT)   BEGIN
    -- Insert data ke tabel request
    INSERT INTO request (nama, jenis_kelamin, ukuran_baju, ukuran_lengan, jumlah, saran, gambar, user_id, menu_id)
    VALUES (in_nama_barang, in_jenis_kelamin, in_ukuran_baju, in_ukuran_lengan, in_jumlah, in_saran, in_gambar, in_user_id, in_menu_id);
END$$

--
-- Fungsi
--
CREATE DEFINER=`` FUNCTION `HitungTotalHarga` (`product_price` INT(11), `quantity` INT(11)) RETURNS INT(11) DETERMINISTIC BEGIN RETURN product_price * quantity;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(5) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `cart_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `cart_view` (
`cart_id` int(11)
,`id` int(5)
,`product_name` varchar(150)
,`product_price` int(5)
,`product_img` varchar(600)
,`user_id` int(11)
,`quantity` int(10)
,`TotalHarga` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `full_order_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `full_order_view` (
`order_id` int(50)
,`order_status` varchar(10)
,`order_date` varchar(20)
,`firstname` varchar(100)
,`lastname` varchar(100)
,`address` varchar(200)
,`city` varchar(50)
,`pincode` varchar(50)
,`payment_mode` varchar(50)
,`user_id` int(11)
,`TotalHarga` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `gaji_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `gaji_view` (
`source` varchar(7)
,`total_pendapatan` decimal(42,0)
,`pendapatan_pemilik` decimal(44,1)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `activity_id` int(11) NOT NULL,
  `action_type` enum('INSERT','UPDATE','DELETE') NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `affected_data` text NOT NULL,
  `nilai_lama` text DEFAULT NULL,
  `nilai_baru` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `action_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`activity_id`, `action_type`, `table_name`, `affected_data`, `nilai_lama`, `nilai_baru`, `user_id`, `action_date`) VALUES
(1, 'DELETE', 'request', 'request_id: 29', '{\"nama\": \"Celana\", \"jenis_kelamin\": \"Laki-Laki\", \"ukuran_baju\": \"M\", \"jumlah\": 8, \"menu_id\": 1, \"user_id\": 22}', NULL, 22, '2024-12-11 22:18:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `nama_barang`, `harga_barang`) VALUES
(1, 'Celana', 18000),
(2, 'Baju', 16000),
(3, 'Lainnya', 20000);

--
-- Trigger `menu`
--
DELIMITER $$
CREATE TRIGGER `after_menu_delete` AFTER DELETE ON `menu` FOR EACH ROW BEGIN
    INSERT INTO logs (
        action_type, 
        table_name, 
        affected_data, 
        nilai_lama, 
        user_id
    )
    VALUES (
        'DELETE', 
        'menu', 
        CONCAT('menu_id: ', OLD.menu_id), 
        JSON_OBJECT('nama_barang', OLD.nama_barang, 'harga_barang', OLD.harga_barang), 
        'USER_ID_PLACEHOLDER'
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_menu_insert` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
    INSERT INTO logs (
        action_type, 
        table_name, 
        affected_data, 
        nilai_baru, 
        user_id
    )
    VALUES (
        'INSERT', 
        'menu', 
        CONCAT('menu_id: ', NEW.menu_id), 
        JSON_OBJECT('nama_barang', NEW.nama_barang, 'harga_barang', NEW.harga_barang), 
        'USER_ID_PLACEHOLDER' -- Ganti dengan variabel sesi
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_menu_update` AFTER UPDATE ON `menu` FOR EACH ROW BEGIN
    INSERT INTO logs (
        action_type, 
        table_name, 
        affected_data, 
        nilai_lama, 
        nilai_baru, 
        user_id
    )
    VALUES (
        'UPDATE', 
        'menu', 
        CONCAT('menu_id: ', OLD.menu_id), 
        JSON_OBJECT('nama_barang', OLD.nama_barang, 'harga_barang', OLD.harga_barang), 
        JSON_OBJECT('nama_barang', NEW.nama_barang, 'harga_barang', NEW.harga_barang), 
        'USER_ID_PLACEHOLDER'
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `user_id` int(20) NOT NULL,
  `order_id` int(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_no` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `order_date` varchar(20) NOT NULL,
  `order_status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`user_id`, `order_id`, `address`, `firstname`, `lastname`, `email`, `contact_no`, `city`, `pincode`, `payment_mode`, `order_date`, `order_status`) VALUES
(22, 75, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-07 13:58:25', 'Complete'),
(22, 74, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '133', 'BCA', '2024-12-07 10:23:48', 'Complete'),
(22, 76, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-07 14:13:24', 'Pending'),
(22, 77, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskali', 'Paskal', 'paskalm30@gmail.com', '081286488876', 'KOTA MEDAN', '121213', 'BRI', '2024-12-07 15:06:17', 'Pending'),
(22, 78, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-07 16:06:29', 'Complete'),
(22, 84, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-10 18:14:47', 'Pending'),
(22, 83, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488876', 'KOTA MEDAN', '121213', 'BRI', '2024-12-09 08:56:04', 'Pending'),
(22, 82, 'JL. SEI BAHKAPURAN NO. 16-B', 'Naurah', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-08 16:52:57', 'Pending'),
(22, 85, 'JL. SEI BAHKAPURAN NO. 16-B', 'Admin', 'Paskal', 'mayadisilalahi@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-10 19:21:27', 'Pending'),
(22, 87, 'JL. SEI BAHKAPURAN NO. 16-B', 'Paskal', 'Paskal', 'paskalm30@gmail.com', '081286488888', 'KOTA MEDAN', '121213', 'BRI', '2024-12-11 13:24:31', 'Pending');

--
-- Trigger `orders`
--
DELIMITER $$
CREATE TRIGGER `after_orders_insert` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
    INSERT INTO logs (
        action_type, 
        table_name, 
        affected_data, 
        nilai_baru, 
        user_id
    )
    VALUES (
        'INSERT', 
        'orders', 
        CONCAT('order_id: ', NEW.order_id), 
        JSON_OBJECT(
            'user_id', NEW.user_id, 
            'address', NEW.address, 
            'firstname', NEW.firstname, 
            'lastname', NEW.lastname, 
            'email', NEW.email, 
            'contact_no', NEW.contact_no, 
            'city', NEW.city, 
            'pincode', NEW.pincode, 
            'payment_mode', NEW.payment_mode, 
            'order_date', NEW.order_date, 
            'order_status', NEW.order_status
        ), 
        NEW.user_id
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(50) DEFAULT NULL,
  `product_id` int(5) DEFAULT NULL,
  `product_price` int(10) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `product_price`, `quantity`) VALUES
(12, 68, 85, 658, 1),
(13, 69, 85, 658, 1),
(14, 70, 85, 658, 1),
(15, 71, 85, 658, 1),
(16, 74, 85, 658, 1),
(17, 75, 85, 658, 1),
(18, 76, 85, 658, 1),
(19, 76, 84, 499, 1),
(21, 78, 84, 499, 1),
(22, 78, 86, 500000, 1),
(25, 80, 86, 500000, 5),
(26, 81, 84, 499, 2),
(27, 81, 87, 4000, 3),
(28, 82, 87, 4000, 3),
(29, 82, 86, 500000, 2),
(30, 83, 84, 499, 1),
(31, 84, 85, 658, 1),
(32, 84, 84, 499, 1),
(33, 85, 85, 658, 1),
(34, 86, 84, NULL, NULL),
(35, 87, 85, 5000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_slider` varchar(20) NOT NULL,
  `product_price` int(5) NOT NULL,
  `product_stock` int(5) NOT NULL,
  `product_img` varchar(600) NOT NULL,
  `product_preview` varchar(1000) NOT NULL,
  `product_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slider`, `product_price`, `product_stock`, `product_img`, `product_preview`, `product_description`) VALUES
(84, 'Uniqlo Versi 3', 'Product', 9000, 9, 'product_img/0613c806091403b04478723b3065a7d7pro14.jpg', 'a:4:{i:0;s:65:\"product_img/preview_img/0613c806091403b04478723b3065a7d7pro13.jpg\";i:1;s:65:\"product_img/preview_img/0613c806091403b04478723b3065a7d7pro15.jpg\";i:2;s:65:\"product_img/preview_img/0613c806091403b04478723b3065a7d7pro16.jpg\";i:3;s:56:\"product_img/preview_img/0613c806091403b04478723b3065a7d7\";}', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic aperiam aliquid fuga atque, porro eaque molestiae molestias temporibus ullam, ipsam dolores perspiciatis sapiente quo animi dolorum repudiandae quis architecto expedita.'),
(85, 'Kaos Tidur', 'Product', 5000, 78, 'product_img/fb0658178c90fe2f8c0bc5f673957e37pro33.jpg', 'a:4:{i:0;s:65:\"product_img/preview_img/fb0658178c90fe2f8c0bc5f673957e37pro32.jpg\";i:1;s:65:\"product_img/preview_img/fb0658178c90fe2f8c0bc5f673957e37pro34.jpg\";i:2;s:65:\"product_img/preview_img/fb0658178c90fe2f8c0bc5f673957e37pro30.jpg\";i:3;s:56:\"product_img/preview_img/fb0658178c90fe2f8c0bc5f673957e37\";}', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error possimus hic laudantium ipsum dicta, aut officia voluptas praesentium earum omnis consectetur nostrum ea, veritatis voluptate? Vero laboriosam soluta recusandae nihil!                    '),
(86, 'Patra', 'Product', 12000, 70, 'product_img/cda28f3a4ec403ebebaf657e67c51bfcbg2.jpg', 'a:4:{i:0;s:74:\"product_img/preview_img/cda28f3a4ec403ebebaf657e67c51bfcservie-pattern.png\";i:1;s:70:\"product_img/preview_img/cda28f3a4ec403ebebaf657e67c51bfcpage-title.png\";i:2;s:66:\"product_img/preview_img/cda28f3a4ec403ebebaf657e67c51bfcfooter.jpg\";i:3;s:62:\"product_img/preview_img/cda28f3a4ec403ebebaf657e67c51bfcbg.jpg\";}', 'Test'),
(87, 'Zenith', 'Product', 4000, 83, 'product_img/f464c9a12ed1fc2f49dc37c84e7b3986shop-banner-2.jpg', 'a:4:{i:0;s:73:\"product_img/preview_img/f464c9a12ed1fc2f49dc37c84e7b3986shop-banner-2.jpg\";i:1;s:56:\"product_img/preview_img/f464c9a12ed1fc2f49dc37c84e7b3986\";i:2;s:56:\"product_img/preview_img/f464c9a12ed1fc2f49dc37c84e7b3986\";i:3;s:56:\"product_img/preview_img/f464c9a12ed1fc2f49dc37c84e7b3986\";}', 'Belilah Murahnya ini!'),
(88, 'Veirdo Mens Cotton T-Shirt', 'Product', 6000, 13, 'product_img/e8fc0c498d1741237137aada2de3e93ashop-rsp1.jpg', 'a:4:{i:0;s:69:\"product_img/preview_img/e8fc0c498d1741237137aada2de3e93ashop-rsp2.jpg\";i:1;s:69:\"product_img/preview_img/e8fc0c498d1741237137aada2de3e93ashop-rsp3.jpg\";i:2;s:69:\"product_img/preview_img/e8fc0c498d1741237137aada2de3e93ashop-rsp4.jpg\";i:3;s:56:\"product_img/preview_img/e8fc0c498d1741237137aada2de3e93a\";}', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolore tempora dicta ut dolorum voluptate iusto quia nobis reiciendis voluptas aliquid? Inventore recusandae quam dolore accusantium? Repellendus, iure culpa. Aspernatur, error!');

--
-- Trigger `products`
--
DELIMITER $$
CREATE TRIGGER `after_products_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
    INSERT INTO logs (
        action_type, 
        table_name, 
        affected_data, 
        nilai_lama, 
        nilai_baru, 
        user_id
    )
    VALUES (
        'UPDATE', 
        'products', 
        CONCAT('product_id: ', OLD.id), 
        JSON_OBJECT(
            'product_name', OLD.product_name, 
            'product_price', OLD.product_price, 
            'product_stock', OLD.product_stock
        ), 
        JSON_OBJECT(
            'product_name', NEW.product_name, 
            'product_price', NEW.product_price, 
            'product_stock', NEW.product_stock
        ), 
        'USER_ID_PLACEHOLDER'
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `report_id` int(40) NOT NULL,
  `report_date` varchar(30) NOT NULL,
  `order_id` int(49) NOT NULL,
  `user_id` int(40) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(400) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`report_id`, `report_date`, `order_id`, `user_id`, `subject`, `message`, `status`) VALUES
(11, '10-12-24', 84, 22, 'Cancel Order', 'Salah Pesan', 'In Process');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `ukuran_baju` varchar(10) NOT NULL,
  `ukuran_lengan` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `saran` varchar(255) NOT NULL,
  `status` enum('pending','in_progress','ready','completed','approved','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `cancel_date` datetime DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`request_id`, `nama`, `jenis_kelamin`, `ukuran_baju`, `ukuran_lengan`, `jumlah`, `gambar`, `saran`, `status`, `created_at`, `updated_at`, `user_id`, `cancel_date`, `menu_id`) VALUES
(16, 'Celana', 'Perempuan', 'M', 'Pendek', 4, 'bg2.jpg', 'Buat coraknya', 'approved', '2024-12-07 09:02:23', '2024-12-09 09:00:51', 22, NULL, 1),
(20, 'Celana', 'Laki-Laki', 'M', 'Pendek', 0, 'bg2.jpg', 'Buat coraknya', 'completed', '2024-12-07 09:11:55', '2024-12-07 14:11:15', 22, NULL, 1),
(21, 'Lainnya', 'Laki-Laki', 'M', 'Pendek', 29983, 'mission.jpg', 'Kece', 'approved', '2024-12-07 10:07:17', '2024-12-07 10:12:41', 22, NULL, 3),
(22, 'Celana', 'Laki-Laki', 'XL', 'Pendek', 0, '', 'Coraknya bg', 'completed', '2024-12-07 13:10:14', '2024-12-07 13:19:41', 22, NULL, 1),
(23, 'Baju', 'Laki-Laki', 'M', 'Panjang', 0, '', '', 'completed', '2024-12-07 14:22:16', '2024-12-07 14:23:45', 22, NULL, 2),
(24, 'Lainnya', 'Laki-Laki', 'L', 'Pendek', 0, '', '', 'completed', '2024-12-07 14:26:49', '2024-12-07 14:30:37', 22, NULL, 3),
(26, 'Baju', 'Laki-Laki', 'M', 'Pendek', 13, '', 'Bagusin bang', 'pending', '2024-12-10 05:55:59', '2024-12-10 05:55:59', 26, NULL, 2),
(27, 'Celana', 'Laki-Laki', 'M', 'Pendek', 6, 'shop-rsp3.jpg', 'Corakin bang gambar panda di Dada ', 'approved', '2024-12-10 17:18:08', '2024-12-10 17:43:32', 22, NULL, 1),
(28, 'Lainnya', 'Laki-Laki', 'M', 'Panjang', 6, '', '', 'pending', '2024-12-10 18:28:40', '2024-12-10 18:28:40', 22, NULL, 3);

--
-- Trigger `request`
--
DELIMITER $$
CREATE TRIGGER `after_request_delete` AFTER DELETE ON `request` FOR EACH ROW BEGIN
    INSERT INTO logs (
        action_type, 
        table_name, 
        affected_data, 
        nilai_lama, 
        user_id
    )
    VALUES (
        'DELETE', 
        'request', 
        CONCAT('request_id: ', OLD.request_id), 
        JSON_OBJECT(
            'nama', OLD.nama, 
            'jenis_kelamin', OLD.jenis_kelamin, 
            'ukuran_baju', OLD.ukuran_baju, 
            'jumlah', OLD.jumlah, 
            'menu_id', OLD.menu_id, 
            'user_id', OLD.user_id
        ), 
        OLD.user_id
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_log`
--

CREATE TABLE `request_log` (
  `log_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jumlah_diambil` int(11) NOT NULL,
  `waktu_diambil` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('in_progress','completed') DEFAULT 'in_progress'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `request_log`
--

INSERT INTO `request_log` (`log_id`, `request_id`, `user_id`, `jumlah_diambil`, `waktu_diambil`, `created_at`, `status`) VALUES
(19, 16, 24, 1, '2022-12-06 15:22:00', '2024-12-07 13:04:06', 'completed'),
(20, 22, 24, 4, '2024-07-17 15:22:08', '2024-12-07 13:17:53', 'completed'),
(26, 24, 25, 2, '2022-10-12 15:22:15', '2024-12-07 14:30:37', 'completed'),
(27, 16, 24, 1, '2024-12-09 09:06:13', '2024-12-09 08:06:13', 'completed'),
(28, 27, 24, 3, '2024-12-10 18:43:32', '2024-12-10 17:43:32', 'completed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_no` varchar(30) DEFAULT NULL,
  `role` enum('customer','admin','employee') NOT NULL DEFAULT 'customer',
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `contact_no`, `role`, `password`, `is_verified`, `verification_code`, `created_at`, `updated_at`) VALUES
(22, 'Paskal', 'Manik', 'paskalm30@gmail.com', '081370998486', 'customer', '$2y$10$ILG3YbZYR1EgyWn6tstQXejrhoY2FPZbakwwxpN3E0yUjp9nJVye.', 1, '', '2024-12-02 16:43:45', '2024-12-02 16:44:02'),
(23, 'Admin', 'Asli', 'admin@gmail.com', '081370998486', 'admin', '$2y$10$e9e816QJPLzHVPx0yAKmmOeQBmIZ48gvagK7FOFmcuMHl5DB6Hmaq', 1, '', '2024-12-02 17:04:19', '2024-12-02 17:04:42'),
(24, 'employee', 'Asli', 'employee@gmail.com', '081286488888', 'employee', '$2y$10$jhjmeNbpCggYQjRDBafgHuUbUd.zvoe1tV4S.i3WFZ0CGWRIlIkjm', 1, '', '2024-12-02 17:23:54', '2024-12-02 17:24:14'),
(25, 'Employee2', 'Asli', 'employee2@gmail.com', '081286488888', 'employee', '$2y$10$Wn93vYLPP4LcwpVnlXs7YeeA9S228qbkiHnzPV80cdI0XDxW7Osb2', 1, '', '2024-12-03 17:27:00', '2024-12-03 17:27:29'),
(26, 'customer', '1', 'customer@gmail.com', '0812864888876', 'customer', '$2y$10$f9p/uTpLrsPWv2oNcpu2NOPEgy6Hg/k9GUI10jAMbEbTV5I5GxKxa', 1, '', '2024-12-10 05:38:22', '2024-12-10 05:43:06');

-- --------------------------------------------------------

--
-- Struktur untuk view `cart_view`
--
DROP TABLE IF EXISTS `cart_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `cart_view`  AS SELECT `c`.`cart_id` AS `cart_id`, `p`.`id` AS `id`, `p`.`product_name` AS `product_name`, `p`.`product_price` AS `product_price`, `p`.`product_img` AS `product_img`, `c`.`user_id` AS `user_id`, `c`.`quantity` AS `quantity`, `HitungTotalHarga`(`p`.`product_price`,`c`.`quantity`) AS `TotalHarga` FROM (`cart` `c` join `products` `p` on(`c`.`id` = `p`.`id`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `full_order_view`
--
DROP TABLE IF EXISTS `full_order_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `full_order_view`  AS SELECT `o`.`order_id` AS `order_id`, `o`.`order_status` AS `order_status`, `o`.`order_date` AS `order_date`, `o`.`firstname` AS `firstname`, `o`.`lastname` AS `lastname`, `o`.`address` AS `address`, `o`.`city` AS `city`, `o`.`pincode` AS `pincode`, `o`.`payment_mode` AS `payment_mode`, `u`.`user_id` AS `user_id`, sum(`HitungTotalHarga`(`p`.`product_price`,`oi`.`quantity`)) AS `TotalHarga` FROM (((`orders` `o` join `order_items` `oi` on(`o`.`order_id` = `oi`.`order_id`)) join `products` `p` on(`oi`.`product_id` = `p`.`id`)) join `users` `u` on(`o`.`user_id` = `u`.`user_id`)) GROUP BY `o`.`order_id`, `o`.`order_status`, `o`.`order_date`, `o`.`firstname`, `o`.`lastname`, `o`.`address`, `o`.`city`, `o`.`pincode`, `o`.`payment_mode`, `u`.`user_id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `gaji_view`
--
DROP TABLE IF EXISTS `gaji_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `gaji_view`  AS SELECT 'Request' AS `source`, sum(`rl`.`jumlah_diambil` * `m`.`harga_barang`) AS `total_pendapatan`, sum(`rl`.`jumlah_diambil` * `m`.`harga_barang`) * 0.6 AS `pendapatan_pemilik` FROM (((`request_log` `rl` join `users` `u` on(`rl`.`user_id` = `u`.`user_id`)) join `request` `r` on(`rl`.`request_id` = `r`.`request_id`)) join `menu` `m` on(`r`.`menu_id` = `m`.`menu_id`)) WHERE `u`.`role` = 'employee' AND `rl`.`status` = 'completed' GROUP BY 'Request'union all select 'Order' AS `source`,sum(`oi`.`product_price` * `oi`.`quantity`) AS `total_pendapatan`,sum(`oi`.`product_price` * `oi`.`quantity`) * 0.6 AS `pendapatan_pemilik` from (`orders` `o` join `order_items` `oi` on(`o`.`order_id` = `oi`.`order_id`)) where `o`.`order_status` = 'complete' group by 'Order'  ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `request_log`
--
ALTER TABLE `request_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `request_log`
--
ALTER TABLE `request_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `request_log`
--
ALTER TABLE `request_log`
  ADD CONSTRAINT `request_log_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`request_id`),
  ADD CONSTRAINT `request_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
