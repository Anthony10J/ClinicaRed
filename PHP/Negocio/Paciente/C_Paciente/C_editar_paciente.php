
<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../Controladores/bitacora.php');
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
include '../../../../Recursos/SweetAlerts.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPaciente = $_POST['idPaciente'];
    $nombre = strtoupper($_POST["nombre"]);
    $genero = $_POST["genero"];
    $fechanacimiento = $_POST["fechanacimiento"];
    $direccion = strtoupper($_POST["direccion"]);
    $idtipodocumento = $_POST["tipo_documento"];
    $numerodocumento = $_POST["numero_de_documento"];
    $ocupacionpaciente = strtoupper($_POST["ocupacion"]);
    $estado = 1 ;
        
    //$fechamodificacion = date('Y-m-d'); // Fecha de modificación

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

    // Actualizar los datos del paciente en la base de datos
    $actualizarPacienteQuery = "UPDATE tbl_paciente SET 
    Nombre = ?, FechaNacimiento = ?, Direccion = ?, Ocupacion = ?, Id_Tipo_Documento = ?, 
    Numero_Documento = ?, Estado_Paciente = ?, IdGenero = ? WHERE Id_Paciente = ?";
    $stmt = mysqli_prepare($conexion, $actualizarPacienteQuery);
    mysqli_stmt_bind_param($stmt, "ssssisiis", $nombre,$fechanacimiento,$direccion,$ocupacionpaciente,$idtipodocumento,$numerodocumento,$estado,$genero,$idPaciente);

    if (mysqli_stmt_execute($stmt)) {
         // Mensaje de éxito
         // $mensajeExito = "¡Los cambios se han guardado exitosamente!";
         echo '
         <script>
             MostrarAlerta("success", "¡GENIAL!", "Usuario editado correctamente.", "../V_Paciente/V_Paciente.php");
         </script>
     ';
        $n=$_SESSION['id_D'];          //obtiene valor de la variable sesion
        $a='EDITAR';
        $d='PACIENTE CON EL ID '. $idPaciente.' HA SIDO EDITADO ';
        bitacora($n, $a, $d);
        exit();
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($conexion);
    }
   
    mysqli_stmt_close($stmt);
}
?>


