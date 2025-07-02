-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2025 at 01:21 PM
-- Server version: 8.0.42-0ubuntu0.22.04.1
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PHP_TEST`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `languages` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subjects` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `lastname`, `email`, `password`, `gender`, `languages`, `subjects`, `image_path`, `created_at`, `updated_at`) VALUES
(33, 'Raya', 'Santana', 'dobo@mailinator.com', '$2y$10$dDJGkGIaYXi7i.ntKVgoLuTJ5Q6TPOWdYiRJkOoZxGiEFc9sCWzWG', 'other', 'German,Italian', 'maths,physics,computer,chemistry', 'uploads/planets.gif', '2025-07-02 12:55:50', '2025-07-02 12:55:50'),
(34, 'Linus', 'Talley', 'zajyvaqez@mailinator.com', '$2y$10$Z0JxbMXCe86Z742X6RXNvuZbBsj8mXZYq9ARGaOoZdn7gA7cpGqlS', 'female', 'Italian', 'physics, chemistry', 'uploads/img_6865316f53bc09.71481035.gif', '2025-07-02 13:17:35', '2025-07-02 13:17:35'),
(35, 'Ivana', 'Osborn', 'jenuvoraky@mailinator.com', '$2y$10$FzihyWp2iwUk6AEIOD.p6u8clkBEqINF.gGHcHMlCVAZwGDNpTAHm', 'male', 'German', 'maths', 'uploads/img_686531802369b2.51865676.gif', '2025-07-02 13:17:52', '2025-07-02 13:17:52'),
(36, 'Conan dhdhdhddhd', 'Moss dfgdgdgddd', 'wywemibud@mailinator.com', '$2y$10$JhQv7I./8yiGpqEDzcYcD.RU4szbRj9QFoKhiJmBZz7Pm5NuQDiF6', 'female', 'German,French', 'maths,computer,chemistry', 'uploads/planets.gif', '2025-07-02 13:18:49', '2025-07-02 13:18:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
