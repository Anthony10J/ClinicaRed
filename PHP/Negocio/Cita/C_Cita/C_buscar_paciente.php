<?php
include '../../../Controladores/Conexion/Conexion_be.php';

// Recibir el DNI del POST y escapar el valor para prevenir inyección SQL
$dni = mysqli_real_escape_string($conexion, $_POST['dni']);

// Realizar la consulta preparada para obtener el nombre asociado al DNI
$query = "SELECT
            P.Nombre,
            P.Id_Paciente,
            E.id_Expediente
            FROM
            tbl_paciente AS P
            LEFT JOIN tbl_expediente AS E
            ON
            P.Id_Paciente = E.Id_Paciente
            WHERE P.Numero_Documento = ?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "s", $dni);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Obtener el primer (y único) resultado
    $fila = mysqli_fetch_assoc($resultado);
    // Valor predeterminado si no se encuentra el paciente
    $id_paciente = 1;
    $id_expediente = 1; 
    if ($fila) {
        // Obtener el nombre del resultado
        $nombre = $fila['Nombre'];
        $id_paciente = intval($fila['Id_Paciente']);
        $id_expediente = intval($fila['id_Expediente']);
    } else {
        // No se encontraron resultados para el DNI proporcionado
        $nombre = "No se encontró el paciente"; // Mensaje de error más descriptivo
    }
} else {
    // Hubo un error en la consulta SQL
    $nombre = "Error en la consulta SQL: " . mysqli_error($conexion); // Mensaje de error más descriptivo
}

// Imprimir el nombre (o enviarlo de vuelta como JSON si prefieres)
echo $nombre . "||" . $id_paciente . "||" . $id_expediente;
// Liberar resultado
mysqli_free_result($resultado);

// Cerrar consulta preparada
mysqli_stmt_close($stmt);

// Cerrar conexión
mysqli_close($conexion);
