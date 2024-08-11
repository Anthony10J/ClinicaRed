<?php
include '../../../Controladores/Conexion/Conexion_be.php';

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener fechas desde la solicitud POST
if (isset($_POST['min']) && isset($_POST['max'])) {
    $fechaDesde = $_POST['min'] . ' 00:00:00'; // Fecha desde con la hora mínima
    $fechaHasta = $_POST['max'] . ' 23:59:59'; // Fecha hasta con la hora máxima

    // Consultar si hay registros en el rango de fechas
    $sqlCount = "SELECT COUNT(*) as total FROM tbl_bitacora WHERE Fecha BETWEEN '$fechaDesde' AND '$fechaHasta'";
    $resultCount = mysqli_query($conexion, $sqlCount);

    if ($resultCount) {
        $row = mysqli_fetch_assoc($resultCount);
        $totalRegistros = $row['total'];

        if ($totalRegistros > 0) {
            if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                // Hay registros y se solicita eliminar
                $sqlDelete = "DELETE FROM tbl_bitacora WHERE Fecha BETWEEN '$fechaDesde' AND '$fechaHasta'";
                if (mysqli_query($conexion, $sqlDelete)) {
                    echo json_encode(['success' => true, 'message' => 'Registros eliminados correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar registros: ' . mysqli_error($conexion)]);
                }
            } else {
                // Solo contamos los registros, no se solicita eliminación
                echo json_encode(['success' => true, 'total' => $totalRegistros]);
            }
        } else {
            // No hay registros en el rango
            echo json_encode(['success' => false, 'message' => 'No hay registros en el rango de fechas proporcionado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al contar los registros: ' . mysqli_error($conexion)]);
    }

    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Fechas no recibidas']);
}
?>
