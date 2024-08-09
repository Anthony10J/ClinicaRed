
<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');

// Obtener los datos enviados por AJAX
$min = $_POST['min'];
$max = $_POST['max'];

// Consulta SQL para eliminar registros
$sql = "DELETE FROM tbl_bitacora WHERE Fecha BETWEEN '$min' AND '$max'";

if (mysqli_query($conexion, $sql)) {
    echo "Registros eliminados correctamente";
} else {
    echo "Error al eliminar registros";
}
?>