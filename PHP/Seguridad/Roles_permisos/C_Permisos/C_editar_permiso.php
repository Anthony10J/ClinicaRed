<?php
// Incluir el archivo de conexión a la base de datos
include '../../../Controladores/Conexion/Conexion_be.php';

if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

// Verificar si el ID del rol está presente en la solicitud POST

include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';


// obtener el objeto
$id_objeto = Obtener_Id_Objeto('V_modal_estado_cita');
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los datos del formulario están presentes
    if (isset($_POST["permisos"])) {
        $permisos = $_POST["permisos"];

        // Recorrer los permisos y actualizar la base de datos
        foreach ($permisos as $rol => $objetos) {
            foreach ($objetos as $objeto => $acciones) {
                $agregar = $acciones["agregar"] == "1" ? 1 : 0;
                $eliminar = $acciones["eliminar"] == "1" ? 1 : 0;
                $actualizar = $acciones["actualizar"] == "1" ? 1 : 0;
                $consultar = $acciones["consultar"] == "1" ? 1 : 0;
                $reportes = $acciones["reportes"] == "1" ? 1 : 0;
                $clinico = $acciones["clinico"] == "1" ? 1 : 0;
                $terapeutico = $acciones["terapeutico"] == "1" ? 1 : 0;

                // Actualizar los permisos en la base de datos
                $sql = "UPDATE tbl_ms_permisos SET 
                        Permiso_Insercion = $agregar,
                        Permiso_Eliminacion = $eliminar,
                        Permiso_Actualizacion = $actualizar,
                        Permiso_Consultar = $consultar,
                        Permiso_Reportes = $reportes,
                        Permiso_Clinico = $clinico,
                        Permiso_Terapeutico = $terapeutico
                        WHERE Id_Rol = (SELECT Id_Rol FROM tbl_ms_roles WHERE Rol = '$rol')
                        AND Id_Objeto = (SELECT Id_Objetos FROM tbl_ms_objetos WHERE Objeto = '$objeto')";

                if (mysqli_query($conexion, $sql)) {
                     // Redirigir a una página de éxito
                     header("Location: ../permisos/V_permisos.php");
                } else {
                    echo "Error al actualizar los permisos: " . mysqli_error($conexion);
                }
            }
        }
    } else {
        echo "No se recibieron datos del formulario.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
