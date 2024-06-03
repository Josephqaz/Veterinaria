-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-06-2024 a las 04:49:14
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
(1, 'Camilo', 'Pérez', '555-1235', 'camilo.perez@example.com'),
(2, 'María', 'García', '555-5678', 'maria.garcia@example.com'),
(3, 'Pedro', 'Rodríguez', '555-8765', 'pedro.rodriguez@example.com'),
(4, 'Ana', 'López', '555-4321', 'ana.lopez@example.com'),
(5, 'Carlos', 'Martínez', '555-1111', 'carlos.martinez@example.com'),
(6, 'Lucía', 'Sánchez', '555-2222', 'lucia.sanchez@example.com'),
(7, 'Miguel', 'González', '555-3333', 'miguel.gonzalez@example.com'),
(8, 'Laura', 'Fernández', '555-4444', 'laura.fernandez@example.com'),
(9, 'Jorge', 'Gómez', '555-5555', 'jorge.gomez@example.com'),
(10, 'Sofía', 'Ruiz', '555-6666', 'sofia.ruiz@example.com');

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
(19, 40, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(20, 30, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(21, 31, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(22, 32, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(23, 33, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(24, 34, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(25, 35, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(26, 36, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(27, 37, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(28, 38, '2024-06-02', 'CREACIÓN DE HISTORIAL'),
(29, 39, '2024-06-02', 'CREACIÓN DE HISTORIAL');

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
(30, 1, 'Rex', 'Perro', 'Pastor Alemán', 'Negro y marrón', 'Grande', '2015'),
(31, 2, 'Luna', 'Gato', 'Siames', 'Blanco', 'Mediano', '2018'),
(32, 3, 'Max', 'Perro', 'Labrador', 'Dorado', 'Grande', '2016'),
(33, 4, 'Nina', 'Gato', 'Persa', 'Gris', 'Pequeño', '2019'),
(34, 5, 'Buddy', 'Perro', 'Beagle', 'Tricolor', 'Mediano', '2017'),
(35, 6, 'Bella', 'Perro', 'Chihuahua', 'Marrón', 'Pequeño', '2020'),
(36, 7, 'Simba', 'Gato', 'Maine Coon', 'Marrón y negro', 'Grande', '2016'),
(37, 8, 'Coco', 'Perro', 'Poodle', 'Blanco', 'Pequeño', '2019'),
(38, 9, 'Rocky', 'Perro', 'Bulldog', 'Marrón y blanco', 'Mediano', '2017'),
(39, 10, 'Milo', 'Gato', 'Bengala', 'Naranja', 'Mediano', '2021'),
(40, 6, 'Manolo', 'Gato', 'Siames', 'Blanco', 'Grande', '2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorios`
--

CREATE TABLE `recordatorios` (
  `idRecordatorio` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recordatorios`
--

INSERT INTO `recordatorios` (`idRecordatorio`, `idMascota`, `fecha`, `idServicio`) VALUES
(28, 30, '2024-06-01', 1),
(29, 31, '2024-06-15', 2),
(30, 32, '2024-07-01', 3),
(31, 33, '2024-07-15', 1),
(32, 34, '2024-08-01', 2),
(33, 35, '2024-08-15', 3),
(34, 36, '2024-09-01', 1),
(35, 37, '2024-09-15', 2),
(36, 38, '2024-10-01', 3),
(37, 39, '2024-10-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `nombre`, `costo`) VALUES
(1, 'Consulta general', 50.00),
(2, 'Vacunación', 30.00),
(3, 'Peluquería', 40.00),
(4, 'Cirugía menor', 200.00),
(6, 'Corte de uñas', 80.00),
(7, 'Baño completo', 30.00),
(8, 'Secado', 15.00);

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
  ADD KEY `idServicio` (`idServicio`),
  ADD KEY `facturacion_ibfk_2` (`idMascota`);

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
  ADD KEY `idMascota` (`idMascota`),
  ADD KEY `fk_recordatorios_servicios` (`idServicio`);

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
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `historialesclinicos`
--
ALTER TABLE `historialesclinicos`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `idMascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  MODIFY `idRecordatorio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD CONSTRAINT `facturacion_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `facturacion_ibfk_2` FOREIGN KEY (`idMascota`) REFERENCES `mascotas` (`idMascota`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `fk_recordatorios_servicios` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`),
  ADD CONSTRAINT `recordatorios_ibfk_1` FOREIGN KEY (`idMascota`) REFERENCES `mascotas` (`idMascota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
