<?php
function bitacora($n,$a,$d){
    // $conexion = mysqli_connect("localhost", "root","", "clinica_red");
    include '../Controladores/Conexion/Conexion_be.php'; 
    //$fecha = date("Y-m-d H:i:s");
    $bitacora = "INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion)
                 VALUES (NOW(),$n, '$a', '$d') ORDER BY Fecha ASC";
    $agregar_bitacora = mysqli_query($conexion, $bitacora);    //almacena la consulta
    return $agregar_bitacora;
    // $conexion->close();
}
?>