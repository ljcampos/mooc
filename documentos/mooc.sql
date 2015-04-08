-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2015 a las 23:20:39
-- Versión del servidor: 5.5.41-0ubuntu0.14.10.1
-- Versión de PHP: 5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mooc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Country`
--

CREATE TABLE IF NOT EXISTS `Country` (
`country_id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `Country`
--

INSERT INTO `Country` (`country_id`, `country`) VALUES
(1, 'Afganistán'),
(2, 'Albania'),
(3, 'Alemania'),
(4, 'Argentina'),
(5, 'Australia'),
(6, 'Bélgica'),
(7, 'Bolivia'),
(8, 'Chile'),
(9, 'China'),
(10, 'China'),
(11, 'México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
`course_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `adquired_knowledges` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `banner` int(11) DEFAULT NULL,
  `video` int(11) DEFAULT NULL,
  `difficulty_id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CourseCategory`
--

CREATE TABLE IF NOT EXISTS `CourseCategory` (
`courseCategory_id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CourseDifficulty`
--

CREATE TABLE IF NOT EXISTS `CourseDifficulty` (
`courseDifficulty_id` int(11) NOT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CourseTeacher`
--

CREATE TABLE IF NOT EXISTS `CourseTeacher` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CourseUser`
--

CREATE TABLE IF NOT EXISTS `CourseUser` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `File`
--

CREATE TABLE IF NOT EXISTS `File` (
`file_id` int(11) NOT NULL,
  `current_name` varchar(100) DEFAULT NULL,
  `name_saved` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `fileType_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FileType`
--

CREATE TABLE IF NOT EXISTS `FileType` (
`fileType_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Lesson`
--

CREATE TABLE IF NOT EXISTS `Lesson` (
`lesson_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LessonFile`
--

CREATE TABLE IF NOT EXISTS `LessonFile` (
  `lessonFile_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profil`
--

CREATE TABLE IF NOT EXISTS `Profil` (
  `profil_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `avatar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Profil`
--

INSERT INTO `Profil` (`profil_id`, `username`, `email`, `birthday`, `gender`, `description`, `country_id`, `address`, `firstname`, `lastname`, `avatar`) VALUES
(6, 'alsvader', 'alsvader@hotmail.com', '1993-04-09', 1, 'Mi súper descripción', 11, 'Calle #10 Col.Reforma', 'Aarón', 'López', NULL),
(7, 'als_link', 'aaronlopesosa@hotmail.com', '2015-03-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Role`
--

CREATE TABLE IF NOT EXISTS `Role` (
`role_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `auth_level` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Role`
--

INSERT INTO `Role` (`role_id`, `label`, `auth_level`) VALUES
(1, 'Super administrador de la aplicación web', 10000),
(2, 'Administrador general de la aplicación', 1000),
(3, 'Role de tipo usuario creador de cursos', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Unit`
--

CREATE TABLE IF NOT EXISTS `Unit` (
`unit_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `User`
--

INSERT INTO `User` (`user_id`, `role_id`, `password`, `salt`, `token`) VALUES
(1, 1, 'admin', '', ''),
(6, 3, '193033d62ddbebee79f7a5ab81b3f4b7dddcfb7428f7e5a963f974fdd85bf992', 'df7f8e43c48ed90ae8101031610c66831181e198a86ee6f4f2df86196e822226', '8f4cbc12f0617e52b0e69474795e8a5f980d135a595e777d845b7bea8da69071'),
(7, 3, 'bf84a45028f0980d0b901567316fe36d75c55ce45cf0013996814659eb75f4d8', '46a9b2687eed4dc82ec28e43872f8a7d6a2af3bce5dc1565b08fc4e72dc5145e', '78fdf012683b2d23d2cda9cf8ef3559e635e67504a8142640ba56d2654681940');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Country`
--
ALTER TABLE `Country`
 ADD PRIMARY KEY (`country_id`);

--
-- Indices de la tabla `Course`
--
ALTER TABLE `Course`
 ADD PRIMARY KEY (`course_id`), ADD KEY `fk_course_category` (`category_id`), ADD KEY `fk_course_difficulty` (`difficulty_id`), ADD KEY `fk_course_banner_file` (`banner`);

--
-- Indices de la tabla `CourseCategory`
--
ALTER TABLE `CourseCategory`
 ADD PRIMARY KEY (`courseCategory_id`);

--
-- Indices de la tabla `CourseDifficulty`
--
ALTER TABLE `CourseDifficulty`
 ADD PRIMARY KEY (`courseDifficulty_id`);

--
-- Indices de la tabla `CourseTeacher`
--
ALTER TABLE `CourseTeacher`
 ADD KEY `fk_courseTeacher_user` (`user_id`), ADD KEY `fk_courseTeacher_course` (`course_id`);

--
-- Indices de la tabla `CourseUser`
--
ALTER TABLE `CourseUser`
 ADD KEY `fk_courseUser_course` (`course_id`), ADD KEY `fk_courseUser_user` (`user_id`);

--
-- Indices de la tabla `File`
--
ALTER TABLE `File`
 ADD PRIMARY KEY (`file_id`), ADD KEY `fk_file_fileType` (`fileType_id`);

--
-- Indices de la tabla `FileType`
--
ALTER TABLE `FileType`
 ADD PRIMARY KEY (`fileType_id`);

--
-- Indices de la tabla `Lesson`
--
ALTER TABLE `Lesson`
 ADD PRIMARY KEY (`lesson_id`), ADD KEY `fk_lesson_unit` (`unit_id`);

--
-- Indices de la tabla `LessonFile`
--
ALTER TABLE `LessonFile`
 ADD PRIMARY KEY (`lessonFile_id`), ADD KEY `fk_lessonFile_lesson` (`lesson_id`);

--
-- Indices de la tabla `Profil`
--
ALTER TABLE `Profil`
 ADD PRIMARY KEY (`profil_id`), ADD KEY `fk_profil_country` (`country_id`);

--
-- Indices de la tabla `Role`
--
ALTER TABLE `Role`
 ADD PRIMARY KEY (`role_id`);

--
-- Indices de la tabla `Unit`
--
ALTER TABLE `Unit`
 ADD PRIMARY KEY (`unit_id`), ADD KEY `fk_unit_course` (`course_id`);

--
-- Indices de la tabla `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_user_role` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Country`
--
ALTER TABLE `Country`
MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `Course`
--
ALTER TABLE `Course`
MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CourseCategory`
--
ALTER TABLE `CourseCategory`
MODIFY `courseCategory_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CourseDifficulty`
--
ALTER TABLE `CourseDifficulty`
MODIFY `courseDifficulty_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `File`
--
ALTER TABLE `File`
MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `FileType`
--
ALTER TABLE `FileType`
MODIFY `fileType_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Lesson`
--
ALTER TABLE `Lesson`
MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Role`
--
ALTER TABLE `Role`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Unit`
--
ALTER TABLE `Unit`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `User`
--
ALTER TABLE `User`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Course`
--
ALTER TABLE `Course`
ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `CourseCategory` (`courseCategory_id`),
ADD CONSTRAINT `Course_ibfk_2` FOREIGN KEY (`difficulty_id`) REFERENCES `CourseDifficulty` (`courseDifficulty_id`),
ADD CONSTRAINT `Course_ibfk_3` FOREIGN KEY (`banner`) REFERENCES `File` (`file_id`);

--
-- Filtros para la tabla `CourseTeacher`
--
ALTER TABLE `CourseTeacher`
ADD CONSTRAINT `CourseTeacher_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`),
ADD CONSTRAINT `CourseTeacher_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`);

--
-- Filtros para la tabla `CourseUser`
--
ALTER TABLE `CourseUser`
ADD CONSTRAINT `CourseUser_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`),
ADD CONSTRAINT `CourseUser_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`);

--
-- Filtros para la tabla `File`
--
ALTER TABLE `File`
ADD CONSTRAINT `File_ibfk_1` FOREIGN KEY (`fileType_id`) REFERENCES `FileType` (`fileType_id`);

--
-- Filtros para la tabla `Lesson`
--
ALTER TABLE `Lesson`
ADD CONSTRAINT `Lesson_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `Unit` (`unit_id`);

--
-- Filtros para la tabla `LessonFile`
--
ALTER TABLE `LessonFile`
ADD CONSTRAINT `LessonFile_ibfk_1` FOREIGN KEY (`lessonFile_id`) REFERENCES `File` (`file_id`),
ADD CONSTRAINT `LessonFile_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `Lesson` (`lesson_id`);

--
-- Filtros para la tabla `Profil`
--
ALTER TABLE `Profil`
ADD CONSTRAINT `Profil_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `Country` (`country_id`),
ADD CONSTRAINT `Profil_ibfk_2` FOREIGN KEY (`profil_id`) REFERENCES `User` (`user_id`);

--
-- Filtros para la tabla `Unit`
--
ALTER TABLE `Unit`
ADD CONSTRAINT `Unit_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`);

--
-- Filtros para la tabla `User`
--
ALTER TABLE `User`
ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `Role` (`role_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
