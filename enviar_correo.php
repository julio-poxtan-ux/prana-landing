<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    // Validar los datos antes de enviar el correo
    if ($nombre === '' || $correo === '') {
        http_response_code(400); // Solicitud incorrecta
        exit('Por favor, completa todos los campos.');
    }

    // Validar el formato del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Solicitud incorrecta
        exit('Por favor, ingresa un correo electrónico válido.');
    }

    // Enviar el correo
    $destinatario = 'julio.poxtan.ux@gmail.com';
    $asunto = 'Solicitud de descarga de PDF';
    $mensaje = "Nombre: $nombre\n";
    $mensaje .= "Correo electrónico: $correo\n";

    if (mail($destinatario, $asunto, $mensaje)) {
        // Descargar el PDF
        $rutaPDF = 'brochure.pdf';
        if (file_exists($rutaPDF)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="brochure.pdf"');
            readfile($rutaPDF);
            exit();
        } else {
            http_response_code(500); // Error en el servidor
            exit('El PDF no está disponible para descarga en este momento.');
        }
    } else {
        http_response_code(500); // Error en el servidor
        exit('Hubo un error al enviar el correo. Por favor, intenta nuevamente más tarde.');
    }
} else {
    http_response_code(405); // Método no permitido
    exit('Método no permitido.');
}
?>
