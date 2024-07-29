<?php 
class Parametro {
    public static function dataServer()
    {
        include('../Conexion/Conexion_be.php');

        // Verificar si la conexión es exitosa
        if (!$conexion) {
            error_log('Conexión fallida: ' . mysqli_connect_error());
            return [];
        }

        try {
            $parametro = array();
            $query = "SELECT Parametro, Valor FROM tbl_ms_parametros WHERE Parametro 
            IN('Servidor_SMTP','Correo_SMTP','Clave_SMTP','Cifrado_SMTP','Puerto_SMTP', 'Nombre_Sistema');";
            $resultado = mysqli_query($conexion, $query);

            if (!$resultado) {
                error_log('Error en la consulta: ' . mysqli_error($conexion));
                mysqli_close($conexion);
                return [];
            }

            while ($fila = mysqli_fetch_assoc($resultado)){
                $parametro[$fila['Parametro']] = $fila['Valor'];
            }
        } catch (Exception $e) {
            error_log('Error SQL: ' . $e->getMessage());
        } finally {
            mysqli_close($conexion); // Cerrar conexión
        }

        return $parametro;
    }
}
