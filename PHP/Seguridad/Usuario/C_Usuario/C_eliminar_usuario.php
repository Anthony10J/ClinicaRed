<?php
// Incluye el archivo de conexión a la base de datos
include '../../../Controladores/Conexion/Conexion_be.php';
// include('../../../Controladores/bitacora.php');
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica si se proporcionó el ID de usuario
    if (isset($_POST["id"])) {
        // Sanitiza el ID de usuario para evitar inyección de SQL
        $idUsuario = filter_var($_POST["id"], FILTER_VALIDATE_INT);

        // Valida el ID del usuario
        if ($idUsuario === false || $idUsuario <= 0) {
            echo "ID de usuario no válido";
            exit; // Sale del script si el ID no es válido
        }

        // Actualiza el estado del usuario en la base de datos
        $estado = 2; // Estado inactivo
        $inhabilitarUsuarioQuery = "UPDATE tbl_ms_usuario SET Estado_Usuario = ? WHERE Id_Usuario = ?";
        $stmt = mysqli_prepare($conexion, $inhabilitarUsuarioQuery);

        // Verifica si la consulta se preparó correctamente
        if ($stmt) {
            // Vincula los parámetros y ejecuta la consulta
            mysqli_stmt_bind_param($stmt, "ii", $estado, $idUsuario);
            if (mysqli_stmt_execute($stmt)) {
                // $n=$_SESSION['id_D'];          //obtiene valor de la variable session
                // $a='ElIMINAR USUARIO';
                // $d='USUARIO '.$IdUsuario .' ELIMINADO';
                // bitacora($n, $a, $d);
                echo "El usuario ha sido inhabilitado exitosamente";
            } else {
                echo "Error al inhabilitar al usuario: " . mysqli_error($conexion);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conexion);
        }
    } else {
        echo "ID de usuario no proporcionado";
    }
} else {
    echo "Acceso denegado";
}
?>