<?php

/* =========================================================
   DATABASE
========================================================= */

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `courses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL UNIQUE,
    `instructor` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `image` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `users2` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `subscribed_courses` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `user_courses` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) NOT NULL,
    `course_title` VARCHAR(255) NOT NULL,
    UNIQUE KEY `unique_sub` (`user_name`, `course_title`),
    FOREIGN KEY (user_name) REFERENCES users2(name) ON DELETE CASCADE,
    FOREIGN KEY (course_title) REFERENCES courses(title) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `lessons` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `course_id` INT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `video_url` VARCHAR(500) NOT NULL,
    `position` INT NOT NULL DEFAULT 1,
    KEY `idx_course_pos` (`course_id`, `position`),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
