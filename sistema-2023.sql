-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-07-2023 a las 02:48:49
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema-2023`
--

-- --------------------------------------------------------



--
-- Creación de la tabla "cliente"
CREATE TABLE `cliente` (
  `idcliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `cedula` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `celular` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `pais` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `grupo_sangre` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Inserción de datos en la tabla "cliente"
INSERT INTO `cliente` (`idcliente`, `nombre`, `apellido`, `cedula`, `celular`, `pais`, `direccion`, `foto`, `grupo_sangre`) VALUES
(1, 'Luis', 'González', '123456789', '55555555', 'Argentina', 'Buenos Aires', 'foto1.jpg', 'A+'),
(2, 'Ana', 'Martínez', '987654321', '44444444', 'España', 'Madrid', 'foto2.jpg', 'B-');

-- Creación de la tabla "parentesco"
CREATE TABLE `parentesco` (
  `id` INT PRIMARY KEY,
  `cliente_id` INT,
  `nombre` VARCHAR(50),
  `relacion` VARCHAR(50),
  `edad` INT,
  `direccion` VARCHAR(100),
  FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`idcliente`)
);

-- Inserción de datos en la tabla "parentesco"
INSERT INTO `parentesco` (`id`, `cliente_id`, `nombre`, `relacion`, `edad`, `direccion`) VALUES
(1, 1, 'Pedro', 'Hermano', 25, 'Calle Principal 123'),
(2, 1, 'María', 'Hermana', 20, 'Avenida Central 456'),
(3, 2, 'Carlos', 'Padre', 50, 'Calle Secundaria 789');


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `nombre`, `telefono`, `email`, `direccion`) VALUES
(1, 'Sistemas Free', '98745698', 'ana.info1999@gamil.com', 'Trujillo');

-- --------------------------------------------------------

-- Crear tabla personal
CREATE TABLE personal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    documento_de_identidad INT,
    tipo_de_documento VARCHAR(50),
    imagen BLOB,
    fecha_de_expedicion DATE,
    nombre VARCHAR(50),
    segundo_nombre VARCHAR(50),
    apellido VARCHAR(50),
    fecha_de_nacimiento DATE,
    lugar_de_nacimiento VARCHAR(50),
    grupo_sanguinio VARCHAR(10),
    factor_RH VARCHAR(10),
    eps VARCHAR(50),
    arl VARCHAR(50),
    fondo_de_pensiones VARCHAR(50),
    fondo_cesantias VARCHAR(50),
    ccf VARCHAR(50),
    pais_de_residencia VARCHAR(50),
    departamento VARCHAR(50),
    municipio VARCHAR(50),
    direccion VARCHAR(100),
    estado_civil VARCHAR(50),
    telefono VARCHAR(20),
    celular VARCHAR(20),
    email VARCHAR(100)
);

-- Insertar informacion
INSERT INTO personal (documento_de_identidad, tipo_de_documento, imagen, fecha_de_expedicion, nombre, segundo_nombre, apellido, fecha_de_nacimiento, lugar_de_nacimiento, grupo_sanguinio, factor_RH, eps, arl, fondo_de_pensiones, fondo_cesantias, ccf, pais_de_residencia, departamento, municipio, direccion, estado_civil, telefono, celular, email)
VALUES (123456789, 'Cédula', 'ruta/imagen.jpg', '2022-01-01', 'Juan', 'Pablo', 'González', '1990-05-15', 'Bogotá', 'O+', 'Positivo', 'EPS001', 'ARL001', 'FondoPensiones001', 'FondoCesantias001', 'CCF001', 'Colombia', 'Cundinamarca', 'Bogotá', 'Calle 123', 'Soltero', '1234567', '987654321', 'juan@example.com');


--
-- Estructura de tabla para la tabla `detalle_permisos`
--

