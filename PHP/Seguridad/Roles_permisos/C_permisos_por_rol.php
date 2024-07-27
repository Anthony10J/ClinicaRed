<?php
include '../../../Controladores/Conexion/Conexion_be.php';

// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Conexión a la base de datos (debes reemplazar estos valores con los tuyos)
$servername = "localhost";
$username = "Id_Usuario";
$password = "Contrasena";
$database = "clinica_red";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para obtener el rol del usuario
function obtenerRol($usuario, $contrasena, $conn) {
    $sql = "SELECT IdRol FROM tbl_ms_usuarios WHERE Usuario = ? AND Contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['IdRol']; // Cambiado de 'Rol' a 'IdRol'
    } else {
        return false; // El usuario no existe o la contraseña es incorrecta
    }
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'];
    $contrasena = $_POST['Contrasena'];

    // Verificar si el usuario existe y obtener su rol
    $rol = obtenerRol($usuario, $contrasena, $conn);

    if ($rol) {
        // Usuario y contraseña válidos, establecer sesión y redirigir según el rol
        $_SESSION['Usuario'] = $usuario;
        $_SESSION['Rol'] = $rol;
        
        // Redireccionar según el rol
        switch ($rol) {
            case 'SUPERADMINISTRADOR':
            case 'ADMINISTRADOR':
                header("Location: ../../../V_Usuario/V_usuario.php"); 
                break;
            case 'SECRETARIA':
                header("Location: ../../../../V_modal_EClinico.php");
                break;
            case 'FISIATRA':
                header("Location: ../../../../V_roles.php");
                break;
            case 'TERAPEUTA':
                header("Location: ../../../Bitacora.php");
                break;
            default:
                header("Location: ../../../Dashboard.php");
                break;
        }
    } else {
        // Usuario o contraseña incorrectos, redirigir al login con un mensaje de error
        header("Location: /index.php?error=1");
    }
}

// Cerrar conexión
$conn->close();
?>
