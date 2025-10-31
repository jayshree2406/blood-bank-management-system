-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2025 at 06:31 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_emailid` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_emailid`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$AUTleTXTPkIu8msRPJZ81e/7NYZQkZyzKBbsENYYukld/nC5hC.cW');

-- --------------------------------------------------------

--
-- Table structure for table `blood_stock`
--

CREATE TABLE `blood_stock` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `units` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_stock`
--

INSERT INTO `blood_stock` (`id`, `blood_group`, `units`) VALUES
(1, 'b+', 4);

-- --------------------------------------------------------

--
-- Table structure for table `donation_requests`
--

CREATE TABLE `donation_requests` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `units` int(11) NOT NULL,
  `donation_date` date NOT NULL,
  `donation_time` time NOT NULL,
  `donation_center` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donation_requests`
--

INSERT INTO `donation_requests` (`id`, `donor_id`, `blood_group`, `units`, `donation_date`, `donation_time`, `donation_center`, `notes`, `status`, `created_at`) VALUES
(1, 1, 'b+', 1, '2025-09-05', '09:00:00', 'dindoli', 'xyz', 'Completed', '2025-09-02 04:23:22'),
(2, 1, 'b+', 1, '2025-09-19', '10:00:00', 'udhna', 'abc', 'Rejected', '2025-09-03 03:17:28'),
(3, 2, 'b+', 3, '2025-10-13', '10:00:00', 'udhna', 'fdf', 'Approved', '2025-10-13 04:18:42'),
(4, 3, 'ab+', 5, '2025-10-23', '10:23:00', 'udhna', '', 'Pending', '2025-10-14 04:53:35'),
(5, 4, 'A+', 2, '2025-10-31', '10:30:00', 'Kamrej', '', 'Approved', '2025-10-14 04:57:17'),
(6, 5, 'O+', 2, '2025-12-04', '16:32:00', 'kadodara', '', 'Approved', '2025-10-14 05:02:34'),
(7, 6, 'B-', 1, '2026-03-26', '14:35:00', 'Vapi', '', 'Approved', '2025-10-14 05:04:26'),
(8, 9, 'A-', 8, '2025-10-31', '02:30:00', 'Delhi', '', 'Pending', '2025-10-14 05:48:41'),
(9, 10, 'A-', 7, '2025-10-23', '11:30:00', 'dindoli', '', 'Pending', '2025-10-14 05:52:18'),
(10, 4, 'B+', 2, '2026-01-23', '04:41:00', 'Surat', '', 'Pending', '2025-10-14 10:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `d_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`d_id`, `full_name`, `email`, `phone`, `address`, `blood_group`, `password_hash`, `created_at`) VALUES
(1, 'Jayshree Nikumbh', 'jayshree@24gmail.com', '9023089502', 'surat', 'B+', '$2y$10$pri9o9dMEtuaMcckZie6VuX3fwOLk/fBuQ.3fj03SbGwcQA.pQeNW', '2025-09-02 03:49:09'),
(2, 'patel krish', 'krish@gmail.com', '9023089502', 'vesu', 'B+', '$2y$10$pWZtX.LFu2gqReZLQVuODOYNJIyaT8fWjr9j4F3xwjeh/ucpB5l1a', '2025-10-13 04:14:52'),
(3, 'Mistry Vaishali', 'vaishali@gmail.com', '5672398345', 'kamrej', 'O+', '$2y$10$kW1HBFrA1YQDoO/Hph4qMOMBmq.UnmJahF1e//1EItUeIDHVj3kku', '2025-10-14 04:52:11'),
(4, 'Riya Patel ', 'riya@gmail.com', '7893214560', 'Rami park dindoli', 'A+', '$2y$10$EfhCS3i6dsLCLrMG6Ubq6OD0VFCQzrEk9D/08PA.cFV4hDG.vrGJ6', '2025-10-14 04:56:15'),
(5, 'Mishra Janvi', 'janvi@gmail.com', '5214630987', 'Milinion', 'O+', '$2y$10$bJFCVI5i.o0sH0XuKS8s1e6SZANyUXa9YtMf4Rikps32gSg8XOEd6', '2025-10-14 04:58:22'),
(6, 'pal Mithilesh', 'mithilesh@gmail.com', '5240316987', 'Dindoli', 'B-', '$2y$10$c04Vb5roP5V.BNj6mmN/4ObIfcPBkJ5edgLpH/F8kMCNgRmEdyOVG', '2025-10-14 05:03:39'),
(7, 'Gupta Sudha', 'sudha@gmail.com', '8569745672', 'Kadodra', 'A-', '$2y$10$hnp/HQQ.pp4zfpsWGG8f7.5ydICqEJ5aBYaQngFcrcR/eqb3l2JNy', '2025-10-14 05:17:11'),
(8, 'Shah Siddhi', 'siddhi@gmail.com', '854762358', 'Varachha', 'B-', '$2y$10$FoYZx1PxV8DFPQZsMgKgneqyC7218zYSSsS7KRv3YQjtQ9ZWkfMx2', '2025-10-14 05:22:19'),
(9, 'Patil Pavan', 'pavan@gmail.com', '7564895236', 'Delhi', 'A-', '$2y$10$o01PttyaFDMU5JORPs/43OrfiMzTdTz4F8vIij62/A2YC4DbTZkz2', '2025-10-14 05:47:28'),
(10, 'Arjun Kapoor', 'arjun@gmail.com', '4569875623', 'Mumbai', 'A-', '$2y$10$lYBiwpjAd7hL97nKGPiHXuOLbHqkpQvmK4V8llG.jcMhcR79pnhga', '2025-10-14 05:50:37'),
(11, 'Patel Rutu', 'rutu@gmail.com', '5678942356', 'Surat', 'A-', '$2y$10$FhdozmQUC7XRDPTXzP.wxubsIMv3XUK23KpFv9fMLNzXfG8mzt136', '2025-10-14 07:36:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_emailid` (`admin_emailid`);

--
-- Indexes for table `blood_stock`
--
ALTER TABLE `blood_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blood_group` (`blood_group`);

--
-- Indexes for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_stock`
--
ALTER TABLE `blood_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donation_requests`
--
ALTER TABLE `donation_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donation_requests`
--
ALTER TABLE `donation_requests`
  ADD CONSTRAINT `donation_requests_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`d_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
