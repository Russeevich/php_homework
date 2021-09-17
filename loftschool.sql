-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.24 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп данных таблицы loftschool.blog: ~22 rows (приблизительно)
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` (`id`, `text`, `owner_id`, `image`, `created_at`) VALUES
	(9, 'njaskncaskc\r\n', 23, '', '2021-09-05 14:33:11'),
	(10, 'skmakjcaasjkcmasckamck', 23, '', '2021-09-05 14:33:16'),
	(11, 'asxascasca', 23, '', '2021-09-05 14:33:25'),
	(12, 'asxklamsklamsxl', 23, '', '2021-09-05 14:33:29'),
	(13, 'lakscmlas', 23, '', '2021-09-05 14:33:53'),
	(14, 'ascsacasc', 23, '', '2021-09-05 14:33:56'),
	(15, 'ascascasc', 23, '', '2021-09-05 14:33:59'),
	(16, 'ascascasca', 23, '', '2021-09-05 14:34:02'),
	(17, 'ascsacas', 23, '', '2021-09-05 14:34:05'),
	(18, 'ascascaasca', 23, '', '2021-09-05 14:34:08'),
	(19, 'sacsacascascsa', 23, '', '2021-09-05 14:34:11'),
	(20, 'ascassacas', 23, '', '2021-09-05 14:34:17'),
	(21, 'zx axasacascasc', 23, '', '2021-09-05 14:34:20'),
	(22, 'jqsmxjksanckc', 23, '', '2021-09-05 14:34:27'),
	(23, 'lamslkcclksalaskcma', 23, '', '2021-09-05 14:34:40'),
	(24, 'mslcaksmcklaslkcma', 23, '', '2021-09-05 14:34:43'),
	(25, 'mamslksmacsalkc', 23, '', '2021-09-05 14:34:47'),
	(26, 'sac msamc m,asc', 23, '', '2021-09-05 14:34:54'),
	(27, 'asmxaskmxamlasx', 23, '', '2021-09-05 14:35:00'),
	(28, 'akmclaskcmas', 23, '', '2021-09-05 14:36:01'),
	(31, 'maxmaskjcanjkcascnas', 23, 'kisspng-portable-network-graphics-circle-sphere-transparen-featured-stickers-abstract-featured-stickers-t-shi-5d1ec9017f80d2.1608920115622986255223.jpg', '2021-09-15 16:42:00'),
	(32, 'jakxnkasxnja', 23, 'WhatsApp Image 2021-07-27 at 14.54.29.jpeg', '2021-09-15 18:50:57');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;

-- Дамп данных таблицы loftschool.users: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `created_at`, `email`, `password`, `role`, `image`) VALUES
	(1, '1231456', '2021-09-03 21:05:05', '1231231@yandex.ru', 'd2e502abf6f7938e227e4477113ce6d602812cf3', 1, '596-5962517_all-seeing-eye-pyramid-png-.png'),
	(2, 'asdzxc2', '2021-09-03 21:16:09', '123123@gmail.com', 'd2e502abf6f7938e227e4477113ce6d602812cf3', 0, ''),
	(23, '1231231', '2021-09-03 21:58:29', 'empiks18@gmail.com', 'd2e502abf6f7938e227e4477113ce6d602812cf3', 1, NULL),
	(24, 'Николай', '2021-09-03 23:21:52', 'gmail@gmail.com', '516b1d33bcc2fce69378548594c85cbf1e5ae9f0', 0, NULL),
	(25, 'Николай Николаевич Назаров', '2021-09-03 23:22:19', 'empiks18s@gmail.com', '516b1d33bcc2fce69378548594c85cbf1e5ae9f0', 0, NULL),
	(26, 'kasncjkasnc', '2021-09-03 23:23:07', 'ajsnkascj@ascnaks.ru', 'c0628bf9acf9e9889dd5d1ceb3a174c0b2eff6b1', 0, NULL),
	(28, 'Николай', '2021-09-17 14:18:41', 'empiks18@gmail.com33', '516b1d33bcc2fce69378548594c85cbf1e5ae9f0', 0, NULL),
	(29, 'asd', '2021-09-17 14:20:24', '123444@gmail.com', '4ccc25e8ded99ff7198cef9beee294f21c640a26', 1, '596-5962517_all-seeing-eye-pyramid-png-.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
