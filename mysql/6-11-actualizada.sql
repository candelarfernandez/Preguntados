-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2023 a las 14:41:55
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
-- Base de datos: `preguntados`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `anio` date NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `pais` varchar(150) NOT NULL,
  `ciudad` varchar(150) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `contrasenia` varchar(150) NOT NULL,
  `estaActiva` int(1) NOT NULL DEFAULT 0,
  `nombreUsuario` varchar(150) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `puntajeTotal` int(11) NOT NULL,
  `cantRespuestas` int(11) NOT NULL,
  `cantRespuestasCorrectas` int(11) NOT NULL,
  `idRol` int(11) NOT NULL DEFAULT 1,
  `latitud` int(11) NOT NULL,
  `longitud` int(11) NOT NULL,
  `nivel` varchar(255) NOT NULL DEFAULT 'principiante',
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `anio`, `sexo`, `pais`, `ciudad`, `mail`, `contrasenia`, `estaActiva`, `nombreUsuario`, `foto`, `codigo`, `puntajeTotal`, `cantRespuestas`, `cantRespuestasCorrectas`, `idRol`, `latitud`, `longitud`, `nivel`, `fechaRegistro`) VALUES
(27, 'Candela Fernandez', '2023-10-01', 'Femenino', 'Argentina', 'Morón', 'cande.fdz12@gmail.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'candelaxx', '', '668899', 13, 0, 0, 1, 0, 0, 'principiante', '2023-10-05 09:32:57'),
(31, 'Maria Vazquez', '2023-10-04', 'Femenino', 'Argentina', 'Morón', 'test@test11.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'candelaxx', '', '275318', 0, 0, 0, 2, 0, 0, 'principiante', '2023-10-12 09:32:57'),
(32, 'Florencia Micaela', '2004-06-16', 'Femenino', 'Argentina', 'Morón', 'test@test2.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'florenciax', './public/img/Horarios .jpg', '296924', 0, 0, 0, 3, 0, 0, 'principiante', '2023-11-05 09:32:57'),
(33, 'Leo', '2000-09-02', 'Masculino', 'Argentina', 'Buenos Aires', 'vilteleonardo92@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'LeoV', './public/img/hipo-perritos-Blog04.jpg', '549467', 82, 218, 29, 1, 0, 0, 'principiante', '2023-11-06 09:32:57'),
(34, 'rocio', '2023-11-06', 'Femenino', 'Argentina', 'buenos aires', 'ro.espana.ero@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'rocioesp', '', '698219', 0, 0, 0, 1, -35, -58, 'principiante', '2023-11-06 10:38:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
