<?php
session_start();

include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../../Recursos/SweetAlerts.php');
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';

// Obtener el objeto
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

// Obtener el ID y nombre del usuario actual desde la sesión
if (isset($_SESSION['id_D']) && isset($_SESSION['usuario'])) {
    $current_user_id = $_SESSION['id_D'];
    $current_user_name = $_SESSION['usuario']; // Esta es tu variable de sesión que contiene el nombre del usuario
    $current_user_id = mysqli_real_escape_string($conexion, $current_user_id);
    $current_user_name = mysqli_real_escape_string($conexion, $current_user_name);

    // Establecer la variable de sesión en MySQL
    if ($conexion->query("SET @current_user_id = '$current_user_id'") === FALSE) {
        echo "Error setting session variable: " . $conexion->error;
        exit();
    }
} else {
    echo "Error: current_user_id o usuario es NULL";
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
        // Obtener el Id_Rol recién insertado
        $id_rol_nuevo = mysqli_insert_id($conexion);

        // Insertar los permisos para el nuevo rol
        for ($i = 1; $i <= 19; $i++) {
            $query_permisos = "INSERT INTO tbl_ms_permisos (
                                    Id_Rol, 
                                    Id_Objeto, 
                                    Permiso_Insercion, 
                                    Permiso_Eliminacion, 
                                    Permiso_Actualizacion, 
                                    Permiso_Consultar, 
                                    Permiso_Reportes, 
                                    Permiso_Terapeutico, 
                                    Permiso_Clinico, 
                                    Creado_Por, 
                                    Fecha_Creacion
                               ) VALUES (
                                    ?, ?, 0, 0, 0, 0, 0, 0, 0, ?, NOW()
                               )";

            $stmt_permisos = mysqli_prepare($conexion, $query_permisos);
            mysqli_stmt_bind_param($stmt_permisos, "iis", $id_rol_nuevo, $i, $current_user_name);

            if (!mysqli_stmt_execute($stmt_permisos)) {
                // Manejar el error si la inserción de permisos falla
                echo "Error al insertar permisos: " . mysqli_error($conexion);
                mysqli_stmt_close($stmt_permisos);
                exit();
            }

            mysqli_stmt_close($stmt_permisos);
        }

        // Redireccionar a la página de roles con un mensaje de éxito
        header("Location: ../V_Roles/V_roles.php");
        exit();
    } else {
        // Mostrar un mensaje de error si falla la ejecución de la consulta
        header("Location: ../V_Roles/V_nuevo_rol.php");
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
