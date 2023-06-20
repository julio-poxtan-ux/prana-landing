<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    // Validar y procesar los datos antes de enviar el correo

    $destinatario = 'julio.poxtan.ux.qgmail.com';
    $asunto = 'Solicitud de descarga de PDF';
    $mensaje = "Nombre: $nombre\n";
    $mensaje .= "Correo electrónico: $correo\n";

    // Enviar el correo
    if (mail($destinatario, $asunto, $mensaje)) {
        http_response_code(200); // Éxito
    } else {
        http_response_code(500); // Error en el servidor
    }
} else {
    http_response_code(400); // Solicitud incorrecta
}
?>