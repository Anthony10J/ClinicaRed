<?php
include('../../../Controladores/Conexion/Conexion_be.php');

$Id_Tipo_Documento = $_POST['Id_Tipo_Documento'];

$sql = "DELETE FROM tbl_tipo_documento WHERE Id_Tipo_Documento = '$Id_Tipo_Documento'";

    echo $resultado = mysqli_query($conexion, $sql);
?>