DROP TABLE IF EXISTS `detalle_permisos`;
CREATE TABLE IF NOT EXISTS `detalle_permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_permiso` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_permiso` (`id_permiso`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_permiso`, `id_usuario`) VALUES
(35, 3, 9),
(36, 4, 9),
(37, 5, 9),
(38, 6, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
CREATE TABLE IF NOT EXISTS `detalle_temp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_venta` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_venta` int NOT NULL,
  `cantidad` int NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_venta` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`) VALUES
(1, 'Colombia'),
(2, 'Ecuador'),
(3, 'Venezuela');


--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `pais_id`) VALUES
(1, 'Amazonas', 1),
(2, 'Antioquia', 1),
(3, 'Arauca', 1),
(4, 'Atlántico', 1),
(5, 'Bolívar', 1),
(6, 'Boyacá', 1),
(7, 'Caldas', 1),
(8, 'Caquetá', 1),
(9, 'Casanare', 1),
(10, 'Cauca', 1),
(11, 'Cesar', 1),
(12, 'Chocó', 1),
(13, 'Córdoba', 1),
(14, 'Cundinamarca', 1),
(15, 'Guainía', 1),
(16, 'Guaviare', 1),
(17, 'Huila', 1),
(18, 'La Guajira', 1),
(19, 'Magdalena', 1),
(20, 'Meta', 1),
(21, 'Nariño', 1),
(22, 'Norte de Santander', 1),
(23, 'Putumayo', 1),
(24, 'Quindío', 1),
(25, 'Risaralda', 1),
(26, 'San Andrés y Providencia', 1),
(27, 'Santander', 1),
(28, 'Sucre', 1),
(29, 'Tolima', 1),
(30, 'Valle del Cauca', 1),
(31, 'Vaupés', 1),
(32, 'Vichada', 1);

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `departamento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`, `departamento_id`) VALUES
(1, 'El Encanto', 1),
(2, 'La Chorrera', 1),
(3, 'La Pedrera', 1),
(4, 'La Victoria', 1),
(5, 'Leticia', 1),
(6, 'Miriti', 1),
(7, 'Puerto Alegria', 1),
(8, 'Puerto Arica', 1),
(9, 'Puerto Nariño', 1),
(10, 'Puerto Santander', 1),
(11, 'Tarapacá', 1),
(12, 'Yaguara', 1),
(13, 'Tarapacá', 2),
(14, 'Cáceres', 2),
(15, 'Caucasia', 2),
(16, 'El Bagre', 2),
(17, 'Nechí', 2),
(18, 'Tarazá', 2),
(19, 'Zaragoza', 2),
(20, 'Caracolí', 2),
(21, 'Maceo', 2),
(22, 'Puerto Berrio', 2),
(23, 'Puerto Nare', 2),
(24, 'Puerto Triunfo', 2),
(25, 'Yondó', 2),
(26, 'Amalfi', 2),
(27, 'Anorí', 2),
(28, 'Cisneros', 2),
(29, 'Remedios', 2),
(30, 'San Roque', 2),
(31, 'Santo Domingo', 2),
(32, 'Segovia', 2),
(33, 'Vegachí', 2),
(34, 'Yalí', 2),
(35, 'Yolombó', 2),
(36, 'Angostura', 2),
(37, 'Belmira', 2),
(38, 'Briceño', 2),
(39, 'Campamento', 2),
(40, 'Carolina', 2),
(41, 'Don Matias', 2),
(42, 'Entrerrios', 2),
(43, 'Gómez Plata', 2),
(44, 'Guadalupe', 2),
(45, 'Ituango', 2),
(46, 'San Andrés', 2),
(47, 'San José De La Montaña', 2),
(48, 'San Pedro', 2),
(49, 'Santa Rosa De Osos', 2),
(50, 'Toledo', 2),
(51, 'Valdivia', 2),
(52, 'Yarumal', 2),
(53, 'Abriaquí', 2),
(54, 'Anza', 2),
(55, 'Armenia', 2),
(56, 'Buriticá', 2),
(57, 'Cañasgordas', 2),
(58, 'Dabeiba', 2),
(59, 'Ebéjico', 2),
(60, 'Frontino', 2),
(61, 'Giraldo', 2),
(62, 'Heliconia', 2),
(63, 'Liborina', 2),
(64, 'Olaya', 2),
(65, 'Peque', 2),
(66, 'Sabanalarga', 2),
(67, 'San Jerónimo', 2),
(68, 'Santafé De Antioquia', 2),
(69, 'Sopetran', 2),
(70, 'Uramita', 2),
(71, 'Abejorral', 2),
(72, 'Alejandría', 2),
(73, 'Argelia', 2),
(74, 'Carmen De Viboral', 2),
(75, 'Cocorná', 2),
(76, 'Concepción', 2),
(77, 'Granada', 2),
(78, 'Guarne', 2),
(79, 'Guatape', 2),
(80, 'La Ceja', 2),
(81, 'La Unión', 2),
(82, 'Marinilla', 2),
(83, 'Nariño', 2),
(84, 'Peñol', 2),
(85, 'Retiro', 2),
(86, 'Rionegro', 2),
(87, 'San Carlos', 2),
(88, 'San Francisco', 2),
(89, 'San Luis', 2),
(90, 'San Rafael', 2),
(91, 'San Vicente', 2),
(92, 'Santuario', 2),
(93, 'Sonson', 2),
(94, 'Amaga', 2),
(95, 'Andes', 2),
(96, 'Angelopolis', 2),
(97, 'Betania', 2),
(98, 'Betulia', 2),
(99, 'Caicedo', 2),
(100, 'Caramanta', 2),
(101, 'Ciudad Bolívar', 2),
(102, 'Concordia', 2),
(103, 'Fredonia', 2),
(104, 'Hispania', 2),
(105, 'Jardín', 2),
(106, 'Jericó', 2),
(107, 'La Pintada', 2),
(108, 'Montebello', 2),
(109, 'Pueblorrico', 2),
(110, 'Salgar', 2),
(111, 'Santa Barbara', 2),
(112, 'Támesis', 2),
(113, 'Tarso', 2),
(114, 'Titiribí', 2),
(115, 'Urrao', 2),
(116, 'Valparaiso', 2),
(117, 'Venecia', 2),
(118, 'Apartadó', 2),
(119, 'Arboletes', 2),
(120, 'Carepa', 2),
(121, 'Chigorodó', 2),
(122, 'Murindó', 2),
(123, 'Mutata', 2),
(124, 'Necoclí', 2),
(125, 'San Juan De Uraba', 2),
(126, 'San Pedro De Uraba', 2),
(127, 'Turbo', 2),
(128, 'Vigía Del Fuerte', 2),
(129, 'Barbosa', 2),
(130, 'Bello', 2),
(131, 'Caldas', 2),
(132, 'Copacabana', 2),
(133, 'Envigado', 2),
(134, 'Girardota', 2),
(135, 'Itagui', 2),
(136, 'La Estrella', 2),
(137, 'Medellín', 2),
(138, 'Sabaneta', 2),
(139, 'Arauca', 3),
(140, 'Arauquita', 3),
(141, 'Cravo Norte', 3),
(142, 'Fortul', 3),
(143, 'Puerto Rondón', 3),
(144, 'Saravena', 3),
(145, 'Tame', 3),
(146, 'Barranquilla', 4),
(147, 'Galapa', 4),
(148, 'Malambo', 4),
(149, 'Puerto Colombia', 4),
(150, 'Soledad', 4),
(151, 'Campo De La Cruz', 4),
(152, 'Candelaria', 4),
(153, 'Luruaco', 4),
(154, 'Manati', 4),
(155, 'Repelon', 4),
(156, 'Santa Lucia', 4),
(157, 'Suan', 4),
(158, 'Baranoa', 4),
(159, 'Palmar De Varela', 4),
(160, 'Polonuevo', 4),
(161, 'Ponedera', 4),
(162, 'Sabanagrande', 4),
(163, 'Sabanalarga', 4),
(164, 'Santo Tomas', 4),
(165, 'Juan De Acosta', 4),
(166, 'Piojó', 4),
(167, 'Tubara', 4),
(168, 'Usiacuri', 4),
(169, 'Cicuco', 5),
(170, 'Hatillo De Loba', 5),
(171, 'Margarita', 5),
(172, 'Mompós', 5),
(173, 'San Fernando', 5),
(174, 'Talaigua Nuevo', 5),
(175, 'Arjona', 5),
(176, 'Arroyohondo', 5),
(177, 'Calamar', 5),
(178, 'Cartagena', 5),
(179, 'Clemencia', 5),
(180, 'Mahates', 5),
(181, 'San Cristobal', 5),
(182, 'San Estanislao', 5),
(183, 'Santa Catalina', 5),
(184, 'Santa Rosa De Lima', 5),
(185, 'Soplaviento', 5),
(186, 'Turbaco', 5),
(187, 'Turbana', 5),
(188, 'Villanueva', 5),
(189, 'Altos Del Rosario', 5),
(190, 'Barranco De Loba', 5),
(191, 'El Peñon', 5),
(192, 'Regidor', 5),
(193, 'Río Viejo', 5),
(194, 'San Martin De Loba', 5),
(195, 'Arenal', 5),
(196, 'Cantagallo', 5),
(197, 'Morales', 5),
(198, 'San Pablo', 5),
(199, 'Santa Rosa Del Sur', 5),
(200, 'Simití', 5),
(201, 'Achí', 5),
(202, 'Magangué', 5),
(203, 'Montecristo', 5),
(204, 'Pinillos', 5),
(205, 'San Jacinto Del Cauca', 5),
(206, 'Tiquisio', 5),
(207, 'Carmen De Bolívar', 5),
(208, 'Córdoba', 5),
(209, 'El Guamo', 5),
(210, 'María La Baja', 5),
(211, 'San Jacinto', 5),
(212, 'San Juan Nepomuceno', 5),
(213, 'Zambrano', 5),
(214, 'Chíquiza', 6),
(215, 'Chivatá', 6),
(216, 'Cómbita', 6),
(217, 'Cucaita', 6),
(218, 'Motavita', 6),
(219, 'Oicatá', 6),
(220, 'Samacá', 6),
(221, 'Siachoque', 6),
(222, 'Sora', 6),
(223, 'Soracá', 6),
(224, 'Sotaquirá', 6),
(225, 'Toca', 6),
(226, 'Tunja', 6),
(227, 'Tuta', 6),
(228, 'Ventaquemada', 6),
(229, 'Chiscas', 6),
(230, 'Cubará', 6),
(231, 'El Cocuy', 6),
(232, 'El Espino', 6),
(233, 'Guacamayas', 6),
(234, 'Güicán', 6),
(235, 'Panqueba', 6),
(236, 'Labranzagrande', 6),
(237, 'Pajarito', 6),
(238, 'Paya', 6),
(239, 'Pisba', 6),
(240, 'Berbeo', 6),
(241, 'Campohermoso', 6),
(242, 'Miraflores', 6),
(243, 'Páez', 6),
(244, 'San Eduardo', 6),
(245, 'Zetaquira', 6),
(246, 'Boyacá', 6),
(247, 'Ciénega', 6),
(248, 'Jenesano', 6),
(249, 'Nuevo Colón', 6),
(250, 'Ramiriquí', 6),
(251, 'Rondón', 6),
(252, 'Tibaná', 6),
(253, 'Turmequé', 6),
(254, 'Umbita', 6),
(255, 'Viracachá', 6),
(256, 'Chinavita', 6),
(257, 'Garagoa', 6),
(258, 'Macanal', 6),
(259, 'Pachavita', 6),
(260, 'San Luis De Gaceno', 6),
(261, 'Santa María', 6),
(262, 'Boavita', 6),
(263, 'Covarachía', 6),
(264, 'La Uvita', 6),
(265, 'San Mateo', 6),
(266, 'Sativanorte', 6),
(267, 'Sativasur', 6),
(268, 'Soatá', 6),
(269, 'Susacón', 6),
(270, 'Tipacoque', 6),
(271, 'Briceño', 6),
(272, 'Buenavista', 6),
(273, 'Caldas', 6),
(274, 'Chiquinquirá', 6),
(275, 'Coper', 6),
(276, 'La Victoria', 6),
(277, 'Maripí', 6),
(278, 'Muzo', 6),
(279, 'Otanche', 6),
(280, 'Pauna', 6),
(281, 'Puerto Boyacá', 6),
(282, 'Quípama', 6),
(283, 'Saboyá', 6),
(284, 'San Miguel De Sema', 6),
(285, 'San Pablo Borbur', 6),
(286, 'Tununguá', 6),
(287, 'Almeida', 6),
(288, 'Chivor', 6),
(289, 'Guateque', 6),
(290, 'Guayatá', 6),
(291, 'La Capilla', 6),
(292, 'Somondoco', 6),
(293, 'Sutatenza', 6),
(294, 'Tenza', 6),
(295, 'Arcabuco', 6),
(296, 'Chitaraque', 6),
(297, 'Gachantivá', 6),
(298, 'Moniquirá', 6),
(299, 'Ráquira', 6),
(300, 'Sáchica', 6),
(301, 'San José De Pare', 6),
(302, 'Santa Sofía', 6),
(303, 'Santana', 6),
(304, 'Sutamarchán', 6),
(305, 'Tinjacá', 6),
(306, 'Togüí', 6),
(307, 'Villa De Leyva', 6),
(308, 'Aquitania', 6),
(309, 'Cuítiva', 6),
(310, 'Firavitoba', 6),
(311, 'Gameza', 6),
(312, 'Iza', 6),
(313, 'Mongua', 6),
(314, 'Monguí', 6),
(315, 'Nobsa', 6),
(316, 'Pesca', 6),
(317, 'Sogamoso', 6),
(318, 'Tibasosa', 6),
(319, 'Tópaga', 6),
(320, 'Tota', 6),
(321, 'Belén', 6),
(322, 'Busbanzá', 6),
(323, 'Cerinza', 6),
(324, 'Corrales', 6),
(325, 'Duitama', 6),
(326, 'Floresta', 6),
(327, 'Paipa', 6),
(328, 'San Rosa Viterbo', 6),
(329, 'Tutazá', 6),
(330, 'Betéitiva', 6),
(331, 'Chita', 6),
(332, 'Jericó', 6),
(333, 'Paz De Río', 6),
(334, 'Socha', 6),
(335, 'Socotá', 6),
(336, 'Tasco', 6),
(337, 'Filadelfia', 7),
(338, 'La Merced', 7),
(339, 'Marmato', 7),
(340, 'Riosucio', 7),
(341, 'Supía', 7),
(342, 'Manzanares', 7),
(343, 'Marquetalia', 7),
(344, 'Marulanda', 7),
(345, 'Pensilvania', 7),
(346, 'Anserma', 7),
(347, 'Belalcázar', 7),
(348, 'Risaralda', 7),
(349, 'San José', 7),
(350, 'Viterbo', 7),
(351, 'Chinchiná', 7),
(352, 'Manizales', 7),
(353, 'Neira', 7),
(354, 'Palestina', 7),
(355, 'Villamaría', 7),
(356, 'Aguadas', 7),
(357, 'Aranzazu', 7),
(358, 'Pácora', 7),
(359, 'Salamina', 7),
(360, 'La Dorada', 7),
(361, 'Norcasia', 7),
(362, 'Samaná', 7),
(363, 'Victoria', 7),
(364, 'Albania', 8),
(365, 'Belén De Los Andaquies', 8),
(366, 'Cartagena Del Chairá', 8),
(367, 'Currillo', 8),
(368, 'El Doncello', 8),
(369, 'El Paujil', 8),
(370, 'Florencia', 8),
(371, 'La Montañita', 8),
(372, 'Milan', 8),
(373, 'Morelia', 8),
(374, 'Puerto Rico', 8),
(375, 'San Jose Del Fragua', 8),
(376, 'San Vicente Del Caguán', 8),
(377, 'Solano', 8),
(378, 'Solita', 8),
(379, 'Valparaiso', 8),
(380, 'Aguazul', 9),
(381, 'Chameza', 9),
(382, 'Hato Corozal', 9),
(383, 'La Salina', 9),
(384, 'Maní', 9),
(385, 'Monterrey', 9),
(386, 'Nunchía', 9),
(387, 'Orocué', 9),
(388, 'Paz De Ariporo', 9),
(389, 'Pore', 9),
(390, 'Recetor', 9),
(391, 'Sabanalarga', 9),
(392, 'Sácama', 9),
(393, 'San Luis De Palenque', 9),
(394, 'Támara', 9),
(395, 'Tauramena', 9),
(396, 'Trinidad', 9),
(397, 'Villanueva', 9),
(398, 'Yopal', 9),
(399, 'Cajibío', 10),
(400, 'El Tambo', 10),
(401, 'La Sierra', 10),
(402, 'Morales', 10),
(403, 'Piendamó', 10),
(404, 'Popayán', 10),
(405, 'Rosas', 10),
(406, 'Sotará', 10),
(407, 'Timbío', 10),
(408, 'Buenos Aires', 10),
(409, 'Caloto', 10),
(410, 'Corinto', 10),
(411, 'Miranda', 10),
(412, 'Padilla', 10),
(413, 'Puerto Tejada', 10),
(414, 'Santander de Quilichao', 10),
(415, 'Suárez', 10),
(416, 'Villa Rica', 10),
(417, 'Guapi', 10),
(418, 'López', 10),
(419, 'Timbiquí', 10),
(420, 'Caldono', 10),
(421, 'Inzá', 10),
(422, 'Jambaló', 10),
(423, 'Páez', 10),
(424, 'Puracé', 10),
(425, 'Silvia', 10),
(426, 'Toribío', 10),
(427, 'Totoró', 10),
(428, 'Almaguer', 10),
(429, 'Argelia', 10),
(430, 'Balboa', 10),
(431, 'Bolívar', 10),
(432, 'Florencia', 10),
(433, 'La Vega', 10),
(434, 'Mercaderes', 10),
(435, 'Patía', 10),
(436, 'Piamonte', 10),
(437, 'San Sebastián', 10),
(438, 'Santa Rosa', 10),
(439, 'Sucre', 10),
(440, 'Becerril', 11),
(441, 'Chimichagua', 11),
(442, 'Chiriguaná', 11),
(443, 'Curumaní', 11),
(444, 'La Jagua De Ibirico', 11),
(445, 'Pailitas', 11),
(446, 'Tamalameque', 11),
(447, 'Astrea', 11),
(448, 'Bosconia', 11),
(449, 'El Copey', 11),
(450, 'El Paso', 11),
(451, 'Agustín Codazzi', 11),
(452, 'La Paz', 11),
(453, 'Manaure', 11),
(454, 'Pueblo Bello', 11),
(455, 'San Diego', 11),
(456, 'Valledupar', 11),
(457, 'Aguachica', 11),
(458, 'Gamarra', 11),
(459, 'González', 11),
(460, 'La Gloria', 11),
(461, 'Pelaya', 11),
(462, 'Río De Oro', 11),
(463, 'San Alberto', 11),
(464, 'San Martín', 11),
(465, 'Atrato', 12),
(466, 'Bagadó', 12),
(467, 'Bojaya', 12),
(468, 'El Carmen De Atrato', 12),
(469, 'Lloró', 12),
(470, 'Medio Atrato', 12),
(471, 'Quibdó', 12),
(472, 'Rio Quito', 12),
(473, 'Acandí', 12),
(474, 'Belén De Bajirá', 12),
(475, 'Carmen Del Darién', 12),
(476, 'Riosucio', 12),
(477, 'Unguía', 12),
(478, 'Bahía Solano', 12),
(479, 'Juradó', 12),
(480, 'Nuquí', 12),
(481, 'Alto Baudó', 12),
(482, 'Bajo Baudó', 12),
(483, 'El Litoral Del San Juan', 12),
(484, 'Medio Baudó', 12),
(485, 'Cantón De San Pablo', 12),
(486, 'Certegui', 12),
(487, 'Condoto', 12),
(488, 'Itsmina', 12),
(489, 'Medio San Juan', 12),
(490, 'Nóvita', 12),
(491, 'Río Frío', 12),
(492, 'San José Del Palmar', 12),
(493, 'Sipí', 12),
(494, 'Tadó', 12),
(495, 'Unión Panamericana', 12),
(496, 'Tierralta', 13),
(497, 'Valencia', 13),
(498, 'Chimá', 13),
(499, 'Cotorra', 13),
(500, 'Lorica', 13),
(501, 'Momil', 13),
(502, 'Purísima', 13),
(503, 'Montería', 13),
(504, 'Canalete', 13),
(505, 'Los Córdobas', 13),
(506, 'Moñitos', 13),
(507, 'Puerto Escondido', 13),
(508, 'San Antero', 13),
(509, 'San Bernardo Del Viento', 13),
(510, 'Chinú', 13),
(511, 'Sahagún', 13),
(512, 'San Andrés Sotavento', 13),
(513, 'Ayapel', 13),
(514, 'Buenavista', 13),
(515, 'La Apartada', 13),
(516, 'Montelíbano', 13),
(517, 'Planeta Rica', 13),
(518, 'Pueblo Nuevo', 13),
(519, 'Puerto Libertador', 13),
(520, 'Cereté', 13),
(521, 'Ciénaga De Oro', 13),
(522, 'San Carlos', 13),
(523, 'San Pelayo', 13),
(524, 'Bogotá', 14),
(525, 'Chocontá', 14),
(526, 'Machetá', 14),
(527, 'Manta', 14),
(528, 'Sesquilé', 14),
(529, 'Suesca', 14),
(530, 'Tibirita', 14),
(531, 'Villapinzón', 14),
(532, 'Agua De Dios', 14),
(533, 'Girardot', 14),
(534, 'Guataquí', 14),
(535, 'Jerusalén', 14),
(536, 'Nariño', 14),
(537, 'Nilo', 14),
(538, 'Ricaurte', 14),
(539, 'Tocaima', 14),
(540, 'Caparrapí', 14),
(541, 'Guaduas', 14),
(542, 'Puerto Salgar', 14),
(543, 'Albán', 14),
(544, 'La Peña', 14),
(545, 'La Vega', 14),
(546, 'Nimaima', 14),
(547, 'Nocaima', 14),
(548, 'Quebradanegra', 14),
(549, 'San Francisco', 14),
(550, 'Sasaima', 14),
(551, 'Supatá', 14),
(552, 'Útica', 14),
(553, 'Vergara', 14),
(554, 'Villeta', 14),
(555, 'Gachalá', 14),
(556, 'Gachetá', 14),
(557, 'Gama', 14),
(558, 'Guasca', 14),
(559, 'Guatavita', 14),
(560, 'Junín', 14),
(561, 'La Calera', 14),
(562, 'Ubalá', 14),
(563, 'Beltrán', 14),
(564, 'Bituima', 14),
(565, 'Chaguaní', 14),
(566, 'Guayabal De Síquima', 14),
(567, 'Puli', 14),
(568, 'San Juan De Río Seco', 14),
(569, 'Vianí', 14),
(570, 'Medina', 14),
(571, 'Paratebueno', 14),
(572, 'Cáqueza', 14),
(573, 'Chipaque', 14),
(574, 'Choachí', 14),
(575, 'Fómeque', 14),
(576, 'Fosca', 14),
(577, 'Guayabetal', 14),
(578, 'Gutiérrez', 14),
(579, 'Quetame', 14),
(580, 'Ubaque', 14),
(581, 'Une', 14),
(582, 'El Peñón', 14),
(583, 'La Palma', 14),
(584, 'Pacho', 14),
(585, 'Paime', 14),
(586, 'San Cayetano', 14),
(587, 'Topaipí', 14),
(588, 'Villagómez', 14),
(589, 'Yacopí', 14),
(590, 'Cajicá', 14),
(591, 'Chía', 14),
(592, 'Cogua', 14),
(593, 'Gachancipá', 14),
(594, 'Nemocón', 14),
(595, 'Sopó', 14),
(596, 'Tabio', 14),
(597, 'Tocancipá', 14),
(598, 'Zipaquirá', 14),
(599, 'Bojacá', 14),
(600, 'Cota', 14),
(601, 'El Rosal', 14),
(602, 'Facatativá', 14),
(603, 'Funza', 14),
(604, 'Madrid', 14),
(605, 'Mosquera', 14),
(606, 'Subachoque', 14),
(607, 'Tenjo', 14),
(608, 'Zipacón', 14),
(609, 'Sibaté', 14),
(610, 'Soacha', 14),
(611, 'Arbeláez', 14),
(612, 'Cabrera', 14),
(613, 'Fusagasugá', 14),
(614, 'Granada', 14),
(615, 'Pandi', 14),
(616, 'Pasca', 14),
(617, 'San Bernardo', 14),
(618, 'Silvania', 14),
(619, 'Tibacuy', 14),
(620, 'Venecia', 14),
(621, 'Anapoima', 14),
(622, 'Anolaima', 14),
(623, 'Apulo', 14),
(624, 'Cachipay', 14),
(625, 'El Colegio', 14),
(626, 'La Mesa', 14),
(627, 'Quipile', 14),
(628, 'San Antonio Del Tequendama', 14),
(629, 'Tena', 14),
(630, 'Viotá', 14),
(631, 'Carmen De Carupa', 14),
(632, 'Cucunubá', 14),
(633, 'Fúquene', 14),
(634, 'Guachetá', 14),
(635, 'Lenguazaque', 14),
(636, 'Simijaca', 14),
(637, 'Susa', 14),
(638, 'Sutatausa', 14),
(639, 'Tausa', 14),
(640, 'Ubaté', 14),
(853, 'Barranco Mina', 15),
(854, 'Cacahual', 15),
(855, 'Inírida', 15),
(856, 'La Guadalupe', 15),
(857, 'Mapiripan', 15),
(858, 'Morichal', 15),
(859, 'Pana Pana', 15),
(860, 'Puerto Colombia', 15),
(861, 'San Felipe', 15),
(862, 'Calamar', 16),
(863, 'El Retorno', 16),
(864, 'Miraflores', 16),
(865, 'San José Del Guaviare', 16),
(866, 'Agrado', 17),
(867, 'Altamira', 17),
(868, 'Garzón', 17),
(869, 'Gigante', 17),
(870, 'Guadalupe', 17),
(871, 'Pital', 17),
(872, 'Suaza', 17),
(873, 'Tarqui', 17),
(874, 'Aipe', 17),
(875, 'Algeciras', 17),
(876, 'Baraya', 17),
(877, 'Campoalegre', 17),
(878, 'Colombia', 17),
(879, 'Hobo', 17),
(880, 'Iquira', 17),
(881, 'Neiva', 17),
(882, 'Palermo', 17),
(883, 'Rivera', 17),
(884, 'Santa María', 17),
(885, 'Tello', 17),
(886, 'Teruel', 17),
(887, 'Villavieja', 17),
(888, 'Yaguará', 17),
(889, 'La Argentina', 17),
(890, 'La Plata', 17),
(891, 'Nátaga', 17),
(892, 'Paicol', 17),
(893, 'Tesalia', 17),
(894, 'Acevedo', 17),
(895, 'Elías', 17),
(896, 'Isnos', 17),
(897, 'Oporapa', 17),
(898, 'Palestina', 17),
(899, 'Pitalito', 17),
(900, 'Saladoblanco', 17),
(901, 'San Agustín', 17),
(902, 'Timaná', 17),
(903, 'Albania', 18),
(904, 'Dibulla', 18),
(905, 'Maicao', 18),
(906, 'Manaure', 18),
(907, 'Riohacha', 18),
(908, 'Uribia', 18),
(909, 'Barrancas', 18),
(910, 'Distracción', 18),
(911, 'El Molino', 18),
(912, 'Fonseca', 18),
(913, 'Hatonuevo', 18),
(914, 'La Jagua Del Pilar', 18),
(915, 'San Juan Del Cesar', 18),
(916, 'Urumita', 18),
(917, 'Villanueva', 18),
(918, 'Ariguaní', 19),
(919, 'Chibolo', 19),
(920, 'Nueva Granada', 19),
(921, 'Plato', 19),
(922, 'Sabanas De San Angel', 19),
(923, 'Tenerife', 19),
(924, 'Algarrobo', 19),
(925, 'Aracataca', 19),
(926, 'Ciénaga', 19),
(927, 'El Retén', 19),
(928, 'Fundación', 19),
(929, 'Pueblo Viejo', 19),
(930, 'Zona Bananera', 19),
(931, 'Cerro San Antonio', 19),
(932, 'Concordia', 19),
(933, 'El Piñón', 19),
(934, 'Pedraza', 19),
(935, 'Pivijay', 19),
(936, 'Remolino', 19),
(937, 'Salamina', 19),
(938, 'Sitionuevo', 19),
(939, 'Zapayán', 19),
(940, 'Santa Marta', 19),
(941, 'El Banco', 19),
(942, 'Guamal', 19),
(943, 'Pijiño Del Carmen', 19),
(944, 'San Sebastian De Buenavista', 19),
(945, 'San Zenón', 19),
(946, 'Santa Ana', 19),
(947, 'Santa Bárbara De Pinto', 19),
(948, 'El Castillo', 20),
(949, 'El Dorado', 20),
(950, 'Fuente De Oro', 20),
(951, 'Granada', 20),
(952, 'La Macarena', 20),
(953, 'La Uribe', 20),
(954, 'Lejanías', 20),
(955, 'Mapiripán', 20),
(956, 'Mesetas', 20),
(957, 'Puerto Concordia', 20),
(958, 'Puerto Lleras', 20),
(959, 'Puerto Rico', 20),
(960, 'San Juan De Arama', 20),
(961, 'Vista Hermosa', 20),
(962, 'Villavicencio', 20),
(963, 'Acacias', 20),
(964, 'Barranca De Upía', 20),
(965, 'Castilla La Nueva', 20),
(966, 'Cumaral', 20),
(967, 'El Calvario', 20),
(968, 'Guamal', 20),
(969, 'Restrepo', 20),
(970, 'San Carlos Guaroa', 20),
(971, 'San Juanito', 20),
(972, 'San Luis De Cubarral', 20),
(973, 'San Martín', 20),
(974, 'Cabuyaro', 20),
(975, 'Puerto Gaitán', 20),
(976, 'Puerto López', 20),
(977, 'Chachagüí', 21),
(978, 'Consacá', 21),
(979, 'El Peñol', 21),
(980, 'El Tambo', 21),
(981, 'La Florida', 21),
(982, 'Nariño', 21),
(983, 'Pasto', 21),
(984, 'Sandoná', 21),
(985, 'Tangua', 21),
(986, 'Yacuanquer', 21),
(987, 'Ancuya', 21),
(988, 'Guaitarilla', 21),
(989, 'La Llanada', 21),
(990, 'Linares', 21),
(991, 'Los Andes', 21),
(992, 'Mallama', 21),
(993, 'Ospina', 21),
(994, 'Providencia', 21),
(995, 'Ricaurte', 21),
(996, 'Samaniego', 21),
(997, 'Santa Cruz', 21),
(998, 'Sapuyes', 21),
(999, 'Túquerres', 21),
(1000, 'Barbacoas', 21),
(1001, 'El Charco', 21),
(1002, 'Francisco Pizarro', 21),
(1003, 'La Tola', 21),
(1004, 'Magüí', 21),
(1005, 'Mosquera', 21),
(1006, 'Olaya Herrera', 21),
(1007, 'Roberto Payán', 21),
(1008, 'Santa Bárbara', 21),
(1009, 'Tumaco', 21),
(1010, 'Albán', 21),
(1011, 'Arboleda', 21),
(1012, 'Belén', 21),
(1013, 'Buesaco', 21),
(1014, 'Colón', 21),
(1015, 'Cumbitara', 21),
(1016, 'El Rosario', 21),
(1017, 'El Tablón de Gómez', 21),
(1018, 'La Cruz', 21),
(1019, 'La Unión', 21),
(1020, 'Leiva', 21),
(1021, 'Policarpa', 21),
(1022, 'San Bernardo', 21),
(1023, 'San Lorenzo', 21),
(1024, 'San Pablo', 21),
(1025, 'San Pedro de Cartago', 21),
(1026, 'Taminango', 21),
(1027, 'Aldana', 21),
(1028, 'Contadero', 21),
(1029, 'Córdoba', 21),
(1030, 'Cuaspud', 21),
(1031, 'Cumbal', 21),
(1032, 'Funes', 21),
(1033, 'Guachucal', 21),
(1034, 'Gualmatán', 21),
(1035, 'Iles', 21),
(1036, 'Imués', 21),
(1037, 'Ipiales', 21),
(1038, 'Potosí', 21),
(1039, 'Puerres', 21),
(1040, 'Pupiales', 21),
(1041, 'Arboledas', 22),
(1042, 'Cucutilla', 22),
(1043, 'Gramalote', 22),
(1044, 'Lourdes', 22),
(1045, 'Salazar', 22),
(1046, 'Santiago', 22),
(1047, 'Villa Caro', 22),
(1048, 'Bucarasica', 22),
(1049, 'El Tarra', 22),
(1050, 'Sardinata', 22),
(1051, 'Tibú', 22),
(1052, 'Abrego', 22),
(1053, 'Cachirá', 22),
(1054, 'Convención', 22),
(1055, 'El Carmen', 22),
(1056, 'Hacarí', 22),
(1057, 'La Esperanza', 22),
(1058, 'La Playa', 22),
(1059, 'Ocaña', 22),
(1060, 'San Calixto', 22),
(1061, 'Teorama', 22),
(1062, 'Cúcuta', 22),
(1063, 'El Zulia', 22),
(1064, 'Los Patios', 22),
(1065, 'Puerto Santander', 22),
(1066, 'San Cayetano', 22),
(1067, 'Villa Del Rosario', 22),
(1068, 'Cácota', 22),
(1069, 'Chitagá', 22),
(1070, 'Mutiscua', 22),
(1071, 'Pamplona', 22),
(1072, 'Pamplonita', 22),
(1073, 'Silos', 22),
(1074, 'Bochalema', 22),
(1075, 'Chinácota', 22),
(1076, 'Durania', 22),
(1077, 'Herrán', 22),
(1078, 'Labateca', 22),
(1079, 'Ragonvalia', 22),
(1080, 'Toledo', 22),
(1081, 'Colón', 23),
(1082, 'Mocoa', 23),
(1083, 'Orito', 23),
(1084, 'Puerto Asís', 23),
(1085, 'Puerto Caicedo', 23),
(1086, 'Puerto Guzmán', 23),
(1087, 'Puerto Leguízamo', 23),
(1088, 'San Francisco', 23),
(1089, 'San Miguel', 23),
(1090, 'Santiago', 23),
(1091, 'Sibundoy', 23),
(1092, 'Valle del Guamuez', 23),
(1093, 'Villa Garzón', 23),
(1094, 'Armenia', 24),
(1095, 'Buenavista', 24),
(1096, 'Calarcá', 24),
(1097, 'Córdoba', 24),
(1098, 'Génova', 24),
(1099, 'Pijao', 24),
(1100, 'Filandia', 24),
(1101, 'Salento', 24),
(1102, 'Circasia', 24),
(1103, 'La Tebaida', 24),
(1104, 'Montenegro', 24),
(1105, 'Quimbaya', 24),
(1106, 'Dosquebradas', 25),
(1107, 'La Virginia', 25),
(1108, 'Marsella', 25),
(1109, 'Pereira', 25),
(1110, 'Santa Rosa de Cabal', 25),
(1111, 'Apía', 25),
(1112, 'Balboa', 25),
(1113, 'Belén de Umbría', 25),
(1114, 'Guática', 25),
(1115, 'La Celia', 25),
(1116, 'Quinchía', 25),
(1117, 'Santuario', 25),
(1118, 'Mistrató', 25),
(1119, 'Pueblo Rico', 25),
(1120, 'Providencia y Santa Catalina', 26),
(1121, 'San Andrés', 26),
(1122, 'Chimá', 27),
(1123, 'Confines', 27),
(1124, 'Contratación', 27),
(1125, 'El Guacamayo', 27),
(1126, 'Galán', 27),
(1127, 'Gambita', 27),
(1128, 'Guadalupe', 27),
(1129, 'Guapotá', 27),
(1130, 'Hato', 27),
(1131, 'Oiba', 27),
(1132, 'Palmar', 27),
(1133, 'Palmas del Socorro', 27),
(1134, 'Santa Helena del Opón', 27),
(1135, 'Simacota', 27),
(1136, 'Socorro', 27),
(1137, 'Suaita', 27),
(1138, 'Capitanejo', 27),
(1139, 'Carcasí', 27),
(1140, 'Cepitá', 27),
(1141, 'Cerrito', 27),
(1142, 'Concepción', 27),
(1143, 'Enciso', 27),
(1144, 'Guaca', 27),
(1145, 'Macaravita', 27),
(1146, 'Málaga', 27),
(1147, 'Molagavita', 27),
(1148, 'San Andrés', 27),
(1149, 'San José de Miranda', 27),
(1150, 'San Miguel', 27),
(1151, 'Aratoca', 27),
(1152, 'Barichara', 27),
(1153, 'Cabrera', 27),
(1154, 'Charalá', 27),
(1155, 'Coromoro', 27),
(1156, 'Curití', 27),
(1157, 'Encino', 27),
(1158, 'Jordán', 27),
(1159, 'Mogotes', 27),
(1160, 'Ocamonte', 27),
(1161, 'Onzaga', 27),
(1162, 'Páramo', 27),
(1163, 'Pinchote', 27),
(1164, 'San Gil', 27),
(1165, 'San Joaquín', 27),
(1166, 'Valle de San José', 27),
(1167, 'Villanueva', 27),
(1168, 'Barrancabermeja', 27),
(1169, 'Betulia', 27),
(1170, 'El Carmen de Chucurí', 27),
(1171, 'Puerto Wilches', 27),
(1172, 'Sabana de Torres', 27),
(1173, 'San Vicente de Chucurí', 27),
(1174, 'Zapatoca', 27),
(1175, 'Bucaramanga', 27),
(1176, 'California', 27),
(1177, 'Charta', 27),
(1178, 'El Playón', 27),
(1179, 'Floridablanca', 27),
(1180, 'Girón', 27),
(1181, 'Lebríja', 27),
(1182, 'Los Santos', 27),
(1183, 'Matanza', 27),
(1184, 'Piedecuesta', 27),
(1185, 'Rionegro', 27),
(1186, 'Santa Bárbara', 27),
(1187, 'Suratá', 27),
(1188, 'Tona', 27),
(1189, 'Vetas', 27),
(1190, 'Aguada', 27),
(1191, 'Albania', 27),
(1192, 'Barbosa', 27),
(1193, 'Bolívar', 27),
(1194, 'Chipatá', 27),
(1195, 'Cimitarra', 27),
(1196, 'El Peñón', 27),
(1197, 'Florián', 27),
(1198, 'Guavatá', 27),
(1199, 'Güepsa', 27),
(1200, 'Jesús María', 27),
(1201, 'La Belleza', 27),
(1202, 'La Paz', 27),
(1203, 'Landázuri', 27),
(1204, 'Puente Nacional', 27),
(1205, 'Puerto Parra', 27),
(1206, 'San Benito', 27),
(1207, 'Sucre', 27),
(1208, 'Vélez', 27),
(1209, 'Guaranda', 28),
(1210, 'Majagual', 28),
(1211, 'Sucre', 28),
(1212, 'Chalán', 28),
(1213, 'Coloso', 28),
(1214, 'Morroa', 28),
(1215, 'Ovejas', 28),
(1216, 'Sincelejo', 28),
(1217, 'Coveñas', 28),
(1218, 'Palmito', 28),
(1219, 'San Onofre', 28),
(1220, 'Santiago de Tolú', 28),
(1221, 'Tolú Viejo', 28),
(1222, 'Buenavista', 28),
(1223, 'Corozal', 28),
(1224, 'El Roble', 28),
(1225, 'Galeras', 28),
(1226, 'Los Palmitos', 28),
(1227, 'Sampués', 28),
(1228, 'San Juan Betulia', 28),
(1229, 'San Pedro', 28),
(1230, 'Sincé', 28),
(1231, 'Caimito', 28),
(1232, 'La Unión', 28),
(1233, 'San Benito Abad', 28),
(1234, 'San Marcos', 28),
(1235, 'Ambalema', 29),
(1236, 'Armero', 29),
(1237, 'Falan', 29),
(1238, 'Fresno', 29),
(1239, 'Honda', 29),
(1240, 'Mariquita', 29),
(1241, 'Palocabildo', 29),
(1242, 'Carmen de Apicalá', 29),
(1243, 'Cunday', 29),
(1244, 'Icononzo', 29),
(1245, 'Melgar', 29),
(1246, 'Villarrica', 29),
(1247, 'Ataco', 29),
(1248, 'Chaparral', 29),
(1249, 'Coyaima', 29),
(1250, 'Natagaima', 29),
(1251, 'Ortega', 29),
(1252, 'Planadas', 29),
(1253, 'Rioblanco', 29),
(1254, 'Roncesvalles', 29),
(1255, 'San Antonio', 29),
(1256, 'Alvarado', 29),
(1257, 'Anzoátegui', 29),
(1258, 'Cajamarca', 29),
(1259, 'Coello', 29),
(1260, 'Espinal', 29),
(1261, 'Flandes', 29),
(1262, 'Ibagué', 29),
(1263, 'Piedras', 29),
(1264, 'Rovira', 29),
(1265, 'San Luis', 29),
(1266, 'Valle de San Juan', 29),
(1267, 'Alpujarra', 29),
(1268, 'Dolores', 29),
(1269, 'Guamo', 29),
(1270, 'Prado', 29),
(1271, 'Purificación', 29),
(1272, 'Saldaña', 29),
(1273, 'Suárez', 29),
(1274, 'Casabianca', 29),
(1275, 'Herveo', 29),
(1276, 'Lérida', 29),
(1277, 'Libano', 29),
(1278, 'Murillo', 29),
(1279, 'Santa Isabel', 29),
(1280, 'Venadillo', 29),
(1281, 'Villahermosa', 29),
(1282, 'Andalucía', 30),
(1283, 'Buga', 30),
(1284, 'Bugalagrande', 30),
(1285, 'Calima', 30),
(1286, 'El Cerrito', 30),
(1287, 'Ginebra', 30),
(1288, 'Guacarí', 30),
(1289, 'Restrepo', 30),
(1290, 'Riofrio', 30),
(1291, 'San Pedro', 30),
(1292, 'Trujillo', 30),
(1293, 'Tuluá', 30),
(1294, 'Yotoco', 30),
(1295, 'Alcalá', 30),
(1296, 'Ansermanuevo', 30),
(1297, 'Argelia', 30),
(1298, 'Bolívar', 30),
(1299, 'Cartago', 30),
(1300, 'El Águila', 30),
(1301, 'El Cairo', 30),
(1302, 'El Dovio', 30),
(1303, 'La Unión', 30),
(1304, 'La Victoria', 30),
(1305, 'Obando', 30),
(1306, 'Roldanillo', 30),
(1307, 'Toro', 30),
(1308, 'Ulloa', 30),
(1309, 'Versalles', 30),
(1310, 'Zarzal', 30),
(1311, 'Buenaventura', 30),
(1312, 'Caicedonia', 30),
(1313, 'Sevilla', 30),
(1314, 'Cali', 30),
(1315, 'Candelaria', 30),
(1316, 'Dagua', 30),
(1317, 'Florida', 30),
(1318, 'Jamundí', 30),
(1319, 'La Cumbre', 30),
(1320, 'Palmira', 30),
(1321, 'Pradera', 30),
(1322, 'Vijes', 30),
(1323, 'Yumbo', 30),
(1324, 'Caruru', 31),
(1325, 'Mitú', 31),
(1326, 'Pacoa', 31),
(1327, 'Papunahua', 31),
(1328, 'Taraira', 31),
(1329, 'Yavaraté', 31),
(1330, 'Cumaribo', 32),
(1331, 'La Primavera', 32),
(1332, 'Puerto Carreño', 32),
(1333, 'Santa Rosalía', 32);


-- --------------------------------------------------------

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento_id` (`departamento_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_ibfk_1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);
COMMIT;
    

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(1, 'configuración'),
(2, 'usuarios'),
(3, 'clientes'),
(4, 'productos'),
(5, 'ventas'),
(6, 'nueva_venta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `codproducto` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int NOT NULL,
  PRIMARY KEY (`codproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `codigo`, `descripcion`, `precio`, `existencia`) VALUES
(1, '123456', 'Televisor Lg', '1500.00', 34),
(2, '13256445', 'Celular Lg', '800.00', 2),
(3, '97879846', 'Impresora epson L300', '500.00', 3),
(4, '978798', 'Computadora Lenovo', '3000.00', 41),
(5, '7977989', 'Scanner', '350.00', 4),
(6, '78879978', 'Arroz Trujillo', '15.00', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`) VALUES
(1, 'Sistemas Free', 'ana.info1999@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(9, 'Maria Sanchez', 'maria@gmail.com', 'maria', '263bce650e68ab4e23f28263760b9fa5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_permisos`

ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
