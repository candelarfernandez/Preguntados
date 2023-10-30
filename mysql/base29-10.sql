-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 29-10-2023 a las 16:38:27
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
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `urlImagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `urlImagen`) VALUES
(1, 'Programación', '\\public\\img\\programacion.png'),
(2, 'Historia', 'public\\img\\categorias\\historia.png'),
(3, 'Deportes', 'public\\img\\categorias\\deportes.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`id`, `idUsuario`, `puntaje`, `fecha`) VALUES
(14, 27, 0, '2023-10-28'),
(31, 31, 0, '2023-10-28'),
(32, 27, 2, '2023-10-28'),
(33, 27, 1, '2023-10-28'),
(34, 27, 3, '2023-10-28'),
(35, 27, 1, '2023-10-28'),
(36, 27, 2, '2023-10-28'),
(37, 27, 2, '2023-10-28'),
(38, 27, 0, '2023-10-28'),
(39, 27, 2, '2023-10-28'),
(40, 27, 0, '2023-10-28'),
(41, 27, 0, '2023-10-28'),
(42, 27, 0, '2023-10-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `pregunta` text NOT NULL,
  `id` int(10) NOT NULL,
  `id_categoria` int(11) DEFAULT 1,
  `reportada` int(11) NOT NULL DEFAULT 0,
  `vecesRespondida` int(11) NOT NULL,
  `vecesNoRespondida` int(11) NOT NULL,
  `dificultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`pregunta`, `id`, `id_categoria`, `reportada`, `vecesRespondida`, `vecesNoRespondida`, `dificultad`) VALUES
