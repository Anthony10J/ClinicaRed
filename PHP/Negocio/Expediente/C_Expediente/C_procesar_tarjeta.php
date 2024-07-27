<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Id_Detalle_Terapia = $_SESSION['Id_Detalle_Terapia'];
    // Obtener los datos del cuerpo de la solicitud POST
    $datos_json = file_get_contents("php://input");

    // Decodificar los datos JSON en un array asociativo
    $datos = json_decode($datos_json, true);

    if (!empty($datos) && is_array($datos)) {
        include('../../../Controladores/Conexion/Conexion_be.php');

        // Iniciar una transacción para garantizar la integridad de los datos
        $conexion->begin_transaction();

        try {
            foreach ($datos as $id => $resultado) {
                // Verificar si el resultado no está vacío y es una cadena de texto
                if (!empty($resultado) && is_string($resultado)) {
                    // Escapar los datos para prevenir inyecciones SQL
                    $id_terapia = intval($id);
                    $resultado_escaped = $conexion->real_escape_string($resultado);

                    // Preparar la consulta SQL
                    $sql = "INSERT INTO tbl_detalle_terapia_tratamiento (Id_Detalle_Terapia, Id_Tipo_Terapia, Resultado) VALUES ('$Id_Detalle_Terapia', ?, ?)";
                    $stmt = $conexion->prepare($sql);

                    if ($stmt) {
                        $stmt->bind_param("is", $id_terapia, $resultado_escaped);
                        $stmt->execute();

                        if ($stmt->affected_rows === 0) {
                            // Si no se afecta ninguna fila, lanzar una excepción
                            throw new Exception("Error al insertar los datos: " . $stmt->error);
                        }

                        $stmt->close();
                    } else {
                        // Error al preparar la consulta
                        throw new Exception("Error al preparar la consulta: " . $conexion->error);
                    }
                } else {
                    // Datos no válidos
                    throw new Exception("Error: Datos no válidos.");
                }
            }
            
            // Confirmar la transacción si todo ha ido bien
            $conexion->commit();
            unset($_SESSION['Id_Detalle_Terapia']); // Asignar un valor null
            $Id_Detalle_Terapia = '';
            // echo '<h6 id="" class="alert alert-success">Datos insertados correctamente</h6>';
            // include '../../../../Recursos/SweetAlerts.php';
            // echo '
            // <script>
            // MostrarAlerta("Success", "", "Datos insertados correctamente", "../../../Vistas/Main.php");
            // </script>
            // ';
            // echo '
            // <script>
            // Swal.fire({
            //     position: "top-end",
            //     icon: "success",
            //     title: "Your work has been saved",
            //     showConfirmButton: false,
            //     timer: 1500
            // });
            // </script>
            // ';
        } catch (Exception $e) {
            // Si ocurre algún error, revertir la transacción y mostrar el mensaje de error
            $conexion->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        // No se recibieron datos válidos
        echo "Error: No se recibieron datos válidos.";
    }
} else {
    // La solicitud no es de tipo POST
    echo "Error: La solicitud debe ser de tipo POST.";
}
?>
