-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2024 at 06:51 PM
-- Server version: 5.7.38-log
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `tests_frt_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_quizzes`
--

CREATE TABLE `client_quizzes` (
                                  `id` bigint(20) UNSIGNED NOT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  `quiz_id` bigint(20) UNSIGNED DEFAULT NULL,
                                  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `first_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `last_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `time_spent` int(11) DEFAULT NULL,
                                  `total_score` double(8,2) DEFAULT NULL,
  `num_questions` int(11) DEFAULT NULL,
  `answered_questions` int(11) DEFAULT NULL,
  `unanswered_questions` int(11) DEFAULT NULL,
  `questions` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_quizzes`
--

INSERT INTO `client_quizzes` (`id`, `created_at`, `updated_at`, `quiz_id`, `name`, `first_name`, `last_name`, `email`, `ip_address`, `time_spent`, `total_score`, `num_questions`, `answered_questions`, `unanswered_questions`, `questions`) VALUES
                                                                                                                                                                                                                                                  (1, '2024-01-13 10:58:21', '2024-01-13 10:58:21', 1, 'test2 lt2', 'test2', 'lt2', 'test2@bws.com', '127.0.0.1', 23, 0.33, 3, 1, 2, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"No\"}]'),
                                                                                                                                                                                                                                                  (2, '2024-01-13 10:59:57', '2024-01-13 10:59:57', 1, 'test1 ttt', 'test1', 'ttt', 'test1@bws.com', '127.0.0.1', 17, 0.33, 3, 1, 2, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"Yes\"}]'),
                                                                                                                                                                                                                                                  (3, '2024-01-13 11:00:48', '2024-01-13 11:00:48', 1, 'test1 ttt', 'test1', 'ttt', 'test1@bws.com', '127.0.0.1', 12, 0.33, 3, 1, 2, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"Yes\"}]'),
                                                                                                                                                                                                                                                  (4, '2024-01-13 11:01:08', '2024-01-13 11:01:08', 1, 'test1 ttt', 'test1', 'ttt', 'test1@bws.com', '127.0.0.1', 43, 0.33, 3, 1, 2, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"No\"}]'),
                                                                                                                                                                                                                                                  (5, '2024-01-13 11:04:12', '2024-01-13 11:04:12', 1, 't1a t1a', 't1a', 't1a', 't1@bws.com', '127.0.0.1', 17, 0.33, 3, 1, 1, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"No\"}]'),
                                                                                                                                                                                                                                                  (6, '2024-01-13 11:08:07', '2024-01-13 11:08:07', 1, 't1a t1a', 't1a', 't1a', 't1a@bws.com', '127.0.0.1', 20, 0.67, 3, 2, 1, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"Yes\"}]'),
                                                                                                                                                                                                                                                  (7, '2024-01-13 11:09:42', '2024-01-13 11:09:42', 1, 't1a t1a', 't1a', 't1a', 't1a@bws.com', '127.0.0.1', 12, 1.00, 3, 3, 0, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"No\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"Yes\"}]'),
                                                                                                                                                                                                                                                  (8, '2024-01-13 11:10:39', '2024-01-13 11:10:39', 1, 't1a t1a', 't1a', 't1a', 't1a@bws.com', '127.0.0.1', 40, 0.33, 3, 1, 2, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\", \"userAnswer\": \"Yes\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\", \"userAnswer\": \"Yes\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\", \"userAnswer\": \"No\"}]'),
                                                                                                                                                                                                                                                  (9, '2024-01-13 11:11:34', '2024-01-13 11:11:34', 3, 'mmm nnn', 'mmm', 'nnn', 'mmm1@bws.com', '127.0.0.1', 27, 0.50, 4, 2, 2, '[{\"valid\": \"a1\", \"answers\": [\"a1\", \"a2\", \"a3\"], \"question\": \"Question 1\", \"userAnswer\": \"a2\"}, {\"valid\": \"b2\", \"answers\": [\"b1\", \"b2\", \"b3\"], \"question\": \"Question 2\", \"userAnswer\": \"b1\"}, {\"valid\": \"c3\", \"answers\": [\"c1\", \"c2\", \"c3\"], \"question\": \"Question 3\", \"userAnswer\": \"c3\"}, {\"valid\": \"d1\", \"answers\": [\"d1\", \"d2\", \"d3\"], \"question\": \"Question 4\", \"userAnswer\": \"d1\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
                                                          (1, '2014_10_12_000000_create_users_table', 1),
                                                          (2, '2014_10_12_100000_create_password_resets_table', 1),
                                                          (3, '2019_08_19_000000_create_failed_jobs_table', 1),
                                                          (4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
                                                          (6, '2024_01_12_092838_create_quizes_table', 2),
                                                          (8, '2024_01_12_092838_create_quizzes_table', 3),
                                                          (12, '2024_01_12_150445_create_client_quizzes_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
                                          `id` bigint(20) UNSIGNED NOT NULL,
                                          `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint(20) UNSIGNED NOT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text COLLATE utf8mb4_unicode_ci,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
                           `id` bigint(20) UNSIGNED NOT NULL,
                           `status` tinyint(4) NOT NULL DEFAULT '1',
                           `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `duration` int(10) UNSIGNED NOT NULL DEFAULT '0',
                           `num_questions` tinyint(4) NOT NULL DEFAULT '0',
                           `questions` json DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `status`, `type`, `title`, `duration`, `num_questions`, `questions`, `created_at`, `updated_at`) VALUES
                                                                                                                                  (1, 1, 'Binary', 'Quiz 1 BINARY', 180, 3, '[{\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 1\"}, {\"valid\": \"No\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 2\"}, {\"valid\": \"Yes\", \"answers\": [\"Yes\", \"No\"], \"question\": \"Question 3\"}]', '2024-01-12 10:23:07', '2024-01-12 10:49:05'),
                                                                                                                                  (3, 1, 'MultipleChoice', 'Quiz 2 Multichoice', 3000, 4, '[{\"valid\": \"a1\", \"answers\": [\"a1\", \"a2\", \"a3\"], \"question\": \"Question 1\"}, {\"valid\": \"b2\", \"answers\": [\"b1\", \"b2\", \"b3\"], \"question\": \"Question 2\"}, {\"valid\": \"c3\", \"answers\": [\"c1\", \"c2\", \"c3\"], \"question\": \"Question 3\"}, {\"valid\": \"d1\", \"answers\": [\"d1\", \"d2\", \"d3\"], \"question\": \"Question 4\"}]', '2024-01-12 11:12:37', '2024-01-12 11:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
    (1, 'Admin', 'admin@bws.com', '2024-01-12 06:13:50', '$2y$10$6UgbpDqyKweb0/rkfX5eXuHBoipOUZxafydTxotpyQhFgjI.Jk/4a', NULL, '2024-01-12 06:13:50', '2024-01-12 06:13:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_quizzes`
--
ALTER TABLE `client_quizzes`
    ADD PRIMARY KEY (`id`),
  ADD KEY `client_quizzes_quiz_id_index` (`quiz_id`),
  ADD KEY `client_quizzes_ip_address_index` (`ip_address`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
    ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_status_index` (`status`),
  ADD KEY `quizzes_type_index` (`type`);

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
-- AUTO_INCREMENT for table `client_quizzes`
--
ALTER TABLE `client_quizzes`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_quizzes`
--
ALTER TABLE `client_quizzes`
    ADD CONSTRAINT `client_quizzes_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);
COMMIT;
