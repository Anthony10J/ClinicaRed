<?php
require_once('../Controladores/conexiondb.php');

// Recibir el DNI desde la solicitud POST
if (isset($_POST["dni"])) {
    $dni = $_POST["dni"];

    // Ejecutar la consulta SQL
    $sql = "SELECT COUNT(*) as count FROM tbl_ms_usuario WHERE dni = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    // Enviar la respuesta al usuario
    if ($count > 0) {
        // El DNI ya existe
        echo "existe";
    } else {
        // El DNI no existe
        echo "ok";
    }

    $stmt->close();
} else {
    // Si no se proporciona un DNI, devuelve un mensaje de error
    echo "error";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
