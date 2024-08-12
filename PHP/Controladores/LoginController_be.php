<?php
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include('../Controladores/Conexion/Conexion_be.php');
include('../../Recursos/SweetAlerts.php');
include('../../Seguridad/Roles.php');
include('./bitacora.php');
include('../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php');

require_once('EnvioOTP/EnviarOTP.php');


$correo = $_POST['correo'];
$clave = $_POST['password'];
$clave_encriptada = md5($clave);





if (!empty($correo) && !empty($clave_encriptada)) {
    $consulta_intentos = "SELECT intentos_fallidos, Estado_Usuario, Id_Usuario FROM tbl_ms_usuario WHERE Correo = '$correo'";
    $resultado_intentos = mysqli_query($conexion, $consulta_intentos);
    $fila_intentos = $resultado_intentos->fetch_assoc();

    if ($fila_intentos['Estado_Usuario'] == 3) {
        // $reiniciar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = 0 WHERE Correo = '$correo'";
        // mysqli_query($conexion, $reiniciar_intentos);
        $mensajeError = "Cuenta bloqueada. Contacte al administrador.";
    } else {
        $consultar_Login = "SELECT estU.Descripcion, u.Id_Usuario, u.Correo, u.Contrasena, u.Usuario, u.Nombre, u.IdRol, r.Rol, u.primer_ingreso 
                            FROM tbl_estado_usuario AS estU 
                            INNER JOIN tbl_ms_usuario AS u ON estU.Id_Estado = u.Estado_Usuario
                            INNER JOIN tbl_ms_roles AS r ON u.IdRol = r.Id_Rol
                            WHERE estU.Id_Estado IN(1) AND u.Correo = '$correo' AND u.Contrasena = '$clave_encriptada'";

        $consultar_Parametro = "SELECT Parametro, Valor FROM tbl_ms_parametros WHERE Parametro LIKE 'INTENTOS_FALLIDOS'";

        $verificar_login = mysqli_query($conexion, $consultar_Login);
        $verificar_parametro = mysqli_query($conexion, $consultar_Parametro);
        $fila = $verificar_login->fetch_assoc();
        $row = $verificar_parametro->fetch_assoc();

        if (mysqli_num_rows($verificar_login) > 0) {
            if ($fila['primer_ingreso'] != 0 || ($fila['primer_ingreso'] == 0 && isset($_POST['g-recaptcha-response']))) {
                if ($fila['primer_ingreso'] == 0) {
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
                            $actualizar_primer_ingreso = "UPDATE tbl_ms_usuario SET primer_ingreso = 1, Primer_Inicio_Sesion = NOW(), Estado_Usuario = 1 WHERE Correo = '$correo'";
                            mysqli_query($conexion, $actualizar_primer_ingreso);
                        }
                    }
                }

                if (empty($mensajeError)) {
                    $_SESSION['correo'] = $correo;
                    $_SESSION['rol'] = $fila['Rol'];
                    $_SESSION['usuario'] = $fila['Usuario'];
                    $_SESSION['nombre'] = $fila['Nombre'];
                    $_SESSION['id_D'] = $fila['Id_Usuario'];
                    $_SESSION['IdRol'] = $fila['IdRol'];

                    $reiniciar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = 0 WHERE Correo = '$correo'";
                    mysqli_query($conexion, $reiniciar_intentos);

                    echo "ID Objeto: " . $id_objeto;
                    $fecha = date("Y-m-d H:i:s");
                    $n = $fila['Id_Usuario'];
                    $a = 'INICIO DE SESIÓN';
                    $d = $_SESSION['usuario'] . ' INICIÓ SESIÓN';
                    $o= 5;
                    bitacora($n, $a, $d, $o);
                    //  enviarOTP($conexion, $correo);

                    if ($_SESSION['IdRol'] == 2) {
                        $mensajeError = "Contacte al administrador para definir el rol de usuario.";
                    } else {
                        header("location: ../Vistas/Main.php");
                        exit();
                    }
                }
            } else {
                $mensajeError = "Es necesario completar el captcha para el primer inicio de sesión.";
            }
        } else {
            $incrementar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = intentos_fallidos + 1 WHERE Correo = '$correo' and IdRol <> 1";
            mysqli_query($conexion, $incrementar_intentos);

            $consulta_intentos_actualizados = "SELECT intentos_fallidos FROM tbl_ms_usuario WHERE Correo = '$correo'";
            $resultado_intentos_actualizados = mysqli_query($conexion, $consulta_intentos_actualizados);
            $fila_intentos_actualizados = $resultado_intentos_actualizados->fetch_assoc();

            if ($fila_intentos_actualizados['intentos_fallidos'] >= $row['Valor']) {
                $actualizar_estado = "UPDATE tbl_ms_usuario SET Estado_Usuario = 3 WHERE Correo = '$correo'";
                mysqli_query($conexion, $actualizar_estado);
                $reiniciar_intentos = "UPDATE tbl_ms_usuario SET intentos_fallidos = 0 WHERE Correo = '$correo'";
                mysqli_query($conexion, $reiniciar_intentos);
            }

                    //Registrar intento fallido en la bitácora
                    $fecha = date("Y-m-d H:i:s");
                    $n = $fila_intentos['Id_Usuario'] ;//  usar un identificador si lo hay o dejar 0
                    $a = 'INTENTO FALLIDO';
                    $d = 'EL USUARIO CON CORREO ' . $correo . ' INTENTÓ INICIAR SESIÓN CON UNA CONTRASENA INCORRECTA';
                    $o = 5;
                    bitacora($n, $a, $d, $o);
    
                   $mensajeError = "Correo o contraseña incorrectos.";
        }
    }
}

if (!empty($mensajeError)) {
    header("location: /index.php?error=" . urlencode($mensajeError));
    exit();
}
?>
