-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2020 a las 16:12:31
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parqueadero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueaderos`
--

CREATE TABLE `parqueaderos` (
  `id` int(6) NOT NULL,
  `nit` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `direccion` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `telefono` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `pisos` int(5) NOT NULL,
  `capacidad_carros` int(10) NOT NULL,
  `capacidad_motos` int(10) NOT NULL,
  `fecha_registro` date NOT NULL,
  `configuracion_plano` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `registro_logo` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `parqueaderos`
--

INSERT INTO `parqueaderos` (`id`, `nit`, `nombre`, `direccion`, `telefono`, `pisos`, `capacidad_carros`, `capacidad_motos`, `fecha_registro`, `configuracion_plano`, `registro_logo`) VALUES
(1, '3232323', 'parqueadero la octava', 'calle 20 c', '3383179', 5, 10, 20, '2020-11-01', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `id` int(20) NOT NULL,
  `id_parqueadero` int(6) NOT NULL,
  `piso` int(6) DEFAULT NULL,
  `num_filas` int(3) NOT NULL,
  `num_columnas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `pisos`
--

INSERT INTO `pisos` (`id`, `id_parqueadero`, `piso`, `num_filas`, `num_columnas`) VALUES
(1, 1, 1, 4, 4),
(2, 1, 2, 4, 4),
(3, 1, 3, 4, 4),
(4, 1, 4, 4, 4),
(5, 1, 5, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id` int(20) NOT NULL,
  `id_piso` int(6) NOT NULL,
  `tipo_puesto` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` varchar(2) COLLATE latin1_general_ci DEFAULT 'L'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`id`, `id_piso`, `tipo_puesto`, `estado`) VALUES
