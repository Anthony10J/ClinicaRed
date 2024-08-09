<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include("../Controladores/Conexion/Conexion_be.php");

// Obtener los datos enviados por AJAX
$min = $_POST['min'];
$max = $_POST['max'];

// Validar que las fechas no estén vacías
if (empty($min) || empty($max)) {
    echo "Por favor, ingresa un rango de fechas válido.";
    exit;
}

// Consulta para verificar si hay registros en el rango de fechas
$sql_check = "SELECT COUNT(*) AS total FROM tbl_bitacora WHERE Fecha BETWEEN '$min' AND '$max'";
$result = mysqli_query($conexion, $sql_check);
$row = mysqli_fetch_assoc($result);

if ($row['total'] > 0) {
    echo "confirm"; // Enviar señal para confirmación de eliminación
} else {
    echo "No hay registros para borrar en el rango de fechas proporcionado.";
}

mysqli_close($conexion);
?>
