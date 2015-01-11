-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2015 a las 07:48:31
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `nicatourdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deptos`
--

CREATE TABLE IF NOT EXISTS `deptos` (
`id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `latitud` text COLLATE utf8_spanish_ci NOT NULL,
  `longitud` text COLLATE utf8_spanish_ci NOT NULL,
  `zoom` int(11) NOT NULL,
  `dolar` varchar(8) COLLATE utf8_spanish_ci NOT NULL,
  `youtube` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `deptos`
--

INSERT INTO `deptos` (`id`, `nombre`, `latitud`, `longitud`, `zoom`, `dolar`, `youtube`, `create_at`, `update_at`) VALUES
(1, 'Boaco', '12.470478201748175', '-85.65898419999996', 14, '26.63', 'h1hllTOfMVI', '2015-01-10 16:27:37', '0000-00-00 00:00:00'),
(2, 'Carazo', '11.847114728782314', '-86.195426', 13, '26.63', 'XvlHisKH1hg', '2015-01-10 16:30:53', '0000-00-00 00:00:00'),
(3, 'Chinandega', '12.623776128614631', '-87.12080960000003', 12, '26.63', 'fLJxdZDm72A', '2015-01-10 16:33:35', '0000-00-00 00:00:00'),
(4, 'Chontales', '12.101263293049545', '-85.36827564999999', 13, '26.63', 'nzziu-FvxJE', '2015-01-10 16:31:21', '0000-00-00 00:00:00'),
(5, 'Estelí', '13.086516350653778', '-86.35850425000001', 12, '26.63', 'lB5HsBgTX2o', '2015-01-10 16:34:10', '0000-00-00 00:00:00'),
(6, 'Granada', '11.928850069287687', '-85.95979939999995', 13, '26.63', 'JOisYHYbNM8', '2015-01-10 16:37:14', '0000-00-00 00:00:00'),
(7, 'Jinotega', '13.089838125023427', '-85.99930305000004', 13, '26.63', 'YgY86pXW7IE', '2015-01-10 16:40:33', '0000-00-00 00:00:00'),
(8, 'Leon', '12.433997349553284', '-86.88207885000003', 12, '26.63', 'upTQ8e0KzDQ', '2015-01-10 16:43:56', '0000-00-00 00:00:00'),
(9, 'Madriz', '13.481491162505499', '-86.58084865000001', 14, '26.63', 'YgY86pXW7IE', '2015-01-10 16:40:38', '0000-00-00 00:00:00'),
(10, 'Managua', '12.096214921751834', '-86.25846060000003', 11, '26.63', '6HSoVVf17WM', '2015-01-10 17:13:07', '0000-00-00 00:00:00'),
(11, 'Masaya', '11.97501259421353', '-86.09272480000004', 12, '26.63', '0QP4Nc0QVCM', '2015-01-10 16:36:09', '0000-00-00 00:00:00'),
(12, 'Matagalpa', '12.92961447177432', '-85.92150800000002', 12, '26.63', 'YgY86pXW7IE', '2015-01-10 16:40:42', '0000-00-00 00:00:00'),
(13, 'Nueva Segovia', '13.629611915823169', '-86.47501950000003', 13, '26.63', 'YgY86pXW7IE', '2015-01-10 16:40:45', '0000-00-00 00:00:00'),
(14, 'Rivas', '11.438217119896732', '-85.82605354999998', 12, '26.63', 'lb5_HQ_rurg', '2015-01-10 16:35:18', '0000-00-00 00:00:00'),
(15, 'Rio San Juan', '11.127238971367062', '-84.77700945000004', 14, '26.63', '92l-jkWkGsU', '2015-01-10 16:36:35', '0000-00-00 00:00:00'),
(16, 'RAAN', '14.035261735939075', '-83.39194929999996', 14, '26.63', 'KYvnpjZjtfc', '2015-01-10 16:43:12', '0000-00-00 00:00:00'),
(17, 'RAAS', '12.011376703641973', '-83.76993655000001', 13, '26.63', 'KYvnpjZjtfc', '2015-01-10 16:43:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcioncultura`
--

CREATE TABLE IF NOT EXISTS `descripcioncultura` (
`id` int(10) unsigned NOT NULL,
  `id_depto` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_foto` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `texto` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleclima`
--

CREATE TABLE IF NOT EXISTS `detalleclima` (
`id` int(10) unsigned NOT NULL,
  `id_depto` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temperatura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `altura` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `humedad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalleclima`
--

INSERT INTO `detalleclima` (`id`, `id_depto`, `nombre`, `temperatura`, `icono`, `altura`, `humedad`, `created_at`, `updated_at`) VALUES
(1, 1, 'Boaco', '28', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '66%', '2015-01-02 10:52:07', '2015-01-03 09:01:51'),
(2, 2, 'Jinotepe', '28', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '66%', '2015-01-02 10:52:08', '2015-01-03 09:01:51'),
(3, 3, 'Chinandega', '27.6', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '243 ft', '63%', '2015-01-02 10:52:11', '2015-01-03 09:01:52'),
(4, 4, 'Juigalpa', '28', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '66%', '2015-01-02 10:52:11', '2015-01-03 09:01:52'),
(5, 5, 'Esteli', '18.9', 'http://icons.wxug.com/i/c/k/nt_rain.gif', '3569 ft', '92%', '2015-01-02 10:52:12', '2015-01-03 09:01:53'),
(6, 6, 'Granada', '28', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '66%', '2015-01-02 10:52:12', '2015-01-03 09:01:53'),
(7, 7, 'Jinotega', '22', 'http://icons.wxug.com/i/c/k/nt_mostlycloudy.gif', '3228 ft', '73%', '2015-01-02 10:52:13', '2015-01-03 09:01:54'),
(8, 8, 'Leon', '27.6', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '243 ft', '63%', '2015-01-02 10:52:13', '2015-01-03 09:01:54'),
(9, 9, 'Somoto', '21', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '3261 ft', '78%', '2015-01-02 10:53:28', '2015-01-02 10:53:28'),
(10, 10, 'Managua', '27', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '65%', '2015-01-02 10:53:29', '2015-01-02 10:53:29'),
(11, 11, 'Masaya', '27', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '65%', '2015-01-02 10:53:29', '2015-01-02 10:53:29'),
(12, 12, 'Matagalpa', '23', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '3228 ft', '65%', '2015-01-02 10:53:30', '2015-01-02 10:53:30'),
(13, 13, 'Ocotal', '21', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '3261 ft', '78%', '2015-01-02 10:53:30', '2015-01-02 10:53:30'),
(14, 14, 'Rivas', '27', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '184 ft', '65%', '2015-01-02 10:53:31', '2015-01-02 10:53:31'),
(15, 15, 'San Carlos', '22', 'http://icons.wxug.com/i/c/k/nt_rain.gif', ' ft', '92%', '2015-01-02 10:53:31', '2015-01-02 10:53:31'),
(16, 16, 'Puerto Cabezas', '27', 'http://icons.wxug.com/i/c/k/nt_partlycloudy.gif', '66 ft', '89%', '2015-01-02 10:53:32', '2015-01-02 10:53:32'),
(17, 17, 'Bluefields', '28', 'http://icons.wxug.com/i/c/k/nt_mostlycloudy.gif', '16 ft', '79%', '2015-01-02 10:53:32', '2015-01-02 10:53:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleslider`
--

CREATE TABLE IF NOT EXISTS `detalleslider` (
`id` int(11) NOT NULL,
  `id_dpto` int(11) NOT NULL,
  `img` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalleslider`
--

INSERT INTO `detalleslider` (`id`, `id_dpto`, `img`, `updated_at`, `created_at`) VALUES
(1, 6, 'Granada/Granada1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(2, 6, 'Granada/Granada2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(3, 6, 'Granada/Granada3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(4, 3, 'Chinandega/Chinandega1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(5, 3, 'Chinandega/Chinandega2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(6, 3, 'Chinandega/Corinto.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(7, 3, 'Chinandega/Puerto-Corinto.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(8, 5, 'Esteli/Esteli1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(9, 5, 'Esteli/Esteli2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(10, 5, 'Esteli/Esteli3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(11, 5, 'Esteli/Esteli4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(12, 5, 'Esteli/Esteli5.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(13, 5, 'Esteli/Esteli6.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(14, 5, 'Esteli/Esteli7.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(16, 5, 'Esteli/Esteli9.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(17, 5, 'Esteli/Esteli10.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(18, 6, 'Granada/Granada4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(19, 6, 'Granada/Gueguense1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(20, 6, 'Granada/Mombacho1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(22, 8, 'Leon/Cerro-Negro.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(23, 8, 'Leon/Leon1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(24, 8, 'Leon/Leon3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(25, 8, 'Leon/Leon6.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(26, 8, 'Leon/Leon5.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(27, 9, 'Madriz/somoto1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(28, 9, 'Madriz/somoto2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(29, 9, 'Madriz/somoto3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(30, 9, 'Madriz/somoto4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(31, 10, 'Managua/Managua2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(32, 10, 'Managua/Managua1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(33, 10, 'Managua/Salvador-Allende1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(34, 10, 'Managua/Managua3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(35, 10, 'Managua/Salvador-Allende3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(36, 10, 'Managua/Salvador-Allende4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(37, 10, 'Managua/Salvador-Allende7.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(38, 10, 'Managua/Salvador-Allende5.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(39, 11, 'Masaya/Masaya1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(40, 11, 'Masaya/Masaya2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(41, 12, 'Matagalpa/Matagalpa.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(42, 12, 'Matagalpa/Selva-Negra1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(43, 12, 'Matagalpa/Selva-Negra2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(44, 12, 'Matagalpa/Selva-Negra3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(45, 12, 'Matagalpa/Selva-Negra4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(46, 13, 'Nueva Segovia/Nueva-Segovia1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(47, 13, 'Nueva Segovia/Nueva-Segovia2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(48, 13, 'Nueva Segovia/Nueva-Segovia3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(49, 13, 'Nueva Segovia/Nueva-Segovia4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(50, 13, 'Nueva Segovia/Nueva-Segovia5.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(51, 17, 'RAAS/Bluefields2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(52, 17, 'RAAS/Bluefields3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(53, 17, 'RAAS/Corn-Island1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(54, 17, 'RAAS/Corn-Island4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(55, 17, 'RAAS/RAAS1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(56, 17, 'RAAS/RAAS2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(57, 17, 'RAAS/RAAS3.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(58, 17, 'RAAS/RAAS4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(59, 15, 'Rio San Juan/Rio-san-juan9.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(60, 15, 'Rio San Juan/Rio-san-juan4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(61, 15, 'Rio San Juan/Rio-san-juan1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(62, 15, 'Rio San Juan/Rio-san-juan7.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(63, 15, 'Rio San Juan/Rio-san-juan12.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(64, 15, 'Rio San Juan/Rio-san-juan6.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(65, 14, 'Rivas/Rivas2.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(66, 14, 'Rivas/San-juan-del-sur11.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(67, 14, 'Rivas/San-juan-del-sur16.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(68, 14, 'Rivas/San-juan-del-sur18.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(69, 14, 'Rivas/Ometepe1.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(70, 14, 'Rivas/Ometepe5.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(71, 14, 'Rivas/Ometepe4.jpg', '2014-12-22 19:25:56', '0000-00-00 00:00:00'),
(76, 6, 'Granada/Mombacho3.jpg', '2014-12-24 11:53:25', '2014-12-24 11:53:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotocultura`
--

CREATE TABLE IF NOT EXISTS `fotocultura` (
`id` int(10) unsigned NOT NULL,
  `id_depto` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `foto` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasolineras`
--

CREATE TABLE IF NOT EXISTS `gasolineras` (
`id` int(10) unsigned NOT NULL,
  `id_depto` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitud` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `gasolineras`
--

INSERT INTO `gasolineras` (`id`, `id_depto`, `nombre`, `latitud`, `longitud`, `created_at`, `updated_at`) VALUES
(1, 10, 'Puma Rubenia', '12.129900529671684', '-86.2321400642395', '2015-01-10 07:56:51', '2015-01-10 07:56:51'),
(2, 10, 'Petronic Rotonda Centroamerica', '12.11416611408742', '-86.25520706176758', '2015-01-10 08:09:43', '2015-01-10 08:09:43'),
(3, 10, 'UNO Las Americas', '12.128568385120092', '-86.22043490409851', '2015-01-11 12:41:28', '2015-01-11 12:41:28'),
(4, 10, 'Petronic Loselza', '12.116704662579123', '-86.25055074691772', '2015-01-11 12:42:36', '2015-01-11 12:42:36'),
(5, 10, 'Puma Linda Vista', '12.15237815338947', '-86.30423784255981', '2015-01-11 12:44:03', '2015-01-11 12:44:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idioma`
--

CREATE TABLE IF NOT EXISTS `idioma` (
`id` int(11) NOT NULL,
  `iniciales` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `idioma`
--

INSERT INTO `idioma` (`id`, `iniciales`, `nombre`) VALUES
(1, 'es', 'Español'),
(2, 'en', 'Ingles'),
(3, 'de', 'Aleman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infoclima`
--

CREATE TABLE IF NOT EXISTS `infoclima` (
`id` int(11) NOT NULL,
  `id_dpto` int(11) NOT NULL,
  `url` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `infoclima`
--

INSERT INTO `infoclima` (`id`, `id_dpto`, `url`) VALUES
(1, 1, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NK/Boaco.json'),
(2, 2, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NK/Jinotepe.json'),
(3, 3, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Chinandega.json'),
(4, 4, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Juigalpa.json'),
(5, 5, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Esteli.json'),
(6, 6, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Granada.json'),
(7, 7, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Jinotega.json'),
(8, 8, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Leon.json'),
(9, 9, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Somoto.json'),
(10, 10, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Managua.json'),
(11, 11, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Masaya.json'),
(12, 12, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Matagalpa.json'),
(13, 13, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Ocotal.json'),
(14, 14, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Rivas.json'),
(15, 15, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/San%20Carlos.json'),
(16, 16, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Puerto%20Cabezas.json'),
(17, 17, 'http://api.wunderground.com/api/c0bc1e930c0a0f3c/conditions/q/NI/Bluefields.json');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_12_19_035134_crear_tabla_usuarios', 1),
('2015_01_02_034238_create_table_detalleclima', 2),
('2015_01_09_062452_eliminar_tablas_para_locales', 3),
('2015_01_09_062540_renombrar_tabla_info', 3),
('2015_01_09_063543_crear_tabla_RestaurantesHoteles', 4),
('2015_01_09_063611_crear_tabla_Gasolineras', 4),
('2015_01_09_071550_crear_tablas_culturas', 5),
('2015_01_09_195218_crear_tabla_traduccion_restaurantesyhoteles', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restauranteshoteles`
--

CREATE TABLE IF NOT EXISTS `restauranteshoteles` (
`id` int(10) unsigned NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_depto` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinfo`
--

CREATE TABLE IF NOT EXISTS `tipoinfo` (
`id` int(11) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipoinfo`
--

INSERT INTO `tipoinfo` (`id`, `tipo`, `updated_at`, `created_at`) VALUES
(1, 'Gastronomia', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(2, 'Tesoros Coloniales', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(3, 'Danza', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(4, 'Artesania', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(5, 'Restaurantes', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(6, 'Hoteles', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(7, 'Tours Operadoras', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(8, 'Traslado', '2014-12-24 05:26:19', '0000-00-00 00:00:00'),
(9, 'Gasolineras', '2014-12-24 05:26:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traduccionlocales`
--

CREATE TABLE IF NOT EXISTS `traduccionlocales` (
`id` int(10) unsigned NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_depto` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `id_local` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(10) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kevin Hernandez', 'kher09', '$2y$10$ddHdIemH/XwS3xjXKAdgJu.8Vw9QNWMjcfSjyxH0ooii4/Wb10c3K', 'YcnBezTk7vlYmVD5QUk8KdV7Qr7MyHWCjUZMRec9RWwOoA3Y3lYRVkbJPb8i', '0000-00-00 00:00:00', '2014-12-29 08:37:02'),
(2, 'Doctorpc', 'doctorpc', '$2y$10$jF7obt463alHqqeFNJFyHeutnTHt3V/sTpSyeQZ71cDhSp..a36y6', '', '2015-01-10 01:42:59', '2015-01-10 01:42:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `deptos`
--
ALTER TABLE `deptos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `descripcioncultura`
--
ALTER TABLE `descripcioncultura`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalleclima`
--
ALTER TABLE `detalleclima`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalleslider`
--
ALTER TABLE `detalleslider`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotocultura`
--
ALTER TABLE `fotocultura`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gasolineras`
--
ALTER TABLE `gasolineras`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `idioma`
--
ALTER TABLE `idioma`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `infoclima`
--
ALTER TABLE `infoclima`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restauranteshoteles`
--
ALTER TABLE `restauranteshoteles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoinfo`
--
ALTER TABLE `tipoinfo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traduccionlocales`
--
ALTER TABLE `traduccionlocales`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `deptos`
--
ALTER TABLE `deptos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `descripcioncultura`
--
ALTER TABLE `descripcioncultura`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `detalleclima`
--
ALTER TABLE `detalleclima`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `detalleslider`
--
ALTER TABLE `detalleslider`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT de la tabla `fotocultura`
--
ALTER TABLE `fotocultura`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gasolineras`
--
ALTER TABLE `gasolineras`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `idioma`
--
ALTER TABLE `idioma`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `infoclima`
--
ALTER TABLE `infoclima`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `restauranteshoteles`
--
ALTER TABLE `restauranteshoteles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipoinfo`
--
ALTER TABLE `tipoinfo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `traduccionlocales`
--
ALTER TABLE `traduccionlocales`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
