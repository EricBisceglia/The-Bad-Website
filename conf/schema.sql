--
-- Setup
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `thebadwebsite`
--

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
  KEY `comics_view_count` (`view_count`),
  KEY `comics_upload_date` (`upload_date`)
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
  `is_old_version` tinyint(1) NOT NULL,
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
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_quote_media` int UNSIGNED NOT NULL,
  `fk_quote_authors` int UNSIGNED NOT NULL,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorting_order` int UNSIGNED NOT NULL,
  `origin` tinyint NOT NULL,
  `source_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_fr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quote_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quote_fr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quotes_fk_quote_media` (`fk_quote_media`),
  KEY `quotes_fk_quote_authors` (`fk_quote_authors`),
  KEY `quotes_sorting_order` (`sorting_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_authors`
--

DROP TABLE IF EXISTS `quote_authors`;
CREATE TABLE IF NOT EXISTS `quote_authors` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_birth` smallint UNSIGNED NOT NULL,
  `year_death` smallint UNSIGNED NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_fr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_media`
--

DROP TABLE IF EXISTS `quote_media`;
CREATE TABLE IF NOT EXISTS `quote_media` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_quote_media_types` int UNSIGNED NOT NULL,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_type` tinyint NOT NULL,
  `name_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_published` smallint UNSIGNED NOT NULL,
  `source_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_fr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_media_media_type` (`media_type`),
  KEY `quote_media_year_published` (`year_published`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_media_authors`
--

DROP TABLE IF EXISTS `quote_media_authors`;
CREATE TABLE IF NOT EXISTS `quote_media_authors` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_quote_media` int UNSIGNED NOT NULL,
  `fk_quote_authors` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_media_authors_fk_quote_media` (`fk_quote_media`),
  KEY `quote_media_authors_fk_quote_authors` (`fk_quote_authors`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_media_types`
--

DROP TABLE IF EXISTS `quote_media_types`;
CREATE TABLE IF NOT EXISTS `quote_media_types` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sorting_order` int UNSIGNED NOT NULL,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_media_types_sorting_order` (`sorting_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_tags`
--

DROP TABLE IF EXISTS `quote_tags`;
CREATE TABLE IF NOT EXISTS `quote_tags` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sorting_order` int UNSIGNED NOT NULL,
  `slug` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_fr` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_tags_sorting_order` (`sorting_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quote_tag_links`
--

DROP TABLE IF EXISTS `quote_tag_links`;
CREATE TABLE IF NOT EXISTS `quote_tag_links` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_quote_tags` int UNSIGNED NOT NULL,
  `fk_quotes` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quote_tag_links_fk_quote_tags` (`fk_quote_tags`),
  KEY `quote_tag_links_fk_quotes` (`fk_quotes`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
