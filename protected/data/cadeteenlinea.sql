-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2015 a las 21:01:06
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
  `direccion` varchar(100) DEFAULT NULL,
  `comuna` varchar(25) DEFAULT NULL,
  `ciudad` varchar(25) DEFAULT NULL,
  `region` varchar(25) DEFAULT NULL,
  `fono` varchar(15) DEFAULT NULL,
  `fonoComercial` varchar(25) DEFAULT NULL,
  `difunto` enum('si','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `apoderado`
--

INSERT INTO `apoderado` (`rut`, `direccion`, `comuna`, `ciudad`, `region`, `fono`, `fonoComercial`, `difunto`) VALUES
(4954924, 'DIEGO PORTALES 629, DEPTO. 32', 'VALPARAISO', 'VALPARAISO', 'VALPARAISO', '032-2493746', '95793351', 'no'),
(6378128, 'AV. RAMIRO MÉNDEZ S/N', 'PARCELA MIRADOR', 'CAUQUENES', 'CAUQUENES', '073-511159', '95424777', 'no'),
(6392614, 'NUCELLA 130 CASA 2', 'REÑACA', 'VIÑA DEL MAR', 'VIÑA DEL MAR', NULL, '95424675', 'no'),
(6821677, 'AV. CIRCUNVALACION N° 1210', NULL, 'SAN FERNANDO', 'SAN FERNANDO', '072-2711904', '56840519', 'no'),
(7089557, 'AV.ALEMANIA #5522, CERRO', 'LA LOMA', 'VALPARAISO', 'VALPARAISO', '32-2256817', '9-3352312', 'no'),
(7763080, 'LOTEO SAN FRANCISCO, ALTO LAS', 'CRUCES Nº 25', 'TALCA', 'TALCA', '071-243991', NULL, 'no'),
(8016825, 'AVDA. RAMIRO MENDEZ SIN NUMERO', 'CAUQUENES', 'CAUQUENES', 'CAUQUENES', '073-511159', '95424777', 'no'),
(8551041, 'LOTEO SAN FRANCISCO, ALTO LAS', 'CRUCES Nº 25', 'TALCA', 'TALCA', '071-243991', '95186943', 'no'),
(8662591, 'AV. CIRCUNVALACION N° 1210', NULL, 'SAN FERNANDO', 'SAN FERNANDO', '072-2711904', '66266550', 'no'),
(9693262, 'AV.ALEMANIA #5522', NULL, 'VALPARAISO', 'VALPARAISO', '32-2256817', '9-8639368', 'no'),
(9707695, 'SALAR  DE GRANDE #18489, CIUDA', 'MAIPU', 'SANTIAGO', 'SANTIAGO', '02-9666800', '86840907', 'no'),
(9978078, '2 ORIENTE 494, DEPTO. 32', 'VIÑA DEL MAR', 'VIÑA DEL MAR', 'VIÑA DEL MAR', '95277896', '95277896', 'no'),
(10263684, 'SALAR DE GRANDE #18489, CIUDAD', 'MAIPU', 'SANTIAGO', 'SANTIAGO', '02-9666800', '53990682', 'no'),
(10738140, 'LAS AGATAS 489, DEPTO 707', 'REÑACA', 'VIÑA DEL MAR', 'VIÑA DEL MAR', '032-2483148', '93311267', 'no'),
(15121504, 'CARACAS N° 418', 'RECREO', 'VIÑA DEL MAR', 'VIÑA DEL MAR', NULL, '87634930', 'no'),
(16309340, '1 PONIENTE 1255, DP 241', NULL, 'VIÑA DEL MAR', 'VIÑA DEL MAR', NULL, NULL, 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
`idarchivos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `tipo_archivo_idtipo_archivo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos`
--

INSERT INTO `archivos` (`idarchivos`, `fecha`, `tipo_archivo_idtipo_archivo`) VALUES
(2, '2015-06-17 00:12:43', 2),
(3, '2015-06-17 01:22:30', 3),
(4, '2015-06-26 17:30:49', 4),
(5, '2015-07-10 00:44:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE IF NOT EXISTS `asignatura` (
  `idasignatura` int(11) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `ano` int(11) NOT NULL,
  `semestre` tinyint(4) NOT NULL,
  `curso` tinyint(4) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `especialidad_idespecialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete`
--

CREATE TABLE IF NOT EXISTS `cadete` (
  `rut` int(10) unsigned NOT NULL,
  `nCadete` int(10) unsigned NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `comuna` varchar(25) DEFAULT NULL,
  `ciudad` varchar(25) DEFAULT NULL,
  `region` varchar(25) DEFAULT NULL,
  `curso` varchar(2) NOT NULL,
  `division` varchar(2) DEFAULT NULL,
  `anoIngreso` int(10) unsigned NOT NULL,
  `anoNacimiento` int(10) unsigned DEFAULT NULL,
  `mesNacimiento` int(10) unsigned DEFAULT NULL,
  `diaNacimiento` int(10) unsigned DEFAULT NULL,
  `lugarNacimiento` varchar(100) DEFAULT NULL,
  `nacionalidad` varchar(25) NOT NULL,
  `seleccion` varchar(25) DEFAULT NULL,
  `nivel` varchar(25) DEFAULT NULL,
  `circulo` varchar(40) DEFAULT NULL,
  `especialidad_idespecialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete`
--

INSERT INTO `cadete` (`rut`, `nCadete`, `direccion`, `comuna`, `ciudad`, `region`, `curso`, `division`, `anoIngreso`, `anoNacimiento`, `mesNacimiento`, `diaNacimiento`, `lugarNacimiento`, `nacionalidad`, `seleccion`, `nivel`, `circulo`, `especialidad_idespecialidad`) VALUES
(17559990, 190, NULL, NULL, NULL, NULL, '3C', '07', 2009, 1990, 12, 8, 'VALPARAISO', 'CHILENA', 'VELA', 'Aficionado', 'TEATRO', 4),
(17992236, 511, NULL, NULL, NULL, NULL, '4B', 'B', 2010, 1991, 10, 23, 'SAN FERNANDO', 'CHILENA', 'FUTBOL', 'Aficionado', 'MUSICA MODERNA', 4),
(18176975, 517, NULL, NULL, NULL, NULL, '4D', 'B', 2011, 1992, 12, 8, 'TALCA', 'CHILENA', 'ATLETISMO', 'Aficionado', 'PASTORAL', 4),
(18203039, 223, NULL, NULL, NULL, NULL, '4I', 'B', 2011, 1993, 3, 13, 'CAUQUENES', 'CHILENA', 'JUDO', 'Olimpico', 'BANDA DE GUERRA', 5),
(18312151, 458, NULL, NULL, NULL, NULL, '4L', 'B', 2011, 1993, 2, 6, 'ANTOFAGASTA', 'sin identificar', 'FUTBOL', 'Aficionado', 'BANDA DE GUERRA', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cadete_apoderado`
--

CREATE TABLE IF NOT EXISTS `cadete_apoderado` (
  `idcadete_apoderado` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `apoderado_rut` int(10) unsigned NOT NULL,
  `tipoApoderado` enum('Padre','Madre','Apoderado suplente','Apoderado Titular') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cadete_apoderado`
--

INSERT INTO `cadete_apoderado` (`idcadete_apoderado`, `cadete_rut`, `apoderado_rut`, `tipoApoderado`) VALUES
(1911, 17559990, 7089557, 'Padre'),
(1912, 17559990, 9693262, 'Padre'),
(1913, 17992236, 6821677, 'Padre'),
(1914, 17992236, 8662591, 'Padre'),
(1915, 17992236, 15121504, 'Apoderado Titular'),
(1916, 17992236, 16309340, 'Padre'),
(1917, 18176975, 4954924, 'Padre'),
(1918, 18176975, 7763080, 'Padre'),
(1919, 18176975, 8551041, 'Padre'),
(1920, 18176975, 9978078, 'Apoderado Titular'),
(1921, 18203039, 6378128, 'Padre'),
(1922, 18203039, 6392614, 'Padre'),
(1923, 18203039, 8016825, 'Padre'),
(1924, 18203039, 10738140, 'Apoderado Titular'),
(1925, 18312151, 9707695, 'Padre'),
(1926, 18312151, 10263684, 'Padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE IF NOT EXISTS `calificaciones` (
  `idcalificaciones` int(11) NOT NULL,
  `ano` int(11) DEFAULT NULL,
  `semestre` tinyint(4) NOT NULL,
  `mando` float NOT NULL,
  `interes_profesional` float NOT NULL,
  `personalidad_madurez` float NOT NULL,
  `responsabilidad` float NOT NULL,
  `espiritu_militar` float NOT NULL,
  `cooperacion` float NOT NULL,
  `conducta` float NOT NULL,
  `aptitud_fisica` float NOT NULL,
  `tenida_orden_aseo` float NOT NULL,
  `final` float NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE IF NOT EXISTS `concepto` (
`idconcepto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `codigo` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`idconcepto`, `nombre`, `codigo`) VALUES
(1, 'Trabajo de síntesis ', 'S'),
(2, 'Interrogación oral', 'I'),
(3, 'Trabajo e laboratorio', 'L'),
(4, 'Prueba avisada según calendario', 'P'),
(5, 'Prueba especial de recuperación', 'R'),
(6, 'Quist ', 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
`iddepartamento` int(10) unsigned NOT NULL,
  `nombre` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `nombre`) VALUES
(1, 'Informática'),
(2, 'Educación'),
(3, 'Abastecimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE IF NOT EXISTS `especialidad` (
`idespecialidad` int(11) NOT NULL,
  `codigo` varchar(1) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`idespecialidad`, `codigo`, `nombre`) VALUES
(1, 'A', 'Politecnico'),
(2, 'B', 'Politecnico'),
(3, 'C', 'CEPO'),
(4, 'E', 'ECO'),
(5, 'I', 'INDIA'),
(6, 'J', 'Abastecimiento'),
(7, 'L', 'Litoral'),
(8, 'O', 'Oficial de mar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `francos`
--

CREATE TABLE IF NOT EXISTS `francos` (
  `idfrancos` int(11) NOT NULL,
  `fecha_salida` varchar(50) DEFAULT NULL,
  `hora_salida` varchar(50) DEFAULT NULL,
  `hora_recogida` varchar(50) DEFAULT NULL,
  `fecha_recogida` varchar(50) DEFAULT NULL,
  `asignatura_bajo` varchar(50) DEFAULT NULL,
  `francoscol` varchar(45) DEFAULT NULL,
  `cadete_rut` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `francos`
--

INSERT INTO `francos` (`idfrancos`, `fecha_salida`, `hora_salida`, `hora_recogida`, `fecha_recogida`, `asignatura_bajo`, `francoscol`, `cadete_rut`) VALUES
(1, ' 3 de OCTUBRE   ', '12,30', '7,20', ' 5 de OCTUBRE   ', '                               ', NULL, 17559990),
(2, ' 3 de OCTUBRE   ', '12,30', '7,20', ' 5 de OCTUBRE   ', '                               ', NULL, 18203039),
(3, ' 3 de OCTUBRE   ', '12,30', '7,20', ' 5 de OCTUBRE   ', '                               ', NULL, 18312151),
(4, ' 2 de OCTUBRE   ', '19,00', '7,45', ' 3 de OCTUBRE   ', '                               ', NULL, 17992236),
(5, ' 3 de OCTUBRE   ', '12,30', '21,00', ' 4 de OCTUBRE   ', '                               ', NULL, 17992236),
(6, ' 4 de OCTUBRE   ', '10,30', '21,00', ' 4 de OCTUBRE   ', '                               ', NULL, 18176975),
(7, ' 3 de OCTUBRE   ', '20,30', '23,30', ' 3 de OCTUBRE   ', '                               ', NULL, 18176975);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `rut` int(10) unsigned NOT NULL,
  `departamento_iddepartamento` int(10) unsigned DEFAULT NULL,
  `tipo` enum('Administrador','administrativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingles_tae`
--

CREATE TABLE IF NOT EXISTS `ingles_tae` (
  `idingles_tae` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `speaking` int(11) NOT NULL,
  `understanding` int(11) NOT NULL,
  `writing` int(11) NOT NULL,
  `average` int(11) NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelacion`
--

CREATE TABLE IF NOT EXISTS `nivelacion` (
  `idnivelacion` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `semestre` tinyint(4) NOT NULL,
  `etapa` tinyint(4) DEFAULT NULL,
  `marca_100_mt` float DEFAULT NULL,
  `marca_1000_mt` float DEFAULT NULL,
  `marca_salto_largo` float DEFAULT NULL,
  `marca_bala` float DEFAULT NULL,
  `marca_100_libre` float DEFAULT NULL,
  `marca_bajo_agua` float DEFAULT NULL,
  `marca_trepa` float DEFAULT NULL,
  `marca_abdominales` float DEFAULT NULL,
  `marca_extension_brazos` float DEFAULT NULL,
  `marca_cooper` float DEFAULT NULL,
  `nota_100_mt` float DEFAULT NULL,
  `nota_1000_mt` float DEFAULT NULL,
  `nota_salto_largo` float DEFAULT NULL,
  `nota_bala` float DEFAULT NULL,
  `nota_100_libre` float DEFAULT NULL,
  `nota_bajo_agua` float DEFAULT NULL,
  `nota_trepa` float DEFAULT NULL,
  `nota_abdominales` float DEFAULT NULL,
  `nota_extension_brazos` float DEFAULT NULL,
  `nota_final` float DEFAULT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `observacion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivelacion`
--

INSERT INTO `nivelacion` (`idnivelacion`, `ano`, `semestre`, `etapa`, `marca_100_mt`, `marca_1000_mt`, `marca_salto_largo`, `marca_bala`, `marca_100_libre`, `marca_bajo_agua`, `marca_trepa`, `marca_abdominales`, `marca_extension_brazos`, `marca_cooper`, `nota_100_mt`, `nota_1000_mt`, `nota_salto_largo`, `nota_bala`, `nota_100_libre`, `nota_bajo_agua`, `nota_trepa`, `nota_abdominales`, `nota_extension_brazos`, `nota_final`, `cadete_rut`, `observacion`) VALUES
(1, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2510, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(2, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2850, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 17559990, 'SALE DE NIVELACION'),
(3, 2010, 2, NULL, 13.5, 3.39, 4.13, 7.72, 1.28, 25, 25.8, 50, 25, 2790, 6, 4.3, 4.43, 4.44, 9.4, 10, 3.4, 6, 10, 0, 17559990, NULL),
(4, 2010, 2, NULL, 13.9, 3.48, 4.23, 7.07, 0, 0, 20.4, 54, 26, 0, 5.2, 3.4, 4.76, 3.14, 0, 0, 6.1, 6.8, 10, 0, 17559990, 'SUPERA    G'),
(5, 2010, 2, NULL, 14.5, 3.35, 4.11, 7.36, 0, 0, 0, 0, 0, 2810, 4, 4.7, 4.36, 3.72, 0, 0, 0, 0, 0, 0, 17559990, 'SUPERA          C'),
(6, 2011, 1, NULL, 13.4, 3.24, 4.22, 8.15, 1.28, 25, 17.4, 60, 26, 2520, 6.2, 5.8, 4.73, 5.3, 9.4, 10, 7.6, 8, 10, 0, 17559990, NULL),
(7, 2011, 1, NULL, 14, 3.47, 3.97, 7.23, 0, 0, 0, 0, 0, 2840, 5, 3.5, 3.9, 3.46, 0, 0, 0, 0, 0, 0, 17559990, 'SUPERA          C'),
(8, 2011, 1, NULL, 14.3, 3.33, 3.9, 7.36, 0, 0, 0, 0, 0, 0, 4.4, 4.9, 3.66, 3.72, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(9, 2011, 1, NULL, 13.4, 3.37, 4.28, 7.1, 0, 0, 0, 0, 0, 0, 6.2, 4.5, 4.93, 3.2, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(10, 2011, 2, NULL, 13.3, 3.27, 4.6, 7.82, 1.32, 25, 18, 58, 30, 0, 6.4, 5.5, 6, 4.64, 9, 10, 7.3, 7.6, 10, 0, 17559990, NULL),
(11, 2011, 2, NULL, 13.9, 3.41, 4.2, 8.1, 0, 0, 0, 0, 0, 0, 5.2, 4.1, 4.66, 5.2, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(12, 2011, 2, NULL, 13.7, 3.38, 4.17, 7.78, 0, 0, 0, 0, 0, 0, 5.6, 4.4, 4.56, 4.56, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(13, 2011, 2, NULL, 13.1, 3.3, 4.45, 7.88, 0, 0, 0, 0, 0, 0, 6.8, 5.2, 5.5, 4.76, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(14, 2012, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2640, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 17559990, NULL),
(15, 2012, 2, NULL, 0, 0, 0, 0, 1.32, 25, 0, 0, 0, 2610, 0, 0, 0, 0, 8.8, 10, 0, 0, 0, 0, 17559990, 'F.I. A   G'),
(16, 2012, 2, NULL, 13.8, 3.39, 4.6, 8.17, 0, 0, 20.6, 53, 20, 2690, 5, 4, 5.66, 4.34, 0, 0, 5.6, 6.2, 10, 0, 17559990, 'SUPERA    G'),
(17, 2012, 2, NULL, 13.3, 3.41, 4.55, 8.78, 0, 0, 0, 0, 0, 2810, 6, 3.8, 5.5, 5.56, 0, 0, 0, 0, 0, 0, 17559990, 'SUPERA          C'),
(18, 2013, 2, NULL, 13.5, 3.25, 4.49, 9.3, 1.42, 25, 35.5, 44, 9, 0, 6.4, 6.1, 5.96, 7.8, 8.2, 10, 0, 5.2, 5.5, 0, 17559990, '               NR.COOPER'),
(19, 2013, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 17559990, NULL),
(20, 2013, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 17559990, NULL),
(21, 2014, 1, NULL, 0, 0, 0, 0, 1.47, 25, 0, 0, 0, 2650, 0, 0, 0, 0, 7.7, 10, 0, 0, 0, 0, 17559990, 'F.I. A   G'),
(22, 2014, 1, NULL, 14, 3.37, 4.35, 9.05, 0, 0, 22.1, 63, 10, 2810, 5.4, 4.9, 5.5, 7.55, 0, 0, 5.65, 9, 6, 0, 17559990, 'SUPERA    G     C'),
(23, 2014, 1, NULL, 14.2, 3.19, 4.55, 9.88, 0, 0, 0, 0, 0, 0, 5, 6.7, 6.16, 8.38, 0, 0, 0, 0, 0, 0, 17559990, 'SALE DE NIVELACION'),
(24, 2014, 2, NULL, 13.6, 3.16, 4.6, 11.2, 1.38, 25, 25.8, 62, 14, 0, 5.8, 6.6, 6, 9.2, 8.4, 10, 3.4, 8.4, 7.5, 0, 17559990, NULL),
(25, 2014, 2, NULL, 0, 0, 0, 0, 0, 0, 21.3, 60, 14, 0, 0, 0, 0, 0, 0, 0, 5.65, 8, 7.5, 0, 17559990, 'SALE DE NIVELACION'),
(26, 2015, 1, NULL, 13.5, 3.26, 4.48, 9.92, 0, 0, 21.4, 63, 15, 0, 6, 5.6, 5.6, 7.92, 0, 0, 5.6, 8.6, 8, 0, 17559990, NULL),
(27, 2015, 1, NULL, 13.9, 3.25, 4.6, 10.02, 1.38, 25, 0, 0, 0, 0, 5.2, 5.7, 6, 8.02, 8.4, 10, 0, 0, 0, 0, 17559990, 'SUPERA      N'),
(28, 2015, 1, NULL, 13.5, 3.22, 4.33, 9.71, 0, 0, 0, 0, 0, 0, 6, 6, 5.1, 7.71, 0, 0, 0, 0, 0, 0, 17559990, 'SALE DE NIVELACION'),
(29, 2010, 2, NULL, 12.9, 3.13, 4.61, 9.16, 2.26, 13, 21, 61, 10, 0, 8.2, 8.1, 7.03, 8.16, 4.2, 6, 7, 9.4, 6.5, 0, 17992236, NULL),
(30, 2010, 2, NULL, 0, 0, 0, 0, 2.17, 16, 0, 0, 0, 0, 0, 0, 0, 0, 5.1, 8.5, 0, 0, 0, 0, 17992236, NULL),
(31, 2010, 2, NULL, 0, 0, 0, 0, 2.07, 17, 0, 0, 0, 0, 0, 0, 0, 0, 6.1, 9, 0, 0, 0, 0, 17992236, 'SALE DE NIVELACION'),
(32, 2015, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 17992236, NULL),
(33, 2015, 1, NULL, 12.9, 3.24, 5.05, 10.25, 1.43, 25, 16.8, 63, 15, 0, 7.2, 5.8, 7.5, 8.25, 7.9, 10, 7.9, 8.6, 8, 0, 17992236, 'SALE DE NIVELACION'),
(34, 2010, 1, NULL, 0, 0, 0, 0, 2.05, 17.5, 0, 0, 0, 2030, 0, 0, 0, 0, 6.7, 8.25, 0, 0, 0, 0, 18176975, 'F.I. A   G'),
(35, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 1, 38, 0, 2380, 0, 0, 0, 0, 0, 0, 0, 5.6, 2.5, 0, 18176975, NULL),
(36, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 60, 42, 1, 2280, 0, 0, 0, 0, 0, 0, 0, 6.4, 3, 0, 18176975, NULL),
(37, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 60, 42, 0, 2300, 0, 0, 0, 0, 0, 0, 0, 6.4, 2.5, 0, 18176975, NULL),
(38, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2.5, 0, 18176975, NULL),
(39, 2010, 2, NULL, 0, 0, 0, 0, 2.13, 17, 60, 41, 0, 2150, 0, 0, 0, 0, 5.7, 6, 0, 5.8, 2, 0, 18176975, 'F.I. A'),
(40, 2010, 2, NULL, 18.9, 4.35, 3.03, 5.6, 2.08, 19, 80, 41, 0, 2300, 0, 1.6, 4.1, 2.8, 6.2, 8, 0, 5.8, 2, 0, 18176975, 'SUPERA      N'),
(41, 2010, 2, NULL, 17.7, 4.35, 3.22, 5.6, 0, 0, 0, 0, 0, 2365, 1.6, 1.6, 4.73, 2.8, 0, 0, 0, 0, 2, 0, 18176975, NULL),
(42, 2010, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2250, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 18176975, NULL),
(43, 2011, 2, NULL, 14.6, 3.44, 3.93, 6.6, 1.46, 19, 22.8, 60, 17, 2700, 4.8, 5, 4.76, 4.2, 8.2, 10, 6.1, 9.2, 10, 0, 18176975, NULL),
(44, 2011, 2, NULL, 15.4, 3.58, 3.59, 5.98, 0, 0, 0, 0, 0, 0, 3.2, 3.6, 3.63, 2.96, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(45, 2011, 2, NULL, 16, 3.57, 3.64, 6.26, 0, 0, 0, 0, 0, 2605, 2, 3.7, 3.8, 3.52, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(46, 2011, 2, NULL, 15, 3.51, 3.82, 6.86, 0, 0, 0, 0, 0, 0, 4, 4.3, 4.4, 4.72, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(47, 2011, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(48, 2012, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2570, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(49, 2012, 2, NULL, 12.9, 3.27, 4.73, 7.82, 1.44, 25, 25.4, 77, 14, 2790, 7.6, 5.9, 6.76, 5.64, 8, 10, 4, 10, 8, 0, 18176975, NULL),
(50, 2012, 2, NULL, 13.6, 3.33, 4.35, 7.34, 0, 0, 0, 0, 0, 2810, 6.2, 5.3, 5.5, 4.68, 0, 0, 0, 0, 0, 0, 18176975, 'SUPERA          C'),
(51, 2012, 2, NULL, 13, 3.27, 4.6, 8.87, 0, 0, 0, 0, 0, 0, 7.4, 5.9, 6.33, 7.37, 0, 0, 0, 0, 0, 0, 18176975, 'SALE DE NIVELACION'),
(52, 2013, 1, NULL, 13.8, 3.26, 4.65, 7.38, 1.39, 21, 21, 68, 19, 2710, 5.8, 6, 6.5, 4.76, 8.5, 10, 6.2, 10, 10, 0, 18176975, NULL),
(53, 2013, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(54, 2013, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(55, 2013, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(56, 2013, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, 'NO RINDE F.C.F NR.COOPER'),
(57, 2013, 2, NULL, 0, 0, 0, 0, 1.36, 21, 23, 58, 15, 0, 0, 0, 0, 0, 8.6, 9, 4.8, 7.6, 8, 0, 18176975, 'SUPERA    G N'),
(58, 2013, 2, NULL, 13.6, 0, 4.26, 7.05, 0, 0, 0, 0, 0, 0, 5.8, 0, 4.86, 3.1, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(59, 2014, 1, NULL, 13.2, 3.34, 4.48, 6.98, 1.43, 20, 20.2, 71, 22, 0, 6.6, 4.8, 5.6, 2.96, 7.9, 8.5, 6.2, 10, 10, 0, 18176975, NULL),
(60, 2014, 1, NULL, 13.4, 3.32, 4.45, 7.56, 0, 0, 0, 0, 0, 0, 6.2, 5, 5.5, 4.12, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(61, 2014, 1, NULL, 13.7, 3.2, 4.25, 7.61, 0, 0, 0, 0, 0, 0, 5.6, 6.2, 4.83, 4.22, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(62, 2014, 1, NULL, 13.5, 3.28, 4.4, 8, 0, 0, 0, 0, 0, 0, 6, 5.4, 5.33, 5, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(63, 2014, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, 'NO RINDE F.C.F NR.COOPER'),
(64, 2014, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(65, 2014, 2, NULL, 14, 3.39, 4.65, 7.74, 1.37, 19, 21.3, 57, 23, 0, 4.6, 4, 5.83, 3.48, 8.3, 6, 5.25, 7, 10, 0, 18176975, 'SUPERA    G N'),
(66, 2014, 2, NULL, 14.1, 3.4, 4.42, 7.78, 0, 0, 0, 0, 0, 2880, 4.4, 3.9, 5.06, 3.56, 0, 0, 0, 0, 0, 0, 18176975, 'SUPERA          C'),
(67, 2015, 1, NULL, 13.8, 3.26, 4.4, 6.83, 1.4, 25, 17.8, 69, 25, 2582, 5, 5.3, 5, 1.66, 8, 10, 7, 9.4, 10, 0, 18176975, NULL),
(68, 2015, 1, NULL, 14.2, 3.39, 4.4, 8.71, 0, 0, 0, 0, 0, 2835, 4.2, 4, 5, 5.42, 0, 0, 0, 0, 0, 0, 18176975, 'SUPERA          C'),
(69, 2015, 1, NULL, 14, 3.31, 4.38, 7.9, 0, 0, 0, 0, 0, 0, 4.6, 4.8, 4.93, 3.8, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(70, 2015, 1, NULL, 13.3, 3.41, 4.54, 7.91, 0, 0, 0, 0, 0, 0, 6, 3.8, 5.46, 3.82, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(71, 2015, 2, NULL, 12.9, 3.29, 4.65, 8.02, 1.54, 25, 17.3, 66, 20, 0, 6.8, 5, 5.83, 4.04, 6.6, 10, 7.25, 8.8, 10, 0, 18176975, NULL),
(72, 2015, 2, NULL, 13.4, 3.34, 4.43, 7.37, 0, 0, 0, 0, 0, 0, 5.8, 4.5, 5.1, 2.74, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(73, 2015, 2, NULL, 13.2, 3.33, 4.55, 8.38, 0, 0, 0, 0, 0, 0, 6.2, 4.6, 5.5, 4.76, 0, 0, 0, 0, 0, 0, 18176975, NULL),
(74, 2010, 1, NULL, 0, 0, 0, 0, 1.21, 25, 44.4, 64, 8, 2120, 0, 0, 0, 0, 10, 10, 5.8, 10, 6.5, 0, 18312151, 'F.I. A'),
(75, 2010, 1, NULL, 16.4, 4.25, 4.04, 6.17, 0, 0, 0, 0, 0, 2475, 5, 3, 7.76, 4.54, 0, 0, 0, 0, 0, 0, 18312151, 'SUPERA          C'),
(76, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18312151, NULL),
(77, 2010, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18312151, NULL),
(78, 2010, 2, NULL, 15.9, 4.45, 4.1, 5.48, 1.21, 25, 34.9, 65, 10, 0, 5.2, 0.6, 7.66, 2.56, 10, 10, 9.55, 10, 7, 0, 18312151, '               NR.COOPER'),
(79, 2010, 2, NULL, 16.8, 4.59, 3.78, 5.92, 0, 0, 0, 0, 0, 0, 3.4, 0, 6.6, 3.44, 0, 0, 0, 0, 0, 0, 18312151, NULL),
(80, 2010, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18312151, NULL),
(81, 2010, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2400, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18312151, 'SUPERA          C'),
(82, 2012, 2, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18312151, NULL),
(83, 2012, 2, NULL, 12.3, 3.17, 4.72, 7.33, 2.14, 13, 21, 74, 22, 0, 9.4, 7.7, 7.4, 5.66, 5.4, 6, 7, 10, 10, 0, 18312151, 'SUPERA  A G'),
(84, 2012, 2, NULL, 0, 0, 0, 0, 2.01, 15, 0, 0, 0, 0, 0, 0, 0, 0, 6.7, 8, 0, 0, 0, 0, 18312151, 'SALE DE NIVELACION'),
(85, 2013, 2, NULL, 12.3, 3.2, 4.8, 9.39, 2.25, 17.5, 19.7, 75, 18, 0, 8.8, 6.6, 7, 7.89, 3.9, 8.25, 6.85, 10, 10, 0, 18312151, NULL),
(86, 2013, 2, NULL, 0, 0, 0, 0, 2.17, 17, 0, 0, 0, 0, 0, 0, 0, 0, 4.7, 8, 0, 0, 0, 0, 18312151, NULL),
(87, 2013, 2, NULL, 0, 0, 0, 0, 1.59, 18, 0, 0, 0, 0, 0, 0, 0, 0, 6.5, 8.5, 0, 0, 0, 0, 18312151, 'SALE DE NIVELACION'),
(88, 2014, 2, NULL, 12.7, 3.21, 4.6, 10.1, 2.06, 20, 18.5, 76, 20, 0, 7.6, 6.1, 6, 8.1, 5.6, 8.5, 7.05, 10, 10, 0, 18312151, NULL),
(89, 2014, 2, NULL, 0, 0, 0, 0, 2.03, 19, 0, 0, 0, 0, 0, 0, 0, 0, 5.9, 8, 0, 0, 0, 0, 18312151, NULL),
(90, 2014, 2, NULL, 0, 0, 0, 0, 1.56, 20, 0, 0, 0, 0, 0, 0, 0, 0, 6.6, 8.5, 0, 0, 0, 0, 18312151, 'SALE DE NIVELACION'),
(91, 2015, 1, NULL, 11.9, 3.22, 4.95, 9.76, 2.05, 22, 15.6, 70, 24, 0, 9.2, 6, 7.16, 7.76, 5.7, 9.5, 8.5, 10, 10, 0, 18312151, NULL),
(92, 2015, 1, NULL, 0, 0, 0, 0, 1.47, 20, 0, 0, 0, 0, 0, 0, 0, 0, 7.5, 8.5, 0, 0, 0, 0, 18312151, 'SALE DE NIVELACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_finales`
--

CREATE TABLE IF NOT EXISTS `notas_finales` (
  `idnotas_finales` int(11) NOT NULL,
  `nota_presentacion` float NOT NULL,
  `nota_examen` float DEFAULT NULL,
  `nota_final` float NOT NULL,
  `nota_examen_repeticion` float DEFAULT NULL,
  `nota_final_repeticion` float DEFAULT NULL,
  `estado` enum('A','E','R') NOT NULL,
  `asignatura_idasignatura` int(11) NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_fisico`
--

CREATE TABLE IF NOT EXISTS `notas_fisico` (
  `idnotas_fisico` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `semestre` tinyint(4) NOT NULL,
  `marca_100_mt` float DEFAULT NULL,
  `marca_1000_mt` float DEFAULT NULL,
  `marca_salto_largo` float DEFAULT NULL,
  `marca_bala` float DEFAULT NULL,
  `marca_100_libre` float DEFAULT NULL,
  `marca_bajo_agua` float DEFAULT NULL,
  `marca_trepa` float DEFAULT NULL,
  `marca_abdominales` float DEFAULT NULL,
  `marca_extension_brazos` float DEFAULT NULL,
  `nota_100_mt` float DEFAULT NULL,
  `nota_1000_mt` float DEFAULT NULL,
  `nota_salto_largo` float DEFAULT NULL,
  `nota_bala` float DEFAULT NULL,
  `nota_100_libre` float DEFAULT NULL,
  `nota_bajo_agua` float DEFAULT NULL,
  `nota_trepa` float DEFAULT NULL,
  `nota_abdominales` float DEFAULT NULL,
  `nota_extension_brazos` float DEFAULT NULL,
  `nota_final` float DEFAULT NULL,
  `cadete_rut` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas_fisico`
--

INSERT INTO `notas_fisico` (`idnotas_fisico`, `ano`, `semestre`, `marca_100_mt`, `marca_1000_mt`, `marca_salto_largo`, `marca_bala`, `marca_100_libre`, `marca_bajo_agua`, `marca_trepa`, `marca_abdominales`, `marca_extension_brazos`, `nota_100_mt`, `nota_1000_mt`, `nota_salto_largo`, `nota_bala`, `nota_100_libre`, `nota_bajo_agua`, `nota_trepa`, `nota_abdominales`, `nota_extension_brazos`, `nota_final`, `cadete_rut`) VALUES
(1, 2013, 1, 13.5, 3.25, 4.49, 9.3, 1.42, 25, 35.5, 44, 9, 6.4, 6.1, 5.96, 7.8, 8.2, 10, 0, 5.2, 5.5, 6.128, 17559990),
(2, 2013, 2, 0, 0, 0, 0, 1.47, 25, 0, 0, 0, 0, 0, 0, 0, 7.7, 10, 0, 0, 0, 1.966, 17559990),
(3, 2014, 1, 13.6, 3.16, 4.6, 11.2, 1.38, 25, 25.8, 62, 14, 5.8, 6.6, 6, 9.2, 8.4, 10, 3.4, 8.4, 7.5, 7.255, 17559990),
(4, 2014, 2, 13.5, 3.26, 4.48, 9.92, 0, 0, 21.4, 63, 15, 6, 5.6, 5.6, 7.92, 0, 0, 5.6, 8.6, 8, 5.257, 17559990),
(5, 2015, 1, 13.4, 3.22, 4.47, 9.72, 1.45, 25, 23.1, 66, 12, 6.2, 6, 5.56, 7.72, 7.7, 10, 4.75, 9.2, 6.5, 7.07, 17559990),
(6, 2010, 1, 12.9, 3.13, 4.61, 9.16, 2.26, 13, 21, 61, 10, 8.2, 8.1, 7.03, 8.16, 4.2, 6, 7, 9.4, 6.5, 7.176, 17992236),
(7, 2010, 2, 12.4, 3.19, 4.97, 9.86, 1.55, 16, 22.1, 64, 10, 9.2, 7.5, 8.23, 8.86, 7.3, 8.5, 6.45, 10, 6.5, 8.06, 17992236),
(8, 2011, 1, 12.4, 3.2, 4.83, 9.9, 2, 17, 21.3, 63, 14, 8.6, 6.6, 7.1, 8.4, 6.4, 8, 6.05, 9, 8, 7.572, 17992236),
(9, 2011, 2, 12.3, 3.25, 4.66, 9.91, 1.58, 17.5, 22, 61, 16, 8.8, 6.1, 6.53, 8.41, 6.6, 8.25, 5.7, 8.6, 9, 7.554, 17992236),
(10, 2012, 1, 12.6, 3.15, 4.95, 8.86, 1.54, 18, 20.4, 64, 14, 8.2, 7.1, 7.5, 7.36, 7, 8.5, 6.5, 9.2, 8, 7.706, 17992236),
(11, 2012, 2, 12.2, 3.14, 5.32, 10.08, 1.52, 18, 19.9, 63, 18, 9, 7.2, 8.73, 8.58, 7.2, 8.5, 6.75, 9, 10, 8.328, 17992236),
(12, 2013, 1, 12.7, 3.13, 4.95, 9.86, 1.54, 22, 16.6, 64, 16, 7.6, 6.9, 7.16, 7.86, 6.8, 9.5, 8, 8.8, 8.5, 7.902, 17992236),
(13, 2013, 2, 12.8, 3.29, 5.07, 10.64, 1.55, 25, 19.7, 65, 13, 7.4, 5.3, 7.56, 8.64, 6.7, 10, 6.45, 9, 7, 7.561, 17992236),
(14, 2014, 1, 12.3, 3.09, 5.02, 10.85, 1.55, 25, 17.9, 68, 18, 8, 7, 7.06, 8.35, 6.5, 10, 6.95, 9.2, 9, 8.006, 17992236),
(15, 2014, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 17992236),
(16, 2015, 1, 12.3, 3.18, 5.38, 9.8, 1.49, 25, 18.8, 60, 13, 8, 6.1, 8.26, 7.3, 7.1, 10, 6.5, 7.6, 6.5, 7.484, 17992236),
(17, 2011, 1, 14.6, 3.44, 3.93, 6.6, 1.46, 19, 22.8, 60, 17, 4.8, 5, 4.76, 4.2, 8.2, 10, 6.1, 9.2, 10, 6.917, 18176975),
(18, 2011, 2, 15.1, 3.53, 4.04, 7.04, 1.43, 19, 21.4, 72, 14, 3.8, 4.1, 5.13, 5.08, 8.5, 10, 6.8, 10, 8.5, 6.878, 18176975),
(19, 2012, 1, 12.9, 3.27, 4.73, 7.82, 1.44, 25, 25.4, 77, 14, 7.6, 5.9, 6.76, 5.64, 8, 10, 4, 10, 8, 7.322, 18176975),
(20, 2012, 2, 13.8, 3.26, 4.65, 7.38, 1.39, 21, 21, 68, 19, 5.8, 6, 6.5, 4.76, 8.5, 10, 6.2, 10, 10, 7.528, 18176975),
(21, 2013, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975),
(22, 2013, 2, 13.2, 3.34, 4.48, 6.98, 1.43, 20, 20.2, 71, 22, 6.6, 4.8, 5.6, 2.96, 7.9, 8.5, 6.2, 10, 10, 6.951, 18176975),
(23, 2014, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18176975),
(24, 2014, 2, 13.8, 3.26, 4.4, 6.83, 1.4, 25, 17.8, 69, 25, 5, 5.3, 5, 1.66, 8, 10, 7, 9.4, 10, 6.817, 18176975),
(25, 2015, 1, 12.9, 3.29, 4.65, 8.02, 1.54, 25, 17.3, 66, 20, 6.8, 5, 5.83, 4.04, 6.6, 10, 7.25, 8.8, 10, 7.146, 18176975),
(26, 2011, 1, 13.4, 3.1, 4.91, 9.38, 1.24, 25, 18.2, 64, 22, 7.2, 8.4, 8.03, 8.38, 10, 10, 8.4, 10, 10, 8.934, 18203039),
(27, 2011, 2, 13, 3.07, 5, 10.67, 1.19, 25, 14.5, 67, 21, 8, 8.7, 8.33, 9.67, 10, 10, 10, 10, 10, 9.411, 18203039),
(28, 2012, 1, 12.4, 3.02, 5.5, 10.07, 1.14, 25, 17.4, 66, 23, 9.2, 9.2, 10, 9.07, 10, 10, 8.8, 10, 10, 9.585, 18203039),
(29, 2012, 2, 12.9, 3.08, 5.1, 10.55, 1.14, 25, 16.9, 67, 24, 8.2, 8.6, 8.66, 9.55, 10, 10, 9.05, 10, 10, 9.34, 18203039),
(30, 2013, 1, 12.4, 3.04, 5.15, 11.18, 1.15, 25, 15.3, 70, 22, 8.6, 8.2, 8.16, 9.68, 10, 10, 9.05, 10, 10, 9.298, 18203039),
(31, 2013, 2, 12.3, 3, 5.25, 11.4, 1.17, 25, 14.5, 66, 26, 8.8, 8.6, 8.5, 9.9, 10, 10, 9.45, 9.6, 10, 9.427, 18203039),
(32, 2014, 1, 12.4, 3, 5.39, 11.69, 1.15, 25, 12.5, 75, 26, 8.2, 8.2, 8.63, 9.69, 10, 10, 10, 10, 10, 9.413, 18203039),
(33, 2014, 2, 12.1, 3.01, 5.35, 11.74, 1.18, 25, 12.1, 76, 27, 8.8, 8.1, 8.5, 9.74, 10, 10, 10, 10, 10, 9.46, 18203039),
(34, 2015, 1, 12.6, 3.06, 5.19, 11.25, 1.13, 25, 12.9, 68, 30, 7.4, 7.3, 7.63, 8.75, 10, 10, 9.45, 9.2, 10, 8.858, 18203039),
(35, 2012, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 18312151),
(36, 2012, 2, 12.3, 3.17, 4.85, 9.8, 2.05, 16, 14.9, 71, 20, 9.4, 7.7, 7.83, 8.8, 6.3, 8.5, 10, 10, 10, 8.725, 18312151),
(37, 2013, 1, 12.3, 3.2, 4.8, 9.39, 2.25, 17.5, 19.7, 75, 18, 8.8, 6.6, 7, 7.89, 3.9, 8.25, 6.85, 10, 10, 7.698, 18312151),
(38, 2013, 2, 12.2, 3.19, 4.85, 9.3, 1.55, 22, 15, 68, 18, 9, 6.7, 7.16, 7.8, 6.9, 10, 9.2, 10, 10, 8.528, 18312151),
(39, 2014, 1, 12.7, 3.21, 4.6, 10.1, 2.06, 20, 18.5, 76, 20, 7.6, 6.1, 6, 8.1, 5.6, 8.5, 7.05, 10, 10, 7.661, 18312151),
(40, 2014, 2, 11.9, 3.22, 4.95, 9.76, 2.05, 22, 15.6, 70, 24, 9.2, 6, 7.16, 7.76, 5.7, 9.5, 8.5, 10, 10, 8.202, 18312151),
(41, 2015, 1, 12.5, 3.15, 4.6, 9.7, 1.53, 21, 15.5, 82, 25, 7.6, 6.4, 5.66, 7.2, 6.7, 8, 8.15, 10, 10, 7.745, 18312151);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_parciales`
--

CREATE TABLE IF NOT EXISTS `notas_parciales` (
  `idnotas_parciales` int(11) NOT NULL,
  `nota` float NOT NULL,
  `dia` smallint(6) NOT NULL,
  `mes` smallint(6) NOT NULL,
  `ano` int(11) NOT NULL,
  `semestre` tinyint(4) NOT NULL,
  `asignatura_idasignatura` int(11) NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `concepto_idconcepto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_archivo`
--

CREATE TABLE IF NOT EXISTS `tipo_archivo` (
`idtipo_archivo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tabla_sincronizar` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_archivo`
--

INSERT INTO `tipo_archivo` (`idtipo_archivo`, `nombre`, `tabla_sincronizar`) VALUES
(1, 'cadetes', 'cadete'),
(2, 'apoderados', 'apoderado'),
(3, 'relación cadete-apoderado', 'cadete_apoderado'),
(4, 'finanzas', 'transaccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE IF NOT EXISTS `transaccion` (
  `idtransaccion` int(10) unsigned NOT NULL,
  `cadete_rut` int(10) unsigned NOT NULL,
  `tipoTransaccion` enum('Cargo','Abono') NOT NULL,
  `monto` bigint(10) NOT NULL,
  `fechaMovimiento` datetime NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `tipoCuenta` enum('Cuenta Corriente','Colegiatura','Equipo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

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
(4954924, 'RAVENTÓS', 'ÁGUILA', 'XIMENA', '4954924', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(6378128, 'ACEVEDO', 'PEDREROS', 'RAMÓN ARTURO', '6378128', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(6392614, 'VARAS', 'MORA', 'IVONNE VILMA', '6392614', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(6821677, 'MORENO', 'Poblete', 'Luis  Fernando', '6821677', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(7089557, 'SEPULVEDA', 'Haugen', 'Rodrigo', '7089557', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(7763080, 'GÓMEZ', 'BARROS', 'VIOLETA MARÍA D', '7763080', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(8016825, 'BARAHONA', 'LEIVA', 'VIVIANA LORENA', '8016825', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(8551041, 'CASANUEVA', 'ÁGUILA', 'OSCAR MIGUEL', '8551041', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(8662591, 'RUZ', 'Acevedo', 'Carmen Gloria', '8662591', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(9693262, 'FELL', 'Novion', 'Mary Jane', '9693262', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(9707695, 'VALDIVIA', 'CORNEJO', 'RENÉ ENRIQUE', '9707695', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(9978078, 'PODEY', 'CASANUEVA', 'MACARENA PAZ', '9978078', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(10263684, 'NARVÁEZ', 'BARAHONA', 'SONIA SUSANA', '10263684', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(10738140, 'BARAHONA', 'LEIVA', 'FABIOLA ANDREA', '10738140', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(15121504, 'RAMOS', 'RUZ', 'DIEGO', '15121504', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(16309340, 'MORENO', 'RUZ', 'DANIELA', '16309340', 'apoderado', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(17559990, 'SEPULVEDA', 'Fell', 'Pablo Andrés', '17559990', 'cadete', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(17992236, 'MORENO', 'Ruz', 'Matías Fernando', '17992236', 'cadete', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(18176975, 'CASANUEVA', 'Gómez', 'Javier Andrés', '18176975', 'cadete', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(18203039, 'ACEVEDO', 'Barahona', 'Daniel Maximiliano', '18203039', 'cadete', NULL, NULL, 'cadete@escuelanaval.cl', NULL),
(18312151, 'VALDIVIA', 'Narváez', 'Sebastián Enrique', '18312151', 'cadete', NULL, NULL, 'cadete@escuelanaval.cl', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apoderado`
--
ALTER TABLE `apoderado`
 ADD PRIMARY KEY (`rut`), ADD KEY `apoderado_FKIndex1` (`rut`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
 ADD PRIMARY KEY (`idarchivos`), ADD KEY `fk_archivos_tipo_archivo1_idx` (`tipo_archivo_idtipo_archivo`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
 ADD PRIMARY KEY (`idasignatura`), ADD KEY `fk_asignatura_especialidad1_idx` (`especialidad_idespecialidad`);

--
-- Indices de la tabla `cadete`
--
ALTER TABLE `cadete`
 ADD PRIMARY KEY (`rut`), ADD KEY `cadete_FKIndex1` (`rut`), ADD KEY `fk_cadete_especialidad1_idx` (`especialidad_idespecialidad`);

--
-- Indices de la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
 ADD PRIMARY KEY (`idcadete_apoderado`), ADD KEY `cadete_apoderado_FKIndex1` (`apoderado_rut`), ADD KEY `cadete_apoderado_FKIndex2` (`cadete_rut`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
 ADD PRIMARY KEY (`idcalificaciones`), ADD KEY `fk_calificaciones_cadete1_idx` (`cadete_rut`);

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
 ADD PRIMARY KEY (`idconcepto`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
 ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
 ADD PRIMARY KEY (`idespecialidad`);

--
-- Indices de la tabla `francos`
--
ALTER TABLE `francos`
 ADD PRIMARY KEY (`idfrancos`), ADD KEY `fk_francos_cadete1_idx` (`cadete_rut`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
 ADD PRIMARY KEY (`rut`), ADD KEY `funcionario_FKIndex1` (`rut`), ADD KEY `funcionario_FKIndex2` (`departamento_iddepartamento`);

--
-- Indices de la tabla `ingles_tae`
--
ALTER TABLE `ingles_tae`
 ADD PRIMARY KEY (`idingles_tae`), ADD KEY `fk_ingles_tae_cadete1_idx` (`cadete_rut`);

--
-- Indices de la tabla `nivelacion`
--
ALTER TABLE `nivelacion`
 ADD PRIMARY KEY (`idnivelacion`), ADD KEY `fk_notas_fisico_cadete1_idx` (`cadete_rut`);

--
-- Indices de la tabla `notas_finales`
--
ALTER TABLE `notas_finales`
 ADD PRIMARY KEY (`idnotas_finales`), ADD KEY `fk_nota_final_asignatura1_idx` (`asignatura_idasignatura`), ADD KEY `fk_notas_finales_cadete1_idx` (`cadete_rut`);

--
-- Indices de la tabla `notas_fisico`
--
ALTER TABLE `notas_fisico`
 ADD PRIMARY KEY (`idnotas_fisico`), ADD KEY `fk_notas_fisico_cadete1_idx` (`cadete_rut`);

--
-- Indices de la tabla `notas_parciales`
--
ALTER TABLE `notas_parciales`
 ADD PRIMARY KEY (`idnotas_parciales`), ADD KEY `fk_notas_parciales_asignatura1_idx` (`asignatura_idasignatura`), ADD KEY `fk_notas_parciales_cadete1_idx` (`cadete_rut`), ADD KEY `fk_notas_parciales_concepto1_idx` (`concepto_idconcepto`);

--
-- Indices de la tabla `tipo_archivo`
--
ALTER TABLE `tipo_archivo`
 ADD PRIMARY KEY (`idtipo_archivo`);

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
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
MODIFY `idarchivos` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
MODIFY `idconcepto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
MODIFY `iddepartamento` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
MODIFY `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tipo_archivo`
--
ALTER TABLE `tipo_archivo`
MODIFY `idtipo_archivo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apoderado`
--
ALTER TABLE `apoderado`
ADD CONSTRAINT `apoderado_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
ADD CONSTRAINT `fk_archivos_tipo_archivo1` FOREIGN KEY (`tipo_archivo_idtipo_archivo`) REFERENCES `tipo_archivo` (`idtipo_archivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
ADD CONSTRAINT `fk_asignatura_especialidad1` FOREIGN KEY (`especialidad_idespecialidad`) REFERENCES `especialidad` (`idespecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cadete`
--
ALTER TABLE `cadete`
ADD CONSTRAINT `cadete_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_cadete_especialidad1` FOREIGN KEY (`especialidad_idespecialidad`) REFERENCES `especialidad` (`idespecialidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cadete_apoderado`
--
ALTER TABLE `cadete_apoderado`
ADD CONSTRAINT `cadete_apoderado_ibfk_1` FOREIGN KEY (`apoderado_rut`) REFERENCES `apoderado` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `cadete_apoderado_ibfk_2` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
ADD CONSTRAINT `fk_calificaciones_cadete1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `francos`
--
ALTER TABLE `francos`
ADD CONSTRAINT `fk_francos_cadete1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`rut`) REFERENCES `usuario` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`departamento_iddepartamento`) REFERENCES `departamento` (`iddepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ingles_tae`
--
ALTER TABLE `ingles_tae`
ADD CONSTRAINT `fk_ingles_tae_cadete1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nivelacion`
--
ALTER TABLE `nivelacion`
ADD CONSTRAINT `fk_notas_fisico_cadete10` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_finales`
--
ALTER TABLE `notas_finales`
ADD CONSTRAINT `fk_nota_final_asignatura1` FOREIGN KEY (`asignatura_idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_notas_finales_cadete1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_fisico`
--
ALTER TABLE `notas_fisico`
ADD CONSTRAINT `fk_notas_fisico_cadete1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notas_parciales`
--
ALTER TABLE `notas_parciales`
ADD CONSTRAINT `fk_notas_parciales_asignatura1` FOREIGN KEY (`asignatura_idasignatura`) REFERENCES `asignatura` (`idasignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_notas_parciales_cadete1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_notas_parciales_concepto1` FOREIGN KEY (`concepto_idconcepto`) REFERENCES `concepto` (`idconcepto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
ADD CONSTRAINT `transaccion_ibfk_1` FOREIGN KEY (`cadete_rut`) REFERENCES `cadete` (`rut`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
