-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2024 a las 00:43:36
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `nombre`, `apellido`, `telefono`, `email`) VALUES
(5, 'Carloss', 'Gomez', '555-0202', 'carlos.gomez@example.com'),
(6, 'Juan', 'Carmen', '32521521', 'Tumama@ja.com'),
(7, 'Joseph Daniel', 'Rhomandt Bermudez', '3042018728', 'jdrhomandtb@itc.edu.co'),
(9, 'Carlos', 'Espermatrago', '31584484', 'cestrago@email.com'),
(12, 'Luis', 'Asturias', '4441464818', 'Luis@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `idFactura` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturacion`
--

INSERT INTO `facturacion` (`idFactura`, `idCliente`, `idMascota`, `idServicio`, `fecha`, `total`) VALUES
(4, 6, 12, 2, '2024-04-17', 30.00),
(5, 5, 11, 1, '2024-04-17', 55.00),
(6, 5, 11, 3, '2024-04-16', 40.00),
(7, 9, 20, 3, '2024-04-04', 40.00),
(8, 7, 18, 3, '2024-04-23', 40.00),
(9, 7, 21, 4, '2024-04-23', 200.00),
(10, 5, 11, 3, '2024-04-24', 40.00),
(11, 5, 11, 4, '2024-04-26', 200.00),
(12, 12, 23, 6, '2024-04-23', 80.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialesclinicos`
--

CREATE TABLE `historialesclinicos` (
  `idHistorial` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historialesclinicos`
--

INSERT INTO `historialesclinicos` (`idHistorial`, `idMascota`, `fecha`, `descripcion`) VALUES
(1, 11, '2024-04-18', 'CREACION DE HISTORIAL'),
(2, 20, '2024-04-23', 'CREACIÓN DE HISTORIAL'),
(3, 21, '2024-04-23', 'CREACIÓN DE HISTORIAL'),
(4, 11, '2024-04-24', 'Facturación del servicio \'Peluquería\' por un monto de 40.00.'),
(5, 11, '2024-04-26', 'Facturación del servicio \'Cirugía menor\' por un monto de 200.00.'),
(6, 22, '2024-04-24', 'CREACIÓN DE HISTORIAL'),
(7, 23, '2024-04-24', 'CREACIÓN DE HISTORIAL'),
(8, 23, '2024-04-23', 'Facturación del servicio \'Corte de uñas\' por un monto de 80.00.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `idMascota` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `raza` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `tamano` varchar(50) DEFAULT NULL,
  `anoNacimiento` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`idMascota`, `idCliente`, `nombre`, `especie`, `raza`, `color`, `tamano`, `anoNacimiento`) VALUES
(11, 5, 'Rockyy', 'Perro', 'Labrador', 'Dorado', 'Grande', '2017'),
(12, 6, 'Bella', 'Perro', 'Husky', 'Gris y blanco', 'Grande', '2018'),
(15, 6, 'LUIS', 'CAN', 'LABRADOR', 'DORADO', '80cm', '2019'),
(17, 5, 'Steve', 'Perro', 'Muerto', 'Criollo', '40cm', '2012'),
(18, 7, 'Kira', 'Gato', 'Australian Labradoodle', 'Gris', '35cm', '2016'),
(19, 7, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 'Prueba', '2023'),
(20, 9, 'Jertrudis', 'Cerdo', 'Criollo', 'Rosa', 'Como tu mama', '2023'),
(21, 7, 'Manolo', 'Gato', 'Criollo', 'Blanco', '30cm', '2016'),
(22, 6, 'Estefano', 'Cuy', 'De comer', 'Cafe', 'Mediano', '2022'),
(23, 12, 'Niquita', 'Perro', 'Bulldog', 'Blanca', 'Grande', '2014');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorios`
--

CREATE TABLE `recordatorios` (
  `idRecordatorio` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `nombre`, `descripcion`, `costo`) VALUES
(1, 'Consulta general', 'Revisión médica básica y consulta.', 50.00),
(2, 'Vacunación', 'Aplicación de vacunas básicas y refuerzos.', 30.00),
(3, 'Peluquería', 'Corte de pelo, baño y limpieza general.', 40.00),
(4, 'Cirugía menor', 'Procedimientos quirúrgicos menores bajo anestesia.', 200.00),
(6, 'Corte de uñas', NULL, 80.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idMascota` (`idMascota`),
  ADD KEY `idServicio` (`idServicio`);

--
-- Indices de la tabla `historialesclinicos`
--
ALTER TABLE `historialesclinicos`
  ADD PRIMARY KEY (`idHistorial`),
  ADD KEY `idMascota` (`idMascota`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`idMascota`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD PRIMARY KEY (`idRecordatorio`),
  ADD KEY `idMascota` (`idMascota`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idServicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `historialesclinicos`
--
ALTER TABLE `historialesclinicos`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `idMascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  MODIFY `idRecordatorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`idMascota`) REFERENCES `mascotas` (`idMascota`),
  ADD CONSTRAINT `facturacion_ibfk_3` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`);

--
-- Filtros para la tabla `historialesclinicos`
--
ALTER TABLE `historialesclinicos`
  ADD CONSTRAINT `historialesclinicos_ibfk_1` FOREIGN KEY (`idMascota`) REFERENCES `mascotas` (`idMascota`);

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`);

--
-- Filtros para la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD CONSTRAINT `recordatorios_ibfk_1` FOREIGN KEY (`idMascota`) REFERENCES `mascotas` (`idMascota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
