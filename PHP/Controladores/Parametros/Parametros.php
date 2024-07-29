<?php
// Borra el caché de la página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Incluir el archivo de conexión a la base de datos
require_once '../Conexion/Conexion_be.php';

try {
    // Consulta SQL para obtener los parámetros
    $sql = "SELECT Parametro, Valor FROM tbl_ms_parametros";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Ejecutar la consulta
    $stmt->execute();

    // Inicializar un arreglo para almacenar los parámetros
    $parametros = array();

    // Obtener los resultados como un array asociativo
    $resultados = $mysqli_stmt::fetchAll(PDO::FETCH_ASSOC);

    // Asignar los valores de los parámetros al arreglo
    foreach ($resultados as $row) {
        $parametros[$row['Parametro']] = $row['Valor'];
    }

    // Ahora puedes acceder a los valores de los parámetros utilizando el nombre del parámetro como clave en el arreglo
    // Por ejemplo:
    $cantidad_minima_clave = isset($parametros['CANT_MIN_CLAVE']) ? $parametros['CANT_MIN_CLAVE'] : null;
    $cantidad_maxima_clave = isset($parametros['CANT_MAX_CLAVE']) ? $parametros['CANT_MAX_CLAVE'] : null;
    $Servidor_SMTP = isset($parametros['Servidor_SMTP']) ? $parametros['Servidor_SMTP'] : null;
    $Clave_SMTP = isset($parametros['Clave_SMTP']) ? $parametros['Clave_SMTP'] : null;
    $Correo_SMTP = isset($parametros['Correo_SMTP']) ? $parametros['Correo_SMTP'] : null;
    $Cifrado_SMTP = isset($parametros['Cifrado_SMTP']) ? $parametros['Cifrado_SMTP'] : null;
    $Puerto_SMTP = isset($parametros['Puerto_SMTP']) ? $parametros['Puerto_SMTP'] : null;
    $Nombre_Sistema = isset($parametros['Nombre_Sistema']) ? $parametros['Nombre_Sistema'] : null;

    // Ahora puedes utilizar estas variables en tu aplicación según sea necesario
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>
