<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');
// Verificar si el ID del rol está presente en la solicitud POST

include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';


// obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_roles');
if ($id_objeto === null) {
    echo "Error: id_objeto es NULL";
    exit();
}
$id_objeto = $conexion->real_escape_string($id_objeto);
if ($conexion->query("SET @id_objeto = '$id_objeto'") === FALSE) {
    echo "Error setting id_objeto variable: " . $conexion->error;
    exit();
}


// Obtener el ID del usuario actual desde la sesión
if (isset($_SESSION['id_D'])) {
$current_user_id = $_SESSION['id_D'];

$current_user_id = mysqli_real_escape_string($conexion, $current_user_id);

// Establecer la variable de sesión en QL
if ($conexion->query("SET @current_user_id = '$current_user_id'") === FALSE) {
    echo "Error setting session variable: " . $conexion->error;
    exit();
}
} else {
echo "Error: current_user_id es NULL";
exit();
}

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

