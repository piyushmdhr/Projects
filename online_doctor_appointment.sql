-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 01:39 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_doctor_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_email_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_contact_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_email_address`, `admin_password`, `admin_name`, `admin_contact_no`) VALUES
(1, 'admin@gmail.com', 'admin', 'Piyush Manandhar', '9860452701');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_schedule_id` int(11) NOT NULL,
  `appointment_number` int(11) NOT NULL,
  `reason_for_appointment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `appointment_time` time NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `patient_come_into_hospital` enum('No','Yes') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_comment` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appointment_table`
--

INSERT INTO `appointment_table` (`appointment_id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `patient_come_into_hospital`, `doctor_comment`) VALUES
(3, 1, 3, 2, 1000, 'Pain in Stomach', '09:00:00', 'Booked', 'No', ''),
(4, 1, 3, 2, 1001, 'Paint in stomach', '09:00:00', 'Booked', 'No', ''),
(5, 1, 4, 2, 1002, 'For Delivery', '09:30:00', 'Booked', 'Yes', 'She gave birth to boy baby.'),
(6, 5, 3, 7, 1003, 'Fever and cold.', '18:00:00', 'Completed', 'Yes', ''),
(7, 6, 5, 13, 1004, 'Pain in Stomach.', '15:30:00', 'Booked', 'Yes', 'Acidity Problem. '),
(61, 4, 1, 6, 1007, '', '00:00:00', 'Cancelled', 'No', ''),
(64, 4, 1, 6, 1010, '', '00:00:00', 'Cancelled', 'No', ''),
(65, 2, 1, 3, 1011, '', '00:00:00', 'Cancelled', 'No', ''),
(67, 2, 1, 8, 1013, '', '00:00:00', 'Cancelled', 'No', ''),
(69, 2, 1, 3, 1015, '', '00:00:00', 'Cancelled', 'No', ''),
(73, 2, 1, 8, 1019, '', '00:00:00', 'Cancelled', 'No', ''),
(75, 6, 1, 13, 1021, '', '00:00:00', 'Booked', 'No', ''),
(76, 4, 1, 12, 1022, '', '00:00:00', 'Booked', 'No', ''),
(81, 2, 18, 3, 1027, '', '00:00:00', 'Cancelled', 'No', ''),
(82, 4, 18, 6, 1028, '', '00:00:00', 'Booked', 'No', ''),
(104, 10, 21, 18, 1050, '', '00:00:00', 'Cancelled', 'No', ''),
(105, 10, 21, 18, 1051, '', '00:00:00', 'Completed', 'No', 'All OK. Done. Fine'),
(106, 10, 21, 19, 1052, '', '00:00:00', 'Booked', 'No', ''),
(108, 2, 21, 8, 1054, '', '00:00:00', 'Completed', 'No', ''),
(109, 6, 21, 14, 1055, '', '00:00:00', 'Booked', 'No', ''),
(110, 6, 21, 14, 1056, '', '00:00:00', 'Booked', 'No', ''),
(112, 10, 22, 18, 1058, '', '00:00:00', 'Cancelled', 'No', ''),
(119, 10, 1, 22, 1065, '', '00:00:00', 'Completed', 'Yes', ''),
(125, 4, 23, 6, 1071, '', '00:00:00', 'Cancelled', 'No', ''),
(127, 2, 23, 26, 1073, '', '00:00:00', 'Booked', 'No', ''),
(137, 10, 1, 22, 1083, '', '00:00:00', 'Completed', 'No', ''),
(138, 10, 1, 22, 1084, '', '00:00:00', 'Cancelled', 'Yes', ''),
(141, 6, 1, 13, 1087, '', '00:00:00', 'Booked', 'No', ''),
(142, 6, 1, 13, 1088, '', '00:00:00', 'Cancelled', 'No', ''),
(146, 10, 1, 22, 1092, '', '00:00:00', 'Booked', 'No', ''),
(147, 10, 1, 19, 1093, '', '00:00:00', 'Booked', 'No', ''),
(165, 6, 14, 14, 1108, '', '00:00:00', 'Booked', 'No', ''),
(166, 5, 4, 4, 1109, '', '00:00:00', 'Booked', 'No', ''),
(167, 5, 7, 7, 1110, '', '00:00:00', 'Booked', 'No', ''),
(168, 5, 9, 9, 1111, '', '00:00:00', 'Booked', 'No', ''),
(169, 5, 9, 9, 1112, '', '00:00:00', 'Booked', 'No', ''),
(170, 10, 22, 22, 1113, '', '00:00:00', 'Booked', 'No', ''),
(171, 4, 6, 6, 1114, '', '00:00:00', 'Booked', 'No', ''),
(172, 4, 12, 12, 1115, '', '00:00:00', 'Booked', 'No', ''),
(173, 3, 11, 11, 1116, '', '00:00:00', 'Booked', 'No', ''),
(174, 3, 5, 5, 1117, '', '00:00:00', 'Booked', 'No', ''),
(178, 4, 1, 6, 1121, '', '00:00:00', 'Booked', 'No', ''),
(179, 4, 1, 12, 1122, '', '00:00:00', 'Booked', 'No', ''),
(180, 3, 1, 5, 1123, '', '00:00:00', 'Booked', 'No', ''),
(193, 3, 1, 11, 1136, '', '00:00:00', 'Booked', 'No', ''),
(198, 4, 1, 12, 1140, '', '00:00:00', 'Booked', 'No', ''),
(206, 4, 1, 6, 1148, '', '00:00:00', 'Booked', 'No', ''),
(207, 5, 1, 4, 1149, '', '00:00:00', 'Cancelled', 'No', ''),
(208, 5, 1, 7, 1150, '', '00:00:00', 'Cancelled', 'No', ''),
(213, 5, 1, 7, 1155, '', '00:00:00', 'Booked', 'No', ''),
(214, 5, 1, 9, 1156, '', '00:00:00', 'Booked', 'No', ''),
(215, 5, 1, 7, 1157, '', '00:00:00', 'Booked', 'No', ''),
(216, 5, 1, 7, 1158, '', '00:00:00', 'Booked', 'No', ''),
(217, 10, 1, 19, 1159, '', '00:00:00', 'Cancelled', 'No', ''),
(218, 6, 1, 14, 1160, '', '00:00:00', 'Booked', 'No', ''),
(219, 2, 1, 8, 1161, '', '00:00:00', 'Booked', 'No', ''),
(220, 2, 1, 28, 1162, '', '00:00:00', 'Cancelled', 'No', ''),
(221, 10, 23, 29, 1163, '', '00:00:00', 'Booked', 'Yes', ''),
(222, 10, 23, 30, 1164, '', '00:00:00', 'Booked', 'Yes', ''),
(223, 10, 23, 30, 1165, '', '00:00:00', 'Booked', 'Yes', ''),
(224, 6, 23, 27, 1166, '', '00:00:00', 'Booked', 'No', ''),
(225, 10, 23, 29, 1167, '', '00:00:00', 'Booked', 'Yes', ''),
(226, 10, 23, 30, 1168, '', '00:00:00', 'Booked', 'Yes', ''),
(227, 10, 23, 29, 1169, '', '00:00:00', 'Completed', 'Yes', ''),
(228, 10, 23, 30, 1170, '', '00:00:00', 'Booked', 'No', ''),
(229, 10, 23, 29, 1171, '', '00:00:00', 'Completed', 'Yes', ''),
(230, 10, 23, 30, 1172, '', '00:00:00', 'Booked', 'No', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule_table`
--

CREATE TABLE `doctor_schedule_table` (
  `doctor_schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_start_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_end_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `average_consulting_time` int(5) NOT NULL,
  `doctor_schedule_status` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_schedule_table`
--

INSERT INTO `doctor_schedule_table` (`doctor_schedule_id`, `doctor_id`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_start_time`, `doctor_schedule_end_time`, `average_consulting_time`, `doctor_schedule_status`) VALUES
(4, 5, '2021-02-19', 'Friday', '10:00', '14:00', 10, 'Not Available'),
(5, 3, '2021-02-19', 'Friday', '13:00', '17:00', 20, 'Available'),
(6, 4, '2021-02-19', 'Friday', '15:00', '18:00', 5, 'Available'),
(7, 5, '2021-02-22', 'Monday', '18:00', '20:00', 10, 'Available'),
(8, 2, '2021-02-24', 'Wednesday', '09:30', '12:30', 5, 'Available'),
(9, 5, '2021-02-24', 'Wednesday', '11:00', '15:00', 10, 'Available'),
(11, 3, '2021-02-24', 'Wednesday', '14:00', '17:00', 15, 'Available'),
(12, 4, '2021-02-24', 'Wednesday', '16:00', '20:00', 10, 'Available'),
(13, 6, '2021-02-24', 'Wednesday', '15:30', '18:30', 10, 'Available'),
(14, 6, '2021-02-25', 'Thursday', '10:00', '13:30', 10, 'Available'),
(18, 10, '2021-05-13', 'Thursday', '16:00', '18:30', 5, 'Not Available'),
(19, 10, '2021-05-03', 'Monday', '13:30', '16:15', 15, 'Available'),
(22, 10, '2021-05-09', 'Sunday', '18:30', '20:00', 10, 'Not Available'),
(27, 6, '2021-05-11', 'Tuesday', '18:53', '22:05', 10, 'Available'),
(28, 2, '2021-05-11', 'Tuesday', '10:30', '14:00', 15, 'Available'),
(29, 10, '2021-05-11', 'Tuesday', '18:30', '20:30', 10, 'Available'),
(30, 10, '2021-05-11', 'Tuesday', '22:00', '23:30', 5, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `doctor_id` int(11) NOT NULL,
  `doctor_email_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_phone_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `doctor_date_of_birth` date NOT NULL,
  `doctor_expert_in` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_table`
--

INSERT INTO `doctor_table` (`doctor_id`, `doctor_email_address`, `doctor_password`, `doctor_name`, `doctor_phone_no`, `doctor_address`, `doctor_date_of_birth`, `doctor_expert_in`, `doctor_status`, `doctor_added_on`) VALUES
(1, 'peterparker@gmail.com', 'password', 'Dr. Peter Parker', '7539518520', '102, Sky View, NYC', '1985-10-29', 'Ophthalmology', 'Active', '2021-02-15 17:04:59'),
(2, 'adambrodly@gmail.com', 'password', 'Dr. Adam Broudly', '753852963', '105, Fort, NYC', '1982-08-10', 'General Physician', 'Active', '2021-02-18 15:00:32'),
(3, 'sophia.parker@gmail.com', 'password', 'Dr. Sophia Parker', '7417417410', '50, Best street CA', '1989-04-03', 'Cardiology', 'Active', '2021-02-18 15:05:02'),
(4, 'williampeterson@gmail.com', 'password', 'Dr. William Peterson', '8523698520', '32, Green City, NYC', '1984-06-11', 'General Physician', 'Active', '2021-02-18 15:08:24'),
(5, 'emmalarsdattor@gmail.com', 'password', 'Dr. Emma Larsdattor', '9635852025', '25, Silver Arch', '1988-03-03', 'Neurology', 'Active', '2021-02-18 15:15:23'),
(6, 'manuel.armstrong@gmail.com', 'password', 'Dr. Manuel Armstrong', '8523697410', '2378 Fire Access Road Asheboro, NC 27203', '1989-03-01', 'Hepatology', 'Active', '2021-02-23 17:26:16'),
(10, 'doctor2@gmail.com', '123', 'Doctor 2', '11412', 'dsdsdv', '2021-05-11', 'Neurology', 'Active', '2021-05-02 21:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `patient_table`
--

CREATE TABLE `patient_table` (
  `patient_id` int(11) NOT NULL,
  `patient_email_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_date_of_birth` date NOT NULL,
  `patient_gender` enum('Male','Female','Other') COLLATE utf8_unicode_ci NOT NULL,
  `patient_address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `patient_phone_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `patient_maritial_status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `patient_added_on` datetime NOT NULL,
  `patient_blood_type` enum('A','B','AB','O') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_table`
--

INSERT INTO `patient_table` (`patient_id`, `patient_email_address`, `patient_password`, `patient_first_name`, `patient_last_name`, `patient_date_of_birth`, `patient_gender`, `patient_address`, `patient_phone_no`, `patient_maritial_status`, `patient_added_on`, `patient_blood_type`) VALUES
(17, 'apex@college.com', 'apex', 'Apex', ' College', '2021-03-30', 'Male', 'Baneshwor, Kathmandu, Nepal', '7410460', 'Single', '2021-04-28 10:50:19', 'A'),
(3, 'jacobmartin@gmail.com', 'password', 'Jacob', 'Martin', '2021-02-26', 'Male', 'Green view, 1025, NYC', '85745635210', 'Single', '2021-02-18 16:34:55', 'AB'),
(4, 'oliviabaker@gmail.com', 'password', 'Olivia', 'Baker', '2001-04-05', 'Female', 'Diamond street, 115, NYC', '7539518520', 'Married', '2021-02-19 18:28:23', 'A'),
(19, 'patient23@gmail.com', '123', 'asfuy', 'sdnsdg', '2000-12-18', 'Male', 'bzdfbfdf', '1412412', 'Single', '2021-05-02 13:01:22', 'O'),
(20, 'patient3@gmail.com', '123', 'dfgsdfb', 'fxbd', '1998-06-05', 'Other', 'sdfgsdfgsdf', '412412', 'Divorced', '2021-05-02 13:17:56', 'A'),
(24, 'patient34@gmail.com', '123', 'agdf', 'dag', '2021-05-05', 'Male', 'sfsdfsd', '165', 'Single', '2021-05-10 11:11:49', 'A'),
(22, 'patient42@gmail.com', '123', 'sadas', ' sfas', '2021-05-13', 'Male', 'dsfds', '1221', 'Single', '2021-05-04 10:56:19', 'A'),
(21, 'patient73@gmail.com', '123', 'aasdasd', 'sdvss', '2021-05-02', 'Male', 'dsdsf', '112321', 'Single', '2021-05-03 14:52:18', 'A'),
(23, 'patient9@gmail.com', '123', 'sfasdf', ' sdagfasdg', '2021-05-19', 'Male', 'dagasdfasdf', '234214', 'Single', '2021-05-05 15:27:20', 'B'),
(1, 'piyush.mdhr@gmail.com', '1234', 'Piyush', ' Manandhar', '2021-04-23', 'Male', 'hfcytfku', '16984531', 'Single', '2021-04-27 11:31:57', 'A'),
(5, 'web-tutorial@programmer.net', 'password', 'Amber', 'Anderson', '1995-07-25', 'Female', '2083 Cameron Road Buffalo, NY 14202', '75394511442', 'Single', '2021-02-23 17:50:06', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  ADD PRIMARY KEY (`doctor_schedule_id`);

--
-- Indexes for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patient_table`
--
ALTER TABLE `patient_table`
  ADD PRIMARY KEY (`patient_email_address`),
  ADD UNIQUE KEY `patient_id` (`patient_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  MODIFY `doctor_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `doctor_table`
--
ALTER TABLE `doctor_table`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient_table`
--
ALTER TABLE `patient_table`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
