-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 21-11-2023 a las 18:46:57
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
(2, 'Historia', '\\public\\img\\historia.png'),
(3, 'Deportes', '\\public\\img\\deportes.png'),
(4, 'Espectaculos', '/public/img/espectaculos.png'),
(5, 'Ciencias Naturales', '\\public\\img\\ciencias.png');

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
(42, 27, 0, '2023-10-29'),
(43, 33, 0, '2023-10-29'),
(44, 33, 2, '2023-10-31'),
(45, 33, 0, '2023-10-31'),
(46, 33, 1, '2023-10-31'),
(47, 33, 1, '2023-10-31'),
(48, 33, 3, '2023-10-31'),
(49, 33, 0, '2023-10-31'),
(50, 33, 3, '2023-10-31'),
(51, 33, 0, '2023-10-31'),
(52, 33, 6, '2023-10-31'),
(53, 33, 4, '2023-10-31'),
(54, 33, 1, '2023-10-31'),
(55, 33, 2, '2023-10-31'),
(56, 33, 7, '2023-10-31'),
(57, 33, 8, '2023-10-31'),
(58, 33, 3, '2023-10-31'),
(59, 33, 7, '2023-10-31'),
(60, 33, 1, '2023-10-31'),
(61, 33, 3, '2023-10-31'),
(62, 33, 1, '2023-10-31'),
(63, 33, 0, '2023-10-31'),
(64, 33, 8, '2023-10-31'),
(65, 33, 0, '2023-10-31'),
(66, 33, 5, '2023-10-31'),
(67, 33, 1, '2023-10-31'),
(68, 33, 0, '2023-10-31'),
(69, 33, 0, '2023-10-31'),
(70, 33, 0, '2023-10-31'),
(71, 33, 0, '2023-10-31'),
(72, 33, 0, '2023-10-31'),
(73, 33, 1, '2023-10-31'),
(74, 33, 1, '2023-10-31'),
(75, 33, 2, '2023-10-31'),
(76, 33, 5, '2023-10-31'),
(77, 33, 4, '2023-10-31'),
(78, 33, 2, '2023-10-31'),
(79, 27, 1, '2023-11-07'),
(80, 27, 1, '2023-11-07'),
(81, 27, 2, '2023-11-07'),
(82, 27, 2, '2023-11-07'),
(83, 27, 0, '2023-11-18'),
(84, 27, 1, '2023-11-18'),
(85, 27, 0, '2023-11-18'),
(86, 27, 0, '2023-11-18'),
(87, 27, 0, '2023-11-18'),
(88, 27, 2, '2023-11-18'),
(89, 27, 0, '2023-11-18'),
(90, 34, 4, '2023-11-20'),
(91, 34, 2, '2023-11-20'),
(92, 27, 0, '2023-11-20'),
(93, 27, 1, '2023-11-20'),
(94, 27, 0, '2023-11-20'),
(95, 27, 0, '2023-11-20'),
(96, 27, 0, '2023-11-20'),
(97, 27, 0, '2023-11-20'),
(98, 27, 0, '2023-11-20'),
(99, 27, 3, '2023-11-20'),
(100, 34, 0, '2023-11-20'),
(101, 34, 1, '2023-11-20'),
(102, 34, 0, '2023-11-20'),
(103, 34, 0, '2023-11-20'),
(104, 34, 1, '2023-11-20'),
(105, 34, 0, '2023-11-20'),
(106, 34, 1, '2023-11-20'),
(107, 35, 7, '2023-11-20'),
(108, 27, 0, '2023-11-20'),
(109, 27, 0, '2023-11-20'),
(110, 27, 0, '2023-11-20'),
(111, 27, 0, '2023-11-20'),
(112, 27, 1, '2023-11-20'),
(113, 27, 2, '2023-11-20'),
(114, 27, 0, '2023-11-20'),
(115, 27, 0, '2023-11-20'),
(116, 27, 0, '2023-11-20'),
(117, 27, 2, '2023-11-20'),
(118, 27, 0, '2023-11-20'),
(119, 27, 0, '2023-11-20'),
(120, 27, 0, '2023-11-20'),
(121, 27, 0, '2023-11-20'),
(122, 27, 2, '2023-11-20'),
(123, 27, 0, '2023-11-20'),
(124, 27, 0, '2023-11-20'),
(125, 27, 0, '2023-11-20'),
(126, 27, 0, '2023-11-20'),
(127, 27, 0, '2023-11-20'),
(128, 27, 0, '2023-11-20'),
(129, 27, 1, '2023-11-20'),
(130, 27, 0, '2023-11-20'),
(131, 27, 0, '2023-11-20'),
(132, 27, 2, '2023-11-20'),
(133, 27, 0, '2023-11-21'),
(134, 27, 2, '2023-11-21'),
(135, 27, 0, '2023-11-21'),
(136, 27, 2, '2023-11-21'),
(137, 36, 3, '2023-11-21'),
(138, 36, 0, '2023-11-21'),
(139, 36, 0, '2023-11-21'),
(140, 36, 7, '2023-11-21'),
(141, 37, 3, '2023-11-21'),
(142, 37, 0, '2023-11-21'),
(143, 37, 2, '2023-11-21'),
(144, 37, 3, '2023-11-21'),
(145, 37, 2, '2023-11-21'),
(146, 35, 5, '2023-11-21'),
(147, 35, 1, '2023-11-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `pregunta` text NOT NULL,
  `id` int(10) NOT NULL,
  `id_categoria` int(11) DEFAULT 1,
  `aciertos` int(11) NOT NULL,
  `apariciones` int(11) NOT NULL,
  `dificultad` int(11) NOT NULL,
  `reportada` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`pregunta`, `id`, `id_categoria`, `aciertos`, `apariciones`, `dificultad`, `reportada`) VALUES
