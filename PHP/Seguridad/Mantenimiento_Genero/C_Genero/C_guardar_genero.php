<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$descripcion = strtoupper($_POST['Genero']);

$sql = "INSERT INTO tbl_genero (Descripcion) VALUES ('$descripcion')";

    echo $resultado = mysqli_query($conexion, $sql);
?>