<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$Id_Tipo_Documento = $_POST['Id_Tipo_Documento'];
$descripcion = strtoupper($_POST['identidad_E']);

$sql = "UPDATE tbl_tipo_documento SET Descripcion = '$descripcion' WHERE Id_Tipo_Documento = '$Id_Tipo_Documento'";

    echo $resultado = mysqli_query($conexion, $sql);
