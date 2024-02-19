-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2024 a las 20:04:04
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `certificado_posgrado`
--

--
-- Volcado de datos para la tabla `tm_categoria`
--

INSERT INTO `tm_categoria` (`cat_id`, `cat_nom`, `fech_crea`, `est`) VALUES
(9, 'CONSTANCIA', '2024-01-23 06:50:01', 1);

--
-- Volcado de datos para la tabla `tm_documento`
--

INSERT INTO `tm_documento` (`doc_id`, `cat_id`, `doc_nom`, `doc_descrip`, `enca_id`, `doc_img`, `fech_crea`, `est`) VALUES
(1, 9, 'CONSTANCIA DE MATRÍCULA', 'CONSTANCIA DE MATRÍCULA', 1, '../../public/1849167703.png', '2024-01-23 06:51:43', 1),
(2, 9, 'CONSTANCIA DE EGRESADO', 'CONSTANCIA DE EGRESADO', 1, '../../public/272190152.png', '2024-01-29 01:20:49', 1),
(3, 9, 'CONSTANCIA DE ESTUDIOS', 'CONSTANCIA DE ESTUDIANTE', 2, '../../public/1761697960.png', '2024-01-29 01:22:11', 1),
(4, 9, 'CONSTANCIA DE NO ADEUDAR', 'CONSTANCIA DE NO ADEUDAR', 2, '../../public/1412730723.png', '2024-01-29 01:21:37', 1),
(5, 9, 'CONSTANCIA DE HABER APROBADO INVESTIGACIÓN', 'CONSTANCIA DE HABER APROBADO INVESTIGACIÓN', 2, '../../public/2129240243.png', '2024-01-29 01:22:57', 1),
(6, 9, 'CONSTANCIA DE EGRESADO - LOS QUE FALTAN SUSTENTAR', 'CONSTANCIA DE EGRESADO - LOS QUE FALTAN SUSTENTAR', 2, '../../public/1781434596.png', '2024-01-29 01:30:56', 1);

--
-- Volcado de datos para la tabla `tm_encargado`
--

INSERT INTO `tm_encargado` (`enca_id`, `enca_nom`, `enca_apep`, `enca_apem`, `enca_correo`, `enca_sex`, `enca_telf`, `fech_crea`, `est`) VALUES
(1, 'RICARDO', 'PALMA', 'PALMA', 'RPALMA@TEST.COM.PE', 'M', '5555555', '2021-04-26 20:24:06', 1),
(2, 'CESAR', 'VALLEJO', 'MEDRANO', 'CVALLEJO@MEDRANO.COM.PE', 'M', '5555555', '2021-04-26 20:24:06', 1),
(7, 'A', 'b', 'c', 'd@a.com', '', '987654321', '2024-02-05 04:26:22', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
