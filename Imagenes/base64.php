<?php
// Ruta de la imagen
$ruta_imagen = './logo3.jpeg';

// Verificar si el archivo existe
if (file_exists($ruta_imagen)) {
    // Leer el contenido de la imagen
    $contenido_imagen = file_get_contents($ruta_imagen);

    // Codificar la imagen en base64
    $ImagenBase64 = base64_encode($contenido_imagen);

    // Imprimir la cadena base64 (solo para verificar)
    // echo "Cadena base64 de la imagen: " . $ImagenBase64;

    // Luego, puedes utilizar esta cadena base64 en tu código JavaScript para mostrar la imagen en el PDF
// } else {
    // echo "La imagen no existe en la ruta especificada.";
}
?>