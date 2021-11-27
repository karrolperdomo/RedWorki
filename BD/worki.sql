-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-11-2021 a las 06:23:46
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `worki`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `cargo` varchar(300) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `cargo`, `id_empresa`) VALUES
(1, 'Ingeniero de Sistemas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `comentario` varchar(1500) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_publicacion`, `id_usuario`, `comentario`, `fecha_hora`) VALUES
(1, 8, 2, 'ASDFADFASDFASDF', '2021-11-05 00:00:00'),
(2, 8, 2, 'este es un comentario correcto', '2021-11-26 21:29:28'),
(3, 6, 2, 'este es el ni&ntilde;o de el bus ', '2021-11-26 21:34:49'),
(4, 6, 2, 'asdfasdfasdf', '2021-11-26 21:35:33'),
(5, 8, 2, 'este es el 3ero', '2021-11-26 21:37:28'),
(6, 8, 2, 'jajajja este es el ultimo', '2021-11-26 21:40:32'),
(7, 8, 2, 'asdfadsfasdf', '2021-11-26 21:41:19'),
(8, 8, 2, 'asdfadsf', '2021-11-26 21:41:45'),
(9, 8, 2, 'asdfadsfasdf', '2021-11-26 21:41:48'),
(10, 9, 5, 'soy muy chimbita', '2021-11-26 21:46:25'),
(11, 12, 10, 'jajajajjaja :)', '2021-11-26 22:40:56'),
(12, 11, 10, 'jejejej :)', '2021-11-26 22:41:56'),
(13, 12, 6, 'https://meet.google.com/wac-xjrd-hku?pli=1&amp;authuser=0', '2021-11-26 22:47:38'),
(14, 12, 6, 'https://meet.google.com/wac-xjrd-hku?pli=1&amp;authuser=0', '2021-11-26 22:47:40'),
(15, 14, 12, 'que bueno estar&eacute; all&aacute;:) ', '2021-11-26 23:38:50'),
(16, 13, 2, 'https://graval-my.sharepoint.com/:u:/r/personal/jmora_ath_com_co/Documents/worki.zip?csf=1&amp;web=1&amp;e=1Q8PeU', '2021-11-27 00:21:53'),
(17, 13, 7, 'jejejej', '2021-11-27 00:21:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(300) NOT NULL,
  `estado_empresa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nombre_empresa`, `estado_empresa`) VALUES
(1, 'Corporacion Universitaria Minuto de Dios', 'activo'),
(2, 'BMO Travel Turing', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hobbies`
--

CREATE TABLE `hobbies` (
  `id_hobbie` int(11) NOT NULL,
  `hobbie` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hobbies`
--

INSERT INTO `hobbies` (`id_hobbie`, `hobbie`) VALUES
(1, 'Deportes'),
(2, 'Artes'),
(3, 'Cine'),
(4, 'Musica'),
(5, 'Libros'),
(6, 'Juegos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `me_gusta`
--

CREATE TABLE `me_gusta` (
  `id_me_gusta` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `me_gusta`
--

INSERT INTO `me_gusta` (`id_me_gusta`, `id_publicacion`, `id_usuario`) VALUES
(19, 15, 12),
(25, 11, 7),
(26, 12, 7),
(27, 9, 7),
(30, 8, 7),
(33, 10, 7),
(34, 7, 7),
(50, 12, 5),
(59, 13, 7),
(61, 8, 5),
(62, 6, 7),
(63, 5, 7),
(65, 1, 7),
(66, 13, 5),
(67, 9, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_publicacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(300) NOT NULL,
  `descripcion` varchar(1500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_publicacion`, `id_usuario`, `imagen`, `fecha_hora`, `titulo`, `descripcion`) VALUES
(1, 2, 'primera_publicacion.jpeg', '2021-11-25 22:57:26', 'Mi primer publicacion', 'esta es la descripcion de mi primer publicacion soy el mejor jajajaja'),
(2, 4, 'segunda_imagen.jpeg', '2021-11-26 00:06:07', 'Primera publicacion del usuario pruebas', 'es la imagen de un ojo con una figura interna, es publicada por el usuaio pruebas'),
(3, 2, '4338afa111a1ec215b7288c6cb21c6b7762de3d1.jpeg', '2021-11-26 19:13:46', 'titualo', 'description'),
(4, 2, '2520e4b3244fcd0bbef9d046114f1dd5466bea3c.jpeg', '2021-11-26 19:14:00', 'titualo', 'description'),
(5, 2, 'b9d1687917023bcf96bae3844b08de01ea945ea2.jpeg', '2021-11-26 19:15:03', 'mi publicacio por el formulario', 'esta publicaicon se hace desde el formulario para probar, es la luna vista por microscopio'),
(6, 2, 'dc670f5f91e0909bc0f36c81b7aff7db32ca1e10.jpeg', '2021-11-26 19:17:31', 'Meme del dia ', 'Es un memaso '),
(7, 1, '69cce441a6ec9189f0968e28dbe30f1736b571b2.jpeg', '2021-11-26 19:19:50', 'meme usuario de bibiaan', 'probando el meme del dia con perfil de bibiana '),
(8, 2, 'bbc0da7ede24dbded60b5d9695650519932cf689.jpeg', '2021-11-26 19:48:53', 'publicacoin 5', 'esta es mi 5 publicacion en 1 dia '),
(9, 5, 'd1eed1eaf6d268eca89505f2f394a4999136c275.jpeg', '2021-11-26 21:46:14', 'publicacion de sebas, foto de perfil', 'publico mi foto de perfil....'),
(10, 7, '21922710a8f454625f134bd7ff5896b68afd66a4.jpeg', '2021-11-26 22:12:08', 'memes del d&iacute;a ', ''),
(11, 7, '0a9b546e8ff351872da7b56f675f9c09638bcefc.jpeg', '2021-11-26 22:12:30', 'memes del d&iacute;a ', ''),
(12, 6, '2745f9d25f593c74cc1fe8d79f16358f30fe794d.jpeg', '2021-11-26 22:16:26', 'jajajajja', ''),
(13, 10, '4001c3b84b8cb410d6b90100112cdcfe3be346e8.jpeg', '2021-11-26 22:39:26', 'jajajja', 'si soy '),
(14, 11, '72b22a5e6ee04330f3a9b9fcee1a676c2789bf11.jpeg', '2021-11-26 23:27:59', 'Fiesta fin de A&ntilde;o', 'Hola buenas tardes, los estamos invitando a nuestra fiesta de fin de A&ntilde;o.&iexcl; los esperamos!. '),
(15, 12, '6f5376ceff31b31f8f561a8bcd68f25a98bf8d1e.jpeg', '2021-11-26 23:38:02', 'paquete Turistico', 'Nuevo paquete tur&iacute;stico a san Andr&eacute;s con una oferta especial para los empleados de bmo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_hobbies`
--

CREATE TABLE `tipos_hobbies` (
  `id_tipo_hobbie` int(11) NOT NULL,
  `tipo_hobbie` varchar(300) NOT NULL,
  `imagen_hobbie` varchar(300) NOT NULL,
  `id_hobbie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_hobbies`
--

INSERT INTO `tipos_hobbies` (`id_tipo_hobbie`, `tipo_hobbie`, `imagen_hobbie`, `id_hobbie`) VALUES
(1, 'Futbol', '', 1),
(2, 'Baloncesto', '', 1),
(3, 'Voleibol', '', 1),
(4, 'Natación', '', 1),
(5, 'Tenis', '', 1),
(6, 'Béisbol', '', 1),
(7, 'Pintura', '', 2),
(8, 'Escultura', '', 2),
(9, 'Acción', '', 3),
(10, 'Aventuras', '', 3),
(11, 'Ciencia Ficción', '', 3),
(12, 'Comedia', '', 3),
(13, 'Documentales', '', 3),
(14, 'Drama', '', 3),
(15, 'Rancheras', '', 4),
(16, '50 sombras de gray', '', 5),
(17, 'Mario Kard', '', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(300) NOT NULL,
  `apellido_usuario` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `palabra_clave` varchar(300) NOT NULL,
  `estado_usuario` varchar(100) NOT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  `gustos_profesionales` varchar(1000) DEFAULT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL,
  `mi_estado` varchar(1000) DEFAULT NULL,
  `numero_telefonico` varchar(100) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `cargo` varchar(300) NOT NULL,
  `estado_conexion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `apellido_usuario`, `email`, `password`, `palabra_clave`, `estado_usuario`, `id_cargo`, `gustos_profesionales`, `imagen`, `id_empresa`, `mi_estado`, `numero_telefonico`, `direccion`, `cargo`, `estado_conexion`) VALUES
(1, 'Angie Bibiana', 'Forero Guzman', 'bibiana@uniminuto.edu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'pepito', 'activo', 1, 'Me gusta Programar, hacer sitios web y instalar servidores', '1.jpeg', 1, 'Soy una persona sencilla, que me gusta estudiar, trabajar y vivir la vida al maximo,  me gusta la parranda el trago, la parranda y los caballos', '3103214567', 'av 11 N&ordm; 20-20 ', 'Ingeniera de sistemas', 'Disponible'),
(2, 'Julio', 'Mora', 'jmora@uniminuto.edu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'perro', 'activo', NULL, NULL, '2.jpeg', 1, NULL, '3201234567', 'av siempre viva ', 'Ingeniero de sistemas', 'Ausente'),
(3, 'Edwin', 'Mora', 'edwin@uniminuto.edu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'perrito', 'activo', NULL, NULL, NULL, 1, NULL, '123456789', 'calle falsa 123', 'Ingeniero', 'Disponible'),
(4, 'prueba nombre', 'prueba apellido', 'prueba@uniminuto.edu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'prueba', 'activo', NULL, NULL, NULL, 1, NULL, '1234567', 'prueba direccion ', 'prueba cargo', 'Disponible'),
(5, 'Sebastian', 'Apellidos', 'sebas@uniminuto.edu', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'motos', 'activo', NULL, NULL, '5.jpeg', 1, 'Soy una persona que el gusta el desorden, mi pasion son las motos y las viejas', '312222222', 'calle falsa av siempre viva', 'Mensajero', 'Disponible'),
(6, 'karol', 'perdomo', 'karol.perdomo@uniminuto.edu.co', '8cb2237d0679ca88db6464eac60da96345513964', 'zeus', 'activo', NULL, NULL, '6.jpeg', 1, 'desarrollo  diferentes campos de acci&oacute;n, tendientes a la soluci&oacute;n de necesidades previamente especificadas.', '312455676332', 'ciudadela colsubsidio', 'ingeniera de sistema ', 'Ausente'),
(7, 'Alejandro ', 'chacon', 'alejandro@uniminuto.edu.co', '8cb2237d0679ca88db6464eac60da96345513964', 'pez', 'activo', NULL, NULL, '7.jpeg', 1, NULL, '31242222444', 'Modelia', 'ingeniero de sistema ', 'No Molestar'),
(8, 'Alejandro ', 'chacon', 'alejandro.1@uniminuto.edu.co', '8cb2237d0679ca88db6464eac60da96345513964', 'pez', 'activo', NULL, NULL, NULL, 1, NULL, '31242222444', 'Modelia', 'ingeniero de sistema ', 'Disponible'),
(9, 'Edward', 'Bastos', 'edward.2@uniminuto.edu.co', '8cb2237d0679ca88db6464eac60da96345513964', 'programacion', 'activo', NULL, NULL, NULL, 1, NULL, '31244566788', 'Suba', 'ingeniero de sistema ', 'Disponible'),
(10, 'Edward', 'Bastos', 'edward.bastos@uniminuto.edu.co', '8cb2237d0679ca88db6464eac60da96345513964', 'programacion', 'activo', NULL, NULL, '10.jpeg', 1, NULL, '31244566788', 'Suba', 'ingeniero de sistema ', 'Disponible'),
(11, 'sandra', 'perez', 'sandraperez@bmo.co', '8cb2237d0679ca88db6464eac60da96345513964', 'loro', 'activo', NULL, NULL, '11.jpeg', 2, NULL, '3125556376', 'Normand&iacute;a', 'Administracion', 'Disponible'),
(12, 'Andr&eacute;s ', 'sanchez', 'andres3@bmo.co', '8cb2237d0679ca88db6464eac60da96345513964', 'gato', 'activo', NULL, NULL, '12.jpeg', 2, NULL, '31242255555', 'engativa', 'gu&iacute;a tur&iacute;stico', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_tipos_hobbies`
--

CREATE TABLE `usuarios_tipos_hobbies` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_hobbie` int(11) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios_tipos_hobbies`
--

INSERT INTO `usuarios_tipos_hobbies` (`id_usuario`, `id_tipo_hobbie`, `descripcion`) VALUES
(1, 1, 'Me gusta ver el futbol de la champios y de la seleccion colombia, soy fan n 1 de Falcao y de muriel. tambien soy hinda del santa fe.  arriba el buen futbol'),
(1, 4, 'Me gusta ir a tierra caliente a nadar en la piscina o en el rio, tambien me gusta la practica libre'),
(1, 7, 'Me gustan pintar las bolas de navidad para decorar mi casa '),
(1, 12, 'me encantan las peliculas de Adam Sandler, y las de Yim Carray'),
(5, 1, 'millos simpre'),
(6, 11, 'Me gustan las pel&iacute;culas Harry Potter es una serie de novelas fant&aacute;sticas escrita por la autora brit&aacute;nica J. K. Rowling, en la que se describen las aventuras del joven aprendiz'),
(6, 15, 'las rancheras son mi pasi&oacute;n'),
(11, 15, 'la m&uacute;sica popular  me gusta mucho.'),
(12, 6, 'Me gusta  mucho  este deporte me mantiene activo.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`),
  ADD KEY `fk_cargos_empresa` (`id_empresa`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `fk_comentarios_publicaciones` (`id_publicacion`),
  ADD KEY `fk_comentarios_usuarios` (`id_usuario`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  ADD PRIMARY KEY (`id_hobbie`);

--
-- Indices de la tabla `me_gusta`
--
ALTER TABLE `me_gusta`
  ADD PRIMARY KEY (`id_me_gusta`),
  ADD KEY `fk_me_gusta_publicacion` (`id_publicacion`),
  ADD KEY `fk_me_gusta_usuario` (`id_usuario`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id_publicacion`),
  ADD KEY `fk_publicaciones_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipos_hobbies`
--
ALTER TABLE `tipos_hobbies`
  ADD PRIMARY KEY (`id_tipo_hobbie`),
  ADD KEY `fk_tipo_hobbie_hobbies` (`id_hobbie`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuarios_empresa` (`id_empresa`),
  ADD KEY `fk_usuarios_cargos` (`id_cargo`);

--
-- Indices de la tabla `usuarios_tipos_hobbies`
--
ALTER TABLE `usuarios_tipos_hobbies`
  ADD PRIMARY KEY (`id_usuario`,`id_tipo_hobbie`),
  ADD KEY `fk_usuariosHobbies2` (`id_tipo_hobbie`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hobbies`
--
ALTER TABLE `hobbies`
  MODIFY `id_hobbie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `me_gusta`
--
ALTER TABLE `me_gusta`
  MODIFY `id_me_gusta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tipos_hobbies`
--
ALTER TABLE `tipos_hobbies`
  MODIFY `id_tipo_hobbie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `fk_cargos_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_publicaciones` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `fk_comentarios_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `me_gusta`
--
ALTER TABLE `me_gusta`
  ADD CONSTRAINT `fk_me_gusta_publicacion` FOREIGN KEY (`id_publicacion`) REFERENCES `publicaciones` (`id_publicacion`),
  ADD CONSTRAINT `fk_me_gusta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `fk_publicaciones_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tipos_hobbies`
--
ALTER TABLE `tipos_hobbies`
  ADD CONSTRAINT `fk_tipo_hobbie_hobbies` FOREIGN KEY (`id_hobbie`) REFERENCES `hobbies` (`id_hobbie`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_cargos` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`),
  ADD CONSTRAINT `fk_usuarios_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`);

--
-- Filtros para la tabla `usuarios_tipos_hobbies`
--
ALTER TABLE `usuarios_tipos_hobbies`
  ADD CONSTRAINT `fk_usuariosHobbies1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fk_usuariosHobbies2` FOREIGN KEY (`id_tipo_hobbie`) REFERENCES `tipos_hobbies` (`id_tipo_hobbie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
