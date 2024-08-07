<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include('../../../Controladores/Conexion/Conexion_be.php');
// session_start();
if (isset($_SESSION['Detalle_Expediente'])) {
    $id_detalle_expediente = $_SESSION['Detalle_Expediente'];
} 
function mostrarFormularioEditable($conexion, $id_evaluacion, $id_detalle_expediente)
{
    // Consulta para obtener los datos de la evaluación
    $sql = "SELECT E.Descripcion AS EvaluacionDescripcion, RE.Descripcion, RE.Id_Resultado_Evaluacion
            FROM tbl_evaluacion AS E
            INNER JOIN tbl_resultado_evaluacion AS RE ON E.Id_Evaluacion = RE.Id_Evaluacion
            WHERE E.Id_Evaluacion = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_evaluacion);
    $stmt->execute();
    $result = $stmt->get_result();

    // Consulta para obtener los resultados existentes
    $sql_values = "SELECT Id_Resultado_Evaluacion, Resultado 
                   FROM tbl_resultado_expediente
                   WHERE Id_Detalle_Expediente = ?";
    $stmt_values = $conexion->prepare($sql_values);
    $stmt_values->bind_param("i", $id_detalle_expediente);
    $stmt_values->execute();
    $values_result = $stmt_values->get_result();

    // Almacenar los valores existentes en un arreglo asociativo
    $existing_values = [];
    while ($row = $values_result->fetch_assoc()) {
        $existing_values[$row["Id_Resultado_Evaluacion"]] = $row["Resultado"];
    }

    if ($result->num_rows > 0) {
        // Almacenar todos los resultados en un arreglo
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Obtener la descripción de la evaluación
        $evaluacionDescripcion = $rows[0]["EvaluacionDescripcion"];

        // Mostrar los datos en labels y generar inputs
        echo '<div class="card">';
        echo '<div class="divEvaluacion">';
        echo '<label class="labelEvaluacion">' . $evaluacionDescripcion . '</label>';
        echo '</div>';
        echo '<div class="divDescripcionEvaluacion">';
        echo '<div class="columnas">';

        // Iterar sobre los resultados de la consulta
        foreach ($rows as $row) {
            $descripcion = $row["Descripcion"];
            $id_resultado = $row["Id_Resultado_Evaluacion"];

            // Obtener el valor existente si está disponible
            $valor_existente = isset($existing_values[$id_resultado]) ? $existing_values[$id_resultado] : '';

            // Mostrar el formulario con el valor existente como valor inicial
            echo '<div class="form-group">';
            echo '<label for="' . $id_resultado . '">' . ucwords($descripcion) . ':</label>';
            echo '<input type="text" class="formulario__input" name="' . $id_resultado . '" maxlength="20" value="' . htmlspecialchars($valor_existente, ENT_QUOTES) . '">';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>'; // Cerrar el div con la clase "card"
    } else {
        echo "No se encontraron resultados.";
    }
}


function ExpedienteClinicoEditable()
{
    include('../../../Controladores/Conexion/Conexion_be.php');
    $id_detalle_expediente = $_SESSION['Detalle_Expediente'];
    // Iniciar el formulario global
    echo '<form method="POST">';

    // Mostrar los datos del expediente
    mostrarFormularioEditable($conexion, 1, $id_detalle_expediente);
    mostrarFormularioEditable($conexion, 2, $id_detalle_expediente);
    mostrarFormularioEditable($conexion, 3, $id_detalle_expediente);

    echo '<hr>';

    // Agregar el botón de envío global
    echo '<button type="button" class="btn-guardar" onclick="confirmarEnvio()">Actualizar </button>';

    echo '</form>'; // Cerrar el formulario global

    // Verifica si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recuperar el ID de detalle de expediente de la sesión
        $id_detalle_expediente = $_SESSION['Detalle_Expediente']; // Asegúrate de utilizar el ID correcto aquí

        // Iterar sobre los datos enviados en el formulario
        foreach ($_POST as $key => $value) {
            // Verificar si el nombre del campo corresponde a un ID de resultado de evaluación
            if (is_numeric($key)) {
                // Validar que el campo no esté vacío y tenga menos de 20 caracteres
                if (!empty($value) && strlen($value) <= 20) {
                    // Realizar la actualización de la base de datos
                    actualizarResultados($conexion, $id_detalle_expediente, $key, $value);
                   
                }
            }
        }
        
    }

    // Cerrar la conexión
    $conexion->close();
}

function actualizarResultados($conexion, $id_detalle_expediente, $id_resultado_evaluacion, $nuevo_resultado)
{
    // Consulta SQL UPDATE para actualizar los resultados en la tabla tbl_resultado_expediente
    $sql_update = "UPDATE tbl_resultado_expediente
                   SET Resultado = ?
                   WHERE Id_Detalle_Expediente = ? and Id_Resultado_Evaluacion = ?";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql_update);

    // Vincular los parámetros: nuevo resultado, ID del detalle del expediente e ID del resultado de evaluación
    $stmt->bind_param("sii", $nuevo_resultado, $id_detalle_expediente, $id_resultado_evaluacion);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo '<h6 class="alert alert-success">Resultado actualizado con éxito</h6>';
      
    } else {
        echo '<h6 class="alert alert-danger">Error al actualizar el resultado</h6>';
    }

    // Cerrar la declaración preparada
    $stmt->close();
   
}

?>
