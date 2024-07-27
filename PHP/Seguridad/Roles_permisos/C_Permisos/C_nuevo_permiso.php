<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Controladores/Conexion/Conexion_be.php';

// Función para agregar permisos
function agregar_permiso($idRol, $idObjeto, $permisos) {
    global $conexion;

    // Aquí se realiza la inserción de los permisos en la base de datos
    $sql = "INSERT INTO tbl_ms_permisos (Id_Rol, Id_Objeto, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion, Permiso_Consultar, Permiso_Reportes)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iisssss", $idRol, $idObjeto, $permisos['insercion'], $permisos['eliminacion'], $permisos['actualizacion'], $permisos['consultar'], $permisos['reportes']);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        return false;
    }
}

// Verificar si se recibió una solicitud POST para agregar permisos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idRol = $_SESSION['IdRol'];
    $idObjeto = Obtener_Id_Objeto('../permisos/Obtener_Id_Objeto.php'); // Ajusta esto según tus necesidades
    $permisos = [
        'insercion' => isset($_POST['Permiso_Insercion']) ? '1' : '0',
        'eliminacion' => isset($_POST['Permiso_Eliminacion']) ? '1' : '0',
        'actualizacion' => isset($_POST['Permiso_Actualizacion']) ? '1' : '0',
        'consultar' => isset($_POST['Permiso_Consultar']) ? '1' : '0',
        'reportes' => isset($_POST['Permiso_Reportes']) ? '1' : '0'
    ];

    if (agregar_permiso($idRol, $idObjeto, $permisos)) {
        // Redirigir al usuario a la página de permisos con un mensaje de éxito
        header("Location: ./V_permisos.php?mensaje=Permiso agregado correctamente");
        exit();
    } else {
        // Redirigir al usuario a la página de permisos con un mensaje de error
        header("Location: ./V_nuevo_permiso.php?mensaje=Error al agregar permiso");
        exit();
    }
}
?>
