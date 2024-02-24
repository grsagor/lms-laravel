-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2024 at 05:30 AM
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
('65d5841352648-stlout-59444256142454672', '4', '65d5841350866-stlout-33623956525466851', '65d583daafce6-stlout-91855518025707457', 'normal', '2024-02-21 05:03:15', '2024-02-21 05:03:15'),
('65d5872285c6f-stlout-40103791903232889', '4', '65d58722848d3-stlout-93763649387927357', '65d583daafce6-stlout-91855518025707457', 'assignment', '2024-02-21 05:16:18', '2024-02-21 05:16:18'),
('65d5889b334e4-stlout-85485746375260541', '4', '65d5889b32221-stlout-68198978796971081', '65d583daafce6-stlout-91855518025707457', 'assignment', '2024-02-21 05:22:35', '2024-02-21 05:22:35'),
('65d592efc4eb0-stlout-59596559022722959', '4', '65d592efc3548-stlout-95711980164680679', '65d583daafce6-stlout-91855518025707457', 'quiz', '2024-02-21 06:06:39', '2024-02-21 06:06:39'),
('65d593c22b440-stlout-19617787959063667', '4', '65d593c229380-stlout-47409379579415299', '65d583daafce6-stlout-91855518025707457', 'quiz', '2024-02-21 06:10:10', '2024-02-21 06:10:10');

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
  `total_marks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `user_id`, `course_id`, `title`, `files`, `description`, `deadline`, `total_marks`, `created_at`, `updated_at`) VALUES
('65d58722848d3-stlout-93763649387927357', '4', '65d583daafce6-stlout-91855518025707457', 'Assignment 1 Title', '[\"\\/upload\\/65d5872281de5[]Zulfeqar Haider Khan- CV.pdf\"]', '<p>Assignment 1 Description<br></p>', '2024-02-21 05:15:00', '10', '2024-02-21 05:16:18', '2024-02-21 05:16:18'),
('65d5889b32221-stlout-68198978796971081', '4', '65d583daafce6-stlout-91855518025707457', 'Assignment 2 Title', '[\"\\/upload\\/65d5889b319e1[]Zulfeqar Haider Khan- CV.pdf\"]', '<p>Assignment 2 description</p>', '2024-02-21 05:22:00', '15', '2024-02-21 05:22:35', '2024-02-21 05:22:35');

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
('65d5873fd49a8-stlout-31860405468838579', '65350e1eb853d-stlout-10684209987447268', '65d58722848d3-stlout-93763649387927357', '[\"\\/upload\\/65d5873fd33e3[]Zulfeqar Haider Khan- CV.pdf\"]', '<p>sd</p>', '5', 'aa', '2024-02-21 05:16:47', '2024-02-21 05:23:28'),
('65d588b900d5a-stlout-95165841792898695', '65350e1eb853d-stlout-10684209987447268', '65d5889b32221-stlout-68198978796971081', '[\"\\/upload\\/65d588b9004fe[]Zulfeqar Haider Khan- CV.pdf\"]', '<p>asfad</p>', '7', 'aa', '2024-02-21 05:23:05', '2024-02-21 05:23:43');

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
('65d583daafce6-stlout-91855518025707457', 'WVv589', 'Discrete Math', '4', NULL, '2024-02-21 05:02:18', '2024-02-21 05:02:18');

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
('65d5841350866-stlout-33623956525466851', '4', '65d583daafce6-stlout-91855518025707457', '<p>This is post 1</p>', '21 February, 2024', '11:03 AM', NULL, '[\"\\/upload\\/65d584134ffba[]screencapture-127-0-0-1-8000-pos-2024-01-28-01_01_19.png\"]', '2024-02-21 05:03:15', '2024-02-21 05:03:15');

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
  `id` varchar(255) NOT NULL,
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
('65d592efc3548-stlout-95711980164680679', '4', 'Quiz 1 Title', '<p>Quiz 1 Description<br></p>', '2024-02-21 06:05:00', '[{\"question\":\"What is one?\",\"option\":[\"1\",\"2\"],\"right_ans\":\"1\"},{\"question\":\"What is 2?\",\"option\":[\"2\",\"3\"],\"right_ans\":\"2\"}]', '2', '2024-02-21 06:06:39', '2024-02-21 06:06:39'),
('65d593c229380-stlout-47409379579415299', '4', 'Quiz 2 Title', '<p>Quiz 2 description</p>', '2024-02-21 06:09:00', '[{\"question\":\"What is three?\",\"option\":[\"3\",\"4\"],\"right_ans\":\"3\"},{\"question\":\"What is four?\",\"option\":[\"4\",\"5\"],\"right_ans\":\"4\"}]', '2', '2024-02-21 06:10:10', '2024-02-21 06:10:10');

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
('65d592ffa128e-stlout-27988315583225520', '65350e1eb853d-stlout-10684209987447268', '65d592efc3548-stlout-95711980164680679', '[{\"question\":\"What is one?\",\"option\":[\"1\",\"2\"],\"right_ans\":\"1\",\"answer\":\"1\"},{\"question\":\"What is 2?\",\"option\":[\"2\",\"3\"],\"right_ans\":\"2\",\"answer\":\"2\"}]', NULL, '2', NULL, '2024-02-21 06:06:55', '2024-02-21 06:06:55'),
('65d593e3a2733-stlout-21533673908673839', '65350e1eb853d-stlout-10684209987447268', '65d593c229380-stlout-47409379579415299', '[{\"question\":\"What is three?\",\"option\":[\"3\",\"4\"],\"right_ans\":\"3\",\"answer\":\"3\"},{\"question\":\"What is four?\",\"option\":[\"4\",\"5\"],\"right_ans\":\"4\",\"answer\":\"5\"}]', NULL, '1', NULL, '2024-02-21 06:10:43', '2024-02-21 06:10:43');

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
('65d583eaee181-stlout-59593874089642896', '65350e1eb853d-stlout-10684209987447268', '65d583daafce6-stlout-91855518025707457', 1, '2024-02-21 05:02:34', '2024-02-21 05:02:44');

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
