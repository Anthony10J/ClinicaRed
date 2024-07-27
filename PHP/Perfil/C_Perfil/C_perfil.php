<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../Controladores/Conexion/Conexion_be.php';

// Verificar si la conexión a la base de datos se realizó correctamente
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el ID del usuario actualmente autenticado
$id_usuario = $_SESSION['id_D']; 

// Consulta SQL con la cláusula WHERE para seleccionar solo los datos del usuario actual
$sql ="SELECT
           Nombre,
           Usuario,
           Correo,
           DNI,
           Direccion
        FROM tbl_ms_usuario
        WHERE id_usuario = $id_usuario;"; // Suponiendo que el ID del usuario sea 'id_usuario'

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}
?>