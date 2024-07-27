<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$descripcion = strtoupper($_POST['identidad']);

$sql = "INSERT INTO tbl_tipo_documento (Descripcion) VALUES ('$descripcion')";

    echo $resultado = mysqli_query($conexion, $sql);
?>