-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2024 a las 22:23:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica_red`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

CREATE TABLE `tbl_bitacora` (
  `Id_Bitacora` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Accion` varchar(20) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cita_terapeutica`
--

CREATE TABLE `tbl_cita_terapeutica` (
  `id_Cita_Terapia` int(11) NOT NULL,
  `Descripcion_Cita` varchar(80) NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Fecha_Cita` date NOT NULL,
  `Hora_Cita` time NOT NULL,
  `Id_Paciente` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Tipo_Cita` int(11) NOT NULL,
  `Id_Especialista` int(11) NOT NULL,
  `Id_Estado_Cita` int(3) NOT NULL,
  `Id_Expediente` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_contacto_paciente`
--

CREATE TABLE `tbl_contacto_paciente` (
  `Id_Contacto_Paciente` int(11) NOT NULL,
  `Contacto_Paciente` varchar(50) NOT NULL,
  `Id_Paciente` int(11) NOT NULL,
  `Id_Tipo_Contacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_contacto_usuario`
--

CREATE TABLE `tbl_contacto_usuario` (
  `Id_Contacto_Usuario` int(11) NOT NULL,
  `Contacto_Usuario` varchar(50) NOT NULL,
  `Id_Tipo_Contacto` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_expediente`
--

CREATE TABLE `tbl_detalle_expediente` (
  `Id_Detalle_Expediente` int(11) NOT NULL,
  `Fecha_Evaluacion` datetime NOT NULL,
  `Lateralidad` varchar(50) NOT NULL,
  `Referido` varchar(50) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Cita_Terapia` int(11) NOT NULL,
  `Id_Expediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_terapia`
--

CREATE TABLE `tbl_detalle_terapia` (
  `Id_Detalle_Terapia` int(11) NOT NULL,
  `Numero_Sesiones` varchar(20) NOT NULL,
  `Fecha_Terapia` datetime NOT NULL,
  `Id_Cita_Terapia` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Expediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_terapia_tratamiento`
--

CREATE TABLE `tbl_detalle_terapia_tratamiento` (
  `IdDetalleTerapiaTratamiento` int(11) NOT NULL,
  `Id_Detalle_Terapia` int(11) NOT NULL,
  `Id_Tipo_Terapia` int(11) NOT NULL,
  `Resultado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_cita`
--

CREATE TABLE `tbl_estado_cita` (
  `Id_Estado_Cita` int(11) NOT NULL,
  `Estado_Cita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_estado_cita`
--

INSERT INTO `tbl_estado_cita` (`Id_Estado_Cita`, `Estado_Cita`) VALUES
(1, 'PENDIENTE'),
(2, 'EN ESPERA'),
(3, 'EN ATENCIÓN'),
(4, 'FINALIZADO'),
(5, 'CANCELADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_usuario`
--

CREATE TABLE `tbl_estado_usuario` (
  `Id_Estado` int(11) NOT NULL,
  `Descripcion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_estado_usuario`
--

INSERT INTO `tbl_estado_usuario` (`Id_Estado`, `Descripcion`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO'),
(3, 'BLOQUEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_evaluacion`
--

CREATE TABLE `tbl_evaluacion` (
  `Id_Evaluacion` int(11) NOT NULL,
  `Descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_evaluacion`
--

INSERT INTO `tbl_evaluacion` (`Id_Evaluacion`, `Descripcion`) VALUES
(1, 'HISTORIAL CLÍNICO'),
(2, 'EXÁMEN FÍSICO'),
(3, 'DIAGNÓSTICO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_expediente`
--

CREATE TABLE `tbl_expediente` (
  `id_Expediente` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `Id_Paciente` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_genero`
--

CREATE TABLE `tbl_genero` (
  `IdGenero` int(11) NOT NULL,
  `Descripcion` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_genero`
--

INSERT INTO `tbl_genero` (`IdGenero`, `Descripcion`) VALUES
(1, 'MASCULINO'),
(2, 'FEMENINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_hist_contrasena`
--

CREATE TABLE `tbl_ms_hist_contrasena` (
  `Id_Hist` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_objetos`
--

CREATE TABLE `tbl_ms_objetos` (
  `Id_Objetos` int(11) NOT NULL,
  `Objeto` varchar(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Tipo_Objeto` varchar(15) NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_objetos`
--

INSERT INTO `tbl_ms_objetos` (`Id_Objetos`, `Objeto`, `Descripcion`, `Tipo_Objeto`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(1, 'V_Paciente', 'Vista para agregar, eliminar y editar pacientes', 'Agregar Pacient', 'Administrador', '2024-03-31 07:19:51', '', '2024-03-31 07:19:51'),
(2, 'V_modal_cita', 'Vista que permite agendar citas a los pacientes', 'Agendar Citas', 'Administrador', '2024-03-31 07:19:51', '', '2024-03-31 07:19:51'),
(3, 'V_modal_expediente', 'Objeto que permite ver los expedientes y crear nuevos expedientes para los pacientes', 'Gestion Expedie', 'Administrador', '2024-03-31 07:50:46', '', '2024-03-31 07:50:46'),
(4, 'V_modal_historial_cita', 'Permite ver el historial de las citas de un expediente', 'Administrador', 'Administrador', '2024-03-31 07:50:46', '', '2024-03-31 07:50:46'),
(5, 'V_usuario', 'Vista para agregar, eliminar y editar Usuarios', 'Crear usuarios', 'Administrador', '2024-03-31 07:53:51', '', '2024-03-31 07:53:51'),
(6, 'V_roles', 'Objeto para crear y eliminar roles', 'Secretaria', 'Administrador', '2024-03-31 07:53:51', '', '2024-03-31 07:53:51'),
(7, 'V_permisos', 'Permite asignar permisos a los roles.', 'Fisiatra', 'Fisiatra', '2024-03-31 07:55:44', '', '2024-03-31 07:55:44'),
(8, 'Bitacora.php', 'Objeto que registra la bitacora del sistema', 'Fisiatra', 'Administrador', '2024-03-31 07:55:44', '', '2024-03-31 07:55:44'),
(9, 'V_modal_parametros', 'Objeto para gestionar parámetros del sistema', 'Administrador', 'Administrador', '2024-03-31 07:58:24', '', '2024-03-31 07:58:24'),
(10, 'V_modal_evaluacion', 'Mantenimiento de Expediente Clinico', 'Administrador', 'Administrador', '2024-03-31 07:58:24', '', '2024-03-31 07:58:24'),
(11, 'V_modal_terapeutico', 'Mantenimiento del expediente Terapeutico', '', 'Administrador', '2024-04-14 22:19:12', '', '2024-04-14 22:19:12'),
(12, 'V_modal_identidad', 'Mantenimiento de los tipos de documentos', '13', 'Administrador', '2024-04-14 22:19:12', '', '2024-04-14 22:19:12'),
(13, 'Main', 'Vista principal del main', '', 'Administrador', '2024-04-15 10:22:02', '', '2024-04-15 10:22:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_parametros`
--

CREATE TABLE `tbl_ms_parametros` (
  `Id_Parametro` int(11) NOT NULL,
  `Parametro` varchar(50) NOT NULL,
  `Valor` varchar(100) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_parametros`
--

INSERT INTO `tbl_ms_parametros` (`Id_Parametro`, `Parametro`, `Valor`, `Id_Usuario`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(1, 'CANT_MIN_CLAVE', '10', 1, '2024-03-01 05:08:58', '15', '2024-03-26 21:13:58'),
(2, 'CANT_MAX_CLAVE', '35', 1, '2024-03-01 05:08:58', '15', '2024-03-18 03:26:05'),
(3, 'Servidor_SMTP', 'smtp.gmail.com', 1, '2024-03-14 06:24:31', '15', '2024-03-18 13:41:34'),
(4, 'Correo_SMTP', 'redelectrodiagnostico@gmail.com', 1, '2024-03-14 06:24:31', '1', '2024-03-14 06:24:31'),
(5, 'Clave_SMTP', 'avvg ofcb bqzm wbrv', 1, '2024-03-14 06:24:31', '1', '2024-03-14 06:24:31'),
(6, 'Cifrado_SMTP', 'SSL', 1, '2024-03-14 06:24:31', '1', '2024-03-14 06:24:31'),
(7, 'Puerto_SMTP', '587', 1, '2024-03-14 06:24:31', '1', '2024-03-14 06:24:31'),
(8, 'Nombre_Sistema', 'Clinica Red', 1, '2024-04-12 06:36:54', '1', '2024-04-12 06:36:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_permisos`
--

CREATE TABLE `tbl_ms_permisos` (
  `Id_Permisos` int(3) NOT NULL,
  `Id_Rol` int(11) NOT NULL,
  `Id_Objeto` int(11) NOT NULL,
  `Permiso_Insercion` int(1) NOT NULL,
  `Permiso_Eliminacion` int(1) NOT NULL,
  `Permiso_Actualizacion` int(1) NOT NULL,
  `Permiso_Consultar` int(1) NOT NULL,
  `Permiso_Reportes` int(1) NOT NULL,
  `Permiso_Terapeutico` int(3) NOT NULL,
  `Permiso_Clinico` int(1) NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_permisos`
--

INSERT INTO `tbl_ms_permisos` (`Id_Permisos`, `Id_Rol`, `Id_Objeto`, `Permiso_Insercion`, `Permiso_Eliminacion`, `Permiso_Actualizacion`, `Permiso_Consultar`, `Permiso_Reportes`, `Permiso_Terapeutico`, `Permiso_Clinico`, `Creado_Por`, `Fecha_Creacion`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-03-31 09:08:39'),
(2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-03-31 09:08:39'),
(3, 1, 3, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-14 22:40:05'),
(4, 1, 4, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-14 22:40:05'),
(5, 1, 5, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-03-31 09:11:42'),
(6, 1, 6, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-03-31 09:11:42'),
(7, 1, 7, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-03-31 09:17:23'),
(8, 1, 8, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-01 02:38:44'),
(9, 1, 9, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-01 02:38:44'),
(10, 1, 10, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-01 02:44:39'),
(11, 1, 11, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-01 02:44:39'),
(12, 1, 12, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '2024-04-01 02:45:57'),
(13, 2, 1, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:45:57'),
(14, 2, 3, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:48:45'),
(15, 2, 4, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:48:45'),
(16, 2, 5, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:50:34'),
(17, 2, 6, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:50:34'),
(18, 2, 7, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:52:13'),
(19, 2, 8, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:52:13'),
(20, 2, 9, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(21, 2, 10, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:55:41'),
(22, 2, 11, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:56:31'),
(23, 2, 12, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:56:31'),
(24, 2, 2, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:58:53'),
(25, 3, 1, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:58:53'),
(26, 3, 2, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:59:47'),
(27, 3, 3, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 02:59:48'),
(28, 3, 4, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:15:59'),
(29, 3, 5, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:15:59'),
(30, 3, 6, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:17:26'),
(31, 3, 7, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:17:26'),
(32, 3, 8, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:20:33'),
(33, 3, 9, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:20:33'),
(34, 3, 7, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:25:57'),
(35, 3, 10, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:25:57'),
(36, 3, 11, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:33:45'),
(37, 3, 12, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '2024-04-01 03:33:45'),
(38, 4, 1, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-04-01 03:46:28'),
(39, 4, 2, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-04-01 03:46:28'),
(40, 4, 3, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-04-01 03:49:43'),
(41, 4, 4, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-03-31 09:07:32'),
(42, 4, 5, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-04-01 03:51:21'),
(43, 4, 6, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-04-01 03:51:21'),
(44, 4, 7, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '2024-04-01 03:56:35'),
(45, 4, 8, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(46, 4, 9, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(47, 4, 10, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(48, 4, 11, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(49, 4, 12, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(50, 5, 1, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(51, 5, 2, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(52, 5, 3, 1, 1, 1, 1, 1, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(53, 5, 4, 1, 1, 1, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(54, 5, 5, 1, 1, 1, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(55, 5, 6, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(56, 5, 7, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(57, 5, 8, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(58, 5, 9, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(59, 5, 10, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(60, 5, 11, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(61, 5, 12, 0, 0, 0, 0, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(62, 6, 1, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(63, 6, 2, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(64, 6, 3, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(65, 6, 4, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(66, 6, 5, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(67, 6, 6, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(68, 6, 7, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(69, 6, 8, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(70, 6, 9, 1, 1, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(71, 6, 10, 0, 0, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(72, 6, 11, 0, 0, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(73, 6, 12, 0, 0, 1, 0, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(74, 7, 1, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(75, 7, 2, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(76, 7, 3, 0, 0, 0, 1, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(77, 7, 4, 0, 0, 0, 1, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(78, 7, 5, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(79, 7, 6, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(80, 7, 7, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(81, 7, 8, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(82, 7, 9, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(83, 7, 10, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(84, 7, 11, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(85, 7, 12, 0, 0, 0, 0, 0, 1, 0, 'Administrador', '0000-00-00 00:00:00'),
(86, 1, 13, 1, 1, 1, 1, 1, 1, 1, 'Administrador', '0000-00-00 00:00:00'),
(87, 2, 13, 0, 0, 0, 1, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(88, 3, 13, 0, 0, 0, 1, 0, 0, 0, 'Administrador', '0000-00-00 00:00:00'),
(89, 4, 13, 1, 1, 1, 1, 1, 0, 0, '', '0000-00-00 00:00:00'),
(90, 5, 13, 0, 0, 0, 1, 0, 0, 0, '', '0000-00-00 00:00:00'),
(91, 6, 13, 0, 0, 0, 1, 0, 0, 1, '', '0000-00-00 00:00:00'),
(92, 7, 13, 0, 0, 0, 1, 0, 1, 0, '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_roles`
--

CREATE TABLE `tbl_ms_roles` (
  `Id_Rol` int(11) NOT NULL,
  `Rol` varchar(30) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_roles`
--

INSERT INTO `tbl_ms_roles` (`Id_Rol`, `Rol`, `Descripcion`, `Creado_Por`, `Fecha_Creacion`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(1, 'SUPERADMINISTRADOR', 'TIENE ACCESO A TODO EL SISTEMA', '1', '2024-02-13 05:01:09', '1', '2024-02-13 05:01:09'),
(2, 'DEFECTO', 'ROL ESPECÍFICO PARA EL AUTOREGISTRO', '1', '2024-03-04 00:38:03', '1', '2024-03-04 00:38:03'),
(3, 'USUARIO', 'CAMBIA DE DEFECTO A USUARIO PARA VISUALIZAR EL MAIN', '1', '2024-03-04 21:39:12', '1', '2024-03-04 21:39:12'),
(4, 'ADMINISTRADOR', 'ADMINISTRACION GENERAL DEL SISTEMA', '1', '2024-03-14 05:16:59', '1', '2024-03-14 05:16:59'),
(5, 'SECRETARIA', 'ACCESO A GESTION DE CITAS', '1', '2024-03-14 05:16:59', '1', '2024-03-14 05:16:59'),
(6, 'FISIATRA', 'ACCESO A AGENDA Y EXPEDIENTES', '1', '2024-03-27 22:30:54', '1', '2024-03-27 22:30:54'),
(7, 'TERAPEUTA', 'SOLO VISUALIZAR EXPEDIENTES', '1', '2024-03-27 22:30:54', '1', '2024-03-27 22:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_usuario`
--

CREATE TABLE `tbl_ms_usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `DNI` varchar(13) DEFAULT NULL,
  `Usuario` varchar(15) DEFAULT NULL,
  `Correo` varchar(40) DEFAULT NULL,
  `Nombre` varchar(80) DEFAULT NULL,
  `Direccion` varchar(80) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `FechaContratacion` datetime DEFAULT NULL,
  `Estado_Usuario` int(11) DEFAULT NULL,
  `Contrasena` varchar(35) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `IdGenero` int(11) DEFAULT NULL,
  `primer_ingreso` int(11) NOT NULL DEFAULT 0,
  `Fecha_Ultima_Conexion` datetime DEFAULT NULL,
  `Primer_Inicio_Sesion` datetime DEFAULT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL,
  `Creado_Por` varchar(15) DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT NULL,
  `Numero_Inicio_Sesion` int(11) DEFAULT NULL,
  `CodigoOTP` int(6) NOT NULL,
  `FechaExpiracionOTP` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_usuario`
--

INSERT INTO `tbl_ms_usuario` (`Id_Usuario`, `DNI`, `Usuario`, `Correo`, `Nombre`, `Direccion`, `FechaNacimiento`, `FechaContratacion`, `Estado_Usuario`, `Contrasena`, `IdRol`, `IdGenero`, `primer_ingreso`, `Fecha_Ultima_Conexion`, `Primer_Inicio_Sesion`, `Fecha_Vencimiento`, `Creado_Por`, `Fecha_Creacion`, `Numero_Inicio_Sesion`, `CodigoOTP`, `FechaExpiracionOTP`) VALUES
(1, '0802200289432', 'ADMIN', 'redelectrodiagnostico@gmail.com', 'CLÍNICA RED', 'SPS', '2024-03-02', '2024-03-04 22:25:36', 1, 'd2a1e5441f59e167f290d9cd79796ebc', 1, 1, 1, '2024-03-04 22:25:06', '2024-03-10 20:22:09', NULL, NULL, NULL, NULL, 537844, '2024-04-12 15:09:39');

--
-- Disparadores `tbl_ms_usuario`
--
DELIMITER $$
CREATE TRIGGER `guardar_contrasena_anterior` BEFORE UPDATE ON `tbl_ms_usuario` FOR EACH ROW BEGIN
    IF OLD.Contrasena <> NEW.Contrasena THEN
        INSERT INTO tbl_ms_hist_contrasena (Id_Usuario, Contrasena, Fecha_Modificacion)
        VALUES (OLD.Id_Usuario, OLD.Contrasena, NOW());
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_paciente`
--

CREATE TABLE `tbl_paciente` (
  `Id_Paciente` int(11) NOT NULL,
  `Numero_Documento` varchar(15) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `IdGenero` int(11) NOT NULL,
  `Id_Tipo_Documento` int(11) NOT NULL,
  `Ocupacion` varchar(50) NOT NULL,
  `Estado_Paciente` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pin`
--

CREATE TABLE `tbl_pin` (
  `Id_Pin` int(11) NOT NULL,
  `Pin` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_resultado_evaluacion`
--

CREATE TABLE `tbl_resultado_evaluacion` (
  `Id_Resultado_Evaluacion` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Id_Evaluacion` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_resultado_evaluacion`
--

INSERT INTO `tbl_resultado_evaluacion` (`Id_Resultado_Evaluacion`, `Descripcion`, `Id_Evaluacion`) VALUES
(1, 'HEA', 1),
(2, 'FOG', 1),
(3, 'APP', 1),
(4, 'AHxDxQx', 1),
(5, 'AIA', 1),
(6, 'AVD', 1),
(7, 'PA', 2),
(8, 'FC', 2),
(9, 'SatO2', 2),
(10, 'PESO', 2),
(11, 'IDx', 3),
(12, 'INDICACIONES MÉDICAS', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_resultado_expediente`
--

CREATE TABLE `tbl_resultado_expediente` (
  `Id_Resultado_Expediente` int(11) NOT NULL,
  `Id_Resultado_Evaluacion` int(11) NOT NULL,
  `Id_Detalle_Expediente` int(11) NOT NULL,
  `Resultado` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cita`
--

CREATE TABLE `tbl_tipo_cita` (
  `Id_Tipo_Cita` int(11) NOT NULL,
  `Descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_cita`
--

INSERT INTO `tbl_tipo_cita` (`Id_Tipo_Cita`, `Descripcion`) VALUES
(1, 'DIAGNÓSTICO'),
(2, 'TERAPIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_contacto`
--

CREATE TABLE `tbl_tipo_contacto` (
  `Id_Tipo_Contacto` int(11) NOT NULL,
  `Descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_documento`
--

CREATE TABLE `tbl_tipo_documento` (
  `Id_Tipo_Documento` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_documento`
--

INSERT INTO `tbl_tipo_documento` (`Id_Tipo_Documento`, `Descripcion`) VALUES
(1, 'IDENTIDAD'),
(2, 'PASAPORTE'),
(3, 'IDENTIDAD EXTRANJERA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_terapia`
--

CREATE TABLE `tbl_tipo_terapia` (
  `idTipoTerapia` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Id_Tipo_Tratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_terapia`
--

INSERT INTO `tbl_tipo_terapia` (`idTipoTerapia`, `Nombre`, `Id_Tipo_Tratamiento`) VALUES
(1, 'ÁREA', 1),
(2, 'TIEMPO', 1),
(3, 'PROTOCOLO/DOSIS', 1),
(4, 'COMPRESA CALIENTE', 2),
(5, 'COMPRESA FRÍA', 2),
(6, 'CONTRASTE', 2),
(7, 'PARAFINA', 2),
(8, 'TINA MANO/PIE', 2),
(9, 'ÁREA', 2),
(10, 'TIEMPO', 2),
(11, 'OBSERVACIÓN', 2),
(12, 'RELAJANTE', 3),
(13, 'ESTIMULANTE', 3),
(14, 'LIBERAR ADHERENCIAS', 3),
(15, 'DESCARGA', 3),
(16, 'DRENAJE LINFÁTICO', 3),
(17, 'ÁREA', 3),
(18, 'OBSERVACIÓN', 3),
(19, 'TENS', 4),
(20, 'ALTO VOLT', 4),
(21, 'IF', 4),
(22, 'Bi', 4),
(23, 'Te', 4),
(24, 'VMS', 4),
(25, 'RUSAS', 4),
(26, 'GALVÁNICA', 4),
(27, 'PUNTERO', 4),
(28, 'MICROCORRIENTE', 4),
(29, 'COMPEX', 4),
(30, 'DOSIS', 4),
(31, 'TIEMPO', 4),
(32, 'ÁREA', 4),
(33, 'OBSERVACIÓN', 4),
(34, 'COMBINADO', 5),
(35, 'PULSÁTIL%', 5),
(36, 'CONTINUO', 5),
(37, 'WATTS', 5),
(38, 'Mhz', 5),
(39, 'TIEMPO', 5),
(40, 'ÁREA', 5),
(41, 'OBSERVACIÓN', 5),
(42, 'JULIOS', 6),
(43, 'Hz', 6),
(44, 'MIN/Pto', 6),
(45, 'Ptos', 6),
(46, 'OBSERVACIÓN', 6),
(47, 'PASIVA', 7),
(48, 'A-A', 7),
(49, 'A-L', 7),
(50, 'GENTIL', 7),
(51, 'FORZADA', 7),
(52, 'ÁREA', 7),
(53, 'OBSERVACIÓN', 7),
(54, 'CERVICAL', 8),
(55, 'PÉLVICA', 8),
(56, 'INTERMITENTE', 8),
(57, 'CONTINUA', 8),
(58, 'MANTENER', 8),
(59, 'seg/Descanso', 8),
(60, 'PESO Min', 8),
(61, 'LB/MAX', 8),
(62, 'TIEMPO', 8),
(63, 'AUMENTO GRADUAL', 8),
(64, 'OBSERVACIÓN', 8),
(65, 'RUEDA DE HOMBRO', 9),
(66, 'ESCALERILLA', 9),
(67, 'PATÍN', 9),
(68, 'ESTABILIZACIÓN ESCAPULAR', 9),
(69, 'POLEA S/PESO', 9),
(70, 'POLEA C/PESO', 9),
(71, 'ESCALERA BILATERAL', 9),
(72, 'OBSERVACIÓN', 9),
(73, 'D', 10),
(74, 'I', 10),
(75, 'BILAT', 10),
(76, 'MANGA', 10),
(77, 'BOTA', 10),
(78, '(A) DESCARGA MUSCULAR', 10),
(79, '(B) MASAJE', 10),
(80, '(C) VASCULAR/LINFÁTICO', 10),
(81, 'PRESIÓN mmHg', 10),
(82, 'TIEMPO', 10),
(83, 'OBSERVACIÓN', 10),
(84, 'ÁREA', 11),
(85, 'TIEMPO', 11),
(86, 'PROTOCOLO/DOSIS', 11),
(87, 'APLICADOR', 11),
(88, 'GUANTE', 11),
(89, 'OBSERVACIÓN', 11),
(90, 'ESTIRAMIENTO', 12),
(91, 'MÚSCULOS', 12),
(92, 'FOAM ROLLER', 12),
(93, 'MÍMICA FACIAL', 12),
(94, 'FORTALECIMIENTO ISOMÉTRICO', 12),
(95, 'A-L', 12),
(96, 'PROGRESIVO RESISTIDO MANUAL', 12),
(97, 'PROGRESIVO RESISTIVO', 12),
(98, 'BANDAS', 12),
(99, 'PESAS', 12),
(100, 'EXCÉNTRICOS', 12),
(101, 'MÚSCULOS', 12),
(102, 'No. SETS', 12),
(103, 'REPETICIONES', 12),
(104, 'FORTALECIMIENTO LUMBOPÉLVICO', 12),
(105, 'REEDUCACIÓN MUSCULAR', 12),
(106, 'OBSERVACIÓN', 12),
(107, 'CAMINADORA', 13),
(108, 'ELÍPTICA', 13),
(109, 'BICI ESTAC', 13),
(110, 'BICI', 13),
(111, 'TIEMPO', 13),
(112, 'RESISTENCIA', 3),
(113, 'PESO', 13),
(114, 'BALANCÍN', 13),
(115, 'BOZU', 13),
(116, 'CINTURÓN RUSO', 13),
(117, 'MINI TRAMPOLÍN', 13),
(118, 'REED GESTO', 13),
(119, 'Bi', 13),
(120, 'MONO', 13),
(121, 'SETS', 13),
(122, 'REPETICIONES', 13),
(123, 'OBSERVACIÓN', 13),
(124, 'BIPEDESTACIÓN', 14),
(125, 'DESCARGA DE PESO %', 14),
(126, 'EQUILIBRIO Y COORDINACIÓN', 14),
(127, 'MARCHA', 14),
(128, 'ADITAMENTO', 14),
(129, 'REEDUCAR', 14),
(130, 'DIFERENTES TERRENOS', 14),
(131, 'GRADAS', 14),
(132, 'RAMPA', 14),
(133, 'PUNTAS-TALONES', 14),
(134, 'PROPIOCEPCIÓN Bi', 14),
(135, 'MONO', 14),
(136, 'PERTURBACIÓN', 14),
(137, 'OBSERVACIÓN', 14),
(138, 'GIROS', 15),
(139, 'EQUILIBRIO DE CUELLO Y TRONCO', 15),
(140, 'CONTROL POSTURAL', 15),
(141, 'DESCARGA DE PESO MS', 15),
(142, 'VASCULACIÓN PÉLVICA', 15),
(143, '4 PUNTOS', 15),
(144, 'ABDOMINALES', 15),
(145, 'SEDESTACIÓN', 15),
(146, 'TRANSFERENCIAS', 15),
(147, 'NEUROFACILITACIÓN', 15),
(148, 'OBSERVACIÓN', 15),
(149, 'MOTOR FINO', 16),
(150, 'COORDINACIÓN OJO-MANO', 16),
(151, 'PINZAS', 16),
(152, 'OPONENCIA', 16),
(153, 'PUÑO', 16),
(154, 'DIGITOEXTEND', 16),
(155, 'MEJORAR', 16),
(156, 'AVD', 16),
(157, 'OBSERVACIÓN', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_tratamiento`
--

CREATE TABLE `tbl_tipo_tratamiento` (
  `Id_Tipo_Tratamiento` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_tratamiento`
--

INSERT INTO `tbl_tipo_tratamiento` (`Id_Tipo_Tratamiento`, `Nombre`) VALUES
(1, 'MAGNETOTERAPIA'),
(2, 'MEDIOS FÍSICOS'),
(3, 'MASOTERAPIA'),
(4, 'ELECTROTERAPIA'),
(5, 'ULTRASONIDO'),
(6, 'LÁSER'),
(7, 'MOVILIDAD ARTICULAR'),
(8, 'TRACCIÓN'),
(9, 'TERAPIA OCUPACIONAL'),
(10, 'PRESOTERAPIA'),
(11, 'OSCILACIÓN PROFUNDA'),
(12, 'EJERCICIO'),
(13, 'EN GIMNASIO'),
(14, 'EN BARRAS'),
(15, 'EN CAMASTRÓN'),
(16, 'DESTREZAS MANUALES');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`Id_Bitacora`),
  ADD KEY `FK_Bitacora_Usuario_idx` (`Id_Usuario`),
  ADD KEY `Id_Usuario` (`Id_Usuario`),
  ADD KEY `Id_Usuario_2` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_cita_terapeutica`
--
ALTER TABLE `tbl_cita_terapeutica`
  ADD PRIMARY KEY (`id_Cita_Terapia`),
  ADD KEY `Id_Paciente` (`Id_Paciente`),
  ADD KEY `Id_Usuario` (`Id_Usuario`),
  ADD KEY `Id_Tipo_Cita` (`Id_Tipo_Cita`),
  ADD KEY `Id_Especialista` (`Id_Especialista`),
  ADD KEY `Id_Estado_Cita` (`Id_Estado_Cita`),
  ADD KEY `Id_Expediente` (`Id_Expediente`);

--
-- Indices de la tabla `tbl_contacto_paciente`
--
ALTER TABLE `tbl_contacto_paciente`
  ADD PRIMARY KEY (`Id_Contacto_Paciente`),
  ADD KEY `FK_ContactoPaciente_Paciente_idx` (`Id_Paciente`),
  ADD KEY `FK_ContactoPaciente_TipoContacto_idx` (`Id_Tipo_Contacto`),
  ADD KEY `Id_Paciente` (`Id_Paciente`),
  ADD KEY `Id_Tipo_Contacto` (`Id_Tipo_Contacto`);

--
-- Indices de la tabla `tbl_contacto_usuario`
--
ALTER TABLE `tbl_contacto_usuario`
  ADD PRIMARY KEY (`Id_Contacto_Usuario`),
  ADD KEY `Id_Tipo_Contacto` (`Id_Tipo_Contacto`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_detalle_expediente`
--
ALTER TABLE `tbl_detalle_expediente`
  ADD PRIMARY KEY (`Id_Detalle_Expediente`),
  ADD KEY `FK_DetalleExpediente_Expediente_idx` (`Id_Expediente`),
  ADD KEY `Id_Usuario` (`Id_Usuario`,`Id_Cita_Terapia`),
  ADD KEY `FK_DetalleExpediente_CitaTerapeutica` (`Id_Cita_Terapia`);

--
-- Indices de la tabla `tbl_detalle_terapia`
--
ALTER TABLE `tbl_detalle_terapia`
  ADD PRIMARY KEY (`Id_Detalle_Terapia`),
  ADD KEY `FK_DetalleTerapia_CitaTerapeutica` (`Id_Cita_Terapia`),
  ADD KEY `FK_DetalleTerapia_Usuario` (`Id_Usuario`),
  ADD KEY `FK_DetalleTerapia_Expediente` (`Id_Expediente`);

--
-- Indices de la tabla `tbl_detalle_terapia_tratamiento`
--
ALTER TABLE `tbl_detalle_terapia_tratamiento`
  ADD PRIMARY KEY (`IdDetalleTerapiaTratamiento`),
  ADD KEY `FK_TBL_DETALLE_TERAPIA_TRATAMIENTO_TBL_DETALLE_TERAPIA_idx` (`Id_Detalle_Terapia`),
  ADD KEY `FK_DetalleTerapiaTratamiento_TipoTerapia` (`Id_Tipo_Terapia`) USING BTREE;

--
-- Indices de la tabla `tbl_estado_cita`
--
ALTER TABLE `tbl_estado_cita`
  ADD PRIMARY KEY (`Id_Estado_Cita`);

--
-- Indices de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  ADD PRIMARY KEY (`Id_Estado`);

--
-- Indices de la tabla `tbl_evaluacion`
--
ALTER TABLE `tbl_evaluacion`
  ADD PRIMARY KEY (`Id_Evaluacion`);

--
-- Indices de la tabla `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  ADD PRIMARY KEY (`id_Expediente`),
  ADD UNIQUE KEY `Id_Paciente_2` (`Id_Paciente`),
  ADD KEY `fk_TBL_EXPEDIENTE_TBL_MS_USUARIO1_idx` (`id_Usuario`),
  ADD KEY `Id_Paciente` (`Id_Paciente`);

--
-- Indices de la tabla `tbl_genero`
--
ALTER TABLE `tbl_genero`
  ADD PRIMARY KEY (`IdGenero`);

--
-- Indices de la tabla `tbl_ms_hist_contrasena`
--
ALTER TABLE `tbl_ms_hist_contrasena`
  ADD PRIMARY KEY (`Id_Hist`),
  ADD KEY `FK_Contrasena_Usuario_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_ms_objetos`
--
ALTER TABLE `tbl_ms_objetos`
  ADD PRIMARY KEY (`Id_Objetos`);

--
-- Indices de la tabla `tbl_ms_parametros`
--
ALTER TABLE `tbl_ms_parametros`
  ADD PRIMARY KEY (`Id_Parametro`),
  ADD KEY `FK_Parametros_Usuario_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  ADD PRIMARY KEY (`Id_Permisos`),
  ADD KEY `FK_Permisos_Roles_idx` (`Id_Rol`),
  ADD KEY `FK_Permisos_Objetos_idx` (`Id_Objeto`);

--
-- Indices de la tabla `tbl_ms_roles`
--
ALTER TABLE `tbl_ms_roles`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `tbl_ms_usuario`
--
ALTER TABLE `tbl_ms_usuario`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `FK_Empleado_Genero_idx` (`IdGenero`),
  ADD KEY `FK_Usuario_Rol_idx` (`IdRol`),
  ADD KEY `Estado_Usuario` (`Estado_Usuario`);

--
-- Indices de la tabla `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  ADD PRIMARY KEY (`Id_Paciente`),
  ADD KEY `FK_Paciente_Genero_idx` (`IdGenero`),
  ADD KEY `FK_Paciente_TipoDocumento_idx` (`Id_Tipo_Documento`);

--
-- Indices de la tabla `tbl_pin`
--
ALTER TABLE `tbl_pin`
  ADD PRIMARY KEY (`Id_Pin`),
  ADD KEY `FK_PreguntasUsuario_Usuario_idx` (`Id_Usuario`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_resultado_evaluacion`
--
ALTER TABLE `tbl_resultado_evaluacion`
  ADD PRIMARY KEY (`Id_Resultado_Evaluacion`),
  ADD KEY `fk_TBL_RESULTADO_EVALUACION_TBL_EVALUACION` (`Id_Evaluacion`);

--
-- Indices de la tabla `tbl_resultado_expediente`
--
ALTER TABLE `tbl_resultado_expediente`
  ADD PRIMARY KEY (`Id_Resultado_Expediente`),
  ADD KEY `FK_ResultadoExpediente_ResultadoEvaluacion_idx` (`Id_Resultado_Evaluacion`),
  ADD KEY `FK_ResultadoExpediente_DetalleExpediente_idx` (`Id_Detalle_Expediente`);

--
-- Indices de la tabla `tbl_tipo_cita`
--
ALTER TABLE `tbl_tipo_cita`
  ADD PRIMARY KEY (`Id_Tipo_Cita`);

--
-- Indices de la tabla `tbl_tipo_contacto`
--
ALTER TABLE `tbl_tipo_contacto`
  ADD PRIMARY KEY (`Id_Tipo_Contacto`);

--
-- Indices de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  ADD PRIMARY KEY (`Id_Tipo_Documento`);

--
-- Indices de la tabla `tbl_tipo_terapia`
--
ALTER TABLE `tbl_tipo_terapia`
  ADD PRIMARY KEY (`idTipoTerapia`),
  ADD KEY `FK_TipoTerapia_TipoTratamiento_idx` (`Id_Tipo_Tratamiento`);

--
-- Indices de la tabla `tbl_tipo_tratamiento`
--
ALTER TABLE `tbl_tipo_tratamiento`
  ADD PRIMARY KEY (`Id_Tipo_Tratamiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `Id_Bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cita_terapeutica`
--
ALTER TABLE `tbl_cita_terapeutica`
  MODIFY `id_Cita_Terapia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_contacto_paciente`
--
ALTER TABLE `tbl_contacto_paciente`
  MODIFY `Id_Contacto_Paciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_contacto_usuario`
--
ALTER TABLE `tbl_contacto_usuario`
  MODIFY `Id_Contacto_Usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_expediente`
--
ALTER TABLE `tbl_detalle_expediente`
  MODIFY `Id_Detalle_Expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_terapia`
--
ALTER TABLE `tbl_detalle_terapia`
  MODIFY `Id_Detalle_Terapia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_terapia_tratamiento`
--
ALTER TABLE `tbl_detalle_terapia_tratamiento`
  MODIFY `IdDetalleTerapiaTratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_cita`
--
ALTER TABLE `tbl_estado_cita`
  MODIFY `Id_Estado_Cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  MODIFY `Id_Estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_evaluacion`
--
ALTER TABLE `tbl_evaluacion`
  MODIFY `Id_Evaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  MODIFY `id_Expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_genero`
--
ALTER TABLE `tbl_genero`
  MODIFY `IdGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_hist_contrasena`
--
ALTER TABLE `tbl_ms_hist_contrasena`
  MODIFY `Id_Hist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_objetos`
--
ALTER TABLE `tbl_ms_objetos`
  MODIFY `Id_Objetos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_parametros`
--
ALTER TABLE `tbl_ms_parametros`
  MODIFY `Id_Parametro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  MODIFY `Id_Permisos` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_roles`
--
ALTER TABLE `tbl_ms_roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_usuario`
--
ALTER TABLE `tbl_ms_usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  MODIFY `Id_Paciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pin`
--
ALTER TABLE `tbl_pin`
  MODIFY `Id_Pin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_resultado_evaluacion`
--
ALTER TABLE `tbl_resultado_evaluacion`
  MODIFY `Id_Resultado_Evaluacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_resultado_expediente`
--
ALTER TABLE `tbl_resultado_expediente`
  MODIFY `Id_Resultado_Expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cita`
--
ALTER TABLE `tbl_tipo_cita`
  MODIFY `Id_Tipo_Cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_contacto`
--
ALTER TABLE `tbl_tipo_contacto`
  MODIFY `Id_Tipo_Contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  MODIFY `Id_Tipo_Documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_terapia`
--
ALTER TABLE `tbl_tipo_terapia`
  MODIFY `idTipoTerapia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_tratamiento`
--
ALTER TABLE `tbl_tipo_tratamiento`
  MODIFY `Id_Tipo_Tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD CONSTRAINT `FK_Bitacora_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_cita_terapeutica`
--
ALTER TABLE `tbl_cita_terapeutica`
  ADD CONSTRAINT `FK_CitaTerapeutica_EstadoCita` FOREIGN KEY (`Id_Estado_Cita`) REFERENCES `tbl_estado_cita` (`Id_Estado_Cita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_TipoCita` FOREIGN KEY (`Id_Tipo_Cita`) REFERENCES `tbl_tipo_cita` (`Id_Tipo_Cita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_UsuarioEspecialista` FOREIGN KEY (`Id_Especialista`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_contacto_paciente`
--
ALTER TABLE `tbl_contacto_paciente`
  ADD CONSTRAINT `FK_ContactoPaciente_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ContactoPaciente_TipoContacto` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_contacto_usuario`
--
ALTER TABLE `tbl_contacto_usuario`
  ADD CONSTRAINT `FK_ContactoUsuario_TipoContacto` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ContactoUsuario_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_expediente`
--
ALTER TABLE `tbl_detalle_expediente`
  ADD CONSTRAINT `FK_DetalleExpediente_CitaTerapeutica` FOREIGN KEY (`Id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleExpediente_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleExpediente_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_terapia`
--
ALTER TABLE `tbl_detalle_terapia`
  ADD CONSTRAINT `FK_DetalleTerapia_CitaTerapeutica` FOREIGN KEY (`Id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleTerapia_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleTerapia_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_terapia_tratamiento`
--
ALTER TABLE `tbl_detalle_terapia_tratamiento`
  ADD CONSTRAINT `FK_DetTerTratamiento_DetalleTerapia` FOREIGN KEY (`Id_Detalle_Terapia`) REFERENCES `tbl_detalle_terapia` (`Id_Detalle_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetTerTratamiento_TipoTerapia` FOREIGN KEY (`Id_Tipo_Terapia`) REFERENCES `tbl_tipo_terapia` (`idTipoTerapia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  ADD CONSTRAINT `FK_Expediente_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Expediente_Usuario` FOREIGN KEY (`id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_hist_contrasena`
--
ALTER TABLE `tbl_ms_hist_contrasena`
  ADD CONSTRAINT `FK_HistorialContrasena_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_parametros`
--
ALTER TABLE `tbl_ms_parametros`
  ADD CONSTRAINT `FK_Parametros_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  ADD CONSTRAINT `FK_Permisos_Objetos` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_ms_objetos` (`Id_Objetos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Permisos_Roles` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_usuario`
--
ALTER TABLE `tbl_ms_usuario`
  ADD CONSTRAINT `FK_Usuario_EstadoUsuario` FOREIGN KEY (`Estado_Usuario`) REFERENCES `tbl_estado_usuario` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Usuario_Genero` FOREIGN KEY (`IdGenero`) REFERENCES `tbl_genero` (`IdGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Usuario_Rol` FOREIGN KEY (`IdRol`) REFERENCES `tbl_ms_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  ADD CONSTRAINT `FK_TBL_DOCUMENTO_TBL_PACIENTE` FOREIGN KEY (`Id_Tipo_Documento`) REFERENCES `tbl_tipo_documento` (`Id_Tipo_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_GENERO_TBL_PACIENTE` FOREIGN KEY (`IdGenero`) REFERENCES `tbl_genero` (`IdGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pin`
--
ALTER TABLE `tbl_pin`
  ADD CONSTRAINT `FK_Pin_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_resultado_evaluacion`
--
ALTER TABLE `tbl_resultado_evaluacion`
  ADD CONSTRAINT `fk_RESULTADO_EVALUACION_EVALUACION` FOREIGN KEY (`Id_Evaluacion`) REFERENCES `tbl_evaluacion` (`Id_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_resultado_expediente`
--
ALTER TABLE `tbl_resultado_expediente`
  ADD CONSTRAINT `FK_ResultadoExpediente_DetalleExpediente` FOREIGN KEY (`Id_Detalle_Expediente`) REFERENCES `tbl_detalle_expediente` (`Id_Detalle_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ResultadoExpediente_ResultadoEvaluacion` FOREIGN KEY (`Id_Resultado_Evaluacion`) REFERENCES `tbl_resultado_evaluacion` (`Id_Resultado_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tipo_terapia`
--
ALTER TABLE `tbl_tipo_terapia`
  ADD CONSTRAINT `FK_TipoTerapia_TipoTratamiento` FOREIGN KEY (`Id_Tipo_Tratamiento`) REFERENCES `tbl_tipo_tratamiento` (`Id_Tipo_Tratamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
