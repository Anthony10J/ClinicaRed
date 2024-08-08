<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

function bitacora($n,$a,$d,$o){
    $conexion = mysqli_connect("localhost", "u452119581_RED","T3chTit4n$2024", "u452119581_clinica_red");
    //include '../Controladores/Conexion/Conexion_be.php'; 
    //$fecha = date("Y-m-d H:i:s");
    $bitacora = "INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
                 VALUES (NOW(),$n, '$a', '$d','$o') ORDER BY Fecha ASC";
    $agregar_bitacora = mysqli_query($conexion, $bitacora);    //almacena la consulta
    return $agregar_bitacora;
    // $conexion->close();
}
?>