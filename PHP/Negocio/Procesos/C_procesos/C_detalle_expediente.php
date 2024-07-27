<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

$Id_Usuario = $_SESSION['id_D'];
// Incluir el archivo de conexión a la base de datos si aún no está incluido
include_once '../../../Controladores/Conexion/Conexion_be.php';

// Verificar si la variable de sesión no está establecida para evitar la ejecución repetida
if (!isset($_SESSION['detalle_expediente_ejecutado'])) {
    // Establecer la variable de sesión para indicar que el archivo se ha ejecutado
    $_SESSION['detalle_expediente_ejecutado'] = true;

    // Recuperar el arreglo de la variable de sesión
    $datos = isset($_SESSION['datos']) ? $_SESSION['datos'] : null;

    // Verificar si la variable de sesión tiene un valor válido
    if ($datos) {
        // Dividir la cadena en un array usando el separador '||'
        $datos_array = explode("||", $datos);

        // Obtener los valores de ID de cita y ID de expediente
        $id_cita = $datos_array[0];
        $id_expediente = $datos_array[5];

        // Ejecutar la inserción con los valores de cita y expediente
        $sql = "INSERT INTO tbl_detalle_expediente (Fecha_Evaluacion, Lateralidad, Referido, Id_Usuario, Id_Cita_Terapia, Id_Expediente)
                VALUES (NOW(), 0, 0, $Id_Usuario, $id_cita, $id_expediente)";

        if (mysqli_query($conexion, $sql)) {
            // Recuperar el último ID insertado
            $Id_Detalle_Expediente = mysqli_insert_id($conexion);

            // Almacenar el ID del detalle del expediente en una variable de sesión
            $_SESSION['Id_Detalle_Expediente'] = $Id_Detalle_Expediente;

            // Puedes utilizar el ID insertado según sea necesario
            // echo "Último ID insertado: " . $Id_Detalle_Expediente;
        } else {
            // Manejar errores si la consulta de inserción falla
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "No se han encontrado datos en la sesión.";
    }
}
