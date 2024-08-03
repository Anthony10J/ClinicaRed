<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$descripcion = strtoupper($_POST['Estado_Cita']);

$sql = "INSERT INTO tbl_estado_cita (Estado_Cita) VALUES ('$descripcion')";

    echo $resultado = mysqli_query($conexion, $sql);
?>