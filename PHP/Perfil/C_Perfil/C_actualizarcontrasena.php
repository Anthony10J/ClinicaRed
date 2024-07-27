<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../Controladores/Conexion/Conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password4 = $_POST['password2'];
    $password5 = $_POST['password3'];
    $correo = $_SESSION['correo'] ; // Asegúrate de que este campo exista en tu formulario y se envíe correctamente

    // Verificar que las contraseñas coincidan
    if ($password4 !== $password5) {
        // Las contraseñas no coinciden, manejar el error aquí
        
        exit;
    }

    // Encriptar la contraseña antes de almacenarla en la base de datos
    $hashed_password = md5($password5);

    // Preparar la consulta SQL usando sentencias preparadas para evitar inyección SQL
    $actualizarUsuarioQuery3 = "UPDATE tbl_ms_usuario SET Contrasena = ? WHERE Correo = ?";
    $stmt = mysqli_prepare($conexion, $actualizarUsuarioQuery3);

    // "ss" indica que ambos parámetros son cadenas (string)
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $correo);

    if (mysqli_stmt_execute($stmt)) {
         // Mensaje de éxito
         echo '
         <script>
             MostrarAlerta("success", "EXITO", "Se Guardo correctamente", "../../Controladores/Logout.php");
         </script>
       ';
        
        // Redireccionar a la página principal o mostrar un mensaje de éxito
        header("Location: ../../Controladores/Logout.php");
        exit();
    } else {
        echo "Error al guardar los cambios: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
}
?>