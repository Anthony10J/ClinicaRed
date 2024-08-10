<?php
include '../../../Controladores/Conexion/Conexion_be.php';
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
    // Obtener los datos del formulario
    $idRol = $_POST['id_rol'];
    $rol = $_POST['rol'];
    $descripcion =  strtoupper($_POST['descripcionrol']);

    // Preparar la consulta SQL para actualizar el rol
    $sql = "UPDATE tbl_ms_roles SET Rol = ?, Descripcion = ? WHERE Id_Rol = ?";
    
    // Preparar la sentencia
    $stmt = mysqli_prepare($conexion, $sql);

    // Vincular las variables a la declaración preparada como parámetros
    mysqli_stmt_bind_param($stmt, "ssi", $rol, $descripcion, $idRol);

    // Ejecutar la sentencia
    if (mysqli_stmt_execute($stmt)) {
        // Redireccionar a la página de listado de roles con un mensaje de éxito
        header("Location: ../V_Roles/V_roles.php?status=success");
        exit;
    } else {
        // Redireccionar a la página de edición de rol con un mensaje de error
        header("Location: ./V_editar_rol.php?id=$idRol&status=error");
        exit;
    }

    // Cerrar la sentencia y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
} else {
    // Si se intenta acceder al script sin enviar datos por POST, redireccionar
    header("Location: ./ruta_a_tu_pagina_de_error.php");
    exit;
}