('Si en un script PHP encuentra una llamada a un m?todo de clase de la siguiente manera:\nUsuario::traerUsuario();\nSe trata de:', 1, 1, 0, 0, 0, 0),
('Cuando utilizo una Clase en forma est?tica siempre se ejecuta el m?todo __construct()', 2, 1, 0, 0, 0, 0),
('La S del acr?nimo SOLID es por el concepto Single Responsability, que indica:', 3, 1, 0, 0, 0, 0),
('El concepto de acoplamiento refiere a:', 4, 1, 0, 0, 0, 0),
('Como concepto general podemos decir que a menos acoplamiento mejor software', 5, 1, 1, 0, 0, 0),
('En software se entiende por patr?n de dise?o a:', 6, 1, 1, 0, 0, 0),
('El patr?n MVC se utiliza mucho en aplicaciones web porque:', 7, 1, 1, 0, 0, 0),
('En un modelo MVC el que recibe normalmente la petici?n del cliente es:', 8, 1, 1, 0, 0, 0),
('El modelo en un esquema MVC es el encargado de almacenar y ejecutar la l?gica del negocio', 9, 1, 0, 0, 0, 0),
('Uno de los objetivos del modelo MVC es separar en la aplicaci?n el modelo de negocios de las interfaces de usuario', 10, 1, 1, 0, 0, 0),
('El enrutador en un modelo MVC es el encargado de ejecutar las operaciones de acceso a la base de datos', 11, 1, 0, 0, 0, 0),
('El folding en una aplicaci?n web se refiere a:', 12, 1, 1, 0, 0, 0),
('Si estoy desarrollando usando TDD estoy', 13, 1, 0, 0, 0, 0),
('El patr?n MVC esta compuesto por:', 14, 1, 0, 0, 0, 0),
('En un patr?n MVC la Vista es la encargada de ', 15, 1, 0, 0, 0, 0),
('La principal diferencia entre los enfoques Responsive y Mobile First es', 16, 1, 0, 0, 0, 0),
('La principal diferencia entre una Aplicaci?n Web y una Aplicaci?n monol?tica (por ejemplo una Win32) es:', 17, 1, 0, 0, 0, 0),
('El protocolo a trav?s del cu?l se realiza todo el intercambio de datos entre un servidor web y un cliente es:', 18, 1, 1, 0, 0, 0),
('El protocolo HTTP tiene entre sus caracteristicas ser:', 19, 1, 0, 0, 0, 0),
('El protocolo DNS es:', 20, 1, 0, 0, 0, 0),
('El protocolo HTTP implementa comandos, entre ellos:', 21, 1, 0, 0, 0, 0),
('El protyocolo HTTP implementa codigos de error de respuesta, si recibo un codigo de la serie 500, ha ocurrido:', 22, 1, 1, 0, 0, 0),
('El protyocolo HTTP implementa codigos de error de respuesta, si recibo un codigo de la serie 400, ha ocurrido:', 23, 1, 0, 0, 0, 0),
('El protyocolo HTTP implementa codigos de error de respuesta, si recibo un codigo de la serie 200, ha ocurrido:', 24, 1, 0, 0, 0, 0),
('En una petici?n GET, los parametros de la petici?n se pasan a trav?s de....', 25, 1, 0, 0, 0, 0),
('Se denomina Scripting del lado del cliente, o programaci?n Front-end o Client Side Scripting a :', 26, 1, 0, 0, 0, 0),
('Se denomina Scripting del lado del servidor, o programaci?n Back-end o Server Side Scripting a :', 27, 1, 1, 0, 0, 0),
('La petici?n de un recurso determinado a un sitio Web (imagen, archivo, etc.) se canaliza mediante:', 28, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasreportadas`
--

CREATE TABLE `preguntasreportadas` (
  `id` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntassugeridas`
--

CREATE TABLE `preguntassugeridas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasusadas`
--

CREATE TABLE `preguntasusadas` (
  `id` int(25) NOT NULL,
  `idPregunta` int(25) NOT NULL,
  `idPartida` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntasusadas`
--

INSERT INTO `preguntasusadas` (`id`, `idPregunta`, `idPartida`) VALUES
(155, 25, 14),
(156, 20, 14),
(157, 13, 14),
(158, 10, 14),
(159, 24, 14),
(160, 23, 14),
(161, 21, 14),
(162, 6, 14),
(163, 2, 14),
(164, 9, 14),
(165, 3, 14),
(166, 16, 14),
(167, 5, 14),
(168, 12, 14),
(169, 4, 14),
(170, 27, 14),
(171, 28, 14),
(172, 8, 14),
(173, 19, 14),
(174, 1, 14),
(175, 26, 14),
(177, 19, 31),
(178, 3, 31),
(179, 26, 31),
(180, 11, 31),
(181, 24, 31),
(182, 23, 31),
(183, 12, 31),
(184, 14, 31),
(185, 28, 31),
(186, 18, 14),
(187, 7, 14),
(188, 22, 14),
(189, 17, 14),
(190, 11, 14),
(191, 5, 33),
(192, 13, 33),
(193, 24, 34),
(194, 14, 34),
(195, 15, 34),
(196, 27, 34),
(197, 3, 34),
(198, 17, 34),
(199, 6, 34),
(200, 5, 34),
(201, 18, 34),
(202, 10, 34),
(203, 19, 34),
(204, 12, 34),
(205, 28, 34),
(206, 2, 34),
(207, 23, 34),
(208, 18, 35),
(209, 11, 35),
(210, 22, 35),
(211, 23, 35),
(212, 25, 35),
(213, 17, 35),
(214, 24, 35),
(215, 1, 35),
(216, 10, 35),
(217, 19, 35),
(218, 4, 35),
(219, 27, 35),
(232, 15, 36),
(233, 27, 36),
(234, 16, 36),
(235, 19, 37),
(236, 26, 37),
(237, 9, 37),
(238, 17, 37),
(239, 22, 38),
(240, 9, 39),
(241, 8, 39),
(242, 15, 39),
(243, 17, 39),
(244, 3, 39),
(245, 13, 39),
(246, 11, 39),
(247, 4, 39),
(248, 16, 39),
(249, 28, 39),
(250, 1, 39),
(251, 12, 39),
(252, 23, 39),
(253, 27, 39),
(254, 7, 39),
(255, 5, 39),
(256, 14, 39),
(257, 22, 39),
(258, 6, 39),
(259, 18, 39),
(260, 10, 39),
(261, 26, 39),
(262, 28, 41),
(263, 18, 41),
(264, 12, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(10) NOT NULL,
  `idPregunta` int(10) NOT NULL,
  `respuesta` text NOT NULL,
  `esCorrecta` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `idPregunta`, `respuesta`, `esCorrecta`) VALUES
(1, 1, 'Una llamada al m?todo por referencia', 'false'),
(2, 1, 'Un m?tido de una Clase invocado en forma est?tica', 'true'),
(3, 1, 'Llamada a un constructor', 'false'),
(4, 1, 'Instanciaci?n de una Clase', 'false'),
(5, 2, 'VERDADERO', 'false'),
(6, 2, 'FALSO', 'true'),
(7, 3, 'Que una Clase solo debe ser instanciada para poder invocer un m?todo de la misma', 'false'),
(8, 3, 'Que una Clase debe cumplir la mayor cantidad de funciones dentro de mi modelo de negocios', 'false'),
(9, 3, 'Que un objeto/clase debe tener una sola raz?n para cambiar, esto es debe tener un s?lo trabajo', 'true'),
(10, 3, 'Los objetos o clases deben estar abiertos por extensi?n, pero cerrados por modificaci?n.', 'false'),
(11, 4, 'al grado de interdependencia que tienen dos unidades de software entre s?', 'true'),
(12, 4, 'al grado de independencia que tienen dos unidades de software entre s?', 'false'),
(13, 4, 'al grado de comunicaci?n que tienen dos unidades de software entre s?', 'false'),
(14, 4, 'al grado de complejidad que tienen dos unidades de software', 'false'),
(15, 5, 'VERDADERO', 'true'),
(16, 5, 'FALSO', 'false'),
(17, 6, 'Al due?o de un dise?o determinado', 'false'),
(18, 6, 'A un conjunto de t?cnicas aplicadas en conjunto para resolver problemas comunes al desarrollo de software', 'true'),
(19, 6, 'Es la vertienrte de POO que se ocupa del desarrollo de interfaces', 'false'),
(20, 6, 'En POO se denomina as? a una clase que funciona como una librer?a en Porcedural', 'false'),
(21, 7, 'Es mas lindo', 'false'),
(22, 7, 'Es mas simple', 'false'),
(23, 7, 'Representa bien la divisi?n de entornos en una aplicaci?n web', 'true'),
(24, 7, 'Esta desarrollado para explicar las interfaces desde una ?ptica de UX', 'false'),
(25, 8, 'el controlador', 'false'),
(26, 8, 'el modelo', 'false'),
(27, 8, 'la vista', 'false'),
(28, 8, 'el enrutador', 'true'),
(29, 9, 'VERDADERO', 'true'),
(30, 9, 'FALSO', 'false'),
(31, 10, 'VERDADERO', 'true'),
(32, 10, 'FALSO', 'false'),
(33, 11, 'VERDADERO', 'false'),
(34, 11, 'FALSO', 'true'),
(35, 12, 'una forma de disponer de las consultas en la base de datos', 'false'),
(36, 12, 'una forma de escribir el c?digo de manera que sea legible', 'false'),
(37, 12, 'una forma de ordenar el c?digo de manera que el proyecto sea comprensible', 'true'),
(38, 12, 'un m?todo de foldear vistas', 'false'),
(39, 13, 'Usando un m?todo de programaci?n basado en objetos', 'false'),
(40, 13, 'Usando un m?todo de programaci?n basado en funciones', 'true'),
(41, 13, 'Usando un m?todo de programaci?n basado en pruebas', 'false'),
(42, 13, 'Usando un m?todo de programaci?n basado en test', 'false'),
(43, 14, 'Un Modelo, una Vista y un Controlador, complementados por un enrutador', 'true'),
(44, 14, 'Un Modelo, una Vista y un Controlador', 'false'),
(45, 14, 'Un Modelo, una Versionador y un Controlador', 'false'),
(46, 14, 'Un Microservicio, una Vista y un Controlador', 'false'),
(47, 15, 'Resolver la comunicaci?n con el usuario', 'true'),
(48, 15, 'Comunicar al Controlador con el Modelo', 'false'),
(49, 15, 'Resolver la l?gica de negocios', 'false'),
(50, 15, 'Resolver la petici?n del usuario', 'false'),
(51, 16, 'Que el enfoque Mobile First se basa en CSS3 y HTML 5.', 'false'),
(52, 16, 'Que el enfoque Mobile First se basa en la idea de dise?ar pensando en el ambiente m?vil y de all? llevar el dise?o al desktop.', 'true'),
(53, 16, 'En que el enfoque Responsive el sitio debe adaptarse a diferentes dispositivos y en el enfoque Mobile First no.', 'false'),
(54, 16, 'Los dos enfoques son iguales, dos nombres para identificar o mismo.', 'false'),
(55, 16, 'La 1 y 4 son correctas', 'false'),
(60, 17, 'Son escencialmente iguales', 'false'),
(61, 17, 'Que una aplicaci?n web hace uso de una red TCP/IP y una aplicaci?n monol?tica no.', 'false'),
(62, 17, 'Que en una aplicaci?n web es dividida en dos partes interdependientes, una en el cliente (visualizaci?n) y otra en el servidor (l?gica de negocios, acceso a datos, etc.)', 'true'),
(63, 17, '1 y 2 son correctas', 'false'),
(64, 18, 'HTTP/HTTPS', 'true'),
(65, 18, 'DNS/HTTP', 'false'),
(66, 18, 'REST', 'false'),
(67, 18, '1 y 2 son correctas', 'false'),
(68, 19, 'No orientado a la conexi?n (Conectionless) / Sin mantenimiento de estado de conexi?n (Stateless)', 'true'),
(69, 19, 'No orientado a la conexi?n (Conectionless) ', 'false'),
(70, 19, 'Orientado a la conexi?n ', 'false'),
(71, 19, 'Orientado al mantenimiento de estado de conexi?n ', 'false'),
(72, 20, 'Un protocolo de resoluci?n de espacios de procesamiento en un entorno distribuido', 'false'),
(73, 20, 'Un protocolo de cifrado de 3 niveles usado en Internet', 'false'),
(74, 20, 'Un protocolo de comunicaci?n entre sitios web y sus clientes', 'false'),
(75, 20, 'Un protocolo de resoluci?n de nombres de caracteristicas jer?rquicas', 'true'),
(76, 21, 'GET, POST, HEAD', 'true'),
(77, 21, 'SEND, PING, SAVE', 'false'),
(78, 21, 'GET, SEND, PING', 'false'),
(79, 21, 'GET, POST, SEND', 'false'),
(80, 22, 'Nada, informa que el procesamiento finlaizo Ok', 'false'),
(81, 22, 'Informa un error en la resolcu?n DNS del nombre', 'false'),
(82, 22, 'Informa que ha ocurrido un error en el procesamiento de la peticion en el servidor', 'true'),
(83, 22, 'Informa que ha ocurrido un error en el procesamiento de la peticion en el cliente', 'false'),
(84, 23, 'Nada, informa que el procesamiento finlaizo Ok', 'false'),
(85, 23, 'Informa un error en la resolcu?n DNS del nombre', 'false'),
(86, 23, 'Informa que ha ocurrido un error en el procesamiento de la peticion en el servidor', 'false'),
(87, 23, 'Informa que ha ocurrido un error en el procesamiento de la peticion en el cliente', 'true'),
(88, 24, 'Nada, informa que el procesamiento finlaizo Ok', 'true'),
(89, 24, 'Informa un error en la resolcu?n DNS del nombre', 'false'),
(90, 24, 'Informa que ha ocurrido un error en el procesamiento de la peticion en el servidor', 'false'),
(91, 24, 'Informa que ha ocurrido un error en el procesamiento de la peticion en el cliente', 'false'),
(92, 25, 'El cuerpo de la petici?n', 'false'),
(93, 25, 'Abriendo un socket', 'false'),
(94, 25, 'Como parte de la URL', 'true'),
(95, 25, 'No se pueden pasar parametros en una peticion GET', 'false'),
(96, 26, 'Porciones de codigo ejecutable que se envian al navegador del cliente para que este los ejecute', 'true'),
(97, 26, 'Porciones de codigo ejecutable que el cliente envia para quese ejecuten en el servidor', 'false'),
(98, 26, 'La parte del modelo de negocios que se ejecuta en el servidor', 'false'),
(99, 26, 'Ninguna de las anteriores', 'false'),
(100, 27, 'Porciones de codigo ejecutable que se envian al navegador del cliente para que este los ejecute', 'false'),
(101, 27, 'Porciones de c?digo ejecutable que se ejecutan en el servidor ante una petici?n del cliente', 'true'),
(102, 27, 'La parte del modelo de negocios que se ejecuta en el cliente', 'false'),
(103, 27, 'Ninguna de las anteriores', 'false'),
(104, 28, 'Una URL', 'true'),
(105, 28, 'Un DNS', 'false'),
(106, 28, 'Una API', 'false'),
(107, 28, 'Ninguna de las anteriores', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `tipo`) VALUES
(1, 'usuario'),
(2, 'administrador'),
(3, 'editor');

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
  `idRol` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `anio`, `sexo`, `pais`, `ciudad`, `mail`, `contrasenia`, `estaActiva`, `nombreUsuario`, `foto`, `codigo`, `puntajeTotal`, `cantRespuestas`, `cantRespuestasCorrectas`, `idRol`) VALUES
(27, 'Candela Fernandez', '2023-10-01', 'Femenino', 'Argentina', 'Morón', 'cande.fdz12@gmail.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'candelaxx', '', '668899', 13, 0, 0, 1),
(31, 'Maria Vazquez', '2023-10-04', 'Femenino', 'Argentina', 'Morón', 'test@test11.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'candelaxx', '', '275318', 0, 0, 0, 1),
(32, 'Florencia Micaela', '2004-06-16', 'Femenino', 'Argentina', 'Morón', 'test@test2.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'florenciax', './public/img/Horarios .jpg', '296924', 0, 0, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_partida_idUsuario` (`idUsuario`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_preguntas_categoria` (`id_categoria`);

--
-- Indices de la tabla `preguntasreportadas`
--
ALTER TABLE `preguntasreportadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indices de la tabla `preguntassugeridas`
--
ALTER TABLE `preguntassugeridas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntasusadas`
--
ALTER TABLE `preguntasusadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPregunta` (`idPregunta`),
  ADD KEY `idPartida` (`idPartida`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `preguntasreportadas`
--
ALTER TABLE `preguntasreportadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntassugeridas`
--
ALTER TABLE `preguntassugeridas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntasusadas`
--
ALTER TABLE `preguntasusadas`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `fk_partida_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `fk_preguntas_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `preguntasreportadas`
--
ALTER TABLE `preguntasreportadas`
  ADD CONSTRAINT `preguntasreportadas_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`id`);

--
-- Filtros para la tabla `preguntasusadas`
--
ALTER TABLE `preguntasusadas`
  ADD CONSTRAINT `preguntasusadas_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`id`),
  ADD CONSTRAINT `preguntasusadas_ibfk_2` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
