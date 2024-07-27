<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../../../../Recursos/SweetAlerts.php');
// include('../../../Controladores/bitacora.php');
//crear conexion
require_once '../../../Controladores/Conexion/Conexion_be.php';
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';

// Recibir datos del formulario de nuevo paciente
$nombre = strtoupper($_POST['nombre']);
$direccion = strtoupper($_POST['direccion']);
$fechanacimiento = date("Y-m-d", strtotime($_POST['fechanacimiento']));
$idgenero = $_POST['genero'];
$idtipodocumento = $_POST['tipo_documento'];
$numerodocumento = $_POST['numero_de_documento'];
$estadopaciente = 1;
$ocupacionpaciente = strtoupper($_POST['ocupacion']);



   // obtener el objeto
   $id_objeto = Obtener_Id_Objeto('V_Paciente');
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
//Insertar nuevo usuario en la base de datos
$query = "INSERT INTO tbl_paciente (Nombre, Direccion, FechaNacimiento, IdGenero, Id_Tipo_Documento, Numero_Documento, Estado_Paciente, Ocupacion) 
          VALUES ('$nombre', '$direccion', '$fechanacimiento','$idgenero','$idtipodocumento','$numerodocumento', $estadopaciente , '$ocupacionpaciente')";

$resultado_query = mysqli_query($conexion, $query);
$pacienteID = mysqli_insert_id($conexion);
if ($resultado_query) {
    //  $n=$_SESSION['id_D'];          //obtiene valor de la variable session
    //  $a='REGISTRAR';
    //  $d='PACIENTE '. $pacienteID .' HA SIDO REGISTRADO';
    //  bitacora($n, $a, $d);
    echo '
        <script>
            MostrarAlerta("success", "¡GENIAL!", "Paciente almacenado correctamente.", "../V_Paciente/V_Paciente.php");
        </script>
    ';
} else {
    echo '
        <script>
            MostrarAlerta("error", "ERROR", "Inténtalo de nuevo, paciente no almacenado.", "../V_Paciente/V_nuevo_paciente.php");
        </script>
    ';
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>