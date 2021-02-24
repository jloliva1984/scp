-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2021 at 05:24 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scp`
--

-- --------------------------------------------------------

--
-- Table structure for table `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre`) VALUES
(1, 'Eléctrica'),
(2, 'Civil'),
(3, 'Mecánica');

-- --------------------------------------------------------

--
-- Table structure for table `especialistas`
--

CREATE TABLE `especialistas` (
  `id_especialista` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `salario_diario` float(8,0) NOT NULL,
  `id_especialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `especialistas`
--

INSERT INTO `especialistas` (`id_especialista`, `nombre_completo`, `salario_diario`, `id_especialidad`) VALUES
(1, 'Jorge Luis Oliva Matos', 204, 1),
(2, 'Duarte Juan Contreras', 204, 2),
(3, 'Luis Enrique Borrero', 204, 3);

-- --------------------------------------------------------

--
-- Table structure for table `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyecto` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(150) NOT NULL,
  `valor` float(8,0) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `codigo`, `descripcion`, `valor`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 'IPU-03-20210312', 'Sistema de riego central Dos Rios', 150000, '2021-02-19', '2021-02-25', '1'),
(2, 'IPU-03-2015487', 'Caseta 4x4 Central America Libre', 45000, '2021-02-11', '2021-02-27', '1'),
(3, 'IPU-03-2145', 'Sistema de drenaje UBPC Celia Sanchez(Mella)', 12000, '2021-02-19', '2021-02-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `proyectos_subelemento_gastos`
--

CREATE TABLE `proyectos_subelemento_gastos` (
  `id_proyectos_subelemento_gastos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `id_subelemento_gasto` int(11) NOT NULL,
  `id_especialista` int(11) NOT NULL,
  `valor` float(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subelemento_gastos`
--

CREATE TABLE `subelemento_gastos` (
  `id_subelemento_gasto` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subelemento_gastos`
--

INSERT INTO `subelemento_gastos` (`id_subelemento_gasto`, `codigo`, `nombre`) VALUES
(1, '2001', 'Dieta'),
(2, '5002', 'Hospedaje'),
(3, '5003', 'Diesel'),
(4, '5004', 'Gasolina'),
(5, '5010', 'Salario');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indexes for table `especialistas`
--
ALTER TABLE `especialistas`
  ADD PRIMARY KEY (`id_especialista`),
  ADD KEY `Refespecialidades2` (`id_especialidad`);

--
-- Indexes for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indexes for table `proyectos_subelemento_gastos`
--
ALTER TABLE `proyectos_subelemento_gastos`
  ADD PRIMARY KEY (`id_proyectos_subelemento_gastos`),
  ADD KEY `Refproyectos6` (`id_proyecto`),
  ADD KEY `Refsubelemento_gastos7` (`id_subelemento_gasto`),
  ADD KEY `Refespecialistas8` (`id_especialista`);

--
-- Indexes for table `subelemento_gastos`
--
ALTER TABLE `subelemento_gastos`
  ADD PRIMARY KEY (`id_subelemento_gasto`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `especialistas`
--
ALTER TABLE `especialistas`
  MODIFY `id_especialista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proyectos_subelemento_gastos`
--
ALTER TABLE `proyectos_subelemento_gastos`
  MODIFY `id_proyectos_subelemento_gastos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subelemento_gastos`
--
ALTER TABLE `subelemento_gastos`
  MODIFY `id_subelemento_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `especialistas`
--
ALTER TABLE `especialistas`
  ADD CONSTRAINT `Refespecialidades2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`);

--
-- Constraints for table `proyectos_subelemento_gastos`
--
ALTER TABLE `proyectos_subelemento_gastos`
  ADD CONSTRAINT `Refespecialistas8` FOREIGN KEY (`id_especialista`) REFERENCES `especialistas` (`id_especialista`),
  ADD CONSTRAINT `Refproyectos6` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id_proyecto`),
  ADD CONSTRAINT `Refsubelemento_gastos7` FOREIGN KEY (`id_subelemento_gasto`) REFERENCES `subelemento_gastos` (`id_subelemento_gasto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
