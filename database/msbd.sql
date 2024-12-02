-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2024 pada 18.58
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `user_id` int(20) NOT NULL,
  `order_id` int(50) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_qty` int(10) NOT NULL,
  `product_img` varchar(300) NOT NULL,
  `order_total` int(10) NOT NULL,
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(5) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_slider` varchar(20) NOT NULL,
  `product_price` int(5) NOT NULL,
  `product_old_price` int(100) NOT NULL,
  `product_qty` int(5) NOT NULL,
  `product_img` varchar(600) NOT NULL,
  `product_preview` varchar(1000) NOT NULL,
  `product_tag` varchar(100) NOT NULL,
  `product_brand` varchar(50) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_subcategory` varchar(100) NOT NULL,
  `product_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slider`, `product_price`, `product_old_price`, `product_qty`, `product_img`, `product_preview`, `product_tag`, `product_brand`, `product_category`, `product_subcategory`, `product_description`) VALUES
(31, 'Veirdo Mens Cotton T-Shirt', 'new', 479, 1299, 0, 'product_img/e919315f214643f3877eebc40a05d8f871BS24CfKaL._UL1500_.jpg', 'a:4:{i:0;s:80:\"product_img/preview_img/e919315f214643f3877eebc40a05d8f871q4Y0fS8DL._UL1239_.jpg\";i:1;s:80:\"product_img/preview_img/e919315f214643f3877eebc40a05d8f871vVo8hWq8L._UL1239_.jpg\";i:2;s:80:\"product_img/preview_img/e919315f214643f3877eebc40a05d8f8616g73qdgSL._UL1500_.jpg\";i:3;s:80:\"product_img/preview_img/e919315f214643f3877eebc40a05d8f8619V7SmL0PL._UL1239_.jpg\";}', '-56%', 'Veirdo', 'Men', 'Tshirts', '\n    Fit Type: Regular Fit\n    Fabric: 100% Cotton\n    Neck Type : Round Neck\n    Fitting Type: Regular Fit\n    Sleeve : Half Sleeve\n    Wash Care : Do Not Bleach, Hand Wash\n'),
(39, 'Urbano Black Stretch Jeans ', 'todays_deal', 658, 1299, 1230, 'product_img/73de0e47d9d0858fd0c5613bfa538d7d611hFiiUv4L._UL1500_.jpg', 'a:4:{i:0;s:80:\"product_img/preview_img/73de0e47d9d0858fd0c5613bfa538d7d611hFiiUv4L._UL1500_.jpg\";i:1;s:80:\"product_img/preview_img/73de0e47d9d0858fd0c5613bfa538d7d61WCwixBwiL._UL1500_.jpg\";i:2;s:80:\"product_img/preview_img/73de0e47d9d0858fd0c5613bfa538d7d61mlCb4IDcL._UL1500_.jpg\";i:3;s:80:\"product_img/preview_img/73de0e47d9d0858fd0c5613bfa538d7d61wTwuYOaaL._UL1500_.jpg\";}', '-68%', 'Urbano Fashion', 'Men', 'Jeans', '\nSize Chart\n\n    Fit Type: Slim Fit\n    Stylish Washed Jeans with Zip Fly & Buttoned Closure\n    Cotton Blend with Stretch Fabric - To give you extra comfort and flexibility\n    Slim Fit; Mid-Rise; Regular Length\n    Washed Style ; Perfect for Casual, Evening & Party wear\n    Wash Care - Mild Wash ; Wash dark colors separately Disclaimer - There may be slight variation in shade and colour due to photographic effects and monitor settings'),
(83, 'Baju', 'todays_deal', 500000, 25000, 2, 'product_img/52a341f0d75d9e50a502c49c19a0e080Jacket.jpg', 'a:4:{i:0;s:71:\"product_img/preview_img/52a341f0d75d9e50a502c49c19a0e080celanapndek.jpg\";i:1;s:56:\"product_img/preview_img/52a341f0d75d9e50a502c49c19a0e080\";i:2;s:56:\"product_img/preview_img/52a341f0d75d9e50a502c49c19a0e080\";i:3;s:56:\"product_img/preview_img/52a341f0d75d9e50a502c49c19a0e080\";}', '20%', 'Uniqlo', 'Men', 'Tshirts', 'Menarik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `ukuran_baju` varchar(10) NOT NULL,
  `ukuran_lengan` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `saran` varchar(255) NOT NULL,
  `status` enum('pending','in_progress','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`request_id`, `nama`, `jenis_kelamin`, `ukuran_baju`, `ukuran_lengan`, `jumlah`, `gambar`, `saran`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(2, 'Baju', '', 'L', 'Pendek', 2, '', 'tebal ya buat ke jepang', '', '2024-12-02 17:39:39', '2024-12-02 17:54:15', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(40) NOT NULL,
  `ticket_date` varchar(30) NOT NULL,
  `order_id` int(49) NOT NULL,
  `user_id` int(40) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` varchar(400) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_date`, `order_id`, `user_id`, `subject`, `message`, `status`) VALUES
(5, '30-11-24', 40, 6, 'Cancel Order', 'Ga Bagus', 'In Process'),
(6, '30-11-24', 41, 0, 'Size Issue', 'OKE', 'In Process');

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
(21, 'siti', 'audrey', 'siti@gmail.com', '081286488876', 'customer', '$2y$10$aZu1/3CewAOP/h6pZ1G/YONzUZHJBkkzIh6NDLyXQd/HnrRMif.c.', 1, '', '2024-12-02 16:12:51', '2024-12-02 16:13:11'),
(22, 'Paskal', 'Manik', 'paskalm30@gmail.com', '081370998486', 'customer', '$2y$10$ILG3YbZYR1EgyWn6tstQXejrhoY2FPZbakwwxpN3E0yUjp9nJVye.', 1, '', '2024-12-02 16:43:45', '2024-12-02 16:44:02'),
(23, 'Admin', 'Asli', 'admin@gmail.com', '081370998486', 'admin', '$2y$10$e9e816QJPLzHVPx0yAKmmOeQBmIZ48gvagK7FOFmcuMHl5DB6Hmaq', 1, '', '2024-12-02 17:04:19', '2024-12-02 17:04:42'),
(24, 'employee', 'Asli', 'employee@gmail.com', '081286488888', 'employee', '$2y$10$jhjmeNbpCggYQjRDBafgHuUbUd.zvoe1tV4S.i3WFZ0CGWRIlIkjm', 1, '', '2024-12-02 17:23:54', '2024-12-02 17:24:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
