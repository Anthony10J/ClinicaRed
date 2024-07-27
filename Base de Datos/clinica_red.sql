-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2024 a las 05:48:05
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
  `Id_Objeto` int(11) NOT NULL,
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
  `Id_Doctor` int(11) NOT NULL
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
  `Contacto_Usuario` varchar(50) DEFAULT NULL,
  `Id_Tipo_Contacto` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_expediente`
--

CREATE TABLE `tbl_detalle_expediente` (
  `Id_Detalle_Expediente` int(11) NOT NULL,
  `Fecha_Evaluacion` date NOT NULL,
  `Hora_Evaluacion` time NOT NULL,
  `Id_Expediente` int(11) NOT NULL,
  `Id_Evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_terapia`
--

CREATE TABLE `tbl_detalle_terapia` (
  `Id_Detalle_Terapia` int(11) NOT NULL,
  `Duracion` time NOT NULL,
  `Fecha_Terapia` datetime NOT NULL,
  `Id_Cita_Terapia` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Terapia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_terapia_tratamiento`
--

CREATE TABLE `tbl_detalle_terapia_tratamiento` (
  `IdDetalleTerapiaTratamiento` int(11) NOT NULL,
  `Id_Detalle_Terapia` int(11) NOT NULL,
  `Id_Tipo_Tratamiento` int(11) NOT NULL,
  `Resultado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dia_feriado`
--

CREATE TABLE `tbl_dia_feriado` (
  `Id_Dia_Feriado` int(11) NOT NULL,
  `Dia_Feriado` date NOT NULL,
  `Creado_Por` varchar(45) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Descripcion` varchar(45) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado_cita`
--

CREATE TABLE `tbl_estado_cita` (
  `Id_Estado_Cita` int(11) NOT NULL,
  `Id_Cita_Terapia` int(11) NOT NULL,
  `Estado_Cita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_expediente`
--

CREATE TABLE `tbl_expediente` (
  `id_Expediente` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `id_Cita_Terapia` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
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
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_horario`
--

CREATE TABLE `tbl_horario` (
  `Id_Horario` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Hora_Salida` time NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_parametros`
--

INSERT INTO `tbl_ms_parametros` (`Id_Parametro`, `Parametro`, `Valor`, `Id_Usuario`, `Fecha_Creacion`, `Fecha_Modificacion`) VALUES
(1, 'CANT_MIN_CLAVE', '8', 1, '2024-03-01 05:08:58', '2024-03-01 05:08:58'),
(2, 'CANT_MAX_CLAVE', '35', 1, '2024-03-01 05:08:58', '2024-03-01 05:08:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ms_permisos`
--

CREATE TABLE `tbl_ms_permisos` (
  `Id_Permisos` int(11) NOT NULL,
  `Id_Rol` int(11) NOT NULL,
  `Id_Objeto` int(11) NOT NULL,
  `Permiso_Insercion` char(1) NOT NULL,
  `Permiso_Eliminacion` char(1) NOT NULL,
  `Permiso_Actualizacion` char(1) NOT NULL,
  `Permiso_Consultar` char(1) NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(3, 'USUARIO', 'ROL PARA USUARIOS CON ACCESO AL SISTEMA', '1', '2024-03-04 21:39:12', '1', '2024-03-04 21:39:12');

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
  `primer_ingreso` int(11) NOT NULL,
  `Fecha_Ultima_Conexion` datetime DEFAULT NULL,
  `Primer_Inicio_Sesion` datetime DEFAULT NULL,
  `Fecha_Vencimiento` date DEFAULT NULL,
  `Creado_Por` varchar(15) DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT NULL,
  `Numero_Inicio_Sesion` int(11) DEFAULT NULL,
  `CodigoOTP` int(6) NOT NULL,
  `FechaExpiracionOTP` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Modificado_Por` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_ms_usuario`
--

INSERT INTO `tbl_ms_usuario` (`Id_Usuario`, `DNI`, `Usuario`, `Correo`, `Nombre`, `Direccion`, `FechaNacimiento`, `FechaContratacion`, `Estado_Usuario`, `Contrasena`, `IdRol`, `IdGenero`, `primer_ingreso`, `Fecha_Ultima_Conexion`, `Primer_Inicio_Sesion`, `Fecha_Vencimiento`, `Creado_Por`, `Fecha_Creacion`, `Numero_Inicio_Sesion`, `CodigoOTP`, `FechaExpiracionOTP`, `Fecha_Modificado`, `Modificado_Por`) VALUES
(1, '0802200289432', 'ADMIN', 'redelectrodiagnostico@gmail.com', 'ADMINISTRADOR DEL SISTEMA', 'SPS', '2024-03-02', '2024-03-04 22:25:36', 1, 'd2a1e5441f59e167f290d9cd79796ebc', 1, 1, 1, '2024-03-04 22:25:06', '2024-03-04 22:25:16', NULL, NULL, NULL, NULL, 782349, '2024-03-03 15:36:20', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_observacion_fisioterapeuta`
--

CREATE TABLE `tbl_observacion_fisioterapeuta` (
  `Id_Obs_Fisioterapeuta` int(11) NOT NULL,
  `Observaciones` varchar(100) DEFAULT NULL,
  `Otro` varchar(100) DEFAULT NULL,
  `id_Expediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_paciente`
--

CREATE TABLE `tbl_paciente` (
  `Id_Paciente` int(11) NOT NULL,
  `Numero_Documento` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `IdGenero` int(11) NOT NULL,
  `Id_Tipo_Documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pin`
--

CREATE TABLE `tbl_pin` (
  `Id_Pin` int(11) NOT NULL,
  `Pin` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT NULL,
  `Creado_Por` varchar(15) DEFAULT NULL,
  `Modificado_Por` varchar(15) DEFAULT NULL,
  `Fecha_Modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_pin`
--

INSERT INTO `tbl_pin` (`Id_Pin`, `Pin`, `Id_Usuario`, `Fecha_Creacion`, `Creado_Por`, `Modificado_Por`, `Fecha_Modificacion`) VALUES
(1, 12345, NULL, '2024-02-12 23:20:16', NULL, NULL, NULL),
(2, 12345, NULL, '2024-02-13 22:54:03', NULL, NULL, NULL),
(3, 12345, NULL, '2024-02-14 16:20:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_resultado_evaluacion`
--

CREATE TABLE `tbl_resultado_evaluacion` (
  `Id_Resultado_Evaluacion` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Id_Evaluacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Estructura de tabla para la tabla `tbl_terapia_expediente`
--

CREATE TABLE `tbl_terapia_expediente` (
  `Id_Terapia` int(11) NOT NULL,
  `Numero_Sesiones` int(11) NOT NULL,
  `Id_Expediente` int(11) NOT NULL,
  `Id_Tipo_Terapia` int(11) NOT NULL,
  `Id_Tipo_Distribucion` int(11) NOT NULL,
  `Observacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_cita`
--

CREATE TABLE `tbl_tipo_cita` (
  `Id_Tipo_Cita` int(11) NOT NULL,
  `Descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Estructura de tabla para la tabla `tbl_tipo_distribucion`
--

CREATE TABLE `tbl_tipo_distribucion` (
  `Id_Tipo_Distribucion` int(11) NOT NULL,
  `Descripcion` varchar(10) NOT NULL,
  `Frecuencia` int(11) NOT NULL
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
(10, 'Identidad'),
(11, 'Pasaporte'),
(12, 'Identidad Extranjera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_terapia`
--

CREATE TABLE `tbl_tipo_terapia` (
  `idTipoTerapia` int(11) NOT NULL,
  `Codigo` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Id_Tipo_Tratamiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_tratamiento`
--

CREATE TABLE `tbl_tipo_tratamiento` (
  `Id_Tipo_Tratamiento` int(11) NOT NULL,
  `Nombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`Id_Bitacora`),
  ADD KEY `FK_Bitacora_Usuario_idx` (`Id_Usuario`),
  ADD KEY `FK_Bitacora_Objetos_idx` (`Id_Objeto`);

--
-- Indices de la tabla `tbl_cita_terapeutica`
--
ALTER TABLE `tbl_cita_terapeutica`
  ADD PRIMARY KEY (`id_Cita_Terapia`),
  ADD KEY `FK_CitaTerapeutica_Paciente_idx` (`Id_Paciente`),
  ADD KEY `FK_CitaTerapeutica_Empleado_idx` (`Id_Usuario`),
  ADD KEY `fk_TBL_CITA_TERAPEUTICA_TBL_TIPO_CITA1_idx` (`Id_Tipo_Cita`),
  ADD KEY `FK_CitaTerapeutica_Usuario_idx` (`Id_Doctor`);

--
-- Indices de la tabla `tbl_contacto_paciente`
--
ALTER TABLE `tbl_contacto_paciente`
  ADD PRIMARY KEY (`Id_Contacto_Paciente`),
  ADD KEY `FK_ContactoPaciente_Paciente_idx` (`Id_Paciente`),
  ADD KEY `FK_ContactoPaciente_TipoContacto_idx` (`Id_Tipo_Contacto`);

--
-- Indices de la tabla `tbl_contacto_usuario`
--
ALTER TABLE `tbl_contacto_usuario`
  ADD PRIMARY KEY (`Id_Contacto_Usuario`),
  ADD KEY `FK_Telefono_TipoTelefono_idx` (`Id_Tipo_Contacto`),
  ADD KEY `FK_ContactoUsuario_Usuario_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_detalle_expediente`
--
ALTER TABLE `tbl_detalle_expediente`
  ADD PRIMARY KEY (`Id_Detalle_Expediente`),
  ADD KEY `FK_DetalleExpediente_Expediente_idx` (`Id_Expediente`),
  ADD KEY `fk_TBL_DETALLE_EXPEDIENTE_TBL_EVALUACION1_idx` (`Id_Evaluacion`);

--
-- Indices de la tabla `tbl_detalle_terapia`
--
ALTER TABLE `tbl_detalle_terapia`
  ADD PRIMARY KEY (`Id_Detalle_Terapia`),
  ADD KEY `FK_DetalleTerapia_Empleado_idx` (`Id_Usuario`),
  ADD KEY `FK_DetalleTerapia_CitaTerapeutica_idx` (`Id_Cita_Terapia`),
  ADD KEY `FK_DetalleTerapia_Terapia_idx` (`Id_Terapia`);

--
-- Indices de la tabla `tbl_detalle_terapia_tratamiento`
--
ALTER TABLE `tbl_detalle_terapia_tratamiento`
  ADD PRIMARY KEY (`IdDetalleTerapiaTratamiento`),
  ADD KEY `FK_TBL_DETALLE_TERAPIA_TRATAMIENTO_TBL_DETALLE_TERAPIA_idx` (`Id_Detalle_Terapia`),
  ADD KEY `FK_DetalleTerapiaTratamiento_TipoTratamiento` (`Id_Tipo_Tratamiento`);

--
-- Indices de la tabla `tbl_dia_feriado`
--
ALTER TABLE `tbl_dia_feriado`
  ADD PRIMARY KEY (`Id_Dia_Feriado`),
  ADD KEY `FK_DiaFeriado_Usuario_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_estado_cita`
--
ALTER TABLE `tbl_estado_cita`
  ADD PRIMARY KEY (`Id_Estado_Cita`),
  ADD KEY `FK_EstadoCita_CitaTerapeutica_idx` (`Id_Cita_Terapia`);

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
  ADD KEY `fk_TBL_EXPEDIENTE_TBL_CITA_TERAPEUTICA1_idx` (`id_Cita_Terapia`),
  ADD KEY `fk_TBL_EXPEDIENTE_TBL_MS_USUARIO1_idx` (`id_Usuario`);

--
-- Indices de la tabla `tbl_genero`
--
ALTER TABLE `tbl_genero`
  ADD PRIMARY KEY (`IdGenero`);

--
-- Indices de la tabla `tbl_horario`
--
ALTER TABLE `tbl_horario`
  ADD PRIMARY KEY (`Id_Horario`),
  ADD KEY `FK_Horario_Usuario_idx` (`Id_Usuario`);

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
-- Indices de la tabla `tbl_observacion_fisioterapeuta`
--
ALTER TABLE `tbl_observacion_fisioterapeuta`
  ADD PRIMARY KEY (`Id_Obs_Fisioterapeuta`),
  ADD KEY `fk_TBL_OBSERVACION_FISIOTERAPEUTA_TBL_EXPEDIENTE1_idx` (`id_Expediente`);

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
  ADD KEY `FK_PreguntasUsuario_Usuario_idx` (`Id_Usuario`);

--
-- Indices de la tabla `tbl_resultado_evaluacion`
--
ALTER TABLE `tbl_resultado_evaluacion`
  ADD PRIMARY KEY (`Id_Resultado_Evaluacion`),
  ADD KEY `fk_TBL_RESULTADO_EVALUACION_TBL_EVALUACION1_idx` (`Id_Evaluacion`);

--
-- Indices de la tabla `tbl_resultado_expediente`
--
ALTER TABLE `tbl_resultado_expediente`
  ADD PRIMARY KEY (`Id_Resultado_Expediente`),
  ADD KEY `FK_ResultadoExpediente_ResultadoEvaluacion_idx` (`Id_Resultado_Evaluacion`),
  ADD KEY `FK_ResultadoExpediente_DetalleExpediente_idx` (`Id_Detalle_Expediente`);

--
-- Indices de la tabla `tbl_terapia_expediente`
--
ALTER TABLE `tbl_terapia_expediente`
  ADD PRIMARY KEY (`Id_Terapia`),
  ADD KEY `FK_Terapia_TipoTerapia_idx` (`Id_Tipo_Terapia`),
  ADD KEY `FK_Terapia_Expediente_idx` (`Id_Expediente`),
  ADD KEY `fk_TBL_TERAPIA_TBL_TIPO_DISTRIBUCION1_idx` (`Id_Tipo_Distribucion`);

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
-- Indices de la tabla `tbl_tipo_distribucion`
--
ALTER TABLE `tbl_tipo_distribucion`
  ADD PRIMARY KEY (`Id_Tipo_Distribucion`);

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
-- AUTO_INCREMENT de la tabla `tbl_dia_feriado`
--
ALTER TABLE `tbl_dia_feriado`
  MODIFY `Id_Dia_Feriado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_cita`
--
ALTER TABLE `tbl_estado_cita`
  MODIFY `Id_Estado_Cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_estado_usuario`
--
ALTER TABLE `tbl_estado_usuario`
  MODIFY `Id_Estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_evaluacion`
--
ALTER TABLE `tbl_evaluacion`
  MODIFY `Id_Evaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  MODIFY `id_Expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_genero`
--
ALTER TABLE `tbl_genero`
  MODIFY `IdGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_horario`
--
ALTER TABLE `tbl_horario`
  MODIFY `Id_Horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_hist_contrasena`
--
ALTER TABLE `tbl_ms_hist_contrasena`
  MODIFY `Id_Hist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_objetos`
--
ALTER TABLE `tbl_ms_objetos`
  MODIFY `Id_Objetos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_parametros`
--
ALTER TABLE `tbl_ms_parametros`
  MODIFY `Id_Parametro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_permisos`
--
ALTER TABLE `tbl_ms_permisos`
  MODIFY `Id_Permisos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_ms_roles`
--
ALTER TABLE `tbl_ms_roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `Id_Pin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_resultado_evaluacion`
--
ALTER TABLE `tbl_resultado_evaluacion`
  MODIFY `Id_Resultado_Evaluacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_resultado_expediente`
--
ALTER TABLE `tbl_resultado_expediente`
  MODIFY `Id_Resultado_Expediente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_terapia_expediente`
--
ALTER TABLE `tbl_terapia_expediente`
  MODIFY `Id_Terapia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_cita`
--
ALTER TABLE `tbl_tipo_cita`
  MODIFY `Id_Tipo_Cita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_contacto`
--
ALTER TABLE `tbl_tipo_contacto`
  MODIFY `Id_Tipo_Contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_distribucion`
--
ALTER TABLE `tbl_tipo_distribucion`
  MODIFY `Id_Tipo_Distribucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  MODIFY `Id_Tipo_Documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_terapia`
--
ALTER TABLE `tbl_tipo_terapia`
  MODIFY `idTipoTerapia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_tratamiento`
--
ALTER TABLE `tbl_tipo_tratamiento`
  MODIFY `Id_Tipo_Tratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD CONSTRAINT `FK_Bitacora_Objetos` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_ms_objetos` (`Id_Objetos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Bitacora_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_cita_terapeutica`
--
ALTER TABLE `tbl_cita_terapeutica`
  ADD CONSTRAINT `FK_CitaTerapeutica_Empleado` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CitaTerapeutica_Usuario` FOREIGN KEY (`Id_Doctor`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_CITA_TERAPEUTICA_TBL_TIPO_CITA1` FOREIGN KEY (`Id_Tipo_Cita`) REFERENCES `tbl_tipo_cita` (`Id_Tipo_Cita`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `FK_ContactoUsuario_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Telefono_TipoTelefono` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_expediente`
--
ALTER TABLE `tbl_detalle_expediente`
  ADD CONSTRAINT `FK_DetalleExpediente_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_DETALLE_EXPEDIENTE_TBL_EVALUACION1` FOREIGN KEY (`Id_Evaluacion`) REFERENCES `tbl_evaluacion` (`Id_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_terapia`
--
ALTER TABLE `tbl_detalle_terapia`
  ADD CONSTRAINT `FK_DetalleTerapia_CitaTerapeutica` FOREIGN KEY (`Id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleTerapia_Empleado` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleTerapia_Terapia` FOREIGN KEY (`Id_Terapia`) REFERENCES `tbl_terapia_expediente` (`Id_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_terapia_tratamiento`
--
ALTER TABLE `tbl_detalle_terapia_tratamiento`
  ADD CONSTRAINT `FK_DetalleTerapiaTratamiento_DetalleTerapia` FOREIGN KEY (`Id_Detalle_Terapia`) REFERENCES `tbl_detalle_terapia` (`Id_Detalle_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DetalleTerapiaTratamiento_TipoTratamiento` FOREIGN KEY (`Id_Tipo_Tratamiento`) REFERENCES `tbl_tipo_tratamiento` (`Id_Tipo_Tratamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_dia_feriado`
--
ALTER TABLE `tbl_dia_feriado`
  ADD CONSTRAINT `FK_DiaFeriado_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_estado_cita`
--
ALTER TABLE `tbl_estado_cita`
  ADD CONSTRAINT `FK_EstadoCita_CitaTerapeutica` FOREIGN KEY (`Id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_expediente`
--
ALTER TABLE `tbl_expediente`
  ADD CONSTRAINT `fk_TBL_EXPEDIENTE_TBL_CITA_TERAPEUTICA1` FOREIGN KEY (`id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_EXPEDIENTE_TBL_MS_USUARIO1` FOREIGN KEY (`id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_horario`
--
ALTER TABLE `tbl_horario`
  ADD CONSTRAINT `FK_Horario_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_ms_hist_contrasena`
--
ALTER TABLE `tbl_ms_hist_contrasena`
  ADD CONSTRAINT `FK_Contrasena_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `FK_Empleado_Genero` FOREIGN KEY (`IdGenero`) REFERENCES `tbl_genero` (`IdGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Usuario_Rol` FOREIGN KEY (`IdRol`) REFERENCES `tbl_ms_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_observacion_fisioterapeuta`
--
ALTER TABLE `tbl_observacion_fisioterapeuta`
  ADD CONSTRAINT `fk_TBL_OBSERVACION_FISIOTERAPEUTA_TBL_EXPEDIENTE1` FOREIGN KEY (`id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_paciente`
--
ALTER TABLE `tbl_paciente`
  ADD CONSTRAINT `FK_Paciente_Genero` FOREIGN KEY (`IdGenero`) REFERENCES `tbl_genero` (`IdGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Paciente_TipoDocumento` FOREIGN KEY (`Id_Tipo_Documento`) REFERENCES `tbl_tipo_documento` (`Id_Tipo_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pin`
--
ALTER TABLE `tbl_pin`
  ADD CONSTRAINT `FK_PreguntasUsuario_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_resultado_evaluacion`
--
ALTER TABLE `tbl_resultado_evaluacion`
  ADD CONSTRAINT `fk_TBL_RESULTADO_EVALUACION_TBL_EVALUACION1` FOREIGN KEY (`Id_Evaluacion`) REFERENCES `tbl_evaluacion` (`Id_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_resultado_expediente`
--
ALTER TABLE `tbl_resultado_expediente`
  ADD CONSTRAINT `FK_ResultadoExpediente_DetalleExpediente` FOREIGN KEY (`Id_Detalle_Expediente`) REFERENCES `tbl_detalle_expediente` (`Id_Detalle_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ResultadoExpediente_ResultadoEvaluacion` FOREIGN KEY (`Id_Resultado_Evaluacion`) REFERENCES `tbl_resultado_evaluacion` (`Id_Resultado_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_terapia_expediente`
--
ALTER TABLE `tbl_terapia_expediente`
  ADD CONSTRAINT `FK_Terapia_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Terapia_TipoTerapia` FOREIGN KEY (`Id_Tipo_Terapia`) REFERENCES `tbl_tipo_terapia` (`idTipoTerapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_TERAPIA_TBL_TIPO_DISTRIBUCION1` FOREIGN KEY (`Id_Tipo_Distribucion`) REFERENCES `tbl_tipo_distribucion` (`Id_Tipo_Distribucion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_tipo_terapia`
--
ALTER TABLE `tbl_tipo_terapia`
  ADD CONSTRAINT `FK_TipoTerapia_TipoTratamiento` FOREIGN KEY (`Id_Tipo_Tratamiento`) REFERENCES `tbl_tipo_tratamiento` (`Id_Tipo_Tratamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
