<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try{
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'manuel.arrano@redsalud.gob.cl';
    $mail->Password = 'Man.2022';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('manuel.arrano@redsalud.gob.cl');
    $mail->addAddress('manuel.arrano@redsalud.gob.cl', 'manuel');
    //$mail->addCC('');  //cc

    $mail->isHTML(true);
    $mail->Subject = 'Prueba formulario';
    $mail->Body = 'esta es una prueba';
    $mail->send();

    echo 'correo enviado';

} catch(Exception $e){
    echo 'Mensaje' . $mail->ErrorInfo;
}

?>
