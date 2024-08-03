<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');
// include('../../../Controladores/bitacora.php');
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';

// obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_modal_terapeutico');
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


// Verificar si las variables de sesión existen
if (isset($_SESSION['Id_Tipo_Tratamiento'])) {
    // Acceder a las variables de sesión
    $Id_Tipo_Tratamiento = $_SESSION['Id_Tipo_Tratamiento'];

    // Ahora puedes usar $id_expediente y $id_paciente según lo necesites
    // echo "ID de expediente: $id_expediente <br>";
    // echo "ID de paciente: $id_paciente <br>";

    // También puedes realizar cualquier otra lógica que necesites con estas variables
} else {
    // Si las variables de sesión no existen, puedes redirigir o mostrar un mensaje de error
    echo "Las variables de sesión no están disponibles.";
}

$tratamiento = strtoupper($_POST['tratamiento']);
// $id_tratamiento = $_POST['CbxTratamiento'];

$sql = "INSERT INTO tbl_tipo_terapia (Nombre, Id_Tipo_Tratamiento) VALUES ('$tratamiento', '$Id_Tipo_Tratamiento')";

    echo $resultado = mysqli_query($conexion, $sql);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='AGREGAR';
    // $d="SE HA AGREGADO EL TIPO DE EXAMEN ". $tratamiento.".";
    // bitacora($n, $a, $d);
   
?>