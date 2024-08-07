<?php
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../../Recursos/SweetAlerts.php');
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
    $genero = strtoupper($_POST["genero"]);
    $estado = $_POST["estadoUser"];
    $rol = $_POST["rol"];
    $fechanacimiento = $_POST["fechanacimiento"];
    $fechacontratacion = $_POST["fechacontratacion"];

    
    // obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_usuario');
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


    // Consulta de actualización con marcadores de posición corregidos
    $actualizarUsuarioQuery = "UPDATE tbl_ms_usuario SET DNI = ?, Usuario = ?, Direccion = ?, Correo = ?, Nombre = ?, IdGenero = ?, Estado_Usuario = ?, 
    IdRol = ?, FechaNacimiento = ?, FechaContratacion = ?  WHERE Id_Usuario = ?";
    
    $stmt = mysqli_prepare($conexion, $actualizarUsuarioQuery);
    mysqli_stmt_bind_param($stmt, "sssssiiissi", $dni, $usuario, $direccion, $correo, $nombre, $genero, $estado, $rol,
        $fechanacimiento, $fechacontratacion, $idUsuario);

        if (mysqli_stmt_execute($stmt)) {
            // Mensaje de éxito
            // $mensajeExito = "¡Los cambios se han guardado exitosamente!";
            echo '
            <script>
                MostrarAlerta("success", "¡GENIAL!", "Usuario editado correctamente.", "../V_Usuario/V_usuario.php");
            </script>
        ';
            // Redireccionar a la página principal o mostrar un mensaje de éxito
            // header("Location: ../V_Usuario/V_usuario.php");
            // exit();
        } else {
        // Manejar el error de forma adecuada
        echo "Error al guardar los cambios";
    }

    mysqli_stmt_close($stmt);
}
?>