('Si en un script PHP encuentra una llamada a un método de clase de la siguiente manera: Usuario::traerUsuario(); Se trata de:', 1, 2, 0, 2, 1, 1),
('Cuando utilizo una Clase en forma estética siempre se ejecuta el método __construct()', 2, 1, 2, 2, 2, 0),
('La S del acrónimo SOLID es por el concepto Single Responsability, que indica:', 3, 1, 1, 1, 3, 0),
('El concepto de acoplamiento refiere a:', 4, 1, 0, 1, 2, 0),
('Como concepto general podemos decir que a menos acoplamiento mejor software', 5, 1, 1, 1, 1, 0),
('En software se entiende por patrón de dise?o a:', 6, 1, 0, 1, 3, 0),
('El patrón MVC se utiliza mucho en aplicaciones web porque:', 7, 1, 2, 2, 2, 0),
('En un modelo MVC el que recibe normalmente la petición del cliente es:', 8, 1, 1, 1, 3, 0),
('El modelo en un esquema MVC es el encargado de almacenar y ejecutar la lógica del negocio', 9, 1, 0, 0, 2, 0),
('Uno de los objetivos del modelo MVC es separar en la aplicación el modelo de negocios de las interfaces de usuario', 10, 1, 0, 0, 1, 0),
('El enrutador en un modelo MVC es el encargado de ejecutar las operaciones de acceso a la base de datos', 11, 1, 1, 1, 2, 1),
('El folding en una aplicación web se refiere a:', 12, 1, 2, 2, 3, 0),
('Si estoy desarrollando usando TDD estoy', 13, 1, 0, 0, 2, 0),
('El patrón MVC esta compuesto por:', 14, 1, 1, 2, 1, 0),
('En un patrón MVC la Vista es la encargada de ', 15, 1, 0, 0, 2, 0),
('La principal diferencia entre los enfoques Responsive y Mobile First es', 16, 1, 0, 1, 3, 0),
('La principal diferencia entre una Aplicación Web y una Aplicación monolótica (por ejemplo una Win32) es:', 17, 1, 1, 2, 1, 0),
('El protocolo a través del cuál se realiza todo el intercambio de datos entre un servidor web y un cliente es:', 18, 1, 1, 4, 2, 0),
('El protocolo HTTP tiene entre sus caracteristicas ser:', 19, 1, 3, 3, 3, 0),
('El protocolo DNS es:', 20, 1, 0, 0, 1, 0),
('El protocolo HTTP implementa comandos, entre ellos:', 21, 1, 5, 5, 2, 0),
('El protyocolo HTTP implementa codigos de error de respuesta, si recibo un codigo de la serie 500, ha ocurrido:', 22, 1, 0, 1, 3, 0),
('El protyocolo HTTP implementa codigos de error de respuesta, si recibo un codigo de la serie 400, ha ocurrido:', 23, 1, 1, 3, 2, 0),
('El protyocolo HTTP implementa codigos de error de respuesta, si recibo un codigo de la serie 200, ha ocurrido:', 24, 1, 1, 2, 1, 0),
('En una petición GET, los parametros de la petición se pasan a través de....', 25, 1, 2, 2, 2, 0),
('Se denomina Scripting del lado del cliente, o programación Front-end o Client Side Scripting a :', 26, 1, 0, 0, 1, 0),
('Se denomina Scripting del lado del servidor, o programación Back-end o Server Side Scripting a :', 27, 1, 1, 2, 3, 0),
('La petición de un recurso determinado a un sitio Web (imagen, archivo, etc.) se canaliza mediante:', 28, 1, 1, 1, 2, 0),
('¿En qué año se firmó el Tratado de Versalles para poner fin a la Primera Guerra Mundial?', 29, 2, 0, 0, 3, 0),
('¿Quién fue el líder de la Revolución Rusa en 1917?', 30, 2, 0, 2, 2, 0),
('¿Cuál de los siguientes imperios existió en la antigua Mesopotamia?', 31, 2, 1, 2, 1, 0),
('¿En qué año se llevó a cabo la Revolución Francesa?', 32, 2, 2, 2, 2, 0),
('¿Cuál de las siguientes ciudades fue la capital del Imperio Inca?', 33, 2, 1, 1, 1, 0),
('¿En qué deporte la pelota tiene mayor diámetro?', 34, 3, 0, 0, 2, 0),
('¿Quién es considerado el mejor futbolista de todos los tiempos?', 35, 3, 1, 1, 3, 0),
('¿Cuál es el deporte acuático que se practica con una tabla?', 36, 3, 1, 2, 2, 0),
('¿En qué año se celebraron los Juegos Olímpicos por primera vez?', 37, 3, 0, 1, 1, 0),
('¿Cuál es el deporte que se juega en un campo extenso?', 38, 3, 0, 2, 2, 0),
('¿Cuál es el planeta más cercano al Sol en nuestro sistema solar?', 39, 5, 2, 2, 3, 0),
('¿Qué gas es esencial para la vida de los seres humanos y otros organismos?', 40, 5, 0, 0, 2, 0),
('¿Cuál es el proceso por el cual las plantas producen su propio alimento?', 41, 5, 0, 0, 1, 0),
('¿Cuál es el hueso más largo del cuerpo humano?', 42, 5, 2, 2, 2, 0),
('¿Qué fenómeno natural mide la escala Richter?', 43, 5, 0, 1, 3, 0),
('¿Quién es el autor de la famosa obra de teatro \"Romeo y Julieta\"?', 44, 4, 0, 0, 2, 0),
('¿En qué película de Quentin Tarantino aparece el personaje \"Jules Winnfield\"?', 45, 4, 1, 2, 1, 0),
('¿Cuál es el título de la primera novela de la saga \"Canción de Hielo y Fuego\" de George R.R. Martin?', 46, 4, 0, 0, 2, 0),
('¿En qué año se estrenó la primera película de Star Wars?', 47, 4, 1, 1, 3, 0),
('¿Quién interpretó el papel principal en la película \"The Revenant\" de 2015?', 48, 4, 1, 1, 2, 0);

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

