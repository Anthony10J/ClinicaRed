<?php

// Array asociativo que contiene los permisos por rol
$permisos_por_rol = array(
    'TERAPEUTA' => array(
        'ver_pacientes' => true,
        'crear_citas' => true,
        'ver_expedientes' => true,
        'editar_expedientes_propios' => true,
        'ver_bitacora' => false,
        'editar_usuarios' => false,
        'eliminar_usuarios' => false
    ),
    'SECRETARIA' => array(
        'ver_pacientes' => true,
        'crear_citas' => true,
        'ver_expedientes' => false,
        'editar_expedientes_propios' => false,
        'ver_bitacora' => true,
        'editar_usuarios' => false,
        'eliminar_usuarios' => false
    ),
    'DOCTOR' => array(
        'ver_pacientes' => true,
        'crear_citas' => true,
        'ver_expedientes' => true,
        'editar_expedientes_propios' => true,
        'ver_bitacora' => false,
        'editar_usuarios' => false,
        'eliminar_usuarios' => false
    ),
    'ADMIN' => array(
        'ver_pacientes' => true,
        'crear_citas' => true,
        'ver_expedientes' => true,
        'editar_expedientes_propios' => true,
        'ver_bitacora' => true,
        'editar_usuarios' => true,
        'eliminar_usuarios' => true
    ),
    'SUPERADMIN' => array(
        'ver_pacientes' => true,
        'crear_citas' => true,
        'ver_expedientes' => true,
        'editar_expedientes_propios' => true,
        'ver_bitacora' => true,
        'editar_usuarios' => true,
        'eliminar_usuarios' => true
    )
);

// Obtener el rol actual, por ejemplo, desde la sesión
$rol_actual = 'ADMIN';

// Verificar si el rol actual tiene permiso para una acción específica
function tiene_permiso($rol, $accion)
{
    global $permisos_por_rol;
    return isset($permisos_por_rol[$rol][$accion]) ? $permisos_por_rol[$rol][$accion] : false;
}

// Ejemplo de uso:
if (tiene_permiso($rol_actual, 'editar_usuarios')) {
    // El usuario tiene permiso para editar usuarios
    // Realizar la acción correspondiente aquí
    echo "El usuario tiene permiso para editar usuarios.";
} else {
    // El usuario no tiene permiso para editar usuarios
    echo "El usuario no tiene permiso para editar usuarios.";
}

?>