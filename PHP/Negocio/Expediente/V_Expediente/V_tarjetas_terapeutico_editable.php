<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Código para generar las tarjetas dinámicamente
include('../../../Controladores/Conexion/Conexion_be.php');


if (isset($_SESSION['Detalle_Terapia'])) {
    $Id_Detalle_Terapia = $_SESSION['Detalle_Terapia'];
} else {
    unset($_SESSION['Detalle_Terapia']);
}

// Obtener el valor del tratamiento seleccionado
$idTratamiento = $_GET['tratamiento'];

// Consulta SQL para obtener los datos de las tarjetas asociadas al tratamiento seleccionado
$sql = "SELECT
    TT.Nombre AS TRATAMIENTO,
    TTER.idTipoTerapia AS Id,
    TTER.Nombre AS TIPO_TERAPIA
 FROM
    tbl_tipo_tratamiento AS TT
 INNER JOIN tbl_tipo_terapia AS TTER
 ON
    TT.Id_Tipo_Tratamiento = TTER.Id_Tipo_Tratamiento
 WHERE
    TT.Id_Tipo_Tratamiento = $idTratamiento";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Almacenar todos los resultados en un arreglo
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $tratamiento = $rows[0]["TRATAMIENTO"];
    
   // Imprimir tarjeta con ID único
echo '<div class="card" id="tarjeta_' . $idTratamiento . '">';
echo '<div class="divEvaluacion">';
echo '<label class="labelEvaluacion">' . $tratamiento . '</label>';
echo '<span class="icono-x-circle" onclick="cerrarTarjeta(\'tarjeta_' . $idTratamiento . '\')"><i class="fas fa-times-circle"></i></span>';
echo '</div>';

// Iniciar la primera columna
echo '<div class="columnas">';

// Realizar la segunda consulta
$sql2 = "SELECT
    DTT.Resultado,
    TT.idTipoTerapia
FROM
    tbl_cita_terapeutica AS CT
INNER JOIN tbl_detalle_terapia AS DT
ON
    CT.id_Cita_Terapia = DT.Id_Cita_Terapia
INNER JOIN tbl_detalle_terapia_tratamiento AS DTT
ON
    DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
INNER JOIN tbl_tipo_terapia AS TT
ON
    DTT.Id_Tipo_Terapia = TT.idTipoTerapia
INNER JOIN tbl_tipo_tratamiento AS TTRA
ON
    TT.Id_Tipo_Tratamiento = TTRA.Id_Tipo_Tratamiento
WHERE
    DT.Id_Detalle_Terapia = $Id_Detalle_Terapia";

$result2 = $conexion->query($sql2);

// Crear un mapa para almacenar los resultados
$mapaResultados = [];
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $mapaResultados[$row2['idTipoTerapia']] = $row2['Resultado'];
    }
}

// Luego, en el loop donde generas los inputs de las tarjetas:
foreach ($rows as $row) {
    $id = $row["Id"];
    $descripcion = $row["TIPO_TERAPIA"];

    // Verificar si hay un resultado para este tipo de terapia en el mapa
    $resultado = isset($mapaResultados[$id]) ? $mapaResultados[$id] : '';

    // Generar el input con el valor prellenado
    echo '<div class="columna">';
    echo '<form method="POST">';
    echo '<div class="divDescripcionEvaluacion">';
    echo '<div class="form-group">';
    echo '<label for="' . $id . '">' . ucwords($descripcion) . ':</label>';
    echo '<input type="text" class="formulario__input" id="' . $id . '" name="' . $id . '" value="' . htmlspecialchars($resultado, ENT_QUOTES) . '">';
    echo '</div>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}

// Cerrar la última columna y la tarjeta después de agregar todos los inputs
echo '</div>'; // Cerrar última columna
echo '</div>'; // Cerrar tarjeta
} else {
    echo "No se encontraron resultados.";
}
$conexion->close();
?>