(1, 1, 'M', 'L'),
(2, 1, 'M', 'L'),
(3, 1, 'M', 'L'),
(4, 1, 'M', 'L'),
(5, 1, 'M', 'L'),
(6, 1, 'M', 'L'),
(7, 1, 'M', 'L'),
(8, 1, 'M', 'L'),
(9, 1, 'M', 'L'),
(10, 1, 'M', 'L'),
(11, 1, 'M', 'L'),
(12, 1, 'M', 'L'),
(13, 1, 'M', 'L'),
(14, 1, 'M', 'L'),
(15, 1, 'M', 'L'),
(16, 1, 'M', 'L'),
(17, 2, 'C', 'L'),
(18, 2, 'C', 'L'),
(19, 2, 'C', 'L'),
(20, 2, 'C', 'L'),
(21, 2, 'C', 'L'),
(22, 2, 'C', 'L'),
(23, 2, 'C', 'L'),
(24, 2, 'C', 'L'),
(25, 2, 'C', 'L'),
(26, 2, 'C', 'L'),
(27, 2, 'C', 'L'),
(28, 2, 'C', 'L'),
(29, 2, 'C', 'L'),
(30, 2, 'C', 'L'),
(31, 2, 'C', 'L'),
(32, 2, 'C', 'L'),
(33, 3, 'M', 'L'),
(34, 3, 'M', 'L'),
(35, 3, 'M', 'L'),
(36, 3, 'M', 'L'),
(37, 3, 'M', 'L'),
(38, 3, 'M', 'L'),
(39, 3, 'M', 'L'),
(40, 3, 'M', 'L'),
(41, 3, 'M', 'L'),
(42, 3, 'M', 'L'),
(43, 3, 'M', 'L'),
(44, 3, 'M', 'L'),
(45, 3, 'M', 'L'),
(46, 3, 'M', 'L'),
(47, 3, 'M', 'L'),
(48, 3, 'M', 'L'),
(49, 4, 'C', 'L'),
(50, 4, 'C', 'L'),
(51, 4, 'C', 'L'),
(52, 4, 'C', 'L'),
(53, 4, 'C', 'L'),
(54, 4, 'C', 'L'),
(55, 4, 'C', 'L'),
(56, 4, 'C', 'L'),
(57, 4, 'C', 'L'),
(58, 4, 'C', 'L'),
(59, 4, 'C', 'L'),
(60, 4, 'C', 'L'),
(61, 4, 'C', 'L'),
(62, 4, 'C', 'L'),
(63, 4, 'C', 'L'),
(64, 4, 'C', 'L'),
(65, 5, 'M', 'L'),
(66, 5, 'M', 'L'),
(67, 5, 'M', 'L'),
(68, 5, 'M', 'L'),
(69, 5, 'C', 'L'),
(70, 5, 'C', 'L'),
(71, 5, 'C', 'L'),
(72, 5, 'C', 'L'),
(73, 5, 'M', 'L'),
(74, 5, 'M', 'L'),
(75, 5, 'M', 'L'),
(76, 5, 'M', 'L'),
(77, 5, 'C', 'L'),
(78, 5, 'C', 'L'),
(79, 5, 'C', 'L'),
(80, 5, 'C', 'L');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(5) NOT NULL,
  `rol` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) NOT NULL,
  `cedula` varchar(100) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL,
  `telefono` varchar(150) CHARACTER SET utf8 NOT NULL,
  `correo` varchar(150) CHARACTER SET utf8 NOT NULL,
  `estado` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT 'Activado',
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `telefono`, `correo`, `estado`, `fecha_registro`) VALUES
(1, '1088008382', 'Caros Eduardo Hincapie Hidalgo', '3383179', 'ce.hincapie19@ciaf.edu.co', 'Activado', '2020-09-14'),
(2, '24412210', 'Hector Ivan Correa', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-01'),
(3, '4352060', 'Carlos Eduardo Hincapie Hidalgo', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-01'),
(4, '10880083825', 'Hector Ivan Correa', '3207236603', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-01'),
(5, '999999', 'Hector Ivan Correa', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-01'),
(6, '212121', 'Carlos Eduardo Hincapie Hidalgo', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-01'),
(8, '2441221012', 'parqueadero la octava', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-06'),
(9, '333', 'Hector Ivan Correa', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-06'),
(11, '24412210111', 'Carlos Eduardo Hincapie Hidalgo', '3383179', 'ce.hincapie19editado@ciaf.edu.co', 'Activado', '2020-11-06'),
(12, '111111', 'Carlos Eduardo Hincapie Hidalgo editado2', '3115455293', 'ce.hincapie19editado2@ciaf.edu.co', 'Desactivado', '2020-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_parqueadero`
--

CREATE TABLE `usuarios_parqueadero` (
  `id` int(20) NOT NULL,
  `id_usuario` int(6) NOT NULL,
  `id_parqueadero` int(6) NOT NULL,
  `user` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `clave` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `estado` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT 'Activado'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `usuarios_parqueadero`
--

INSERT INTO `usuarios_parqueadero` (`id`, `id_usuario`, `id_parqueadero`, `user`, `clave`, `estado`) VALUES
(2, 1, 1, 'ce.hincapie19@ciaf.edu.co', '$2y$10$jmy3RVElIsXTWYO8PcwMFOGb5/ivGjPBgWwxM4mzDP7bP3cdgMLoC', 'Activado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_super_administradores`
--

CREATE TABLE `usuarios_super_administradores` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `clave` varchar(256) NOT NULL,
  `nombre` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios_super_administradores`
--

INSERT INTO `usuarios_super_administradores` (`id`, `user`, `clave`, `nombre`) VALUES
(1, '1088008382', '$2y$10$jmy3RVElIsXTWYO8PcwMFOGb5/ivGjPBgWwxM4mzDP7bP3cdgMLoC', 'Carlos Eduardo Hincapie Hidalgo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `parqueaderos`
--
ALTER TABLE `parqueaderos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nit` (`nit`);

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_parqueadero` (`id_parqueadero`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pisos` (`id_piso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios_parqueadero`
--
ALTER TABLE `usuarios_parqueadero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_parqueadero` (`id_parqueadero`);

--
-- Indices de la tabla `usuarios_super_administradores`
--
ALTER TABLE `usuarios_super_administradores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `parqueaderos`
--
ALTER TABLE `parqueaderos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios_parqueadero`
--
ALTER TABLE `usuarios_parqueadero`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios_super_administradores`
--
ALTER TABLE `usuarios_super_administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `pisos_ibfk_1` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id`);

--
-- Filtros para la tabla `puestos`
--
ALTER TABLE `puestos`
  ADD CONSTRAINT `puestos_ibfk_1` FOREIGN KEY (`id_piso`) REFERENCES `pisos` (`id`);

--
-- Filtros para la tabla `usuarios_parqueadero`
--
ALTER TABLE `usuarios_parqueadero`
  ADD CONSTRAINT `usuarios_parqueadero_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `usuarios_parqueadero_ibfk_2` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
