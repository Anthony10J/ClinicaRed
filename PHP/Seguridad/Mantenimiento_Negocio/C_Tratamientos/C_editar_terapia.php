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


$idTipoTerapia = $_POST['idTipoTerapia'];
$tratamiento = strtoupper($_POST['tratamiento_E']);

$sql = "UPDATE tbl_tipo_terapia SET Nombre = '$tratamiento' WHERE idTipoTerapia = '$idTipoTerapia'";

    echo $resultado = mysqli_query($conexion, $sql);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='EDITAR';
    // $d="SE HA EDITADO EL TIPO DE TRATAMIENTO ". $tratamiento.".";
    // bitacora($n, $a, $d);
