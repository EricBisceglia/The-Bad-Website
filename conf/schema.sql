--
-- Setup
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database
--

CREATE DATABASE IF NOT EXISTS `thebadwebsite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `thebadwebsite`;

-- --------------------------------------------------------

--
-- Table structure for table `comics`
--

DROP TABLE IF EXISTS `comics`;
CREATE TABLE IF NOT EXISTS `comics` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_comic_types` int UNSIGNED NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `title_en` tinytext NOT NULL,
  `title_fr` tinytext NOT NULL,
  `description_en` text NOT NULL,
  `description_fr` text NOT NULL,
  `youtube_id_en` tinytext NOT NULL,
  `youtube_id_fr` tinytext NOT NULL,
  `view_count` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comics_types` (`fk_comic_types`),
  KEY `comics_public` (`is_public`),
  KEY `comics_upload_date` (`upload_date`),
  KEY `comics_view_count` (`view_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comic_tags`
--

DROP TABLE IF EXISTS `comic_tags`;
CREATE TABLE IF NOT EXISTS `comic_tags` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_tags` int UNSIGNED NOT NULL,
  `fk_comics` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comic_tags_tags` (`fk_tags`),
  KEY `comic_tags_comics` (`fk_comics`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comic_types`
--

DROP TABLE IF EXISTS `comic_types`;
CREATE TABLE IF NOT EXISTS `comic_types` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sorting_order` int UNSIGNED NOT NULL,
  `slug` tinytext NOT NULL,
  `is_major` tinyint(1) NOT NULL,
  `banner_en` tinytext NOT NULL,
  `banner_fr` tinytext NOT NULL,
  `name_en` tinytext NOT NULL,
  `name_fr` tinytext NOT NULL,
  `description_en` text NOT NULL,
  `description_fr` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comic_types_sorting_order` (`sorting_order`),
  KEY `comic_types_is_major` (`is_major`),
  KEY `comic_types_slug` (`slug`(20))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

DROP TABLE IF EXISTS `ideas`;
CREATE TABLE IF NOT EXISTS `ideas` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_idea_types` int UNSIGNED NOT NULL,
  `title` tinytext NOT NULL,
  `body` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ideas_title` (`title`(16)),
  KEY `ideas_idea_types` (`fk_idea_types`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `idea_types`
--

DROP TABLE IF EXISTS `idea_types`;
CREATE TABLE IF NOT EXISTS `idea_types` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sorting_order` int UNSIGNED NOT NULL,
  `name_en` tinytext NOT NULL,
  `name_fr` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idea_types_sorting_order` (`sorting_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `fk_comics` int UNSIGNED NOT NULL,
  `image_order` int UNSIGNED NOT NULL,
  `upload_date` date NOT NULL,
  `is_a_preview` tinyint(1) NOT NULL,
  `is_bonus_panel` tinyint(1) NOT NULL,
  `is_remake` tinyint(1) NOT NULL,
  `is_full_version` tinyint(1) NOT NULL,
  `is_a_template` tinyint(1) NOT NULL,
  `is_an_emoji` tinyint(1) NOT NULL,
  `is_a_speech_bubble` tinyint(1) NOT NULL,
  `is_nsfw` tinyint(1) NOT NULL,
  `language` tinytext NOT NULL,
  `transcript` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_comics` (`fk_comics`),
  KEY `images_image_order` (`image_order`),
  KEY `images_is_a_preview` (`is_a_preview`),
  KEY `images_is_a_template` (`is_a_template`),
  KEY `images_is_nsfw` (`is_nsfw`),
  KEY `images_language` (`language`(10)),
  KEY `images_is_full_version` (`is_full_version`),
  KEY `images_is_remake` (`is_remake`),
  KEY `images_upload_date` (`upload_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `tasks` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `latest_query_id` int UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sorting_order` int UNSIGNED NOT NULL,
  `name` tinytext NOT NULL,
  `banner_en` tinytext NOT NULL,
  `banner_fr` tinytext NOT NULL,
  `title_en` tinytext NOT NULL,
  `title_fr` tinytext NOT NULL,
  `description_en` text NOT NULL,
  `description_fr` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tags_name` (`name`(20))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;
