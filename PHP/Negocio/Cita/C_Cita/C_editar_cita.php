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

$idCita_E = $_POST['idCita_E'];
$motivoCita = strtoupper($_POST['motivoCita_E']);
$fechaCita = date("Y-m-d", strtotime($_POST['fechaCita_E']));
$horaCita = $_POST['horaCita_E'];
// $id_Paciente = $_POST['nombrePaciente'];
$id_Usuario = $_SESSION['id_D'];
$id_Tipo_Cita = $_POST['tipoCita_E'];
$subespecialidad_E = $_POST['subespecialidad_E'];

$sql = "UPDATE tbl_cita_terapeutica SET Descripcion_Cita = '$motivoCita', Fecha_Cita = '$fechaCita', Hora_Cita = '$horaCita',
                                        Id_Usuario = '$id_Usuario', Id_Tipo_Cita = '$id_Tipo_Cita', Id_Especialista = '$subespecialidad_E'
                                        WHERE id_Cita_Terapia = '$idCita_E'";

    echo $resultado = mysqli_query($conexion, $sql);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable session
    //     $a='EDITAR';
    //     $d='CITA '. $idCita_E .' HA SIDO EDITADA';
    //     bitacora($n, $a, $d);
?>
