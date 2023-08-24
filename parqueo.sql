-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2023 a las 23:50:11
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parqueo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_anuncios`
--

CREATE TABLE `tb_anuncios` (
  `id_anuncio` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `imagen` longblob DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `nit_cliente` varchar(255) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `placa_auto` varchar(255) DEFAULT NULL,
  `placa_auto_dos` varchar(255) DEFAULT NULL,
  `map_id` int(11) DEFAULT NULL,
  `nit_compartido` int(20) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `fecha_asignacion_comp` date DEFAULT NULL,
  `fecha_id` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `nombre_cliente`, `nit_cliente`, `correo`, `placa_auto`, `placa_auto_dos`, `map_id`, `nit_compartido`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `fecha_asignacion`, `fecha_asignacion_comp`, `fecha_id`, `estado`) VALUES
(126, 'ING AYOROA CARDOZO JOSE RICHARD', '147852', 'ayoroa@gmail.com', 'LLL444', '', 340, 0, '2023-06-10 10:43:18', '2023-06-23 20:48:31', NULL, '2023-06-25', NULL, NULL, '1'),
(127, 'Lic. Calancha Navia Boris Marcelo', '258741', 'calancha@gmail.com', 'BBB555', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, '2023-06-24', NULL, NULL, '1'),
(128, 'MSC COSTAS JUREGUI VLADIMIR', '369852', 'costas@gmail.com', 'CCC666', '', NULL, 0, '2023-06-10 10:43:18', '2023-06-23 20:44:52', NULL, '2023-06-24', NULL, NULL, '1'),
(129, 'Lic. Escalera Fernandez David', '456987', 'escalera@gmail.com', 'DDD777', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, NULL, NULL, NULL, '1'),
(130, 'Msc. Lic. Jaldin Rosales K. Rolando', '753159', 'jaldin@gmail.com', 'EEE888', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, NULL, NULL, NULL, '1'),
(131, 'Msc. Ing. Orellana Araoz Jorge Walter', '987654', 'orellana@gmail.com', 'FFF999', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, NULL, NULL, NULL, '1'),
(132, 'Dr. Romero Rodríguez Patricia Elizabeth', '654321', 'romero@gmail.com', 'GGG000', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, '2023-06-24', NULL, NULL, '1'),
(133, 'Ing. Villarroel Novillo Jimmy', '321654', 'villarroel@gmail.com', 'HHH111', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, NULL, NULL, NULL, '1'),
(134, 'Lic. Villarroel Tapia Henrry Frank', '159753', 'villarroelt@gmail.com', 'III222', NULL, NULL, 0, '2023-06-10 10:43:18', NULL, NULL, NULL, NULL, NULL, '1'),
(135, 'NICOLAS', '13473151', 'nicolastrigo07@gmail.com', 'ASDW1561', '', NULL, 0, '2023-06-23 15:36:51', NULL, NULL, NULL, NULL, NULL, '1'),
(136, 'CRISTIAN', '4875123', 'rochacristhian77@gmail.com', 'DAD151', '', NULL, 0, '2023-06-23 15:37:27', NULL, NULL, NULL, NULL, NULL, '1'),
(137, 'PEDRO', '234234', 'pedro@gmail.com', 'DAD4894', '', NULL, 0, '2023-06-24 17:42:00', NULL, NULL, NULL, NULL, NULL, '1'),
(138, 'Maria Lopez', '5522', 'papa@gmail.com', 'sdf345 ', NULL, NULL, 0, '2023-06-25 00:00:50', NULL, NULL, NULL, NULL, NULL, '1'),
(139, 'Saul Flores', '454254', 'saul@gmail.com', '56f5s ', NULL, NULL, 0, '2023-06-25 00:00:50', NULL, NULL, NULL, NULL, NULL, '1'),
(140, 'Andres', '5675', 'Andres@gmail.com', 'dfg44', NULL, NULL, 0, '2023-06-25 00:00:50', NULL, NULL, NULL, NULL, NULL, '1'),
(141, 'nuevo', '34553', 'nuevo@gmail.com', 'ghjg66655', NULL, NULL, 0, '2023-06-25 00:00:50', NULL, NULL, NULL, NULL, NULL, '1'),
(142, 'jose manuel', '234234', 'jose@gmail.com', 'ghj675', NULL, NULL, 0, '2023-06-25 00:00:50', NULL, NULL, NULL, NULL, NULL, '1'),
(143, 'test', '34535555', 'test@gmail.com', 'zxc', NULL, NULL, 0, '2023-06-25 00:00:50', NULL, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_facturaciones`
--

