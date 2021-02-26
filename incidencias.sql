-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2021 a las 22:14:40
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `incidencias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adjunto_incidencias`
--

CREATE TABLE `adjunto_incidencias` (
  `id_adjunto_incidencias` int(11) NOT NULL,
  `id_incidencia` int(11) NOT NULL,
  `id_subsistema` int(11) NOT NULL,
  `id_sistema` int(11) NOT NULL,
  `ruta_adjunto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id_incidencia` int(11) NOT NULL,
  `id_subsistema` int(11) NOT NULL,
  `id_sistema` int(11) NOT NULL,
  `incidencia` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistemas`
--

CREATE TABLE `sistemas` (
  `id_sistema` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `version` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sistemas`
--

INSERT INTO `sistemas` (`id_sistema`, `nombre`, `version`) VALUES
(1, 'VERSAT SARASOLA', '201028'),
(5, 'VERSAT ERP', '1'),
(11, 'ENERGEST', '2.1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soluciones`
--

CREATE TABLE `soluciones` (
  `id_soluciones` int(11) NOT NULL,
  `solucion` varchar(150) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsistemas`
--

CREATE TABLE `subsistemas` (
  `id_subsistema` int(11) NOT NULL,
  `id_sistema` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adjunto_incidencias`
--
ALTER TABLE `adjunto_incidencias`
  ADD PRIMARY KEY (`id_adjunto_incidencias`,`id_incidencia`,`id_subsistema`,`id_sistema`),
  ADD KEY `Refincidencias7` (`id_incidencia`,`id_subsistema`,`id_sistema`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id_incidencia`,`id_subsistema`,`id_sistema`),
  ADD KEY `Refsubsistemas6` (`id_subsistema`,`id_sistema`);

--
-- Indices de la tabla `sistemas`
--
ALTER TABLE `sistemas`
  ADD PRIMARY KEY (`id_sistema`);

--
-- Indices de la tabla `soluciones`
--
ALTER TABLE `soluciones`
  ADD PRIMARY KEY (`id_soluciones`);

--
-- Indices de la tabla `subsistemas`
--
ALTER TABLE `subsistemas`
  ADD PRIMARY KEY (`id_subsistema`,`id_sistema`),
  ADD KEY `Refsistemas1` (`id_sistema`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adjunto_incidencias`
--
ALTER TABLE `adjunto_incidencias`
  MODIFY `id_adjunto_incidencias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id_incidencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sistemas`
--
ALTER TABLE `sistemas`
  MODIFY `id_sistema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `subsistemas`
--
ALTER TABLE `subsistemas`
  MODIFY `id_subsistema` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adjunto_incidencias`
--
ALTER TABLE `adjunto_incidencias`
  ADD CONSTRAINT `Refincidencias7` FOREIGN KEY (`id_incidencia`,`id_subsistema`,`id_sistema`) REFERENCES `incidencias` (`id_incidencia`, `id_subsistema`, `id_sistema`);

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `Refsubsistemas6` FOREIGN KEY (`id_subsistema`,`id_sistema`) REFERENCES `subsistemas` (`id_subsistema`, `id_sistema`);

--
-- Filtros para la tabla `subsistemas`
--
ALTER TABLE `subsistemas`
  ADD CONSTRAINT `Refsistemas1` FOREIGN KEY (`id_sistema`) REFERENCES `sistemas` (`id_sistema`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
