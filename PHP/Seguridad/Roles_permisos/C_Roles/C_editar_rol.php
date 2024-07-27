<?php
include '../../../Controladores/Conexion/Conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idRol = $_POST['id_rol'];
    $rol = $_POST['rol'];
    $descripcion =  strtoupper($_POST['descripcion']);

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