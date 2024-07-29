<?php
session_start(); // Asegúrate de iniciar la sesión al principio del script
include '../../../Controladores/Conexion/Conexion_be.php';
require_once './C_recovery_controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password2 = $_POST['password2'];
    $password3 = $_POST['password3'];
    $correo = $_SESSION['correo3']; // Asegúrate de que este campo exista en tu formulario y se envíe correctamente

    // Verificar que las contraseñas coincidan
    if ($password2 !== $password3) {
        echo '
        <script>
            MostrarAlerta("Error", "ERROR", "Las contraseñas no coinciden", "");
        </script>
        ';
        exit;
    }

    // Encriptar la nueva contraseña antes de verificar y almacenarla en la base de datos
    $hashed_password = md5($password3);

    // Preparar la consulta para obtener el ID del usuario
    $query_get_user_id = "SELECT Id_Usuario FROM tbl_ms_usuario WHERE Correo = ?";
    $stmt_get_user_id = mysqli_prepare($conexion, $query_get_user_id);
    mysqli_stmt_bind_param($stmt_get_user_id, "s", $correo);
    mysqli_stmt_execute($stmt_get_user_id);
    mysqli_stmt_bind_result($stmt_get_user_id, $id_usuario);
    mysqli_stmt_fetch($stmt_get_user_id);
    mysqli_stmt_close($stmt_get_user_id);

    // Verificar si el usuario existe
    // if (!$id_usuario) {
    //     echo '
    //     <script>
    //         MostrarAlerta("Error", "ERROR", "Usuario no encontrado", "");
    //     </script>
    //     ';
    //     exit;
    // }

    // Verificar si la nueva contraseña ya ha sido utilizada anteriormente
    $query_check_password = "SELECT Contrasena FROM tbl_ms_hist_contrasena WHERE Id_Usuario = ? AND Contrasena = ?";
    $stmt_check_password = mysqli_prepare($conexion, $query_check_password);
    mysqli_stmt_bind_param($stmt_check_password, "is", $id_usuario, $hashed_password);
    mysqli_stmt_execute($stmt_check_password);
    mysqli_stmt_store_result($stmt_check_password);

    if (mysqli_stmt_num_rows($stmt_check_password) > 0) {
        // Contraseña reutilizada
        echo '
        <script>
            MostrarAlerta("Error", "ERROR", "La nueva contraseña ya ha sido utilizada anteriormente", "/PHP/Seguridad/OTP/V_Recuperar_Clave/V_cambiar_clave.php");
        </script>
        ';
        mysqli_stmt_close($stmt_check_password);
        exit;
    }
    mysqli_stmt_close($stmt_check_password);

    // Actualizar la contraseña en la base de datos
    $actualizarUsuarioQuery2 = "UPDATE tbl_ms_usuario SET Contrasena = ?, Estado_Usuario = 1, intentos_fallidos = 0 WHERE Correo = ?";
    $stmt = mysqli_prepare($conexion, $actualizarUsuarioQuery2);
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $correo);

    if (mysqli_stmt_execute($stmt)) {
        // Registrar la nueva contraseña en el historial
        $insert_hist_query = "INSERT INTO tbl_ms_hist_contrasena (Id_Usuario, Contrasena) VALUES (?, ?)";
        $stmt_insert_hist = mysqli_prepare($conexion, $insert_hist_query);
        mysqli_stmt_bind_param($stmt_insert_hist, "is", $id_usuario, $hashed_password);
        mysqli_stmt_execute($stmt_insert_hist);
        mysqli_stmt_close($stmt_insert_hist);

        echo '
        <script>
            MostrarAlerta("Exito", "EXITO", "Se guardó correctamente", "/index.php");
        </script>
        ';

        // Redireccionar a la página principal o mostrar un mensaje de éxito
        header("Location: /index.php");
        exit();
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
}
?>
