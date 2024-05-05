<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);//mostrar errores
ini_set('max_execution_time', 300); //300 segundos es igual a 5 minutos
require '../PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                       // Activar o desactivar el modo debug
$mail->isSMTP();                              // Indicar al mailer que use SMTP
$mail->Host = 'smtp.gmail.com';           // Acá va el host SMTP
$mail->SMTPAuth = true;                       // Activar la autenticación SMTP
$mail->Username = 'paysafeis2023@gmail.com';    // La cuenta de correos que vas a utilizar. Tiene que estar creada previamente en el cPanel
$mail->Password = 'cmeapbznldiolzfg';             // La clave de de esa cuenta de correos
$mail->SMTPSecure = 'tls';                    // Activar el cifrado TLS, "ssl" también es aceptado
$mail->Port = 587;                            // El puerto de conexión SMTP

$mail->setFrom('paysafeis2023@gmail.com', 'Equipo PaySafe');            // El correo desde cual sale el correo y el "nombre" 
$mail->addAddress('danybaez30@gmail.com', 'Daniel Baez');  // Añadir el recipiente
$mail->addReplyTo('paysafeis2023@gmail.com', 'Informacion');            // Indicar una cuenta para responder (opcional)

$mail->Subject = 'Se aproxima tu fecha de pago...'; // Agregar el asunto del correo

$mail->Body    = 'Este es el "body" del HTML y <b>esto está en negritas</b>';
$mail->AltBody = 'Este es el mensaje alternativo para clientes de correo que no usan HTML';  


if(!$mail->send()) {
    echo 'El mensaje no pudo ser enviado.';
    echo 'Error del Mailer: ' . $mail->ErrorInfo;
} else {
    echo 'El mensaje se envio correctamente';
}