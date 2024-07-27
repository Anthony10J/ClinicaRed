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


$Id_Terapia_E = $_POST['Id_Terapia_E'];
$terapiaE = strtoupper($_POST['terapiaE']);

$sql = "UPDATE tbl_tipo_tratamiento SET Nombre = '$terapiaE' WHERE Id_Tipo_Tratamiento = '$Id_Terapia_E'";

    echo $resultado = mysqli_query($conexion, $sql);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='EDITAR';
    // $d="SE HA EDITADO EL TIPO DE TERAPIA ". $terapia_E.".";
    // bitacora($n, $a, $d);
?>