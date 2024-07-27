<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include('../../../Controladores/Conexion/Conexion_be.php');
// include('../../../Controladores/bitacora.php');

$idCita =$_POST['$idCita'];
$motivoCita = strtoupper($_POST['motivoCita']);
$fechaCita = date("Y-m-d", strtotime($_POST['fechaCita']));
$horaCita = $_POST['horaCita'];
$id_Paciente = $_POST['Id_Paciente'];
$id_Usuario = $_SESSION['id_D'];
$id_Tipo_Cita = $_POST['tipoCita'];
$subespecialidad = $_POST['subespecialidad'];
$id_Expediente = $_POST['Id_Expediente'];

$sql = "INSERT INTO tbl_cita_terapeutica (Descripcion_Cita, Fecha_Registro, Fecha_Cita, Hora_Cita, Id_Paciente, Id_Usuario, Id_Tipo_Cita, Id_Especialista, Id_Estado_Cita, Id_Expediente)
        VALUES ('$motivoCita', NOW(), '$fechaCita', '$horaCita', '$id_Paciente', '$id_Usuario', '$id_Tipo_Cita', '$subespecialidad', 1, '$id_Expediente')";
   
   echo $resultado = mysqli_query($conexion, $sql);  
    // $citaID = mysqli_insert_id($conexion);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='AGENDAR';
    // $d='CITA '. $citaID.' FUE AGENDADA PARA EL '.$fechaCita.' A LAS '.$horaCita.' PARA EL PACIENTE '.$id_Paciente;
    // bitacora($n, $a, $d);
?>