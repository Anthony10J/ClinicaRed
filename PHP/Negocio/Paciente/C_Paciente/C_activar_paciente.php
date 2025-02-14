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


// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica si se proporcionó el ID de paciente
    if (isset($_POST["id"])) {
        // Sanitiza el ID de paciente para evitar inyección de SQL
        $idPaciente = filter_var($_POST["id"], FILTER_VALIDATE_INT);

        // Valida el ID del paciente
        if ($idPaciente === false || $idPaciente <= 0) {
            echo "ID de paciente no válido";
            exit; // Sale del script si el ID no es válido
        }

        // Actualiza el estado del paciente en la base de datos
        $estado = 1; // Estado activo
        $habilitarPacienteQuery = "UPDATE tbl_paciente SET Estado_Paciente = ? WHERE Id_Paciente = ?";
        $stmt = mysqli_prepare($conexion, $habilitarPacienteQuery);
        // Verifica si la consulta se preparó correctamente
        if ($stmt) {
            // Vincula los parámetros y ejecuta la consulta
            mysqli_stmt_bind_param($stmt, "ii", $estado, $idPaciente);
            if (mysqli_stmt_execute($stmt)) {
                // $n=$_SESSION['id_D'];          //obtiene valor de la variable session
                // $a='HABILITAR';
                // $d='PACIENTE CON EL ID '. $idPaciente .' HA SIDO HABILITADO';
                // bitacora($n, $a, $d);
                echo "El paciente ha sido habilitado exitosamente";
            } else {
                echo "Error al habilitar al paciente: " . mysqli_error($conexion);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta: " . mysqli_error($conexion);
        }
    } else {
        echo "ID de paciente no proporcionado";
    }
} else {
    echo "Acceso denegado";
}
?>
