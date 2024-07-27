<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Archivo de conexión a la base de datos
$include('../Controladores/Conexion_be.php');

// Verificar si se ha enviado una solicitud POST para generar el PDF
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si se ha hecho clic en el botón "Generar PDF"
    if (isset($_POST['generar_pdf'])) {
        // Obtener los registros de la tabla bitacora
        $registros = obtenerRegistros();

        // Generar y descargar el PDF
        generarPDF($registros);
    }
    // Si se ha hecho clic en el botón "Depurar"
    elseif (isset($_POST['depurar'])) {
        // Depurar la bitácora (eliminar todos los registros)
        depurarBitacora();
    }
}

// Función para obtener los registros de la bitácora desde la base de datos
function obtenerRegistros() {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $database = "tu_base_de_datos";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los registros de la tabla bitacora
    $sql = "SELECT * FROM bitacora";
    $result = $conn->query($sql);

    $registros = array();
    while ($row = $result->fetch_assoc()) {
        $registros[] = $row;
    }

    // Cerrar la conexión
    $conn->close();

    return $registros;
}

// Función para generar el PDF con los registros de la bitácora
function generarPDF($registros) {
    // Crear un nuevo objeto TCPDF
    // $pdf = new TCPDF();

    // Establecer el título del documento
    // $pdf->SetTitle('Bitácora');

    // Agregar una página
    // $pdf->AddPage();

    // Crear la tabla para mostrar los registros
    $html = '<table border="1">';
    $html .= '<tr><th>ID</th><th>Fecha y Hora</th><th>Usuario</th><th>Objeto</th><th>Acción</th><th>Descripción</th></tr>';
    foreach ($registros as $registro) {
        $html .= '<tr>';
        $html .= '<td>' . $registro['id'] . '</td>';
        $html .= '<td>' . $registro['fecha_hora'] . '</td>';
        $html .= '<td>' . $registro['usuario'] . '</td>';
        $html .= '<td>' . $registro['objeto'] . '</td>';
        $html .= '<td>' . $registro['accion'] . '</td>';
        $html .= '<td>' . $registro['descripcion'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';

    // Agregar la tabla al documento PDF
    // $pdf->writeHTML($html, true, false, true, false, '');

    // Generar el PDF y mostrarlo al usuario para descargar
    // $pdf->Output('bitacora.pdf', 'D');
    exit();
}

// Función para depurar la bitácora (eliminar todos los registros)
function depurarBitacora() {
    // Conectar a la base de datos
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $database = "tu_base_de_datos";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Eliminar todos los registros de la tabla bitacora
    $sql = "DELETE FROM bitacora";

    if ($conn->query($sql) === TRUE) {
        echo "Bitácora depurada correctamente";
    } else {
        echo "Error al depurar la bitácora: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Bitácora</title>
    <!-- Agregar las bibliotecas de Bootstrap y jQuery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <!-- Agregar el panel de control de Bootstrap -->
    <div class="container mt-4">
        <div class="row justify-content-center"> <!-- Centrar a la izquierda -->
            <div class="col-md-11 offset-md-3">
                <div class="card custom-card">
                    <div class="card-header">
                        <h2 class="text-left">Bitácora</h2>
                    </div>
                    <div class="card-body">
                        <!-- Botón para generar PDF -->
                        <form method="post">
                            <button type="submit" name="generar_pdf" class="btn btn-secondary"><i class="fas fa-file-pdf"></i> Generar PDF</button>
                        </form>
                        <!-- Botón para depurar la bitácora -->
                        <form method="post">
                            <button type="submit" name="depurar" class="btn btn-danger mt-3"><i class="fas fa-trash"></i> Depurar Bitácora</button>
                        </form>
                        <!-- Resto del contenido del formulario... -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
