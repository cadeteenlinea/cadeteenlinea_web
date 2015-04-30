-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-04-2015 a las 21:56:07
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
  `nombres` varchar(75) NOT NULL,
  `apellidoPat` varchar(25) NOT NULL,
  `apellidoMat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`rut`, `nombres`, `apellidoPat`, `apellidoMat`) VALUES
(17558919, 'Sebastián Elias', 'Franco', 'Brantes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete`
--

CREATE TABLE IF NOT EXISTS `cadete` (
  `rut` int(10) unsigned NOT NULL,
  `nombres` varchar(75) NOT NULL,
  `apellidoPat` varchar(25) NOT NULL,
  `apellidoMat` varchar(25) NOT NULL,
  `curso` int(10) unsigned NOT NULL,
  `nCadete` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete`
--

INSERT INTO `cadete` (`rut`, `nombres`, `apellidoPat`, `apellidoMat`, `curso`, `nCadete`) VALUES
(11111111, 'Nombre de prueba 1', 'apellido pat 1', 'apellido mat 1', 1, 1),
(22222222, 'Nombre de prueba 2', 'apellido pat 2', 'apellido mat 2', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete_apoderado`
--

CREATE TABLE IF NOT EXISTS `cadete_apoderado` (
`idcadete_apoderado` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `apoderado_rut` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete_apoderado`
--

INSERT INTO `cadete_apoderado` (`idcadete_apoderado`, `cadete_rut`, `apoderado_rut`) VALUES
(1, 11111111, 17558919),
(2, 22222222, 17558919);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
`idperfil` int(10) unsigned NOT NULL,
  `codigo` varchar(3) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `codigo`, `nombre`, `descripcion`) VALUES
(1, 'AD', 'Administrador', 'Administrador de todo el sistema, acceso completo a los cadetes y usuarios'),
(2, 'CA', 'Cadete', ''),
(3, 'PA', 'Padre', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `rut` int(10) unsigned NOT NULL,
  `perfil_idperfil` int(10) unsigned NOT NULL,
  `password_2` varchar(250) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `perfil_idperfil`, `password_2`, `last_login`) VALUES
(17558919, 2, 'asdasd', '2015-04-30 16:46:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
 ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `cadete`
--
ALTER TABLE `cadete`
 ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
 ADD PRIMARY KEY (`idcadete_apoderado`), ADD KEY `cadete_apoderado_FKIndex1` (`apoderado_rut`), ADD KEY `cadete_apoderado_FKIndex2` (`cadete_rut`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`idperfil`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`rut`), ADD KEY `usuario_FKIndex1` (`perfil_idperfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
MODIFY `idcadete_apoderado` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
MODIFY `idperfil` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
