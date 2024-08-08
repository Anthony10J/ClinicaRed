SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS u452119581_clinica_red;

USE u452119581_clinica_red;

DROP TABLE IF EXISTS tbl_bitacora;

CREATE TABLE `tbl_bitacora` (
  `Id_Bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Accion` varchar(20) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Id_Objeto` int(11) NOT NULL,
  PRIMARY KEY (`Id_Bitacora`),
  KEY `FK_Bitacora_Usuario_idx` (`Id_Usuario`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `Id_Usuario_2` (`Id_Usuario`),
  KEY `FK_bitacora_objeto` (`Id_Bitacora`),
  KEY `FK_Bitacora_Objetos` (`Id_Objeto`),
  CONSTRAINT `FK_Bitacora_Objetos` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_ms_objetos` (`Id_Objetos`),
  CONSTRAINT `FK_Bitacora_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_bitacora VALUES("1","2024-08-02 05:18:41","1","INSERTAR","SE HA REGISTRADO EL PACIENTE: ETHEL","1");
INSERT INTO tbl_bitacora VALUES("2","2024-08-02 05:20:31","1","ACTUALIZAR","SE HA EDITADO EL PACIENTE: ETHEL. TIPO DE DOCUMENTO CAMBIADO DE IDENTIDAD A PASAPORTE","1");
INSERT INTO tbl_bitacora VALUES("3","2024-08-02 05:20:31","1","ACTUALIZAR","SE HA EDITADO EL PACIENTE: ETHEL. OCUPACIÓN CAMBIADA DE NINGUNA A ESTUDIANTE","1");
INSERT INTO tbl_bitacora VALUES("4","2024-08-02 05:39:00","1","ELIMINAR","SE INACTIVÓ EL PACIENTE: ETHEL QUE TENIA EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("5","2024-08-02 05:39:13","1","ELIMINAR","SE INACTIVÓ EL PACIENTE: ETHEL QUE TENIA EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("6","2024-08-02 05:41:51","1","ELIMINAR","SE ACTIVÓ EL PACIENTE: ETHEL QUE TENIA EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("7","2024-08-02 05:44:35","1","ELIMINAR","SE HA INACTIVADO EL PACIENTE: ETHEL QUE TENIA EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("8","2024-08-02 05:44:46","1","ELIMINAR","SE ACTIVÓ EL PACIENTE: ETHEL QUE CON EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("9","2024-08-02 05:47:02","1","ELIMINAR","SE HA INHABILITÓ EL PACIENTE: ETHEL QUE TENIA EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("10","2024-08-02 05:47:10","1","ACTUALIZAR","SE ACTIVÓ EL PACIENTE: ETHEL CON EL ID: 1","1");
INSERT INTO tbl_bitacora VALUES("11","2024-08-02 06:07:23","1","INSERTAR","SE CREO EL EXPEDIENTE CON ID: 1 Al PACIENTE ETHEL","3");
INSERT INTO tbl_bitacora VALUES("12","2024-08-02 06:19:09","1","INSERTAR","CITA: DIAGNÓSTICO FUE AGENDADA PARA EL 2024-08-16 A LAS 00:23:00 PARA EL PACIENTE ETHEL","2");
INSERT INTO tbl_bitacora VALUES("13","2024-08-02 06:19:58","1","ELIMINAR","SE CANCELÓ LA CITA: 2 DEL TIPO DIAGNÓSTICO","2");
INSERT INTO tbl_bitacora VALUES("14","2024-08-02 06:21:09","1","INSERTAR","CITA: DIAGNÓSTICO FUE AGENDADA PARA EL 2024-08-30 A LAS 02:00:00 PARA EL PACIENTE ETHEL","2");
INSERT INTO tbl_bitacora VALUES("15","2024-08-02 06:21:27","1","ACTUALIZAR","EL ESTADO DE LA CITA 3 CAMBIO DE :PENDIENTE A EN ESPERA","2");
INSERT INTO tbl_bitacora VALUES("16","2024-08-02 06:34:08","1","INSERTAR","SE REGISTRO EL USUARIO: DED CON EL NOMBRE DULCE","5");
INSERT INTO tbl_bitacora VALUES("17","2024-08-02 06:36:27","1","ACTUALIZAR","SE HA EDITADO EL USUARIO DEDGUEVARA. USUARIO CAMBIADO DE DED A DEDGUEVARA","5");
INSERT INTO tbl_bitacora VALUES("18","2024-08-02 06:36:27","1","ACTUALIZAR","SE HA EDITADO EL CORREO ELECTRONICO DEL USUARIO: DEDGUEVARA. DE dediazg@unah.hn A dediazg@unah.hnn","5");
INSERT INTO tbl_bitacora VALUES("19","2024-08-02 06:37:14","1","ACTUALIZAR","EL ESTADO DEL USUARIO DEDGUEVARA CAMBIO DE :ACTIVO A INACTIVO","5");
INSERT INTO tbl_bitacora VALUES("20","2024-08-02 06:37:36","1","ACTUALIZAR","EL ESTADO DEL USUARIO DEDGUEVARA CAMBIO DE :INACTIVO A ACTIVO","5");
INSERT INTO tbl_bitacora VALUES("21","2024-08-02 07:05:17","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DEL ROL RECEPCIONISTA. DESCRIPCION EDITADA DE RECIBE A LOS PACIENTES DE LA CLINICA A RECIBE A LOS NUEVOS PACIENTES DE LA CLINICA","6");
INSERT INTO tbl_bitacora VALUES("22","2024-08-02 07:05:17","1","INSERTAR","SE HA REGISTRADO EL ROL DE: RECEPCIONISTA","6");
INSERT INTO tbl_bitacora VALUES("23","2024-08-02 07:06:22","1","INSERTAR","SE HA REGISTRADO EL PARAMETRO: NO_SE","9");
INSERT INTO tbl_bitacora VALUES("24","2024-08-02 07:06:41","1","ACTUALIZAR","SE HA EDITADO EL VALOR DEL PARAMETRO NO_SE. VALOR EDITADO DE 100 A 10","9");
INSERT INTO tbl_bitacora VALUES("25","2024-08-02 07:06:47","1","ELIMINAR","SE ELIMINÓ EL PARAMETRO: NO_SE","9");
INSERT INTO tbl_bitacora VALUES("26","2024-08-02 07:19:32","1","INSERTAR","SE HA REGISTRADO  BITACORA","11");
INSERT INTO tbl_bitacora VALUES("27","2024-08-02 07:19:33","1","INSERTAR","SE HA REGISTRADO  BITACORA","11");
INSERT INTO tbl_bitacora VALUES("28","2024-08-02 22:04:33","1","ACTUALIZAR","SE HA EDITADO LA FECHA DE CONTRATACION DEL USUARIO: MANA. FECHA DE CONTRATACION CAMBIADA DE 2024-01-01 00:00:00 A 0000-00-00 00:00:00","5");
INSERT INTO tbl_bitacora VALUES("29","2024-08-02 22:06:48","1","ACTUALIZAR","SE HA EDITADO LA FECHA DE CONTRATACION DEL USUARIO: MANA. FECHA DE CONTRATACION CAMBIADA DE 0000-00-00 A 2020-10-03","5");
INSERT INTO tbl_bitacora VALUES("30","2024-08-02 22:08:18","1","INSERTAR","SE REGISTRO EL USUARIO: JDUARTE CON EL NOMBRE ANTHONY DUARTE","5");
INSERT INTO tbl_bitacora VALUES("31","2024-08-03 04:08:52","1","INSERTAR","SE HA REGISTRADO LA EVALUACION: PRUEBA","10");
INSERT INTO tbl_bitacora VALUES("32","2024-08-03 04:08:56","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","10");
INSERT INTO tbl_bitacora VALUES("33","2024-08-03 04:09:30","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("34","2024-08-03 04:09:45","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("35","2024-08-03 05:19:28","1","INSERTAR","SE HA REGISTRADO LA EVALUACION: EXAMEN","10");
INSERT INTO tbl_bitacora VALUES("36","2024-08-03 05:19:46","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DE LA EVALUACION: EXAMEN A EXAMENE","10");
INSERT INTO tbl_bitacora VALUES("37","2024-08-03 05:19:52","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: EXAMENE","10");
INSERT INTO tbl_bitacora VALUES("38","2024-08-03 05:20:25","1","INSERTAR","SE HA REGISTRADO LA EVALUACION: EXAMEN","10");
INSERT INTO tbl_bitacora VALUES("39","2024-08-03 05:20:47","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO EVALUACION EXAMEN","11");
INSERT INTO tbl_bitacora VALUES("40","2024-08-03 05:20:59","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DE LA EVALUACION: EVALUACION EXAMEN A EVALUACION EXAMENE","11");
INSERT INTO tbl_bitacora VALUES("41","2024-08-03 05:21:03","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: EVALUACION EXAMENE","11");
INSERT INTO tbl_bitacora VALUES("42","2024-08-03 05:21:58","1","INSERTAR","SE HA REGISTRADO EL TIPO DE TERAPIA TERAPIA","10");
INSERT INTO tbl_bitacora VALUES("43","2024-08-03 05:22:10","1","ACTUALIZAR","SE HA EDITADO EL TIPO DE TRATAMIENTO: TERAPIA A TERAPIAE","11");
INSERT INTO tbl_bitacora VALUES("44","2024-08-03 05:22:28","1","INSERTAR","SE HA REGISTRADO EL TIPO DE TRATAMIENTO TRATAMIENTO","11");
INSERT INTO tbl_bitacora VALUES("45","2024-08-03 05:22:42","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL TRATAMIENTO: TRATAMIENTO A TRATAMIENTOE","11");
INSERT INTO tbl_bitacora VALUES("46","2024-08-03 05:22:49","1","ELIMINAR","SE ELIMINÓ EL TRATAMIENTO: TRATAMIENTOE","11");
INSERT INTO tbl_bitacora VALUES("47","2024-08-03 05:23:14","1","ELIMINAR","SE ELIMINÓ EL TIPO DE TERAPIA: TERAPIAE","11");
INSERT INTO tbl_bitacora VALUES("48","2024-08-03 16:57:11","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: EXAMEN","10");
INSERT INTO tbl_bitacora VALUES("49","2024-08-03 21:07:46","1","INGRESO A PANTALLA","ADMIN INGRESO A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("50","2024-08-03 21:08:34","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO NUEVO","12");
INSERT INTO tbl_bitacora VALUES("51","2024-08-03 21:08:35","1","INGRESO A PANTALLA","ADMIN INGRESO A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("52","2024-08-03 21:08:42","1","ACTUALIZAR","SE HA EDITADO EL TIPO DE DOCUMENTO: NUEVO A NUEVOP","12");
INSERT INTO tbl_bitacora VALUES("53","2024-08-03 21:08:43","1","INGRESO A PANTALLA","ADMIN INGRESO A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("54","2024-08-03 21:08:46","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: NUEVOP","12");
INSERT INTO tbl_bitacora VALUES("55","2024-08-03 21:08:47","1","INGRESO A PANTALLA","ADMIN INGRESO A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("56","2024-08-03 21:10:15","1","INGRESO A PANTALLA","ADMIN INGRESO A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("57","2024-08-03 21:12:03","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO ","12");
INSERT INTO tbl_bitacora VALUES("58","2024-08-03 21:32:26","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("59","2024-08-03 21:33:07","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("60","2024-08-03 21:33:29","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("61","2024-08-03 21:33:37","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO PANTALLA","12");
INSERT INTO tbl_bitacora VALUES("62","2024-08-03 21:33:38","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("63","2024-08-03 21:34:47","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("64","2024-08-03 21:34:55","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO IDE","12");
INSERT INTO tbl_bitacora VALUES("65","2024-08-03 21:34:56","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("66","2024-08-03 21:42:18","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("67","2024-08-03 21:42:37","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO IDER","12");
INSERT INTO tbl_bitacora VALUES("68","2024-08-03 21:46:07","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO WERTUTYU","12");
INSERT INTO tbl_bitacora VALUES("69","2024-08-03 23:02:41","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("70","2024-08-04 03:58:06","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: BITACORA","11");
INSERT INTO tbl_bitacora VALUES("71","2024-08-04 03:58:20","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: BITACORA","11");
INSERT INTO tbl_bitacora VALUES("72","2024-08-04 04:00:29","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("73","2024-08-04 04:00:43","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: WERTUTYU","12");
INSERT INTO tbl_bitacora VALUES("74","2024-08-04 04:00:56","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: IDER","12");
INSERT INTO tbl_bitacora VALUES("75","2024-08-04 04:01:00","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: ","12");
INSERT INTO tbl_bitacora VALUES("76","2024-08-04 04:01:05","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: PANTALLA","12");
INSERT INTO tbl_bitacora VALUES("77","2024-08-04 04:01:09","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: IDE","12");
INSERT INTO tbl_bitacora VALUES("78","2024-08-04 04:23:38","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("79","2024-08-05 06:00:02","1","INSERTAR","SE HA REGISTRADO LA EVALUACION: PRUEBA","10");
INSERT INTO tbl_bitacora VALUES("80","2024-08-05 06:00:13","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","10");
INSERT INTO tbl_bitacora VALUES("81","2024-08-05 06:00:25","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("82","2024-08-05 06:00:35","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("83","2024-08-05 06:00:58","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("84","2024-08-05 06:01:03","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("85","2024-08-05 06:01:22","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("86","2024-08-05 06:01:30","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("87","2024-08-05 06:01:43","1","INSERTAR","SE HA REGISTRADO EL TIPO DE TERAPIA PRUEBA","10");
INSERT INTO tbl_bitacora VALUES("88","2024-08-05 06:02:05","1","INSERTAR","SE HA REGISTRADO EL TIPO DE TRATAMIENTO PRUEBA 2","11");
INSERT INTO tbl_bitacora VALUES("89","2024-08-05 06:02:39","1","INGRESO A PANTALLA","ADMIN INGRESÓ A LA PANTALLA DE IDENTIDAD.","12");
INSERT INTO tbl_bitacora VALUES("90","2024-08-05 06:02:46","1","INSERTAR","SE HA REGISTRADO EL TIPO DE DOCUMENTO RTN","12");
INSERT INTO tbl_bitacora VALUES("91","2024-08-05 06:02:51","1","ELIMINAR","SE ELIMINÓ EL TIPO DE DOCUMENTO: RTN","12");
INSERT INTO tbl_bitacora VALUES("92","2024-08-06 20:18:33","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL USUARIO: ANTHONY DUARTE A ANTHONY DUARTEE","5");
INSERT INTO tbl_bitacora VALUES("93","2024-08-06 20:18:40","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL USUARIO: ANTHONY DUARTEE A ANTHONY DUARTE","5");
INSERT INTO tbl_bitacora VALUES("94","2024-08-06 20:25:25","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL USUARIO: ANTHONY DUARTE A ANTHONY DUARTEE","5");
INSERT INTO tbl_bitacora VALUES("95","2024-08-06 20:25:30","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL USUARIO: ANTHONY DUARTEE A ANTHONY DUARTE","5");
INSERT INTO tbl_bitacora VALUES("96","2024-08-06 20:33:50","1","ACTUALIZAR","SE HA EDITADO EL USUARIO JDUARTEE. USUARIO CAMBIADO DE JDUARTE A JDUARTEE","5");
INSERT INTO tbl_bitacora VALUES("97","2024-08-06 20:33:55","1","ACTUALIZAR","SE HA EDITADO EL USUARIO JDUARTE. USUARIO CAMBIADO DE JDUARTEE A JDUARTE","5");
INSERT INTO tbl_bitacora VALUES("98","2024-08-06 20:37:58","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL USUARIO: ANTHONY DUARTE A ANTHONY DUARTEEEE","5");
INSERT INTO tbl_bitacora VALUES("99","2024-08-06 20:38:03","1","ACTUALIZAR","SE HA EDITADO EL NOMBRE DEL USUARIO: ANTHONY DUARTEEEE A ANTHONY DUARTE","5");
INSERT INTO tbl_bitacora VALUES("100","2024-08-06 20:39:38","1","ACTUALIZAR","EL ESTADO DEL USUARIO JDUARTE CAMBIO DE :ACTIVO A INACTIVO","5");
INSERT INTO tbl_bitacora VALUES("101","2024-08-06 20:39:43","1","ACTUALIZAR","EL ESTADO DEL USUARIO JDUARTE CAMBIO DE :INACTIVO A ACTIVO","5");
INSERT INTO tbl_bitacora VALUES("102","2024-08-06 20:40:05","1","ACTUALIZAR","EL ESTADO DEL USUARIO JDUARTE CAMBIO DE :ACTIVO A INACTIVO","5");
INSERT INTO tbl_bitacora VALUES("103","2024-08-06 20:40:09","1","ACTUALIZAR","EL ESTADO DEL USUARIO JDUARTE CAMBIO DE :INACTIVO A ACTIVO","5");
INSERT INTO tbl_bitacora VALUES("104","2024-08-06 22:18:50","1","INSERTAR","SE HA REGISTRADO EL PACIENTE: ANTHONY DUARTE","1");
INSERT INTO tbl_bitacora VALUES("105","2024-08-06 22:23:26","1","INSERTAR","SE CREO EL EXPEDIENTE CON ID: 14 Al PACIENTE ANTHONY DUARTE","3");
INSERT INTO tbl_bitacora VALUES("106","2024-08-06 22:25:18","1","INSERTAR","CITA: DIAGNÓSTICO FUE AGENDADA PARA EL 2024-08-07 A LAS 13:00:00 PARA EL PACIENTE ANTHONY DUARTE","2");
INSERT INTO tbl_bitacora VALUES("107","2024-08-06 22:25:27","1","ACTUALIZAR","EL ESTADO DE LA CITA 4 CAMBIO DE :PENDIENTE A EN ESPERA","2");
INSERT INTO tbl_bitacora VALUES("108","2024-08-07 14:11:19","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DEL ROL PRUEBA. DESCRIPCION EDITADA DE PRUEBA A PRUEBA2","6");
INSERT INTO tbl_bitacora VALUES("109","2024-08-07 14:11:19","1","INSERTAR","SE HA REGISTRADO EL ROL DE: PRUEBA","6");
INSERT INTO tbl_bitacora VALUES("110","2024-08-07 14:12:09","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DEL ROL ROL. DESCRIPCION EDITADA DE ROL A ROL1","6");
INSERT INTO tbl_bitacora VALUES("111","2024-08-07 14:12:09","1","INSERTAR","SE HA REGISTRADO EL ROL DE: ROL","6");
INSERT INTO tbl_bitacora VALUES("112","2024-08-07 15:50:22","5","INSERTAR","CITA: DIAGNÓSTICO FUE AGENDADA PARA EL 2024-08-06 A LAS 13:20:00 PARA EL PACIENTE ANTHONY DUARTE","2");
INSERT INTO tbl_bitacora VALUES("113","2024-08-07 15:50:43","5","ACTUALIZAR","EL ESTADO DE LA CITA 5 CAMBIO DE :PENDIENTE A EN ESPERA","2");
INSERT INTO tbl_bitacora VALUES("114","2024-08-07 16:35:44","1","INSERTAR","CITA: DIAGNÓSTICO FUE AGENDADA PARA EL 2024-08-07 A LAS 14:20:00 PARA EL PACIENTE ANTHONY DUARTE","2");
INSERT INTO tbl_bitacora VALUES("115","2024-08-07 16:35:58","1","ACTUALIZAR","EL ESTADO DE LA CITA 9 CAMBIO DE :PENDIENTE A EN ESPERA","2");
INSERT INTO tbl_bitacora VALUES("116","2024-08-08 07:18:14","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DEL ROL RECEPCIONISTA. DESCRIPCION EDITADA DE RECIBE A LOS NUEVOS PACIENTES DE LA CLINICA A RECIBE A LOS NUEVOS PACIENTES DE LA CLINICA.","6");
INSERT INTO tbl_bitacora VALUES("117","2024-08-08 07:18:14","1","INSERTAR","SE HA REGISTRADO EL ROL DE: RECEPCIONISTA","6");
INSERT INTO tbl_bitacora VALUES("118","2024-08-08 09:06:06","1","INSERTAR","SE HA REGISTRADO EL PARAMETRO: INTENTOS_FALLIDOS","9");
INSERT INTO tbl_bitacora VALUES("119","2024-08-08 09:07:05","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DEL ROL PRUEBA. DESCRIPCION EDITADA DE PRUEBA A PRUEBA2","6");
INSERT INTO tbl_bitacora VALUES("120","2024-08-08 09:07:05","1","INSERTAR","SE HA REGISTRADO EL ROL DE: PRUEBA","6");
INSERT INTO tbl_bitacora VALUES("121","2024-08-08 09:07:46","1","ACTUALIZAR","SE HA EDITADO LA DESCRIPCION DEL ROL PRUEBA2. DESCRIPCION EDITADA DE PRUEBA2 A PRUEBA23","6");
INSERT INTO tbl_bitacora VALUES("122","2024-08-08 09:07:46","1","INSERTAR","SE HA REGISTRADO EL ROL DE: PRUEBA2","6");
INSERT INTO tbl_bitacora VALUES("123","2024-08-08 09:11:18","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("124","2024-08-08 09:11:23","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: PRUEBA","11");
INSERT INTO tbl_bitacora VALUES("125","2024-08-08 09:11:35","1","INSERTAR","SE HA REGISTRADO EXPEDIENTE CLINICO MAPAS2","11");
INSERT INTO tbl_bitacora VALUES("126","2024-08-08 09:11:40","1","ELIMINAR","SE ELIMINÓ LA EVALUACION: MAPAS2","11");
INSERT INTO tbl_bitacora VALUES("127","2024-08-08 17:41:13","1","INICIO DE SESIÓN","ADMIN INICIÓ SESIÓN","7");
INSERT INTO tbl_bitacora VALUES("128","2024-08-08 17:56:03","1","INICIO DE SESIÓN","ADMIN INICIÓ SESIÓN","5");
INSERT INTO tbl_bitacora VALUES("129","2024-08-08 18:08:22","1","CIERRE DE SESIÓN","ADMIN FINALIZÓ SESIÓN.","5");
INSERT INTO tbl_bitacora VALUES("130","2024-08-08 18:08:36","1","INICIO DE SESIÓN","ADMIN INICIÓ SESIÓN","5");
INSERT INTO tbl_bitacora VALUES("131","2024-08-08 18:33:10","1","DESCARGA","SE HA DESCARGADO REPORTE DE IDENTIDAD DE LOS PACIENTETS documento.pdf","12");
INSERT INTO tbl_bitacora VALUES("132","2024-08-08 20:32:48","1","INICIO DE SESIÓN","ADMIN INICIÓ SESIÓN","5");
INSERT INTO tbl_bitacora VALUES("133","2024-08-08 20:40:24","5","INICIO DE SESIÓN","JDUARTE INICIÓ SESIÓN","5");
INSERT INTO tbl_bitacora VALUES("134","2024-08-08 20:51:07","5","INICIO DE SESIÓN","JDUARTE INICIÓ SESIÓN","5");



DROP TABLE IF EXISTS tbl_cita_terapeutica;

CREATE TABLE `tbl_cita_terapeutica` (
  `id_Cita_Terapia` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion_Cita` varchar(80) NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Fecha_Cita` date NOT NULL,
  `Hora_Cita` time NOT NULL,
  `Id_Paciente` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Tipo_Cita` int(11) NOT NULL,
  `Id_Especialista` int(11) NOT NULL,
  `Id_Estado_Cita` int(3) NOT NULL,
  `Id_Expediente` int(3) NOT NULL,
  PRIMARY KEY (`id_Cita_Terapia`),
  KEY `Id_Paciente` (`Id_Paciente`),
  KEY `Id_Usuario` (`Id_Usuario`),
  KEY `Id_Tipo_Cita` (`Id_Tipo_Cita`),
  KEY `Id_Especialista` (`Id_Especialista`),
  KEY `Id_Estado_Cita` (`Id_Estado_Cita`),
  KEY `Id_Expediente` (`Id_Expediente`),
  CONSTRAINT `FK_CitaTerapeutica_EstadoCita` FOREIGN KEY (`Id_Estado_Cita`) REFERENCES `tbl_estado_cita` (`Id_Estado_Cita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CitaTerapeutica_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CitaTerapeutica_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CitaTerapeutica_TipoCita` FOREIGN KEY (`Id_Tipo_Cita`) REFERENCES `tbl_tipo_cita` (`Id_Tipo_Cita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CitaTerapeutica_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_CitaTerapeutica_UsuarioEspecialista` FOREIGN KEY (`Id_Especialista`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_cita_terapeutica VALUES("2","DOLOR PIE","2024-08-02 06:19:09","2024-08-16","00:23:00","1","1","1","2","5","1");
INSERT INTO tbl_cita_terapeutica VALUES("3","FRACTURA BRAZO","2024-08-02 06:21:09","2024-08-30","02:00:00","1","1","1","2","2","1");
INSERT INTO tbl_cita_terapeutica VALUES("4","FRACTURA","2024-08-06 22:25:18","2024-08-07","13:00:00","2","1","1","5","4","14");
INSERT INTO tbl_cita_terapeutica VALUES("5","FRACTURA2","2024-08-07 15:50:22","2024-08-06","13:20:00","2","5","1","5","4","14");
INSERT INTO tbl_cita_terapeutica VALUES("9","FRACTURA3","2024-08-07 16:35:44","2024-08-07","14:20:00","2","1","1","5","4","14");



DROP TABLE IF EXISTS tbl_contacto_paciente;

CREATE TABLE `tbl_contacto_paciente` (
  `Id_Contacto_Paciente` int(11) NOT NULL AUTO_INCREMENT,
  `Contacto_Paciente` varchar(50) NOT NULL,
  `Id_Paciente` int(11) NOT NULL,
  `Id_Tipo_Contacto` int(11) NOT NULL,
  PRIMARY KEY (`Id_Contacto_Paciente`),
  KEY `FK_ContactoPaciente_Paciente_idx` (`Id_Paciente`),
  KEY `FK_ContactoPaciente_TipoContacto_idx` (`Id_Tipo_Contacto`),
  KEY `Id_Paciente` (`Id_Paciente`),
  KEY `Id_Tipo_Contacto` (`Id_Tipo_Contacto`),
  CONSTRAINT `FK_ContactoPaciente_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ContactoPaciente_TipoContacto` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;




DROP TABLE IF EXISTS tbl_contacto_usuario;

CREATE TABLE `tbl_contacto_usuario` (
  `Id_Contacto_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Contacto_Usuario` varchar(50) NOT NULL,
  `Id_Tipo_Contacto` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`Id_Contacto_Usuario`),
  KEY `Id_Tipo_Contacto` (`Id_Tipo_Contacto`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `FK_ContactoUsuario_TipoContacto` FOREIGN KEY (`Id_Tipo_Contacto`) REFERENCES `tbl_tipo_contacto` (`Id_Tipo_Contacto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ContactoUsuario_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;




DROP TABLE IF EXISTS tbl_detalle_expediente;

CREATE TABLE `tbl_detalle_expediente` (
  `Id_Detalle_Expediente` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Evaluacion` datetime NOT NULL,
  `Lateralidad` varchar(50) NOT NULL,
  `Referido` varchar(50) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Cita_Terapia` int(11) NOT NULL,
  `Id_Expediente` int(11) NOT NULL,
  PRIMARY KEY (`Id_Detalle_Expediente`),
  KEY `FK_DetalleExpediente_Expediente_idx` (`Id_Expediente`),
  KEY `Id_Usuario` (`Id_Usuario`,`Id_Cita_Terapia`),
  KEY `FK_DetalleExpediente_CitaTerapeutica` (`Id_Cita_Terapia`),
  CONSTRAINT `FK_DetalleExpediente_CitaTerapeutica` FOREIGN KEY (`Id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetalleExpediente_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetalleExpediente_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_detalle_expediente VALUES("1","2024-08-06 22:25:51","0","0","5","4","14");
INSERT INTO tbl_detalle_expediente VALUES("2","2024-08-07 15:51:52","0","0","5","5","14");
INSERT INTO tbl_detalle_expediente VALUES("3","2024-08-07 16:37:03","0","0","5","9","14");



DROP TABLE IF EXISTS tbl_detalle_terapia;

CREATE TABLE `tbl_detalle_terapia` (
  `Id_Detalle_Terapia` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Sesiones` varchar(20) NOT NULL,
  `Fecha_Terapia` datetime NOT NULL,
  `Id_Cita_Terapia` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_Expediente` int(11) NOT NULL,
  PRIMARY KEY (`Id_Detalle_Terapia`),
  KEY `FK_DetalleTerapia_CitaTerapeutica` (`Id_Cita_Terapia`),
  KEY `FK_DetalleTerapia_Usuario` (`Id_Usuario`),
  KEY `FK_DetalleTerapia_Expediente` (`Id_Expediente`),
  CONSTRAINT `FK_DetalleTerapia_CitaTerapeutica` FOREIGN KEY (`Id_Cita_Terapia`) REFERENCES `tbl_cita_terapeutica` (`id_Cita_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetalleTerapia_Expediente` FOREIGN KEY (`Id_Expediente`) REFERENCES `tbl_expediente` (`id_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetalleTerapia_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_detalle_terapia VALUES("1","0","2024-08-06 22:27:13","4","5","14");
INSERT INTO tbl_detalle_terapia VALUES("2","0","2024-08-07 15:55:48","5","5","14");
INSERT INTO tbl_detalle_terapia VALUES("3","0","2024-08-07 16:37:24","9","5","14");



DROP TABLE IF EXISTS tbl_detalle_terapia_tratamiento;

CREATE TABLE `tbl_detalle_terapia_tratamiento` (
  `IdDetalleTerapiaTratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Detalle_Terapia` int(11) NOT NULL,
  `Id_Tipo_Terapia` int(11) NOT NULL,
  `Resultado` varchar(45) NOT NULL,
  PRIMARY KEY (`IdDetalleTerapiaTratamiento`),
  KEY `FK_TBL_DETALLE_TERAPIA_TRATAMIENTO_TBL_DETALLE_TERAPIA_idx` (`Id_Detalle_Terapia`),
  KEY `FK_DetalleTerapiaTratamiento_TipoTerapia` (`Id_Tipo_Terapia`) USING BTREE,
  CONSTRAINT `FK_DetTerTratamiento_DetalleTerapia` FOREIGN KEY (`Id_Detalle_Terapia`) REFERENCES `tbl_detalle_terapia` (`Id_Detalle_Terapia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DetTerTratamiento_TipoTerapia` FOREIGN KEY (`Id_Tipo_Terapia`) REFERENCES `tbl_tipo_terapia` (`idTipoTerapia`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_detalle_terapia_tratamiento VALUES("1","1","1","prueba");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("2","1","2","prueba");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("3","1","3","prueba");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("4","1","34","prueba1");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("5","1","35","prueba1");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("6","1","36","prueba1");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("7","2","1","redireccion");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("8","2","2","redireccion");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("9","2","3","redireccion");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("10","3","1","prueba3");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("11","3","2","prueba3");
INSERT INTO tbl_detalle_terapia_tratamiento VALUES("12","3","3","prueba3");



DROP TABLE IF EXISTS tbl_estado_cita;

CREATE TABLE `tbl_estado_cita` (
  `Id_Estado_Cita` int(11) NOT NULL AUTO_INCREMENT,
  `Estado_Cita` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_Estado_Cita`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_estado_cita VALUES("1","PENDIENTE");
INSERT INTO tbl_estado_cita VALUES("2","EN ESPERA");
INSERT INTO tbl_estado_cita VALUES("3","EN ATENCIÓN");
INSERT INTO tbl_estado_cita VALUES("4","FINALIZADO");
INSERT INTO tbl_estado_cita VALUES("5","CANCELADO");



DROP TABLE IF EXISTS tbl_estado_usuario;

CREATE TABLE `tbl_estado_usuario` (
  `Id_Estado` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(15) NOT NULL,
  PRIMARY KEY (`Id_Estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbl_estado_usuario VALUES("1","ACTIVO");
INSERT INTO tbl_estado_usuario VALUES("2","INACTIVO");
INSERT INTO tbl_estado_usuario VALUES("3","BLOQUEADO");



DROP TABLE IF EXISTS tbl_evaluacion;

CREATE TABLE `tbl_evaluacion` (
  `Id_Evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Evaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_evaluacion VALUES("1","HISTORIAL CLÍNICO");
INSERT INTO tbl_evaluacion VALUES("2","EXÁMEN FÍSICO");
INSERT INTO tbl_evaluacion VALUES("3","DIAGNÓSTICO");



DROP TABLE IF EXISTS tbl_expediente;

CREATE TABLE `tbl_expediente` (
  `id_Expediente` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha_Creacion` datetime NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `Id_Paciente` int(3) NOT NULL,
  PRIMARY KEY (`id_Expediente`),
  UNIQUE KEY `Id_Paciente_2` (`Id_Paciente`),
  KEY `fk_TBL_EXPEDIENTE_TBL_MS_USUARIO1_idx` (`id_Usuario`),
  KEY `Id_Paciente` (`Id_Paciente`),
  CONSTRAINT `FK_Expediente_Paciente` FOREIGN KEY (`Id_Paciente`) REFERENCES `tbl_paciente` (`Id_Paciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Expediente_Usuario` FOREIGN KEY (`id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_expediente VALUES("1","2024-08-02 06:07:23","1","1");
INSERT INTO tbl_expediente VALUES("14","2024-08-06 22:23:26","1","2");



DROP TABLE IF EXISTS tbl_genero;

CREATE TABLE `tbl_genero` (
  `IdGenero` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`IdGenero`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_genero VALUES("1","MASCULINO");
INSERT INTO tbl_genero VALUES("2","FEMENINO");



DROP TABLE IF EXISTS tbl_ms_hist_contrasena;

CREATE TABLE `tbl_ms_hist_contrasena` (
  `Id_Hist` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Usuario` int(11) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`Id_Hist`),
  KEY `FK_Contrasena_Usuario_idx` (`Id_Usuario`),
  CONSTRAINT `FK_HistorialContrasena_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;




DROP TABLE IF EXISTS tbl_ms_objetos;

CREATE TABLE `tbl_ms_objetos` (
  `Id_Objetos` int(11) NOT NULL AUTO_INCREMENT,
  `Objeto` varchar(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Tipo_Objeto` varchar(15) NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`Id_Objetos`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_ms_objetos VALUES("1","V_Paciente","Vista para agregar, eliminar y editar pacientes","Agregar Pacient","Administrador","2024-03-31 07:19:51","","2024-03-31 07:19:51");
INSERT INTO tbl_ms_objetos VALUES("2","V_modal_cita","Vista que permite agendar citas a los pacientes","Agendar Citas","Administrador","2024-03-31 07:19:51","","2024-03-31 07:19:51");
INSERT INTO tbl_ms_objetos VALUES("3","V_modal_expediente","Objeto que permite ver los expedientes y crear nuevos expedientes para los pacientes","Gestion Expedie","Administrador","2024-03-31 07:50:46","","2024-03-31 07:50:46");
INSERT INTO tbl_ms_objetos VALUES("4","V_modal_historial_cita","Permite ver el historial de las citas de un expediente","Administrador","Administrador","2024-03-31 07:50:46","","2024-03-31 07:50:46");
INSERT INTO tbl_ms_objetos VALUES("5","V_usuario","Vista para agregar, eliminar y editar Usuarios","Crear usuarios","Administrador","2024-03-31 07:53:51","","2024-03-31 07:53:51");
INSERT INTO tbl_ms_objetos VALUES("6","V_roles","Objeto para crear y eliminar roles","Secretaria","Administrador","2024-03-31 07:53:51","","2024-03-31 07:53:51");
INSERT INTO tbl_ms_objetos VALUES("7","V_permisos","Permite asignar permisos a los roles.","Fisiatra","Fisiatra","2024-03-31 07:55:44","","2024-03-31 07:55:44");
INSERT INTO tbl_ms_objetos VALUES("8","Bitacora.php","Objeto que registra la bitacora del sistema","Fisiatra","Administrador","2024-03-31 07:55:44","","2024-03-31 07:55:44");
INSERT INTO tbl_ms_objetos VALUES("9","V_modal_parametros","Objeto para gestionar parámetros del sistema","Administrador","Administrador","2024-03-31 07:58:24","","2024-03-31 07:58:24");
INSERT INTO tbl_ms_objetos VALUES("10","V_modal_evaluacion","Mantenimiento de Expediente Clinico","Administrador","Administrador","2024-03-31 07:58:24","","2024-03-31 07:58:24");
INSERT INTO tbl_ms_objetos VALUES("11","V_modal_terapeutico","Mantenimiento del expediente Terapeutico","","Administrador","2024-04-14 22:19:12","","2024-04-14 22:19:12");
INSERT INTO tbl_ms_objetos VALUES("12","V_modal_identidad","Mantenimiento de los tipos de documentos","","Administrador","2024-04-14 22:19:12","","2024-04-14 22:19:12");
INSERT INTO tbl_ms_objetos VALUES("13","Main","Vista principal del main","","Administrador","2024-04-15 10:22:02","","2024-04-15 10:22:02");
INSERT INTO tbl_ms_objetos VALUES("14","V_modal_estado_usuario","MANTENIMIENTO PARA LOS ESTADOS DE USUARIOS","","","2024-08-08 06:21:49","","2024-08-08 06:21:49");
INSERT INTO tbl_ms_objetos VALUES("15","V_modal_estado_cita","MANTENIMIENTO PARA LOS ESTADOS DE CITAS","","","2024-08-08 06:21:49","","2024-08-08 06:21:49");
INSERT INTO tbl_ms_objetos VALUES("16","V_modal_tipo_cita","MANTENIMIENTO PARA LOS TIPOS DE CITAS","","","2024-08-08 06:21:49","","2024-08-08 06:21:49");
INSERT INTO tbl_ms_objetos VALUES("17","V_modal_genero","MANTENIMIENTO PARA LOS GÉNEROS DE USUARIOS","","","2024-08-08 06:21:49","","2024-08-08 06:21:49");
INSERT INTO tbl_ms_objetos VALUES("18","V_respaldo","MÓDULO PARA CREAR RESPALDO DE LA BASE DE DATOS","","","2024-08-08 06:21:49","","2024-08-08 06:21:49");
INSERT INTO tbl_ms_objetos VALUES("19","V_restore","MÓDULO PARA RESTAURAR LA BASE DE DATOS","","","2024-08-08 06:21:49","","2024-08-08 06:21:49");



DROP TABLE IF EXISTS tbl_ms_parametros;

CREATE TABLE `tbl_ms_parametros` (
  `Id_Parametro` int(11) NOT NULL AUTO_INCREMENT,
  `Parametro` varchar(50) NOT NULL,
  `Valor` varchar(100) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`Id_Parametro`),
  KEY `FK_Parametros_Usuario_idx` (`Id_Usuario`),
  CONSTRAINT `FK_Parametros_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_ms_parametros VALUES("1","CANT_MIN_CLAVE","10","1","2024-03-01 05:08:58","15","2024-03-26 21:13:58");
INSERT INTO tbl_ms_parametros VALUES("2","CANT_MAX_CLAVE","35","1","2024-03-01 05:08:58","15","2024-03-18 03:26:05");
INSERT INTO tbl_ms_parametros VALUES("3","Servidor_SMTP","smtp.gmail.com","1","2024-03-14 06:24:31","15","2024-03-18 13:41:34");
INSERT INTO tbl_ms_parametros VALUES("4","Correo_SMTP","redelectrodiagnostico@gmail.com","1","2024-03-14 06:24:31","1","2024-03-14 06:24:31");
INSERT INTO tbl_ms_parametros VALUES("5","Clave_SMTP","avvg ofcb bqzm wbrv","1","2024-03-14 06:24:31","1","2024-03-14 06:24:31");
INSERT INTO tbl_ms_parametros VALUES("6","Cifrado_SMTP","SSL","1","2024-03-14 06:24:31","1","2024-03-14 06:24:31");
INSERT INTO tbl_ms_parametros VALUES("7","Puerto_SMTP","587","1","2024-03-14 06:24:31","1","2024-03-14 06:24:31");
INSERT INTO tbl_ms_parametros VALUES("8","Nombre_Sistema","Clinica Red","1","2024-04-12 06:36:54","1","2024-04-12 06:36:54");
INSERT INTO tbl_ms_parametros VALUES("10","INTENTOS_FALLIDOS","3","1","2024-08-08 09:06:06","1","2024-08-08 09:06:06");



DROP TABLE IF EXISTS tbl_ms_permisos;

CREATE TABLE `tbl_ms_permisos` (
  `Id_Permisos` int(3) NOT NULL AUTO_INCREMENT,
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
  `Fecha_Creacion` datetime NOT NULL,
  PRIMARY KEY (`Id_Permisos`),
  KEY `FK_Permisos_Roles_idx` (`Id_Rol`),
  KEY `FK_Permisos_Objetos_idx` (`Id_Objeto`),
  CONSTRAINT `FK_Permisos_Objetos` FOREIGN KEY (`Id_Objeto`) REFERENCES `tbl_ms_objetos` (`Id_Objetos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Permisos_Roles` FOREIGN KEY (`Id_Rol`) REFERENCES `tbl_ms_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_ms_permisos VALUES("1","1","1","1","1","1","1","1","1","1","Administrador","2024-03-31 09:08:39");
INSERT INTO tbl_ms_permisos VALUES("2","1","2","1","1","1","1","1","1","1","Administrador","2024-03-31 09:08:39");
INSERT INTO tbl_ms_permisos VALUES("3","1","3","1","1","1","1","1","1","1","Administrador","2024-04-14 22:40:05");
INSERT INTO tbl_ms_permisos VALUES("4","1","4","1","1","1","1","1","1","1","Administrador","2024-04-14 22:40:05");
INSERT INTO tbl_ms_permisos VALUES("5","1","5","1","1","1","1","1","1","1","Administrador","2024-03-31 09:11:42");
INSERT INTO tbl_ms_permisos VALUES("6","1","6","1","1","1","1","1","1","1","Administrador","2024-03-31 09:11:42");
INSERT INTO tbl_ms_permisos VALUES("7","1","7","1","1","1","1","1","1","1","Administrador","2024-03-31 09:17:23");
INSERT INTO tbl_ms_permisos VALUES("8","1","8","1","1","1","1","1","1","1","Administrador","2024-04-01 02:38:44");
INSERT INTO tbl_ms_permisos VALUES("9","1","9","1","1","1","1","1","1","1","Administrador","2024-04-01 02:38:44");
INSERT INTO tbl_ms_permisos VALUES("10","1","10","1","1","1","1","1","1","1","Administrador","2024-04-01 02:44:39");
INSERT INTO tbl_ms_permisos VALUES("11","1","11","1","1","1","1","1","1","1","Administrador","2024-04-01 02:44:39");
INSERT INTO tbl_ms_permisos VALUES("12","1","12","1","1","1","1","1","1","1","Administrador","2024-04-01 02:45:57");
INSERT INTO tbl_ms_permisos VALUES("13","1","13","1","1","1","1","1","1","1","Administrador","2024-04-01 02:45:57");
INSERT INTO tbl_ms_permisos VALUES("14","1","14","1","1","1","1","1","1","1","Administrador","2024-04-01 02:48:45");
INSERT INTO tbl_ms_permisos VALUES("15","1","15","1","1","1","1","1","1","1","Administrador","2024-04-01 02:48:45");
INSERT INTO tbl_ms_permisos VALUES("16","1","16","1","1","1","1","1","1","1","Administrador","2024-04-01 02:50:34");
INSERT INTO tbl_ms_permisos VALUES("17","1","17","1","1","1","1","1","1","1","Administrador","2024-04-01 02:50:34");
INSERT INTO tbl_ms_permisos VALUES("18","1","18","1","1","1","1","1","1","1","Administrador","2024-04-01 02:52:13");
INSERT INTO tbl_ms_permisos VALUES("19","1","19","1","1","1","1","1","1","1","Administrador","2024-04-01 02:52:13");
INSERT INTO tbl_ms_permisos VALUES("20","2","1","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("21","2","2","0","0","0","0","0","0","0","Administrador","2024-04-01 02:55:41");
INSERT INTO tbl_ms_permisos VALUES("22","2","3","0","0","0","0","0","0","0","Administrador","2024-04-01 02:56:31");
INSERT INTO tbl_ms_permisos VALUES("23","2","4","0","0","0","0","0","0","0","Administrador","2024-04-01 02:56:31");
INSERT INTO tbl_ms_permisos VALUES("24","2","5","0","0","0","0","0","0","0","Administrador","2024-04-01 02:58:53");
INSERT INTO tbl_ms_permisos VALUES("25","2","6","0","0","0","0","0","0","0","Administrador","2024-04-01 02:58:53");
INSERT INTO tbl_ms_permisos VALUES("26","2","7","0","0","0","0","0","0","0","Administrador","2024-04-01 02:59:47");
INSERT INTO tbl_ms_permisos VALUES("27","2","8","0","0","0","0","0","0","0","Administrador","2024-04-01 02:59:48");
INSERT INTO tbl_ms_permisos VALUES("28","2","9","0","0","0","0","0","0","0","Administrador","2024-04-01 03:15:59");
INSERT INTO tbl_ms_permisos VALUES("29","2","10","0","0","0","0","0","0","0","Administrador","2024-04-01 03:15:59");
INSERT INTO tbl_ms_permisos VALUES("30","2","11","0","0","0","0","0","0","0","Administrador","2024-04-01 03:17:26");
INSERT INTO tbl_ms_permisos VALUES("31","2","12","0","0","0","0","0","0","0","Administrador","2024-04-01 03:17:26");
INSERT INTO tbl_ms_permisos VALUES("32","2","13","0","0","0","0","0","0","0","Administrador","2024-04-01 03:20:33");
INSERT INTO tbl_ms_permisos VALUES("33","2","14","0","0","0","0","0","0","0","Administrador","2024-04-01 03:20:33");
INSERT INTO tbl_ms_permisos VALUES("34","2","15","0","0","0","0","0","0","0","Administrador","2024-04-01 03:25:57");
INSERT INTO tbl_ms_permisos VALUES("35","2","16","0","0","0","0","0","0","0","Administrador","2024-04-01 03:25:57");
INSERT INTO tbl_ms_permisos VALUES("36","2","17","0","0","0","0","0","0","0","Administrador","2024-04-01 03:33:45");
INSERT INTO tbl_ms_permisos VALUES("37","2","18","0","0","0","0","0","0","0","Administrador","2024-04-01 03:33:45");
INSERT INTO tbl_ms_permisos VALUES("38","2","19","0","0","0","0","0","0","0","Administrador","2024-04-01 03:46:28");
INSERT INTO tbl_ms_permisos VALUES("39","3","1","0","0","0","0","0","0","0","Administrador","2024-04-01 03:46:28");
INSERT INTO tbl_ms_permisos VALUES("40","3","2","0","0","0","0","0","0","0","Administrador","2024-04-01 03:49:43");
INSERT INTO tbl_ms_permisos VALUES("41","3","3","0","0","0","0","0","1","1","Administrador","2024-03-31 09:07:32");
INSERT INTO tbl_ms_permisos VALUES("42","3","4","0","0","0","0","0","0","0","Administrador","2024-04-01 03:51:21");
INSERT INTO tbl_ms_permisos VALUES("43","3","5","0","0","0","0","0","0","0","Administrador","2024-04-01 03:51:21");
INSERT INTO tbl_ms_permisos VALUES("44","3","6","0","0","0","0","0","0","0","Administrador","2024-04-01 03:56:35");
INSERT INTO tbl_ms_permisos VALUES("45","3","7","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("46","3","8","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("47","3","9","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("48","3","10","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("49","3","11","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("50","3","12","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("51","3","13","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("52","3","14","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("53","3","15","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("54","3","16","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("55","3","17","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("56","3","18","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("57","3","19","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("58","4","1","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("59","4","2","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("60","4","3","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("61","4","4","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("62","4","5","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("63","4","6","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("64","4","7","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("65","4","8","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("66","4","9","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("67","4","10","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("68","4","11","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("69","4","12","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("70","4","13","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("71","4","14","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("72","4","15","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("73","4","16","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("74","4","17","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("75","4","18","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("76","4","19","1","1","1","1","1","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("77","5","1","1","1","1","1","1","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("78","5","2","1","1","1","1","1","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("79","5","3","1","0","0","1","1","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("80","5","4","0","0","0","0","0","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("81","5","5","0","0","0","0","0","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("82","5","6","0","0","0","0","0","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("83","5","7","0","0","0","0","0","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("84","5","8","0","0","0","0","0","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("85","5","9","0","0","0","0","0","1","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("86","5","10","0","0","0","0","0","1","1","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("87","5","11","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("88","5","12","0","0","0","0","0","0","0","Administrador","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("89","5","13","1","1","1","1","1","0","0","","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("90","5","14","0","0","0","0","0","0","0","","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("91","5","15","0","0","0","0","0","0","1","","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("92","5","16","0","0","0","0","0","1","0","","0000-00-00 00:00:00");
INSERT INTO tbl_ms_permisos VALUES("93","5","17","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("94","5","18","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("95","5","19","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("96","6","1","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("97","6","2","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("98","6","3","1","1","1","1","1","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("99","6","4","1","1","1","1","1","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("100","6","5","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("101","6","6","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("102","6","7","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("103","6","8","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("104","6","9","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("105","6","10","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("106","6","11","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("107","6","12","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("108","6","13","1","1","1","1","1","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("109","6","14","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("110","6","15","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("111","6","16","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("112","6","17","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("113","6","18","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("114","6","19","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("115","7","1","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("116","7","2","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("117","7","3","0","0","0","1","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("118","7","4","0","0","0","1","1","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("119","7","5","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("120","7","6","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("121","7","7","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("122","7","8","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("123","7","9","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("124","7","10","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("125","7","11","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("126","7","12","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("127","7","13","1","1","1","1","1","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("128","7","14","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("129","7","15","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("130","7","16","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("131","7","17","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("132","7","18","0","0","0","0","0","0","0","","2024-08-08 07:05:31");
INSERT INTO tbl_ms_permisos VALUES("133","7","19","0","0","0","0","0","0","0","","2024-08-08 07:05:31");



DROP TABLE IF EXISTS tbl_ms_roles;

CREATE TABLE `tbl_ms_roles` (
  `Id_Rol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` varchar(30) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`Id_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_ms_roles VALUES("1","SUPERADMINISTRADOR","TIENE ACCESO A TODO EL SISTEMA","1","2024-02-13 05:01:09","1","2024-02-13 05:01:09");
INSERT INTO tbl_ms_roles VALUES("2","DEFECTO","ROL ESPECÍFICO PARA EL AUTOREGISTRO","1","2024-03-04 00:38:03","1","2024-03-04 00:38:03");
INSERT INTO tbl_ms_roles VALUES("3","USUARIO","CAMBIA DE DEFECTO A USUARIO PARA VISUALIZAR EL MAIN","1","2024-03-04 21:39:12","1","2024-03-04 21:39:12");
INSERT INTO tbl_ms_roles VALUES("4","ADMINISTRADOR","ADMINISTRACION GENERAL DEL SISTEMA","1","2024-03-14 05:16:59","1","2024-03-14 05:16:59");
INSERT INTO tbl_ms_roles VALUES("5","SECRETARIA","ACCESO A GESTION DE CITAS","1","2024-03-14 05:16:59","1","2024-03-14 05:16:59");
INSERT INTO tbl_ms_roles VALUES("6","FISIATRA","ACCESO A AGENDA Y EXPEDIENTES","1","2024-03-27 22:30:54","1","2024-03-27 22:30:54");
INSERT INTO tbl_ms_roles VALUES("7","TERAPEUTA","SOLO VISUALIZAR EXPEDIENTES","1","2024-03-27 22:30:54","1","2024-03-27 22:30:54");
INSERT INTO tbl_ms_roles VALUES("8","RECEPCIONISTA","RECIBE A LOS NUEVOS PACIENTES DE LA CLINICA.","","2024-08-02 07:00:28","","0000-00-00 00:00:00");
INSERT INTO tbl_ms_roles VALUES("17","PRUEBA2","PRUEBA23","","2024-08-08 09:07:30","","0000-00-00 00:00:00");



DROP TABLE IF EXISTS tbl_ms_usuario;

CREATE TABLE `tbl_ms_usuario` (
  `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `DNI` varchar(13) DEFAULT NULL,
  `Usuario` varchar(15) DEFAULT NULL,
  `Correo` varchar(40) DEFAULT NULL,
  `Nombre` varchar(80) DEFAULT NULL,
  `Direccion` varchar(80) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `FechaContratacion` date DEFAULT NULL,
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
  `FechaExpiracionOTP` datetime DEFAULT NULL,
  `intentos_fallidos` int(1) NOT NULL,
  PRIMARY KEY (`Id_Usuario`),
  KEY `FK_Empleado_Genero_idx` (`IdGenero`),
  KEY `FK_Usuario_Rol_idx` (`IdRol`),
  KEY `Estado_Usuario` (`Estado_Usuario`),
  CONSTRAINT `FK_Usuario_EstadoUsuario` FOREIGN KEY (`Estado_Usuario`) REFERENCES `tbl_estado_usuario` (`Id_Estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Usuario_Genero` FOREIGN KEY (`IdGenero`) REFERENCES `tbl_genero` (`IdGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Usuario_Rol` FOREIGN KEY (`IdRol`) REFERENCES `tbl_ms_roles` (`Id_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_ms_usuario VALUES("1","0802200289432","ADMIN","redelectrodiagnostico@gmail.com","CLÍNICA RED","SPS","2024-03-02","2024-03-04","1","d2a1e5441f59e167f290d9cd79796ebc","1","1","1","2024-03-04 22:25:06","2024-03-10 20:22:09","0000-00-00","","0000-00-00 00:00:00","0","537844","2024-04-12 15:09:39","0");
INSERT INTO tbl_ms_usuario VALUES("2","0801213456723","MANA","fisiatra@gmail.com","MARIANA","FRANCISCO MORAZáN","1980-02-02","2020-10-03","1","74f7f9967c24aaf6ed06b833de5abebc","2","2","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00","","2024-08-02 06:12:43","0","0","0000-00-00 00:00:00","0");
INSERT INTO tbl_ms_usuario VALUES("3","1234567898889","DEDGUEVARA","dediazg@unah.hnn","DULCE","TEGUCIGALPA","2000-03-02","2020-03-03","1","dd321ef531691a1c9dc61d5a45887bf1","3","2","0","0000-00-00 00:00:00","0000-00-00 00:00:00","0000-00-00","","2024-08-02 06:34:08","0","0","0000-00-00 00:00:00","0");
INSERT INTO tbl_ms_usuario VALUES("5","0801200118740","JDUARTE","anthonyduarte504@gmail.com","ANTHONY DUARTE","UNAH","2001-10-03","2020-10-03","1","d2a1e5441f59e167f290d9cd79796ebc","4","1","1","0000-00-00 00:00:00","2024-08-02 22:08:40","0000-00-00","","2024-08-02 22:08:18","0","0","0000-00-00 00:00:00","0");



DROP TABLE IF EXISTS tbl_paciente;

CREATE TABLE `tbl_paciente` (
  `Id_Paciente` int(11) NOT NULL AUTO_INCREMENT,
  `Numero_Documento` varchar(15) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Direccion` varchar(80) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `IdGenero` int(11) NOT NULL,
  `Id_Tipo_Documento` int(11) NOT NULL,
  `Ocupacion` varchar(50) NOT NULL,
  `Estado_Paciente` tinyint(2) NOT NULL,
  PRIMARY KEY (`Id_Paciente`),
  KEY `FK_Paciente_Genero_idx` (`IdGenero`),
  KEY `FK_Paciente_TipoDocumento_idx` (`Id_Tipo_Documento`),
  CONSTRAINT `FK_TBL_DOCUMENTO_TBL_PACIENTE` FOREIGN KEY (`Id_Tipo_Documento`) REFERENCES `tbl_tipo_documento` (`Id_Tipo_Documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TBL_GENERO_TBL_PACIENTE` FOREIGN KEY (`IdGenero`) REFERENCES `tbl_genero` (`IdGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_paciente VALUES("1","145678943","ETHEL","TEGUCIGALPA","2000-04-04","2","2","ESTUDIANTE","1");
INSERT INTO tbl_paciente VALUES("2","0801200118740","ANTHONY DUARTE","UNAH","2001-10-03","1","1","ESTUDIANTE","1");



DROP TABLE IF EXISTS tbl_pin;

CREATE TABLE `tbl_pin` (
  `Id_Pin` int(11) NOT NULL AUTO_INCREMENT,
  `Pin` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Fecha_Creacion` datetime NOT NULL,
  `Creado_Por` varchar(15) NOT NULL,
  `Modificado_Por` varchar(15) NOT NULL,
  `Fecha_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`Id_Pin`),
  KEY `FK_PreguntasUsuario_Usuario_idx` (`Id_Usuario`),
  KEY `Id_Usuario` (`Id_Usuario`),
  CONSTRAINT `FK_Pin_Usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `tbl_ms_usuario` (`Id_Usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;




DROP TABLE IF EXISTS tbl_resultado_evaluacion;

CREATE TABLE `tbl_resultado_evaluacion` (
  `Id_Resultado_Evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL,
  `Id_Evaluacion` int(5) NOT NULL,
  PRIMARY KEY (`Id_Resultado_Evaluacion`),
  KEY `fk_TBL_RESULTADO_EVALUACION_TBL_EVALUACION` (`Id_Evaluacion`),
  CONSTRAINT `fk_RESULTADO_EVALUACION_EVALUACION` FOREIGN KEY (`Id_Evaluacion`) REFERENCES `tbl_evaluacion` (`Id_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_resultado_evaluacion VALUES("1","HEA","1");
INSERT INTO tbl_resultado_evaluacion VALUES("2","FOG","1");
INSERT INTO tbl_resultado_evaluacion VALUES("3","APP","1");
INSERT INTO tbl_resultado_evaluacion VALUES("4","AHxDxQx","1");
INSERT INTO tbl_resultado_evaluacion VALUES("5","AIA","1");
INSERT INTO tbl_resultado_evaluacion VALUES("6","AVD","1");
INSERT INTO tbl_resultado_evaluacion VALUES("7","PA","2");
INSERT INTO tbl_resultado_evaluacion VALUES("8","FC","2");
INSERT INTO tbl_resultado_evaluacion VALUES("9","SatO2","2");
INSERT INTO tbl_resultado_evaluacion VALUES("10","PESO","2");
INSERT INTO tbl_resultado_evaluacion VALUES("11","IDx","3");
INSERT INTO tbl_resultado_evaluacion VALUES("12","INDICACIONES MÉDICAS","3");



DROP TABLE IF EXISTS tbl_resultado_expediente;

CREATE TABLE `tbl_resultado_expediente` (
  `Id_Resultado_Expediente` int(11) NOT NULL AUTO_INCREMENT,
  `Id_Resultado_Evaluacion` int(11) NOT NULL,
  `Id_Detalle_Expediente` int(11) NOT NULL,
  `Resultado` varchar(80) NOT NULL,
  PRIMARY KEY (`Id_Resultado_Expediente`),
  KEY `FK_ResultadoExpediente_ResultadoEvaluacion_idx` (`Id_Resultado_Evaluacion`),
  KEY `FK_ResultadoExpediente_DetalleExpediente_idx` (`Id_Detalle_Expediente`),
  CONSTRAINT `FK_ResultadoExpediente_DetalleExpediente` FOREIGN KEY (`Id_Detalle_Expediente`) REFERENCES `tbl_detalle_expediente` (`Id_Detalle_Expediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ResultadoExpediente_ResultadoEvaluacion` FOREIGN KEY (`Id_Resultado_Evaluacion`) REFERENCES `tbl_resultado_evaluacion` (`Id_Resultado_Evaluacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_resultado_expediente VALUES("1","1","1","prueba1");
INSERT INTO tbl_resultado_expediente VALUES("2","2","1","prueba1");
INSERT INTO tbl_resultado_expediente VALUES("3","3","1","prueba1");
INSERT INTO tbl_resultado_expediente VALUES("4","11","1","prueba");
INSERT INTO tbl_resultado_expediente VALUES("5","12","1","prueba");
INSERT INTO tbl_resultado_expediente VALUES("6","1","2","redireccion");
INSERT INTO tbl_resultado_expediente VALUES("7","2","2","redireccion");
INSERT INTO tbl_resultado_expediente VALUES("8","3","2","redireccion");
INSERT INTO tbl_resultado_expediente VALUES("9","1","3","prueba");
INSERT INTO tbl_resultado_expediente VALUES("10","2","3","prueba");
INSERT INTO tbl_resultado_expediente VALUES("11","3","3","prueba");



DROP TABLE IF EXISTS tbl_tipo_cita;

CREATE TABLE `tbl_tipo_cita` (
  `Id_Tipo_Cita` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_Tipo_Cita`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_tipo_cita VALUES("1","DIAGNÓSTICO");
INSERT INTO tbl_tipo_cita VALUES("2","TERAPIA");



DROP TABLE IF EXISTS tbl_tipo_contacto;

CREATE TABLE `tbl_tipo_contacto` (
  `Id_Tipo_Contacto` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id_Tipo_Contacto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;




DROP TABLE IF EXISTS tbl_tipo_documento;

CREATE TABLE `tbl_tipo_documento` (
  `Id_Tipo_Documento` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id_Tipo_Documento`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_tipo_documento VALUES("1","IDENTIDAD");
INSERT INTO tbl_tipo_documento VALUES("2","PASAPORTE");
INSERT INTO tbl_tipo_documento VALUES("3","IDENTIDAD EXTRANJERA");



DROP TABLE IF EXISTS tbl_tipo_terapia;

CREATE TABLE `tbl_tipo_terapia` (
  `idTipoTerapia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Id_Tipo_Tratamiento` int(11) NOT NULL,
  PRIMARY KEY (`idTipoTerapia`),
  KEY `FK_TipoTerapia_TipoTratamiento_idx` (`Id_Tipo_Tratamiento`),
  CONSTRAINT `FK_TipoTerapia_TipoTratamiento` FOREIGN KEY (`Id_Tipo_Tratamiento`) REFERENCES `tbl_tipo_tratamiento` (`Id_Tipo_Tratamiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_tipo_terapia VALUES("1","ÁREA","1");
INSERT INTO tbl_tipo_terapia VALUES("2","TIEMPO","1");
INSERT INTO tbl_tipo_terapia VALUES("3","PROTOCOLO/DOSIS","1");
INSERT INTO tbl_tipo_terapia VALUES("4","COMPRESA CALIENTE","2");
INSERT INTO tbl_tipo_terapia VALUES("5","COMPRESA FRÍA","2");
INSERT INTO tbl_tipo_terapia VALUES("6","CONTRASTE","2");
INSERT INTO tbl_tipo_terapia VALUES("7","PARAFINA","2");
INSERT INTO tbl_tipo_terapia VALUES("8","TINA MANO/PIE","2");
INSERT INTO tbl_tipo_terapia VALUES("9","ÁREA","2");
INSERT INTO tbl_tipo_terapia VALUES("10","TIEMPO","2");
INSERT INTO tbl_tipo_terapia VALUES("11","OBSERVACIÓN","2");
INSERT INTO tbl_tipo_terapia VALUES("12","RELAJANTE","3");
INSERT INTO tbl_tipo_terapia VALUES("13","ESTIMULANTE","3");
INSERT INTO tbl_tipo_terapia VALUES("14","LIBERAR ADHERENCIAS","3");
INSERT INTO tbl_tipo_terapia VALUES("15","DESCARGA","3");
INSERT INTO tbl_tipo_terapia VALUES("16","DRENAJE LINFÁTICO","3");
INSERT INTO tbl_tipo_terapia VALUES("17","ÁREA","3");
INSERT INTO tbl_tipo_terapia VALUES("18","OBSERVACIÓN","3");
INSERT INTO tbl_tipo_terapia VALUES("19","TENS","4");
INSERT INTO tbl_tipo_terapia VALUES("20","ALTO VOLT","4");
INSERT INTO tbl_tipo_terapia VALUES("21","IF","4");
INSERT INTO tbl_tipo_terapia VALUES("22","Bi","4");
INSERT INTO tbl_tipo_terapia VALUES("23","Te","4");
INSERT INTO tbl_tipo_terapia VALUES("24","VMS","4");
INSERT INTO tbl_tipo_terapia VALUES("25","RUSAS","4");
INSERT INTO tbl_tipo_terapia VALUES("26","GALVÁNICA","4");
INSERT INTO tbl_tipo_terapia VALUES("27","PUNTERO","4");
INSERT INTO tbl_tipo_terapia VALUES("28","MICROCORRIENTE","4");
INSERT INTO tbl_tipo_terapia VALUES("29","COMPEX","4");
INSERT INTO tbl_tipo_terapia VALUES("30","DOSIS","4");
INSERT INTO tbl_tipo_terapia VALUES("31","TIEMPO","4");
INSERT INTO tbl_tipo_terapia VALUES("32","ÁREA","4");
INSERT INTO tbl_tipo_terapia VALUES("33","OBSERVACIÓN","4");
INSERT INTO tbl_tipo_terapia VALUES("34","COMBINADO","5");
INSERT INTO tbl_tipo_terapia VALUES("35","PULSÁTIL%","5");
INSERT INTO tbl_tipo_terapia VALUES("36","CONTINUO","5");
INSERT INTO tbl_tipo_terapia VALUES("37","WATTS","5");
INSERT INTO tbl_tipo_terapia VALUES("38","Mhz","5");
INSERT INTO tbl_tipo_terapia VALUES("39","TIEMPO","5");
INSERT INTO tbl_tipo_terapia VALUES("40","ÁREA","5");
INSERT INTO tbl_tipo_terapia VALUES("41","OBSERVACIÓN","5");
INSERT INTO tbl_tipo_terapia VALUES("42","JULIOS","6");
INSERT INTO tbl_tipo_terapia VALUES("43","Hz","6");
INSERT INTO tbl_tipo_terapia VALUES("44","MIN/Pto","6");
INSERT INTO tbl_tipo_terapia VALUES("45","Ptos","6");
INSERT INTO tbl_tipo_terapia VALUES("46","OBSERVACIÓN","6");
INSERT INTO tbl_tipo_terapia VALUES("47","PASIVA","7");
INSERT INTO tbl_tipo_terapia VALUES("48","A-A","7");
INSERT INTO tbl_tipo_terapia VALUES("49","A-L","7");
INSERT INTO tbl_tipo_terapia VALUES("50","GENTIL","7");
INSERT INTO tbl_tipo_terapia VALUES("51","FORZADA","7");
INSERT INTO tbl_tipo_terapia VALUES("52","ÁREA","7");
INSERT INTO tbl_tipo_terapia VALUES("53","OBSERVACIÓN","7");
INSERT INTO tbl_tipo_terapia VALUES("54","CERVICAL","8");
INSERT INTO tbl_tipo_terapia VALUES("55","PÉLVICA","8");
INSERT INTO tbl_tipo_terapia VALUES("56","INTERMITENTE","8");
INSERT INTO tbl_tipo_terapia VALUES("57","CONTINUA","8");
INSERT INTO tbl_tipo_terapia VALUES("58","MANTENER","8");
INSERT INTO tbl_tipo_terapia VALUES("59","seg/Descanso","8");
INSERT INTO tbl_tipo_terapia VALUES("60","PESO Min","8");
INSERT INTO tbl_tipo_terapia VALUES("61","LB/MAX","8");
INSERT INTO tbl_tipo_terapia VALUES("62","TIEMPO","8");
INSERT INTO tbl_tipo_terapia VALUES("63","AUMENTO GRADUAL","8");
INSERT INTO tbl_tipo_terapia VALUES("64","OBSERVACIÓN","8");
INSERT INTO tbl_tipo_terapia VALUES("65","RUEDA DE HOMBRO","9");
INSERT INTO tbl_tipo_terapia VALUES("66","ESCALERILLA","9");
INSERT INTO tbl_tipo_terapia VALUES("67","PATÍN","9");
INSERT INTO tbl_tipo_terapia VALUES("68","ESTABILIZACIÓN ESCAPULAR","9");
INSERT INTO tbl_tipo_terapia VALUES("69","POLEA S/PESO","9");
INSERT INTO tbl_tipo_terapia VALUES("70","POLEA C/PESO","9");
INSERT INTO tbl_tipo_terapia VALUES("71","ESCALERA BILATERAL","9");
INSERT INTO tbl_tipo_terapia VALUES("72","OBSERVACIÓN","9");
INSERT INTO tbl_tipo_terapia VALUES("73","D","10");
INSERT INTO tbl_tipo_terapia VALUES("74","I","10");
INSERT INTO tbl_tipo_terapia VALUES("75","BILAT","10");
INSERT INTO tbl_tipo_terapia VALUES("76","MANGA","10");
INSERT INTO tbl_tipo_terapia VALUES("77","BOTA","10");
INSERT INTO tbl_tipo_terapia VALUES("78","(A) DESCARGA MUSCULAR","10");
INSERT INTO tbl_tipo_terapia VALUES("79","(B) MASAJE","10");
INSERT INTO tbl_tipo_terapia VALUES("80","(C) VASCULAR/LINFÁTICO","10");
INSERT INTO tbl_tipo_terapia VALUES("81","PRESIÓN mmHg","10");
INSERT INTO tbl_tipo_terapia VALUES("82","TIEMPO","10");
INSERT INTO tbl_tipo_terapia VALUES("83","OBSERVACIÓN","10");
INSERT INTO tbl_tipo_terapia VALUES("84","ÁREA","11");
INSERT INTO tbl_tipo_terapia VALUES("85","TIEMPO","11");
INSERT INTO tbl_tipo_terapia VALUES("86","PROTOCOLO/DOSIS","11");
INSERT INTO tbl_tipo_terapia VALUES("87","APLICADOR","11");
INSERT INTO tbl_tipo_terapia VALUES("88","GUANTE","11");
INSERT INTO tbl_tipo_terapia VALUES("89","OBSERVACIÓN","11");
INSERT INTO tbl_tipo_terapia VALUES("90","ESTIRAMIENTO","12");
INSERT INTO tbl_tipo_terapia VALUES("91","MÚSCULOS","12");
INSERT INTO tbl_tipo_terapia VALUES("92","FOAM ROLLER","12");
INSERT INTO tbl_tipo_terapia VALUES("93","MÍMICA FACIAL","12");
INSERT INTO tbl_tipo_terapia VALUES("94","FORTALECIMIENTO ISOMÉTRICO","12");
INSERT INTO tbl_tipo_terapia VALUES("95","A-L","12");
INSERT INTO tbl_tipo_terapia VALUES("96","PROGRESIVO RESISTIDO MANUAL","12");
INSERT INTO tbl_tipo_terapia VALUES("97","PROGRESIVO RESISTIVO","12");
INSERT INTO tbl_tipo_terapia VALUES("98","BANDAS","12");
INSERT INTO tbl_tipo_terapia VALUES("99","PESAS","12");
INSERT INTO tbl_tipo_terapia VALUES("100","EXCÉNTRICOS","12");
INSERT INTO tbl_tipo_terapia VALUES("101","MÚSCULOS","12");
INSERT INTO tbl_tipo_terapia VALUES("102","No. SETS","12");
INSERT INTO tbl_tipo_terapia VALUES("103","REPETICIONES","12");
INSERT INTO tbl_tipo_terapia VALUES("104","FORTALECIMIENTO LUMBOPÉLVICO","12");
INSERT INTO tbl_tipo_terapia VALUES("105","REEDUCACIÓN MUSCULAR","12");
INSERT INTO tbl_tipo_terapia VALUES("106","OBSERVACIÓN","12");
INSERT INTO tbl_tipo_terapia VALUES("107","CAMINADORA","13");
INSERT INTO tbl_tipo_terapia VALUES("108","ELÍPTICA","13");
INSERT INTO tbl_tipo_terapia VALUES("109","BICI ESTAC","13");
INSERT INTO tbl_tipo_terapia VALUES("110","BICI","13");
INSERT INTO tbl_tipo_terapia VALUES("111","TIEMPO","13");
INSERT INTO tbl_tipo_terapia VALUES("112","RESISTENCIA","3");
INSERT INTO tbl_tipo_terapia VALUES("113","PESO","13");
INSERT INTO tbl_tipo_terapia VALUES("114","BALANCÍN","13");
INSERT INTO tbl_tipo_terapia VALUES("115","BOZU","13");
INSERT INTO tbl_tipo_terapia VALUES("116","CINTURÓN RUSO","13");
INSERT INTO tbl_tipo_terapia VALUES("117","MINI TRAMPOLÍN","13");
INSERT INTO tbl_tipo_terapia VALUES("118","REED GESTO","13");
INSERT INTO tbl_tipo_terapia VALUES("119","Bi","13");
INSERT INTO tbl_tipo_terapia VALUES("120","MONO","13");
INSERT INTO tbl_tipo_terapia VALUES("121","SETS","13");
INSERT INTO tbl_tipo_terapia VALUES("122","REPETICIONES","13");
INSERT INTO tbl_tipo_terapia VALUES("123","OBSERVACIÓN","13");
INSERT INTO tbl_tipo_terapia VALUES("124","BIPEDESTACIÓN","14");
INSERT INTO tbl_tipo_terapia VALUES("125","DESCARGA DE PESO %","14");
INSERT INTO tbl_tipo_terapia VALUES("126","EQUILIBRIO Y COORDINACIÓN","14");
INSERT INTO tbl_tipo_terapia VALUES("127","MARCHA","14");
INSERT INTO tbl_tipo_terapia VALUES("128","ADITAMENTO","14");
INSERT INTO tbl_tipo_terapia VALUES("129","REEDUCAR","14");
INSERT INTO tbl_tipo_terapia VALUES("130","DIFERENTES TERRENOS","14");
INSERT INTO tbl_tipo_terapia VALUES("131","GRADAS","14");
INSERT INTO tbl_tipo_terapia VALUES("132","RAMPA","14");
INSERT INTO tbl_tipo_terapia VALUES("133","PUNTAS-TALONES","14");
INSERT INTO tbl_tipo_terapia VALUES("134","PROPIOCEPCIÓN Bi","14");
INSERT INTO tbl_tipo_terapia VALUES("135","MONO","14");
INSERT INTO tbl_tipo_terapia VALUES("136","PERTURBACIÓN","14");
INSERT INTO tbl_tipo_terapia VALUES("137","OBSERVACIÓN","14");
INSERT INTO tbl_tipo_terapia VALUES("138","GIROS","15");
INSERT INTO tbl_tipo_terapia VALUES("139","EQUILIBRIO DE CUELLO Y TRONCO","15");
INSERT INTO tbl_tipo_terapia VALUES("140","CONTROL POSTURAL","15");
INSERT INTO tbl_tipo_terapia VALUES("141","DESCARGA DE PESO MS","15");
INSERT INTO tbl_tipo_terapia VALUES("142","VASCULACIÓN PÉLVICA","15");
INSERT INTO tbl_tipo_terapia VALUES("143","4 PUNTOS","15");
INSERT INTO tbl_tipo_terapia VALUES("144","ABDOMINALES","15");
INSERT INTO tbl_tipo_terapia VALUES("145","SEDESTACIÓN","15");
INSERT INTO tbl_tipo_terapia VALUES("146","TRANSFERENCIAS","15");
INSERT INTO tbl_tipo_terapia VALUES("147","NEUROFACILITACIÓN","15");
INSERT INTO tbl_tipo_terapia VALUES("148","OBSERVACIÓN","15");
INSERT INTO tbl_tipo_terapia VALUES("149","MOTOR FINO","16");
INSERT INTO tbl_tipo_terapia VALUES("150","COORDINACIÓN OJO-MANO","16");
INSERT INTO tbl_tipo_terapia VALUES("151","PINZAS","16");
INSERT INTO tbl_tipo_terapia VALUES("152","OPONENCIA","16");
INSERT INTO tbl_tipo_terapia VALUES("153","PUÑO","16");
INSERT INTO tbl_tipo_terapia VALUES("154","DIGITOEXTEND","16");
INSERT INTO tbl_tipo_terapia VALUES("155","MEJORAR","16");
INSERT INTO tbl_tipo_terapia VALUES("156","AVD","16");
INSERT INTO tbl_tipo_terapia VALUES("157","OBSERVACIÓN","16");
INSERT INTO tbl_tipo_terapia VALUES("159","PRUEBA 2","18");



DROP TABLE IF EXISTS tbl_tipo_tratamiento;

CREATE TABLE `tbl_tipo_tratamiento` (
  `Id_Tipo_Tratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_Tipo_Tratamiento`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO tbl_tipo_tratamiento VALUES("1","MAGNETOTERAPIA");
INSERT INTO tbl_tipo_tratamiento VALUES("2","MEDIOS FÍSICOS");
INSERT INTO tbl_tipo_tratamiento VALUES("3","MASOTERAPIA");
INSERT INTO tbl_tipo_tratamiento VALUES("4","ELECTROTERAPIA");
INSERT INTO tbl_tipo_tratamiento VALUES("5","ULTRASONIDO");
INSERT INTO tbl_tipo_tratamiento VALUES("6","LÁSER");
INSERT INTO tbl_tipo_tratamiento VALUES("7","MOVILIDAD ARTICULAR");
INSERT INTO tbl_tipo_tratamiento VALUES("8","TRACCIÓN");
INSERT INTO tbl_tipo_tratamiento VALUES("9","TERAPIA OCUPACIONAL");
INSERT INTO tbl_tipo_tratamiento VALUES("10","PRESOTERAPIA");
INSERT INTO tbl_tipo_tratamiento VALUES("11","OSCILACIÓN PROFUNDA");
INSERT INTO tbl_tipo_tratamiento VALUES("12","EJERCICIO");
INSERT INTO tbl_tipo_tratamiento VALUES("13","EN GIMNASIO");
INSERT INTO tbl_tipo_tratamiento VALUES("14","EN BARRAS");
INSERT INTO tbl_tipo_tratamiento VALUES("15","EN CAMASTRÓN");
INSERT INTO tbl_tipo_tratamiento VALUES("16","DESTREZAS MANUALES");
INSERT INTO tbl_tipo_tratamiento VALUES("18","PRUEBA");





DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_CITA` AFTER INSERT ON `tbl_cita_terapeutica` FOR EACH ROW BEGIN
DECLARE CitaNombre VARCHAR(100);
DECLARE PacienteNombre VARCHAR(100);

SELECT Nombre INTO PacienteNombre FROM tbl_paciente WHERE Id_Paciente = NEW.Id_Paciente;
SELECT Descripcion INTO CitaNombre FROM tbl_tipo_cita WHERE Id_Tipo_Cita = NEW.Id_Tipo_Cita;

INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('CITA: ', CitaNombre, ' FUE AGENDADA PARA EL ', NEW.Fecha_Cita,' A LAS ', NEW.Hora_Cita, ' PARA EL PACIENTE ', PacienteNombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_CITA` AFTER UPDATE ON `tbl_cita_terapeutica` FOR EACH ROW BEGIN

DECLARE OldCitaNombre VARCHAR(100);
DECLARE NewCitaNombre VARCHAR(100);

DECLARE OldEspecialistaNombre VARCHAR(100);
DECLARE NewEspecialistaNombre VARCHAR(100);

-- Obtener tipo de cita
SELECT Descripcion INTO OldCitaNombre FROM tbl_tipo_cita WHERE Id_Tipo_Cita = OLD.Id_Tipo_Cita;
SELECT Descripcion INTO NewCitaNombre FROM tbl_tipo_cita WHERE Id_Tipo_Cita = NEW.Id_Tipo_Cita;

-- Obtener Especialidad
-- SELECT Rol INTO OldEspecialidadNombre FROM tbl_ms_roles WHERE Id_Rol = OLD.Id_Rol;
-- SELECT Rol INTO NewEspecialidadNombre FROM tbl_ms_roles WHERE Id_Rol = NEW.Id_Rol;


-- Verificar cambios en tipo cita
IF OLD.Id_Tipo_Cita <> NEW.Id_Tipo_Cita THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL TIPO DE CITA DE: ', OldCitaNombre , ' A ', NewCitaNombre), @id_objeto);
END IF;

-- Verificar cambios en motivo cita
IF OLD.Descripcion_Cita <> NEW.Descripcion_Cita THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA MODIFICADO EL MOTIVO DE LA CITA CON EL ID ', NEW.id_Cita_Terapia), @id_objeto);
END IF;



-- Verificar cambios en especialistas
IF OLD.Id_Especialista <> NEW.Id_Especialista THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA MODIFICADO EL ESPECIALISTA DE LA CITA CON EL ID ', NEW.id_Cita_Terapia), @id_objeto);
END IF;

-- Verificar cambios en Fecha de cita
IF OLD.Fecha_Cita <> NEW.Fecha_Cita THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA CAMBIADO LA FECHA DE LA CITA: ', NEW.id_Cita_Terapia, '. DE ', OLD.Fecha_Cita, ' A ', NEW.Fecha_Cita), @id_objeto);
END IF;

-- Verificar cambios en hora cita
IF OLD.Hora_Cita <> NEW.Hora_Cita THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA CAMBIADO LA HORA DE LA CITA: ', NEW.id_Cita_Terapia, '. DE ', OLD.Hora_Cita, ' A ', NEW.Hora_Cita), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `CANCELAR_CITA` AFTER UPDATE ON `tbl_cita_terapeutica` FOR EACH ROW BEGIN
DECLARE CitaNombre VARCHAR(100);
SELECT Descripcion INTO CitaNombre FROM tbl_tipo_cita WHERE Id_Tipo_Cita = NEW.Id_Tipo_Cita;

IF NEW.Id_Estado_Cita = 5 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE CANCELÓ LA CITA: ', OLD.id_Cita_Terapia, ' DEL TIPO ', CitaNombre),@id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `CITA_ESTADO` AFTER UPDATE ON `tbl_cita_terapeutica` FOR EACH ROW BEGIN
DECLARE OldCitaEstado VARCHAR(100);
DECLARE NewCitaEstado VARCHAR(100);

SELECT Estado_Cita INTO OldCitaEstado FROM tbl_estado_cita WHERE Id_Estado_Cita = OLD.Id_Estado_Cita;
SELECT Estado_Cita INTO NewCitaEstado FROM tbl_estado_cita WHERE Id_Estado_Cita = NEW.Id_Estado_Cita;

IF NEW.Id_Estado_Cita = 2 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('EL ESTADO DE LA CITA ', OLD.id_Cita_Terapia, ' CAMBIO DE :', OldCitaEstado,' A ', NewCitaEstado),@id_objeto);
END IF;


IF NEW.Id_Estado_Cita = 1 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('EL ESTADO DE LA CITA ', OLD.id_Cita_Terapia, ' CAMBIO DE :', OldCitaEstado,' A ', NewCitaEstado),@id_objeto);
END IF;

END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERTAR_EVALUACION` AFTER INSERT ON `tbl_evaluacion` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO LA EVALUACION: ', NEW.Descripcion), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `EDITAR_EVALUACION` AFTER UPDATE ON `tbl_evaluacion` FOR EACH ROW BEGIN

-- Verificar cambios en el campo nombre de evaluacion
IF OLD.Descripcion <> NEW.Descripcion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO LA DESCRIPCION DE LA EVALUACION: ', OLD.Descripcion, ' A ', NEW.Descripcion), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_EVALUACION` AFTER DELETE ON `tbl_evaluacion` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ LA EVALUACION: ', OLD.Descripcion), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_EXPEDIENTE` AFTER INSERT ON `tbl_expediente` FOR EACH ROW BEGIN
DECLARE PacienteNombre VARCHAR(100);
SELECT Nombre INTO PacienteNombre FROM tbl_paciente WHERE Id_Paciente = NEW.Id_Paciente;

INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE CREO EL EXPEDIENTE CON ID: ', NEW.id_Expediente, ' Al PACIENTE ', PacienteNombre ), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERTAR_PARAMETRO` AFTER INSERT ON `tbl_ms_parametros` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EL PARAMETRO: ', NEW.Parametro), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `EDIT_PARAMETRO` AFTER UPDATE ON `tbl_ms_parametros` FOR EACH ROW BEGIN

-- Verificar cambios en el campo nombre de parametro
IF OLD.Parametro <> NEW.parametro THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL NOMBRE DEL PARAMETRO: ', OLD.Parametro, ' A ', NEW.Parametro), @id_objeto);
END IF;

-- Verificar cambios en el valor del parametro
IF OLD.Valor <> NEW.Valor THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL VALOR DEL PARAMETRO ', NEW.Parametro, '. VALOR EDITADO DE ', OLD.Valor, ' A ', NEW.Valor), @id_objeto);
END IF;

END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_PARAMETRO` AFTER DELETE ON `tbl_ms_parametros` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ EL PARAMETRO: ', OLD.Parametro), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_ROL` AFTER UPDATE ON `tbl_ms_roles` FOR EACH ROW BEGIN

-- Verificar cambios en el campo nombre de rol
IF OLD.Rol <> NEW.Rol THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL NOMBRE DEL ROL: ', OLD.Rol, ' A ', NEW.Rol), @id_objeto);
END IF;

-- Verificar cambios en la descripcion del rol
IF OLD.Descripcion <> NEW.Descripcion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO LA DESCRIPCION DEL ROL ', NEW.Rol, '. DESCRIPCION EDITADA DE ', OLD.Descripcion, ' A ', NEW.Descripcion), @id_objeto);
END IF;

END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERTAR_ROL` AFTER UPDATE ON `tbl_ms_roles` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EL ROL DE: ', NEW.ROL), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERTAR_USUARIO` AFTER INSERT ON `tbl_ms_usuario` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE REGISTRO EL USUARIO: ', NEW.Usuario, ' CON EL NOMBRE ', NEW.Nombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `guardar_contrasena_anterior` BEFORE UPDATE ON `tbl_ms_usuario` FOR EACH ROW BEGIN
IF OLD.Contrasena <> NEW.Contrasena THEN
INSERT INTO tbl_ms_hist_contrasena (Id_Usuario, Contrasena, Fecha_Modificacion)
VALUES (OLD.Id_Usuario, OLD.Contrasena, NOW());
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_USUARIO` AFTER UPDATE ON `tbl_ms_usuario` FOR EACH ROW BEGIN

-- Verificar cambios en el campo Nombre
IF OLD.Nombre <> NEW.Nombre THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL NOMBRE DEL USUARIO: ', OLD.Nombre, ' A ', NEW.Nombre), @id_objeto);
END IF;

-- Verificar cambios en el campo usuario
IF OLD.Usuario <> NEW.Usuario THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL USUARIO ', NEW.USUARIO, '. USUARIO CAMBIADO DE ', OLD.Usuario, ' A ', NEW.Usuario), @id_objeto);
END IF;

-- Verificar cambios en el campo correo
IF OLD.Correo <> NEW.Correo THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL CORREO ELECTRONICO DEL USUARIO: ', NEW.Usuario, '. DE ', OLD.Correo, ' A ', NEW.Correo), @id_objeto);
END IF;

-- Verificar cambios en el campo Fecha contratacion
IF OLD.FechaContratacion <> NEW.FechaContratacion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO LA FECHA DE CONTRATACION DEL USUARIO: ', NEW.Usuario, '. FECHA DE CONTRATACION CAMBIADA DE ', OLD.FechaContratacion, ' A ', NEW.FechaContratacion), @id_objeto);
END IF;

-- Verificar cambios en el campo FechaNacimiento
IF OLD.FechaNacimiento <> NEW.FechaNacimiento THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO LA FECHA DE NACIMIENTO DEL USUARIO: ', NEW.Usuario, '. FECHA DE NACIMIENTO CAMBIADA DE ', OLD.FechaNacimiento, ' A ', NEW.FechaNacimiento), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ESTADO_USUARIO` AFTER UPDATE ON `tbl_ms_usuario` FOR EACH ROW BEGIN
DECLARE OldUsuarioEstado VARCHAR(100);
DECLARE NewUsuarioEstado VARCHAR(100);

SELECT Descripcion INTO OldUsuarioEstado FROM tbl_estado_usuario WHERE Id_Estado = OLD.Estado_Usuario;
SELECT Descripcion INTO NewUsuarioEstado FROM tbl_estado_usuario WHERE Id_Estado = NEW.Estado_Usuario;

IF OLD.Estado_Usuario <> NEW.Estado_Usuario THEN
IF NEW.Estado_Usuario = 1 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('EL ESTADO DEL USUARIO ', OLD.Usuario, ' CAMBIO DE :', OldUsuarioEstado,' A ', NewUsuarioEstado),@id_objeto);
END IF;


IF NEW.Estado_Usuario = 2 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('EL ESTADO DEL USUARIO ', OLD.Usuario, ' CAMBIO DE :', OldUsuarioEstado,' A ', NewUsuarioEstado),@id_objeto);
END IF;

IF NEW.Estado_Usuario = 3 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('EL ESTADO DEL USUARIO ', OLD.Usuario, ' CAMBIO DE :', OldUsuarioEstado,' A ', NewUsuarioaEstado),@id_objeto);
END IF;
END IF;

END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_PACIENTE` AFTER INSERT ON `tbl_paciente` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EL PACIENTE: ', NEW.Nombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `EDIT_PACIENTE` AFTER UPDATE ON `tbl_paciente` FOR EACH ROW BEGIN

DECLARE oldGeneroNombre VARCHAR(100);
DECLARE newGeneroNombre VARCHAR(100);
DECLARE oldTipoDocumentoNombre VARCHAR(100);
DECLARE newTipoDocumentoNombre VARCHAR(100);

-- Obtener nombres de género
SELECT Descripcion INTO oldGeneroNombre FROM tbl_genero WHERE IdGenero = OLD.IdGenero;
SELECT Descripcion INTO newGeneroNombre FROM tbl_genero WHERE IdGenero = NEW.IdGenero;

-- Obtener nombres de tipo de documento
SELECT Descripcion INTO oldTipoDocumentoNombre FROM tbl_tipo_documento WHERE Id_Tipo_Documento = OLD.Id_Tipo_Documento;
SELECT Descripcion INTO newTipoDocumentoNombre FROM tbl_tipo_documento WHERE Id_Tipo_Documento = NEW.Id_Tipo_Documento;

-- Verificar cambios en el campo Nombre
IF OLD.Nombre <> NEW.Nombre THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL PACIENTE: ', OLD.Nombre, ' A ', NEW.Nombre), @id_objeto);
END IF;

-- Verificar cambios en el campo Dirección
IF OLD.Direccion <> NEW.Direccion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL PACIENTE ', NEW.Nombre, '. DIRECCIÓN CAMBIADA DE ', OLD.Direccion, ' A ', NEW.Direccion), @id_objeto);
END IF;

-- Verificar cambios en el campo IdGenero
IF OLD.IdGenero <> NEW.IdGenero THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL PACIENTE: ', NEW.Nombre, '. GÉNERO CAMBIADO DE ', oldGeneroNombre, ' A ', newGeneroNombre), @id_objeto);
END IF;

-- Verificar cambios en el campo Id_Tipo_Documento
IF OLD.Id_Tipo_Documento <> NEW.Id_Tipo_Documento THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL PACIENTE: ', NEW.Nombre, '. TIPO DE DOCUMENTO CAMBIADO DE ', oldTipoDocumentoNombre, ' A ', newTipoDocumentoNombre), @id_objeto);
END IF;

-- Verificar cambios en el campo Ocupacion
IF OLD.Ocupacion <> NEW.Ocupacion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL PACIENTE: ', NEW.Nombre, '. OCUPACIÓN CAMBIADA DE ', OLD.Ocupacion, ' A ', NEW.Ocupacion), @id_objeto);
END IF;

-- Verificar cambios en el campo FechaNacimiento
IF OLD.FechaNacimiento <> NEW.FechaNacimiento THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL PACIENTE: ', NEW.Nombre, '. FECHA DE NACIMIENTO CAMBIADA DE ', OLD.FechaNacimiento, ' A ', NEW.FechaNacimiento), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ESTADO_PACIENTE` AFTER UPDATE ON `tbl_paciente` FOR EACH ROW BEGIN
IF NEW.Estado_Paciente = 1 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE ACTIVÓ EL PACIENTE: ', OLD.Nombre, ' CON EL ID: ', OLD.Id_Paciente),@id_objeto);
END IF;
IF NEW.Estado_Paciente = 0 THEN
INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE HA INHABILITÓ EL PACIENTE: ', OLD.Nombre, ' QUE TENIA EL ID: ', OLD.Id_Paciente),@id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_PACIENTE` AFTER DELETE ON `tbl_paciente` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ EL PACIENTE: ', OLD.Nombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_ECLINICO` AFTER INSERT ON `tbl_resultado_evaluacion` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EXPEDIENTE CLINICO ', NEW.Descripcion), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_ECLINICO` AFTER UPDATE ON `tbl_resultado_evaluacion` FOR EACH ROW BEGIN

-- Verificar cambios en el campo nombre de evaluacion
IF OLD.Descripcion <> NEW.Descripcion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO LA DESCRIPCION DE LA EVALUACION: ', OLD.Descripcion, ' A ', NEW.Descripcion), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_ECLINICO` AFTER DELETE ON `tbl_resultado_evaluacion` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ LA EVALUACION: ', OLD.Descripcion), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_TDOCUMENTO` AFTER INSERT ON `tbl_tipo_documento` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EL TIPO DE DOCUMENTO ', NEW.Descripcion), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_TDOCUMENTO` AFTER UPDATE ON `tbl_tipo_documento` FOR EACH ROW BEGIN
-- Verificar cambios en el campo nombre del documento
IF OLD.Descripcion <> NEW.Descripcion THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL TIPO DE DOCUMENTO: ', OLD.Descripcion, ' A ', NEW.Descripcion), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_TDocumento` AFTER DELETE ON `tbl_tipo_documento` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ EL TIPO DE DOCUMENTO: ', OLD.Descripcion), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_TIPTRATAMIENTO` AFTER INSERT ON `tbl_tipo_terapia` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EL TIPO DE TRATAMIENTO ', NEW.Nombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_TRATAMIENTO` AFTER UPDATE ON `tbl_tipo_terapia` FOR EACH ROW BEGIN

-- Verificar cambios en el campo nombre de tratamiento
IF OLD.Nombre <> NEW.Nombre THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL NOMBRE DEL TRATAMIENTO: ', OLD.Nombre, ' A ', NEW.Nombre), @id_objeto);
END IF;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_TRATAMIENTO` AFTER DELETE ON `tbl_tipo_terapia` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ EL TRATAMIENTO: ', OLD.Nombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `INSERT_TERAPIA` AFTER INSERT ON `tbl_tipo_tratamiento` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id,'INSERTAR', CONCAT('SE HA REGISTRADO EL TIPO DE TERAPIA ', NEW.Nombre), @id_objeto);
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ACTUALIZAR_TERAPIA` AFTER UPDATE ON `tbl_tipo_tratamiento` FOR EACH ROW BEGIN

-- Verificar cambios en el campo nombre de Tipo terapia
IF OLD.Nombre <> NEW.Nombre THEN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ACTUALIZAR', CONCAT('SE HA EDITADO EL TIPO DE TRATAMIENTO: ', OLD.Nombre, ' A ', NEW.Nombre), @id_objeto);
END IF;

END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`u452119581_RED`@`127.0.0.1` TRIGGER `ELIMINAR_TERAPIA` AFTER DELETE ON `tbl_tipo_tratamiento` FOR EACH ROW BEGIN
INSERT INTO tbl_bitacora(Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
VALUES (NOW(), @current_user_id, 'ELIMINAR', CONCAT('SE ELIMINÓ EL TIPO DE TERAPIA: ', OLD.Nombre), @id_objeto);
END$$
DELIMITER ;
SET FOREIGN_KEY_CHECKS=1;