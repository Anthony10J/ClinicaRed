<?php
require_once('../Controladores/conexiondb.php');

if (isset($_POST["usuario"])) {
    $usuario = $_POST["usuario"];

    // Ejecutar la consulta SQL
    $sql = "SELECT COUNT(*) as count FROM tbl_ms_usuario WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    // Enviar la respuesta al usuario
    if ($count > 0) {
        // El Correo ya existe
        echo "existe";
    } else {
        // El Correo no existe
        echo "ok";
    }

    $stmt->close();
} else {
    // Si no se proporciona un Correo, devuelve un mensaje de error
    echo "error";
}

// Cerrar la conexión a la base de datos
$conn->close();

