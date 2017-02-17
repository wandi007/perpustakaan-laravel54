-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2017 at 11:32 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `judul`, `penerbit`, `tahun_terbit`, `jumlah_stok`) VALUES
(1, 'jquery', 'erlangga', 1945, 50),
(2, 'php', 'erlangga', 2000, 2),
(5, 'html', 'gramedia', 2017, 30),
(6, 'java', 'jawa', 1800, 2),
(7, 'vb 6', 'vibe', 1700, 10);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_02_07_123425_CreatePinjamsTable', 1),
(2, '2017_02_07_123545_CreateBukusTable', 1),
(3, '2017_02_07_124316_CreatePengarangsTable', 1),
(4, '2017_02_14_111549_CreatePermintaansTable', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengarangs`
--

CREATE TABLE `pengarangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_buku` int(11) NOT NULL,
  `nama_pengarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengarangs`
--

INSERT INTO `pengarangs` (`id`, `id_buku`, `nama_pengarang`) VALUES
(1, 1, 'wandi'),
(2, 2, 'naruto'),
(3, 1, 'sasuke'),
(4, 2, 'orochimaru'),
(5, 5, 'wandi'),
(6, 6, 'jiraya'),
(7, 7, 'wandi'),
(8, 7, 'naruto'),
(9, 7, 'sasuke'),
(10, 7, 'jiraya');

-- --------------------------------------------------------

--
-- Table structure for table `permintaans`
--

CREATE TABLE `permintaans` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permintaans`
--

INSERT INTO `permintaans` (`id`, `id_buku`, `id_user`) VALUES
(1, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pinjams`
--

CREATE TABLE `pinjams` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pinjams`
--

INSERT INTO `pinjams` (`id`, `id_user`, `id_buku`, `tgl_pinjam`, `tgl_kembali`) VALUES
(6, 6, 1, '2017-02-14', '2017-02-21'),
(10, 6, 2, '2017-02-14', '2017-02-21'),
(11, 6, 1, '2017-02-15', '2017-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `jabatan`, `alamat`) VALUES
(1, 'wandi', 'wfebriandi@gmail.com', '$2y$10$BLpO6x33r3DOcY5zEvMT7OX1SwnzsrVaof0aIyGRk5GMQbgE0IeFG', 'JCkWpD2JKDCX4HNxtCzq7CRJDTmhQYZnxPvjO1cuh1Uw2NXGQM69WYvJtByu', '2017-02-07 05:26:46', '2017-02-07 05:26:46', 'anggota', ''),
(2, 'wandi2', 'wandicager@gmail.com', '$2y$10$S..UF6zG3s.ycLyt04PsZuNSarSLxH/EONpcDuTCHZnq9ccsOzALS', '8Vc7SS1wlRmjSbTUOJKfNKEbFcaoScfhBA9ipyILJNaDosiphZH0eFkVsvvz', '2017-02-08 03:21:15', '2017-02-08 03:21:15', 'anggota', ''),
(3, 'tes3', 'tes3@gmail.com', '$2y$10$VsTNkos39uue7Y6UUTio1ej66QeXgYCltU5TJrRnJOu2g0Tffp.Sq', 'oBju7c9Wu7jBsY7tGgdZq4PgLarcPfWyhqURi8jMVeuROA96OQFXoLtGGsMQ', '2017-02-08 05:36:29', '2017-02-08 05:36:29', 'anggota', ''),
(4, 'admin', 'admin@gmail.com', '$2y$10$GrAOkfczIQgD8ba5PSxu4uU4jkbzHZ.gAztohwFAk3Rm/kDQBLU4.', 'obNdmBOYd64FIZcjLD6TyLGuFiMLLzQ01APQ1zKc0e1VB1krEhPZzVlFxlcM', '2017-02-09 04:08:52', '2017-02-09 04:08:52', 'admin', ''),
(5, 'tes4', 'tes4@gmail.com', '$2y$10$KK41npHWv6o1rr.6AXyqwuvXbOBt9gyfniVfRDsxcist2vkmJsHzS', '9lrKY9W0iEYpOGjMvGR1KJYZRMT41fGZJxdq83Zab3oO5TCuHlbOXZWvvo77', '2017-02-09 04:11:39', '2017-02-09 04:11:39', 'anggota', ''),
(6, 'tes5', 'tes5@gmail.com', '$2y$10$pPq6DhuMPXxwYDK4uu28kuMVVblN9qQjwRUj9jIPe2MaHgoCrxTr2', 'SxJ7xQ8n9PynlYfzSpEjAxZPbcSey6e2Ck0roOqrAFuG6zgLv293qQjOM6jS', '2017-02-14 03:16:55', '2017-02-14 03:16:55', 'anggota', 'jln. karang tineung no 71 rt 06 rw 01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengarangs`
--
ALTER TABLE `pengarangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permintaans`
--
ALTER TABLE `permintaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjams`
--
ALTER TABLE `pinjams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengarangs`
--
ALTER TABLE `pengarangs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `permintaans`
--
ALTER TABLE `permintaans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pinjams`
--
ALTER TABLE `pinjams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
