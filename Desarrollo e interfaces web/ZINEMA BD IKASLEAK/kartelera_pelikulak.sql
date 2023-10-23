-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2020 a las 14:39:48
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kartelera_pelikulak`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_butacasLibres` (IN `p_id` INT, IN `p_butacasLibres` INT)  NO SQL
UPDATE pelistabla
SET pelistabla.butacasLibres=p_butacasLibres
WHERE pelistabla.id=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_concultar_peliculas` ()  NO SQL
SELECT * from pelistabla$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelistabla`
--

CREATE TABLE `pelistabla` (
  `id` int(11) NOT NULL,
  `cartelPeli` text NOT NULL,
  `tituloPeli` text NOT NULL,
  `butacasLibres` int(11) NOT NULL,
  `butacasTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pelistabla`
--

INSERT INTO `pelistabla` (`id`, `cartelPeli`, `tituloPeli`, `butacasLibres`, `butacasTotal`) VALUES
(1, 'view/img/mechanic.jpg', 'MECHANIC:RESURRECTION', 100, 100),
(2, 'view/img/missperegrine.jpg', 'EL HOGAR DE MISS PEREGRINE PARA NIÑOS PECULIARES', 144, 150),
(3, 'view/img/unmonstruo.jpg', 'UN MONSTRUO VIENE A VERME', 75, 75),
(4, 'view/img/ozzy.jpg', 'OZZY', 50, 50);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pelistabla`
--
ALTER TABLE `pelistabla`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pelistabla`
--
ALTER TABLE `pelistabla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
