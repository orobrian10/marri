-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2019 a las 21:55:30
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
-- Estructura de tabla para la tabla `acopios`
--

CREATE TABLE `acopios` (
  `id_aco` int(11) NOT NULL,
  `nom_aco` varchar(50) NOT NULL,
  `ubi_aco` int(11) NOT NULL,
  `cer_aco` int(11) NOT NULL,
  `lot_aco` int(11) NOT NULL,
  `sil_aco` int(1) DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acopios`
--

INSERT INTO `acopios` (`id_aco`, `nom_aco`, `ubi_aco`, `cer_aco`, `lot_aco`, `sil_aco`, `stock`) VALUES
(10, 'acotest', 1, 2, 12, 1, 17500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acopios_lugares`
--

CREATE TABLE `acopios_lugares` (
  `id_lug` int(11) NOT NULL,
  `nom_lug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `acopios_lugares`
--

INSERT INTO `acopios_lugares` (`id_lug`, `nom_lug`) VALUES
(1, 'Martino Cereales'),
(2, 'Coop. de Carcarañá'),
(3, 'Cooperativa de San Jerónimo'),
(4, 'San Cristóbal'),
(5, 'Silos Bolsa'),
(6, 'Silos Propios'),
(7, 'tes2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cereales`
--

CREATE TABLE `cereales` (
  `id_cer` int(11) NOT NULL,
  `nom_cer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cereales`
--

INSERT INTO `cereales` (`id_cer`, `nom_cer`) VALUES
(1, 'Trigo'),
(2, 'Mariz');

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
(2, 'Bs as'),
(5, 'Tucuman'),
(6, 'Santa Fe'),
(7, 'San Jeronimo'),
(8, 'Roldan2'),
(9, 'Arroyo Seco'),
(10, 'San Pedro'),
(11, 'Baradero'),
(13, 'Tierra del fuego'),
(14, 'Chubut'),
(15, 'asdx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_mov` int(11) NOT NULL,
  `fec_cos` date NOT NULL,
  `can_mov` int(11) NOT NULL,
  `ori_mov` int(11) NOT NULL,
  `des_mov` int(11) NOT NULL,
  `car_mov` int(11) DEFAULT NULL,
  `cer_mov` int(11) NOT NULL,
  `stock_ant_mov` int(11) NOT NULL,
  `cre_mov` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_mov`, `fec_cos`, `can_mov`, `ori_mov`, `des_mov`, `car_mov`, `cer_mov`, `stock_ant_mov`, `cre_mov`) VALUES
(18, '2019-04-26', 3500, 1, 10, 1, 1, 5000, '2019-04-26 16:30:36'),
(19, '2019-04-26', 15000, 1, 10, 5, 1, 2500, '2019-04-26 16:31:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_pro` int(11) NOT NULL,
  `nom_pro` varchar(50) NOT NULL,
  `tel_pro` varchar(12) NOT NULL,
  `loc_pro` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_pro`, `nom_pro`, `tel_pro`, `loc_pro`) VALUES
(1, 'Azul', '2147483647', 11),
(3, 'Avril', '1', 2),
(4, '1', '3416792500', 2),
(5, '12312', '2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variedades`
--

CREATE TABLE `variedades` (
  `id_var` int(11) NOT NULL,
  `cer_var` int(3) NOT NULL,
  `des_var` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `variedades`
--

INSERT INTO `variedades` (`id_var`, `cer_var`, `des_var`) VALUES
(3, 1, 'Var test 1'),
(4, 1, 'Var trigo test2'),
(5, 2, 'test mariz'),
(6, 1, 'var2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ven` int(11) NOT NULL,
  `fec_ven` date NOT NULL,
  `cer_ven` int(3) NOT NULL,
  `kgs_ven` float NOT NULL,
  `pkg_ven` float NOT NULL,
  `pto_ven` float NOT NULL,
  `des_ven` int(4) NOT NULL,
  `stock_ven` int(11) NOT NULL,
  `cre_ven` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ven`, `fec_ven`, `cer_ven`, `kgs_ven`, `pkg_ven`, `pto_ven`, `des_ven`, `stock_ven`, `cre_ven`) VALUES
(8, '2019-04-26', 1, 4000, 150, 600000, 10, 8500, '2019-04-26 16:31:12'),
(9, '2019-04-26', 2, 2000, 100, 200000, 10, 4500, '2019-04-26 16:31:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acopios`
--
ALTER TABLE `acopios`
  ADD PRIMARY KEY (`id_aco`),
  ADD KEY `lugares` (`ubi_aco`);

--
-- Indices de la tabla `acopios_lugares`
--
ALTER TABLE `acopios_lugares`
  ADD PRIMARY KEY (`id_lug`);

--
-- Indices de la tabla `cereales`
--
ALTER TABLE `cereales`
  ADD PRIMARY KEY (`id_cer`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
  ADD PRIMARY KEY (`id_loc`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_mov`),
  ADD KEY `cer_mov` (`cer_mov`),
  ADD KEY `des_mov` (`des_mov`),
  ADD KEY `ori_mov` (`ori_mov`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_pro`),
  ADD KEY `localidad_proveedor` (`loc_pro`);

--
-- Indices de la tabla `variedades`
--
ALTER TABLE `variedades`
  ADD PRIMARY KEY (`id_var`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ven`),
  ADD KEY `cer_ven` (`cer_ven`),
  ADD KEY `des_ven` (`des_ven`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acopios`
--
ALTER TABLE `acopios`
  MODIFY `id_aco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `acopios_lugares`
--
ALTER TABLE `acopios_lugares`
  MODIFY `id_lug` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cereales`
--
ALTER TABLE `cereales`
  MODIFY `id_cer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
  MODIFY `id_loc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_mov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `variedades`
--
ALTER TABLE `variedades`
  MODIFY `id_var` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acopios`
--
ALTER TABLE `acopios`
  ADD CONSTRAINT `lugares` FOREIGN KEY (`ubi_aco`) REFERENCES `acopios_lugares` (`id_lug`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`cer_mov`) REFERENCES `cereales` (`id_cer`),
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`des_mov`) REFERENCES `acopios` (`id_aco`),
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`ori_mov`) REFERENCES `acopios_lugares` (`id_lug`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `localidad_proveedor` FOREIGN KEY (`loc_pro`) REFERENCES `localidades` (`id_loc`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cer_ven`) REFERENCES `cereales` (`id_cer`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`des_ven`) REFERENCES `acopios` (`id_aco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
