<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);//mostrar errores
ini_set('max_execution_time', 300); //300 segundos es igual a 5 minutos
require '../PHPMailerAutoload.php';
//aqui va la consulta para saber todos los contactos
define ("HOST", 'localhost');
define ("BD", 'id21371185_paysafe');
define ("USER_BD", 'id21371185_admin');
define ("PASS_BD", 'Paysafe123.');
$conn = mysqli_connect(HOST, USER_BD, PASS_BD, BD);

if ($conn) {
    $consulta = "SELECT * FROM clientes";
    $resultados = mysqli_query($conn, $consulta);

    if ($resultados) {
        while ($mostrar = mysqli_fetch_array($resultados)) {

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
                $mail->addEmbeddedImage('../../images/logo_correo.png', 'logo', 'logo_correo.png'); // Incrustar la imagen en el mensaje
                $mail->addAddress($mostrar['correo'], $mostrar['nombre'].' '.$mostrar['apellido']);  // Añadir el recipiente
                $mail->addReplyTo('paysafeis2023@gmail.com', 'Informacion');            // Indicar una cuenta para responder (opcional)
                
                $mail->Subject = 'Se aproxima tu fecha de pago...'; // Agregar el asunto del correo

                $mail->Body    = 'Hola '.$mostrar['nombre'].',<br>
                Te escribimos de parte del equipo de PaySafe para recordarte que el pago de tu factura esta pronto a vencer.<br>                           
                Si ya has realizado el pago, no te preocupes por este correo.<br>                         
                En caso contrario, te agradeceremos que lo hagas lo antes posible para evitar cargos extra.<br>                                
                Recuerda que puedes realizar el pago en nuestra sucursal<br><br>
                                                
                Agradeceremos tu pronta atención a este asunto.<br><br>
                                                
                Atentamente,<br>
                Equipo PaySafe<br>
                <img src="cid:logo"> ';
                $mail->AltBody = 'Hola [nombre del cliente],<br>
                Te escribimos de parte del equipo de PaySafe para recordarte que el pago de tu factura esta pronto a vencer.<br>                           
                Si ya has realizado el pago, no te preocupes por este correo.<br>                         
                En caso contrario, te agradeceremos que lo hagas lo antes posible para evitar cargos extra.<br>                                
                Recuerda que puedes realizar el pago en nuestra sucursal<br><br>
                                                
                Agradeceremos tu pronta atención a este asunto.<br><br>
                                                
                Atentamente,<br>
                Equipo PaySafe<br>';  


                if(!$mail->send()) {
                    echo 'El mensaje no pudo ser enviado.';
                    echo 'Error del Mailer: ' . $mail->ErrorInfo;
                } else {
                    echo 'El mensaje se envio correctamente';
                }       
        }
        
        mysqli_free_result($resultados);
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
}

?>