--
-- Volcado de datos para la tabla `preguntassugeridas`
--

INSERT INTO `preguntassugeridas` (`id`, `descripcion`) VALUES
(2, 'quien gano las elecciones en argentina 2023?'),
(3, 'quien gano el ot 2018?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntasusadas`
--

CREATE TABLE `preguntasusadas` (
  `id` int(25) NOT NULL,
  `idPregunta` int(25) NOT NULL,
  `idPartida` int(25) NOT NULL,
  `tiempo` varchar(255) DEFAULT ''''''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntasusadas`
--

INSERT INTO `preguntasusadas` (`id`, `idPregunta`, `idPartida`, `tiempo`) VALUES
(445, 22, 127, '4.3274989128113'),
(446, 6, 128, '2.6463000774384'),
(447, 19, 129, '1.4148859977722'),
(448, 1, 129, '1.4148859977722'),
(449, 16, 130, '3.0041270256042'),
(450, 30, 131, '3.308867931366'),
(451, 12, 132, '1.2476031780243'),
(452, 47, 132, '1.2476031780243'),
(453, 36, 132, '1.2476031780243'),
(454, 38, 133, '4.0022008419037'),
(455, 25, 134, '3.1110470294952'),
(456, 23, 134, '3.1110470294952'),
(457, 18, 134, '3.1110470294952'),
(458, 4, 135, '3.9233119487762'),
(459, 8, 136, '6.3295519351959'),
(460, 19, 136, '6.3295519351959'),
(461, 24, 136, '6.3295519351959'),
(462, 42, 137, '3.9948980808258'),
(463, 32, 137, '3.9948980808258'),
(464, 5, 137, '3.9948980808258'),
(465, 23, 137, '3.9948980808258'),
(466, 23, 138, '5.6447560787201'),
(467, 17, 139, '3.5147981643677'),
(468, 2, 140, '4.9710800647736'),
(469, 21, 140, '4.9710800647736'),
(470, 31, 140, '4.9710800647736'),
(471, 11, 140, '4.9710800647736'),
(472, 33, 140, '4.9710800647736'),
(473, 32, 140, '4.9710800647736'),
(474, 28, 140, '4.9710800647736'),
(475, 37, 140, '4.9710800647736'),
(476, 24, 141, '4.7112309932709'),
(477, 36, 141, '4.7112309932709'),
(478, 21, 141, '4.7112309932709'),
(479, 30, 141, '4.7112309932709'),
(480, 18, 142, '1.9130389690399'),
(481, 21, 143, '2.3055989742279'),
(482, 2, 143, '2.3055989742279'),
(483, 18, 143, '2.3055989742279'),
(484, 21, 144, '5.3517990112305'),
(485, 48, 144, '5.3517990112305'),
(486, 7, 144, '5.3517990112305'),
(487, 38, 144, '5.3517990112305'),
(488, 3, 145, '3.9918119907379'),
(489, 35, 145, '3.9918119907379'),
(490, 43, 145, '3.9918119907379'),
(491, 17, 146, '3.7967920303345'),
(492, 21, 146, '3.7967920303345'),
(493, 14, 146, '3.7967920303345'),
(494, 42, 146, '3.7967920303345'),
(495, 25, 146, '3.7967920303345'),
(496, 45, 146, '3.7967920303345'),
(497, 19, 147, '4.4318511486053'),
(498, 27, 147, '4.4318511486053');

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
(107, 28, 'Ninguna de las anteriores', 'false'),
(188, 29, '1919', 'true'),
(189, 29, '1945', 'false'),
(190, 29, '1939', 'false'),
(191, 29, '1914', 'false'),
(192, 30, 'Vladimir Lenin', 'true'),
(193, 30, 'José Stalin', 'false'),
(194, 30, 'León Trotsky', 'false'),
(195, 30, 'Nikita Jrushchov', 'false'),
(196, 31, 'Imperio Asirio', 'false'),
(197, 31, 'Imperio Romano', 'false'),
(198, 31, 'Imperio Babilónico', 'true'),
(199, 31, 'Imperio Mongol', 'false'),
(200, 32, '1789', 'true'),
(201, 32, '1812', 'false'),
(202, 32, '1901', 'false'),
(203, 32, '1956', 'false'),
(204, 33, 'Cuzco', 'true'),
(205, 33, 'Lima', 'false'),
(206, 33, 'Quito', 'false'),
(207, 33, 'Bogotá', 'false'),
(208, 34, 'Baloncesto', 'true'),
(209, 34, 'Fútbol', 'false'),
(210, 34, 'Tenis', 'false'),
(211, 34, 'Handball', 'false'),
(212, 35, 'Ronaldinho', 'false'),
(213, 35, 'Diego Maradona', 'true'),
(214, 35, 'Cristiano Ronaldo', 'false'),
(215, 35, 'Batistuta', 'false'),
(216, 36, 'Surf', 'true'),
(217, 36, 'Natación', 'false'),
(218, 36, 'Esquí acuático', 'false'),
(219, 36, 'Waterpolo', 'false'),
(220, 37, '1896', 'true'),
(221, 37, '1900', 'false'),
(222, 37, '1920', 'false'),
(223, 37, '1936', 'false'),
(224, 38, 'Golf', 'true'),
(225, 38, 'Tenis', 'false'),
(226, 38, 'Baloncesto', 'false'),
(227, 38, 'Natación', 'false'),
(228, 39, 'Mercurio', 'true'),
(229, 39, 'Venus', 'false'),
(230, 39, 'Tierra', 'false'),
(231, 39, 'Marte', 'false'),
(232, 40, 'Oxígeno', 'true'),
(233, 40, 'Dióxido de carbono', 'false'),
(234, 40, 'Nitrógeno', 'false'),
(235, 40, 'Hidrógeno', 'false'),
(236, 41, 'Fotosíntesis', 'true'),
(237, 41, 'Respiración', 'false'),
(238, 41, 'Digestión', 'false'),
(239, 41, 'Fermentación', 'false'),
(240, 42, 'Fémur', 'true'),
(241, 42, 'Tibia', 'false'),
(242, 42, 'Húmero', 'false'),
(243, 42, 'Fíbula', 'false'),
(244, 43, 'Terremoto', 'true'),
(245, 43, 'Tornado', 'false'),
(246, 43, 'Tsunami', 'false'),
(247, 43, 'Volcán', 'false'),
(248, 44, 'William Shakespeare', 'true'),
(249, 44, 'Miguel de Cervantes', 'false'),
(250, 44, 'Charles Dickens', 'false'),
(251, 44, 'Fiodor Dostoievski', 'false'),
(252, 45, 'Pulp Fiction', 'true'),
(253, 45, 'Kill Bill', 'false'),
(254, 45, 'Reservoir Dogs', 'false'),
(255, 45, 'Django Unchained', 'false'),
(256, 46, 'Juego de Tronos', 'false'),
(257, 46, 'Choque de Reyes', 'true'),
(258, 46, 'Danza de Dragones', 'false'),
(259, 46, 'Tormenta de Espadas', 'false'),
(260, 47, '1977', 'true'),
(261, 47, '1980', 'false'),
(262, 47, '1975', 'false'),
(263, 47, '1983', 'false'),
(264, 48, 'Leonardo DiCaprio', 'true'),
(265, 48, 'Brad Pitt', 'false'),
(266, 48, 'Tom Hanks', 'false'),
(267, 48, 'Johnny Depp', 'false');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestassugeridas`
--

CREATE TABLE `respuestassugeridas` (
  `id` int(11) NOT NULL,
  `idPreguntaSugerida` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `esCorrecta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestassugeridas`
--

INSERT INTO `respuestassugeridas` (`id`, `idPreguntaSugerida`, `respuesta`, `esCorrecta`) VALUES
(5, 2, 'javier milei', 'true'),
(6, 2, 'sergio massa', 'false'),
(7, 2, 'patricia bullrich', 'false'),
(8, 2, 'miriam bregman', 'false'),
(9, 3, 'famous', 'true'),
(10, 3, 'alba reche', 'false'),
(11, 3, 'julia medina', 'false'),
(12, 3, 'natalia lacunza', 'false');

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
  `idRol` int(11) NOT NULL DEFAULT 1,
  `nivel` varchar(255) NOT NULL DEFAULT 'principiante',
  `fechaRegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `latitud` int(255) DEFAULT NULL,
  `longitud` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `anio`, `sexo`, `pais`, `ciudad`, `mail`, `contrasenia`, `estaActiva`, `nombreUsuario`, `foto`, `codigo`, `puntajeTotal`, `cantRespuestas`, `cantRespuestasCorrectas`, `idRol`, `nivel`, `fechaRegistro`, `latitud`, `longitud`) VALUES
(27, 'Candela Fernandez', '2002-10-23', 'Femenino', 'Argentina', 'Moron', 'cande.fdz12@gmail.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'candelax', './public\\img\\avatar-valen.jpg', '668899', 38, 65, 26, 1, 'avanzado', '2023-10-05 09:32:57', -35, -59),
(31, 'Maria Vazquez', '2023-10-04', 'Femenino', 'Argentina', 'Morón', 'test@test11.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'candelaxx', './public\\img\\MicrosoftTeams-image (1).png', '275318', 0, 0, 0, 2, 'principiante', '2023-10-12 09:32:57', -35, -59),
(32, 'Florencia Micaela', '2004-06-16', 'Femenino', 'Argentina', 'Morón', 'test@test2.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'florenciax', './public/img/Horarios .jpg', '296924', 0, 0, 0, 3, 'principiante', '2023-11-05 09:32:57', -35, -59),
(33, 'Leo', '2000-09-02', 'Masculino', 'Argentina', 'Buenos Aires', 'vilteleonardo92@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'LeoV', './public\\img\\MicrosoftTeams-image.png', '549467', 82, 218, 29, 1, 'principiante', '2023-11-06 09:32:57', -35, -58),
(34, 'Julieta Agustina', '1999-09-07', 'Femenino', 'Uruguay', 'Montevideo', 'test@julieta.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'julietax', './public/img/Captura de pantalla 2023-10-05 103244.png', '910756', 9, 18, 9, 1, 'avanzado', '2023-11-20 14:10:05', -35, -59),
(35, 'Rocio España', '2003-08-15', 'Femenino', 'Chile', 'Morón', 'test@rochi.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'rocioxx', './public/img/avatar.png', '651180', 13, 16, 13, 1, 'experto', '2023-11-20 16:36:11', -35, -58),
(36, 'Ailen Vilches', '2000-09-15', 'Femenino', 'Argentina', 'Ramos mejia', 'test@ailu.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'ailux', './public/img/avatar.png', '154081', 10, 15, 11, 1, 'experto', '2023-11-21 13:42:45', -35, -59),
(37, 'Andrea Sosa', '2001-02-19', 'Femenino', 'Argentina', 'Moreno', 'test@andre.com', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 'andrex', './public/img/ciencias.png', '478227', 10, 15, 10, 1, 'experto', '2023-11-21 13:46:12', -35, -59);

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
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `respuestassugeridas`
--
ALTER TABLE `respuestassugeridas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPreguntaSugerida` (`idPreguntaSugerida`);

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
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de la tabla `preguntasreportadas`
--
ALTER TABLE `preguntasreportadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `preguntassugeridas`
--
ALTER TABLE `preguntassugeridas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntasusadas`
--
ALTER TABLE `preguntasusadas`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT de la tabla `respuestassugeridas`
--
ALTER TABLE `respuestassugeridas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `fk_partida_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

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
-- Filtros para la tabla `respuestassugeridas`
--
ALTER TABLE `respuestassugeridas`
  ADD CONSTRAINT `respuestassugeridas_ibfk_1` FOREIGN KEY (`idPreguntaSugerida`) REFERENCES `preguntassugeridas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
