<?php
// 2 formas de conectarse a la BD del proyecto:

// =========================   FORMA #1   =========================
//local
// $conexion = mysqli_connect("localhost", "root","", "clinica_red"); // Forma #1
// $conexion = mysqli_connect("localhost", "root","", "clinica_red2"); // Forma #1
//RAILWAY
// $servername = "roundhouse.proxy.rlwy.net";
// $username = "root";
// $password = "jPaDrwRuxJgKeZgRjCmjQxqaKcCORJDa";
// $dbname = "Clinica_Red";
// $PORT = "48563";
//Azure
// $servername = "red-server.mysql.database.azure.com";
// $username = "adminred";
// $password = "T3chTit4n$";
// $dbname = "clinica_red";
// $conexion = mysqli_connect($servername, $username, $password, $dbname, $PORT);
//HOSTINGER
$servername = "localhost";
$username = "u452119581_red_2";
$password = "TechTitans2024";
$dbname = "u452119581_evaluacion_red";
$conexion = mysqli_connect($servername, $username, $password, $dbname);
// Base para Capacitacion
// $servername = "localhost";
// $username = "u452119581_adminred1";
// $password = "T3chTit4ns2024";
// $dbname = "u452119581_capacitacion";
// $conexion = mysqli_connect($servername, $username, $password, $dbname);
// $conexion->begin_transaction();

try {
    // Bloquear el registro que deseas proteger
    $id_registro = 1; // Reemplaza con el ID del registro que quieres bloquear
    $sql = "SELECT * FROM tbl_ms_usuario WHERE Id_Usuario = $id_registro FOR UPDATE";
    $result = $conexion->query($sql);

    // Realizar otras operaciones si es necesario

    // Confirmar la transacción
    $conexion->commit();
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
// $conexion->close();

//   if ($conexion) {
//       echo 'Conectado éxitosamente a la base de datos';
//    }else{
//       echo 'No se ha podido conectar a la base de datos';
//  }


// =========================   FORMA #2   =========================
// // Conexión a la base de datos:
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "clinica_red";

// $conn = new mysqli($servername, $username, $password, $dbname); 

// // Verificar la conexión
// if ($conn->connect_error) {
//     die("Conexión fallida: " . $conn->connect_error);
// }
?>