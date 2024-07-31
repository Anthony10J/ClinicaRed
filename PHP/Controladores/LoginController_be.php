<?php
session_start();
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include('../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php');
include('../Controladores/Conexion/Conexion_be.php');
include('../../Recursos/SweetAlerts.php');
include('../../Seguridad/Roles.php');
include('./bitacora.php');

require_once('EnvioOTP/EnviarOTP.php');

$correo = $_POST['correo'];
$clave = $_POST['password'];
$clave_encriptada = md5($clave);

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

if (!empty($correo) && !empty($clave_encriptada)) { // Validar que el correo y contraseña no estén vacíos.
    // Verificar el número de intentos fallidos y el estado del usuario
    $consulta_intentos = "SELECT intentos_fallidos, Estado_Usuario FROM tbl_ms_usuario WHERE Correo = '$correo'";
    $resultado_intentos = mysqli_query($conexion, $consulta_intentos);
    $fila_intentos = $resultado_intentos->fetch_assoc();

    if ($fila_intentos['Estado_Usuario'] == 3) {
        // Reiniciar los intentos fallidos pero mantener el estado bloqueado
        $reiniciar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = 0 WHERE Correo = '$correo'";
        mysqli_query($conexion, $reiniciar_intentos);
        $mensajeError = "Cuenta bloqueada. Contacte al administrador.";
    } else {
        $consultar_Login = "SELECT estU.Descripcion, u.Id_Usuario, u.Correo, u.Contrasena, u.Usuario, u.Nombre, u.IdRol, r.Rol, u.primer_ingreso 
                            FROM tbl_estado_usuario AS estU 
                            INNER JOIN tbl_ms_usuario AS u ON estU.Id_Estado = u.Estado_Usuario
                            INNER JOIN tbl_ms_roles AS r ON u.IdRol = r.Id_Rol
                            WHERE estU.Id_Estado IN(1, 2) AND u.Correo = '$correo' AND u.Contrasena = '$clave_encriptada'";

        $consultar_Parametro = "SELECT Parametro, Valor FROM tbl_ms_parametros WHERE Parametro LIKE 'INTENTOS_FALLIDOS'";

        $verificar_login = mysqli_query($conexion, $consultar_Login); // Validar que existe una conexión a la BD y se realiza una consulta
        $verificar_parametro = mysqli_query($conexion, $consultar_Parametro); // Validar que existe una conexión a la BD y se realiza una consulta
        $fila = $verificar_login->fetch_assoc();
        $row = $verificar_parametro->fetch_assoc();

        if (mysqli_num_rows($verificar_login) > 0) {
            // Si no es el primer ingreso o si es el primer ingreso y se ha superado el captcha, proceder con el inicio de sesión.
            if ($fila['primer_ingreso'] != 0 || ($fila['primer_ingreso'] == 0 && isset($_POST['g-recaptcha-response']))) {
                if ($fila['primer_ingreso'] == 0) { // Si es primer ingreso, actualizar el campo primer_ingreso a 1
                    // Verificar captcha solo si es el primer ingreso
                    if (!isset($_POST['g-recaptcha-response'])) {
                        $mensajeError = "Es necesario completar el captcha para el primer inicio de sesión.";
                    } else {
                        $captcha = $_POST['g-recaptcha-response'];
                        $secret = '6LfmNZMpAAAAAGtglVeRgJ83DglCNBPQDnOimzMG';
                        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
                        $arr = json_decode($response, TRUE);

                        if (!$arr['success']) {
                            $mensajeError = "Por favor verifica el captcha.";
                        } else {
                            // Si no hay mensaje de error después de verificar el captcha, actualizar primer_ingreso a 1
                            $actualizar_primer_ingreso = "UPDATE tbl_ms_usuario SET primer_ingreso = 1, Primer_Inicio_Sesion = NOW(), Estado_Usuario = 1 WHERE Correo = '$correo'";
                            mysqli_query($conexion, $actualizar_primer_ingreso);
                        }
                    }
                }

                // Si no hay mensaje de error después de la verificación del captcha, proceder con el inicio de sesión
                if (empty($mensajeError)) {
                    // Validar que existe el registro en la base de datos para iniciar sesión
                    $_SESSION['correo'] = $correo;  // Almacena el usuario/correo que inició sesión en el sistema.
                    $_SESSION['rol'] = $fila['Rol'];
                    $_SESSION['usuario'] = $fila['Usuario'];
                    $_SESSION['nombre'] = $fila['Nombre'];
                    $_SESSION['id_D'] = $fila['Id_Usuario'];
                    $_SESSION['IdRol'] = $fila['IdRol'];

                    // Reiniciar los intentos fallidos a 0 después de un inicio de sesión exitoso
                    $reiniciar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = 0 WHERE Correo = '$correo'";
                    mysqli_query($conexion, $reiniciar_intentos);

                    $fecha = date("Y-m-d H:i:s");
                    $n = $fila['Id_Usuario'];
                    $a = 'INICIO DE SESIÓN';
                    $d = $_SESSION['usuario'] . ' INICIÓ SESIÓN';
                    $o= $id_objeto;
                    bitacora($n, $a, $d, $o);
                    //  enviarOTP($conexion, $correo);
                   header("location: ../Vistas/Main.php"); // Redirecciona al usuario a la página principal
                   exit();
                }
            } else {
                $mensajeError = "Es necesario completar el captcha para el primer inicio de sesión.";
            }
        } else {
            // Incrementar el contador de intentos fallidos
            $incrementar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = intentos_fallidos + 1 WHERE Correo = '$correo'";
            mysqli_query($conexion, $incrementar_intentos);

            // Verificar si los intentos fallidos han alcanzado el límite
            $consulta_intentos_actualizados = "SELECT intentos_fallidos FROM tbl_ms_usuario WHERE Correo = '$correo'";
            $resultado_intentos_actualizados = mysqli_query($conexion, $consulta_intentos_actualizados);
            $fila_intentos_actualizados = $resultado_intentos_actualizados->fetch_assoc();

            if ($fila_intentos_actualizados['intentos_fallidos'] >= $row['Valor']) {
                // Actualizar el estado del usuario a 3 (bloqueado)
                $actualizar_estado = "UPDATE tbl_ms_usuario SET Estado_Usuario = 3 WHERE Correo = '$correo'";
                mysqli_query($conexion, $actualizar_estado);
                // Reiniciar los intentos fallidos
                $reiniciar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = 0 WHERE Correo = '$correo'";
                mysqli_query($conexion, $reiniciar_intentos);
            }

            $mensajeError = "Correo o contraseña incorrectos.";
        }
    }
}

if (!empty($mensajeError)) {
    header("location: /index.php?error=" . urlencode($mensajeError));
    exit();
}
?>
