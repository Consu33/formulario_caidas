<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

//Capturar los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$rut = $_POST['rut'];
$sexo = $_POST['sexo'];
$edad = $_POST['edad'];
$diagnostico_ingreso = $_POST['diagnostico_ingreso'];
$servicio_clinico = $_POST['servicio_clinico'];
$hora_caida = $_POST['hora_caida'];
$dia_caida = $_POST['dia_caida'];
$sala = $_POST['sala'];
$lesiones = implode(', ', $_POST['lesiones']);
$ubicacion_lesion = $_POST['ubicacion_lesion'];
$descripcion_caida = $_POST['descripcion_caida'];
$sitio = implode(', ', $_POST['sitio_caida']);
$equipo = implode(', ', $_POST['equipo_mobiliario']);
$otro = $_POST['otro_equipo'];
$entorno = implode(', ', $_POST['entorno']);
$actividad = implode(', ', $_POST['actividad']);
$medicamentos = implode(', ', $_POST['medicamentos_paciente']);
$estado_paciente = implode(', ', $_POST['estado_paciente']);
$observaciones = $_POST['observaciones'];

try {
        //Configuracion servidor mail
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
       

        // Contentido
        $mail->isHTML(true);                                  
        $mail->CharSet = "UTF-8";
        $mail->Subject = "Formulario de caidas";
        $mail->Body    = "Datos de paciente <br>";
        $mail->Body    = "Nombre: ".$nombre."<br>";     
        $mail->Body   .= "Apellido: ".$apellido."<br>";
        $mail->Body   .= "Rut: ".$rut."<br>";
        $mail->Body   .= "Sexo: ".$sexo."<br>";
        $mail->Body   .= "Edad: ".$edad."<br>";
        $mail->Body   .= "Diagnostico: ".$diagnostico_ingreso."<br>";
        $mail->Body   .= "Servicio clinico: ".$servicio_clinico."<br>";
        $mail->Body   .= "Hora caida: ".$hora_caida."<br>";
        $mail->Body   .= "Día caida: ".$dia_caida."<br>";
        $mail->Body   .= "Sala: ".$sala."<br>";
        $mail->Body   .= "Lesiones: ".$lesiones."<br>";
        $mail->Body   .= "Ubicación lesión: ".$ubicacion_lesion."<br>";
        $mail->Body   .= "Descripción caida: ".$descripcion_caida."<br>";
        $mail->Body   .= "Sitio: ".$sitio."<br>";
        $mail->Body   .= "Equipo: ".$equipo."<br>";
        $mail->Body   .= "Otro: ".$otro."<br>";
        $mail->Body   .= "Entorno: ".$entorno."<br>";
        $mail->Body   .= "Actividad: ".$actividad."<br>";
        $mail->Body   .= "Medicamentos: ".$medicamentos."<br>";
        $mail->Body   .= "Estado paciente: ".$estado_paciente."<br>";
        $mail->Body   .= "Observaciones: ".$observaciones."<br>";

        $mail->send();
        echo 'correo enviado';

    } catch(Exception $e){
        echo 'Mensaje' . $mail->ErrorInfo;
    }
    
?>
