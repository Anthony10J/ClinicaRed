<?php
// require_once('../Controladores/conexiondb.php'); // Asegúrate de importar la conexión a la base de datos

// // Obtén el número de identificación del cliente
// $numeroIdentificacion = $_POST['numero_de_documento']; // O $_GET['numero'] si estás usando GET

// // Consulta la base de datos para verificar si el número de identificación ya existe
// $query = "SELECT Numero_Documento FROM tbl_paciente WHERE Numero_Documento = ?";
// $stmt = $conn->prepare($query);
// $stmt->bind_param("s", $numeroIdentificacion);
// $stmt->execute();
// $result = $stmt->get_result();

// // Verifica si se encontró un registro con el número de identificación
// $existe = $result->num_rows > 0;

// // Cierra la declaración y la conexión
// $stmt->close();
// $conn->close();

// // Envía una respuesta JSON al cliente
// header('Content-Type: application/json');
// echo json_encode(array('existe' => $existe));
?>
<?php
require_once('../Controladores/conexiondb.php');

// Recibir el DNI desde la solicitud POST
if (isset($_POST["numero_de_documento"])) {
    $n_documento = $_POST["numero_de_documento"];

    // Ejecutar la consulta SQL
    $sql = "SELECT COUNT(*) FROM tbl_paciente WHERE Numero_Documento = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }
    $stmt->bind_param("s", $n_documento);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    // Enviar la respuesta al usuario
    if ($count > 0) {
        // El DNI ya existe
        echo "existe";
    } else {
        // El DNI no existe
        echo "ok";
    }

    $stmt->close();
} else {
    // Si no se proporciona un DNI, devuelve un mensaje de error
    echo "error";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
