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

    // Obtener los resultados como un array asociativo
    foreach ($resultados as $row) {
        $parametro = $row['Parametro'];
        $valor = $row['Valor'];

        // Asignar los valores de los parámetros al arreglo
        $parametros[$parametro] = $valor;
    }

    // Ahora puedes acceder a los valores de los parámetros utilizando el nombre del parámetro como clave en el arreglo
    // Por ejemplo:
    $cantidad_minima_clave = $parametros['CANT_MIN_CLAVE'];
    $cantidad_maxima_clave = $parametros['CANT_MAX_CLAVE'];
    $Servidor_SMTP = $parametros['Servidor_SMTP'];
    $Clave_SMTP = $parametros['Clave_SMTP'];
    $Correo_SMTP = $parametros['Correo_SMTP'];
    $Cifrado_SMTP = $parametros['Cifrado_SMTP'];
    $Puerto_SMTP = $parametros['Puerto_SMTP'];
    $Nombre_Sistema = $parametros['Nombre_Sistema'];

    // Ahora puedes utilizar estas variables en tu aplicación según sea necesario
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>
