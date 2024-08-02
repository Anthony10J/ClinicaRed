<?php
include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../../Recursos/SweetAlerts.php');
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
session_start();


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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rol = strtoupper($_POST['rol']);
    $descripcionrol = strtoupper($_POST['descripcionrol']);

    // Preparar la consulta SQL para insertar el rol
    $query = "INSERT INTO tbl_ms_roles (Rol, Descripcion, Fecha_Creacion) 
              VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $rol, $descripcionrol);

    // Ejecutar la consulta preparada
    if (mysqli_stmt_execute($stmt)) {
        // Redireccionar a la página de roles con un mensaje de éxito
        header("Location: ../V_Roles/V_roles.php?mensaje=El rol se creó correctamente");
        exit();
    } else {
        // Mostrar un mensaje de error si falla la ejecución de la consulta
        header("Location: ../V_Roles/V_nuevo_rol.php?mensaje=El rol rol no creado.");
        exit();
           }

    // Cerrar la declaración
    mysqli_stmt_close($stmt);
} else {
    // Si no se recibe una solicitud POST, redirigir a alguna página adecuada
    header("Location: ../V_Roles/V_nuevo_rol.php");
    exit();
}

mysqli_close($conexion);
?>
