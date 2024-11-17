-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2024 at 12:52 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumify`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_desc` varchar(500) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`, `created`) VALUES
(1, 'PHP', 'PHP is an open-source, server-side programming language that can be used to create websites, applications, customer relationship management systems and more. It is a widely-used general-purpose language that can be embedded into HTML. This functionality with HTML means that the PHP language has remained popular with developers as it helps to simplify HTML code.', '2024-11-12 19:21:48'),
(2, 'ReactJS', 'React is a framework that employs Webpack to automatically compile React, JSX, and ES6 code while handling CSS file prefixes. React is a JavaScript-based UI development library. Although React is a library rather than a language, it is widely used in web development. The library first appeared in May 2013 and is now one of the most commonly used frontend libraries for web development.', '2024-11-12 19:22:49'),
(3, 'Django Delight', 'Get your hands dirty with Django! Share your projects, seek advice, and collaborate with other Django developers.', '2024-11-12 19:57:07'),
(4, 'Python', 'Python is an interpreted, object-oriented, high-level programming language with dynamic semantics developed by Guido van Rossum.', '2024-11-13 15:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `comment_content` text NOT NULL,
  `comment_by` varchar(30) NOT NULL,
  `thread_id` int NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_by`, `thread_id`, `comment_time`) VALUES
(40, 'test comment', 'John', 72, '2024-11-16 19:03:11'),
(41, 'test', '', 40, '2024-11-16 19:04:07'),
(42, 'test', '', 40, '2024-11-16 19:09:27'),
(43, 'test', '', 40, '2024-11-16 19:10:15'),
(44, 'test cmnt', 'Michale', 39, '2024-11-16 19:11:01'),
(45, 'great keep it up ', 'cleverprogrammer', 75, '2024-11-17 18:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int NOT NULL,
  `thread_title` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int NOT NULL,
  `thread_user_id` int NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(39, 'What is Python and why is it used?', 'Python is a computer programming language often used to build websites and software, automate tasks, and analyze data.', 4, 21, '2024-11-14 19:17:20'),
(40, 'Is JavaScript easy or Python?', 'JavaScript is more difficult to master than Python. Python is usually the beginners-choice, especially for those who do not have any prior programming experience. Python code is notorious for being more readable, meaning that it is easier to understand (and write).', 4, 23, '2024-11-14 19:28:40'),
(73, 'What is PHP used for?', 'PHP can be used to develop dynamic and interactive web pages, applications, and eCommerce platforms. PHP is well suited to various web tasks, from generating dynamic web pages, sending emails, and collecting web forms to sending and receiving cookies.', 1, 26, '2024-11-17 17:52:19'),
(75, 'What is PHP mostly used for?', 'PHP finds widespread use in web development, helping to craft dynamic websites, manage content systems, run e-commerce platforms, and build various web applications. Its adaptability and ability to work seamlessly with different databases contribute to its popularity.', 1, 26, '2024-11-17 17:54:22'),
(88, 'Is PHP useful in 2024?', 'Yes, in 2024, PHP is still relevant for a wide range of web development tasks. PHP remains a viable option for building websites due to its ubiquity, integration capabilities, and continuous improvements. The progress of PHP frameworks also contributes to the ongoing relevance of this programming language.', 1, 23, '2024-11-17 18:23:33'),
(89, 'Is React easy to learn?', ' React is easy to learn, but only once you have foundational knowledge in JavaScript. Of course, the difficulty that comes with learning anything new is somewhat subjective. Regardless of your prior experience, plenty of resources are available to help make React easier to learn.', 2, 23, '2024-11-17 18:24:23'),
(90, 'Can I learn React in 7 days?', 'The expected learning period for React ranges from one to six months, depending on your individual circumstances and existing programming knowledge. Having prior experience with JavaScript significantly speeds up the learning process because it&#39;s the programming language used to code React.', 2, 23, '2024-11-17 18:24:54'),
(91, 'What is better, Angular or React?', 'Angular ensures that data is always sync at all levels, with the two-way data binding, that contrasts with one-way data binding of React. React has an easier learning curve, so the ramp-up time is much shorter. React offers a better mobile cross-platform framework solution than Angular.', 2, 23, '2024-11-17 18:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_dt`) VALUES
(20, 'Michale', 'michale@contact.com', '$2y$10$LXvZ.UAH4cuBtgzsFY1Z7uFpaHS9pYPxIkZBcsQdrQPgIRjmZ3fge', '2024-11-14 18:18:39'),
(21, 'John', 'johndoe@contact.com', '$2y$10$8P/PnL7DvX4RwVrN634duuhRDyz11udiDzB86J8sEBZGzrHySA9j6', '2024-11-14 18:41:59'),
(22, 'Tom', 'tomcruise@support.com', '$2y$10$RRce3orbpj6ow/CeIOajg.bs9CBX0qWkSCLuW7OpkA9MImKn0Cd9i', '2024-11-14 18:42:27'),
(23, 'cleverprogrammer', 'clerverprogrammer@contact.com', '$2y$10$FBtQsPbPWGYk9tXBuB5EZOS5jSJDyQyFgmL5xeqMhe0yG9Hcfg632', '2024-11-14 18:43:03'),
(24, 'william', 'william@test.com', '$2y$10$LqfFUjRzw8A1b9ZaicKjReYmWbXaTJln6bo8nSzPUBpvzjed18Si6', '2024-11-14 18:51:47'),
(26, 'ANIK', 'freelanceranik1879@gmail.com', '$2y$10$rPVjIOju29XMXspDDcTsHexojfhhh/MtWHCy9ySJNMBFUvsrdOjei', '2024-11-17 17:49:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
