<?php
include('../../../Controladores/Conexion/Conexion_be.php');
// Verificar si el ID del rol está presente en la solicitud POST
if (isset($_POST['idRol'])) {
    $idRol = $_POST['idRol'];

    // Preparar la consulta para eliminar el rol
    $sql = "DELETE FROM tbl_ms_roles WHERE Id_Rol = ?";

    // Preparar la sentencia
    if ($stmt = $conexion->prepare($sql)) {
        // Vincular el parámetro
        $stmt->bind_param("i", $idRol);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Si la eliminación es exitosa, enviar una respuesta exitosa
            echo 'success';
        } else {
            // Si ocurre un error, enviar una respuesta de error
            echo 'error';
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo 'error';
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo 'error';
}
?>

