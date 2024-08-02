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
// include('../../../Controladores/bitacora.php');

// obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_modal_cita');
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

$idCita =$_POST['$idCita'];
$motivoCita = strtoupper($_POST['motivoCita']);
$fechaCita = date("Y-m-d", strtotime($_POST['fechaCita']));
$horaCita = $_POST['horaCita'];
$id_Paciente = $_POST['Id_Paciente'];
$id_Usuario = $_SESSION['id_D'];
$id_Tipo_Cita = $_POST['tipoCita'];
$subespecialidad = $_POST['subespecialidad'];
$id_Expediente = $_POST['Id_Expediente'];

$sql = "INSERT INTO tbl_cita_terapeutica (Descripcion_Cita, Fecha_Registro, Fecha_Cita, Hora_Cita, Id_Paciente, Id_Usuario, Id_Tipo_Cita, Id_Especialista, Id_Estado_Cita, Id_Expediente)
        VALUES ('$motivoCita', NOW(), '$fechaCita', '$horaCita', '$id_Paciente', '$id_Usuario', '$id_Tipo_Cita', '$subespecialidad', 1, '$id_Expediente')";
   
   echo $resultado = mysqli_query($conexion, $sql);  
    // $citaID = mysqli_insert_id($conexion);
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
    // $a='AGENDAR';
    // $d='CITA '. $citaID.' FUE AGENDADA PARA EL '.$fechaCita.' A LAS '.$horaCita.' PARA EL PACIENTE '.$id_Paciente;
    // bitacora($n, $a, $d);
?>