<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');

include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';

// obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_modal_identidad');
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

// Parámetros de la acción
// Parámetros de la acción
// $accion = 'DESCARGA';
//$nombre_pdf = isset($_POST['archivo']) ? basename($_POST['archivo']) : 'documento.pdf';
// $descripcion_bitacora = 'SE HA DESCARGADO REPORTE TIPOS DE IDENTIDAD DE LOS PACIENTES ' . $nombre_pdf;


// // Insertar el registro en la bitácora
// $sql = "INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
//         VALUES (NOW(), '$current_user_id', '$accion', '$descripcion_bitacora', '$id_objeto')";

// $conexion->query($sql);
// $conexion->close();



$descripcion = strtoupper($_POST['identidad']);

$sql = "INSERT INTO tbl_tipo_documento (Descripcion) VALUES ('$descripcion')";

    echo $resultado = mysqli_query($conexion, $sql);
?>