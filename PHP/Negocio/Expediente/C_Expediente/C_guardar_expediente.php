<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
include('../../../Controladores/Conexion/Conexion_be.php');
// include('../../../Controladores/bitacora.php');

$id_Paciente = $_POST['Id_Paciente'];
$id_Usuario = $_SESSION['id_D'];

// obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_modal_expediente');
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


$sql = "INSERT INTO tbl_expediente (Fecha_Creacion, Id_Usuario, Id_Paciente)
        VALUES (NOW(),'$id_Usuario','$id_Paciente')";

    echo $resultado = mysqli_query($conexion, $sql);
    // $expedienteID = mysqli_insert_id($conexion);

    // $n = $_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a ='CREAR';
    // $d ='SE HA CREADO EL EXPEDIENTE '. $expedienteID .' AL PACIENTE '.$id_Paciente;
    // bitacora($n, $a, $d);
?>