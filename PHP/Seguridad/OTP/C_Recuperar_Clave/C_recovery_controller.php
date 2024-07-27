<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
  // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
  // La sesión aún no está iniciada, entonces la inicias
  session_start();
}
include('../../../Controladores/Conexion/Conexion_be.php');
include('../../../../Recursos/SweetAlerts.php');
include('./C_enviar_token_clave.php');

if (isset($_POST['correo3'])) {
  $correo2 = $_POST['correo3']; // Asignar a la variable local $correo2
  $_SESSION['correo3'] = $correo2; // También guardar en la sesión
}
if (!empty($correo2)) {
  if (substr_count($correo2, '@') == 1) { // Validar que el correo no tenga 2 '@' o ','

    if (substr($correo2, -1) != '.') { // Validar que el correo no finalice con un '.'

      $consultar_Email = "SELECT * FROM tbl_ms_usuario WHERE Correo = '$correo2'";
      $verificar_correo2 = mysqli_query($conexion, $consultar_Email);

      if ((mysqli_num_rows($verificar_correo2) > 0) ) { // Validar que el correo electrónico existe en la BD
        
        if(!empty($_POST)){
          
         // $correo3 = $_POST ['correo3'];
          $captcha = $_POST ['g-recaptcha-response'];
          $secret = '6LclhcgpAAAAALXq-MUx0XdFl3MI3YhnbKTyYsmJ';
          $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

            $arr = json_decode($response, TRUE);
                
            if ($arr['success']) {
              enviarOTP2($conexion, $correo2);
            } else {
              echo '
              <script>
                MostrarAlerta("error", "ERROR", "No se verificó el captcha.", "../V_Recuperar_Clave/V_verificar_token.php");
              </script>
              ';
             exit();
            }
          
        }  
      } else {
        // Mostrar mensaje de error de correo no encontrado
        echo '
          <script>
            MostrarAlerta("error", "ERROR", "Este correo electrónico no está registrado.", "../V_Recuperar_Clave/V_verificar_token.php");
          </script>
        ';
        exit();
      }
    } else {
      // Mostrar mensaje de error de correo con punto final
      echo '
        <script>
          MostrarAlerta("error", "ERROR", "El correo electrónico no es válido, porque finaliza con un punto.", "../V_Recuperar_Clave/V_verificar_token.php");
        </script>
      ';
      exit();
    }
  } else {
    // Mostrar mensaje de error de correo con 2 '@' o sin '@'
    echo '
      <script>
        MostrarAlerta("error", "ERROR", "El correo electrónico no es válido.", "../V_Recuperar_Clave/V_verificar_token.php");
      </script>
    ';
    exit();
  }
} else {
  // Mostrar mensaje de error de correo vacío
  echo '
    <script>
      MostrarAlerta("error", "ERROR", "No se ingresó ningun correo.", "../V_Recuperar_Clave/V_verificar_token.php");
    </script>
';
}
?>