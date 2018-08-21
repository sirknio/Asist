-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2018 at 12:27 PM
-- Server version: 5.7.17-log
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assist`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplicacion`
--

CREATE TABLE `aplicacion` (
  `pkfield` int(11) NOT NULL,
  `LimiteEventosDashboard` int(11) NOT NULL,
  `LVHoraEntrada` time NOT NULL,
  `LVHoraSalida` time NOT NULL,
  `SHoraEntrada` time NOT NULL,
  `SHoraSalida` time NOT NULL,
  `LVHorasAlmuerzo` int(11) DEFAULT NULL,
  `LVHoraEntradaAdmin` time NOT NULL,
  `LVHoraSalidaAdmin` time NOT NULL,
  `SHoraEntradaAdmin` time NOT NULL,
  `SHoraSalidaAdmin` time NOT NULL,
  `LVHorasAlmuerzoAdmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `asistencia`
--

CREATE TABLE `asistencia` (
  `EntryNo` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `RegistroEntrada` datetime NOT NULL,
  `RegistroSalida` datetime NOT NULL,
  `Ingreso` tinyint(4) DEFAULT '0',
  `DocumentoNo` varchar(50) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Observaciones` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Categoría` int(11) NOT NULL,
  `idLider1` int(11) NOT NULL,
  `idLider2` int(11) NOT NULL,
  `logo_filename` varchar(50) NOT NULL,
  `logo_filepath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idMicrocelula` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `DocumentoTipo` enum('Cedula','Pasaporte','Tarjeta Identidad') NOT NULL,
  `DocumentoNo` varchar(50) NOT NULL,
  `Genero` enum('Masculino','Femenino') NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `TelefonoMovil` varchar(20) NOT NULL,
  `TelefonoResidencia` varchar(20) NOT NULL,
  `TelefonoOficina` varchar(20) NOT NULL,
  `EstadoCivil` enum('Soltero','Union Libre','Casado','Viudo') CHARACTER SET utf8 COLLATE utf8_esperanto_ci NOT NULL,
  `idConyugue` int(11) NOT NULL,
  `FechaMatrimonio` date NOT NULL,
  `Profesion` varchar(50) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `Habilidades` set('Musica','Manualidades','ApoyoSocial','Niños','DinamicasGrupo','Decoracion','RedesSociales') NOT NULL,
  `foto_filename` varchar(50) NOT NULL,
  `foto_filepath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `TipoUsuario` enum('Gerente','Admin') NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idGrupo`, `TipoUsuario`, `Usuario`, `Nombre`, `Apellido`, `Password`, `Email`) VALUES
(1, 0, 'Admin', 'admin', 'Carlos', 'Arboleda', '0c7540eb7e65b553ec1ba6b20de79608', 'carlos.a.arboleda@gmail.com'),
(15, 0, 'Gerente', 'humber', 'Humberto', 'Cardona', '38d56dd35102fca79d505d589ed307fa', 'h@h.h');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`EntryNo`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `EntryNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
