include('../Controladores/Conexion/Conexion_be.php');
include('../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php');
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
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
include('./bitacora.php');
$u=$_SESSION['usuario'];
$n= $_SESSION['id_D'];
$a='CIERRE DE SESIÓN';
$d= $_SESSION['usuario'].' FINALIZÓ SESIÓN.';
$o= $id_objeto;
session_destroy();
header("location: /index.php");
bitacora($n,$a,$d, $o); 
