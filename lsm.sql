-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 04:15 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_posts`
--

CREATE TABLE `all_posts` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `post_id` varchar(255) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `post_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_posts`
--

INSERT INTO `all_posts` (`id`, `user_id`, `post_id`, `course_id`, `post_type`, `created_at`, `updated_at`) VALUES
(8, '1', '6', '3', 'normal', '2024-03-05 20:38:39', '2024-03-05 20:38:39'),
(10, '1', '3', '3', 'quiz', '2024-03-05 21:01:54', '2024-03-05 21:01:54'),
(11, '1', '7', '1', 'normal', '2024-03-05 21:04:43', '2024-03-05 21:04:43'),
(12, '1', '8', '4', 'normal', '2024-03-06 02:32:39', '2024-03-06 02:32:39'),
(13, '1', '4', '4', 'quiz', '2024-03-06 02:34:26', '2024-03-06 02:34:26'),
(14, '1', '3', '4', 'assignment', '2024-03-06 02:36:48', '2024-03-06 02:36:48'),
(15, '1', '9', '3', 'normal', '2024-03-06 02:54:51', '2024-03-06 02:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `files` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `total_marks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `user_id`, `course_id`, `title`, `files`, `description`, `deadline`, `total_marks`, `created_at`, `updated_at`) VALUES
(3, '1', '4', 'First Assignment', '[\"\\/upload\\/65e7d6c0c21b1[]CSE-335, DC, Assignment 01.pdf\"]', '<p>please submit tiimely.</p>', '2024-03-07 02:38:00', '10', '2024-03-06 02:36:48', '2024-03-06 02:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` bigint(20) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `assignment_id` varchar(255) DEFAULT NULL,
  `files` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `marks` varchar(255) DEFAULT NULL,
  `teachers_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `post_id` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `teacher_id` varchar(255) DEFAULT NULL,
  `students` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `teacher_id`, `students`, `created_at`, `updated_at`) VALUES
(2, 'WK1091', 'Advance Programming', '1', NULL, '2024-03-01 17:49:31', '2024-03-01 17:49:31'),
(3, 'ohi136', 'Data Mining and Knowledge Discovery', '1', NULL, '2024-03-01 17:51:41', '2024-03-01 17:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `post` longtext DEFAULT NULL,
  `posted_date` varchar(255) DEFAULT NULL,
  `posted_time` varchar(255) DEFAULT NULL,
  `post_type` varchar(255) DEFAULT NULL,
  `files` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `course_id`, `post`, `posted_date`, `posted_time`, `post_type`, `files`, `created_at`, `updated_at`) VALUES
(6, '1', '3', '<p><b style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\"><u style=\"-webkit-tap-highlight-color: transparent;\">Contact Information:&nbsp;</u></b><br style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\"><b style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">Name: Lomat Haidar Chowdhury</b><br style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\"><b style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">Email Id:</b><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">&nbsp;</span><a target=\"_blank\" href=\"https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=tabassumwaishy%40stamforduniversity.edu.bd&amp;authuser=0\" style=\"-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; background-color: rgb(255, 255, 255);\">lomat@stamforduniversity.edu.bd</a><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">&nbsp;or&nbsp;</span><a target=\"_blank\" href=\"https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=tabassumwaishy%40gmai.com&amp;authuser=0\" style=\"-webkit-tap-highlight-color: transparent; text-decoration: none; color: rgb(41, 98, 255); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; background-color: rgb(255, 255, 255);\">lomat@gmai.com</a><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">&nbsp;</span><br style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\"><b style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">Contact Number:</b><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">&nbsp;01*********</span><br></p>', '06 March, 2024', '02:38 AM', NULL, '[]', '2024-03-05 20:38:39', '2024-03-05 20:38:39'),
(7, '1', '1', '<p>hi</p>', '06 March, 2024', '03:04 AM', NULL, '[]', '2024-03-05 21:04:43', '2024-03-05 21:04:43'),
(8, '1', '4', '<p>Welcome to descrete math course. Thank you.</p>', '06 March, 2024', '08:32 AM', NULL, '[]', '2024-03-06 02:32:39', '2024-03-06 02:32:56'),
(9, '1', '3', '<p>this is our logo.</p>', '06 March, 2024', '08:54 AM', NULL, '[\"\\/upload\\/65e7dafb74ac0[]abc.png\"]', '2024-03-06 02:54:51', '2024-03-06 02:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `post_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(4, '1', '3', '2024-03-05 16:40:21', '2024-03-05 16:40:21'),
(10, '1', '12', '2024-03-06 02:33:00', '2024-03-06 02:33:00'),
(11, '20', '12', '2024-03-06 02:33:06', '2024-03-06 02:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `quizzes` longtext DEFAULT NULL,
  `total_marks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `user_id`, `title`, `description`, `deadline`, `quizzes`, `total_marks`, `created_at`, `updated_at`) VALUES
(3, '1', 'Computer Graphics Quiz', '<p>please submit in time.</p>', '2024-03-07 21:00:00', '[{\"question\":\"What does RGB stand for in computer graphics?\",\"option\":[\"Red, Green, Blue\",\"Realistic Graphics Buffer\",\"Random Gradient Buffer\",\"Rendered Graphical Background\"],\"right_ans\":\"Random Gradient Buffer\"},{\"question\":\"Which of the following is NOT a 3D primitive used in computer graphics?\",\"option\":[\"Cube\",\"Rectangle\",\"Cylinder\",\"Sphere\"],\"right_ans\":\"Rectangle\"},{\"question\":\"what is two?\",\"option\":[\"1\",\"2\"],\"right_ans\":\"2\"}]', '3', '2024-03-05 21:01:54', '2024-03-06 02:51:27'),
(4, '1', 'First Quiz', '<p>Please submit it timely.</p>', '2024-03-07 06:41:00', '[{\"question\":\"What is one?\",\"option\":[\"1\",\"2\"],\"right_ans\":\"1\"},{\"question\":\"What is two?\",\"option\":[\"2\",\"3\"],\"right_ans\":\"2\"}]', '2', '2024-03-06 02:34:26', '2024-03-06 02:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submissions`
--

CREATE TABLE `quiz_submissions` (
  `id` bigint(20) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `quiz_id` varchar(255) DEFAULT NULL,
  `answers` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `marks` varchar(255) DEFAULT NULL,
  `teachers_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_submissions`
--

INSERT INTO `quiz_submissions` (`id`, `student_id`, `quiz_id`, `answers`, `comments`, `marks`, `teachers_feedback`, `created_at`, `updated_at`) VALUES
(13, '20', '4', '[{\"question\":\"What is one?\",\"option\":[\"1\",\"2\"],\"right_ans\":\"1\",\"answer\":\"1\"},{\"question\":\"What is two?\",\"option\":[\"2\",\"3\"],\"right_ans\":\"2\",\"answer\":\"3\"}]', NULL, '1', NULL, '2024-03-06 02:42:20', '2024-03-06 02:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `scr`
--

CREATE TABLE `scr` (
  `id` bigint(20) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scr`
--

INSERT INTO `scr` (`id`, `student_id`, `course_id`, `verified`, `created_at`, `updated_at`) VALUES
(8, '6', '3', 1, '2024-03-05 20:31:38', '2024-03-05 20:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `tcr`
--

CREATE TABLE `tcr` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `otp_expired_at` timestamp NULL DEFAULT NULL,
  `is_verified` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `dp` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `otp`, `otp_expired_at`, `is_verified`, `name`, `email`, `password`, `role`, `dp`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, 'Lomat Haidar Chowdhury', 'lomat@gmail.com', '$2y$10$UfR2JYhQy9.YfKioPYeUEeGyvHwH62ZZcEI26HJiewHgpVUZDWOwO', 'teacher', 'uploads/user-images/170932540465e23c5ca3c111656602667704.jfif', 0, '2024-03-01 17:32:08', '2024-03-01 20:36:44'),
(2, NULL, NULL, 1, 'Muhammed Yaseen Morshed Adib', 'yaseen@gmail.com', '$2y$10$IYU1xET2g/q7Dm9yd0eUrur64aNlhKC78KLlTdRWy/./wMOhFitg.', 'teacher', NULL, 0, '2024-03-01 17:33:38', '2024-03-01 17:33:38'),
(3, NULL, NULL, 1, 'Tanveer Ahmed', 'tanveer@gmail.com', '$2y$10$U.0eK9JxyTaCntnaPhcsIuor1Dnx/SOn597ZmLE.Rr6j1m0Nm/516', 'teacher', NULL, 0, '2024-03-01 17:34:38', '2024-03-01 17:34:38'),
(4, NULL, NULL, 1, 'Mashiwat Tabassum Waishy', 'waishy@gmail.com', '$2y$10$3qAA6oK52UcJdhEIh6lb4uWOMPp0vxZ7QCFcfAr/E795Thwuanahm', 'teacher', NULL, 0, '2024-03-01 17:35:26', '2024-03-01 17:35:26'),
(5, NULL, NULL, 1, 'Saiful Islam', 'saiful@gmail.com', '$2y$10$BCT6K5RCNYvQiE.WX8pz3eFGhJVYpbNnrn3PaIU21p3kziCzwgDcC', 'teacher', NULL, 0, '2024-03-01 17:36:31', '2024-03-01 17:36:31'),
(6, NULL, NULL, 1, 'Golam Rahman Sagor', 'sagor@gmail.com', '$2y$10$PlOE.EJK9wcb.UZ39JH1ceuob6tlct/n5/C2UI.4FmvQfVi193Xla', 'student', 'uploads/user-images/170932549965e23cbb1e559323877355_3266150213601914_2346836580765544354_n.jpg', 0, '2024-03-01 17:37:54', '2024-03-01 20:38:19'),
(8, NULL, NULL, 1, 'Ajrin Sultana Asha', 'ajrin@gmail.com', '$2y$10$FqCFBSBcQmTRFHw1EAiFfeSodAj3PWfIuFypJDTyi0p2r5SY1fz7W', 'student', NULL, 0, '2024-03-01 17:39:03', '2024-03-01 17:39:03'),
(9, NULL, NULL, 1, 'Zerin Nodila', 'zerin@gmail.com', '$2y$10$nZu55LRp/.achg4ZPmw5VeMJ2p6MsaXgcYlfvH2BzallOKqoj15wS', 'student', NULL, 0, '2024-03-01 17:39:38', '2024-03-01 17:39:38'),
(10, NULL, NULL, 1, 'Ariful Islam Lipu', 'lipu@gmail.com', '$2y$10$oGfE6SlU2gkeSP8RuHxm7uMnP93c5xR2cfVpF9m1VjyBfkc0/8aCG', 'student', NULL, 0, '2024-03-01 17:40:17', '2024-03-01 17:40:17'),
(11, NULL, NULL, 1, 'Sakibus Sayedat', 'sakib@gmail.com', '$2y$10$psgaNFQWmO2bpHB6nFZi1ue7sD1i7AwqYnNz8ioQ94SWMPkIFjxNy', 'student', NULL, 0, '2024-03-01 17:40:53', '2024-03-01 17:40:53'),
(12, NULL, NULL, 1, 'Ahmed Shafi Arnob', 'arnob@gmail.com', '$2y$10$KuXhCRWP2OXyrVH34JQDZONSXA2gKteY8BI4IIk81Yu4XVB1myCB2', 'student', NULL, 0, '2024-03-01 17:41:35', '2024-03-01 17:41:35'),
(13, NULL, NULL, 1, 'Arif Raihan Abir', 'abir@gmail.com', '$2y$10$ROB7U6b7kljMVTD3Dg1jeuowNe.0K3lL8yKEl9SoL0HKMD.hVMsNu', 'student', NULL, 0, '2024-03-01 17:42:10', '2024-03-01 17:42:10'),
(14, NULL, NULL, 1, 'Ahsan Mahmud', 'ahsan@gmail.com', '$2y$10$Y5AtlBUSqI/beIx9XnhkQuRhVfulhm04IAWrwSrWjwmWmT77PHDdq', 'student', NULL, 0, '2024-03-01 17:42:42', '2024-03-01 17:42:42'),
(15, NULL, NULL, 1, 'Monisonkor Roy', 'monisonkor@gmail.com', '$2y$10$Ti96mhAm1xMXev/FEXaD0ul6LYjjaUUaQOQjrbsThNuX1fQfjFQta', 'student', NULL, 0, '2024-03-01 17:43:50', '2024-03-01 17:43:50'),
(16, NULL, NULL, 1, 'Nusrat Jahan', 'nusrat@gmail.com', '$2y$10$mrKXAG7kFto4PzV1IwSboOIK2FbnZn0u1J.2hPOWeRjpDsHDU/NcG', 'student', NULL, 0, '2024-03-01 17:38:22', '2024-03-01 17:38:22'),
(20, 1432, '2024-03-06 02:30:26', 1, 'Golam Rahman Sagor', 'grsagor08@gmail.com', '$2y$10$h8tNajKXN9LJ1Gr6RH0LPeeJ1joY.oHcYcor1qlRkpdPL3cbgIw3C', 'student', 'uploads/user-images/170969306065e7d884988a4abc-removebg-preview.png', 0, '2024-03-06 02:28:26', '2024-03-06 02:44:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_posts`
--
ALTER TABLE `all_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`code`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scr`
--
ALTER TABLE `scr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tcr`
--
ALTER TABLE `tcr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_posts`
--
ALTER TABLE `all_posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `scr`
--
ALTER TABLE `scr`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tcr`
--
ALTER TABLE `tcr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
