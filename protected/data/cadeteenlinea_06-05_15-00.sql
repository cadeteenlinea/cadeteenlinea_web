-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2015 a las 20:00:35
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderado`
--

CREATE TABLE IF NOT EXISTS `apoderado` (
  `rut` int(10) unsigned NOT NULL,
  `apellidoPat` varchar(25) NOT NULL,
  `apellidoMat` varchar(25) NOT NULL,
  `nombres` varchar(50) NOT NULL,
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

INSERT INTO `apoderado` (`rut`, `apellidoPat`, `apellidoMat`, `nombres`, `direccion`, `comuna`, `ciudad`, `region`, `fono`, `fonoComercial`, `email`, `difunto`) VALUES
(17558919, 'Franco', 'Brantes', 'Sebastián Elias', 'los alerces', 'Quilpue', 'Quilpue', 'Valparaiso', '96836377', NULL, 'seb.frab@gmail.com', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete`
--

CREATE TABLE IF NOT EXISTS `cadete` (
  `rut` int(10) unsigned NOT NULL,
  `nCadete` int(10) unsigned NOT NULL,
  `apellidoPat` varchar(25) NOT NULL,
  `apellidoMat` varchar(25) NOT NULL,
  `nombres` varchar(50) NOT NULL,
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
  `circulo` varchar(25) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete`
--

INSERT INTO `cadete` (`rut`, `nCadete`, `apellidoPat`, `apellidoMat`, `nombres`, `direccion`, `comuna`, `ciudad`, `region`, `curso`, `division`, `anoIngreso`, `anoNacimiento`, `mesNacimiento`, `diaNacimiento`, `lugarNacimiento`, `nacionalidad`, `seleccion`, `nivel`, `circulo`, `email`) VALUES
(11111111, 76, 'Montenegro', 'García', 'Felipe Joaquin', 'los alerces', 'Quilpue', 'Quilpue', 'Valparaiso', '3A', '1', 2012, 1992, 7, 18, '', 'Chilena', '', '', NULL, NULL),
(22222222, 3, 'Montenegro', 'García', 'Erika Lorena', 'los alerces', 'Quilpue', 'Quilpue', 'Valparaiso', '1B', '5', 2015, 1996, 2, 27, '', 'Chilena', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete_apoderado`
--

CREATE TABLE IF NOT EXISTS `cadete_apoderado` (
`idcadete_apoderado` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `apoderado_rut` int(10) unsigned NOT NULL,
  `tipoApoderado` enum('Padre','Madre','Apoderado suplente','Apoderado Titular') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete_apoderado`
--

INSERT INTO `cadete_apoderado` (`idcadete_apoderado`, `cadete_rut`, `apoderado_rut`, `tipoApoderado`) VALUES
(1, 11111111, 17558919, 'Padre'),
(2, 22222222, 17558919, 'Padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
`iddepartamento` int(10) unsigned NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `rut` int(10) unsigned NOT NULL,
  `departamento_iddepartamento` int(10) unsigned DEFAULT NULL,
  `apellidoPat` varchar(25) NOT NULL,
  `apellidoMat` varchar(25) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `tipo` enum('Administrador','administrativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE IF NOT EXISTS `transaccion` (
`idtransaccion` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `tipoTransaccion` enum('Cargo','Abono') NOT NULL,
  `monto` int(10) unsigned NOT NULL,
  `fechaMovimiento` datetime NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `tipoCuenta` enum('Cta Cte','Colegiatura','Equipo') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`idtransaccion`, `cadete_rut`, `tipoTransaccion`, `monto`, `fechaMovimiento`, `descripcion`, `tipoCuenta`) VALUES
(1, 11111111, 'Cargo', 2350000, '2015-05-01 00:00:00', '', 'Cta Cte'),
(2, 11111111, 'Cargo', 32000, '2015-05-02 00:00:00', '', 'Cta Cte'),
(3, 22222222, 'Cargo', 2000000, '2015-05-03 00:00:00', '', 'Cta Cte'),
(4, 11111111, 'Abono', 50235, '2015-05-14 06:39:21', 'Fiesta', 'Cta Cte'),
(5, 11111111, 'Abono', 560000, '2015-05-07 04:32:14', 'Adelanto de cobros', 'Colegiatura'),
(6, 22222222, 'Abono', 50000, '2015-05-11 00:00:00', 'Abono por cobros mal hechos', 'Equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `rut` int(10) unsigned NOT NULL,
  `password_2` varchar(250) NOT NULL,
  `perfil` enum('funcionario','apoderado','cadete') NOT NULL DEFAULT 'funcionario',
  `lastLogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `password_2`, `perfil`, `lastLogin`) VALUES
(11111111, 'asdasd', 'cadete', '0000-00-00 00:00:00'),
(17558919, 'asdasd', 'apoderado', '0000-00-00 00:00:00'),
(22222222, 'asdasd', 'cadete', '0000-00-00 00:00:00');

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
MODIFY `idcadete_apoderado` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
MODIFY `iddepartamento` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
MODIFY `idtransaccion` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
