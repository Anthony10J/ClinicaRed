<?php 
class Parametro {
    public static function dataServer()
    {
        include('../Conexion/Conexion_be.php');
       // $conn = $conexion;
        try {
            $parametro = array();
            $query = "SELECT Parametro, Valor FROM tbl_ms_parametros WHERE Parametro 
            IN('Servidor_SMTP','Correo_SMTP','Clave_SMTP','Cifrado_SMTP','Puerto_SMTP', 'Nombre_Sistema');";
            $resultado = mysqli_query($conexion, $query);
            //Fetch assoc: solo toma una linea donde convierte un array para recibir un resultado
            while ($fila = mysqli_fetch_assoc($resultado)){
                switch ($fila['Parametro']) {
                    case 'Servidor_SMTP':
                        $parametro += [
                            'Servidor_SMTP' => $fila['Valor']
                        ];
                        break;
                    case 'Correo_SMTP':
                        $parametro += [
                            'Correo_SMTP' => $fila['Valor']
                        ];
                        break;
                    case 'Clave_SMTP':
                        $parametro += [
                            'Clave_SMTP' => $fila['Valor']
                        ];
                        break;
                        case 'Cifrado_SMTP':
                            $parametro += [
                                'Cifrado_SMTP' => $fila['Valor']
                            ];
                            break;
                            case 'Nombre_Sistema':
                                $parametro += [
                                    'Nombre_Sistema' => $fila['Valor']
                                ];
                                break;
                    default:
                        $parametro += [
                            'Puerto_SMTP' => $fila['Valor']
                        ];
                        break;
                }
            }
        } catch (Exception $e) {
            echo '
            <script> Error SQL: </script>
            ' . $e;
        }
        mysqli_close($conexion); //Cerrar conexion
        return $parametro;
    }

}
