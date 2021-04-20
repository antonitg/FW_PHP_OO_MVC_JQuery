-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-03-2021 a las 19:43:13
-- Versión del servidor: 8.0.22
-- Versión de PHP: 7.4.13RC1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cars`
--

CREATE TABLE `cars` (
  `registration` varchar(7) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `regdate` date NOT NULL,
  `carcondition` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `upgrades` varchar(200) NOT NULL,
  `category` varchar(120) NOT NULL,
  `price` int NOT NULL,
  `lat` varchar(45) NOT NULL,
  `lon` varchar(45) NOT NULL,
  `views` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cars`
--

INSERT INTO `cars` (`registration`, `brand`, `model`, `regdate`, `carcondition`, `upgrades`, `category`, `price`, `lat`, `lon`, `views`) VALUES
('0000AAA', 'KIA', 'Tiguan', '2018-10-10', 'Used', 'Wheels:', 'Beniganim,Nou', 9000, '-10.89000', '138.61816', 7),
('0000AAB', 'bmw', 'Serie 1', '2010-10-10', 'New', 'Motor:', 'Valencia', 9000, '76.98908', '21.74515', 5),
('0000AAF', 'KIA', 'Coupe', '2020-10-10', 'New', 'Motor:Wheels:Seats:', 'Promo', 19999, '38.942228', '-0.355878', 4),
('0000ASD', 'BMW', 'asd', '2021-02-09', 'New', 'Motor:', 'ASD', 8034, '41.3828939', '2.1774322', 4),
('0000AXC', 'Volvo', 'Corse', '2020-12-09', 'Old', 'Wheels:', 'Oferta', 2000, '40.416705', '3.703582', 4),
('1345PDS', 'SEAT', 'Ibiza', '2018-10-30', 'Used', 'Motor:Wheels:', 'SEAT', 13500, '37.9923795', '-1.1305431', 39),
('2484HSU', 'Mercedes-Benz', 'AMG1', '2019-09-20', 'Used', 'Motor:Wheels:', 'Garaje', 30450, '39.469707', '-0.376335', 1),
('2846HDS', 'Volkswagen', 'Polo', '2018-09-13', 'Used', 'Motor:', 'Nou,Barat', 4670, '38.353738', '-0.490185', 7),
('3649CGE', 'SEAT', 'Mondeo', '2021-02-28', 'Old', 'Motor:', 'SEAT', 4947, '', '', 35),
('4788GGD', 'Bugatti', 'Veyron', '2019-04-05', 'New', 'Motor:Wheels:Seats:', 'Premium', 2200000, '39.98333', '-0.03333', 44),
('7993HSF', 'FIAT', '500', '2020-03-07', 'New', 'Motor:Wheels:Seats:', 'Edicion Limitada', 3400, '', '', 0),
('9834UZB', 'FIAT', 'Multipla', '2013-11-23', 'Old', 'Seats:', 'Lleig', 1200, '', '', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img`
--

CREATE TABLE `img` (
  `id` varchar(30) NOT NULL,
  `src` varchar(150) NOT NULL,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `img`
--

INSERT INTO `img` (`id`, `src`, `tipo`) VALUES
('0000AAA', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('0000AAB', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('0000AAC', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('0000AAF', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('0000ASD', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('0000AXC', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('1345PDS', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('1455LKD', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('1834JAF', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('1836NAO', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('2484HSU', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('2846HDS', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('3456GXW', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('3649CGE', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('4788GGD', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('7993HSF', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('9582JSI', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('9834UZB', 'https://i.pinimg.com/originals/bd/b4/6f/bdb46ffb292c431640cf33a2a64a9c64.jpg', 'car'),
('BMW', 'https://cdn.pixabay.com/photo/2016/03/26/22/34/car-1281640_960_720.jpg', 'cat'),
('KM0', 'https://cdn.pixabay.com/photo/2015/12/08/00/28/car-1081742_960_720.jpg\r\n', 'cat'),
('Luxury', 'https://cdn.pixabay.com/photo/2020/09/06/07/37/car-5548242_960_720.jpg', 'cat'),
('Preowned', 'https://cdn.pixabay.com/photo/2017/08/22/00/27/car-dashboard-2667434_960_720.jpg', 'cat'),
('Seat', 'https://cdn.pixabay.com/photo/2017/08/12/12/00/seat-leon-2634185_960_720.jpg', 'cat');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`registration`);

--
-- Indices de la tabla `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
