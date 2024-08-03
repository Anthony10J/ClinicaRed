<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$descripcion = strtoupper($_POST['Tipo_Cita']);

$sql = "INSERT INTO tbl_tipo_cita (Descripcion) VALUES ('$descripcion')";

    echo $resultado = mysqli_query($conexion, $sql);
?>