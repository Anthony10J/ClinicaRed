<?php
include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../../Recursos/SweetAlerts.php');
// include('../../../Controladores/bitacora.php');
include('../../../PHPMailer/C_correo_usuario.php');
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Recibir datos del formulario
$dni = $_POST['dni'];
$usuario = strtoupper($_POST['usuario']);
$correo = $_POST['correo2'];
$nombre = strtoupper($_POST['nombre']);
$direccion = strtoupper($_POST['direccion']);
$fechanacimiento = date("Y-m-d", strtotime($_POST['fechanacimiento']));
$fechacontratacion = date("Y-m-d", strtotime($_POST['fechacontratacion']));
$estadousuario = $_POST['estadoUser'];
$contrasena = $_POST['password2'];
$confirmacion_contrasena = $_POST['password3'];
$clave_encriptada = md5($confirmacion_contrasena);
$idrol = $_POST['rol'];
$idgenero = $_POST['genero'];

                       //Insertar nuevo usuario en la base de datos
                        $query = "INSERT INTO tbl_ms_usuario (DNI, Usuario, Correo, Nombre, Direccion, FechaNacimiento, FechaContratacion, 
                                    Estado_Usuario, Contrasena, IdRol, IdGenero, Fecha_Creacion) 
                                    VALUES ('$dni', '$usuario', '$correo', '$nombre', '$direccion', '$fechanacimiento', 
                                    '$fechacontratacion', '$estadousuario', '$clave_encriptada', '$idrol', '$idgenero', NOW())";


$resultado_query = mysqli_query($conexion, $query);
if ($resultado_query) {
    enviarCorreo3($correo, $correo, $contrasena); // Validar que se insertó correctamente el registro
    // $n=$_SESSION['id_D'];          //obtiene valor de la variable session
    // $a='AGREGAR USUARIO';
    // $d='USUARIO '. $usuario .' FUE AGREGADO';
    // bitacora($n, $a, $d);
    
    echo '
        <script>
            MostrarAlerta("success", "¡GENIAL!", "Usuario almacenado correctamente.", "../V_Usuario/V_usuario.php");
        </script>
    ';
} else {
    echo '
        <script>
            MostrarAlerta("error", "ERROR", "Inténtalo de nuevo, usuario no almacenado.", "../V_Usuario/V_nuevo_usuario.php");
        </script>
    ';
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
