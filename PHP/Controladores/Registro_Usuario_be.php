<?php

include './Conexion/Conexion_be.php';
include './bitacora.php';
include('../../Recursos/SweetAlerts.php');
include('../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php');

$dni = $_POST['dni'];
$usuario = strtoupper($_POST['usuario']);
$correo = $_POST['correo2'];
$nombre = strtoupper($_POST['nombre']);
$direccion = strtoupper($_POST['direccion']);
// $direccion = $_POST['direccion'];
$fechanacimiento = date("Y-m-d", strtotime($_POST['fechanacimiento']));
$genero = $_POST['genero'];
$clave = $_POST['password3'];
$clave_encriptada = md5($clave);



   // obtener el objeto
//    $id_objeto = Obtener_Id_Objeto('V_Paciente');
//    if ($id_objeto === null) {
//        echo "Error: id_objeto es NULL";
//        exit();
//    }

//    $id_objeto = $conexion->real_escape_string($id_objeto);
//    if ($conexion->query("SET @id_objeto = '$id_objeto'") === FALSE) {
//        echo "Error setting id_objeto variable: " . $conexion->error;
//        exit();
//    }




if (!empty($dni) && !empty($usuario) && !empty($nombre) && !empty($correo) 
    && !empty($fechanacimiento) && !empty($genero) && !empty($clave)) { // Validar que ninguno de los campos esté vacío

        if (!preg_match('/[A-Z]/', $dni) && !preg_match('/[a-z]/', $dni)) { // Validar que en el DNI no se acepten caracteres alfabéticos.

            if (!preg_match('/[0-9]/', $nombre)) { // Validar que no haya caracteres numéricos o especiales en el nombre

                if (substr_count($correo, '@') == 1) { // Validar que el correo no tenga 2 '@' o ','
        
                    if (substr($correo, -1) != '.') { // Validar que el correo no finalice con un '.'
        
                        $consultar_Email = "SELECT * FROM tbl_ms_usuario WHERE Correo = '$correo'";
                        $verificar_correo = mysqli_query($conexion, $consultar_Email);
        
                        if (mysqli_num_rows($verificar_correo) == 0) { // Validar que el correo electrónico no existe en la BD
        
                            $consultar_User = "SELECT * FROM tbl_ms_usuario WHERE Usuario = '$usuario'";
                            $verificar_usuario = mysqli_query($conexion, $consultar_User);
        
                            if (mysqli_num_rows($verificar_usuario) == 0) { // Validar que el nuevo usuario no existe en la BD
        
                                $query = "INSERT INTO tbl_ms_usuario(DNI, Usuario, Correo, Nombre, Direccion, FechaNacimiento, FechaContratacion, Estado_Usuario, 
                                                                    Contrasena, IdRol, IdGenero, primer_ingreso, Creado_Por, Fecha_Creacion, Numero_Inicio_Sesion) 
                                          VALUES ('$dni', '$usuario', '$correo', '$nombre', '$direccion', '$fechanacimiento', NOW(), 2, '$clave_encriptada', 2, '$genero', 
                                          0, 'AUTOREGISTRO', NOW(), 0)";
        
                                $resultado_query = mysqli_query($conexion, $query);
                                if ($resultado_query) { // Validar que se insertó correctamente el registro
                                    $query2=  "SELECT * FROM tbl_ms_usuario WHERE Usuario LIKE '$usuario'";
                                    $n= mysqli_query($conexion, $query2);
                                    $fila = $n->fetch_assoc();
                                    $n2= $fila['Id_Usuario'];
                                    $a='AUTOREGISTRO';
                                    $d= 'USUARIO '.$fila['Usuario'].' SE HA REGISTRADO.';
                                    $o=  $id_objeto;
                                    // bitacora($n2,$a,$d,$o);
                                    echo '
                                        <script>
                                            MostrarAlerta("success", "¡GENIAL!", "Usuario almacenado correctamente.", "/index.php");
                                        </script>
                                    ';
                                } else {
                                    echo '
                                        <script>
                                            MostrarAlerta("error", "ERROR", "Inténtalo de nuevo, usuario no almacenado.", "/index.php");
                                        </script>
                                    ';
                                    exit();
                                }
                            } else {
                                echo '
                                    <script>
                                        MostrarAlerta("error", "ERROR", "El nombre de usuario ya está registrado, intenta con un nuevo nombre de usuario.", "/index.php");
                                    </script>
                                ';
                                exit();
                            }
                        } else {
                            echo '
                                <script>
                                    MostrarAlerta("error", "ERROR", "Este correo electrónico ya está registrado, intenta con otro correo electrónico diferente.", "/index.php");
                                </script>
                            ';
                            exit();
                        }
                    } else {
                        echo '
                            <script>
                                MostrarAlerta("error", "ERROR", "El correo electrónico no es válido, porque finaliza con un punto.", "/index.php");
                            </script>
                        ';
                        exit();
                    }
                } else {
                    echo '
                        <script>
                            MostrarAlerta("error", "ERROR", "El correo electrónico no coincide con el formato establecido.", "/index.php");
                        </script>
                    ';
                    exit();
                }
            } else {
                echo '
                    <script>
                        MostrarAlerta("error", "ERROR", "No se permiten números o caracteres especiales en el campo Nombre.", "/index.php");
                    </script>
                ';
                exit();
            }
        } else {
            echo '
                <script>
                    MostrarAlerta("error", "ERROR", "No se permiten letras en el campo DNI.", "/index.php");
                </script>
            ';
        }
} else {
    echo '
        <script>
            MostrarAlerta("error", "ERROR", "Por favor, llena todos los campos del registro.", "/index.php");
        </script>
    ';
    exit();
}
// Comprobar si la inserción fue exitosa
// if ($conexion->affected_rows > 0) {
//     // Obtener el ID del nuevo usuario
//     $id_nuevo_usuario = $conexion->insert_id;

//     // Registrar la acción en la bitácora
//     $sql_bitacora = "INSERT INTO tbl_bitacora (Fecha, Id_Usuario, Accion, Descripcion, Id_Objeto)
//                      VALUES (NOW(), 'AUTO-REGISTRO', 'INSERTAR', CONCAT('SE REGISTRÓ EL USUARIO: ', '$usuario', ' CON EL NOMBRE ', '$nombre'), NULL)";
    
//     if ($conexion->query($sql_bitacora) === TRUE) {
//         echo "Usuario registrado y acción de auto-registro registrada en la bitácora con éxito.";
//     } else {
//         echo "Error al registrar la acción de auto-registro en la bitácora: " . $conexion->error;
//     }
// } else {
//     echo "Error al registrar el usuario: " . $conexion->error;
// }
mysqli_close($conexion);
?>
