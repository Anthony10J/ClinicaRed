<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$IdGenero = $_POST['IdGenero'];

$sql = "DELETE FROM tbl_genero WHERE IdGenero = '$IdGenero'";

    echo $resultado = mysqli_query($conexion, $sql);
?>