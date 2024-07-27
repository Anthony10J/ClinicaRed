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

$id_Cita = $_POST['idCita_L'];

$sql = "UPDATE tbl_cita_terapeutica SET Id_Estado_Cita = 2 WHERE id_Cita_Terapia = '$id_Cita'";
    echo $resultado = mysqli_query($conexion, $sql);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='MODIFICADO';
    // $d='EL ESTADO DE LA CITA '. $id_Cita .' HA SIDO MODIFICADO DE "PENDIENTE" A "ESPERA". ';
    // bitacora($n, $a, $d);
?>