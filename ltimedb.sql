-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: ltime
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.23.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `binshops_categories`
--

DROP TABLE IF EXISTS `binshops_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_by` int unsigned DEFAULT NULL COMMENT 'user id',
  `parent_id` int DEFAULT NULL,
  `lft` int DEFAULT NULL,
  `rgt` int DEFAULT NULL,
  `depth` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binshops_categories_created_by_index` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_categories`
--

LOCK TABLES `binshops_categories` WRITE;
/*!40000 ALTER TABLE `binshops_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `binshops_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_category_translations`
--

DROP TABLE IF EXISTS `binshops_category_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_category_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `lang_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `binshops_category_translations_slug_unique` (`slug`),
  KEY `binshops_category_translations_lang_id_index` (`lang_id`),
  CONSTRAINT `binshops_category_translations_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `binshops_languages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_category_translations`
--

LOCK TABLES `binshops_category_translations` WRITE;
/*!40000 ALTER TABLE `binshops_category_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `binshops_category_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_comments`
--

DROP TABLE IF EXISTS `binshops_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL COMMENT 'if user was logged in',
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'if enabled in the config file',
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'if not logged in',
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'the comment body',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `author_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binshops_comments_post_id_index` (`post_id`),
  KEY `binshops_comments_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_comments`
--

LOCK TABLES `binshops_comments` WRITE;
/*!40000 ALTER TABLE `binshops_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `binshops_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_configurations`
--

DROP TABLE IF EXISTS `binshops_configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_configurations` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_configurations`
--

LOCK TABLES `binshops_configurations` WRITE;
/*!40000 ALTER TABLE `binshops_configurations` DISABLE KEYS */;
INSERT INTO `binshops_configurations` VALUES ('DEFAULT_LANGUAGE_LOCALE','en','2023-06-20 17:23:05','2023-06-20 17:23:05'),('INITIAL_SETUP','1','2023-06-20 17:23:05','2023-06-20 17:23:05');
/*!40000 ALTER TABLE `binshops_configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_languages`
--

DROP TABLE IF EXISTS `binshops_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `rtl` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `binshops_languages_name_unique` (`name`),
  UNIQUE KEY `binshops_languages_locale_unique` (`locale`),
  UNIQUE KEY `binshops_languages_iso_code_unique` (`iso_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_languages`
--

LOCK TABLES `binshops_languages` WRITE;
/*!40000 ALTER TABLE `binshops_languages` DISABLE KEYS */;
INSERT INTO `binshops_languages` VALUES (1,'English','en','en','YYYY/MM/DD',1,0,'2023-06-20 17:23:05','2023-06-20 17:23:05');
/*!40000 ALTER TABLE `binshops_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_post_categories`
--

DROP TABLE IF EXISTS `binshops_post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_post_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned NOT NULL,
  `category_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `binshops_post_categories_post_id_index` (`post_id`),
  KEY `binshops_post_categories_category_id_index` (`category_id`),
  CONSTRAINT `binshops_post_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `binshops_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `binshops_post_categories_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `binshops_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_post_categories`
--

LOCK TABLES `binshops_post_categories` WRITE;
/*!40000 ALTER TABLE `binshops_post_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `binshops_post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_post_translations`
--

DROP TABLE IF EXISTS `binshops_post_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_post_translations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int unsigned DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'New blog post',
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_body` mediumtext COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `use_view_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'should refer to a blade file in /views/',
  `image_large` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_medium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binshops_post_translations_lang_id_index` (`lang_id`),
  CONSTRAINT `binshops_post_translations_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `binshops_languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_post_translations`
--

LOCK TABLES `binshops_post_translations` WRITE;
/*!40000 ALTER TABLE `binshops_post_translations` DISABLE KEYS */;
INSERT INTO `binshops_post_translations` VALUES (1,1,'the-future-of-sustainable-design-in-real-estate','The Future of Sustainable Design in Real Estate',NULL,NULL,NULL,'<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sustainable design is becoming increasingly important in the real estate industry, as developers and property owners seek to reduce environmental impact and improve the health and wellness of building occupants. In this article, we&#39;ll explore the future of sustainable design in real estate and the benefits of incorporating green features into buildings.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sustainable design in real estate involves incorporating environmentally friendly features and practices into the design, construction, and operation of buildings. This can include features such as energy-efficient lighting and HVAC systems, solar panels, green roofs, and rainwater harvesting systems.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">One of the primary benefits of sustainable design is the reduction of environmental impact. Green buildings use less energy and water, produce less waste, and emit fewer greenhouse gases than traditional buildings. This not only helps to mitigate climate change, but also reduces operating costs for property owners and tenants.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Another benefit of sustainable design is the positive impact on human health and wellness. Green buildings are designed to optimize indoor air quality, natural light, and temperature control, which can improve productivity and reduce absenteeism among building occupants. Additionally, green spaces such as rooftop gardens and indoor plantings can improve mental health and well-being.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The future of sustainable design in real estate is promising. As technology continues to advance, we can expect to see even more innovative and cost-effective solutions for green building design and construction. In addition, sustainable design is becoming more mainstream as consumers and tenants increasingly demand environmentally friendly features in the buildings they occupy.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sustainable design is a growing trend in the real estate industry, as developers and property owners seek to reduce environmental impact and improve the health and wellness of building occupants. By incorporating green features into buildings, property owners can reduce operating costs, improve indoor air quality, and provide a healthier and more productive environment for tenants. As sustainable design continues to evolve and become more mainstream, we can expect to see even more innovative solutions for green building design and construction in the future.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>',NULL,NULL,'the-future-of-sustainable-design-in-real-estate-tlgzp-1000x700.jpg','the-future-of-sustainable-design-in-real-estate-fimy6-600x400.jpg','the-future-of-sustainable-design-in-real-estate-9mftn-150x150.jpg',1,'2023-06-20 17:34:10','2023-06-20 17:35:02'),(2,2,'the-benefits-of-investing-in-commercial-real-estate','The Benefits of Investing in Commercial Real Estate',NULL,NULL,NULL,'<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Investing in commercial real estate is a great way to diversify your portfolio and generate long-term passive income. Unlike residential real estate, commercial properties are primarily used for business purposes and can provide consistent rental income from tenants who are often on long-term leases. In this article, we&#39;ll explore the benefits of investing in commercial real estate and provide tips for identifying profitable opportunities.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The potential benefits of investing in commercial real estate are numerous. For one, commercial properties typically have higher rental income potential compared to residential properties. This is because commercial tenants often sign longer leases, meaning landlords can count on consistent rental income for extended periods of time. Additionally, commercial real estate can appreciate in value over time, providing investors with potential capital gains.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Another advantage of commercial real estate investing is the potential for tax benefits. Property owners can take advantage of deductions for mortgage interest, property taxes, and depreciation, which can help reduce their tax liability. Additionally, commercial real estate investors can use a 1031 exchange to defer capital gains taxes when selling a property and reinvesting the proceeds into another property.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">To identify profitable commercial real estate investments, investors should conduct thorough market research and identify growing or underserved areas with high demand for commercial space. They should also consider factors such as the property&#39;s location, the condition of the building, and the tenant&#39;s creditworthiness. It&#39;s also important to work with an experienced commercial real estate broker who can help identify potential investment opportunities and navigate the buying process.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Investing in commercial real estate can be a lucrative way to generate passive income and build wealth over time. By understanding the potential benefits and conducting thorough research, investors can identify profitable opportunities and make informed investment decisions.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>',NULL,NULL,'the-benefits-of-investing-in-commercial-real-estate-xda7l-1000x700.jpg','the-benefits-of-investing-in-commercial-real-estate-yefnq-600x400.jpg','the-benefits-of-investing-in-commercial-real-estate-o8z12-150x150.jpg',1,'2023-06-20 17:35:58','2023-06-20 17:35:58'),(3,3,'how-to-choose-the-right-contractor-for-your-construction-project','How to Choose the Right Contractor for Your Construction Project',NULL,NULL,NULL,'<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Choosing the right contractor is critical to the success of any construction project. A reliable, experienced contractor can help ensure that the project is completed on time, within budget, and to the highest quality standards. In this article, we&#39;ll provide tips for property owners and developers on how to select the right contractor for their construction projects.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">There are several factors that property owners and developers should consider when selecting a contractor for their construction project. First, they should evaluate the contractor&#39;s experience and track record, including the types of projects they have completed in the past and their level of expertise in the specific type of construction being planned. Checking references and reading online reviews can also help provide insight into a contractor&#39;s quality of work.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Another important factor to consider is the contractor&#39;s reputation within the industry. Property owners and developers should look for a contractor who is respected by their peers and has a track record of delivering projects on time and within budget. They should also look for a contractor who communicates well and is transparent about their pricing, timeline, and progress.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">It&#39;s also important to work with a contractor who is licensed, insured, and bonded. This ensures that the contractor is qualified to perform the work and provides protection against liability and property damage. Property owners and developers should also have a clear, detailed contract that outlines the scope of work, timeline, and payment terms.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Choosing the right contractor is critical to the success of any construction project. By considering factors such as experience, reputation, licensing, and communication skills, property owners and developers can find a reliable, trustworthy contractor who can deliver a high-quality construction project on time and within budget.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>',NULL,NULL,'how-to-choose-the-right-contractor-for-your-construction-project-nvpw6-1000x700.jpg','how-to-choose-the-right-contractor-for-your-construction-project-twx2g-600x400.jpg','how-to-choose-the-right-contractor-for-your-construction-project-2ppiz-150x150.jpg',1,'2023-06-20 17:36:38','2023-06-20 17:36:38');
/*!40000 ALTER TABLE `binshops_post_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_posts`
--

DROP TABLE IF EXISTS `binshops_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned DEFAULT NULL,
  `posted_at` datetime DEFAULT NULL COMMENT 'Public posted at time, if this is in future then it wont appear yet',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binshops_posts_user_id_index` (`user_id`),
  KEY `binshops_posts_posted_at_index` (`posted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_posts`
--

LOCK TABLES `binshops_posts` WRITE;
/*!40000 ALTER TABLE `binshops_posts` DISABLE KEYS */;
INSERT INTO `binshops_posts` VALUES (1,1,'2023-06-20 17:34:10',1,'2023-06-20 17:34:10','2023-06-20 17:34:10'),(2,1,'2023-06-20 17:35:58',1,'2023-06-20 17:35:58','2023-06-20 17:35:58'),(3,1,'2023-06-20 17:36:38',1,'2023-06-20 17:36:38','2023-06-20 17:36:38');
/*!40000 ALTER TABLE `binshops_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `binshops_uploaded_photos`
--

DROP TABLE IF EXISTS `binshops_uploaded_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `binshops_uploaded_photos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uploaded_images` text COLLATE utf8mb4_unicode_ci,
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unknown',
  `uploader_id` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `binshops_uploaded_photos_uploader_id_index` (`uploader_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `binshops_uploaded_photos`
--

LOCK TABLES `binshops_uploaded_photos` WRITE;
/*!40000 ALTER TABLE `binshops_uploaded_photos` DISABLE KEYS */;
INSERT INTO `binshops_uploaded_photos` VALUES (1,'{\"image_large\":{\"filename\":\"the-future-of-sustainable-design-in-real-estate-tlgzp-1000x700.jpg\",\"w\":1000,\"h\":700},\"image_medium\":{\"filename\":\"the-future-of-sustainable-design-in-real-estate-fimy6-600x400.jpg\",\"w\":600,\"h\":400},\"image_thumbnail\":{\"filename\":\"the-future-of-sustainable-design-in-real-estate-9mftn-150x150.jpg\",\"w\":150,\"h\":150}}',NULL,'BlogFeaturedImage',NULL,'2023-06-20 17:34:10','2023-06-20 17:34:10'),(2,'{\"image_large\":{\"filename\":\"the-benefits-of-investing-in-commercial-real-estate-xda7l-1000x700.jpg\",\"w\":1000,\"h\":700},\"image_medium\":{\"filename\":\"the-benefits-of-investing-in-commercial-real-estate-yefnq-600x400.jpg\",\"w\":600,\"h\":400},\"image_thumbnail\":{\"filename\":\"the-benefits-of-investing-in-commercial-real-estate-o8z12-150x150.jpg\",\"w\":150,\"h\":150}}',NULL,'BlogFeaturedImage',NULL,'2023-06-20 17:35:58','2023-06-20 17:35:58'),(3,'{\"image_large\":{\"filename\":\"how-to-choose-the-right-contractor-for-your-construction-project-nvpw6-1000x700.jpg\",\"w\":1000,\"h\":700},\"image_medium\":{\"filename\":\"how-to-choose-the-right-contractor-for-your-construction-project-twx2g-600x400.jpg\",\"w\":600,\"h\":400},\"image_thumbnail\":{\"filename\":\"how-to-choose-the-right-contractor-for-your-construction-project-2ppiz-150x150.jpg\",\"w\":150,\"h\":150}}',NULL,'BlogFeaturedImage',NULL,'2023-06-20 17:36:38','2023-06-20 17:36:38');
/*!40000 ALTER TABLE `binshops_uploaded_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_status` tinyint(1) DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_replied` date DEFAULT NULL,
  `reply_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'2024-04-28 02:29:23','2024-04-28 02:29:23','message',0,'gugesi@mailinator.com','Price Mccoy','+1 (647) 642-2265','Iste cumque harum si','Praesentium architec',NULL,NULL,NULL);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deals` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `beds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `baths` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `squareft` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `featured-image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover-image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deals`
--

LOCK TABLES `deals` WRITE;
/*!40000 ALTER TABLE `deals` DISABLE KEYS */;
/*!40000 ALTER TABLE `deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laravel_fulltext`
--

DROP TABLE IF EXISTS `laravel_fulltext`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `laravel_fulltext` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `indexable_id` int NOT NULL,
  `indexable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indexed_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `indexed_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `laravel_fulltext_indexable_type_indexable_id_unique` (`indexable_type`,`indexable_id`),
  FULLTEXT KEY `fulltext_title` (`indexed_title`),
  FULLTEXT KEY `fulltext_title_content` (`indexed_title`,`indexed_content`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laravel_fulltext`
--

LOCK TABLES `laravel_fulltext` WRITE;
/*!40000 ALTER TABLE `laravel_fulltext` DISABLE KEYS */;
INSERT INTO `laravel_fulltext` VALUES (1,1,'BinshopsBlog\\Models\\BinshopsPostTranslation','The Future of Sustainable Design in Real Estate','<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sustainable design is becoming increasingly important in the real estate industry, as developers and property owners seek to reduce environmental impact and improve the health and wellness of building occupants. In this article, we&#39;ll explore the future of sustainable design in real estate and the benefits of incorporating green features into buildings.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sustainable design in real estate involves incorporating environmentally friendly features and practices into the design, construction, and operation of buildings. This can include features such as energy-efficient lighting and HVAC systems, solar panels, green roofs, and rainwater harvesting systems.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">One of the primary benefits of sustainable design is the reduction of environmental impact. Green buildings use less energy and water, produce less waste, and emit fewer greenhouse gases than traditional buildings. This not only helps to mitigate climate change, but also reduces operating costs for property owners and tenants.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Another benefit of sustainable design is the positive impact on human health and wellness. Green buildings are designed to optimize indoor air quality, natural light, and temperature control, which can improve productivity and reduce absenteeism among building occupants. Additionally, green spaces such as rooftop gardens and indoor plantings can improve mental health and well-being.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The future of sustainable design in real estate is promising. As technology continues to advance, we can expect to see even more innovative and cost-effective solutions for green building design and construction. In addition, sustainable design is becoming more mainstream as consumers and tenants increasingly demand environmentally friendly features in the buildings they occupy.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sustainable design is a growing trend in the real estate industry, as developers and property owners seek to reduce environmental impact and improve the health and wellness of building occupants. By incorporating green features into buildings, property owners can reduce operating costs, improve indoor air quality, and provide a healthier and more productive environment for tenants. As sustainable design continues to evolve and become more mainstream, we can expect to see even more innovative solutions for green building design and construction in the future.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>','2023-06-20 17:34:10','2023-06-20 17:35:02'),(2,2,'BinshopsBlog\\Models\\BinshopsPostTranslation','The Benefits of Investing in Commercial Real Estate','<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Investing in commercial real estate is a great way to diversify your portfolio and generate long-term passive income. Unlike residential real estate, commercial properties are primarily used for business purposes and can provide consistent rental income from tenants who are often on long-term leases. In this article, we&#39;ll explore the benefits of investing in commercial real estate and provide tips for identifying profitable opportunities.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The potential benefits of investing in commercial real estate are numerous. For one, commercial properties typically have higher rental income potential compared to residential properties. This is because commercial tenants often sign longer leases, meaning landlords can count on consistent rental income for extended periods of time. Additionally, commercial real estate can appreciate in value over time, providing investors with potential capital gains.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Another advantage of commercial real estate investing is the potential for tax benefits. Property owners can take advantage of deductions for mortgage interest, property taxes, and depreciation, which can help reduce their tax liability. Additionally, commercial real estate investors can use a 1031 exchange to defer capital gains taxes when selling a property and reinvesting the proceeds into another property.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">To identify profitable commercial real estate investments, investors should conduct thorough market research and identify growing or underserved areas with high demand for commercial space. They should also consider factors such as the property&#39;s location, the condition of the building, and the tenant&#39;s creditworthiness. It&#39;s also important to work with an experienced commercial real estate broker who can help identify potential investment opportunities and navigate the buying process.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Investing in commercial real estate can be a lucrative way to generate passive income and build wealth over time. By understanding the potential benefits and conducting thorough research, investors can identify profitable opportunities and make informed investment decisions.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>','2023-06-20 17:35:58','2023-06-20 17:35:58'),(3,3,'BinshopsBlog\\Models\\BinshopsPostTranslation','How to Choose the Right Contractor for Your Construction Project','<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Choosing the right contractor is critical to the success of any construction project. A reliable, experienced contractor can help ensure that the project is completed on time, within budget, and to the highest quality standards. In this article, we&#39;ll provide tips for property owners and developers on how to select the right contractor for their construction projects.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">There are several factors that property owners and developers should consider when selecting a contractor for their construction project. First, they should evaluate the contractor&#39;s experience and track record, including the types of projects they have completed in the past and their level of expertise in the specific type of construction being planned. Checking references and reading online reviews can also help provide insight into a contractor&#39;s quality of work.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Another important factor to consider is the contractor&#39;s reputation within the industry. Property owners and developers should look for a contractor who is respected by their peers and has a track record of delivering projects on time and within budget. They should also look for a contractor who communicates well and is transparent about their pricing, timeline, and progress.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">It&#39;s also important to work with a contractor who is licensed, insured, and bonded. This ensures that the contractor is qualified to perform the work and provides protection against liability and property damage. Property owners and developers should also have a clear, detailed contract that outlines the scope of work, timeline, and payment terms.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:&quot;Calibri&quot;,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Choosing the right contractor is critical to the success of any construction project. By considering factors such as experience, reputation, licensing, and communication skills, property owners and developers can find a reliable, trustworthy contractor who can deliver a high-quality construction project on time and within budget.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>','2023-06-20 17:36:38','2023-06-20 17:36:38');
/*!40000 ALTER TABLE `laravel_fulltext` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES ('Dawa',NULL,'5.8656','0.2914','Ghana','Greater Accra','active',2,'2024-03-11 17:54:04','2024-03-11 17:54:04','Dawa','Africa',NULL),('Agortor',NULL,NULL,NULL,'Ghana','Greater Accra','active',3,'2024-03-11 17:55:28','2024-03-11 17:55:28','Agortor','Africa',NULL),('Prampram',NULL,'0.0667','5.7333','Ghana','Greater Accra Region','active',5,'2024-08-09 15:29:16','2024-08-09 15:29:16','Prampram','Africa',NULL),('Tema',NULL,'0.0302','5.7348','Ghana','Greater Accra Region','active',6,'2024-08-26 15:29:11','2024-08-26 15:29:11','Tema','Africa',NULL);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2016_11_04_152913_create_laravel_fulltext_table',1),(5,'2019_08_19_000000_create_failed_jobs_table',1),(6,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2020_10_16_004241_create_binshops_languages_table',1),(8,'2020_10_16_005400_create_binshops_categories_table',1),(9,'2020_10_16_005425_create_binshops_category_translations_table',1),(10,'2020_10_16_010039_create_binshops_posts_table',1),(11,'2020_10_16_010049_create_binshops_post_translations_table',1),(12,'2020_10_16_121230_create_binshops_comments_table',1),(13,'2020_10_16_121728_create_binshops_uploaded_photos_table',1),(14,'2020_10_22_132005_create_binshops_configurations_table',1),(15,'2023_04_13_051650_create_locations_table',1),(16,'2023_04_13_110211_create_properties_table',1),(17,'2023_04_17_190710_create_sessions_table',1),(18,'2023_04_18_044331_create_deals_table',1),(19,'2023_04_18_121941_create_testimonials_table',1),(20,'2023_05_08_232239_add_referral_to_users_table',1),(21,'2023_05_11_040657_add_user_role_to_users_table',1),(22,'2023_05_21_065059_add_fields_to_properties_table',1),(23,'2023_05_21_071457_rename_fields_in_properties_table',1),(24,'2023_05_21_105921_add_more_rows_to_properties_table',1),(25,'2023_05_21_113725_create_partners_table',1),(26,'2023_05_21_114315_add_fields_to_testimonials_table',1),(27,'2023_05_23_232153_create_contacts_table',1),(28,'2023_05_30_195136_create_settings_table',1),(29,'2023_07_26_132928_add_rating_field_to_testimonials_table',2),(30,'2024_02_01_180216_add_city_field_to_locations_table',3),(31,'2024_04_26_192433_update_column_in_properties_table',4),(32,'2024_04_27_124040_add_short_description_field_to_properties_table',5),(33,'2024_04_28_082312_add_slug_to_properties_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `properties` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `beds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `baths` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `squareft` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_built` date DEFAULT NULL,
  `rooms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (2,'2024-04-26 19:35:53','2024-08-29 11:13:07',1,'Enyo Gardens','Welcome to an exceptional place to build your dream home.\nEnyo Gardens is a fully Titled, Registered and Litigation-free land in a serene and upcoming area of Dawa. As a trusted partner in your property investment journey, L-Time Properties Ltd. is committed to following all legal processes and requirements, ensuring your investment is secure and hassle-free. Lands at Enyo Gardens are also very affordable with flexible payment terms. This prime location offers the perfect balance of tranquillity and accessibility, providing an ideal setting for your dream home or investment property. It is projected to accommodate a state of the art recreational centre, a well-equipped school and hospital, a religious centre, a police station and an all stocked shopping mall. \n\nOur expert team is always available to guide you through every step, ensuring a smooth and stress-free experience. We know the local market and are dedicated to helping you find the ideal property.”\n\nInvest in your future today and experience the peace of mind that comes with owning a property in this promising and rapidly developing area. Don\'t miss this fantastic opportunity to be part of the Enyo Gardens community.',NULL,'','','',40000.00,'properties/MK7ilRvxhRnIKbRATK6ksWwK2SXhrKGNTX9kakkl.jpg','land','cover_photos/2trWzXrKv4DlimQu242iQlRxFuPgw9dItmpNAQxh.jpg',NULL,'Dawa','',NULL,'','',NULL),(9,'2024-08-28 14:08:09','2024-08-29 11:13:38',1,'Peace Palace','Welcome to an exceptional place to build your dream home.\nEliz Court is a fully Titled, Registered and Litigation-free land in a serene and upcoming area of Dawa. As a trusted partner in your property investment journey, L-Time Properties Ltd. is committed to following all legal processes and requirements, ensuring your investment is secure and hassle-free. Lands at Eliz Court are also very affordable with flexible payment terms. This prime location offers the perfect balance of tranquillity and accessibility, providing an ideal setting for your dream home or investment property. It is projected to accommodate a state of the art recreational centre, a well-equipped school among others.\n\nOur expert team is always available to guide you through every step, ensuring a smooth and stress-free experience. We know the local market and are dedicated to helping you find the ideal property.”\n\nInvest in your future today and experience the peace of mind that comes with owning a property in this promising and rapidly developing area. Don\'t miss this fantastic opportunity to be part of the Eliz Court community.','Welcome to Peace Palace, an exquisite development by L-Time Properties, offering titled and litigation-free lands in the tranquil neighborhood of Tsopoli, Agortor. With our commitment to following all legal processes and requirements...','','','',28000.00,'properties/cDhtDQSMqzwJItpzcsDY6aIsYfZv2hMI8CYoy474.jpg','land','cover_photos/hRpjGftnI1LOzV4EP4MICSRnpjlk3jXfUgzjWVfk.jpg',NULL,'Agortor','',NULL,'','',NULL),(10,'2024-08-28 14:11:32','2024-08-29 11:14:02',1,'Life City - Prampram','Welcome to an exceptional place to build your dream home.\nPeace Palace is a fully Titled, Registered and Litigation-free land in a serene and upcoming area of Dawa. As a trusted partner in your property investment journey, L-Time Properties Ltd. is committed to following all legal processes and requirements, ensuring your investment is secure and hassle-free. Lands at Peace Palace are also very affordable with flexible payment terms. This prime location offers the perfect balance of tranquillity and accessibility, providing an ideal setting for your dream home or investment property. It is projected to accommodate a state of the art recreational centre, a well-equipped school among others.\n\nOur expert team is always available to guide you through every step, ensuring a smooth and stress-free experience. We know the local market and are dedicated to helping you find the ideal property.”\n\nInvest in your future today and experience the peace of mind that comes with owning a property in this promising and rapidly developing area. Don\'t miss this fantastic opportunity to be part of the Peace Palace community.','Discover Life City, an exceptional investment opportunity by L-Time Properties, offering titled and litigation-free lands in the rapidly developing area of Prampram, Greater Accra Region. Our commitment to following all legal process...','','','',80000.00,'properties/UOeSx1c7bIfN9jN9bZWofDg3fh7qWs2ZHw9ysWJU.jpg','land','cover_photos/7dVBOpwNvrkDaKZBTcbxhJ0wrJBNfAUw3pwJcc2i.jpg',NULL,'Prampram','',NULL,'','',NULL);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'2023-07-26 23:15:55','2023-07-26 23:15:55','“Working with L-Time Properties was a great experience. They were responsive, knowledgeable, and easy to work with, and they helped us find the perfect property for our needs.”',NULL,'Johnson Sebire','Principal Consultant','5','Manifest Multimedia');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affiliate_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_affiliate_id_unique` (`affiliate_id`),
  KEY `users_referred_by_index` (`referred_by`)
) ENGINE=InnoDB AUTO_INCREMENT=378 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Johnson Azumah Sebire','johnson@manifestghana.com',NULL,'$2y$10$9MDKGuTjbu8HJvX8.hSlHOWBxJ2VowYKm5VfRWbyb3aiaCnwTUXcu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-20 17:22:26','2024-04-28 02:47:34','System','GEOP4','admin'),(2,'Emmanuel Ray','apostleraylive@gmail.com',NULL,'$2y$10$wbsIpTbdEwP0PoPNjw10A.V0u.QdblW.Zu1yae1uIy5Km7d60CEqG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-20 17:22:26','2023-06-20 17:22:26','System','OLwE3','admin'),(3,'Francis Agbeko','francis@ltimepropertiesltd.com',NULL,'$2y$10$oEygpFy210t2ZRZwMvya5uabIJUd7iV0gZU0XMTbsqzOivC8VXUxG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-06-20 17:22:26','2023-06-20 17:22:26','System','u8b0N','admin'),(4,'Charlestut','jea.npau.li.ono.de.w.i.t.t@gmail.com',NULL,'$2y$10$9iumOpwsryhzJfvyyiQCBu7Y4oXhrboYMhoJEalFLbe59jaZu4p8q',NULL,NULL,NULL,NULL,NULL,NULL,'2023-07-22 20:17:14','2023-07-22 20:17:14','System','QRmkD','affiliate'),(5,'Lucapdreri','robertomoralez@zohomail.eu',NULL,'$2y$10$76CzpFI/PBh7U6VnOsaxR.7SW9c0aQpN/eW9r1fbxytMZY9nUNZUm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-08-07 17:35:51','2023-08-07 17:35:51','System','Zu7JN','affiliate'),(6,'Felixunorp','bak96shella@hotmail.com',NULL,'$2y$10$lE2YR9ybSWfROI7e5DSZGe2Fh7Wl/al3JafSnRaAcKS3SsQ7AB7uW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-01 07:38:15','2023-09-01 07:38:15','System','8uZMG','affiliate'),(7,'JarrodCaf','tfpkdb@top-21.online',NULL,'$2y$10$ACdysAVVvPUUk3lY/wGONeGUEVplI5rszEq7iGQdi4m5DZ/OL2QBy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-23 14:49:52','2023-09-23 14:49:52','System','A77LQ','affiliate'),(8,'WayneShile','dzhuvp@top-21.online',NULL,'$2y$10$PQu3B9T0sn62PpHp5KOhGuhc0nDVxMgpDxjfpjBj0JABVHOQo5c/q',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-23 06:34:19','2023-10-23 06:34:19','System','3GSEt','affiliate'),(9,'Igorihb','shk.u.t.ko.v.igo.recze.k.b.e.st@gmail.com',NULL,'$2y$10$m3d5G15.TrqwX.wmeM7/1uPwRZ5LZBXio3kQBYKXsNOWmEWUJiVSq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-23 19:41:51','2023-10-23 19:41:51','System','oy5UG','affiliate'),(10,'dCSXubfIsPCa','sNhvXM.qwbmbjw@gemination.hair',NULL,'$2y$10$.LeGEC6lmcfNv1LlnpHTzucyTUkWAg01jpln/k5AQmwu17f9W68pK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-26 10:28:01','2023-10-26 10:28:01','System','oWw2d','affiliate'),(11,'Svetlrkm','i.r.c.z.e.nkosve.t.la.n.as2.0.3.0@gmail.com',NULL,'$2y$10$fuET4A3.M7Tjqt9DCouh0ONKwsmxQ5NuWIQQHMD2gLm/a6cPcRIsS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-28 10:29:11','2023-10-28 10:29:11','System','mn49X','affiliate'),(12,'Sergrpz','s.tri.uo.k.o.f.fsti.f.fa.lmo.s.t@gmail.com',NULL,'$2y$10$2.qZYtjIi8iWKsGUA2D94ebTrPwqWqTfBBZj9qlLcFHdK0VNmve1W',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 09:14:27','2023-10-29 09:14:27','System','smoib','affiliate'),(13,'Svetlyum','irc.z.enkosv.e.t.lan.as.2.03.0@gmail.com',NULL,'$2y$10$P2BK9RngWJXvp5kH4mjrgO2ExSUYg1R8SS042nzpA/RTxacyz8Af2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 09:20:33','2023-10-29 09:20:33','System','IaN5S','affiliate'),(14,'Igorcfb','sh.kut.k.ovigo.re.c.z.e.k.be.st@gmail.com',NULL,'$2y$10$4elgeOD3VJ1YIAMnUJEkR.TkBrYyyxSRVH0Dq0naM4iCeRrHnbqvm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-29 09:21:05','2023-10-29 09:21:05','System','3OXpB','affiliate'),(15,'Sergjmf','stri.u.o.kof.f.st.i.f.fa.lm.ost@gmail.com',NULL,'$2y$10$wkDSRVSYvQHd7t4ytdnE5umdLM5xhQ/G0JnevvPsUK6huTyhG9i8O',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 02:36:36','2023-10-30 02:36:36','System','7kjo4','affiliate'),(16,'Igorlih','shkutk.ovig.or.ecz.e.k.b.est@gmail.com',NULL,'$2y$10$biz.vJUOvTkmFNcZXM/VNOBsEEE3ZG2kOiwH7PDuuLsaVV84QJbZK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 02:54:19','2023-10-30 02:54:19','System','DKKwU','affiliate'),(17,'Svetlhjq','i.rcz.e.n.k.os.ve.t.l.a.na.s.20.30@gmail.com',NULL,'$2y$10$sL7bChzfrtxppnqAYHLxXep6juIB7XFyqmIxzTtmUKrJLvwDAsJZS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 03:05:28','2023-10-30 03:05:28','System','PozuT','affiliate'),(18,'Sergwjq','st.r.iuok.o.f.f.st.if.fa.lmo.s.t@gmail.com',NULL,'$2y$10$8HH.tsuYdA7wr9HEUaNOb.CWj8WcgMh7RdIC779zc4Ktpd6AOUOI.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 10:24:43','2023-10-30 10:24:43','System','5Wanq','affiliate'),(19,'Igoremf','shkut.ko.vig.o.re.cz.ekb.est@gmail.com',NULL,'$2y$10$9ojkrTan9lfhxUvMpKQIKuKCp2od/pFLRk8OO0HkLG6wQx6leA3/K',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 11:01:26','2023-10-30 11:01:26','System','1hFT7','affiliate'),(20,'Svetltzj','i.r.cz.e.nk.o.sve.tlan.a.s2.030@gmail.com',NULL,'$2y$10$OXcnCzEgd/qGsFRKNT8Nz.g.mRebroxmULWIs3wiECwlgme3DFeQ.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-30 11:48:31','2023-10-30 11:48:31','System','WOGi8','affiliate'),(21,'Sergzen','s.t.r.iu.ok.o.ffstif.fa.lm.o.s.t@gmail.com',NULL,'$2y$10$KOJSrBoZsTZJpCb.SttwjuOf5fllnnabYVENA9/P42Yei4ibS/q4W',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-31 03:04:49','2023-10-31 03:04:49','System','CJG1c','affiliate'),(22,'Svetldgv','ircz.enk.o.s.v.etl.an.as.2.030@gmail.com',NULL,'$2y$10$7x1qKKrUMN1eMh5DTjuDPO/3tDuRtbBw66sCUfWA9B/pajiF1BCT2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-31 03:22:49','2023-10-31 03:22:49','System','weUBu','affiliate'),(23,'Igoriee','s.hku.tko.v.i.gor.e.cz.ekb.e.st@gmail.com',NULL,'$2y$10$Nlic9Mf9AWOIsq31v4Vj0.S0N6yiB9eLEdf03IMAtOd4g6DBOplMe',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-31 03:46:10','2023-10-31 03:46:10','System','tRtlT','affiliate'),(24,'Svetlhgl','i.rc.z.e.n.k.os.v.e.tla.n.a.s.2030@gmail.com',NULL,'$2y$10$f4qmuUNPIlf1LKXrfHmb5.yhRrk.Km3xCIFId1df3Y2DuxIJ.iYwa',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-31 17:04:49','2023-10-31 17:04:49','System','fQ3vb','affiliate'),(25,'Sergaee','s.t.riu.o.k.offsti.ff.a.lm.ost@gmail.com',NULL,'$2y$10$zV99DWqOYTfS60R6ebSJ/.eDE8t0LBglHqoclLDUgAlgxd949/bfa',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-31 17:51:13','2023-10-31 17:51:13','System','SfeYZ','affiliate'),(26,'Igornya','shk.utkovi.gor.ecz.ekbe.st@gmail.com',NULL,'$2y$10$R0BHpQXKF2qIHVNO8.QoyuzGphL9zEbYSTHGt6y53bE8EhKkKnhEK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-10-31 18:10:30','2023-10-31 18:10:30','System','soYXu','affiliate'),(27,'Svetlsvc','irc.ze.n.k.o.s.v.e.t.l.anas2.0.30@gmail.com',NULL,'$2y$10$roS4Rr/wyREn6cdL2cSw3uOi.elOFyfaS5a/jpboHwUHf0NhyOh12',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-01 02:44:06','2023-11-01 02:44:06','System','U1uRG','affiliate'),(28,'Sergpfr','s.t.riu.o.ko.ffst.i.ffalmos.t@gmail.com',NULL,'$2y$10$SMjPFMBbKs9u9dEUOb3X6O0RlP1m24Qd/rvq8BLtsub8pcZpWFFCm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-01 03:43:52','2023-11-01 03:43:52','System','EtXl3','affiliate'),(29,'Igorqxk','shkut.kovi.g.or.e.c.z.ek.bes.t@gmail.com',NULL,'$2y$10$P4bvXbrIWvtDJwlQpUshY.IMQV9rnqQRhKUJJyocWd1vQKYpoyMeC',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-01 04:06:32','2023-11-01 04:06:32','System','RzhJo','affiliate'),(30,'Svetlanavqp','kri.czik.ov.aya.svet.l.an.a@gmail.com',NULL,'$2y$10$EOnWqUPVn/dBIZS9tyMZved2VADgOVkoIV4BY9YRZy8tgvsxY.uA2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-01 23:42:07','2023-11-01 23:42:07','System','cxxrH','affiliate'),(31,'Iringjz','i.rina202.0.kob.z.a.r.2.020@gmail.com',NULL,'$2y$10$daqMZib8pT01JdqDoC0qvefmFu.vN0.4yyoV/ly2OS/2Bkmt0NULu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-02 02:15:59','2023-11-02 02:15:59','System','Bn8cF','affiliate'),(32,'Veronafoq','v.er.o.n.i.kas.l.obo.dano.vi.c.h@gmail.com',NULL,'$2y$10$6zq27tAe.S8Jui8Xzn7GrOH3xyEUQF45frm6X45XbVV5fRS9aqa9C',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-02 05:44:12','2023-11-02 05:44:12','System','jYUyL','affiliate'),(33,'Svetlanafpb','kri.czi.kov.a.yas.v.et.lan.a@gmail.com',NULL,'$2y$10$EOsxjOXFF2Ro.ASmykOg2OIneeedVc45AI.suRqel480H9x2jc6zq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-02 20:26:46','2023-11-02 20:26:46','System','xCIAj','affiliate'),(34,'Irinqjp','irin.a2020k.obzar2.0.20@gmail.com',NULL,'$2y$10$Dnd.mzmmbOannkcxeI50SuajL5.qH0PErBNT6g9P4IC2BbBcJjZbu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-03 00:56:34','2023-11-03 00:56:34','System','J8gau','affiliate'),(35,'Veronalwm','ve.ron.i.kas.lob.o.d.anov.i.ch@gmail.com',NULL,'$2y$10$bVpHVEX9Q7oumJHAlSYM4.2.Jef5LmycKtttyTRpBnaRo5RK51HEW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-03 01:26:33','2023-11-03 01:26:33','System','iNoH6','affiliate'),(36,'Svetlanasmr','kric.z.i.ko.v.ay.as.ve.t.lan.a@gmail.com',NULL,'$2y$10$UtyQk290jZ/SWgUvU.66Get2w3QrPzVILGwOP2XpY11/HyWaCRB3O',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-03 06:06:15','2023-11-03 06:06:15','System','ZHcNM','affiliate'),(37,'Irinhnq','irina2.0.2.0.ko.b.z.a.r.2020@gmail.com',NULL,'$2y$10$dP2Xk07r9rzGqNiz.NROJ.RTtMpBCRORy7boHdYPfVqUBB2F51pXa',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-03 07:59:54','2023-11-03 07:59:54','System','bkOlC','affiliate'),(38,'Veronaijl','v.e.ro.n.i.k.as.l.obo.danov.ich@gmail.com',NULL,'$2y$10$k9jyd.NDOUPsSTKxJ3DNFu3xxeG7OzFB8EiqfCSVOZwyf9WnHHF6q',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-03 08:24:35','2023-11-03 08:24:35','System','qraEn','affiliate'),(39,'Svetlanagou','k.ri.cz.i.k.ova.ya.s.v.e.t.la.n.a@gmail.com',NULL,'$2y$10$4Xg9pqq.CNMx5FZ4TyncMOrOpUIEzUNxjEbCD1cer4gi9ydZsDboy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-03 23:06:43','2023-11-03 23:06:43','System','PyP6u','affiliate'),(40,'Irinmnc','i.r.in.a.2.02.0kobzar2.0.20@gmail.com',NULL,'$2y$10$ryt1sMqWF6ss09WLTj1UhuRwOe8m6TtrWzT3H8oPiLVtuqsgAh68O',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-04 07:19:08','2023-11-04 07:19:08','System','uLSSz','affiliate'),(41,'Veronathd','v.er.onika.s.l.o.b.o.da.n.ov.i.c.h@gmail.com',NULL,'$2y$10$dwqDcrBMl/WrUpnbPEvcI.4CE0OcqBRls/LSaEzCa/p7RQ/smR0oS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-04 09:01:52','2023-11-04 09:01:52','System','AWkCY','affiliate'),(42,'Svetlanaugy','k.ricz.i.k.o.vayas.v.e.tl.an.a@gmail.com',NULL,'$2y$10$bIlPvT..FzY46afCQxPfj.OM9s0zdoMnz7XtzMIbAO0ZCwRweoOOW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-04 18:09:33','2023-11-04 18:09:33','System','dyh2Q','affiliate'),(43,'Irinhvh','i.r.i.na2.0.2.0.k.o.b.z.a.r2.0.20@gmail.com',NULL,'$2y$10$z3NTVxB9nm21jSuh6IcBguAOWc2aXjS.vAfvE8BcLA5pt3RiQ28kG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-04 20:06:16','2023-11-04 20:06:16','System','XguNQ','affiliate'),(44,'Glendapr','ppkutk@top-21.online',NULL,'$2y$10$rCXiL.FBkmSsuk.alEMGpObs.7CNg4GKzFpf54FTTLq.kwuMcSL/C',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-05 04:45:02','2023-11-05 04:45:02','System','Gprnk','affiliate'),(45,'Vilianafan','v.i.l.l.a.n.u.moru.ch.k.o.mo.st@gmail.com',NULL,'$2y$10$YarRcKx3cf/fq4V0trs2fOXBOHfsvJ1oLOvFVY7M0sIRQxl2zxuAC',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-05 10:42:14','2023-11-05 10:42:14','System','A1rY4','affiliate'),(46,'Leongvx','le.o.n.i.ds.h.k.or.obe.n.k.ov.vy.a@gmail.com',NULL,'$2y$10$y8ASNlkyljU0lL22ChaT0O.iVjPYPLVzUBkEdCwfN9UHNhjMp4DTa',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-05 10:42:38','2023-11-05 10:42:38','System','btZMe','affiliate'),(47,'Davidvbp','s.e.mec.zen.k.oda.v.id.b.ig.man@gmail.com',NULL,'$2y$10$gdbyPqIMDEkSMDDCL1i3GeSWSn4C3BFnxufi.5c7beKhPYe3kkM6e',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-05 10:47:44','2023-11-05 10:47:44','System','YkyF5','affiliate'),(48,'Leonuwq','le.onids.hkorobe.n.kov.v.ya@gmail.com',NULL,'$2y$10$e334Iu2ycV6lNsACQ9.X1.yODbZG/8ICzayqr7nUXYm6vE0J/Vluy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 05:27:27','2023-11-06 05:27:27','System','hzOKA','affiliate'),(49,'Davidfmu','s.e.me.c.z.e.nk.o.d.avidbigma.n@gmail.com',NULL,'$2y$10$00UW9eyhAs9w6jc.WwH7EOYkiQCrP33Rb7MJe7a3uZBzyRAh3EYHi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 06:04:49','2023-11-06 06:04:49','System','CxVzf','affiliate'),(50,'Vilianaome','vi.ll.a.n.u.moruc.h.komo.st@gmail.com',NULL,'$2y$10$AWIan.PUbi.jWlcrQsVaouuRa5m.RJYMjGetnakxWmET5rG0ibfb.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 06:47:39','2023-11-06 06:47:39','System','c03qI','affiliate'),(51,'Leonems','leo.nid.s.h.ko.r.o.b.enkovv.y.a@gmail.com',NULL,'$2y$10$ovjxr5Sv4Bp.idoUTfLAveCpDRx6zAxkxNaKkvc./KxpvHQGzBrj.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 23:05:26','2023-11-06 23:05:26','System','mPf3s','affiliate'),(52,'Davidjyd','se.m.ecze.n.ko.d.a.vid.b.i.g.ma.n@gmail.com',NULL,'$2y$10$62c6AhbZvdY/8XMyc5SUw.YhkvMGzs9C9J4kRI21xtCe6JM8ZvzNm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 23:05:26','2023-11-06 23:05:26','System','Ip5js','affiliate'),(53,'Vilianarkg','v.i.ll.a.nu.mor.u.c.hk.o.mo.st@gmail.com',NULL,'$2y$10$GOGxo2O9OnDD9jz.Q3XFwO316/iVQp/bsVxD5VJvkKv59tMp6Qaca',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-06 23:16:44','2023-11-06 23:16:44','System','mZHAZ','affiliate'),(54,'Leonnsu','l.eo.nid.s.hko.rob.e.n.ko.v.v.y.a@gmail.com',NULL,'$2y$10$qsLMloBrs4fOXMVST4m8Pe3P159QU0yB67rQRBZDU.ANRjmBgTrp2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-07 06:41:12','2023-11-07 06:41:12','System','q5lHE','affiliate'),(55,'Davidjdp','se.mec.z.enko.d.av.id.bi.g.m.a.n@gmail.com',NULL,'$2y$10$vhW.q7VECYSxGSbF4wnXVOw8dkl9b6QtTcCb0rWiYWaQ1BtEE4wIS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-07 06:41:12','2023-11-07 06:41:12','System','ffQJH','affiliate'),(56,'Vilianardi','v.ill.a.n.um.o.r.uc.h.k.o.m.o.s.t@gmail.com',NULL,'$2y$10$dggJeduz2f7dQdmGQ0MQ0u4Qo3Y8dkRF96ZvrySK6BpkolvgbRTv2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-07 07:01:01','2023-11-07 07:01:01','System','ctObF','affiliate'),(57,'Julitse','anjelik.alo.pis.t.u.ck.l.o.ve@gmail.com',NULL,'$2y$10$gxYA0ZrA.dZO0eRT7KZDZePi6qJ6nNIfmOaQyL9PQcYTrzRJf7gFm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 02:06:31','2023-11-08 02:06:31','System','FUwat','affiliate'),(58,'Vikibrc','vik.tor.iyas.k.uc.h.ko1.999@gmail.com',NULL,'$2y$10$VgTDgmFc4oK49Bz70173Be0gKz/maK/avflqzU3vudFonZ1PqKmBW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 02:20:07','2023-11-08 02:20:07','System','AgEu4','affiliate'),(59,'Serzzpz','s.e.rzk.rut.o.g.o.lo.vth.ema.n@gmail.com',NULL,'$2y$10$hOb9isYAjzTMqRsc7zH4M.lBfG2p7LMcaJKAktG/moZqWhQ1rBsmy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 02:34:17','2023-11-08 02:34:17','System','I7Tzk','affiliate'),(60,'Vikiufu','v.i.ktori.ya.sk.uc.h.k.o1.9.99@gmail.com',NULL,'$2y$10$aYvlzSOucRnB1jiVYrvRKuJwVE./BfB3L8m1GB0jUiw5LfldDUJsm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 12:57:10','2023-11-08 12:57:10','System','JVebk','affiliate'),(61,'Julikwl','anj.e.li.ka.l.o.p.i.s.tuc.k.lov.e@gmail.com',NULL,'$2y$10$0yvmqzFpFskksuRf79uYDeTRkj.gRy5/07JJUJTB1zSjZbGg7YJii',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 18:14:08','2023-11-08 18:14:08','System','JqY3A','affiliate'),(62,'Serzpgq','s.er.zkr.uto.g.o.lo.v.t.he.m.an@gmail.com',NULL,'$2y$10$hd62hF/2.Pb12tLA3t08GuWA5eng7fk6ZXpC1K1GRVnq/VXFDxULq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 20:32:57','2023-11-08 20:32:57','System','0IiD1','affiliate'),(63,'Vikivif','v.i.k.toriy.a.skuc.hk.o.1.99.9@gmail.com',NULL,'$2y$10$Wqhtq8qdbtYGXPwuAC.S/.i.kQS4S/mD6zqE7reEIC4kJmRm0DQQy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-08 23:32:19','2023-11-08 23:32:19','System','cfy73','affiliate'),(64,'Julilqp','anj.eli.k.al.o.p.is.tuck.l.ove@gmail.com',NULL,'$2y$10$jowQuStFTTox/kTa2jf4cOuQ4pUr4.JVqvE75jDeiT2un51RZtKI6',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 08:46:53','2023-11-09 08:46:53','System','dRYe9','affiliate'),(65,'Serzdyp','serz.kr.u.togo.lov.th.em.an@gmail.com',NULL,'$2y$10$1WhFaEO4aGqhZxEJI14VmuOc1AHJViN0pTrnJ9sy0dyXv3LlWh4l2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 10:36:24','2023-11-09 10:36:24','System','r9OXf','affiliate'),(66,'skyreverymub','malinoleg91@mail.ru',NULL,'$2y$10$RfUtR1DopG8kqjMUJUBnROJcI1cQPnHCT3Xy95ujS.Ixx863fdiPi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 21:12:30','2023-11-09 21:12:30','System','SeN9n','affiliate'),(67,'Vikibwg','v.i.k.toriya.s.k.u.c.hko.19.9.9@gmail.com',NULL,'$2y$10$yT8S8D9leRh3Y4YC6b5/EuxGrUl9YlhzuSldY.IJFK7FuVSwl6pAu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-09 22:47:13','2023-11-09 22:47:13','System','Vbsdb','affiliate'),(68,'Juliygs','anjel.ikal.o.pist.uckl.ov.e@gmail.com',NULL,'$2y$10$ifaX.LavXn5BoWW1OSsWDOG9TPffZL9SOBwHyAIzp0mMidiocM11u',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-10 11:01:16','2023-11-10 11:01:16','System','ELKkm','affiliate'),(69,'Serzfjh','se.rz.krutogo.lovt.h.e.man@gmail.com',NULL,'$2y$10$z5WoouHDmN9ZBAM6kWtyHuRAnTBE/zvwgEiEDI5hXWKTz7i4mloBu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-10 11:51:48','2023-11-10 11:51:48','System','zxitI','affiliate'),(70,'Juliatu','an.jelik.al.o.p.i.s.t.uc.k.l.ove@gmail.com',NULL,'$2y$10$5z7czlK8dzNXpIsJ1eJDOeL5wV09frICTB8Mm5V.IUBF5vuDeKATq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-10 18:01:59','2023-11-10 18:01:59','System','ynFPO','affiliate'),(71,'Serzjon','se.r.z.k.rut.ogolo.v.t.h.e.m.a.n@gmail.com',NULL,'$2y$10$1AfabWMftGkKXWSitWoUHeKl/zQ0kgfNr5dmLSImbZDWyaMD.9wm2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-10 18:42:06','2023-11-10 18:42:06','System','FGxCZ','affiliate'),(72,'Juliiyd','anj.e.l.i.k.a.l.opi.s.tuck.love@gmail.com',NULL,'$2y$10$OY/vY0yumZC6H.nBceAh0.3WxCtdwhl5lFvrtQP4zWKEbSdZun5pq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-11 06:31:39','2023-11-11 06:31:39','System','LPsSQ','affiliate'),(73,'Serzbla','s.e.r.z.k.ruto.go.l.o.vt.heman@gmail.com',NULL,'$2y$10$N2SE5X3p9jF9zZ6CuoLAIOkd9rIxJQ.tnXeW5zZmoamlKR9H9C0XK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-11 07:17:51','2023-11-11 07:17:51','System','STYmH','affiliate'),(74,'Vikioqn','vi.kt.or.i.y.a.s.ku.c.hk.o1.999@gmail.com',NULL,'$2y$10$..GXdR6OqKJoV/73ijoitO3p5vz/Y5v1Hn8ZNXrVOj3GicztcqUsy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-11 07:44:25','2023-11-11 07:44:25','System','yhgqI','affiliate'),(75,'Evamyb','ev.as.t.og.odu.kl.oveli.f.e@gmail.com',NULL,'$2y$10$ksKZblxB.r6EsFtHK3kGf.hyY6Ax0cd/uiyZNL7yEUJReYrzQcv2K',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-11 15:33:53','2023-11-11 15:33:53','System','qpSDZ','affiliate'),(76,'Eldarczg','a.lekse.js.t.uko.ru.ko.v204.8@gmail.com',NULL,'$2y$10$PNamgEfPq4SGs93rqg.62eRHFsTswLwjfgRaj9p40s2UTloAZDes2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-11 19:15:48','2023-11-11 19:15:48','System','vw8bV','affiliate'),(77,'Robrdk','rober.tbr.o.w.nmoonm.a.ns@gmail.com',NULL,'$2y$10$syP8Rx8mFsSan.Ufi0Kao.HlKIoHs5xd1qUEnqz7DqA4iZe46HAp.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-11 21:14:43','2023-11-11 21:14:43','System','Le5W1','affiliate'),(78,'Evauhq','e.vasto.go.d.u.k.l.ov.e.l.i.f.e@gmail.com',NULL,'$2y$10$rbva4XyYQeD9OZjoEko0fufSjC7uXhItKiL2bGYfh.vOAHofOxInq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-12 07:03:12','2023-11-12 07:03:12','System','iafmD','affiliate'),(79,'Polipropil_ekSi','user1103834@edufree.pw',NULL,'$2y$10$Edj14c2wkFjeOYTBQQAZJOZywqdGNDQXChpmKknpNEBj69leQ9vBO',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-12 18:41:33','2023-11-12 18:41:33','System','1luaV','affiliate'),(80,'Robglb','ro.b.e.rtb.r.own.m.o.o.nman.s@gmail.com',NULL,'$2y$10$F8odhnS0Kmqu0KISQ2a8..h2L/XPf41MiS6z785uA1Oj/PA7/R8Xa',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-12 19:18:35','2023-11-12 19:18:35','System','4oG2Y','affiliate'),(81,'Robutt','ro.b.e.r.tbr.ownmo.o.n.m.a.n.s@gmail.com',NULL,'$2y$10$QCAkm9s4uAnErhERudpmHefprvOs3O3rfE6JtfTRxvowZONwwsNsC',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 02:51:44','2023-11-13 02:51:44','System','eFopD','affiliate'),(82,'Evafau','e.v.as.t.o.go.d.u.k.lovel.if.e@gmail.com',NULL,'$2y$10$1Xvkcu7fbZf8qB/T2YcW.OvDH1e5L1u3WpNxiUYZy1sB42OumA3JW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 05:42:44','2023-11-13 05:42:44','System','KKVW6','affiliate'),(83,'Eldartny','alek.s.e.js.tu.k.oru.k.o.v.20.4.8@gmail.com',NULL,'$2y$10$EU7IkPaLgRQKFQHynad83O3JgvLtyTII9JvyU6RlgPSAu/GY4h/KS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 12:40:56','2023-11-13 12:40:56','System','M4Mnp','affiliate'),(84,'KXcLmkFJXaDMz','dACcPn.qbtjmjm@virilia.life',NULL,'$2y$10$AhR3xgfpaLqtMJPZBXBPWe8ygY/pYBkjXvniEI5mukXEpnDlClr4a',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 17:03:56','2023-11-13 17:03:56','System','iz9BV','affiliate'),(85,'Robzur','ro.b.er.tbr.ow.nm.o.onman.s@gmail.com',NULL,'$2y$10$RW5P68gsyizhZ8hUuxi26OFX9v5MUP3nURvHgJ72yUOMOSHE/jaEW',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-13 23:38:04','2023-11-13 23:38:04','System','zsmen','affiliate'),(86,'Evafrc','eva.s.to.g.o.d.ukl.ov.el.ife@gmail.com',NULL,'$2y$10$YRvdg4mNaZbY5xKjWUdChOdG.IJfl5KumNBE47NvaFPFbj8IGpG7i',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-14 07:01:43','2023-11-14 07:01:43','System','PgxLn','affiliate'),(87,'Glendapr','lbufrs@top-21.online',NULL,'$2y$10$lwWt.LNy7QMPvxpZTnGuK.2EkSnCDTx9CFzib61So.WBvrKAPL3Ku',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-14 13:59:48','2023-11-14 13:59:48','System','pYb1q','affiliate'),(88,'Evaknh','e.vas.to.g.oduk.lov.eli.fe@gmail.com',NULL,'$2y$10$Tz7lvHkRx6iTvSgpeCV2yeZuGH50iozrjaSzXRkFc8P/M7hKf8L5G',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-14 19:04:43','2023-11-14 19:04:43','System','caVtx','affiliate'),(89,'Eldardkk','ale.k.sej.stuko.r.u.k.o.v20.4.8@gmail.com',NULL,'$2y$10$coi1pU74ldYAOaln0lbxy.n3YOCRu7fKFNYkQyvso1wqIoH9wAyga',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-14 20:56:13','2023-11-14 20:56:13','System','4buYf','affiliate'),(90,'Robcfp','ro.b.er.t.b.ro.w.nmoon.man.s@gmail.com',NULL,'$2y$10$E8LwMjcwe04Y.N9LyoGa2.oaqRRzEzjDCHYQ11sger.wGrjJHBMDK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-15 07:35:58','2023-11-15 07:35:58','System','0s5fp','affiliate'),(91,'Eldarlxg','ale.k.sejs.t.u.koru.kov20.4.8@gmail.com',NULL,'$2y$10$79h1/vN7bb1xXR/AObX8WOXoAf8zn0BYHLRwteWkfiLXUoBMecUge',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-15 19:18:04','2023-11-15 19:18:04','System','zFueE','affiliate'),(92,'Ilushikmvr','skr.ebc.ovili.ush.ka.208.6@gmail.com',NULL,'$2y$10$uCoDH6l8uDMYoV3JopkGuOQd6xHOqgaKKoEtjig8UbjOB0/R64IEq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-16 04:07:24','2023-11-16 04:07:24','System','7CeA0','affiliate'),(93,'Margarettoy','m.ar.garelo.ve.tr.o.bert.s@gmail.com',NULL,'$2y$10$fmrKwlXqb3nG3itrK8XVV.s6dCWYNIOI36lAPMi/HdhF5./r1.fIC',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-16 06:46:25','2023-11-16 06:46:25','System','QHRVf','affiliate'),(94,'Eldarfqs','a.l.ek.se.j.st.u.koruk.o.v.20.4.8@gmail.com',NULL,'$2y$10$IDwbnhpiFaDTPQaHFtcRc.gzxvdokHU7F30bTyDv.HEnKLxhNJm5q',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-16 18:46:30','2023-11-16 18:46:30','System','bO1d1','affiliate'),(95,'Viktorieip','v.ik.tor.i.ailovebackc.ha.m@gmail.com',NULL,'$2y$10$OwX6ZOSwamEnb3EULizsXutWbpHNPDKhiuFWGuDZR9fKfQ7NbF/Xe',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-17 22:33:54','2023-11-17 22:33:54','System','5OFfB','affiliate'),(96,'Margaretmar','m.a.rg.arel.ov.etr.o.b.erts@gmail.com',NULL,'$2y$10$2Jj0Zv3b2euzUhlZe3NwheOYtdfLQk0wGeTtlQ4i8OXYLmFlHPpDy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-18 01:17:43','2023-11-18 01:17:43','System','HaMk6','affiliate'),(97,'Ilushikfvd','sk.reb.co.vi.li.us.h.k.a2086@gmail.com',NULL,'$2y$10$VlFEE.3Hy4OqmLNaMimvw.WFBJ03IkyZq1tY3bO8b298uml80brxu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-18 04:51:04','2023-11-18 04:51:04','System','kAOhB','affiliate'),(98,'Phir_yiSi','user1103853@edufree.pw',NULL,'$2y$10$g5wxp6aPYLHJzmnBIFzICOSH0H/uLinq5H9aWNL2jNWmDyLf0jEau',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-18 10:35:53','2023-11-18 10:35:53','System','pychM','affiliate'),(99,'Margaretkoo','ma.rgarelo.ve.tr.ob.e.r.t.s@gmail.com',NULL,'$2y$10$0K.3Nbxgrk0JKs3meh6KrOvejh8o/dzIeHK536JDJTRIQhzLjeGt6',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-18 19:59:17','2023-11-18 19:59:17','System','O4GxJ','affiliate'),(100,'Viktoriavw','v.ik.t.oriailo.v.eb.ack.c.ha.m@gmail.com',NULL,'$2y$10$LKGxeoMRgF.7E.ztNvheouywviqNXyluGqWQ6nRUbqk6oCAdUb8Cm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-19 22:06:05','2023-11-19 22:06:05','System','HUpmY','affiliate'),(101,'Ilushikgyi','s.k.re.b.co.v.i.liush.ka20.8.6@gmail.com',NULL,'$2y$10$zBLOM1H675vupA6hXpRM1.MRSWZvQ14QA9Tx0K723C3fyK.d2wfeK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-20 00:56:49','2023-11-20 00:56:49','System','qx0R8','affiliate'),(102,'uJjKyDKCnHQf','uMOikC.qjbdbph@tonetics.biz',NULL,'$2y$10$7XbID5bpQOZ1RvdpAmyhXOr6lYQrF/sVD5clgUhyfW1g32.8UiHOG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-20 05:41:33','2023-11-20 05:41:33','System','WXdQd','affiliate'),(103,'Margaretrwl','ma.r.g.a.relo.ve.t.r.ober.t.s@gmail.com',NULL,'$2y$10$cwDY.d9bI7vbRwVQ4c/kxuOeO6Qv1WzXmQjIAUorr5XoFViDXRnZG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-20 07:31:49','2023-11-20 07:31:49','System','tPXk3','affiliate'),(104,'Ilushikidn','s.kr.e.b.co.v.i.l.iu.sh.ka2.0.8.6@gmail.com',NULL,'$2y$10$lRTstsVG4mXwawMlXYOjG.OZ0tqmLSfdQwaUleNR503nqVvptn2Wi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-21 22:22:12','2023-11-21 22:22:12','System','Ka4Hp','affiliate'),(105,'Vikiijh','shu.p.l.etcov.av.i.k.t.o.r.iia@gmail.com',NULL,'$2y$10$X3Pc.LOC1BDfHCFjFLR2keCCtzQExSh.6QoUwR553Tp/.CyB870S6',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-22 08:07:10','2023-11-22 08:07:10','System','6Eka3','affiliate'),(106,'Viktorikit','vi.kto.ri.ailov.e.b.a.ckc.h.am@gmail.com',NULL,'$2y$10$PGy69OSvwdNIJuOhV7syyuCBs3i/x9YUxZi4pwKAWy4K1pKcAPtci',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-23 22:47:48','2023-11-23 22:47:48','System','sKPf1','affiliate'),(107,'Nial_boEn','user1103876@edufree.pw',NULL,'$2y$10$mlDlLvdqKEN1P0.vwiPWU.5mhbozXLJs/qw8SDXzLWkxYVgRrhdhC',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-24 00:27:23','2023-11-24 00:27:23','System','XzOLc','affiliate'),(108,'Vikilxn','s.hup.le.t.c.o.vav.i.k.to.r.i.ia@gmail.com',NULL,'$2y$10$x1ACA9AEGqYLKMUlqSDFWum13L0leBi7XtViB7ZnQ4kYTkDKtF9Q.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-25 09:37:37','2023-11-25 09:37:37','System','3QQI8','affiliate'),(109,'Viktorismo','vikt.or.i.ailov.eb.a.ck.ch.a.m@gmail.com',NULL,'$2y$10$I1nR../HfGU9Nitn.QoFUeCqj9dBatmZUoCL/xBUY9nUuNM0HrM7e',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-25 09:53:58','2023-11-25 09:53:58','System','HZ0Br','affiliate'),(110,'Gordon','vvTInL.hbtcd@rottack.biz',NULL,'$2y$10$B9B3btApyVd5twb3gZCsD./ixODH81HrU5ju5yEBiit3lI3lm6Dfq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-27 15:26:00','2023-11-27 15:26:00','System','PJU5f','affiliate'),(111,'Veronaxyp','ve.r.o.na.s.ku.t.en.k.oal.l.s.ta.r@gmail.com',NULL,'$2y$10$bIxIqEyNo6/PpJ/gU9DYsuWXbUazEVk0W0qC0GRXioWBG1.AH07iq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-27 22:00:11','2023-11-27 22:00:11','System','jGo0V','affiliate'),(112,'Vikifne','s.hup.l.e.t.co.va.vikt.or.i.ia@gmail.com',NULL,'$2y$10$GYjPurMye.cjOs7QWmGF6ukJU5BrU8F4lE4XqI1WjuUhSs7o1Pslq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-28 01:02:34','2023-11-28 01:02:34','System','zVTtJ','affiliate'),(113,'Griz_cgEn','user1103886@edufree.pw',NULL,'$2y$10$Ci5WfgvoqbaqpwFrmjGlr.cU3wWxQi3I2C.7GiNo4L2k8fNaFfzQO',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-28 03:38:00','2023-11-28 03:38:00','System','YKEOF','affiliate'),(114,'Magdalene Dede Boadu','dedegota@yahoo.com',NULL,'$2y$10$qcnU/LCusbyHHhFpM.CEW.Q831B/ttZtUjEyxXfg5U2mZi2a4yBte',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-29 07:29:31','2023-11-29 07:29:31','System','lYa5b','affiliate'),(115,'Glendapr','xzqouc@top-21.online',NULL,'$2y$10$tAQEZFyFE00cxo6w73k/Lunv5mSbOJLn4hTkdtWugWxiJuNXJFCqO',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-29 11:01:44','2023-11-29 11:01:44','System','ggRwl','affiliate'),(116,'Veronadxd','v.er.ona.sk.utenk.o.al.l.s.tar@gmail.com',NULL,'$2y$10$tr2WbR7/5PfxleKy00reteFbkWt3KAOxCYXPA.Cw76u.WSQtYRhnS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-30 00:56:30','2023-11-30 00:56:30','System','oNhsY','affiliate'),(117,'Vikiyma','s.h.u.pl.et.co.v.avi.kto.riia@gmail.com',NULL,'$2y$10$oQR6NatbNbhE3DRxP7SzMea7uKEQbiqiekm1055zU1oVkIKSRp6He',NULL,NULL,NULL,NULL,NULL,NULL,'2023-11-30 03:59:35','2023-11-30 03:59:35','System','bRfvW','affiliate'),(118,'Mekhi','mXHwRS.qjhdbhp@anaphora.team',NULL,'$2y$10$7Hi9axWPeJKhsSj2mU.Ga.L0dNkGlAkGf2bRGdQBAkQJU44VeqhUq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-01 09:12:42','2023-12-01 09:12:42','System','McXGY','affiliate'),(119,'EtBdEmsJtrrx','uYrXWc.bdhbptt@usufruct.bar',NULL,'$2y$10$lcIOTXfFjlvu.Ab9wI6vJe1qqZBGLbNwIZRdwAuJKaQVATcbzn0zS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-02 16:39:01','2023-12-02 16:39:01','System','qo94n','affiliate'),(120,'Veronafov','ve.ro.n.a.sk.u.t.enk.oa.l.ls.t.ar@gmail.com',NULL,'$2y$10$tEi24uVKPJdlPZx9QHNjB.OSFdHkCw.J/nHTOzbfqhjU37auFJ.sG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-03 03:20:52','2023-12-03 03:20:52','System','hTLkz','affiliate'),(121,'Akay_btki','user1034824936@freehostme.space',NULL,'$2y$10$Z4hIVlHiLdCxRgHjK8Nm1ORPLwmWNj7lm3p5ooSyknfqx8xB1k.qy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-04 02:37:37','2023-12-04 02:37:37','System','tQUZg','affiliate'),(122,'Renatiznq','che.r.e.p.a.no.vrena.t.2350.7.9@gmail.com',NULL,'$2y$10$Twa3VwM4RfO23aoP2zfl2uC8mAXAfkNPzRgo0LDvs9ryP6wYzJy9C',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-05 00:18:31','2023-12-05 00:18:31','System','n5o8G','affiliate'),(123,'Veronajvx','v.e.ro.n.as.ku.t.e.n.k.o.a.ll.sta.r@gmail.com',NULL,'$2y$10$yEWA5zRzL4HE1jzZMRglGekpbZgzuCfZdlcRIyiK2wb8XJTZq/99S',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-05 05:10:01','2023-12-05 05:10:01','System','xND01','affiliate'),(124,'Renatibps','che.rep.anov.r.ena.t23.50.7.9@gmail.com',NULL,'$2y$10$epGHgaPMl9pnGwZrrMtDyepRzoa0h44ojyj.ANqw5SEzfgm8tgDIy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-06 02:20:28','2023-12-06 02:20:28','System','V198W','affiliate'),(125,'Allaadx','a.l.lahe.a.r.ts.urmanidz.e@gmail.com',NULL,'$2y$10$NLzvyqFFh4kbPtde8DYHBeV1w4G8k7NZFdFl91c/yoTIKUmSvQzG2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-07 01:05:49','2023-12-07 01:05:49','System','kPM1E','affiliate'),(126,'Renaticua','c.her.e.p.an.ovr.e.nat2.35.0.7.9@gmail.com',NULL,'$2y$10$ujJGcGf7TQUQ298L0Ub5V.lguiFtr27B1EgflUbnRo6Oxxf/7jQqG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-08 22:03:38','2023-12-08 22:03:38','System','272lt','affiliate'),(127,'ACCCPLywnDxYJFU','Jdtmtz.bccwcpt@scranch.shop',NULL,'$2y$10$wOG.z/BLpGoGEMcuGsJNoOuxdzceKL6uVR/80dXyJlrJ7rEZQfKuO',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-09 12:56:54','2023-12-09 12:56:54','System','KEIZH','affiliate'),(128,'Allasar','all.a.hea.rt.sur.ma.n.id.ze@gmail.com',NULL,'$2y$10$OR3lKcwhSx8bZaHSqe7PQu4TadKBGYGidKM0kvOjA.UtY45ml933C',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-10 05:34:33','2023-12-10 05:34:33','System','0tOgp','affiliate'),(129,'Veronabdz','ve.r.onas.kutenko.allsta.r@gmail.com',NULL,'$2y$10$/s1Pk0od2TrCloruzowMruiyYJ455EOpWt7.vGsRxmGa9FeGy6c.O',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-10 09:28:12','2023-12-10 09:28:12','System','EExd8','affiliate'),(130,'Jason','FFaKUX.qtjhjmp@carnana.art',NULL,'$2y$10$iMr9ICOtx8P2ae2/VBGHz.2Ud./ZHhS9Igou5JQr6p0Wj0wMEETLG',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-10 23:41:13','2023-12-10 23:41:13','System','xveye','affiliate'),(131,'SteveSquat','iahktg@top-21.online',NULL,'$2y$10$68HK/2NL8hxnncLkQyZzCuTtlVvlDvXm/xvk5DYTB4MPsdU/SlrEe',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-11 15:57:35','2023-12-11 15:57:35','System','VKqyW','affiliate'),(132,'Renatiilm','cherepan.o.vr.e.na.t.23507.9@gmail.com',NULL,'$2y$10$AO9AOtAOr2dOj5UpCgzJNezIGHw0H3v.YOMu7vX5OMlwHlDuVB6hy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-12 07:28:41','2023-12-12 07:28:41','System','QEehQ','affiliate'),(133,'Zaniyah','PKPFoV.tqtmmdc@rightbliss.beauty',NULL,'$2y$10$T9I581EWWt4d6YT85pNTfOCMbkEVBwsOnzneE6Qaq3e/hvpxjPsV.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-12 15:23:50','2023-12-12 15:23:50','System','eUSMW','affiliate'),(134,'Allackq','a.l.lah.earts.u.rm.a.ni.dze@gmail.com',NULL,'$2y$10$aiyGxx7CpwoYx6gNFRzNJOvYAXnMTw4FAOg4TM744AJxddo95QOg2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-14 01:16:39','2023-12-14 01:16:39','System','wSSoq','affiliate'),(135,'Juliaadsk','juli.aa.l.l.b.estro.be.rtss@gmail.com',NULL,'$2y$10$ApfgoB/b6.jtX3uUCurEeO9NOnCBHCLtcFvfIcSUOR5fyitdWvKsq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-14 09:13:02','2023-12-14 09:13:02','System','ZTM91','affiliate'),(136,'Juliaaprj','ju.l.iaal.l.bes.t.r.ob.e.rt.s.s@gmail.com',NULL,'$2y$10$apX.Xi/4.ZLgF.4rYrsps.Zhs7PjDHycGq1LrAHDfYtFUI8zftHH2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-17 04:32:53','2023-12-17 04:32:53','System','XB4v1','affiliate'),(137,'Juliaauso','ju.l.i.a.a.llbest.rob.e.r.tss@gmail.com',NULL,'$2y$10$tbwB030Fd6RDgo5MIf93bOiXzImP3V8t9QVf14r/xqXgKHr2m5mbS',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-18 10:10:00','2023-12-18 10:10:00','System','McJR3','affiliate'),(138,'Juliaacio','ju.l.i.aal.l.b.est.r.ober.t.ss@gmail.com',NULL,'$2y$10$J2bCPlyUEeqBME68UVNm8OgyrdGUPzzaPOiDAGGAZf0UBxKkIPzp2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-19 15:55:52','2023-12-19 15:55:52','System','I91fR','affiliate'),(139,'Jeffreynom','r.o.g.r.o.g.bo.che@gmail.com',NULL,'$2y$10$/Wl2waGlsu8scGk/OXST5uzraECRdZtwDI7PJ8NFA5gEzi8YTrXPK',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 11:06:51','2023-12-20 11:06:51','System','hxvY1','affiliate'),(140,'Juliaagbk','j.u.l.i.a.al.l.b.e.st.r.o.b.erts.s@gmail.com',NULL,'$2y$10$QEsDJDMRCJoZN/e4VlmowePUpsOkWCX/U4fXiGDakEdTO0BWnA0.6',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-20 15:58:50','2023-12-20 15:58:50','System','exki2','affiliate'),(141,'dimkainmd','alex21032121@gmail.com',NULL,'$2y$10$vGJJkZqOvTWuLLtXHPI0Ou.M8.LJJvFx65GkKwqj7zTePtpS5DSGe',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-22 03:29:37','2023-12-22 03:29:37','System','lVRxI','affiliate'),(142,'AshleyHeday','hakgiq@world23.online',NULL,'$2y$10$zYNtrzKOJ2ZxMwSJ.dOXUuycMvi43D2HP9O7kIUZIYJdx9iRTFrAm',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-22 19:59:42','2023-12-22 19:59:42','System','i3Gz7','affiliate'),(143,'Renaticii','c.h.e.repa.n.o.vre.na.t.2.35.079@gmail.com',NULL,'$2y$10$E9TG8JquGoNVljaMVVN2K.OJmMmQHK5usC/uLPErFNB.zZN8UUEAu',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-25 23:24:37','2023-12-25 23:24:37','System','oUeOt','affiliate'),(144,'Renatijbj','ch.e.re.panovren.a.t2.350.7.9@gmail.com',NULL,'$2y$10$9EbWI3qN9eyiPRede1du2OEkup1kqj9RESoIJpY5qCsTm.6SzhFe.',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-26 08:15:15','2023-12-26 08:15:15','System','R8aGO','affiliate'),(145,'Travis','JjDCau.tpmtttm@purline.top',NULL,'$2y$10$goU.0PN4kC0dj0OgQb483us6SVQvJMAZxFQUJ9Ndg8GbFbv.3ZMTi',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-26 08:56:32','2023-12-26 08:56:32','System','bJUdE','affiliate'),(146,'Renatibna','cher.ep.an.o.vr.e.na.t2.35.0.79@gmail.com',NULL,'$2y$10$TeKgVPlEf7aL0JuRgb73QOOXRYMuxpZ2Wv9cwytj2Xe5DvqHOGP4O',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-27 08:59:50','2023-12-27 08:59:50','System','OFbD7','affiliate'),(147,'yutub_whka','btxizcbptka@exactli.pw',NULL,'$2y$10$nPYHK2sNCf8P4UwtVBj8UOHEveUgMZed5sfpxPgQzCM2xOfTum46O',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-27 09:22:47','2023-12-27 09:22:47','System','rApHv','affiliate'),(148,'Chase','SVHUXJ.dhjwqpj@purline.top',NULL,'$2y$10$LOxu8o01MbBjdY.tnMhsTOe65ieGYgUzJcVCq/dv.NSg/kqK5Lvbq',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-27 21:25:54','2023-12-27 21:25:54','System','TKwaN','affiliate'),(149,'Renativdn','c.h.e.r.e.pa.no.vr.ena.t2350.79@gmail.com',NULL,'$2y$10$VvmXm4vsVJX9ymr1UimtKO68Fu1AcOF91dwF.GPc3i30sbZbCPtRy',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-28 03:27:35','2023-12-28 03:27:35','System','i1XbV','affiliate'),(150,'Renatiptw','c.h.ere.p.anov.r.e.na.t.2.350.79@gmail.com',NULL,'$2y$10$RdI4oKmb5BMs2IUwN7Rm5eqa6CyjBa0XkKGWdolAUM4uSBAm9ZkV2',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-28 18:00:26','2023-12-28 18:00:26','System','OHwBg','affiliate'),(151,'insta_fcka','isfexaldaka@exactli.pw',NULL,'$2y$10$Abz1urau1YA4J9harH/D0OANs9wdXY9qcdW4uthCd7ti3sFvxaW6G',NULL,NULL,NULL,NULL,NULL,NULL,'2023-12-31 02:45:10','2023-12-31 02:45:10','System','Terea','affiliate'),(152,'Dylan','lsvSVs.cmhttmp@carnana.art',NULL,'$2y$10$tGeR3xETfPArWa0QUnBAceC2Y3AphiVy5NlEgxOXdOEMabD4SeU8.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-06 00:07:23','2024-01-06 00:07:23','System','RsNeY','affiliate'),(153,'Renativsh','c.he.repa.no.vre.n.at.2.3507.9@gmail.com',NULL,'$2y$10$sbuB5hXN5TkH5oFafw6aH.G6jJLCzzWaLRx4QT7pxdTewXDcv26fa',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-06 00:42:20','2024-01-06 00:42:20','System','qBIoT','affiliate'),(154,'Renatihah','c.h.e.r.e.pan.ovre.na.t.2.3.5.0.79@gmail.com',NULL,'$2y$10$lYcorLbMkChV833Dz2d/QuBiT21Qm4teWjFn/WnKPKaHjdNDrevni',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-06 08:44:03','2024-01-06 08:44:03','System','ZksNd','affiliate'),(155,'Renatitsm','cher.epan.o.v.r.en.a.t.2.35.0.7.9@gmail.com',NULL,'$2y$10$l3WOD3NPzxlw8PyAUUMzueOTFOUbCnAHZ.HkMeBM1DQCC14MrFRiq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-06 20:39:28','2024-01-06 20:39:28','System','A25MZ','affiliate'),(156,'Renatiloh','che.re.pano.v.r.enat.23.50.79@gmail.com',NULL,'$2y$10$AGDMgrXbWuv4zR.8OzGNn.H7ok5t4YZiWRybcb2WOCUBXw.yBMYWK',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-08 08:35:09','2024-01-08 08:35:09','System','lmyQx','affiliate'),(157,'Renatipgz','c.her.e.p.anovr.e.nat2.3.5.0.7.9@gmail.com',NULL,'$2y$10$.vqzjT2Yl1QIXd24DIhPfeM5mWg.uhMv9XBUYTpcmU.BGQSdwE7sS',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-08 18:22:18','2024-01-08 18:22:18','System','KaHiA','affiliate'),(158,'Renatiiip','ch.e.r.e.p.anovr.e.n.at.2.35079@gmail.com',NULL,'$2y$10$QUhzE9gp/YMYhScZyxCoseIJtmr9PVH/Fx2ADRvs1aCogOvWO1Qpy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-09 03:37:54','2024-01-09 03:37:54','System','EN44W','affiliate'),(159,'Juliet','lqLSsP.dhpcjmw@kerfuffle.asia',NULL,'$2y$10$aLiWB/VLB8Q.JXCiSC1K/emWES9JD4RAa9Bnj5cFnplsAKHpEBMAe',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-11 06:14:22','2024-01-11 06:14:22','System','iA3cE','affiliate'),(160,'Donaldpumus','j.a.so.nm.a.s.t.ersp.a.s@gmail.com',NULL,'$2y$10$wo.oFUkq73a9yyPN5wY30uYR4neyZ2950UuthkD1eJ0BWCGEnUnXy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-18 13:01:57','2024-01-18 13:01:57','System','YLcqM','affiliate'),(161,'Victorxme','bo.r.i.s.1.980s.e.cenov@gmail.com',NULL,'$2y$10$521qSxpkqkbRSG7hKKCKjeDn3CAzj2xAh.INmXXPN/9wEhpo3bRNe',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-26 04:46:26','2024-01-26 04:46:26','System','Zjzax','affiliate'),(162,'Anic','lazuritllc@hotmail.com',NULL,'$2y$10$U67o6QWMaTx5VDOmGMQFTuhoRnN.t4MO13i.G1erbL1D/4C0lhcjW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-28 09:08:20','2024-01-28 09:08:20','System','l1IIx','affiliate'),(163,'agrohimpka','l.i.d.e.rpr.o.mo2.01.5.s.up.e.r@gmail.com',NULL,'$2y$10$.cLv10kbXRFyvuRATr6Wd.HhkqFtaE94Tc.I1lfBLGg.REhvRERB6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-28 15:11:11','2024-01-28 15:11:11','System','um0IC','affiliate'),(164,'Bogdanmlf','go.rs.ec.1.9.8.0.r.u.se.r.v@gmail.com',NULL,'$2y$10$9CGwm6wt4kkND.ZMNuSMYOrXt.fWTweRCUj.6kIW2FxlKSP6n.zAW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-01-30 21:16:23','2024-01-30 21:16:23','System','12bBT','affiliate'),(165,'Shay','pbLuIA.qwcpbcq@sabletree.foundation',NULL,'$2y$10$eJ3gl4f3Tq8cmBq592PqEeUVij06H5vkhnBZJllWdxVt57xNS4Zaq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-09 16:37:03','2024-02-09 16:37:03','System','5I8wb','affiliate'),(166,'Thomasspast','trendo90@outlook.com',NULL,'$2y$10$oFv.aCoC1trPm3CVALUo9eXTXxuw.vqWDE1aemCQ/yGFu7vu.gKOq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-15 11:27:43','2024-02-15 11:27:43','System','ZJw5k','affiliate'),(167,'Giovanna','ilMAmO.tqtpcbj@flexduck.click',NULL,'$2y$10$cdpQL1TwGhWGHe9UwKfjP.xxlASZ6be0iLU6a.Ap25YDPmUVTKODO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-16 01:57:20','2024-02-16 01:57:20','System','pJ3JD','affiliate'),(168,'agrohimjit','li.d.erpr.o.m.o.20.1.5.su.pe.r@gmail.com',NULL,'$2y$10$qrbn.2ZemJe2.LXw9OoY0up6EYEjjN/2nIdaF57g2h9SL9ddTY6Z2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-20 18:44:19','2024-02-20 18:44:19','System','t1unZ','affiliate'),(169,'Andreastqt','a.qu.a.burs.e.r.vic.e20.21@gmail.com',NULL,'$2y$10$Vpkw1nxMEG7LsjaR0gm.quqo/3mCEfx7D.cH9xgKjQ8cweBbbaYNy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-24 13:16:17','2024-02-24 13:16:17','System','wRIAT','affiliate'),(170,'Williammayof','qgbqjxdyuki@poochta.com',NULL,'$2y$10$Tx9Y64LsKpuENKikm2T9QusNCYf85ZqgRCgsz9SYBwt0so73kJ2kW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-24 15:05:50','2024-02-24 15:05:50','System','9BB12','affiliate'),(171,'Antonioawu','2.6.1.2s.upers.er.vis.2.02.1@gmail.com',NULL,'$2y$10$5.JXGoTuGVTtuqmWpgpda.7bEdyE//SkHNptMKsByig9GRDsrVDO2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-24 23:55:36','2024-02-24 23:55:36','System','cScSF','affiliate'),(172,'FrankSot','br.a.d.t.he.m.a.s.te.r.77.7@gmail.com',NULL,'$2y$10$Dm3ZCKZl0moc.hntb3z8yubi0CYyZFvBlvFEfbr0R.AX122HBbcd6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-27 06:52:05','2024-02-27 06:52:05','System','ENOrn','affiliate'),(173,'Anais','xcYbeF.qpmpbt@rushlight.cfd',NULL,'$2y$10$gGqsjL9N.fl4p/iGUc9UrunbCA/hlAqOgAc5xGwWFjnD/yqb7z39m',NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-27 07:46:15','2024-02-27 07:46:15','System','5t5dt','affiliate'),(174,'Victorepv','b.o.r.is.19.80.se.c.e.n.o.v@gmail.com',NULL,'$2y$10$NpdTEi743FAaeB6P06oA6ed/ZTT01hAxcEX4uBEBTrjm/QWq41FVC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-02 08:51:29','2024-03-02 08:51:29','System','iqIqv','affiliate'),(175,'Elia','ASBkVk.mqcppqt@pointel.xyz',NULL,'$2y$10$FjWFzKXY5I5v1fGxxKft6.mNhTPZV8GwvDw56GzzKFE.Vep307WAC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-07 11:31:57','2024-03-07 11:31:57','System','mXPR4','affiliate'),(176,'Michaelskync','hol.m.e.ss.tep.h06@gmail.com',NULL,'$2y$10$9MdGD9G4up4JsU6XKitxTeJDaH/W7ahc3VUgnENypeGE4pW2ygV7K',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-09 13:28:25','2024-03-09 13:28:25','System','Iy8Lk','affiliate'),(177,'Kayleigh','jFNFBD.mttmwbq@kerfuffle.asia',NULL,'$2y$10$MrTiJx0BGea/LLoSRVnwYOY7c5THYfswoQI59amLJpr/5bopSfYPu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-11 10:51:42','2024-03-11 10:51:42','System','QFWXv','affiliate'),(178,'melene','qcmtbcqjp.b@monochord.xyz',NULL,'$2y$10$SA6fHK6pf16C57dEezrqu.iS9GCuwlhJkf1tlS.PU1S01KpJNl./a',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-15 17:24:42','2024-03-15 17:24:42','System','CVVh2','affiliate'),(179,'Antonioudm','p.util.o.ivan.73.5.6.7.8.1.23@gmail.com',NULL,'$2y$10$3mrWSWlMfHaMAsqyRxq9ZOOGR7w8YYB1Zs4vIEaYNuErJYrEsX4dW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-16 10:34:57','2024-03-16 10:34:57','System','4VdPv','affiliate'),(180,'mack','dccdhdjcb.b@monochord.xyz',NULL,'$2y$10$L3ezECmuSdU0eGDqJPAv3.blR3yYKvbifAYkKLj8TH/KKlBGgAwjC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-18 16:33:41','2024-03-18 16:33:41','System','5BUuR','affiliate'),(181,'Antoniousk','p.ut.il.o.i.van.73.567.8123@gmail.com',NULL,'$2y$10$m3/eBZ0LSOB4saGqKUZg5OK1DHBDfxIccMRCaaL6g0tSUkmQyBbTy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-18 17:14:07','2024-03-18 17:14:07','System','xYQeo','affiliate'),(182,'Louiezom','buchana.on.ma.t.t@gmail.com',NULL,'$2y$10$TYXyKtx1af/z9Q0eXsjNOunMqFiJECRF2PM10MGTIMh47t.j5N2Wi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-19 03:26:00','2024-03-19 03:26:00','System','Br5eE','affiliate'),(183,'edislav','pctdmhjht.b@monochord.xyz',NULL,'$2y$10$yhymbjcu3vSgO5zf95atT.UgTJBpqcAldtToaonP2/RDCPrQBw3Sq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-21 18:17:20','2024-03-21 18:17:20','System','FZ5rR','affiliate'),(184,'JerryPag','j.a.meswood.s.iii.iv@gmail.com',NULL,'$2y$10$OiZfejms0utZaz3m6zihZe3o1/8pjkqWj3cX02t7rCVlcgsjo.uqe',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-22 02:58:05','2024-03-22 02:58:05','System','Wh1T6','affiliate'),(185,'kemeisha','qjcjbbmmwq.b@monochord.xyz',NULL,'$2y$10$Aju4ekYua.yIIAwH9JT7EeP4T5cO04YLCMxeSblXgwth0IZDKDeei',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-24 10:21:47','2024-03-24 10:21:47','System','SvYcK','affiliate'),(186,'StevenFluby','jjoze@modernmark.ru',NULL,'$2y$10$bOI9kJhUJAqviVvnNtJgo.T6toC1uwmapadWJwreEvQUVAVufAjpu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-25 08:32:39','2024-03-25 08:32:39','System','kb3VD','affiliate'),(187,'Isaac','obodaiisaac7@gmail.com',NULL,'$2y$10$FZ0w4L1yH5slscRZWowD.eUqXgEpnHWCklL/4.1NHokKB49IKnFk.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-26 16:19:51','2024-03-26 16:19:51','System','6v0cK','affiliate'),(188,'makenlee','qtbpchpmtm.b@monochord.xyz',NULL,'$2y$10$93QNNFNOApunRCfCgLIxyeE8VHQ/u1SY7Eirxn2lg3BwgSjUzgO7S',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-27 14:59:05','2024-03-27 14:59:05','System','z36Xm','affiliate'),(189,'Henrycrink','jo.nt.hedefe.n.d.er@gmail.com',NULL,'$2y$10$f1VHM/w6uiGLSNi60DztVuTU/2Emm/iWlsH4TYtTUN2cXPNqoN3ZK',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-28 18:43:46','2024-03-28 18:43:46','System','Gvge2','affiliate'),(190,'Francisacelf','s.amm.ym.a.nn976@gmail.com',NULL,'$2y$10$1.bGb8FQHpYql5YYBtWACuYo0Lm6yoM0ownBqq4V4xl7tnIHcURsu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-03-30 03:14:48','2024-03-30 03:14:48','System','rAopz','affiliate'),(191,'Michailmvl','en.t.e.roff.ic.e2207.2.0.2.2.3@gmail.com',NULL,'$2y$10$LSCAjgwW0MXijZqdeQOfkeisWr6rb9lpLYSOHF5p/EUARSm5HANvy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-01 02:02:43','2024-04-01 02:02:43','System','LlJkm','affiliate'),(192,'Stevenmic','c.breal.e.st.a.t.e.h.o.me.s@gmail.com',NULL,'$2y$10$dKCun.yllmrn.H.NWfytEOqCP42TwXSQvysFmtYCR9Vjt/H5vvhra',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-01 21:20:25','2024-04-01 21:20:25','System','UIaTs','affiliate'),(193,'Michailalm','e.n.t.e.ro.ffi.ce220.7202.23@gmail.com',NULL,'$2y$10$c8IK8BnVWCLfZBIgnXNubuo/eGK9260WNi9nA7XLvOD6yvCwEXyv.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-02 16:11:48','2024-04-02 16:11:48','System','hU4PX','affiliate'),(194,'Yasmin','htLiLj.qcmptjj@borasca.xyz',NULL,'$2y$10$4OUjG4oQ2GFklxIDazBuZunQMNrDOCiD00HJiN2phkv3AMKRY0AcS',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-05 12:23:06','2024-04-05 12:23:06','System','93FGn','affiliate'),(195,'sherma','qcbdcmbwmp.b@rightbliss.beauty',NULL,'$2y$10$1lPYP/QjmlcMnJxzgKQSZ.b23xwlWPE3zmeWwYXBMQf5gRkWlZU22',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-07 07:40:37','2024-04-07 07:40:37','System','fswlw','affiliate'),(196,'CarmelaNit','b.ra.de.l.y.bra.d.4.5@gmail.com',NULL,'$2y$10$pc3NHLmrOotHAN8xG5LvXuCQxYLpk0enlEDgJZLtEbH5E8XLGBQSu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-14 12:01:13','2024-04-14 12:01:13','System','t0cQt','affiliate'),(197,'ThomasTer','c.ur.tb.alc.h.20.2.2@gmail.com',NULL,'$2y$10$PPsRIraDFfDflcNaTc10de/dCCYY1X9.GFzcPGuyQGG/5suFGRCyK',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-17 21:09:33','2024-04-17 21:09:33','System','m32Ng','affiliate'),(198,'Donaldpumus','j.a.s.o.n.m.as.te.rspa.s@gmail.com',NULL,'$2y$10$6/pbmNjlzBI4frccYnMcwujuHsyQzXM.ORvsmT4yXhIJXYJzaadEi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-23 00:10:33','2024-04-23 00:10:33','System','q2tWi','affiliate'),(199,'Abdullatif Shaibu','sterlinomar65@gmail.com',NULL,'$2y$10$CEErxbEYpopR4sb790q6P.8UmYQyLeMlbjnQ3EEmX3MHptJc679ye',NULL,NULL,NULL,NULL,NULL,NULL,'2024-04-29 12:48:15','2024-04-29 12:48:15','System','eJogL','affiliate'),(200,'EllisMat','gqsvlwvyipr@poochta.com',NULL,'$2y$10$c3USdjsosQ3.dhq9lM.pQeZKLIH0HcpxfRmzw1NfOO9iKMMKx7xvu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-01 13:09:47','2024-05-01 13:09:47','System','dKkQ4','affiliate'),(201,'ManuelBet','qxuvreuegSn@poochta.com',NULL,'$2y$10$MFxa7RkEkqHhVBI0Qhyl5.8aKwilHBmNFMu/HsgwYtdhlhGhABdOC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-05 20:02:44','2024-05-05 20:02:44','System','2NrHp','affiliate'),(202,'Donaldpumus','j.a.s.on.ma.ster.sp.a.s@gmail.com',NULL,'$2y$10$4VzHPCJ4K5V.fXiJra9oOuZctYKRK/k19rq2C1LnoZvXy/c/9izP2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-12 15:06:07','2024-05-12 15:06:07','System','j10A8','affiliate'),(203,'Louiezom','b.u.chan.a.o.nm.att@gmail.com',NULL,'$2y$10$JWkXdZYAw0cdAT3Q4/5.yeY5DCDCeAmpXUOVyhq/jjRMkmOYNc4Ne',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-14 22:10:46','2024-05-14 22:10:46','System','HG7h7','affiliate'),(204,'Nfejdekofhofjwdoe jirekdwjfreohogjkerwkrj rekwlrkfekjgoperrkfoek ojeopkfwkferjgiejfwk okfepjfgrihgoiejfklegjroi jeiokferfekfrjgiorjofeko jeoighirhgioejfoekforjgijriogjeo foefojeigjrigklej jkrjfkrejgkrhglrlrk ltimepropertiesltd.com','vadimnea66+162r@list.ru',NULL,'$2y$10$5quTepKrb.Yj4Z0tuPeq5OutYoENXxSNsrBIP6hRSiMW0dLHb6BAG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-15 19:24:15','2024-05-15 19:24:15','System','sv7Aq','affiliate'),(205,'Mildredheets','b.ri.a.nn.a.m.c.ke.n.z.ie4.597@gmail.com',NULL,'$2y$10$CtUnO3J7uXGw75s1gJSIEuSD26Ak1Po4TWQjWGkm/dAIAsE3EOCMS',NULL,NULL,NULL,NULL,NULL,NULL,'2024-05-31 18:57:22','2024-05-31 18:57:22','System','122Wh','affiliate'),(206,'Lewisrah','t07.71364@gmail.com',NULL,'$2y$10$eHyzA2AduW9Fq1JIkvDFCe4a7LF3WGPL8My.uLUIueaCCxYnmJh1y',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-07 02:11:09','2024-06-07 02:11:09','System','muG2u','affiliate'),(207,'* * * Apple iPhone 15 Free: http://toyoracing.com.br/upload/rtxvph.php * * * hs=85349da210d01f13875035b1a83a58b3*','okebepu@merepost.com',NULL,'$2y$10$i9gNeXSKA5N8cSf/hPNKNegnHKoLX6QgkGIInbbthgCO0SboU8.Bm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-08 09:37:23','2024-06-08 09:37:23','System','ASHZM','affiliate'),(208,'Mildredheets','brian.n.amck.e.n.zie.45.9.7@gmail.com',NULL,'$2y$10$389K5PEaN1ZpSipH91vdlOdF4r6dmtiLtfLzqz8AQQrekRgVFwjHm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-08 15:12:55','2024-06-08 15:12:55','System','DFoGf','affiliate'),(209,'WayneCar','c.rysta.l.m.ck.enze.e6.7@gmail.com',NULL,'$2y$10$OYHsjFjXdaCtfCERjlhVr.9JM55R/DEB5cdyDoDlWkYZE4UwM3J4.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-14 07:04:04','2024-06-14 07:04:04','System','FQBVb','affiliate'),(210,'Donaldpumus','ja.s.o.n.m.as.ters.p.a.s@gmail.com',NULL,'$2y$10$tvrj9amVnTiS1pyIuhsHmOy1DyJyohmfDgnGiIJ7XMDiCDc3T5iZO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-17 16:35:07','2024-06-17 16:35:07','System','GzOKg','affiliate'),(211,'JewelMIB','b.r.a.ndy.g.4.0.4@gmail.com',NULL,'$2y$10$vjoSS.gkitRcv8SUkr20jupq/4/qbKrxILpbWnYOXdyuiEWgW2IJW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-20 17:49:26','2024-06-20 17:49:26','System','RPpDw','affiliate'),(212,'MarthaGries','j95.1.50.296@gmail.com',NULL,'$2y$10$GcY06REv1WAnQkBqAtBJEO1LOVDDW50Cl53/tpW2ydzoxvg4TjLsi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-20 20:27:22','2024-06-20 20:27:22','System','4108J','affiliate'),(213,'Louiezom','bucha.n.a.o.nm.att@gmail.com',NULL,'$2y$10$fSSeheyxwdoDgx19Fezu5eocoTNsQeYtwa5heiwqLJNkF7FKF69Kq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-26 13:37:12','2024-06-26 13:37:12','System','h0J8N','affiliate'),(214,'Richardmah','info@sedona-vortex-tours.com',NULL,'$2y$10$PTk6ssTRkrpeXVcjYnfCquw317fi0741jR5iDhqcAdz/J/dfIjTpW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-28 09:47:49','2024-06-28 09:47:49','System','AIOAK','affiliate'),(215,'BerniceBom','c.ry.s.ta.l.nelso.n3.4.45@gmail.com',NULL,'$2y$10$W7rOW6wcM9uN0asxwpqcguoTMd9RN3CzXiM2O75VocPXCresvaJyO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-29 11:12:37','2024-06-29 11:12:37','System','Ux9n5','affiliate'),(216,'Patrick Kofi','taypatrick5@gmail.com',NULL,'$2y$10$8L6wP.OHQqgUbmubHjq2yeu15R4H.8bLVHcJMUCTEZJXZW5lJUrEy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-06-29 11:51:37','2024-06-29 11:51:37','System','yY4uM','affiliate'),(217,'Stevenmic','craig@rockstarseo.net',NULL,'$2y$10$cTah2r00FR7QQ1Ah8kRA2uTef3nktaaSrkWxNEown7vYILbV3Qxt.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-16 20:06:43','2024-07-16 20:06:43','System','aCr4I','affiliate'),(218,'Boafo Benjamin','boafobenjamin73@gmail.com',NULL,'$2y$10$zMFytvUXAAm6lI7483anrutU7KDZxrMs8L.YiCizEouDyzvcA3GUG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-23 00:58:50','2024-07-23 00:58:50','System','wDupP','affiliate'),(219,'Kofi','voyageghana1@gmail.com',NULL,'$2y$10$DtS7KlF0G3P4yHh4V4kKlu8WyKhJsA5v9FdFL8TCzV.qZl89eHqk6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-25 10:58:37','2024-07-25 10:58:37','System','CwL1V','affiliate'),(220,'Francisacelf','s.ammy.m.an.n9.7.6@gmail.com',NULL,'$2y$10$1ISSlEKQhl/fABOfDvsBJemEEaQGql8t78h1ZRl9o6yy3FwQepgwW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-26 19:43:55','2024-07-26 19:43:55','System','QNvlm','affiliate'),(221,'MiguelBab','jill@sedona-vortex-tours.com',NULL,'$2y$10$QsV8LAI.uTCpZcQ4Qae57ezpJXmaVFbqUj.E.9tpmsPs6GplxGq.u',NULL,NULL,NULL,NULL,NULL,NULL,'2024-07-29 09:06:21','2024-07-29 09:06:21','System','glIX7','affiliate'),(222,'Jashley Arensburg','mbziizaum@solid-hamster.skin',NULL,'$2y$10$HTfSNENQI71cRyidbxe2c.nDdF.dGrrIduSDXJFYXyWU2bBjkfqRa',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-09 09:13:12','2024-08-09 09:13:12','System','nUXd8','affiliate'),(223,'Donaldpumus','ja.s.onm.a.s.t.ersp.as@gmail.com',NULL,'$2y$10$mcLgJ61hqc/2bfHSnKMQnevkZQxWL2NjcX5Jc7aq5kFnX.CoZVyGK',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-09 11:55:41','2024-08-09 11:55:41','System','Rmvlg','affiliate'),(224,'Shawntelle Shemansky','zizlbirjum@solid-hamster.skin',NULL,'$2y$10$He95KKc2GQgSDNh/A87ZVeS3IjMIh4S6/NTxwwa5gHIFbVLg6s5PC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-10 14:39:13','2024-08-10 14:39:13','System','V7X3j','affiliate'),(225,'Abigai Margulies','blbrjaabum@solid-hamster.skin',NULL,'$2y$10$jOnyQCSjhtmCWhhnPcuv2ODM81rVF6NAjRSsWLW/aMLg/yn2bdgMu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-13 10:55:57','2024-08-13 10:55:57','System','IiRY2','affiliate'),(226,'LindaVek','re.e.d25.1.6.7@gmail.com',NULL,'$2y$10$gsu3h2YCA71tJx81UcKGWe3bwau2wDoJH8u.UUMdkHqhBlD.sI5bG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-24 09:20:33','2024-08-24 09:20:33','System','1NngB','affiliate'),(227,'The 2us2 11 ltimepropertiesltd.com p5','mitaxebandilis@gmail.com',NULL,'$2y$10$Q/WoTGRazFw.n.5QA.qCHuXtGKDAdkuwTqK4cIedGwoTs7K3H52SW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-27 06:17:11','2024-08-27 06:17:11','System','IzfhW','affiliate'),(228,'Patrick Elom','patrickagbodaze@gmail.com',NULL,'$2y$10$daiUMihPhLr444GcYo4a/uG5Ng31K0BlT4TMNzeELwO9MBDvOSSi.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-27 16:15:30','2024-08-27 16:15:30','System','Avd16','affiliate'),(229,'Carry Abare','zrjiieeimum@solid-hamster.skin',NULL,'$2y$10$nn7JD7lceqtABxZWIV.UQebqYySCFY4VBTc5Rwk93W18kXwB3ScMO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-29 04:01:05','2024-08-29 04:01:05','System','NulLj','affiliate'),(230,'Stevenmic','randy@phoenixseomasters.com',NULL,'$2y$10$g50IPhdXgQYYFyka7xI5zurrIY2o3Rob7.wU9bH4BOD/3n5/tPV0i',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-02 00:55:43','2024-09-02 00:55:43','System','jhX8X','affiliate'),(231,'Gideon','aboagyegideon112@gmail.com',NULL,'$2y$10$5abBBvtlIWuud5XuikrqD.pRcHBFZJzZ6m5qwt41XfpMw4YKlXAMm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-03 08:35:14','2024-09-03 08:35:14','System','yjnOa','affiliate'),(232,'RaymondGriem','rio@rockstarseo.net',NULL,'$2y$10$yn8LlFvreH4TXIfCUJ4aXeXBXhAMqbiHanDXdZrebJZoKKIinuKQq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-04 15:28:53','2024-09-04 15:28:53','System','Fex3J','affiliate'),(233,'JewelMIB','br.and.yg4.04@gmail.com',NULL,'$2y$10$ZjAoW2c3CbbYYKApTWu0P.rzmRvU/I5PQ3tjAHX3vxfETewZnw4w6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-04 17:27:19','2024-09-04 17:27:19','System','SPsDs','affiliate'),(234,'zbMqenMDTHbTN!','IrvingMarino789806099@outlook.com',NULL,'$2y$10$h7Pd3Mr2GpiGAsHNKoIbluWTqRpqyzZq6cDKbktYOWprFd4l6NwVO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-11 05:11:52','2024-09-11 05:11:52','System','GHHpA','affiliate'),(235,'JewelMIB','br.a.ndy.g40.4@gmail.com',NULL,'$2y$10$fIBkBDyQRNjjk1LqkI1U.e7kN328e7PtxdhWfyHwAokxVDwNhZpNC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-22 17:11:47','2024-09-22 17:11:47','System','4GDYs','affiliate'),(236,'MichaelNuh','br.an.don.br.an.dog@gmail.com',NULL,'$2y$10$G3TKBGxwdK/Mi1Wf50lPo.8xom6TWLmlx5235QFRJSaSLik.25dZe',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-23 04:57:48','2024-09-23 04:57:48','System','xXI45','affiliate'),(237,'GYWoHjNhr','lexlexlex18@yahoo.com',NULL,'$2y$10$zlFqiDtS59BY7Xv9PWkkAuyHqh6RtrcVbz4llicSWMC0HBKjtrjeG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-24 05:50:35','2024-09-24 05:50:35','System','k2Qmy','affiliate'),(238,'Betseyemoge','bri.tt.an.ymckenz.ie.333@gmail.com',NULL,'$2y$10$c.TkUBftGICrTVmhYayay.lqRqNHHw0xWHvn6Gx/xYsVMZtfjDyTy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-24 08:52:45','2024-09-24 08:52:45','System','UEbKI','affiliate'),(239,'Ayitey Michael Mario','michaelmarioayitey@gmail.com',NULL,'$2y$10$4AYanqAFq26jk9/m7pNKweIOHj4Pg/t3T2Hgi77up.c.TPHr5mhna',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-02 14:18:11','2024-10-02 14:18:11','System','iYM4Y','affiliate'),(240,'LindaVek','r.e.ed2516.7@gmail.com',NULL,'$2y$10$UtP/unmTbgXKBKQEEFhLQ.rDG31Youa0NUUKWHoX6I4XQ71wZTkP2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-16 18:36:36','2024-10-16 18:36:36','System','fKTtE','affiliate'),(241,'aCtNadSeoLI','trushx41@gmail.com',NULL,'$2y$10$LhM2JxgY71Jwj0DaLnPIo.iK.0aL6oJh7s4E6zoP0qvTS/3LQp57e',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-18 06:16:54','2024-10-18 06:16:54','System','emqC6','affiliate'),(242,'Arisha5sn','5@arianabymishel.fun',NULL,'$2y$10$zAdhAf.a7sp9lzWTErTsceQbJDiVWCz/bDBkz7ssl.c/ARgwb1W0G',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-22 12:21:32','2024-10-22 12:21:32','System','US3Ng','affiliate'),(243,'lalendi_mtOa','ulgkybjhpOa@domhost.website',NULL,'$2y$10$o8DLyzEjCAf8ua8eZEBXI..ROkNv4ICaMm8vupsmUiSPXELBEAp3O',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-24 23:55:31','2024-10-24 23:55:31','System','8oZWZ','affiliate'),(244,'uNKIxjDijByc','bkassandraos30@gmail.com',NULL,'$2y$10$Yj2PnhpB0aFxRLtUWf83Du9l00TTYpvq37LHt5N8t6skTqBcuStD6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-25 22:46:27','2024-10-25 22:46:27','System','r2Shw','affiliate'),(245,'Louiezom','buc.ha.nao.n.matt@gmail.com',NULL,'$2y$10$Lvs8MMEJM6F4jpXNkbXPkejHK4AJGQ1qgpPK4M.CFt/FXa02XSJPW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-30 23:55:44','2024-10-30 23:55:44','System','0lVgb','affiliate'),(246,'lalendi_waOa','ozxgyuituOa@domhost.website',NULL,'$2y$10$D4n44p0GXi.BMUVoyM9zhOV.f7A3C/nXMWhgDObFMojwNS.rcZq5y',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-02 09:23:35','2024-11-02 09:23:35','System','nNSOX','affiliate'),(247,'MLrzDecBprJE','muerandik720@gmail.com',NULL,'$2y$10$7nhWuIcxdcQfBGxj4Ixr7.OQoZJyePb3lBRSzcHJFDY45hHCXZKuG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-04 10:13:18','2024-11-04 10:13:18','System','z8XtV','affiliate'),(248,'BCphfOQGSXdBdpc','v2enued8hsvy@yahoo.com',NULL,'$2y$10$owdaJvbrUjPjIS2i4IJ3quPAnaBU4u/I0n6oTib0BaHJwacIa3EQm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-08 01:59:14','2024-11-08 01:59:14','System','fhDEO','affiliate'),(249,'gRHuQjqHgBLJbSh','meritdrn876@gmail.com',NULL,'$2y$10$211HHsc/u9NWt.p5wUE1he2vQZMM7Ha2lS7OP.wt7NvSebuhtbuV2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-08 23:59:17','2024-11-08 23:59:17','System','FOVnm','affiliate'),(250,'uwpAtzCJo','farleiex45@gmail.com',NULL,'$2y$10$CbUnLzrm8AHxVgzLua49..10ka0FSIGqtLetLEhK6T4BEpnu3HXTu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-09 18:35:48','2024-11-09 18:35:48','System','ZFJRL','affiliate'),(251,'lalendi_ikOa','lrgaizswfOa@domhost.website',NULL,'$2y$10$wM/2AbZe0ZXZ2q7KP7QJMe8cCXMgQdpzKjXWGpgukIgCqoTQ62/A2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-09 19:24:48','2024-11-09 19:24:48','System','YJUa6','affiliate'),(252,'PvwlCSpvvvFv','xscyngjkr@yahoo.com',NULL,'$2y$10$UG1S9/JYLyhiuqurZtXVue7qpDL65p8OB011HDM.1cXric5K4bOpO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-10 11:21:33','2024-11-10 11:21:33','System','6J4B4','affiliate'),(253,'smSLFltsDs','ublylgteudbyllm@yahoo.com',NULL,'$2y$10$DWttPabDO4TWnYqI9pQnAOWriy9HJVjUejCUkDG9LahCJ7eFEigoq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-11 04:34:29','2024-11-11 04:34:29','System','2nJ7e','affiliate'),(254,'Bula dinor 000x ltimepropertiesltd.com Ee','mitax.ebandilis@gmail.com',NULL,'$2y$10$oERAnNwcE6J6Y8NzR0GcFusau2Ij3PSV.Z8iHpCOpcgsAtAY.hmum',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-11 05:18:51','2024-11-11 05:18:51','System','YsFSl','affiliate'),(255,'iBOpHprZ','stoddertounissoux@yahoo.com',NULL,'$2y$10$mJppqvHbV6DA4YfP2P/x1u3vuXTW4vEYg7/8xSwNFQfOJQfz2oUnW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-12 00:05:59','2024-11-12 00:05:59','System','mSj5h','affiliate'),(256,'Michaelodomo','kris@phoenixseo-az.com',NULL,'$2y$10$Y37LIVxOqkbR8eoYmWTaiOtoI7KpgrA0bsWkTKjX42iE0aUI1JI5i',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-12 02:49:37','2024-11-12 02:49:37','System','bgh0O','affiliate'),(257,'szQMNNfWsAoQ','tstokesu6765@gmail.com',NULL,'$2y$10$pRcZ6rYtJEeVMHiYriqMNuyR.S3AvRAJEJAOnctx6kYQOmASg32hK',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-12 21:50:37','2024-11-12 21:50:37','System','LnAHD','affiliate'),(258,'KJkwxxzXbDkPZIM','chaseelsdon@gmail.com',NULL,'$2y$10$tjhUM271PWcFozIj55KfAO03hSqSDqTXZgxAr9fdNH.cWtaV0hvDm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-14 16:08:29','2024-11-14 16:08:29','System','F1v3w','affiliate'),(259,'oDndCIfuuyB','kollilawsond@gmail.com',NULL,'$2y$10$eqOZwa54.tkYEgDUeljHzeQf.wPf8/tVd1azNB3f3nASgcM2Chb2G',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-15 12:34:03','2024-11-15 12:34:03','System','XNdxe','affiliate'),(260,'MbZGLaNlkyzMas','dario.1955@yahoo.com',NULL,'$2y$10$xGmcQeVyYTFdiw4Cruo3G..q5yMUZWuQrGqVwVpsVhk0nHPf.il72',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-16 09:49:10','2024-11-16 09:49:10','System','wt8Cj','affiliate'),(261,'KmbNHbSWsnzu','kdjeriov@gmail.com',NULL,'$2y$10$L5KivXRz3ogbp8qRWSUDoO/hEqAGWbSy6HzAeqNwdvO4Wkw0WGppu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-17 17:43:44','2024-11-17 17:43:44','System','iBIFh','affiliate'),(262,'jAnnyswTCWoWE','srgmhouy1hul9x@yahoo.com',NULL,'$2y$10$tnsypdWCj07OUuHB4YN.N.aZsm2twX.gFiJO1HmjsXhVdUx9veqM.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-17 18:41:31','2024-11-17 18:41:31','System','cKicz','affiliate'),(263,'gtbiiTuluKai','myerslyanneff@gmail.com',NULL,'$2y$10$sGrgvTZQKdtFZmCqTUNDTe.XTBezmK5IVYDu3gKLqk2AJQIZX62ci',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-18 15:15:15','2024-11-18 15:15:15','System','uthyL','affiliate'),(264,'MRlppgeoUlIrxaF','sheltonguzmane49@gmail.com',NULL,'$2y$10$sAMhtukqAzjSrP3z/MLm3OvdNMcB/Ubk7bMKYg7ZxdJvZ9ZmQR4Fi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-21 23:53:57','2024-11-21 23:53:57','System','QJsXd','affiliate'),(265,'lQkuGNStm','murrelliory@yahoo.com',NULL,'$2y$10$TOrAwsUQ21RpXpq6IXV7GOrkTG2sDgaFjFLq/jnNgza29Fg3XXjFq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-23 23:00:17','2024-11-23 23:00:17','System','6Eghq','affiliate'),(266,'jyWudzUXH','matthewsabbigeilg1983@gmail.com',NULL,'$2y$10$ahaUZ8wFCn8W41O4MAhIMueSi4nEnzecSyuDTKQQkb40tikpcwvSi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-24 18:55:47','2024-11-24 18:55:47','System','9UjMS','affiliate'),(267,'xJFLYlmloX','wfshuwvarg@yahoo.com',NULL,'$2y$10$d6McmT.ABiVgw.oDZsAhxOy/GsmCNwKyjocjkybJ4RdQyMxzZaWVq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-24 18:59:15','2024-11-24 18:59:15','System','Gh8xS','affiliate'),(268,'adminxps','budaklzcrew@gmail.com',NULL,'$2y$10$KtXeKtohp1ecbT0d/nmmPuERRtCD0KBlDno2uZzRjLyxyXq/64bmm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-24 23:03:04','2024-11-24 23:03:04','System','QRlNd','affiliate'),(269,'QqbEeZDBRTE','ildredyk@gmail.com',NULL,'$2y$10$SqMB/bpsZhd.TIMbhsieTuAyE3e2SWylofeGXCFbKoAEessovVAAC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-25 16:23:38','2024-11-25 16:23:38','System','JEXO3','affiliate'),(270,'XkQtwNWVGU','maynardmabel2002@gmail.com',NULL,'$2y$10$h462QVZB0V2MODla35EZge6BLTDlMDoIMuASDYmXvz.s4Pk2qfDUi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-26 14:40:11','2024-11-26 14:40:11','System','sMLxl','affiliate'),(271,'bTvjFuxzC','kerolhendricksg1987@gmail.com',NULL,'$2y$10$gcPhR66eKxz2SUq3WN7Ibeev3IO5ExPPaXK2GnD05gHT5tOy6jLKa',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-28 12:44:17','2024-11-28 12:44:17','System','Ls5jJ','affiliate'),(272,'QNaSBKlK','d1pfgodueg5y@yahoo.com',NULL,'$2y$10$6nKAVtUR4xbkArr1iUNvdOd9uGhXEeg5hvJw9R1o3EPn8nbUuYJR.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-29 07:36:41','2024-11-29 07:36:41','System','fuEOD','affiliate'),(273,'TAuXzEdBko','fhrkbci7zs4gopd@yahoo.com',NULL,'$2y$10$H3defyUlufZMR4OnUk.aUegKkYoTFfVL.Hc8MHHqj9h5mKn5LouRO',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-30 02:21:58','2024-11-30 02:21:58','System','tUAh9','affiliate'),(274,'AjenTMNp','gpqbtc6nqou9g3slu@yahoo.com',NULL,'$2y$10$qEpps1lVD5sV3lL1aVcLJ.8ddn6IF0DbjZgWlpZBdscKmyJiU17jC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-30 21:09:24','2024-11-30 21:09:24','System','3Pmbk','affiliate'),(275,'VAJZCwzanzLj','sdoxbjxxyinlpotd@yahoo.com',NULL,'$2y$10$g50IZ0Q6url4WdTkcXWtsupM/E/t2NcjJc89Eo6dVv8CXfkcAmaxG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-01 15:10:31','2024-12-01 15:10:31','System','Fu9WE','affiliate'),(276,'NFCdfvKxLnFtrL','bd52bncggxqweb@yahoo.com',NULL,'$2y$10$7gPQ/tEjEjIHmFHV834YvOcozOQIHoFAxw5c7BaaVqHSeRenKVbqy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-02 07:22:54','2024-12-02 07:22:54','System','DdkYA','affiliate'),(277,'Nfejdekofhofjwdoe jirekdwjfreohogjkerwkrj rekwlrkfekjgoperrkfoek ojeopkfwkferjgiejfwk okfepjfgrihgoiejfklegjroi jeiokferfekfrjgiorjofeko jeoighirhgioejfoekforjgijriogjeo foefojeigjrigklej jkrjfkrejgkrhglrlrk ltimepropertiesltd.com','yasen.krasen.13+98649@mail.ru',NULL,'$2y$10$yRXAyH6.nkNhRXMCs1dQbuhgNRcuj/QBLsHgpRwdKHUQnLxwDAF.C',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-02 10:39:02','2024-12-02 10:39:02','System','8uV41','affiliate'),(278,'ueztDEmVDm','dwrvnynubnq@yahoo.com',NULL,'$2y$10$A3QBv0MFZ9fG7G7ZASgsfeeXguBT0mIeTCBVg7d8is1Ey51NQ.DSa',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-03 01:55:28','2024-12-03 01:55:28','System','1O848','affiliate'),(279,'uvtcpnEY','nhejkyxnu@yahoo.com',NULL,'$2y$10$TDXNCtXhaCFTd.gGKUE0ueddSbigexyUHdYgt3z2.lDWANo7ZHC3u',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-03 20:17:46','2024-12-03 20:17:46','System','YiKl8','affiliate'),(280,'Louiezom','buc.ha.naon.ma.tt@gmail.com',NULL,'$2y$10$FcM7jP6Z22Fi1tUj9Zwo2eCyBquM5YL4nfy9X1q2j5pZePFpTVh26',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-04 15:01:54','2024-12-04 15:01:54','System','TjMe0','affiliate'),(281,'qAbYCSIeJz','isticworoys@yahoo.com',NULL,'$2y$10$rQCLZCuFZ2HK9vpTh6vnLuNfu/c4.ioEWLnnQ9Kzo0wdFCYxiT4nW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-05 05:24:02','2024-12-05 05:24:02','System','CtnaV','affiliate'),(282,'lqXvqCpK','mcculbraie957@gmail.com',NULL,'$2y$10$sSICyOvYKjsSsltIioc5guZ0THVbmXSCW.R6sMGah9rbVs.Tyw9ym',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-06 01:20:06','2024-12-06 01:20:06','System','WZYG9','affiliate'),(283,'qWIfXRzF','tempestuwraith81ia@gmail.com',NULL,'$2y$10$Ye/ia/MELjleuzV1TxVKquVtjEPBjl.jXOatG/BzMcPIvY9PRSNfS',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-06 20:19:35','2024-12-06 20:19:35','System','PW1cv','affiliate'),(284,'pPjbtTOvDyJReV','uilslfshlncj@yahoo.com',NULL,'$2y$10$VLsaKfUH7WodnoukZZgctOcgDlD3hm4BlDWlDiYBDtb3dVhzVv.mq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-08 07:49:04','2024-12-08 07:49:04','System','WcLmq','affiliate'),(285,'XgZmqMsg','osrrekdebl@yahoo.com',NULL,'$2y$10$2SX2TeJReQTO4F/Q/p2gneBkayQ6tUqbK24YX.OySc.nTy1RbYzou',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-09 01:19:26','2024-12-09 01:19:26','System','IPmbM','affiliate'),(286,'vaNGBJpAMXRno','xcqiqlvsg@yahoo.com',NULL,'$2y$10$e/2At8CmWkPh2DclZ7skQOumwajKcHDd0dYe7ZtsDWwfm5hcrUaQe',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-10 02:16:19','2024-12-10 02:16:19','System','lwyAB','affiliate'),(287,'Sandraraink','da.v.idli.n.esman@gmail.com',NULL,'$2y$10$lbsGEsGf15jAoEFkzxbgveMtCl4ebt5Mg/wkwYEQwy.kp4/RMTQ.K',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-10 16:25:19','2024-12-10 16:25:19','System','HOfzG','affiliate'),(288,'vNSYDXSQFSuz','kgkcuacfwpkbtk@yahoo.com',NULL,'$2y$10$397bAUWuLLeLs7BOPGPLCunTBUELaScaC8vRyIBCd1AV9k3W6.SMW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-11 03:34:11','2024-12-11 03:34:11','System','pSVrI','affiliate'),(289,'FqteDodH','sinheranle30@gmail.com',NULL,'$2y$10$kNVupGKamrbFh7RRTqLqmuq9vJpswpIsGm6jWpT00XNBVwC8aSLSG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-12 07:33:04','2024-12-12 07:33:04','System','9PKc0','affiliate'),(290,'Luk mito *0101 ltimepropertiesltd.com Pz','m.itaxebandilis@gmail.com',NULL,'$2y$10$Kv3m/CaVxip4hjdml0aLbuMwcsVHIsABw7ILyqMGnk0y3Df8SzqZ.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-12 07:53:00','2024-12-12 07:53:00','System','y9yux','affiliate'),(291,'Henrycrink','jonthede.f.e.nder@gmail.com',NULL,'$2y$10$CGHUxxyMxMj1PS0FitKAAeKbGJrGHiArF9AN2/ljW8JcxjZvZ7VUC',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-13 08:29:38','2024-12-13 08:29:38','System','GESwi','affiliate'),(292,'CCuWtrgtFCB','fowlermeibellb2006@gmail.com',NULL,'$2y$10$BLoUFFxuto0t9i7YdQQyUOdj/Qw7V9EcZI4/Dgv588Xd0EsnwdF12',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-13 10:55:15','2024-12-13 10:55:15','System','o4zdz','affiliate'),(293,'* * * Unlock Free Spins Today: https://rweee.com/upload/x8ps5t.php?s9ghgw * * * hs=85349da210d01f13875035b1a83a58b3*','pazapz@mailbox.in.ua',NULL,'$2y$10$VDaZYXbWxeUxHO9hivARz.5P6HUu.iGNMxSCQDbnjQuTZ8ONpMDjm',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-14 00:49:17','2024-12-14 00:49:17','System','9uDsu','affiliate'),(294,'RTVUopJWSWwQRz','ytdkhhfqsbshyl@yahoo.com',NULL,'$2y$10$wvWqaHjl5QpC9zeSuFTZn.p5DuDL8j5HoyO4A84rBJDTwtnwQDJ6W',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-14 10:00:49','2024-12-14 10:00:49','System','7fDwG','affiliate'),(295,'FzirFoeoH','mbayersnubed@yahoo.com',NULL,'$2y$10$lC7JZdQumxwyh7EIye5gJux8.cP7WnWExpTDu7BhB/fnUwy.MgP3y',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-15 05:33:37','2024-12-15 05:33:37','System','5gktL','affiliate'),(296,'IojGTklNIWgQLA','vpgoeuiuyvhkna@yahoo.com',NULL,'$2y$10$R2TX1qFS2kbKl1J.rl75Gu.CFbQQzBAs2tIEBm/tfc70rVoAs2HC6',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-16 04:19:32','2024-12-16 04:19:32','System','r5gvT','affiliate'),(297,'fxwZhqtHmQLVld','soraselo426@gmail.com',NULL,'$2y$10$6Aa5mTPax6O9T/jOve/3hu9HlbDzjHZLGZr4dKEKP.4VzGKudtEeG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-18 13:29:28','2024-12-18 13:29:28','System','iVbco','affiliate'),(298,'nJAjXmHStZDGbJ','gosegita644@gmail.com',NULL,'$2y$10$Xc4k.PCyJ3GLFyIiBmEFeue7StIUPTmCaIq3JLki.0kUt5orwKEb2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-19 13:54:44','2024-12-19 13:54:44','System','CnEHa','affiliate'),(299,'DoydCDEqY','rietfrank@yahoo.com',NULL,'$2y$10$ip4cMebbUipm/W5WR/Gjz.NQLTRTUn0ZHGyowJUFyKCPGc9wAlWPi',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-20 13:20:39','2024-12-20 13:20:39','System','75zFl','affiliate'),(300,'ytVLgwDAYXupY','gtwr10s2x8t8v5p4p@yahoo.com',NULL,'$2y$10$HkO1V5m.6Kx5pVgR2Yx/GeA6j4zanJd3J9tMuET9G34pfIDIrO7Tq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-21 10:02:22','2024-12-21 10:02:22','System','KYF07','affiliate'),(301,'watgAcKruotbeN','ceyopojopah23@gmail.com',NULL,'$2y$10$ZgA31f6kIpsnhxoJqDdCBeO2E3gpU1jM0.EVeWWQcEdZzD6QqAkMy',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-22 05:22:16','2024-12-22 05:22:16','System','S6zax','affiliate'),(302,'yVZgvLbnolPi','andelkowienbart@yahoo.com',NULL,'$2y$10$irJU9oTuOUVW.3q43jqB.ugf8CniUcM6l4Yuf0UgmrBYm4FFBK/MW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-22 23:59:50','2024-12-22 23:59:50','System','YCh3W','affiliate'),(303,'rtvwuerRWjvvFzy','ayasanomuce98@gmail.com',NULL,'$2y$10$1ZKUCdK54vdoeDzhPp9DDObdo4Rcvc5pwfpuHRU86b7DFtjsS3YqG',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-23 20:43:58','2024-12-23 20:43:58','System','DmsAJ','affiliate'),(304,'CqrHKxVg','jivagukinul924@gmail.com',NULL,'$2y$10$D7naEcZ7vQG.zICxUpbHC.pqXAbWC9M0N0wlPcz1tr2J6ohY8QyG.',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-24 22:47:58','2024-12-24 22:47:58','System','0DPSr','affiliate'),(305,'XDSNDbkqOx','xbb57mhue@yahoo.com',NULL,'$2y$10$SzJONrPS2r/yagmcgM4Cuu/gvZnCzE0H50ay0KOEPawbP9d18T3Yq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-25 18:21:16','2024-12-25 18:21:16','System','UYf6I','affiliate'),(306,'mjkWOPqJbpXapuQ','fnrwknmngeaph@yahoo.com',NULL,'$2y$10$x91/DcnyIN9F2BXw1MhVruTFiuscPCevxpVA3LhzRiI7NsPfITVWq',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-26 13:21:24','2024-12-26 13:21:24','System','ATYCQ','affiliate'),(307,'vsLXHvqLiT','mqrpekouvu@yahoo.com',NULL,'$2y$10$QQXENAAVjVZ2coq5NEa5WOR4.D6pXsnZp/hlpON2DS1t0aByrsUH2',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-27 14:18:28','2024-12-27 14:18:28','System','vD7o0','affiliate'),(308,'LXFWArFbBNl','giwilimubos354@gmail.com',NULL,'$2y$10$PB/qq9hitXj8VreDH.59TezhDd91szrKFLHpkgzAAHZuIgO2twmgW',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-30 08:13:19','2024-12-30 08:13:19','System','mLkFi','affiliate'),(309,'WahSJQZcNNLIWaF','keravit327@gmail.com',NULL,'$2y$10$a6.sYilxOrhbyF0iXigUb.Kq7N0UEeOpNWF9.jyTjXi0P9y8XTfmu',NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-31 04:59:49','2024-12-31 04:59:49','System','lanAq','affiliate'),(310,'hzdfkbUlD','ms9bq6th1ple@yahoo.com',NULL,'$2y$10$dT.ZKIbrmbx/qB/e76Ex1OsjS6B.N05YprruRwcwJjLkbyjudHPCy',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-01 16:13:41','2025-01-01 16:13:41','System','p3SUV','affiliate'),(311,'TBKBHIRFIQkGTr','rehemej772@gmail.com',NULL,'$2y$10$ntFXteP8H2FWAh5Poa3TyOK/JylSCrlzQLeIlqr4VzPrWOY7o9GKe',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-02 09:26:11','2025-01-02 09:26:11','System','KZ4US','affiliate'),(312,'qKOjCNoNfwJGy','pwi9al1aahvq2k@yahoo.com',NULL,'$2y$10$ZJ0DUmqP6OYUoJFBFx.ZHeF9XzofQZsKDc8xHNLqe7g5at1qOsAcG',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-03 06:18:10','2025-01-03 06:18:10','System','T4VFU','affiliate'),(313,'hXBueOaQaTQlz','ernlaammiro@yahoo.com',NULL,'$2y$10$H9L.RxwBnJFztgdhFDPJZOshsVG.4WiAYP6RnCkURZpGgLZsDnBp6',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-04 05:42:06','2025-01-04 05:42:06','System','BIdB8','affiliate'),(314,'xByWkpKJRXVtwq','sexulohuto11@gmail.com',NULL,'$2y$10$DUajx8okkKLCacLpWyuV7uQQ8dtRUx6YD93dkGnadpWeWNnm4ab12',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-06 11:16:59','2025-01-06 11:16:59','System','FB3Xa','affiliate'),(315,'BdcvFEiFJuKdDxk','oqeyolovub713@gmail.com',NULL,'$2y$10$KmXgExJeDdQaCtVfQxXO2euJpyDJNtMVs1J3l2oahz0vv1ojV0gee',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 13:06:59','2025-01-07 13:06:59','System','6iRdL','affiliate'),(316,'MartinWal','j.9.7.84.25.90@gmail.com',NULL,'$2y$10$ud3AARpCIwafnQFu9o05IOm.biGq/gkLr3jM3rhW35ltr4Rs1YVbi',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-07 13:21:58','2025-01-07 13:21:58','System','iUZYH','affiliate'),(317,'MSfViVXRH','alimilemer573@gmail.com',NULL,'$2y$10$ldNeEuY/JozLs/1pJGHezOhC7qCEfBCfC8YQ1TMmudytkHZlGeek.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-08 13:50:58','2025-01-08 13:50:58','System','llU6o','affiliate'),(318,'SlwTgZucPBjp','mqqvopz3haoejj@yahoo.com',NULL,'$2y$10$BoNYBNQKhuVcCfzf8GqsHOetgsxI5zUeg1m/p7YYvDaVVLnSwtjRC',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-09 19:15:52','2025-01-09 19:15:52','System','ZifFj','affiliate'),(319,'Chancellor Ansu Adjei','kofiansu001@gmail.com',NULL,'$2y$10$kOstE4mhi1cngbrWbgJShugUZV0q1oThLWvFKRTWV5jRkuV2p8pQ.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-10 10:53:25','2025-01-10 10:53:25','System','Wwp2N','affiliate'),(320,'aSDKsfOGbpO','axonequq856@gmail.com',NULL,'$2y$10$nudjK2CNDvsE4iz5R7blxeUUJ2.yamKM/6qHjPxUeC9QAI2pGVkD.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-10 16:49:27','2025-01-10 16:49:27','System','MaOiW','affiliate'),(321,'VGkMzMdFVuxec','glytsisfleeti@yahoo.com',NULL,'$2y$10$Sbe0Q5nvjFoPfSY1iqQmdecXk/G4QLZxB/H00QX3jvo7zvVLw9G3K',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-11 14:50:53','2025-01-11 14:50:53','System','GlEWx','affiliate'),(322,'RonaldReenO','d.a.nnyd.a.ni.e.l.s0007@gmail.com',NULL,'$2y$10$U6Yw9080i3eNTJb2wAIQKuP4lOSsOGtX.a6i1rBu1Y./EzBeB5JZW',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-12 14:12:24','2025-01-12 14:12:24','System','WqeZN','affiliate'),(323,'ySsBpWtebHguw','ubikegevi18@gmail.com',NULL,'$2y$10$Q0pHFcha3ul/XxE.0S0fPuwmDVIaNvoakLjmPDv1.vsmI5xMP/4f6',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-12 17:15:33','2025-01-12 17:15:33','System','LZRm1','affiliate'),(324,'qkycjJWaKfaToXO','qqxi4uytdpr@yahoo.com',NULL,'$2y$10$DZVmhUn17A8OJ918udU9OeEsDSf13B0yZPKnLIgzg45M0nS8A.fE2',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-14 02:46:16','2025-01-14 02:46:16','System','8auJf','affiliate'),(325,'kLUEZvoKBoCSiKY','wekclfqfgmgngcvo@yahoo.com',NULL,'$2y$10$TYtrw/5cu5LGD9YFVVet6.BlbnoCJDkpHZ85YukGfA4IwA0RipWHa',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-15 11:45:38','2025-01-15 11:45:38','System','198uQ','affiliate'),(326,'MartinWal','j97.84.259.0@gmail.com',NULL,'$2y$10$PR6kHWMRR2aSvUoiDlBt6eU0aGw82Od6zIPYXdYVsN4ZwSoOm6zDG',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-16 11:29:21','2025-01-16 11:29:21','System','xpfTI','affiliate'),(327,'XVCxqABQk','dixozarud99@gmail.com',NULL,'$2y$10$c/EIztYilgtEH1HfyC96QOMfFKPqcc3t2C4n47TPH0hp/veWPlCWO',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-18 06:39:26','2025-01-18 06:39:26','System','NtrWH','affiliate'),(328,'jNWDDydTPia','wcbmivucjpxlw@yahoo.com',NULL,'$2y$10$t5cCjq6rdwOxEt/HETHL4eoPm3HbRuPrO4hVLOel/x9FlN6yEThrO',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-19 03:50:34','2025-01-19 03:50:34','System','gPJya','affiliate'),(329,'JHobrrPl','ouphantomeo30rift@gmail.com',NULL,'$2y$10$CiIxkWQtndnT00A9CQozd.Pzw70i4k4ecXZpK8JN2/5hywiJvdbyC',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-20 01:00:31','2025-01-20 01:00:31','System','DlNzd','affiliate'),(330,'mPjZfWRqWjBqXKX','xm1tcd00w@yahoo.com',NULL,'$2y$10$cRh/xixwJaFhjLlgI0I68.yQu6EN3ncYeDU6ehVKOFVKm5k5L2yi6',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-21 02:12:16','2025-01-21 02:12:16','System','doqMz','affiliate'),(331,'Henrycrink','jont.h.e.de.fe.nder@gmail.com',NULL,'$2y$10$G.i6ruOf.Mp0gDY1s2dFJunBbIKufTTxgxmpILO/PDIca.Ben1eJu',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-21 21:01:58','2025-01-21 21:01:58','System','lzPXp','affiliate'),(332,'MiguelBab','ba.u.e.r.bra.d.ba.u.er.1.st@gmail.com',NULL,'$2y$10$9Gm0AUOMNTFvzSkFjqmE4uwh9DnLXeauluCLyMzfhuUq8twTXej3u',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-22 01:34:49','2025-01-22 01:34:49','System','NTl6c','affiliate'),(333,'kUrfJAxQAn','Melinda4James3853@gmail.com',NULL,'$2y$10$ppssS6/T0/5fbZMjxYeE/Ot.nU1Zx0wzwBAbm1lejwQ1tzm.I2qQq',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-22 13:07:27','2025-01-22 13:07:27','System','uJYze','affiliate'),(334,'Stevenmic','j28.5.6.9.98@gmail.com',NULL,'$2y$10$lN44qsw3/XeSl0bQENqLyuTXNWGY0IojrRaUfEqXU9Y8Iq1UQX72u',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-23 11:47:11','2025-01-23 11:47:11','System','ejLLV','affiliate'),(335,'avdmnPmxxzyo','dnmj9ey3uunngk@yahoo.com',NULL,'$2y$10$GCBErzkp3WBaSrnzY6mE1O309Q8euMsJpocudOtY97ozu/pAoxSra',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-24 07:09:21','2025-01-24 07:09:21','System','O4xLJ','affiliate'),(336,'EaUoLoblkhkO','Arnold8Ellington6503@gmail.com',NULL,'$2y$10$VFVbtL6EhDLGcNyS3G5K/el1VYKimj9AWcNLYZNBLc1wfesaMHLa.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-25 12:59:46','2025-01-25 12:59:46','System','c2zeR','affiliate'),(337,'Henrycrink','jon.t.h.ed.e.fender@gmail.com',NULL,'$2y$10$EwnDoGbP7ikLjTQB66eN9uJchPvaecDZWTc6o0BvK1HNczAZv6w.u',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-25 20:05:49','2025-01-25 20:05:49','System','DACjY','affiliate'),(338,'Stevenmic','j2.856.9.98@gmail.com',NULL,'$2y$10$KgE9FBgj4qwX31npNkCuXudx.L9baglvnGeND1tfSNo2eonEXW.3a',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-26 13:10:00','2025-01-26 13:10:00','System','9eYOp','affiliate'),(339,'XOOdefqkD','Rosetta2Cole2408@gmail.com',NULL,'$2y$10$4LTXIoNJef0d6Sgom2TIKObD9ZRGj/VZ53Gtw80TDt..3jKwj0nx.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-27 09:00:46','2025-01-27 09:00:46','System','Sbfqa','affiliate'),(340,'JasonDon','maximo@apacheodyssey.com',NULL,'$2y$10$HwUk7hnpOOdqcMItz7egtOtGaqA2.usyeaTQ1yl5ZJ2YEJoixxFiW',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 00:29:07','2025-01-30 00:29:07','System','Dmbtg','affiliate'),(341,'wNEUtujMegNmSf','minsterfieros@yahoo.com',NULL,'$2y$10$zs3p5yWxpOMjtjstpjqyV.4PW2AHCkHE6wPVT7q5aI9SlWd/ab0Ei',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 02:56:23','2025-01-30 02:56:23','System','M15Ac','affiliate'),(342,'Louiezom','b.u.c.h.a.n.aon.matt@gmail.com',NULL,'$2y$10$f63dmKJy5rz1Wov4XiG6teIjAVqucoKCEnyb5v49pBUOt3mqJsWey',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-30 21:32:07','2025-01-30 21:32:07','System','UcqqV','affiliate'),(343,'jhCfKurPvvLm','Bryden8Ayrton5951@gmail.com',NULL,'$2y$10$8vkuviIT2LHioTsa5gbIvuEFoIraAsfZNbIxtmbxWpueCT6JXK8dC',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-31 07:38:38','2025-01-31 07:38:38','System','Lda7v','affiliate'),(344,'KarenNex','j.a.me.swo.o.dsii.i.iv@gmail.com',NULL,'$2y$10$2o5tdp.zA.U2w4vYykKh0.ph5LuPEC.O21BHpchCbXDubTbvQPp9a',NULL,NULL,NULL,NULL,NULL,NULL,'2025-01-31 12:50:35','2025-01-31 12:50:35','System','Cc3K7','affiliate'),(345,'sVTRlgJs','rnpdgqjjrambjufkk@yahoo.com',NULL,'$2y$10$Y9TzFCMX7Xf8vmCghSHMwO2Wtk3BIeuaEvloKrK6vzN/WyfNMxgVm',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-01 13:34:28','2025-02-01 13:34:28','System','rPsn2','affiliate'),(346,'EQOTyRJkdaJCJv','ezocequye60@gmail.com',NULL,'$2y$10$XvcVvEenJTa7c3JzCVjol.2e/coD6k4w2wyGnJtm6jpeOPQ0bEFaq',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-02 10:36:33','2025-02-02 10:36:33','System','xCgsA','affiliate'),(347,'OVkKmnhFYud','mementooyfrost@gmail.com',NULL,'$2y$10$T2MxYpoE31UwUoyzVsq2HeE8p23b5jZ5i8rf5/OYQ/MwPol6c/Yjq',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-03 09:14:38','2025-02-03 09:14:38','System','zGlgU','affiliate'),(348,'XbEvSQFW','auobsidianeaglyphua@gmail.com',NULL,'$2y$10$Cv6RWMPTUveU/HmQPIeh6OVMj0qBdEMbX62Hu9Eb/hkuUpFgGn2Ny',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-04 10:47:01','2025-02-04 10:47:01','System','zdCkn','affiliate'),(349,'pMdjujpO','irphrsncuqnn@yahoo.com',NULL,'$2y$10$hKjtbky/JPhi9ZW991g8KuLzdoILrJS7tCD0icSimR218clU4RjsO',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-05 11:11:22','2025-02-05 11:11:22','System','PDph4','affiliate'),(350,'wDbjMWjTut','illuminateoo25wraith@gmail.com',NULL,'$2y$10$WMuoJLWdS4xLZrJ8ppa61e74wukklDAGXgx0BW8wG.ak8Kfj4hw5m',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-06 11:36:37','2025-02-06 11:36:37','System','gMYBn','affiliate'),(351,'TOTiPNylr','fablee83pinnacleuo@gmail.com',NULL,'$2y$10$aHv03N0lmpS6lQrNi3GcBuMhtUiXvMxkbRTRevrqzgSWcWfs12LrO',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-07 09:12:50','2025-02-07 09:12:50','System','yRmta','affiliate'),(352,'Colaper top *987 ltimepropertiesltd.com cj','mita.xebandilis@gmail.com',NULL,'$2y$10$0toxtMjgrTEZIzWXgPzmh.4Ut4EVV8fDTpAJjV0oXixEo0NGiwgXW',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-07 16:02:27','2025-02-07 16:02:27','System','R1cdx','affiliate'),(353,'rVStWDGihe','iaquiverey40vergeou@gmail.com',NULL,'$2y$10$h/qFYIpITyHD2g1MDal3Meo/m.YNQxVbbgiQxt/Wx3ls0Sxa2RXfi',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-09 06:33:19','2025-02-09 06:33:19','System','tDuja','affiliate'),(354,'Donaldpumus','j.a.so.n.ma.ster.spa.s@gmail.com',NULL,'$2y$10$WdoE4E2qGCv9ADjs3Ffsm./ngVUqyl5gjogUlaZRy6iY5K2QosBiO',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-09 19:34:03','2025-02-09 19:34:03','System','Yr5kJ','affiliate'),(355,'Stevenmic','j.2.8.5.6.998@gmail.com',NULL,'$2y$10$h1TFtv1o8JiYo59cPG8xHuy8ykpdCo.5UTvi8mLIzzYjmzqhdsiaa',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-09 21:08:27','2025-02-09 21:08:27','System','OzNAW','affiliate'),(356,'Edwinlog','ryang.oos.e.man.2@gmail.com',NULL,'$2y$10$jFUytRJy8qZFf3xACdIIwuurlkcK6mxUSyQXFZk.9PMfMbaAdxqMm',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-09 23:27:19','2025-02-09 23:27:19','System','HVnsI','affiliate'),(357,'sbCPDRib','kismetuy52rift64@gmail.com',NULL,'$2y$10$e1j3ldvvitcDl7MCueu3SO3r/nblly4jdzIwf2C6TlxNvqzXypBlK',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-12 06:28:48','2025-02-12 06:28:48','System','CK0dd','affiliate'),(358,'Alfonsotix','like.soso14@gmail.com',NULL,'$2y$10$B92wzK0W8EYUFB/d9G6E/uwqjxna5ky7d9tZ129r.YWrrHj8fZ/..',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-13 01:02:56','2025-02-13 01:02:56','System','HQLUi','affiliate'),(359,'Michaelskync','h.o.l.mes.ste.ph0.6@gmail.com',NULL,'$2y$10$Oublx3DuL/YTyV.TVW31KuPwjdUoUpo7jj4Dh3FP7hqz1Ehq0/XH.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-13 18:05:22','2025-02-13 18:05:22','System','qt5ko','affiliate'),(360,'YEKqZJjHirccB','histromllma@yahoo.com',NULL,'$2y$10$ZjnJBojBrZEUGNXp2tyuceA8QpKZlaUh8E7LgPQHuoWSl9VL.gXcK',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-15 07:24:28','2025-02-15 07:24:28','System','uCtJB','affiliate'),(361,'JgPPIqkk','pettytani@gmail.com',NULL,'$2y$10$CyiqCIaEg2N.tDKl/I1b8ex6ckScIyERzTaaa8NIY2KXt9DpsUz8O',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-16 00:23:22','2025-02-16 00:23:22','System','wZQwQ','affiliate'),(362,'AojhbqzhzrLizk','robinsondilankx@gmail.com',NULL,'$2y$10$.OFIrmX48ELb9hvu9CPJQeLY3GvUzdL1hwVRaXuC6K3HUxKXCsFS6',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-16 15:47:31','2025-02-16 15:47:31','System','nJzS1','affiliate'),(363,'XoPTMcOUeRsnfO','daimondju8@gmail.com',NULL,'$2y$10$Gxrvv1.AoBQtW7dFbfpo..PrJTjJQd9ixsxmo0CG/siE4X1Gv4Iia',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-17 08:36:50','2025-02-17 08:36:50','System','AW5Da','affiliate'),(364,'RUJZFUZUntQmr','p1baxmd7edrvfpw4v@yahoo.com',NULL,'$2y$10$8J6m80Y49VAHhC8c1SN4gORzvIkVvP9b5vhrIAoMxX2MkpJLnIuO.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-18 15:48:37','2025-02-18 15:48:37','System','BU3CS','affiliate'),(365,'QgWDohkUyQZAg','sullivansti2@gmail.com',NULL,'$2y$10$kBj4nVYpBSWPXWjigHkwyeZbGyU6ePEBM3lrQo8nr3/YruHBPWQSe',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-20 02:04:54','2025-02-20 02:04:54','System','3vU3v','affiliate'),(366,'old(\'name\')','hopoogbm@do-not-respond.me',NULL,'$2y$10$sDF2iOb4tW6naI5v3dOTVuY7.Boe85DwiVKhLLlSDrV/7goiToqW.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-20 03:23:01','2025-02-20 03:23:01','System','Z5tXv','affiliate'),(367,'old(\'name\')','dqocogep@do-not-respond.me',NULL,'$2y$10$CeqAjIEA5hWrVIO8VbnLF.sMqf1WKrLHn0f/KPfYv9Z379ijAeQ0u',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-20 06:48:34','2025-02-20 06:48:34','System','n2YEO','affiliate'),(368,'udXGlcais','odhqqvadccxypc@yahoo.com',NULL,'$2y$10$jTVydoptHhFi1yiaG7Nb.e3FAhgUvTfSYCpTzynhASwhwS8ZFUkdO',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-21 01:36:10','2025-02-21 01:36:10','System','xWVQO','affiliate'),(369,'CRsRxkjbqvAPhQ','willpiteruy6@gmail.com',NULL,'$2y$10$h9Q4JjvmEAPa9PtTgXYNxuNe1VJU1exTU5I6nMVgDxYj7AhVzgrgW',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-22 23:04:19','2025-02-22 23:04:19','System','pKgEh','affiliate'),(370,'TuUhSaLHJ','petersenlacira5@gmail.com',NULL,'$2y$10$pO9WI80QSTGZXEVj16JNmOg..uKNerVyP5t7fSdvS/1qSy0GOPuxS',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-23 16:24:00','2025-02-23 16:24:00','System','PAND0','affiliate'),(371,'Wisdom Azaglo','w.carter007@gmail.com',NULL,'$2y$10$TBLorAKJCNiRTff0N1F7mezrqCIf7tsaVwUp/2IzwhM.xc635XRBu',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-24 07:55:17','2025-02-24 07:55:17','System','mQqyI','affiliate'),(372,'QoIWrPGc','connickmtau@yahoo.com',NULL,'$2y$10$Rz.N3K5UAUvXNiFEh3aM3eTpdX2PJ8Dp1TT6kgHTLW3tD/NQ4UL4G',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-24 11:19:04','2025-02-24 11:19:04','System','3v8hP','affiliate'),(373,'dyYrlSATmaj','wnyatnrfagvp@yahoo.com',NULL,'$2y$10$40Bt.PZYz50vVZUuO8A./OadBwr7aCZ8O2I1huv36I59imLFileDa',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-25 11:08:16','2025-02-25 11:08:16','System','or7zd','affiliate'),(374,'BSyEaduv','uunseeniu86kaleidoscope80eo@gmail.com',NULL,'$2y$10$M0YiZq70/GcPr85tmHHpZuuHhhJwpyKon2VYlYXlTYK3lwJFIUMeG',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-26 11:41:21','2025-02-26 11:41:21','System','wBvie','affiliate'),(375,'Miguelsmire','kertyucds@onet.eu',NULL,'$2y$10$sPAWlS7qwEHaaQ04PLyePOpxOu7BmjYc3HZYvAEl77VsKb6yCql0q',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-26 12:41:05','2025-02-26 12:41:05','System','ROJGb','affiliate'),(376,'aXmwiLIwUQirKP','wdampjmftxx@yahoo.com',NULL,'$2y$10$lvHa9x5u9xG0pVF5kgmFGOo5WvvwLbA7REEuZGOsDwRyhUYv.SHW.',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 04:04:30','2025-03-01 04:04:30','System','ZLmCY','affiliate'),(377,'fwhSsDLmi','dlfgyrxphrabsuq@yahoo.com',NULL,'$2y$10$IqCHBuGlY7EQgWVb4yGhredrOy612GUl0ObtmMnijMRqLk0U5vQ1K',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 18:45:35','2025-03-01 18:45:35','System','0eR2f','affiliate');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-02  5:01:19
