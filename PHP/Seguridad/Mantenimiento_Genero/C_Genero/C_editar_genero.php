<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$IdGenero = $_POST['IdGenero'];
$descripcion = strtoupper($_POST['Genero_E']);

$sql = "UPDATE tbl_genero SET Descripcion = '$descripcion' WHERE IdGenero = '$IdGenero'";

    echo $resultado = mysqli_query($conexion, $sql);
