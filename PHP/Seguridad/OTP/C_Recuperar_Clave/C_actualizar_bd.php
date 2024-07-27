<?php
include '../../../Controladores/Conexion/Conexion_be.php';
require_once './C_recovery_controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password2 = $_POST['password2'];
    $password3 = $_POST['password3'];
    $correo = $_SESSION['correo3'] ; // Asegúrate de que este campo exista en tu formulario y se envíe correctamente

    // Verificar que las contraseñas coincidan
    if ($password2 !== $password3) {
        // Las contraseñas no coinciden, manejar el error aquí
        
        exit;
    }

    // Encriptar la contraseña antes de almacenarla en la base de datos
    $hashed_password = md5($password3);

    // Preparar la consulta SQL usando sentencias preparadas para evitar inyección SQL
    $actualizarUsuarioQuery2 = "UPDATE tbl_ms_usuario SET Contrasena = ?, Estado_Usuario = 1, intentos_fallidos = 0 WHERE Correo = ?";
    $stmt = mysqli_prepare($conexion, $actualizarUsuarioQuery2);

    // "ss" indica que ambos parámetros son cadenas (string)
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $correo);

    if (mysqli_stmt_execute($stmt)) {
         // Mensaje de éxito
         echo '
         <script>
             MostrarAlerta("Exito", "EXITO", "Se Guardo correctamente", "/index.php");
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