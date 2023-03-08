-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2023 at 09:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230228111416', '2023-02-28 12:14:51', 39),
('DoctrineMigrations\\Version20230228123534', '2023-02-28 13:35:51', 35),
('DoctrineMigrations\\Version20230301084457', '2023-03-01 09:45:18', 35);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `created` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `created`, `image`, `quantity`) VALUES
(12, 'Metro 2034', 10, '2023-03-01', 'image-41033-640018c194c03.jpg', 1),
(13, 'Escape From Furnace 5: Execution', 7, '2023-03-02', 'image-244718-1-1311-640018efd403b.jpg', 1),
(14, 'Shadows Of The Dark Crystal #1 (Jim Henson\'s The Dark Crystal)', 6, '2023-03-02', 'image-195509-1-35521-640019368b996.jpg', 1),
(15, 'American Gods [TV Tie-In]', 6, '2023-03-02', 'image-195509-1-30442-64001977744f3.jpg', 1),
(16, 'Sapiens', 15, '2023-03-02', 'Sapiens-640019c6e4e05.jpg', 1),
(17, 'Perfume: The Story of a Murderer', 8, '2023-03-02', 'image-179425-64001a142e1bb.jpg', 1),
(18, 'Howl\'s Moving Castle', 15, '2023-03-02', 'image-195509-1-1339-64001a4b75d01.jpg', 1),
(19, 'The Lord Of The Rings: The Two Towers', 9, '2023-03-02', '9780008537784-64001ab77f435.jpg', 1),
(20, 'Bridge to Terabithia', 10, '2023-03-02', 'bridge-to-terabithia-1-2018-08-21-17-37-53-64001b1de1cd5.jpg', 1),
(21, 'The Alchemist', 5, '2023-03-02', '9780007155668-1-64001b3b2389a.jpg', 1),
(22, 'Kafka On The Shore', 4, '2023-03-02', '58-1-2-64001b9a65403.jpg', 1),
(23, 'The Old Man And The Sea', 8, '2023-03-02', '9780099908401-3-64001c012378b.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`) VALUES
(1, 'vnguyenduylinh@gmail.com', '[\"ROLE_USER\"]', '$2y$13$W7ZRie9Rp512IwCIDHSwTOgiWCJ9QG6x7R29l05nirMzIOeOnzUuq', 'linhproht'),
(2, 'vnguyenduylinh@gmail.com2', '[\"ROLE_USER\"]', '$2y$13$wgilI.GZjmxipepwkOmJg.gVwTcW6HZXHrcjPfLP0fopixOJsSHYG', '22222'),
(3, 'vnguyenduylinh@gmail.com222', '[\"ROLE_USER\"]', '$2y$13$98DoL3ToGMpUXgjiLejxDuE6BVc6eCwNR4RxST88Bb3dJSz3rqWM2', 'linhproht2'),
(5, 'vnguyenduylinh@gmail.com3', '[\"ROLE_USER\"]', '$2y$13$v7O38aXhDrS6kE6KJ2JbRe2gRsmIwAPtPmSB2syYlLh13Ti68uPsK', 'linhproht3'),
(6, 'vnguyenduylinh123@gmail.com', '[\"ROLE_USER\"]', '$2y$13$5Ds/0npdS6/NXfL0MSJuwOu2sVigscK3KRwdBa1/ARApGTgCUgvOG', 'linhproht123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
