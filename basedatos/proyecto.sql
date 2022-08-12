-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2022 a las 18:04:48
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_citas`
--

CREATE TABLE `tbl_citas` (
  `id` int(11) NOT NULL,
  `asunto` text NOT NULL,
  `nota` text NOT NULL,
  `paciente` text NOT NULL,
  `medico` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `enfermedad` text NOT NULL,
  `sintomas` text NOT NULL,
  `medicamentos` text NOT NULL,
  `estado_listas` int(4) NOT NULL,
  `estado_pago` int(4) NOT NULL,
  `costos` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_citas`
--

INSERT INTO `tbl_citas` (`id`, `asunto`, `nota`, `paciente`, `medico`, `fecha`, `hora`, `enfermedad`, `sintomas`, `medicamentos`, `estado_listas`, `estado_pago`, `costos`) VALUES
(2, 'Dolor de espalda', 'Presenta dolores de espalda', 'Arturo', '1', '2022-06-25', '16:33:00', 'Hernia de disco', 'Dolor de espalda', 'Pendiente', 1, 1, '151354231'),
(3, 'Dolor de espalda', 'Presenta dolores de espalda', 'Carlos', '1', '2022-04-16', '19:06:00', 'Dolor de cabeza', 'Dolores de cabeza', 'Pendiente', 1, 1, '45000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_especialidad`
--

CREATE TABLE `tbl_especialidad` (
  `id` int(11) NOT NULL,
  `especialidad` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_especialidad`
--

INSERT INTO `tbl_especialidad` (`id`, `especialidad`) VALUES
(13, 'quiropractia'),
(14, 'quiropractia'),
(15, 'Terapia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_medicos`
--

CREATE TABLE `tbl_medicos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `direccion` text NOT NULL,
  `email` text NOT NULL,
  `telefono` int(10) NOT NULL,
  `especialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_medicos`
--

INSERT INTO `tbl_medicos` (`id`, `nombre`, `direccion`, `email`, `telefono`, `especialidad`) VALUES
(2, 'Carlos', '50 noroeste de la Iglesia Católica de Santa Margarita', 'christopheravila49@gmail.com', 2536124, '1'),
(3, 'Carlos', '60 metros sureste de la iglesia san martin', 'carlos@gmail.xcom', 56412412, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pacientes`
--

CREATE TABLE `tbl_pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `direccion` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_pacientes`
--

INSERT INTO `tbl_pacientes` (`id`, `nombre`, `direccion`, `email`, `telefono`) VALUES
(2, 'Cristhofer Casasola', 'Barrio Mexico, Calle 11', 'jardelcasasola@gmail.com', '88064388'),
(3, 'Carlos', '50 metro este de pipasa', 'carlos123@gmail.com', '2536124'),
(5, 'Carlos', '50 noroeste de la Iglesia Católica ', 'christopheravila49@gmail.com', '2536124'),
(6, 'Carlos', '50 noroeste de la Iglesia Católica ', 'christopheravila49@gmail.com', '2536124');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `usuario` varchar(35) NOT NULL,
  `clave` varchar(16) NOT NULL,
  `activo` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id`, `cedula`, `usuario`, `clave`, `activo`) VALUES
(1, '5-09990000', 'elcrack', 'ccc', 1),
(2, '5-09990000', 'elcrack', 'bbb', 1),
(3, '5-09990000', 'elcrack', 'eee', 1),
(4, '1-00000234', 'lhl', 'mmm', 1),
(5, '1-17730583', 'Cristhofer', 'casa', 1),
(6, '5-26151561', 'Arturo', 'ddd', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_especialidad`
--
ALTER TABLE `tbl_especialidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_medicos`
--
ALTER TABLE `tbl_medicos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_pacientes`
--
ALTER TABLE `tbl_pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_citas`
--
ALTER TABLE `tbl_citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_especialidad`
--
ALTER TABLE `tbl_especialidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_medicos`
--
ALTER TABLE `tbl_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_pacientes`
--
ALTER TABLE `tbl_pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
