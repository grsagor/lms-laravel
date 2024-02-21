-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 07:19 PM
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
  `id` varchar(255) NOT NULL,
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
('6537ed737f6f4-stlout-72232086538164197', '4', '6537ed737ed7b-stlout-82804592575662684', '653746624ea2b-stlout-12896205320286654', 'assignment', '2023-10-24 16:14:43', '2023-10-24 16:14:43'),
('6539588c7d90d-stlout-23751450834589994', '4', '6539588c77d6a-stlout-62946251838315479', '653746624ea2b-stlout-12896205320286654', 'assignment', '2023-10-25 18:03:56', '2023-10-25 18:03:56'),
('6547e0b6526f1-stlout-72031127419191086', '4', '6547e0b64fbc0-stlout-94149479298431346', '653746624ea2b-stlout-12896205320286654', 'quiz', '2023-11-05 18:36:38', '2023-11-05 18:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `course_id` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `files` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `user_id`, `course_id`, `title`, `files`, `description`, `deadline`, `created_at`, `updated_at`) VALUES
('6537ed737ed7b-stlout-82804592575662684', '4', '653746624ea2b-stlout-12896205320286654', 'asdfas', '[\"\\/upload\\/Zulfeqar Haider Khan- CV.pdf\"]', '<ul><li>dfasdfasdf</li></ul>', '2023-10-25 16:12:00', '2023-10-24 16:14:43', '2023-10-24 16:14:43'),
('6539588c77d6a-stlout-62946251838315479', '4', '653746624ea2b-stlout-12896205320286654', NULL, '[]', NULL, '2023-10-25 18:03:56', '2023-10-25 18:03:56', '2023-10-25 18:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

CREATE TABLE `assignment_submissions` (
  `id` varchar(255) NOT NULL,
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
('65b4a4219addb-stlout-20195332737250917', '65350e1eb853d-stlout-10684209987447268', '6537ed737ed7b-stlout-82804592575662684', '[\"\\/upload\\/Zulfeqar Haider Khan- CV.pdf\"]', NULL, '10', 'aserawerw', '2024-01-27 06:35:13', '2024-01-27 06:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `post_id` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`, `updated_at`) VALUES
('65ac02826aa3f-stlout-52560231832978232', '4', '6537ed737f6f4-stlout-72232086538164197', 'ki khobor', '2024-01-20 17:27:30', '2024-01-20 17:27:30'),
('65ac0286da93e-stlout-51659995000833680', '4', '6537ed737f6f4-stlout-72232086538164197', 'bhalo to?', '2024-01-20 17:27:34', '2024-01-20 17:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` varchar(255) NOT NULL,
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
('653746624ea2b-stlout-12896205320286654', 'RXd601', 'First Course', '4', NULL, '2023-10-23 22:21:54', '2023-10-23 22:21:54'),
('6537484e9f56d-stlout-40657266389260616', 'izg908', 'Second class', '4', NULL, '2023-10-23 22:30:06', '2023-10-23 22:30:06'),
('65b4a3422da68-stlout-85615500327349598', 'APL622', 'test couse', '4', NULL, '2024-01-27 06:31:30', '2024-01-27 06:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_10_22_080614_create_users_table', 1),
(3, '2023_10_22_104907_create_posts_table', 2),
(4, '2023_10_22_104927_create_comments_table', 2),
(5, '2023_10_22_105236_create_courses_table', 2),
(6, '2023_10_22_105357_create_assignments_table', 2),
(7, '2023_10_22_105405_create_quizzes_table', 2),
(8, '2023_10_24_041302_create_t_c_r_s_table', 3),
(9, '2023_10_24_041314_create_s_c_r_s_table', 3),
(10, '2023_10_24_212008_create_all_posts_table', 4),
(11, '2023_11_06_023459_create_assignment_submissions_table', 5),
(12, '2023_11_07_003104_create_quiz_submissions_table', 5),
(13, '2024_01_20_132339_create_post_likes_table', 6);

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
  `id` varchar(255) NOT NULL,
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
('6547e1856984e-stlout-82334645585038009', '4', '653746624ea2b-stlout-12896205320286654', 'Est explicabo. Dolor.f', '06 November, 2023', '12:40 AM', 'normal', '[]', '2023-11-05 18:40:05', '2023-11-05 18:40:05');

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
(8, '4', '6539588c7d90d-stlout-23751450834589994', '2024-01-20 10:46:36', '2024-01-20 10:46:36'),
(9, '4', '6547e0b6526f1-stlout-72031127419191086', '2024-01-20 10:46:46', '2024-01-20 10:46:46'),
(12, '4', '6537ed737f6f4-stlout-72232086538164197', '2024-02-20 18:00:33', '2024-02-20 18:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `quizzes` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `user_id`, `title`, `description`, `deadline`, `quizzes`, `created_at`, `updated_at`) VALUES
('6547e0b64fbc0-stlout-94149479298431346', '4', 'Perspiciatis velit', NULL, '2023-10-02 16:25:00', '[{\"question\":\"Excepturi et autem q\",\"option\":[\"Unde sapiente quam e\",\"Qui dolor perspiciat\",\"Ipsum adipisicing te\",\"Iure pariatur Commo\"],\"right_ans\":\"Qui dolor perspiciat\"},{\"question\":\"Nisi expedita nobis\",\"option\":[\"Et sunt et mollitia\",\"Incididunt est quasi\",\"Nemo repellendus Eo\",\"Vel quam tempor fugi\"],\"right_ans\":\"Incididunt est quasi\"}]', '2023-11-05 18:36:38', '2023-11-05 18:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_submissions`
--

CREATE TABLE `quiz_submissions` (
  `id` varchar(255) NOT NULL,
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
('65b4a61c5ad96-stlout-20653058328948510', '65350e1eb853d-stlout-10684209987447268', '6547e0b64fbc0-stlout-94149479298431346', '[{\"question\":\"Excepturi et autem q\",\"option\":[\"Unde sapiente quam e\",\"Qui dolor perspiciat\",\"Ipsum adipisicing te\",\"Iure pariatur Commo\"],\"right_ans\":\"Qui dolor perspiciat\",\"answer\":\"Qui dolor perspiciat\"},{\"question\":\"Nisi expedita nobis\",\"option\":[\"Et sunt et mollitia\",\"Incididunt est quasi\",\"Nemo repellendus Eo\",\"Vel quam tempor fugi\"],\"right_ans\":\"Incididunt est quasi\",\"answer\":\"Et sunt et mollitia\"}]', NULL, '1', NULL, '2024-01-27 06:43:40', '2024-01-27 06:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `scr`
--

CREATE TABLE `scr` (
  `id` varchar(255) NOT NULL,
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
('6547d64267c49-stlout-45569832707172966', '65350e1eb853d-stlout-10684209987447268', '653746624ea2b-stlout-12896205320286654', 0, '2023-11-05 17:52:02', '2023-11-05 17:52:02');

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
  `id` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `dp`, `status`, `created_at`, `updated_at`) VALUES
('4', 'Hello Teacher', 'n@teacher.com', '$2y$10$MSGEfzMv104ovJhsdPAeCeXxCMfBc51BMuY.nvLvm5pEr9wKPfFVm', 'teacher', 'uploads/user-images/170577460765ac0e0f5f9da1.jpg', 0, '2023-10-22 04:38:19', '2024-01-20 18:17:18'),
('65350e1eb853d-stlout-10684209987447268', 'Nusrat Student 1', 'n1@student.com', '$2y$10$xn8kebTVXlsCOOkuovEwi.IYpesjM4F.ydblVBECfm9EyyUqDqWIu', 'student', NULL, 0, '2023-10-22 05:57:18', '2023-10-22 05:57:18'),
('65350e3b0efd2-stlout-21302338425649725', 'Nusrat Student 1', 'n2@student.com', '$2y$10$AmIXHcLXpWuEOAx8pLxWyOSfEOU8M0kWn8rfvtM7RSqSXXBomKyhS', 'student', NULL, 0, '2023-10-22 05:57:47', '2023-10-22 05:57:47');

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tcr`
--
ALTER TABLE `tcr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
