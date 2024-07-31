<?php
session_start();

include '../../Controladores/Conexion/Conexion_be.php';
error_reporting(E_PARSE);
/*Solo modifica lo que se encuentra en medio de las segundas
 comillas de los parentesis. Ejemplo: define("USER", "valor que ingresaras" ); 
 */

// //Nombre de usuario de mysql
// define("USER", "root");

// //Servidor de mysql
// define("SERVER", "localhost");

// //Nombre de la base de datos
// define("BD", "clinica_red");

// //Contraseña de myqsl
// define("PASS", "");
//Nombre de usuario de mysql
define("USER", "u452119581_red_2");

//Servidor de mysql
define("SERVER", "localhost");

//Nombre de la base de datos
define("BD", "u452119581_evaluacion_red");

//Contraseña de myqsl
define("PASS", "TechTitans2024");

//Carpeta donde se almacenaran las copias de seguridad
// define("BACKUP_PATH", "../../../Base de Datos/Respaldos Backup");
define("BACKUP_PATH", "../../../Base de Datos/Respaldos Backup/");

/*Configuración de zona horaria de tu país para más información visita
    http://php.net/manual/es/function.date-default-timezone-set.php
    http://php.net/manual/es/timezones.php
*/
date_default_timezone_set('America/Mexico_City');

class SGBD{
    //Funcion para hacer consultas a la base de datos
    public static function sql($query){
        $con=mysqli_connect(SERVER, USER, PASS, BD);
        mysqli_set_charset($con, "utf8");
        if (mysqli_connect_errno()) {
            printf("Conexion fallida: %s\n", mysqli_connect_error());
            exit();
        }else{
            mysqli_autocommit($con, false);
            mysqli_begin_transaction($con, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
            if($consul=mysqli_query($con, $query)){
                if (!mysqli_commit($con)) {
                    print("Falló la consignación de la transacción\n");
                    exit();
                }
            }else{
                mysqli_rollback($con);
                echo "Falló la transacción";
                exit();
            }
            return $consul;
        }
    }  

    //Func

    //Funcion para limpiar variables que contengan inyeccion SQL
    public static function limpiarCadena($valor) {
        $valor=addslashes($valor);
        $valor = str_ireplace("<script>", "", $valor);
        $valor = str_ireplace("</script>", "", $valor);
        $valor = str_ireplace("SELECT * FROM", "", $valor);
        $valor = str_ireplace("DELETE FROM", "", $valor);
        $valor = str_ireplace("UPDATE", "", $valor);
        $valor = str_ireplace("INSERT INTO", "", $valor);
        $valor = str_ireplace("DROP TABLE", "", $valor);
        $valor = str_ireplace("TRUNCATE TABLE", "", $valor);
        $valor = str_ireplace("--", "", $valor);
        $valor = str_ireplace("^", "", $valor);
        $valor = str_ireplace("[", "", $valor);
        $valor = str_ireplace("]", "", $valor);
        $valor = str_ireplace("\\", "", $valor);
        $valor = str_ireplace("=", "", $valor);
        return $valor;
    }
}