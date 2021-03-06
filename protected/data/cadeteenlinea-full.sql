-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2015 a las 14:07:16
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cadeteenlinea`
--
CREATE DATABASE IF NOT EXISTS `cadeteenlinea` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cadeteenlinea`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

DROP TABLE IF EXISTS `apoderado`;
CREATE TABLE IF NOT EXISTS `apoderado` (
  `rut` int(10) unsigned NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `comuna` varchar(25) NOT NULL,
  `ciudad` varchar(25) NOT NULL,
  `region` varchar(25) NOT NULL,
  `fono` varchar(15) NOT NULL,
  `fonoComercial` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `difunto` enum('si','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`rut`, `direccion`, `comuna`, `ciudad`, `region`, `fono`, `fonoComercial`, `email`, `difunto`) VALUES
(5108249, 'Los alerces', 'Viña del Mar', 'Viña del Mar', 'Valparaiso', '56236563', NULL, NULL, 'no'),
(17558919, 'los alerces', 'Quilpue', 'Quilpue', 'Valparaiso', '96836377', NULL, 'seb.frab@gmail.com', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete`
--

DROP TABLE IF EXISTS `cadete`;
CREATE TABLE IF NOT EXISTS `cadete` (
  `rut` int(10) unsigned NOT NULL,
  `nCadete` int(10) unsigned NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `comuna` varchar(25) NOT NULL,
  `ciudad` varchar(25) NOT NULL,
  `region` varchar(25) NOT NULL,
  `curso` varchar(2) NOT NULL,
  `division` varchar(1) NOT NULL,
  `anoIngreso` int(10) unsigned NOT NULL,
  `anoNacimiento` int(10) unsigned NOT NULL,
  `mesNacimiento` int(10) unsigned NOT NULL,
  `diaNacimiento` int(10) unsigned NOT NULL,
  `lugarNacimiento` varchar(100) NOT NULL,
  `nacionalidad` varchar(25) NOT NULL,
  `seleccion` varchar(25) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `circulo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete`
--

INSERT INTO `cadete` (`rut`, `nCadete`, `direccion`, `comuna`, `ciudad`, `region`, `curso`, `division`, `anoIngreso`, `anoNacimiento`, `mesNacimiento`, `diaNacimiento`, `lugarNacimiento`, `nacionalidad`, `seleccion`, `nivel`, `circulo`) VALUES
(11111111, 76, 'los alerces', 'Quilpue', 'Quilpue', 'Valparaiso', '3A', '1', 2012, 1992, 7, 18, '', 'Chilena', '', '', NULL),
(22222222, 3, 'los alerces', 'Quilpue', 'Quilpue', 'Valparaiso', '1B', '5', 2015, 1996, 2, 27, '', 'Chilena', '', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete_apoderado`
--

DROP TABLE IF EXISTS `cadete_apoderado`;
CREATE TABLE IF NOT EXISTS `cadete_apoderado` (
`idcadete_apoderado` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `apoderado_rut` int(10) unsigned NOT NULL,
  `tipoApoderado` enum('Padre','Madre','Apoderado suplente','Apoderado Titular') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete_apoderado`
--

INSERT INTO `cadete_apoderado` (`idcadete_apoderado`, `cadete_rut`, `apoderado_rut`, `tipoApoderado`) VALUES
(1, 11111111, 17558919, 'Padre'),
(2, 22222222, 17558919, 'Padre'),
(3, 22222222, 5108249, 'Apoderado suplente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
`iddepartamento` int(10) unsigned NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `rut` int(10) unsigned NOT NULL,
  `departamento_iddepartamento` int(10) unsigned DEFAULT NULL,
  `tipo` enum('Administrador','administrativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

DROP TABLE IF EXISTS `transaccion`;
CREATE TABLE IF NOT EXISTS `transaccion` (
`idtransaccion` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `tipoTransaccion` enum('Cargo','Abono') NOT NULL,
  `monto` bigint(10) NOT NULL,
  `fechaMovimiento` datetime NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `tipoCuenta` enum('Cta Cte','Colegiatura','Equipo') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`idtransaccion`, `cadete_rut`, `tipoTransaccion`, `monto`, `fechaMovimiento`, `descripcion`, `tipoCuenta`) VALUES
(19, 11111111, 'Cargo', 48100, '2013-05-17 11:53:32', 'Seguro por permanencia', 'Cta Cte'),
(20, 11111111, 'Abono', 48100, '2013-06-06 11:48:56', 'Transferencia Chile-Edw.', 'Cta Cte'),
(21, 11111111, 'Cargo', 51129, '2013-06-19 12:16:49', 'Seguro escolar', 'Cta Cte'),
(22, 11111111, 'Abono', 51129, '2013-07-11 08:49:05', 'Transferencia Chile-Edw.', 'Cta Cte'),
(23, 11111111, 'Cargo', 3646, '2013-08-14 17:34:33', 'Recuerdo fiesta de aniversario', 'Cta Cte'),
(24, 11111111, 'Cargo', 21234, '2013-08-23 09:20:03', 'Fiesta generacional', 'Cta Cte'),
(25, 11111111, 'Abono', 24880, '2013-09-06 15:23:54', 'Transferencia Chile-Edw.', 'Cta Cte'),
(27, 11111111, 'Cargo', 35512, '2014-04-10 16:36:38', 'Fiesta generacional', 'Cta Cte'),
(28, 11111111, 'Cargo', 48601, '2014-04-25 11:48:21', 'Seguro por permanencia', 'Cta Cte'),
(29, 11111111, 'Abono', 48601, '2014-05-09 09:25:50', 'Transferencia Chile-Edw.', 'Cta Cte'),
(30, 11111111, 'Cargo', 53737, '2014-05-16 10:20:08', 'Seguro escolar', 'Cta Cte'),
(31, 11111111, 'Cargo', 5049, '2014-05-23 14:56:31', 'Sala de venta', 'Cta Cte'),
(32, 11111111, 'Abono', 35512, '2014-06-06 14:21:19', 'Transferencia Chile-Edw.', 'Cta Cte'),
(33, 11111111, 'Cargo', -137, '2014-07-02 10:24:46', 'Corrección de cobro', 'Cta Cte'),
(34, 11111111, 'Abono', 5049, '2014-07-21 08:42:33', 'Transferencia Chile-Edw.', 'Cta Cte'),
(35, 11111111, 'Abono', 53600, '2014-08-06 08:54:32', 'Transferencia Chile-Edw.', 'Cta Cte'),
(36, 11111111, 'Cargo', 72250, '2015-03-31 11:55:01', 'Seguro por permanencia', 'Cta Cte'),
(37, 11111111, 'Cargo', 48302, '2015-05-11 09:45:29', 'Seguro escolar', 'Cta Cte'),
(38, 11111111, 'Abono', 70166, '2015-05-11 12:31:16', 'Transferencia Chile-Edw.', 'Cta Cte'),
(39, 11111111, 'Cargo', 228045, '2013-02-11 15:48:27', 'Colegiatura Febrero 2013', 'Colegiatura'),
(40, 11111111, 'Cargo', 228470, '2013-03-12 12:09:58', 'Colegiatura Marco 2013', 'Colegiatura'),
(41, 11111111, 'Abono', 456998, '2013-03-21 14:13:17', 'Pago en caja Esc. Naval', 'Colegiatura'),
(42, 11111111, 'Cargo', 228731, '2013-04-02 16:54:19', 'Colegiatura Abril 2013', 'Colegiatura'),
(43, 11111111, 'Abono', 228731, '2013-04-09 09:08:57', 'Transferencia Chile-Edw.', 'Colegiatura'),
(44, 11111111, 'Abono', 229553, '2013-05-07 09:03:15', 'Transferencia Chile-Edw.', 'Colegiatura'),
(45, 11111111, 'Cargo', 229553, '2013-05-08 10:27:57', 'Colegiatura Mayo 2013', 'Colegiatura'),
(46, 11111111, 'Cargo', 228675, '2013-06-05 17:15:23', 'Colegiatura Junio 2013', 'Colegiatura'),
(47, 11111111, 'Abono', 228675, '2013-06-06 11:47:31', 'Transferencia Chile-Edw.', 'Colegiatura'),
(48, 11111111, 'Cargo', 228530, '2013-07-05 09:37:23', 'Colegiatura Julio 2013', 'Colegiatura'),
(49, 11111111, 'Abono', 228047, '2013-07-11 08:47:22', 'Transferencia Chile-Edw', 'Colegiatura'),
(50, 11111111, 'Cargo', 258044, '2014-02-10 14:04:33', 'Colegiatura Febrero 2014', 'Colegiatura'),
(51, 11111111, 'Cargo', 258685, '2014-03-04 09:57:24', 'Colegiatura Marzo 2014', 'Colegiatura'),
(52, 11111111, 'Abono', 258685, '2014-03-06 09:23:18', 'Transferencia Chile-Edw.', 'Colegiatura'),
(53, 11111111, 'Cargo', 259886, '2014-04-04 12:47:15', 'Colegiatura Abril 2014', 'Colegiatura'),
(54, 11111111, 'Abono', 259886, '2014-04-08 12:01:58', 'Transferencia Chile-Edw.', 'Colegiatura'),
(55, 11111111, 'Abono', 261855, '2014-05-09 09:32:34', 'Transferencia Chile-Edw.', 'Colegiatura'),
(56, 11111111, 'Cargo', 261855, '2014-05-13 09:38:27', 'Colegiatura Mayo 2014', 'Colegiatura'),
(57, 11111111, 'Abono', 263503, '2014-06-06 14:24:34', 'Transferencia Chile-Edw.', 'Colegiatura'),
(58, 11111111, 'Cargo', -889, '2014-07-01 12:43:06', 'Variación UF-Colegiatura', 'Colegiatura'),
(59, 11111111, 'Cargo', 264392, '2014-07-02 14:48:18', 'Colegiatura Junio 2014', 'Colegiatura'),
(60, 11111111, 'Abono', 258044, '2014-07-21 08:40:59', 'Transferencia Chile-Edw', 'Colegiatura'),
(61, 11111111, 'Cargo', 269954, '2015-02-04 14:26:13', 'Colegiatura Febrero 2015', 'Colegiatura'),
(62, 11111111, 'Abono', 269954, '2015-02-16 15:24:37', 'Transferencia Chile-Edw.', 'Colegiatura'),
(63, 11111111, 'Cargo', 270046, '2015-03-02 16:08:08', 'Colegiatura Marzo 2015', 'Colegiatura'),
(64, 11111111, 'Abono', 270046, '2015-03-09 10:36:16', 'Transferencia Chile-Edw.', 'Colegiatura'),
(65, 11111111, 'Cargo', 271025, '2015-04-08 10:52:49', 'Colegiatura Abril 2015', 'Colegiatura'),
(66, 11111111, 'Cargo', 272574, '2015-05-06 17:02:31', 'Colegiatura Mayo 2015', 'Colegiatura'),
(67, 11111111, 'Abono', 272574, '2015-05-11 12:35:09', 'Transferencia Chile-Edw.', 'Colegiatura'),
(68, 11111111, 'Cargo', 2049986, '2013-03-08 20:26:57', 'Cargo Pack Equipo Inicial', 'Equipo'),
(69, 11111111, 'Abono', 1059063, '2013-12-04 16:33:59', 'Pago en caja Esc. Naval\r\n', 'Equipo'),
(70, 11111111, 'Abono', 990923, '2013-09-09 16:33:59', 'Pago en caja Esc. Naval', 'Equipo'),
(71, 22222222, 'Cargo', 15082, '2015-03-11 12:31:04', 'Sala de venta', 'Cta Cte'),
(72, 22222222, 'Cargo', 14543, '2015-03-11 12:40:11', 'Sala de venta', 'Cta Cte'),
(73, 22222222, 'Cargo', 8171, '2015-03-12 11:44:39', 'Sala de venta', 'Cta Cte'),
(74, 22222222, 'Cargo', 59003, '2015-03-25 08:42:00', 'Seguro por permanencia', 'Cta Cte'),
(75, 22222222, 'Cargo', 48301, '2015-05-11 10:04:01', 'Seguro escolar', 'Cta Cte'),
(76, 22222222, 'Abono', 130000, '2015-05-19 10:04:01', 'Pago con cheque a fecha', 'Cta Cte'),
(77, 22222222, 'Cargo', 269954, '2015-02-04 14:49:52', 'Colegiatura Febrero 2015', 'Colegiatura'),
(78, 22222222, 'Cargo', 560, '2015-03-02 12:52:41', 'Variación UF-Colegiatura Febrero', 'Colegiatura'),
(79, 22222222, 'Cargo', 270046, '2015-03-02 16:08:10', 'Colegiatura Marzo 2015', 'Colegiatura'),
(80, 22222222, 'Abono', 270055, '2015-03-12 10:13:31', 'Pago Portal Banco Chile', 'Colegiatura'),
(81, 22222222, 'Cargo', 271025, '2015-04-08 10:59:19', 'Colegiatura Abril 2015', 'Colegiatura'),
(82, 22222222, 'Abono', 271489, '2015-04-22 11:45:29', 'Pago Portal Banco Chile', 'Colegiatura'),
(83, 22222222, 'Cargo', 272574, '2015-05-06 17:12:31', 'Colegiatura Mayo 2015', 'Colegiatura'),
(84, 22222222, 'Abono', 1847033, '2015-01-20 17:28:09', 'Pago en caja Esc. Naval', 'Equipo'),
(85, 22222222, 'Cargo', 368088, '2015-01-28 16:02:20', 'Cargo Pack Equipo Inicial', 'Equipo'),
(86, 22222222, 'Cargo', 107429, '2015-02-04 14:47:29', 'Cargo Pack Equipo Inicial', 'Equipo'),
(87, 22222222, 'Cargo', 27921, '2015-02-04 15:05:03', 'Cargo Pack Equipo Inicial', 'Equipo'),
(88, 22222222, 'Cargo', 31002, '2015-03-04 12:44:28', 'Cargo Pack Equipo Inicial', 'Equipo'),
(89, 22222222, 'Cargo', 213712, '2015-03-26 11:06:12', 'Cargo Pack Equipo Inicial', 'Equipo'),
(90, 22222222, 'Cargo', 21760, '2015-03-26 15:46:17', 'Cargo Pack Equipo Inicial', 'Equipo'),
(91, 22222222, 'Cargo', 93148, '2015-04-13 16:02:23', 'Cargo Pack Equipo Inicial', 'Equipo'),
(92, 22222222, 'Cargo', 205854, '2015-04-16 12:40:19', 'Cargo Pack Equipo Inicial', 'Equipo'),
(93, 22222222, 'Cargo', 42364, '2015-04-21 16:58:53', 'Cargo Pack Equipo Inicial', 'Equipo'),
(94, 22222222, 'Cargo', 90965, '2015-04-22 10:51:03', 'Cargo Pack Equipo Inicial', 'Equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `rut` int(10) unsigned NOT NULL,
  `apellidoPat` varchar(25) NOT NULL,
  `apellidoMat` varchar(25) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `password_2` varchar(250) NOT NULL,
  `perfil` enum('funcionario','apoderado','cadete') NOT NULL DEFAULT 'funcionario',
  `lastLogin` datetime DEFAULT NULL,
  `codVerificacion` varchar(10) DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `fechaVerificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `apellidoPat`, `apellidoMat`, `nombres`, `password_2`, `perfil`, `lastLogin`, `codVerificacion`, `email`, `fechaVerificacion`) VALUES
(5108249, 'Gaete', 'Lopez', 'Veronica Judith', 'asdasd', 'apoderado', NULL, NULL, '', NULL),
(11111111, 'Montenegro', 'García', 'Felipe Joaquin', 'asdasd', 'cadete', '0000-00-00 00:00:00', NULL, '', NULL),
(17558919, 'Franco', 'Brantes', 'Sebastian Elias', 'asdasd', 'apoderado', '0000-00-00 00:00:00', NULL, 'seb.frab@gmail.com', NULL),
(22222222, 'Vargas', 'García', 'Erika Lorena', 'asdasd', 'cadete', '0000-00-00 00:00:00', '\\Bv:[.U}@,', 'seb.frab@gmail.com', '2015-05-31 21:23:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
 ADD PRIMARY KEY (`rut`), ADD KEY `apoderado_FKIndex1` (`rut`);

--
-- Indices de la tabla `cadete`
--
ALTER TABLE `cadete`
 ADD PRIMARY KEY (`rut`), ADD KEY `cadete_FKIndex1` (`rut`);

--
-- Indices de la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
 ADD PRIMARY KEY (`idcadete_apoderado`), ADD KEY `cadete_apoderado_FKIndex1` (`apoderado_rut`), ADD KEY `cadete_apoderado_FKIndex2` (`cadete_rut`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
 ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`rut`), ADD KEY `funcionario_FKIndex1` (`rut`), ADD KEY `funcionario_FKIndex2` (`departamento_iddepartamento`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
 ADD PRIMARY KEY (`idtransaccion`), ADD KEY `transaccion_FKIndex1` (`cadete_rut`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`rut`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
MODIFY `idcadete_apoderado` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
MODIFY `iddepartamento` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
MODIFY `idtransaccion` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apoderado`
--
ALTER TABLE `apoderado`
ADD CONSTRAINT `apoderado_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cadete`
--
ALTER TABLE `cadete`
ADD CONSTRAINT `cadete_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
ADD CONSTRAINT `cadete_apoderado_ibfk_1` FOREIGN KEY (`apoderado_rut`) REFERENCES `apoderado` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `cadete_apoderado_ibfk_2` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`departamento_iddepartamento`) REFERENCES `departamento` (`iddepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
ADD CONSTRAINT `transaccion_ibfk_1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
