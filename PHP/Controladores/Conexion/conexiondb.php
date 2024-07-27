<?php
//Railwai
// $servername = "roundhouse.proxy.rlwy.net";
// $username = "root";
// $password = "jPaDrwRuxJgKeZgRjCmjQxqaKcCORJDa";
// $dbname = "Clinica_Red";
// $PORT = "48563";
//AZURE
// $servername = "red-server.mysql.database.azure.com";
// $username = "adminred";
// $password = "T3chTit4n$";
// $dbname = "clinica_red";
// $conn = new mysqli($servername, $username, $password, $dbname);
//local
// Conexión a la base de datos Local
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinica_red";
$conn = new mysqli($servername, $username, $password, $dbname);

// //hostinger
// $servername = "localhost";
// $username = "u452119581_red_2";
// $password = "TechTitans2024";
// $dbname = "u452119581_evaluacion_red";
// $conn = new mysqli($servername, $username, $password, $dbname);
// Base para Capacitacion
// $servername = "localhost";
// $username = "u452119581_adminred1";
// $password = "T3chTit4ns2024";
// $dbname = "u452119581_capacitacion";
// $conexion = mysqli_connect($servername, $username, $password, $dbname);
// $conexion->begin_transaction();

// // Verificar la conexión
// if ($conn->connect_errno) {
//     die("Conexión fallida: " . $conn->connect_errno);
// }

$conn->begin_transaction();

try {
    // Bloquear el registro que deseas proteger
    $id_registro = 1; // Reemplaza con el ID del registro que quieres bloquear
    $sql = "SELECT * FROM tbl_ms_usuario WHERE Id_Usuario = $id_registro FOR UPDATE";
    $result = $conn->query($sql);

    // Realizar otras operaciones si es necesario

    // Confirmar la transacción
    $conn->commit();
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión
// $conn->close();