CREATE TABLE `tb_facturaciones` (
  `id_factura` int(11) NOT NULL,
  `nro_factura` int(255) NOT NULL,
  `mes` varchar(255) DEFAULT NULL,
  `precio_id` int(255) DEFAULT NULL,
  `estado_factura` varchar(255) DEFAULT NULL,
  `fecha_emision` varchar(255) DEFAULT NULL,
  `cliente_id` int(255) DEFAULT NULL,
  `ultimo_precio` int(255) NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_facturaciones`
--

INSERT INTO `tb_facturaciones` (`id_factura`, `nro_factura`, `mes`, `precio_id`, `estado_factura`, `fecha_emision`, `cliente_id`, `ultimo_precio`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
(81, 1, 'ENERO', NULL, 'PAGADO', NULL, 126, 70, '2023-06-24', NULL, NULL, '1'),
(82, 2, 'ENERO', NULL, 'PAGADO', NULL, 126, 70, '2023-06-24', NULL, NULL, '1'),
(83, 3, 'ENERO', NULL, 'NO PAGADO', NULL, 130, 70, '2023-06-24', NULL, NULL, '1'),
(84, 4, 'ENERO', NULL, 'NO PAGADO', NULL, 128, 70, '2023-06-24', NULL, NULL, '1'),
(85, 5, 'ENERO', NULL, 'NO PAGADO', NULL, 128, 70, '2023-07-24', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_fechas_limite`
--

CREATE TABLE `tb_fechas_limite` (
  `id_fecha` int(11) NOT NULL,
  `fecha_limite_asignacion` date DEFAULT NULL,
  `fecha_limite_pago` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_fechas_limite`
--

INSERT INTO `tb_fechas_limite` (`id_fecha`, `fecha_limite_asignacion`, `fecha_limite_pago`) VALUES
(17, '2023-06-30', '2023-06-30'),
(18, '2023-06-08', '2023-06-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_informaciones`
--

CREATE TABLE `tb_informaciones` (
  `id_informacion` int(11) NOT NULL,
  `nombre_parqueo` varchar(255) DEFAULT NULL,
  `actividad_empresa` varchar(255) DEFAULT NULL,
  `sucursal` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `zona` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `departamento_ciudad` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_informaciones`
--

INSERT INTO `tb_informaciones` (`id_informacion`, `nombre_parqueo`, `actividad_empresa`, `sucursal`, `direccion`, `zona`, `telefono`, `departamento_ciudad`, `pais`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
(1, 'PARQUEO FCYT UMSS', 'UNIVERSIDAD', 'TECNOLOGIA', 'CALLE SUCRE', 'CENTRO', '4251515', 'COCHABAMBA', 'BOLIVIA', '2023-05-08 11:43:02', '2023-06-15 05:34:40', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_mapeos`
--

CREATE TABLE `tb_mapeos` (
  `id_map` int(11) NOT NULL,
  `estado_espacio` varchar(20) DEFAULT NULL,
  `espacio` int(20) DEFAULT NULL,
  `seccion` varchar(20) DEFAULT NULL,
  `borrar` varchar(20) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_mapeos`
--

INSERT INTO `tb_mapeos` (`id_map`, `estado_espacio`, `espacio`, `seccion`, `borrar`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
(340, 'LIBRE', 1, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(341, 'LIBRE', 2, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(342, 'LIBRE', 3, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(343, 'LIBRE', 4, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(344, 'LIBRE', 5, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(345, 'LIBRE', 6, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(346, 'LIBRE', 7, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(347, 'LIBRE', 8, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(348, 'LIBRE', 9, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(349, 'LIBRE', 10, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(350, 'LIBRE', 11, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(351, 'LIBRE', 12, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(352, 'LIBRE', 13, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(353, 'LIBRE', 14, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(354, 'LIBRE', 15, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(355, 'LIBRE', 16, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(356, 'LIBRE', 17, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(357, 'LIBRE', 18, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(358, 'LIBRE', 19, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(359, 'LIBRE', 20, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(360, 'LIBRE', 21, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(361, 'LIBRE', 22, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(362, 'LIBRE', 23, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(363, 'LIBRE', 24, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(364, 'LIBRE', 25, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(365, 'LIBRE', 26, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(366, 'LIBRE', 27, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(367, 'LIBRE', 28, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(368, 'LIBRE', 29, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(369, 'LIBRE', 30, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(370, 'LIBRE', 31, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(371, 'LIBRE', 32, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(372, 'LIBRE', 33, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(373, 'LIBRE', 34, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(374, 'LIBRE', 35, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(375, 'LIBRE', 36, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(376, 'LIBRE', 37, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(377, 'LIBRE', 38, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(378, 'LIBRE', 39, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(379, 'LIBRE', 40, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(380, 'LIBRE', 41, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(381, 'LIBRE', 42, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(382, 'LIBRE', 43, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(383, 'LIBRE', 44, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(384, 'LIBRE', 45, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(385, 'LIBRE', 46, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(386, 'LIBRE', 47, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(387, 'LIBRE', 48, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(388, 'LIBRE', 49, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(389, 'LIBRE', 50, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(390, 'LIBRE', 51, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(391, 'LIBRE', 52, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(392, 'LIBRE', 53, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(393, 'LIBRE', 54, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(394, 'LIBRE', 55, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(395, 'LIBRE', 56, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(396, 'LIBRE', 57, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(397, 'LIBRE', 58, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(398, 'LIBRE', 59, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(399, 'LIBRE', 60, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(400, 'LIBRE', 61, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(401, 'LIBRE', 62, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(402, 'LIBRE', 63, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(403, 'LIBRE', 64, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(404, 'LIBRE', 65, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(405, 'LIBRE', 66, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(406, 'LIBRE', 67, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(407, 'LIBRE', 68, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(408, 'LIBRE', 69, 'A', 'NO', '2023-06-15 18:06:00', NULL, NULL, '1'),
(410, 'LIBRE', 70, 'A', 'NO', '2023-06-15 06:07:21', NULL, NULL, '1'),
(411, 'LIBRE', 1, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(412, 'LIBRE', 2, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(413, 'LIBRE', 3, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(414, 'LIBRE', 4, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(415, 'LIBRE', 5, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(416, 'LIBRE', 6, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(417, 'LIBRE', 7, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(418, 'LIBRE', 8, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(419, 'LIBRE', 9, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(420, 'LIBRE', 10, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(421, 'LIBRE', 11, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(422, 'LIBRE', 12, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(423, 'LIBRE', 13, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(424, 'LIBRE', 14, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(425, 'LIBRE', 15, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(426, 'LIBRE', 16, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(427, 'LIBRE', 17, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(428, 'LIBRE', 18, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(429, 'LIBRE', 19, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(430, 'LIBRE', 20, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(431, 'LIBRE', 21, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(432, 'LIBRE', 22, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(433, 'LIBRE', 23, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(434, 'LIBRE', 24, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(435, 'LIBRE', 25, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(436, 'LIBRE', 26, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(437, 'LIBRE', 27, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(438, 'LIBRE', 28, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(439, 'LIBRE', 29, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(440, 'LIBRE', 30, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(441, 'LIBRE', 31, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(442, 'LIBRE', 32, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(443, 'LIBRE', 33, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(444, 'LIBRE', 34, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(445, 'LIBRE', 35, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(446, 'LIBRE', 36, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(447, 'LIBRE', 37, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(448, 'LIBRE', 38, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(449, 'LIBRE', 39, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(450, 'LIBRE', 40, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(451, 'LIBRE', 41, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(452, 'LIBRE', 42, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(453, 'LIBRE', 43, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(454, 'LIBRE', 44, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(455, 'LIBRE', 45, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(456, 'LIBRE', 46, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(457, 'LIBRE', 47, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(458, 'LIBRE', 48, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(459, 'LIBRE', 49, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(460, 'LIBRE', 50, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(461, 'LIBRE', 51, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(462, 'LIBRE', 52, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(463, 'LIBRE', 53, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(464, 'LIBRE', 54, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(465, 'LIBRE', 55, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(466, 'LIBRE', 56, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(467, 'LIBRE', 57, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(468, 'LIBRE', 58, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(469, 'LIBRE', 59, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(470, 'LIBRE', 60, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(471, 'LIBRE', 61, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(472, 'LIBRE', 62, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(473, 'LIBRE', 63, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(474, 'LIBRE', 64, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(475, 'LIBRE', 65, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(476, 'LIBRE', 66, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(477, 'LIBRE', 67, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(478, 'LIBRE', 68, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(479, 'LIBRE', 69, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1'),
(480, 'LIBRE', 70, 'B', 'NO', '2023-06-15 18:10:10', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pagos`
--

CREATE TABLE `tb_pagos` (
  `id_pago` int(11) NOT NULL,
  `nro_factura` int(255) NOT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_pagos`
--

INSERT INTO `tb_pagos` (`id_pago`, `nro_factura`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
(54, 1, '2023-06-24', NULL, NULL, 'PAGADO'),
(55, 2, '2023-07-24', NULL, NULL, 'PAGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_permisos`
--

CREATE TABLE `tb_permisos` (
  `id_permiso` int(11) NOT NULL,
  `principal` varchar(255) DEFAULT NULL,
  `principal2` varchar(255) DEFAULT NULL,
  `usuarios` varchar(255) DEFAULT NULL,
  `roles` varchar(255) DEFAULT NULL,
  `parqueo` varchar(255) DEFAULT NULL,
  `clientes` varchar(255) DEFAULT NULL,
  `recibos` varchar(255) DEFAULT NULL,
  `pagos` varchar(255) DEFAULT NULL,
  `anuncios` varchar(255) DEFAULT NULL,
  `guardia` varchar(255) DEFAULT NULL,
  `buzon` varchar(255) DEFAULT NULL,
  `fecha` varchar(10) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `rol_id` int(100) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_permisos`
--

INSERT INTO `tb_permisos` (`id_permiso`, `principal`, `principal2`, `usuarios`, `roles`, `parqueo`, `clientes`, `recibos`, `pagos`, `anuncios`, `guardia`, `buzon`, `fecha`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `rol_id`, `estado`) VALUES
(11, 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', 'on', NULL, NULL, NULL, 1, '1'),
(20, 'off', 'off', 'off', 'off', 'off', 'on', 'off', 'off', 'on', 'on', 'on', NULL, '2023-06-23 08:41:47', NULL, NULL, 50, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_precios`
--

CREATE TABLE `tb_precios` (
  `id_precio` int(11) NOT NULL,
  `precio` varchar(255) DEFAULT NULL,
  `fecha_id` int(11) DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_precios`
--

INSERT INTO `tb_precios` (`id_precio`, `precio`, `fecha_id`, `fyh_creacion`, `estado`) VALUES
(36, '100', NULL, '2023-06-24', '1'),
(37, '70', NULL, '2023-06-24', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_reportes_g`
--

CREATE TABLE `tb_reportes_g` (
  `id_reporte_g` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cliente_id` int(100) DEFAULT NULL,
  `usuario_id` int(255) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `autor` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(255) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id_rol`, `nombre_rol`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
(1, 'ADMINISTRADOR ', NULL, NULL, NULL, '1'),
(50, 'GUARDIA', '2023-06-23 08:41:47', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_solicitudes`
--

CREATE TABLE `tb_solicitudes` (
  `id_solicitud` int(11) NOT NULL,
  `nit_cliente` int(25) NOT NULL,
  `asunto` varchar(25) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fyh_creacion` date DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `cliente_id` int(10) NOT NULL,
  `estado` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_solicitudes`
--

INSERT INTO `tb_solicitudes` (`id_solicitud`, `nit_cliente`, `asunto`, `descripcion`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `cliente_id`, `estado`) VALUES
(19, 0, 'OTRO', '1', '2023-06-06', NULL, '2023-06-06 01:55:47', 94, '0'),
(20, 0, 'SOLICITUD', 'ddd', '2023-06-06', NULL, NULL, 94, '1'),
(21, 0, 'RECLAMO', 'ddd', '2023-06-06', NULL, NULL, 94, '1'),
(22, 0, 'ESPACIO COMPARTIDO', 'ddd', '2023-06-06', NULL, NULL, 94, '1'),
(23, 0, 'OTRO', 'ada', '2023-06-13', NULL, '2023-06-13 08:04:57', 104, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verificado` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `turno` varchar(255) DEFAULT NULL,
  `fyh_creacion` datetime DEFAULT NULL,
  `fyh_actualizacion` datetime DEFAULT NULL,
  `fyh_eliminacion` datetime DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `id_reporte_g` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nombres`, `rol_id`, `email`, `email_verificado`, `password_user`, `turno`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`, `id_reporte_g`) VALUES
(63, 'ADMIN', 1, 'admin@gmail.com', NULL, 'Admin777@', 'MAÑANA', NULL, '2023-06-15 05:30:15', NULL, '1', 0),
(69, 'CORINA FLORES', 1, 'corina@gmail.com', NULL, 'ASDasd456/*-', 'TARDE', '2023-06-09 22:59:34', '2023-06-10 10:31:17', NULL, '1', 0),
(83, 'NICOLAS TRIGO', 50, 'nicolastrigo07@gmail.com', NULL, 'Nico0703**', 'MAÑANA', '2023-06-23 20:42:25', NULL, NULL, '1', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_anuncios`
--
ALTER TABLE `tb_anuncios`
  ADD PRIMARY KEY (`id_anuncio`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `map_id` (`map_id`),
  ADD KEY `fecha_id` (`fecha_id`);

--
-- Indices de la tabla `tb_facturaciones`
--
ALTER TABLE `tb_facturaciones`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `nro_factura` (`nro_factura`),
  ADD KEY `precio_id` (`precio_id`);

--
-- Indices de la tabla `tb_fechas_limite`
--
ALTER TABLE `tb_fechas_limite`
  ADD PRIMARY KEY (`id_fecha`);

--
-- Indices de la tabla `tb_informaciones`
--
ALTER TABLE `tb_informaciones`
  ADD PRIMARY KEY (`id_informacion`);

--
-- Indices de la tabla `tb_mapeos`
--
ALTER TABLE `tb_mapeos`
  ADD PRIMARY KEY (`id_map`);

--
-- Indices de la tabla `tb_pagos`
--
ALTER TABLE `tb_pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `nro_factura` (`nro_factura`);

--
-- Indices de la tabla `tb_permisos`
--
ALTER TABLE `tb_permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tb_precios`
--
ALTER TABLE `tb_precios`
  ADD PRIMARY KEY (`id_precio`),
  ADD KEY `fecha_id` (`fecha_id`);

--
-- Indices de la tabla `tb_reportes_g`
--
ALTER TABLE `tb_reportes_g`
  ADD PRIMARY KEY (`id_reporte_g`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tb_solicitudes`
--
ALTER TABLE `tb_solicitudes`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_anuncios`
--
ALTER TABLE `tb_anuncios`
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de la tabla `tb_facturaciones`
--
ALTER TABLE `tb_facturaciones`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `tb_fechas_limite`
--
ALTER TABLE `tb_fechas_limite`
  MODIFY `id_fecha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tb_informaciones`
--
ALTER TABLE `tb_informaciones`
  MODIFY `id_informacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_mapeos`
--
ALTER TABLE `tb_mapeos`
  MODIFY `id_map` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT de la tabla `tb_pagos`
--
ALTER TABLE `tb_pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `tb_permisos`
--
ALTER TABLE `tb_permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tb_precios`
--
ALTER TABLE `tb_precios`
  MODIFY `id_precio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tb_reportes_g`
--
ALTER TABLE `tb_reportes_g`
  MODIFY `id_reporte_g` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `tb_solicitudes`
--
ALTER TABLE `tb_solicitudes`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD CONSTRAINT `tb_clientes_ibfk_1` FOREIGN KEY (`map_id`) REFERENCES `tb_mapeos` (`id_map`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_clientes_ibfk_2` FOREIGN KEY (`fecha_id`) REFERENCES `tb_fechas_limite` (`id_fecha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_facturaciones`
--
ALTER TABLE `tb_facturaciones`
  ADD CONSTRAINT `tb_facturaciones_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `tb_clientes` (`id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_facturaciones_ibfk_2` FOREIGN KEY (`precio_id`) REFERENCES `tb_precios` (`id_precio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tb_pagos`
--
ALTER TABLE `tb_pagos`
  ADD CONSTRAINT `tb_pagos_ibfk_1` FOREIGN KEY (`nro_factura`) REFERENCES `tb_facturaciones` (`nro_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_permisos`
--
ALTER TABLE `tb_permisos`
  ADD CONSTRAINT `tb_permisos_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tb_roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_precios`
--
ALTER TABLE `tb_precios`
  ADD CONSTRAINT `tb_precios_ibfk_1` FOREIGN KEY (`fecha_id`) REFERENCES `tb_fechas_limite` (`id_fecha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_reportes_g`
--
ALTER TABLE `tb_reportes_g`
  ADD CONSTRAINT `tb_reportes_g_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `tb_clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_reportes_g_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `tb_usuarios` (`id`);

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tb_roles` (`id_rol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
