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

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` INT NOT NULL AUTO_INCREMENT,
  `nombre_departamento` VARCHAR(50) NOT NULL,
  `pais` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserción de datos en la tabla `departamentos` para Colombia
INSERT INTO `departamentos` (`nombre_departamento`, `pais`) VALUES
('Amazonas', 'Colombia'),
('Antioquia', 'Colombia'),
('Arauca', 'Colombia'),
('Atlántico', 'Colombia'),
('Bolívar', 'Colombia'),
('Boyacá', 'Colombia'),
('Caldas', 'Colombia'),
('Caquetá', 'Colombia'),
('Casanare', 'Colombia'),
('Cauca', 'Colombia'),
('Cesar', 'Colombia'),
('Chocó', 'Colombia'),
('Córdoba', 'Colombia'),
('Cundinamarca', 'Colombia'),
('Guainía', 'Colombia'),
('Guaviare', 'Colombia'),
('Huila', 'Colombia'),
('La Guajira', 'Colombia'),
('Magdalena', 'Colombia'),
('Meta', 'Colombia'),
('Nariño', 'Colombia'),
('Norte de Santander', 'Colombia'),
('Putumayo', 'Colombia'),
('Quindío', 'Colombia'),
('Risaralda', 'Colombia'),
('San Andrés y Providencia', 'Colombia'),
('Santander', 'Colombia'),
('Sucre', 'Colombia'),
('Tolima', 'Colombia'),
('Valle del Cauca', 'Colombia'),
('Vaupés', 'Colombia'),
('Vichada', 'Colombia');

-- Inserción de datos en la tabla `departamentos` para Ecuador
INSERT INTO `departamentos` (`nombre_departamento`, `pais`) VALUES
('Azuay', 'Ecuador'),
('Bolívar', 'Ecuador'),
('Cañar', 'Ecuador'),
('Carchi', 'Ecuador'),
('Chimborazo', 'Ecuador'),
('Cotopaxi', 'Ecuador'),
('El Oro', 'Ecuador'),
('Esmeraldas', 'Ecuador'),
('Galápagos', 'Ecuador'),
('Guayas', 'Ecuador'),
('Imbabura', 'Ecuador'),
('Loja', 'Ecuador'),
('Los Ríos', 'Ecuador'),
('Manabí', 'Ecuador'),
('Morona Santiago', 'Ecuador'),
('Napo', 'Ecuador'),
('Orellana', 'Ecuador'),
('Pastaza', 'Ecuador'),
('Pichincha', 'Ecuador'),
('Santa Elena', 'Ecuador'),
('Santo Domingo de los Tsáchilas', 'Ecuador'),
('Sucumbíos', 'Ecuador'),
('Tungurahua', 'Ecuador'),
('Zamora Chinchipe', 'Ecuador');

-- Inserción de datos en la tabla `departamentos` para Venezuela
INSERT INTO `departamentos` (`nombre_departamento`, `pais`) VALUES
('Amazonas', 'Venezuela'),
('Anzoátegui', 'Venezuela'),
('Apure', 'Venezuela'),
('Aragua', 'Venezuela'),
('Barinas', 'Venezuela'),
('Bolívar', 'Venezuela'),
('Carabobo', 'Venezuela'),
('Cojedes', 'Venezuela'),
('Delta Amacuro', 'Venezuela'),
('Falcón', 'Venezuela'),
('Guárico', 'Venezuela'),
('Lara', 'Venezuela'),
('Mérida', 'Venezuela'),
('Miranda', 'Venezuela'),
('Monagas', 'Venezuela'),
('Nueva Esparta', 'Venezuela'),
('Portuguesa', 'Venezuela'),
('Sucre', 'Venezuela'),
('Táchira', 'Venezuela'),
('Trujillo', 'Venezuela'),
('Vargas', 'Venezuela'),
('Yaracuy', 'Venezuela'),
('Zulia', 'Venezuela');

-- --------------------------------------------------------

--
-- Crear tabla Municipios
CREATE TABLE Municipios (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(100),
    Departamento VARCHAR(100),
    Pais VARCHAR(100)
);

-- Insertar municipios del departamento de Amazonas
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (1, 'Leticia', 'Amazonas', 'Colombia'),
    (2, 'Puerto Nariño', 'Amazonas', 'Colombia');

-- Insertar municipios del departamento de Antioquia
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (3, 'Medellín', 'Antioquia', 'Colombia'),
    (4, 'Bello', 'Antioquia', 'Colombia'),
    (5, 'Envigado', 'Antioquia', 'Colombia');

-- Insertar municipios del departamento de Atlántico
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (6, 'Barranquilla', 'Atlántico', 'Colombia'),
    (7, 'Soledad', 'Atlántico', 'Colombia'),
    (8, 'Malambo', 'Atlántico', 'Colombia');

-- Continuar con los demás departamentos y sus municipios

-- Insertar municipios del departamento de Bolívar
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (9, 'Cartagena', 'Bolívar', 'Colombia'),
    (10, 'Magangué', 'Bolívar', 'Colombia'),
    (11, 'El Carmen de Bolívar', 'Bolívar', 'Colombia');

-- Insertar municipios del departamento de Boyacá
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (12, 'Tunja', 'Boyacá', 'Colombia'),
    (13, 'Duitama', 'Boyacá', 'Colombia'),
    (14, 'Sogamoso', 'Boyacá', 'Colombia');

-- Insertar municipios del departamento de Caldas
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (15, 'Manizales', 'Caldas', 'Colombia'),
    (16, 'Pereira', 'Caldas', 'Colombia'),
    (17, 'La Dorada', 'Caldas', 'Colombia');

-- Insertar municipios del departamento de Caquetá
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (18, 'Florencia', 'Caquetá', 'Colombia'),
    (19, 'San Vicente del Caguán', 'Caquetá', 'Colombia'),
    (20, 'Puerto Rico', 'Caquetá', 'Colombia');

-- Continuar con los demás departamentos y sus municipios

-- Insertar municipios del departamento de Cundinamarca
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (47, 'Bogotá', 'Cundinamarca', 'Colombia'),
    (48, 'Soacha', 'Cundinamarca', 'Colombia'),
    (49, 'Zipaquirá', 'Cundinamarca', 'Colombia');

-- Insertar municipios del departamento de Guainía
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (51, 'Inírida', 'Guainía', 'Colombia');

-- Insertar municipios del departamento de Guaviare
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (52, 'San José del Guaviare', 'Guaviare', 'Colombia');

-- Insertar municipios del departamento de Huila
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (53, 'Neiva', 'Huila', 'Colombia'),
    (54, 'Pitalito', 'Huila', 'Colombia'),
    (55, 'Garzón', 'Huila', 'Colombia');

-- Continuar con los demás departamentos y sus municipios

-- Insertar municipios del departamento de Valle del Cauca
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (102, 'Cali', 'Valle del Cauca', 'Colombia'),
    (103, 'Buenaventura', 'Valle del Cauca', 'Colombia'),
    (104, 'Palmira', 'Valle del Cauca', 'Colombia');

-- Insertar municipios del departamento de Vaupés
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (106, 'Mitú', 'Vaupés', 'Colombia');

-- Insertar municipios del departamento de Vichada
INSERT INTO Municipios (ID, Nombre, Departamento, Pais)
VALUES
    (107, 'Puerto Carreño', 'Vichada', 'Colombia');

-- --------------------------------------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capital` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idioma_oficial` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `moneda` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `poblacion` int DEFAULT NULL,
  `area` int DEFAULT NULL,
  `continente` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `codigo_pais` varchar(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prefijo_telefonico` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cctld` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`, `capital`, `idioma_oficial`, `moneda`, `poblacion`, `area`, `continente`, `codigo_pais`, `prefijo_telefonico`, `cctld`) VALUES
(1, 'Colombia', 'Bogotá', 'Español', 'Peso colombiano', 50372424, 1141748, 'América del Sur', 'CO', '+57', 'co'),
(2, 'Ecuador', 'Quito', 'Español', 'Dólar estadounidense', 4088589, 108849, 'América del Sur', 'EC', '+593', 'ec'),
(3, 'Venezuela', 'Caracas', 'Español', 'Bolívar soberano', 28870195, 916445, 'América del Sur', 'VE', '+58', 've');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
