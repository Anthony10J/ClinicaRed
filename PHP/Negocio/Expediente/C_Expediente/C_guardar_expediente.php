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

$id_Paciente = $_POST['Id_Paciente'];
$id_Usuario = $_SESSION['id_D'];

$sql = "INSERT INTO tbl_expediente (Fecha_Creacion, Id_Usuario, Id_Paciente)
        VALUES (NOW(),'$id_Usuario','$id_Paciente')";

    echo $resultado = mysqli_query($conexion, $sql);
    // $expedienteID = mysqli_insert_id($conexion);

    // $n = $_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a ='CREAR';
    // $d ='SE HA CREADO EL EXPEDIENTE '. $expedienteID .' AL PACIENTE '.$id_Paciente;
    // bitacora($n, $a, $d);
?>