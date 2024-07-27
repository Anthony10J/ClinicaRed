<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

if (isset($_SESSION['Detalle_Terapia'])) {
    $Id_Detalle_Terapia = $_SESSION['Detalle_Terapia'];
} else {
    // Si el ID de detalle de terapia no está definido en la sesión, puedes manejarlo según tus requisitos.
    // Aquí, por ejemplo, lo estableceré en 0 si no está definido.
    $Id_Detalle_Terapia = 0;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del cuerpo de la solicitud POST
    $datos_json = file_get_contents("php://input");

    // Decodificar los datos JSON en un array asociativo
    $datos = json_decode($datos_json, true);

    if (!empty($datos) && is_array($datos)) {
        // Conexión a la base de datos
        include('../../../Controladores/Conexion/Conexion_be.php');

        // Iniciar una transacción para garantizar la integridad de los datos
        $conexion->begin_transaction();

        try {
            // Preparar la consulta de actualización una sola vez fuera del bucle foreach
            $sql = "UPDATE tbl_detalle_terapia_tratamiento
                    SET Resultado = ?
                    WHERE Id_Detalle_Terapia = ? AND Id_Tipo_Terapia = ?";

            $stmt = $conexion->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error al preparar la consulta: " . $conexion->error);
            }

            // Iterar sobre los datos recibidos y realizar la actualización
            foreach ($datos as $id => $resultado) {
                // Verificar si el resultado no está vacío y es una cadena de texto
                if (!empty($resultado) && is_string($resultado)) {
                    // Escapar los datos para prevenir inyecciones SQL
                    $id_terapia = intval($id);
                    $resultado_escaped = $conexion->real_escape_string($resultado);

                    // Enlazar los parámetros a la consulta
                    $stmt->bind_param("sii", $resultado_escaped, $Id_Detalle_Terapia, $id_terapia);

                    // Ejecutar la consulta de actualización
                    $stmt->execute();

                    // Verificar si la consulta afectó alguna fila
                    if ($stmt->affected_rows === 0) {
                        throw new Exception("No se realizó la actualización para Id: $id_terapia. Verifica si los datos ingresados son correctos.");
                    }
                } else {
                    // Datos no válidos
                    throw new Exception("Error: Datos no válidos para Id: $id.");
                }
            }

            // Confirmar la transacción si todo ha ido bien
            $conexion->commit();
            echo "Datos actualizados correctamente.";
        } catch (Exception $e) {
            // Si ocurre algún error, revertir la transacción
            $conexion->rollback();
            echo "Error: " . $e->getMessage();
        }

        // Cerrar la consulta preparada y la conexión a la base de datos
        $stmt->close();
        $conexion->close();
    } else {
        // No se recibieron datos válidos
        echo "Error: No se recibieron datos válidos.";
    }
} else {
    // La solicitud no es de tipo POST
    echo "Error: La solicitud debe ser de tipo POST.";
}
?>
