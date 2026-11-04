-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2026 at 02:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shita`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuracion_sitio`
--

CREATE TABLE `configuracion_sitio` (
  `id_configuracion` int(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configuracion_sitio`
--

INSERT INTO `configuracion_sitio` (`id_configuracion`, `clave`, `valor`, `fecha_actualizacion`) VALUES
(1, 'frase_del_dia', 'Cree mas en ti.', '2026-10-21 20:24:35'),
(2, 'autor_frase', 'SHITA', '2026-10-13 01:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `conversaciones`
--

CREATE TABLE `conversaciones` (
  `id_conversacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `resumen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversaciones`
--

INSERT INTO `conversaciones` (`id_conversacion`, `id_usuario`, `fecha`, `resumen`) VALUES
(1, 5, '2026-08-31 20:51:35', 'El usuario, llamado Estefa, está realizando una prueba en su página web y siente curiosidad por el soporte que puede brindar SHITA. Estefa se siente feliz y le gusta el color morado y programar. Está aprendiendo sobre proyectos de inteligencia artificial, específicamente en chats emocionales, y muestra interés en bases de datos, inteligencia artificial y ciberseguridad. No mencionó un recurso específico para su aprendizaje, pero está explorando estas áreas.'),
(3, 6, '2026-08-31 21:05:24', NULL),
(5, 5, '2026-10-07 04:59:43', NULL),
(10, 5, '2026-10-13 18:52:20', NULL),
(11, 8, '2026-10-19 19:27:57', NULL),
(12, 9, '2026-10-19 19:34:02', NULL),
(15, 9, '2026-10-19 19:41:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emociones`
--

CREATE TABLE `emociones` (
  `id_emocion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emociones`
--

INSERT INTO `emociones` (`id_emocion`, `nombre`, `color`) VALUES
(1, 'Feliz', '#54CFC5'),
(2, 'Tranquilo', '#8B8CF6'),
(3, 'Ansioso', '#F5B544'),
(4, 'Estresado', '#F47C91'),
(5, 'Cansado', '#9A8CE8');

-- --------------------------------------------------------

--
-- Table structure for table `memorias_usuario`
--

CREATE TABLE `memorias_usuario` (
  `id_memoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `memoria` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_conversacion` int(11) NOT NULL,
  `id_emocion` int(11) DEFAULT NULL,
  `emisor` enum('Usuario','Bot') NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_conversacion`, `id_emocion`, `emisor`, `mensaje`, `fecha`) VALUES
(1, 3, NULL, 'Usuario', 'hola shita', '2026-08-31 21:11:44'),
(2, 3, NULL, 'Usuario', 'ola', '2026-08-31 21:12:15'),
(3, 3, NULL, 'Usuario', 'yes', '2026-08-31 21:29:56'),
(4, 3, NULL, 'Usuario', 'hola', '2026-09-02 22:18:07'),
(5, 3, NULL, 'Bot', '¡Hola! ¿Cómo estás?', '2026-09-02 22:18:09'),
(6, 3, NULL, 'Usuario', 'estoy bien y tu', '2026-09-02 22:18:35'),
(7, 3, NULL, 'Bot', '¡Me alegra que estés bien! Yo también estoy aquí y listo para charlar. ¿Qué tal va tu día?', '2026-09-02 22:18:36'),
(8, 3, NULL, 'Usuario', 'todo bien, estoy relajado en cama', '2026-09-02 22:20:50'),
(9, 3, NULL, 'Bot', '¡Qué gusto! Relajarse en la cama es de lo mejor. ¿Estás viendo algo interesante, escuchando música o simplemente disfrutando del momento?', '2026-09-02 22:20:52'),
(10, 1, NULL, 'Usuario', 'hola', '2026-09-02 22:25:54'),
(11, 1, NULL, 'Bot', '¡Hola! ¿Cómo estás?', '2026-09-02 22:25:57'),
(12, 1, NULL, 'Usuario', 'bien y tu?', '2026-09-02 22:34:46'),
(13, 1, NULL, 'Bot', '¡Hola! Estoy aquí disponible para lo que necesites. ¿En qué te gustaría conversar hoy?', '2026-09-02 22:34:48'),
(14, 1, NULL, 'Usuario', 'uwu', '2026-09-02 22:34:57'),
(15, 1, NULL, 'Bot', '¡Hola! ¿Cómo estás? ¿En qué puedo ayudarte hoy? 🥰', '2026-09-02 22:35:00'),
(16, 1, NULL, 'Usuario', 'onichan', '2026-09-02 22:35:08'),
(17, 1, NULL, 'Bot', '¡Hola! ¿Cómo estás? 😊', '2026-09-02 22:35:11'),
(18, 1, NULL, 'Usuario', 'bien y tu\'', '2026-09-02 22:35:17'),
(19, 1, NULL, 'Bot', '¡Estoy bien, gracias por preguntar! ¿En qué te gustaría que te acompañe hoy?', '2026-09-02 22:35:19'),
(20, 1, NULL, 'Usuario', 'que es onichan', '2026-09-02 22:35:27'),
(21, 1, NULL, 'Bot', '\"Onichan\" es una forma cariñosa en japonés para referirse a un hermano mayor. \"Oni\" significa hermano y \"chan\" es un sufijo afectuoso. Se usa comúnmente en anime y manga. ¿Te interesa más sobre cultura japonesa?', '2026-09-02 22:35:30'),
(22, 1, NULL, 'Usuario', 'ola', '2026-09-14 18:58:53'),
(23, 1, NULL, 'Bot', '¡Hola! ¿Cómo estás? ¿En qué puedo ayudarte hoy?', '2026-09-14 18:58:59'),
(24, 1, NULL, 'Usuario', 'todo bien y vos?', '2026-09-14 18:59:11'),
(25, 1, NULL, 'Bot', 'Todo bien, gracias por preguntar. ¿En qué andás hoy?', '2026-09-14 18:59:14'),
(26, 1, NULL, 'Usuario', 'hola SHITA, mi nombre es estefa', '2026-09-21 19:40:15'),
(27, 1, NULL, 'Bot', '¡Hola, Estefa! Un gusto conocerte. ¿Cómo te va hoy? 😊', '2026-09-21 19:40:20'),
(28, 1, NULL, 'Usuario', 'bien bien, sabes como es mi nombre?', '2026-09-21 19:40:32'),
(29, 1, NULL, 'Bot', 'Sí, me dijiste que te llamas Estefa. 😊 ¿Te gustaría hablar de algo en particular?', '2026-09-21 19:40:36'),
(30, 1, NULL, 'Usuario', 'no realmente, esto es una prueba sobre mi pagina, te sientes como un buen apoyo?', '2026-09-21 19:47:38'),
(31, 1, NULL, 'Bot', '¡Claro que sí, aquí estoy para lo que necesites! Si tienes más preguntas sobre cómo puedo ayudarte, no dudes en decírmelo. 😊', '2026-09-21 19:47:40'),
(32, 1, NULL, 'Usuario', 'me siento feliz', '2026-09-21 19:48:01'),
(33, 1, NULL, 'Bot', '¡Qué bueno escuchar eso! 😊 ¿Algo en especial te hace sentir así?', '2026-09-21 19:48:03'),
(34, 1, NULL, 'Usuario', 'Mi color favorito es el morado y me gusta mucho programar.', '2026-09-21 20:07:03'),
(35, 1, NULL, 'Bot', 'El morado es un color genial, tiene mucha personalidad. Y programar es una habilidad súper valiosa. ¿En qué tipo de proyectos estás trabajando?', '2026-09-21 20:07:06'),
(36, 1, NULL, 'Usuario', 'proyecto de IA, como chat emocionales, codigos,  eso, apenas estoy aprendiendo realmente', '2026-09-21 20:07:24'),
(37, 1, NULL, 'Bot', '¡Qué emocionante! Los chats emocionales son fascinantes. Aprender sobre IA puede ser un desafío, pero muy gratificante. ¿Hay algo específico con lo que te gustaría ayuda o algún tema que te interese explorar más en IA?', '2026-09-21 20:07:28'),
(38, 1, NULL, 'Usuario', 'no realmente, me interesan las bases de datos, la inteligencia artificial o la ciberseguridad', '2026-09-21 20:08:15'),
(39, 1, NULL, 'Bot', '¡Excelentes áreas de interés! Cada una tiene su propio conjunto de desafíos y oportunidades. Las bases de datos son esenciales para manejar datos, la IA para innovaciones, y la ciberseguridad es crucial para proteger todo. ¿Has pensado en algún curso o recurso que te gustaría usar para aprender más?', '2026-09-21 20:08:20'),
(40, 1, NULL, 'Usuario', 'si, me gustaria llegar a la universidad EAFIT, proximamente, este 25 de septiembre (en 4 dias) se diran los resultados de las pruebas ICFES y podre ver si tengo oportunidad o debere aplicar a otra U', '2026-09-21 20:09:13'),
(41, 1, NULL, 'Bot', 'Qué emocionante, Estefa, estar tan cerca de saber los resultados. EAFIT es una gran opción. Estoy aquí para apoyarte mientras esperas. ¿Cómo te estás sintiendo al respecto?', '2026-09-21 20:09:16'),
(42, 1, NULL, 'Usuario', 'nervioso, muy nervioso realmente', '2026-09-21 20:09:26'),
(43, 1, NULL, 'Bot', 'Es completamente normal sentirse nervioso antes de recibir resultados importantes. ¡Recuerda que, pase lo que pase, siempre hay caminos y oportunidades por explorar! Estoy aquí para lo que necesites. 🍀', '2026-09-21 20:09:28'),
(44, 1, NULL, 'Usuario', 'buenas', '2026-09-23 18:53:25'),
(45, 1, NULL, 'Bot', '¡Hola de nuevo, Estefa! ¿Cómo estás?', '2026-09-23 18:53:31'),
(52, 5, NULL, 'Usuario', 'helloo', '2026-10-07 06:01:35'),
(53, 5, NULL, 'Bot', '¡Hola! ¿Cómo estás? 😊', '2026-10-07 06:01:40'),
(54, 5, NULL, 'Usuario', 'bien y tu', '2026-10-07 15:48:28'),
(55, 5, NULL, 'Bot', 'También estoy bien, gracias. ¿En qué andas o qué te gustaría hacer hoy?', '2026-10-07 15:48:31'),
(56, 5, NULL, 'Usuario', 'ola', '2026-10-11 22:15:23'),
(57, 5, NULL, 'Bot', '¡Hola de nuevo! ¿Cómo va todo? 😊', '2026-10-11 22:15:28'),
(60, 10, NULL, 'Usuario', 'hola', '2026-10-13 18:52:23'),
(61, 10, NULL, 'Bot', '¡Hola! ¿Cómo va tu día?', '2026-10-13 18:52:32'),
(62, 10, NULL, 'Usuario', 'como estas?', '2026-10-13 19:04:34'),
(63, 10, NULL, 'Bot', 'Estoy aquí, listo para charlar contigo. Cuéntame, ¿cómo te encuentras hoy?', '2026-10-13 19:04:36'),
(64, 10, NULL, 'Usuario', 'esto es una presentacion de IA, que podrias exlicarnos?', '2026-10-13 19:04:57'),
(65, 10, NULL, 'Bot', 'Claro, puedo darte una idea general. Una presentación de IA suele enfocarse en cómo la inteligencia artificial está diseñada para simular procesos humanos como el aprendizaje, el razonamiento y la resolución de problemas. Se podría hablar sobre:\n\n1. **Tipos de IA**: Desde la IA estrecha, que realiza tareas específicas, hasta la IA general, que busca emular la inteligencia humana completa.\n\n2. **Algoritmos de aprendizaje**: Como el aprendizaje automático (machine learning) y el aprendizaje profundo (deep learning).\n\n3. **Aplicaciones**: Uso en medicina, automatización, asistentes virtuales, reconocimiento de voz e imagen, entre otros.\n\n4. **Ética y futuro**: Cómo manejar los desafíos éticos y el impacto de la IA en la sociedad.\n\n¿Te gustaría saber más sobre algún aspecto en particular?', '2026-10-13 19:05:01'),
(66, 11, NULL, 'Usuario', 'que pasa si me gusta la novia de mi amigo?', '2026-10-19 19:29:57'),
(67, 11, NULL, 'Usuario', 'que pasa si me gusta la novia de mi mejor amigo?', '2026-10-19 19:30:55'),
(68, 11, NULL, 'Bot', 'Ese tipo de situaciones pueden ser complicadas. Lo más importante es ser honesto contigo mismo y considerar tus sentimientos y los de los demás. Aquí tienes algunas ideas:\n\n1. **Reflexiona sobre tus sentimientos**: Asegúrate de que lo que sientes es verdadero y no solo una atracción pasajera.\n\n2. **Considera la amistad**: Piensa en cómo estos sentimientos podrían afectar tu amistad.\n\n3. **Habla con alguien de confianza**: A veces, compartir con alguien fuera de la situación puede darte claridad.\n\n4. **Respeta la relación**: Procura no hacer nada que pueda dañar la relación de ellos o tu amistad.\n\n¿Qué piensas sobre esto?', '2026-10-19 19:31:01'),
(69, 11, NULL, 'Usuario', 'que pasa si la novia de mi amigo dice que gusta de ambos?', '2026-10-19 19:32:17'),
(70, 11, NULL, 'Bot', 'Eso puede ser muy confuso y complicado. Es importante manejarlo con cuidado:\n\n1. **Piensa en tu amigo**: Considera cómo esto podría afectarle. Su relación y tu amistad están en juego.\n\n2. **Habla con ella**: Si te sientes cómodo, podrías hablar con ella para entender mejor la situación, pero siempre respetando la relación que tiene con tu amigo.\n\n3. **Sé honesto contigo mismo**: Analiza cómo te sientes y qué es lo mejor para todos.\n\n4. **Evalúa la lealtad**: Reflexiona sobre lo que valoras más en esta situación.\n\n¿Qué opinas?', '2026-10-19 19:32:20'),
(71, 12, NULL, 'Usuario', 'hola', '2026-10-19 19:34:09'),
(72, 12, NULL, 'Bot', '¡Hola! ¿Cómo estás?', '2026-10-19 19:34:12'),
(73, 12, NULL, 'Usuario', 'muy bien', '2026-10-19 19:34:22'),
(74, 12, NULL, 'Bot', '¡Qué bueno! ¿Hay algo en particular de lo que te gustaría hablar hoy?', '2026-10-19 19:34:23'),
(75, 12, NULL, 'Usuario', 'si, quisiera hablar hoy, que me recomendarias para una cita que tengo con una persona que me gusta? que le puedo llevar? chocolate? bom bom bun? soy una persona de bajos reccursos', '2026-10-19 19:35:10'),
(76, 12, NULL, 'Bot', '¡Qué emoción lo de tu cita! No tienes que gastar mucho para demostrar interés. Un gesto sencillo, como una flor que encuentres en el camino, puede ser muy especial. Los chocolates también son un buen detalle.\n\nAdemás, la clave está en la atención que le prestes durante la cita. Escuchar y mostrar interés genuino hace una gran diferencia. ¡Espero que la pases genial!', '2026-10-19 19:35:12'),
(77, 12, NULL, 'Usuario', 'que hago si mi novio no me quiere?', '2026-10-19 19:35:52'),
(78, 12, NULL, 'Bot', 'Siento que te sientas así. Si crees que tu novio no te quiere, lo mejor es hablar sinceramente con él sobre cómo te sientes. La comunicación abierta puede aclarar malentendidos y ayudarte a saber qué está pasando. Recuerda que mereces estar con alguien que valore y corresponda tus sentimientos.', '2026-10-19 19:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `recursos`
--

CREATE TABLE `recursos` (
  `id_recurso` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registros_emocionales`
--

CREATE TABLE `registros_emocionales` (
  `id_registro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_emocion` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registros_emocionales`
--

INSERT INTO `registros_emocionales` (`id_registro`, `id_usuario`, `id_emocion`, `fecha_registro`) VALUES
(1, 5, 1, '2026-10-12 01:17:45'),
(2, 5, 2, '2026-10-12 01:17:50'),
(3, 5, 1, '2026-10-12 01:43:22'),
(4, 5, 3, '2026-10-13 18:41:45'),
(5, 5, 1, '2026-10-13 18:52:03'),
(6, 3, 2, '2026-10-13 19:07:17'),
(7, 8, 1, '2026-10-19 19:27:33'),
(8, 8, 3, '2026-10-19 19:28:41'),
(9, 5, 3, '2026-10-23 00:11:18'),
(10, 5, 5, '2026-10-23 00:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT 'default.png',
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `password`, `foto`, `estado`, `fecha_registro`, `id_rol`) VALUES
(3, 'Thomas', 'Ramirez', 'ramirezthomas017@gmail.com', '$2y$10$zSsWKm22BSeIenRNZGDx..dSA5WmmlkzrW90ZU6pKGp7IPSNHtquy', 'default.png', 'Activo', '2026-07-06 16:50:10', 2),
(5, 'Estefania', 'Osorio', 'estefao@gmail.com', '$2y$10$zyoR5uFOIHIEwwmWx9.9uuOzt0phWUvGj5PmWug5wg5yJLEiHbEwS', 'usuarios/usuario_5_1791917126.jpeg', 'Activo', '2026-07-06 17:15:06', 1),
(6, 'Abdallah', 'Ceballos', 'abdalla@gmail.com', '$2y$10$saX57BEw4pjqDnQfC8cE/.KF4yQF9nGPeU6vGsLM6e.CKnEladplq', 'default.png', 'Activo', '2026-08-26 18:34:28', 2),
(8, 'Jaiver', 'Cordoba', 'cordobapalacios58@gmail.com', '$2y$10$r0qjozzsGIrtDSHnkojRGO9rzi8bYNdGfuGYFvs5/GC9dOFm/v9CC', 'default.png', 'Activo', '2026-10-19 19:25:44', 2),
(9, 'Juan Pablo', 'Rivero', 'yeipipi@gmail.com', '$2y$10$nejb8CpRX2DyVRNNvb5X6uV1m6a22y4YJ77JSNU6wI8CL/ceAK8R.', 'usuarios/usuario_9_1792438924.webp', 'Activo', '2026-10-19 19:33:44', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `configuracion_sitio`
--
ALTER TABLE `configuracion_sitio`
  ADD PRIMARY KEY (`id_configuracion`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indexes for table `conversaciones`
--
ALTER TABLE `conversaciones`
  ADD PRIMARY KEY (`id_conversacion`),
  ADD KEY `conversaciones_ibfk_1` (`id_usuario`);

--
-- Indexes for table `emociones`
--
ALTER TABLE `emociones`
  ADD PRIMARY KEY (`id_emocion`);

--
-- Indexes for table `memorias_usuario`
--
ALTER TABLE `memorias_usuario`
  ADD PRIMARY KEY (`id_memoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_emocion` (`id_emocion`),
  ADD KEY `mensajes_ibfk_1` (`id_conversacion`);

--
-- Indexes for table `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id_recurso`);

--
-- Indexes for table `registros_emocionales`
--
ALTER TABLE `registros_emocionales`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `idx_registro_usuario_fecha` (`id_usuario`,`fecha_registro`),
  ADD KEY `fk_registro_emocion` (`id_emocion`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `configuracion_sitio`
--
ALTER TABLE `configuracion_sitio`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `conversaciones`
--
ALTER TABLE `conversaciones`
  MODIFY `id_conversacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `emociones`
--
ALTER TABLE `emociones`
  MODIFY `id_emocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `memorias_usuario`
--
ALTER TABLE `memorias_usuario`
  MODIFY `id_memoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id_recurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registros_emocionales`
--
ALTER TABLE `registros_emocionales`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversaciones`
--
ALTER TABLE `conversaciones`
  ADD CONSTRAINT `conversaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `memorias_usuario`
--
ALTER TABLE `memorias_usuario`
  ADD CONSTRAINT `memorias_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_conversacion`) REFERENCES `conversaciones` (`id_conversacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_emocion`) REFERENCES `emociones` (`id_emocion`);

--
-- Constraints for table `registros_emocionales`
--
ALTER TABLE `registros_emocionales`
  ADD CONSTRAINT `fk_registro_emocion` FOREIGN KEY (`id_emocion`) REFERENCES `emociones` (`id_emocion`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_registro_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
