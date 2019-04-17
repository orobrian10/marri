-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2019 a las 21:59:36
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maquirriain`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campos`
--

CREATE TABLE `campos` (
  `id` int(11) NOT NULL,
  `nom_campos` varchar(40) NOT NULL,
  `loc_campos` int(11) NOT NULL,
  `hec_tot_campos` int(11) NOT NULL,
  `hec_sem_campos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `campos`
--

INSERT INTO `campos` (`id`, `nom_campos`, `loc_campos`, `hec_tot_campos`, `hec_sem_campos`) VALUES
(3, 'AES', 1, 31, 1),
(4, '54354', 1, 12, 12),
(6, 'teas1', 2, 2, 3),
(7, '1', 2, 3, 4),
(8, '1', 2, 3, 4),
(9, '1', 2, 3, 4),
(10, '1', 2, 3, 4),
(11, '12', 2, 121, 32),
(12, '4324', 1, 121, 21),
(13, '1', 2, 3, 4),
(14, '1', 2, 3, 4),
(15, 'Campo Brian', 2, 150, 200),
(16, '2', 1, 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE `localidades` (
  `id_loc` int(11) NOT NULL,
  `nom_loc` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id_loc`, `nom_loc`) VALUES
(1, 'Rosario'),
(2, 'Bs as');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campos`
--
ALTER TABLE `campos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loc_rel` (`loc_campos`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_loc`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campos`
--
ALTER TABLE `campos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id_loc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `campos`
--
ALTER TABLE `campos`
  ADD CONSTRAINT `loc_rel` FOREIGN KEY (`loc_campos`) REFERENCES `localidades` (`id_loc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
