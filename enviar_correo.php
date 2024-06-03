<?php

// Datos de conexión con base de datos
$components = explode('\\', _DIR_);
$first_four_elements = array_slice($components, 0, 4);
$root_path = implode('/', $first_four_elements);

echo "Root path: " . $root_path . "<br>";

require_once($root_path . '/PHPMailer/src/Exception.php');
require_once($root_path . '/PHPMailer/src/PHPMailer.php');
require_once($root_path . '/PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
header('Content-Type: application/json; charset=utf-8');
$mail = new PHPMailer(true);

try {
        //Configuracion servidor mail
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'manuel.arrano@redsalud.gob.cl';
        $mail->Password = 'Man.2022';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('manuel.arrano@redsalud.gob.cl', 'Formulario caida');
        $mail->addAddress('manuel.arrano@redsalud.gob.cl', 'Departamento de Calidad');
        //$mail->addAddress("manuel.arrano@redsalud.gob.cl");
        //$mail->AddAddress("maria.mora@redsalud.gov.cl", 'Maria Mora');
        //$mail->AddAddress("igor.bastias@redsalud.gov.cl", 'Igor Bastias');
        //$mail->AddAddress("catherine.almarza@redsalud.gov.cl", 'Catherine Almarza');
        //$mail->AddAddress("maria.apablaza@redsalud.gov.cl", 'Maria Apablaza');
        //$mail->AddAddress("edison.quinones@redsalud.gov.cl", 'Edison Quiñones');
        //$mail->AddAddress("gabriela.opazo@redsalud.gov.cl", 'Gabriela Opazo');
        //$mail->AddAddress("daniel.bravom@redsalud.gov.cl", 'Daniel Bravo');
        //$mail->AddAddress("patricio.figueroa@redsalud.gov.cl", 'Patricio Figueroa');
        //$mail->AddAddress("jonathan.onatea@redsalud.gov.cl", 'Jonathan Onatea');
        //$mail->AddAddress("roberto,perezp@redsalud.gov.cl", 'Roberto Perez');
        //$mail->AddAddress("mariela.barrerah@redsalud.gov.cl", 'Mariela Barrera');
        //$mail->AddAddress("miguel.godoy@redsalud.gov.cl", 'Miguel Godoy');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->CharSet = "UTF-8";
        $mail->Subject = "Formulario de caidas";
        $mail->Body     = "Datos de paciente: <br>";
        $mail->Body     .= "Nombre: ".$nombre."<br>";
        $mail->Body     .= "Apellido: ".$apellido."<br>";
        $mail->Body     .= "Rut: ".$rut."<br>";
        $mail->Body     .= "Sexo: ".$sexo."<br>";
        $mail->Body     .= "Edad: ".$edad."<br>";
        $mail->Body     .= "Diagnostico: ".$diagnostico_ingreso."<br>";
        $mail->Body     .= "Servicio clinico: ".$servicio_clinico."<br>";
        $mail->Body     .= "Hora caida: ".$hora_caida."<br>";
        $mail->Body     .= "Día caida: ".$dia_caida."<br>";
        $mail->Body     .= "Sala: ".$sala."<br>";
        $mail->Body     .= "Lesiones: ".$lesiones."<br>";
        $mail->Body     .= "Ubicación lesión: ".$ubicacion_lesion."<br>";
        $mail->Body     .= "Descripción caida: ".$descripcion_caida."<br>";
        $mail->Body     .= "Sitio: ".$sitio."<br>";
        $mail->Body     .= "Equipo: ".$equipo."<br>";
        $mail->Body     .= "Otro: ".$otro."<br>";
        $mail->Body     .= "Entorno: ".$entorno."<br>";
        $mail->Body     .= "Actividad: ".$actividad."<br>";
        $mail->Body     .= "Medicamentos: ".$medicamentos."<br>";
        $mail->Body     .= "Estado paciente: ".$estado_paciente."<br>";
        $mail->Body     .= "Observaciones: ".$observaciones."<br>";

        $mail->send();
        echo json_encode(["success" => true, "message" => "(3) Correo enviado correctamente"]);

}catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "(5) Error al enviar el correo: " . $mail->ErrorInfo]);
    }
/*

$mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = $user_email;
            $mail->Password = $user_email_pass;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

*/





    //$mail->setFrom("manuel.arrano@redsalud.gob.cl", "Evento Adversos");
    // Add a recipient
    //$mail->addAddress("manuel.arrano@redsalud.gob.cl");
    //$mail->AddAddress("maria.mora@redsalud.gov.cl", 'Maria Mora');
    //$mail->AddAddress("igor.bastias@redsalud.gov.cl", 'Igor Bastias');
    //$mail->AddAddress("catherine.almarza@redsalud.gov.cl", 'Catherine Almarza');
    //$mail->AddAddress("maria.apablaza@redsalud.gov.cl", 'Maria Apablaza');
    //$mail->AddAddress("edison.quinones@redsalud.gov.cl", 'Edison Quiñones');
    //$mail->AddAddress("gabriela.opazo@redsalud.gov.cl", 'Gabriela Opazo');
    //$mail->AddAddress("daniel.bravom@redsalud.gov.cl", 'Daniel Bravo');
    //$mail->AddAddress("patricio.figueroa@redsalud.gov.cl", 'Patricio Figueroa');
    //$mail->AddAddress("jonathan.onatea@redsalud.gov.cl", 'Jonathan Onatea');
    //$mail->AddAddress("roberto,perezp@redsalud.gov.cl", 'Roberto Perez');
    //$mail->AddAddress("mariela.barrerah@redsalud.gov.cl", 'Mariela Barrera');
    //$mail->AddAddress("miguel.godoy@redsalud.gov.cl", 'Miguel Godoy');

   



    
        if(!$mail->Send()) {
            alert ($mail->ErrorInfo);
            } else {
              alert ("Mensaje enviado correctamente");
        }

?>
