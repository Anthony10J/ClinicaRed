<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');
// include ('../../../Controladores/bitacora.php');

$terapia = strtoupper($_POST['terapia']);

$sql = "INSERT INTO tbl_tipo_tratamiento (Nombre)
        VALUES ('$terapia')";

    echo $resultado = mysqli_query($conexion, $sql);

    // $n = $_SESSION['id_D'];
    // $a = 'AGREGAR';
    // $d = 'SE HA AGREGADO EL TIPO DE TERAPIA ' . $terapia . '.';
    // bitacora($n, $a, $d);

?>