
<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Incluye el archivo de conexión y el controlador del perfil
include '../../Controladores/Conexion/Conexion_be.php';
include '../C_Perfil/C_perfil.php';

// Verifica si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $dni = $_POST['dni'];
    $direccion = $_POST['direccion'];

    // Prepara la consulta SQL para actualizar los datos en la base de datos
    $actualizarUsuarioQuery= "UPDATE tbl_ms_usuario SET Nombre = '$nombre', Usuario = '$usuario', Correo = '$correo', DNI = '$dni', Direccion = '$direccion' WHERE WHERE id_usuario = $id_usuario;"; // Cambia 'tabla_perfil' y 'id' según la estructura de tu base de datos
    // Ejecuta la consulta
    $resultado = mysqli_query($conexion, $query);

    // Verifica si la consulta se ejecutó correctamente
    if ($resultado) {
        // Redirige al usuario a las páginas V_perfil.php y V_usuario.php
        header("Location: ../../Vistas/V_perfil.php?mensaje=¡Los cambios se han guardado exitosamente!");
        header("Location: ../../Vistas/V_usuario.php?mensaje=¡Los cambios se han guardado exitosamente!");
        exit(); // Asegúrate de terminar el script después de redirigir al usuario
    } else {
        echo "Error al actualizar los datos en la base de datos.";
    }
}

?> 

