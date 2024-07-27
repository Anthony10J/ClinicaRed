<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');
include('../../../Controladores/bitacora.php');


$Id_Resultado_Evaluacion = $_POST['Id_Resultado_Evaluacion'];
$Descripcion = strtoupper($_POST['evaluacionR_E']);

$sql = "UPDATE tbl_resultado_evaluacion SET Descripcion = '$Descripcion' 
        WHERE Id_Resultado_Evaluacion = '$Id_Resultado_Evaluacion'";

    echo $resultado = mysqli_query($conexion, $sql);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='EDITAR';
    // $d="SE HA EDITADO EL TIPO DE EXAMEN ". $Descripcion.".";
    // bitacora($n, $a, $d);
    
?>