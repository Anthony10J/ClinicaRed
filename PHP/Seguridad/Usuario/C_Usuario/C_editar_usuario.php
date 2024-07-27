<?php
include '../../../Controladores/Conexion/Conexion_be.php';
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['idUsuario'];
    $dni = $_POST["dni"];
    $usuario = strtoupper($_POST["usuario"]);
    $direccion = strtoupper($_POST["direccion"]);
    $correo = $_POST["correo"];
    $nombre = strtoupper($_POST["nombre"]);
    $estado = $_POST["estadoUser"];
    $rol = $_POST["rol"];
    $fechanacimiento = $_POST["fechanacimiento"];
    $fechacontratacion = $_POST["fechacontratacion"];

    // Consulta de actualización con marcadores de posición corregidos
    $actualizarUsuarioQuery = "UPDATE tbl_ms_usuario SET DNI = ?, Usuario = ?, Direccion = ?, Correo = ?, Nombre = ?, Estado_Usuario = ?, 
    IdRol = ?, FechaNacimiento = ?, FechaContratacion = ?  WHERE Id_Usuario = ?";
    
    $stmt = mysqli_prepare($conexion, $actualizarUsuarioQuery);
    mysqli_stmt_bind_param($stmt, "sssssiissi", $dni, $usuario, $direccion, $correo, $nombre, $estado, $rol,
        $fechanacimiento, $fechacontratacion, $idUsuario);

    if (mysqli_stmt_execute($stmt)) {
        // Mensaje de éxito
        $mensajeExito = "¡Los cambios se han guardado exitosamente!";
        
        // Redireccionar a la página principal o mostrar un mensaje de éxito
        header("Location: ../V_Usuario/V_usuario.php");
        exit();
    } else {
        // Manejar el error de forma adecuada
        echo "Error al guardar los cambios";
    }

    mysqli_stmt_close($stmt);
}
?>
