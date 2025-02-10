-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-12-2024 a las 19:25:58
-- Versión del servidor: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- Versión de PHP: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `uoc`
--
CREATE DATABASE IF NOT EXISTS `uoc` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `uoc`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Category`
--

CREATE TABLE `Category` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `Category`
--

INSERT INTO `Category` (`id`, `name`, `description`, `img`) VALUES
(1, 'Estructurales', 'Elementos que forman parte de la estructura, tanto interiores como exteriores. Aquí encontrarás ventanas, claraboyas, toldos, estructuras de asientos, bases giratorias...', 'estructurales.jpeg'),
(2, 'Agua', 'Todo lo que tenga que ver con la instalación de agua como depósitos, tuberías, desagües, lavavos, fregaderos, grifos...', 'aguas.jpg'),
(3, 'Electricidad', 'Cables, protecciones, instalación solar, batería auxiliar...', 'electricidad.png'),
(4, 'Comfort', 'Colchones, calefacción estacionaria, aire acondicionado, detectores de CO, detectores de gases inflamables...', 'comfort.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Order`
--

CREATE TABLE `Order` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `data` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `Order`
--

INSERT INTO `Order` (`id`, `userId`, `date`, `data`) VALUES
(1, 2, '2024-11-13 10:15:21', ''),
(2, 2, '2024-11-14 17:17:22', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Product`
--

CREATE TABLE `Product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `img` varchar(250) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `cat` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `Product`
--

INSERT INTO `Product` (`id`, `name`, `description`, `img`, `price`, `cat`) VALUES
(1, 'Depósito aguas grises 80 L', '', 'deposito80L.jpg', 78.90, 2),
(2, 'Claraboya Fiamma Turbo Vent 40x40', '', 'claraboya.jpg', 128.70, 1),
(3, 'Cuadro eléctrico', '', 'cuadro-electrico.jpg', 91.00, 3),
(4, 'Kit solar', '', 'kit-solar.jpg', 259.00, 3),
(5, 'Calefacción estacionaria', '', 'calefaccion.jpg', 210.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Product_Order`
--

CREATE TABLE `Product_Order` (
  `id` int(11) NOT NULL,
  `orderId` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `Product_Order`
--

INSERT INTO `Product_Order` (`id`, `orderId`, `productId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 2),
(4, 2, 2),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE `User` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(60) NOT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`id`, `email`, `username`, `password`, `lastlogin`, `role`) VALUES
(1, 'admin@uoc.edu', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2024-12-01 17:04:24', 2),
(2, 'mgoyenech3@uoc.edu', 'mikeluoc', '3da541559918a808c2402bba5012f6c60b27661c', '2024-11-29 12:40:38', 1),
(6, 'mmore.cabanas@gmail.com', 'asdddd', 'dfc079ab60ecfaf82d36724567f479ce72034521', '2024-12-01 17:00:55', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Order`
--
ALTER TABLE `Order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indices de la tabla `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat` (`cat`);

--
-- Indices de la tabla `Product_Order`
--
ALTER TABLE `Product_Order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Category`
--
ALTER TABLE `Category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Order`
--
ALTER TABLE `Order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Product_Order`
--
ALTER TABLE `Product_Order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `User`
--
ALTER TABLE `User`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Order`
--
ALTER TABLE `Order`
  ADD CONSTRAINT `Order_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `User` (`id`);

--
-- Filtros para la tabla `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`cat`) REFERENCES `Category` (`id`);

--
-- Filtros para la tabla `Product_Order`
--
ALTER TABLE `Product_Order`
  ADD CONSTRAINT `Product_Order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Product` (`id`),
  ADD CONSTRAINT `Product_Order_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `Order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
