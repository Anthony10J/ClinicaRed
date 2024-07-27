<?php
function Obtener_Id_Objeto($nombre_objeto)
{
    include '../../../Controladores/Conexion/Conexion_be.php';

    $sql = "SELECT Id_Objetos FROM `tbl_ms_objetos` WHERE Objeto = '$nombre_objeto'";

    $sql = mysqli_query($conexion, $sql);

    $id_objeto = $sql->fetch_assoc();

    return $id_objeto["Id_Objetos"];
}

function Obtener_Permisos_Rol_Objeto($IdRol, $IdObjeto)
{
    include '../../../Controladores/Conexion/Conexion_be.php';

    $sql = "SELECT Permiso_Consultar, Permiso_Insercion, Permiso_Eliminacion, Permiso_Actualizacion, Permiso_Reportes,
    Permiso_Terapeutico, Permiso_Clinico
     FROM `tbl_ms_permisos` WHERE Id_Objeto = '$IdObjeto' AND Id_Rol = '$IdRol'";

    $sql = mysqli_query($conexion, $sql);
    
    $Permisos_Objeto = $sql->fetch_assoc();

    return $Permisos_Objeto;

}
