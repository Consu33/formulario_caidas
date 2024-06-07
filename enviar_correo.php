<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/*require 'vendor/autoload.php';*/

require_once "vendor/autoload.php";
$mail = new PHPMailer;

// Función para obtener datos de POST de manera segura
function obtener_dato($array, $clave, $por_defecto = '') {
    return isset($array[$clave]) ? $array[$clave] : $por_defecto;
}

// Capturar los datos del formulario
$nombre = obtener_dato($_POST, 'nombre');
$apellido = obtener_dato($_POST, 'apellido');
$rut = obtener_dato($_POST, 'rut');
$sexo = obtener_dato($_POST, 'sexo');
$edad = obtener_dato($_POST, 'edad');
$diagnostico_ingreso = obtener_dato($_POST, 'diagnostico_ingreso');
$servicio_clinico = obtener_dato($_POST, 'servicio_clinico');
$hora_caida = obtener_dato($_POST, 'hora_caida');
$dia_caida = obtener_dato($_POST, 'dia_caida');
$sala = obtener_dato($_POST, 'sala');
$lesiones = obtener_dato($_POST, 'lesiones', []);
$ubicacion_lesion = obtener_dato($_POST, 'ubicacion_lesion');
$descripcion_caida = obtener_dato($_POST, 'descripcion_caida');
$sitio = obtener_dato($_POST, 'sitio_caida', []);
$equipo = obtener_dato($_POST, 'equipo_mobiliario', []);
$otro = obtener_dato($_POST, 'otro_equipo');
$entorno = obtener_dato($_POST, 'entorno', []);
$actividad = obtener_dato($_POST, 'actividad', []);
$medicamentos = obtener_dato($_POST, 'medicamentos_paciente', []);
$estado_paciente = obtener_dato($_POST, 'estado_paciente', []);
$observaciones = obtener_dato($_POST, 'observaciones');


 // Convertir arreglos a cadenas separadas por comas
$lesiones_str = is_array($lesiones) ? implode(', ', $lesiones) : $lesiones;
$sitio_str = is_array($sitio) ? implode(', ', $sitio) : $sitio;
$equipo_str = is_array($equipo) ? implode(', ', $equipo) : $equipo;
$entorno_str = is_array($entorno) ? implode(', ', $entorno) : $entorno;
$actividad_str = is_array($actividad) ? implode(', ', $actividad) : $actividad;
$medicamentos_str = is_array($medicamentos) ? implode(', ', $medicamentos) : $medicamentos;
$estado_paciente_str = is_array($estado_paciente) ? implode(', ', $estado_paciente) : $estado_paciente;

echo "<pre>";
echo "Nombre: $nombre\n";
echo "Apellido: $apellido\n";
echo "Rut: $rut\n";
echo "Sexo: $sexo\n";
echo "Edad: $edad\n";
echo "Diagnostico: $diagnostico_ingreso\n";
echo "Servicio clinico: $servicio_clinico\n";
echo "Hora caida: $hora_caida\n";
echo "Día caida: $dia_caida\n";
echo "Sala: $sala\n";
echo "Lesiones: $lesiones_str\n";
echo "Ubicación lesión: $ubicacion_lesion\n";
echo "Descripción caida: $descripcion_caida\n";
echo "Sitio: $sitio_str\n";
echo "Equipo: $equipo_str\n";
echo "Otro: $otro\n";
echo "Entorno: $entorno_str\n";
echo "Actividad: $actividad_str\n";
echo "Medicamentos: $medicamentos_str\n";
echo "Estado paciente: $estado_paciente_str\n";
echo "Observaciones: $observaciones\n";
echo "</pre>";

try {
    // Configuración del servidor de correo
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

    // Contenido del correo
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->Subject = "Formulario de caidas";
    $mail->Body = "Datos de paciente <br>";
    $mail->Body .= "Nombre: $nombre<br>"; 
    $mail->Body .= "Apellido: $apellido<br>";
    $mail->Body .= "Rut: $rut<br>";
    $mail->Body .= "Sexo: $sexo<br>";
    $mail->Body .= "Edad: $edad<br>";
    $mail->Body .= "Diagnostico: $diagnostico_ingreso<br>";
    $mail->Body .= "Servicio clinico: $servicio_clinico<br>";
    $mail->Body .= "Hora caida: $hora_caida<br>";
    $mail->Body .= "Día caida: $dia_caida<br>";
    $mail->Body .= "Sala: $sala<br>";
    $mail->Body .= "Lesiones: $lesiones_str<br>";
    $mail->Body .= "Ubicación lesión: $ubicacion_lesion<br>";
    $mail->Body .= "Descripción caida: $descripcion_caida<br>";
    $mail->Body .= "Sitio: $sitio_str<br>";
    $mail->Body .= "Equipo: $equipo_str<br>";
    $mail->Body .= "Otro: $otro<br>";
    $mail->Body .= "Entorno: $entorno_str<br>";
    $mail->Body .= "Actividad: $actividad_str<br>";
    $mail->Body .= "Medicamentos: $medicamentos_str<br>";
    $mail->Body .= "Estado paciente: $estado_paciente_str<br>";
    $mail->Body .= "Observaciones: $observaciones<br>";
    

    $mail->send();
    echo 'Correo enviado';

} catch (Exception $e) {
    echo 'Mensaje: ' . $mail->ErrorInfo;
}
?>
<br>
<button><a href="index.html.php">Generar otro formulario</a></button>
