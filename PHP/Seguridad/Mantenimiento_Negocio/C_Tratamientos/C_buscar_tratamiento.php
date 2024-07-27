<?php
include '../../../Controladores/Conexion/Conexion_be.php';

// Recibir el parámetro del POST y escapar el valor para prevenir inyección SQL
$tratamiento = mysqli_real_escape_string($conexion, $_POST['tratamiento']);

// Realizar la consulta preparada para obtener el parámetro
$query = "SELECT Nombre FROM tbl_tipo_terapia WHERE Nombre = ?";
$stmt = mysqli_prepare($conexion, $query);

// Verificar si la consulta preparada fue exitosa
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $tratamiento);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar si la consulta fue exitosa
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        // Verifica si se encontró una fila
        if ($fila) {
            // Devuelve un JSON indicando que el parámetro ya existe
            echo json_encode(['existe' => true]);
        } else {
            // Devuelve un JSON indicando que el parámetro no existe
            echo json_encode(['existe' => false]);
        }
    } else {
        echo json_encode(['error' => 'Error en la consulta SQL: ' . mysqli_error($conexion)]);
    }

    // Liberar resultado
    mysqli_free_result($resultado);
    // Cerrar consulta preparada
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Error en la consulta preparada: ' . mysqli_error($conexion)]);
}

// Cerrar conexión
mysqli_close($conexion);
?>
