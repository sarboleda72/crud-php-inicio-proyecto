-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2023 a las 17:45:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adsi1323395`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `documento` int(11) NOT NULL,
  `nombres` varchar(35) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `foto` longblob NOT NULL,
  `genero` varchar(10) NOT NULL,
  `rol` varchar(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`documento`, `nombres`, `correo`, `clave`, `telefono`, `ciudad`, `foto`, `genero`, `rol`) VALUES
(23413, 'fsdgg', 'mono1@gmail.com', 'd81f9c1be2e08964bf9f', '635634636', 'Manizales', 0x7075626c69632f696d67732f666f746f732f3031657863656c31322e6a7067, 'T', ''),
(123456, 'Isabel Reina Inglaterra1', 'isabel@isabel.com', 'cb37fd639c21c6f5093c', '908978563412', 'Manizales', 0x7075626c69632f696d67732f666f746f732f6b7561732e706e67, 'M', ''),
(232323, 'popeye', 'popeye@gmasil.com', 'b5d80b7c6c6129032b3f', '343434', 'manizales', 0x7075626c69632f696d67732f666f746f732f6b7561732e706e67, 'M', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`documento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
