<?php
include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../../Recursos/SweetAlerts.php');


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
