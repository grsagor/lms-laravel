-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 11:30 PM
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
(1, '1', '1', '3', 'normal', '2024-03-01 18:05:54', '2024-03-01 18:05:54'),
(2, '1', '3', '3', 'normal', '2024-03-01 18:54:14', '2024-03-01 18:54:14'),
(3, '1', '1', '3', 'assignment', '2024-03-01 19:07:20', '2024-03-01 19:07:20'),
(5, '1', '2', '3', 'quiz', '2024-03-01 19:39:52', '2024-03-01 19:39:52');

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
(1, '1', '3', 'Midterm Assignment', '[\"\\/upload\\/65e22768359a5[]Assignment-1.pdf\"]', '<p><font color=\"#3c4043\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 14px; letter-spacing: 0.2px;\">Submit assignment in time.</span></font></p><p><font color=\"#3c4043\" face=\"Roboto, Arial, sans-serif\"><span style=\"font-size: 14px; letter-spacing: 0.2px;\">Don\'t copy.</span></font></p>', '2024-03-14 17:59:00', '5', '2024-03-01 19:07:20', '2024-03-01 19:07:20');

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

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`id`, `student_id`, `assignment_id`, `files`, `comments`, `marks`, `teachers_feedback`, `created_at`, `updated_at`) VALUES
(1, '6', '1', '[\"\\/upload\\/65e2343c69a90[]Sagor.pdf\"]', 'CSE06907989', '4', 'Brilliant', '2024-03-01 20:02:04', '2024-03-01 20:06:14');

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
(1, 'tOg424', 'Machine Learning', '1', NULL, '2024-03-01 17:48:51', '2024-03-01 17:48:51'),
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
(1, '1', '3', '<p>Welcome to <b>DMKD</b> course! Let\'s engage, learn, and grow together. Your active participation is key to&nbsp; success.<br></p>', '02 March, 2024', '12:05 AM', NULL, '[]', '2024-03-01 18:05:54', '2024-03-01 18:05:54'),
(3, '1', '3', '<p><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">Dear&nbsp; students</span><br style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\"><span style=\"color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\">This is the Lecture note of Intersection points.</span><br style=\"-webkit-tap-highlight-color: transparent; color: rgba(0, 0, 0, 0.87); font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 13px;\"><br></p>', '02 March, 2024', '12:54 AM', NULL, '[\"\\/upload\\/65e22455c18f3[]lecture-1.pdf\"]', '2024-03-01 18:54:13', '2024-03-01 18:54:13');

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
(2, '1', 'Class Test-1', NULL, '2024-03-07 17:59:00', '[{\"question\":\"In Data Mining and Knowledge Discovery (DMKD), which technique involves identifying patterns in large datasets?\",\"option\":[\"Regression analysis\",\"Clustering\",\"Decision trees\",\"Linear programming\"],\"right_ans\":\"Linear programming\"},{\"question\":\"What is the primary goal of data preprocessing in DMKD?\",\"option\":[\"To reduce the size of the dataset\",\"To increase data quality\",\"To remove outliers from the dataset\",\"To create visualizations of the data\"],\"right_ans\":\"To reduce the size of the dataset\"},{\"question\":\"Which of the following is not a commonly used algorithm for association rule mining in DMKD?\",\"option\":[\"Apriori algorithm\",\"FP-growth algorithm\",\"K-means algorithm\",\"Eclat algorithm\"],\"right_ans\":\"FP-growth algorithm\"},{\"question\":\"Which evaluation metric is commonly used to assess the performance of classification algorithms in DMKD?\",\"option\":[\"Mean Absolute Error (MAE)\",\"Root Mean Squared Error (RMSE)\",\"F1 Score\",\"R-squared value\"],\"right_ans\":\"R-squared value\"},{\"question\":\"In DMKD, which technique is used for dimensionality reduction by transforming the original variables into a new set of variables?\",\"option\":[\"Principal Component Analysis (PCA)\",\"K-nearest neighbors (KNN)\",\"Support Vector Machines (SVM)\",\"Gradient Boosting Machines (GBM)\"],\"right_ans\":\"Support Vector Machines (SVM)\"}]', '5', '2024-03-01 19:39:52', '2024-03-01 19:39:52');

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
(1, '6', '2', '[{\"question\":\"In Data Mining and Knowledge Discovery (DMKD), which technique involves identifying patterns in large datasets?\",\"option\":[\"Regression analysis\",\"Clustering\",\"Decision trees\",\"Linear programming\"],\"right_ans\":\"Linear programming\",\"answer\":\"Decision trees\"},{\"question\":\"What is the primary goal of data preprocessing in DMKD?\",\"option\":[\"To reduce the size of the dataset\",\"To increase data quality\",\"To remove outliers from the dataset\",\"To create visualizations of the data\"],\"right_ans\":\"To reduce the size of the dataset\",\"answer\":\"To increase data quality\"},{\"question\":\"Which of the following is not a commonly used algorithm for association rule mining in DMKD?\",\"option\":[\"Apriori algorithm\",\"FP-growth algorithm\",\"K-means algorithm\",\"Eclat algorithm\"],\"right_ans\":\"FP-growth algorithm\",\"answer\":\"K-means algorithm\"},{\"question\":\"Which evaluation metric is commonly used to assess the performance of classification algorithms in DMKD?\",\"option\":[\"Mean Absolute Error (MAE)\",\"Root Mean Squared Error (RMSE)\",\"F1 Score\",\"R-squared value\"],\"right_ans\":\"R-squared value\",\"answer\":\"F1 Score\"},{\"question\":\"In DMKD, which technique is used for dimensionality reduction by transforming the original variables into a new set of variables?\",\"option\":[\"Principal Component Analysis (PCA)\",\"K-nearest neighbors (KNN)\",\"Support Vector Machines (SVM)\",\"Gradient Boosting Machines (GBM)\"],\"right_ans\":\"Support Vector Machines (SVM)\",\"answer\":\"Gradient Boosting Machines (GBM)\"}]', NULL, '0', NULL, '2024-03-01 20:09:32', '2024-03-01 20:09:32'),
(2, '8', '2', '[{\"question\":\"In Data Mining and Knowledge Discovery (DMKD), which technique involves identifying patterns in large datasets?\",\"option\":[\"Regression analysis\",\"Clustering\",\"Decision trees\",\"Linear programming\"],\"right_ans\":\"Linear programming\",\"answer\":\"Clustering\"},{\"question\":\"What is the primary goal of data preprocessing in DMKD?\",\"option\":[\"To reduce the size of the dataset\",\"To increase data quality\",\"To remove outliers from the dataset\",\"To create visualizations of the data\"],\"right_ans\":\"To reduce the size of the dataset\",\"answer\":\"To create visualizations of the data\"},{\"question\":\"Which of the following is not a commonly used algorithm for association rule mining in DMKD?\",\"option\":[\"Apriori algorithm\",\"FP-growth algorithm\",\"K-means algorithm\",\"Eclat algorithm\"],\"right_ans\":\"FP-growth algorithm\",\"answer\":\"K-means algorithm\"},{\"question\":\"Which evaluation metric is commonly used to assess the performance of classification algorithms in DMKD?\",\"option\":[\"Mean Absolute Error (MAE)\",\"Root Mean Squared Error (RMSE)\",\"F1 Score\",\"R-squared value\"],\"right_ans\":\"R-squared value\",\"answer\":\"Root Mean Squared Error (RMSE)\"},{\"question\":\"In DMKD, which technique is used for dimensionality reduction by transforming the original variables into a new set of variables?\",\"option\":[\"Principal Component Analysis (PCA)\",\"K-nearest neighbors (KNN)\",\"Support Vector Machines (SVM)\",\"Gradient Boosting Machines (GBM)\"],\"right_ans\":\"Support Vector Machines (SVM)\",\"answer\":\"Principal Component Analysis (PCA)\"}]', NULL, '0', NULL, '2024-03-01 20:26:05', '2024-03-01 20:26:05'),
(3, '12', '2', '[{\"question\":\"In Data Mining and Knowledge Discovery (DMKD), which technique involves identifying patterns in large datasets?\",\"option\":[\"Regression analysis\",\"Clustering\",\"Decision trees\",\"Linear programming\"],\"right_ans\":\"Linear programming\",\"answer\":\"Linear programming\"},{\"question\":\"What is the primary goal of data preprocessing in DMKD?\",\"option\":[\"To reduce the size of the dataset\",\"To increase data quality\",\"To remove outliers from the dataset\",\"To create visualizations of the data\"],\"right_ans\":\"To reduce the size of the dataset\",\"answer\":\"To reduce the size of the dataset\"},{\"question\":\"Which of the following is not a commonly used algorithm for association rule mining in DMKD?\",\"option\":[\"Apriori algorithm\",\"FP-growth algorithm\",\"K-means algorithm\",\"Eclat algorithm\"],\"right_ans\":\"FP-growth algorithm\",\"answer\":\"FP-growth algorithm\"},{\"question\":\"Which evaluation metric is commonly used to assess the performance of classification algorithms in DMKD?\",\"option\":[\"Mean Absolute Error (MAE)\",\"Root Mean Squared Error (RMSE)\",\"F1 Score\",\"R-squared value\"],\"right_ans\":\"R-squared value\",\"answer\":\"F1 Score\"},{\"question\":\"In DMKD, which technique is used for dimensionality reduction by transforming the original variables into a new set of variables?\",\"option\":[\"Principal Component Analysis (PCA)\",\"K-nearest neighbors (KNN)\",\"Support Vector Machines (SVM)\",\"Gradient Boosting Machines (GBM)\"],\"right_ans\":\"Support Vector Machines (SVM)\",\"answer\":\"Gradient Boosting Machines (GBM)\"}]', NULL, '3', NULL, '2024-03-01 20:27:41', '2024-03-01 20:27:41');

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
(1, '6', '3', 1, '2024-03-01 19:43:36', '2024-03-01 19:47:24'),
(2, '6', '2', 1, '2024-03-01 20:11:38', '2024-03-01 20:14:08'),
(3, '8', '3', 1, '2024-03-01 20:24:38', '2024-03-01 20:25:25'),
(4, '12', '3', 1, '2024-03-01 20:26:56', '2024-03-01 20:27:08');

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
(18, 9000, '2024-03-01 22:27:51', 1, 'sagor', 'grsagor08@gmail.com', '$2y$10$NPHlyyONEgXwGZrQnQblgOyUaD4FkzDTXhtiqI0MFLXI0i3aEFMUG', 'student', NULL, 0, '2024-03-01 22:06:05', '2024-03-01 22:26:50');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_submissions`
--
ALTER TABLE `quiz_submissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `scr`
--
ALTER TABLE `scr`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tcr`
--
ALTER TABLE `tcr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
