/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100126
 Source Host           : localhost:3306
 Source Schema         : nu_fbs

 Target Server Type    : MySQL
 Target Server Version : 100126
 File Encoding         : 65001

 Date: 24/02/2018 15:15:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name_khmer` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_parent` int(11) NULL DEFAULT NULL,
  `category_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_category_name_category_name_khmer_unique`(`category_name`, `category_name_khmer`) USING BTREE,
  UNIQUE INDEX `categories_category_name_unique`(`category_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 98 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Phone & Tablets', 'ទូរស័ព្ទ និង Tablets', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (2, 'Computers & Accessories', 'កុំព្យូទ័រ និង គ្រឿងបន្លាស់', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (3, 'Electronics & Appliances', 'អេឡិចត្រូនិច និង គ្រឿងប្រើប្រាស់', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (4, 'Cars and Vehicles', 'រថយន្ត និង យានយន្ត', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (5, 'House & Lands', 'ផ្ទះ និង ដី', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (6, 'Fashion & Beauty', 'សម្លៀកបំពាក់', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (7, 'Books,Sports & Other', 'សៀវភៅ សំភារះកីឡា និង ផ្សេងៗ', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (8, 'Furniture & Decor', 'គ្រឿងសង្ហារឹម និង ដេគ័រ', NULL, '', NULL, NULL);
INSERT INTO `categories` VALUES (69, 'Phones', 'ទូរស័ព្ទ', 1, '', NULL, NULL);
INSERT INTO `categories` VALUES (70, 'Tablets', 'Tablets', 1, '', NULL, NULL);
INSERT INTO `categories` VALUES (71, 'Phone Accessories', 'គ្រឿងបន្លាស់ទូរស័ព្ទ', 1, '', NULL, NULL);
INSERT INTO `categories` VALUES (72, 'Phone Numbers', 'លេខទូរស័ព្ទ', 1, '', NULL, NULL);
INSERT INTO `categories` VALUES (73, 'Computers', 'កុំព្យូទ័រ', 2, '', NULL, NULL);
INSERT INTO `categories` VALUES (74, 'Computer accessories', 'គ្រឿងកុំព្យូទ័រ', 2, '', NULL, NULL);
INSERT INTO `categories` VALUES (75, 'Softwares', 'កម្មវិធី', 2, '', NULL, NULL);
INSERT INTO `categories` VALUES (76, 'Consumer Electronics', 'ឧបករណ៍អេឡិចត្រូនិក', 3, '', NULL, NULL);
INSERT INTO `categories` VALUES (77, 'Security Camera', 'កាមេរ៉ាសុវត្ថិភាព', 3, '', NULL, NULL);
INSERT INTO `categories` VALUES (78, 'Cameras,camcorders', 'ម៉ាស៊ីនថត និង កាមេរ៉ា', 3, '', NULL, NULL);
INSERT INTO `categories` VALUES (79, 'TVs,Videos and Audios', 'ទូរទស្សន៍ គ្រឿងបំពងសំឡេង និង វីដេអូ', 3, '', NULL, NULL);
INSERT INTO `categories` VALUES (80, 'Home appliances ', 'ប្រដាប់ប្រើប្រាស់ក្នុងផ្ទះ', 3, '', NULL, NULL);
INSERT INTO `categories` VALUES (81, 'Video games,consoles,toys', 'ឧបគរណ៍ហ្គេម និង ឧបករណ៍ក្មេងលេង', 3, '', NULL, NULL);
INSERT INTO `categories` VALUES (82, 'Cars', 'រថយន្ត', 4, '', NULL, NULL);
INSERT INTO `categories` VALUES (83, 'Motorcycles', 'ម៉ូតូ', 4, '', NULL, NULL);
INSERT INTO `categories` VALUES (84, 'Car Parts & Accessories', 'គ្រឿងបន្លាស់ឡាន', 4, '', NULL, NULL);
INSERT INTO `categories` VALUES (85, 'Houses', 'ផ្ទះ', 5, '', NULL, NULL);
INSERT INTO `categories` VALUES (86, 'Lands', 'ដី', 5, '', NULL, NULL);
INSERT INTO `categories` VALUES (87, 'Jewelry & Watches', 'គ្រឿងអលង្ការ និង នាឡិកា', 6, '', NULL, NULL);
INSERT INTO `categories` VALUES (88, 'Clothing & Accessories', 'សម្លៀកបំពាក់ និង គ្រឿងលំអរ', 6, '', NULL, NULL);
INSERT INTO `categories` VALUES (89, 'Beauty & Healthcare', 'គ្រឿងសំអាង និង សុខភាព', 6, '', NULL, NULL);
INSERT INTO `categories` VALUES (90, 'Books', 'គ្រឿងសង្ហារឹម និង ដេគ័រ', 7, '', NULL, NULL);
INSERT INTO `categories` VALUES (91, 'Sports Equipment', 'ឧបករណ៍កីឡា', 7, '', NULL, NULL);
INSERT INTO `categories` VALUES (92, 'CDS,DVDS,VHS', 'CDS,DVDS,VHS', 7, '', NULL, NULL);
INSERT INTO `categories` VALUES (93, 'Household Items', 'សម្ភារៈក្នុងផ្ទះ', 8, '', NULL, NULL);
INSERT INTO `categories` VALUES (94, 'Office Furniture', 'សម្ភារៈក្នុងការិយាល័យ', 8, '', NULL, NULL);
INSERT INTO `categories` VALUES (95, 'Home Furniture', 'គ្រឿងសង្ហារឹមក្នុងផ្ទះ', 8, '', NULL, NULL);
INSERT INTO `categories` VALUES (96, 'Kitchenware', 'សម្ភារៈក្នុងផ្ទះបាយ', 8, '', NULL, NULL);
INSERT INTO `categories` VALUES (97, 'Handicrafts Paintings', 'សិប្បកម្ម និងគំនូរ', 8, '', NULL, NULL);

-- ----------------------------
-- Table structure for contact_mes
-- ----------------------------
DROP TABLE IF EXISTS `contact_mes`;
CREATE TABLE `contact_mes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `contact_mes_user_id_post_id_unique`(`user_id`, `post_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for favorites
-- ----------------------------
DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `favorites_user_id_post_id_unique`(`user_id`, `post_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (6, '2016_06_01_000001_create_oauth_auth_codes_table', 1);
INSERT INTO `migrations` VALUES (7, '2016_06_01_000002_create_oauth_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1);
INSERT INTO `migrations` VALUES (9, '2016_06_01_000004_create_oauth_clients_table', 1);
INSERT INTO `migrations` VALUES (10, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
INSERT INTO `migrations` VALUES (11, '2018_01_31_232142_create_users_table', 2);
INSERT INTO `migrations` VALUES (12, '2018_01_31_232403_create_categories_table', 2);
INSERT INTO `migrations` VALUES (13, '2018_01_31_232452_create_posts_table', 3);
INSERT INTO `migrations` VALUES (14, '2018_01_31_232525_create_favorites_table', 3);
INSERT INTO `migrations` VALUES (15, '2018_01_31_232608_create_contact_mes_table', 3);
INSERT INTO `migrations` VALUES (16, '2018_02_01_232528_create_roles_table', 3);
INSERT INTO `migrations` VALUES (17, '2018_02_01_232955_create_notifications_table', 3);

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oauth_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_access_tokens_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oauth_auth_codes
-- ----------------------------
DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oauth_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_clients_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oauth_personal_access_clients
-- ----------------------------
DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_personal_access_clients_client_id_index`(`client_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for oauth_refresh_tokens
-- ----------------------------
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens`  (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `oauth_refresh_tokens_access_token_id_index`(`access_token_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_from` decimal(8, 2) NOT NULL,
  `price_to` decimal(8, 2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `post_type` enum('buy','sell') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buy',
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (1, 'asdf', 'asdf', 1.00, 1.00, 69, NULL, 1, 1, 'buy', NULL, NULL, NULL);
INSERT INTO `posts` VALUES (2, 'asdf', 'asdf', 1.00, 1.00, 69, NULL, 1, 1, 'buy', NULL, NULL, NULL);
INSERT INTO `posts` VALUES (3, 'asdf', 'asdf', 1.00, 1.00, 69, NULL, 1, 1, 'sell', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `readonly_access` tinyint(1) NOT NULL DEFAULT 1,
  `api_access` tinyint(1) NOT NULL DEFAULT 0,
  `dashboard_access` tinyint(1) NOT NULL DEFAULT 0,
  `full_access` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'read_only', 1, 0, 0, 0, NULL, NULL);
INSERT INTO `roles` VALUES (2, 'user', 1, 1, 0, 0, NULL, NULL);
INSERT INTO `roles` VALUES (3, 'dev', 1, 1, 1, 0, NULL, NULL);
INSERT INTO `roles` VALUES (4, 'admin', 1, 1, 1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `accountkit_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `profile_pic` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `access_token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_accountkit_id_unique`(`accountkit_id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_phone_unique`(`phone`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '1587022274669104', 'Henry', 'Heng', '', '+85512253882', 'female', '134 Monorom', 'Phnom Penh', 'test.jpg', 'EMAWf5bpF9TyQZBu8ZArP8goi8zkesjZA4vDXCbWIlYYK0oHyZAKcsyWrwnNCWy3bwxb9xZBl6NYVLOnF7k0iLZAJQINAWHddMfh9vg3cEl2lRda1JKmu4Dy33v8MhoJosWFfBNS20cxanvme99oTKsZBIsiKFLbwZBJ4ZD', 1, 1, NULL, '2018-02-08 23:34:57', '2018-02-18 23:57:05');

SET FOREIGN_KEY_CHECKS = 1;
