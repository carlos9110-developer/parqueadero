-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2020 a las 04:53:29
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.3.19

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
(1, '1', 'parking la octava con 36', 'calle 8 cra 40', '3383179', 5, 10, 30, '2020-10-05', '0', '0'),
(2, '6', 'parking la octava con 36', 'calle 8 cra 40 editado', '3383179', 6, 10, 40, '2020-10-05', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `id` int(20) NOT NULL,
  `id_parqueadero` int(6) NOT NULL,
  `piso` int(6) DEFAULT NULL,
  `num_puestos_moto` int(6) DEFAULT NULL,
  `num_puestos_carros` int(6) DEFAULT NULL,
  `num_filas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id` int(20) NOT NULL,
  `id_piso` int(6) NOT NULL,
  `tipo_puesto` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `estado` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `fila` int(3) NOT NULL,
  `columna` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  `user` varchar(100) CHARACTER SET utf8 NOT NULL,
  `contrasena` varchar(150) CHARACTER SET utf8 NOT NULL,
  `estado` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'Activado',
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `telefono`, `correo`, `user`, `contrasena`, `estado`, `fecha_registro`) VALUES
(1, '24412210', 'Caros Eduardo Hincapie Hidalgo', '3383179', 'ce.hincapie19@ciaf.edu.co', 'ce.hincapie19@ciaf.edu.co_1111', '$2y$10$3l/TdXwSqJyxDg4WOVbFMOWjXXXFiG8umGoBMM2LkZavp0HoCJU2S', 'Activado', '2020-09-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_rol_parqueadero`
--

CREATE TABLE `usuarios_rol_parqueadero` (
  `id` int(20) NOT NULL,
  `id_usuario` int(6) NOT NULL,
  `id_parqueadero` int(6) NOT NULL,
  `id_rol` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_rol_parqueadero`
--
ALTER TABLE `usuarios_rol_parqueadero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_parqueadero` (`id_parqueadero`),
  ADD KEY `id_rol` (`id_rol`);

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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios_rol_parqueadero`
--
ALTER TABLE `usuarios_rol_parqueadero`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `usuarios_rol_parqueadero`
--
ALTER TABLE `usuarios_rol_parqueadero`
  ADD CONSTRAINT `usuarios_rol_parqueadero_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `usuarios_rol_parqueadero_ibfk_2` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id`),
  ADD CONSTRAINT `usuarios_rol_parqueadero_ibfk_3` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
