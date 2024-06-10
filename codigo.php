<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "formulariocaida";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);

if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_errno);
}

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

//Declaracion de variables de tablas
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$rut = $_POST['rut'];
$sexo = $_POST['sexo']; // "Hombre o Mujer"
$edad = $_POST['edad'];

//consulta tabla paciente
$consulta_paciente = $conexion->prepare("INSERT INTO paciente (nombre, apellido, rut, sexo, edad) VALUES (?, ?, ?, ?, ?)");
$consulta_paciente->bind_param("ssssi", $nombre, $apellido, $rut, $sexo, $edad);

if ($consulta_paciente->execute()) {
    $paciente_id = $consulta_paciente->insert_id;     
} else {
    echo "Error al insertar datos: " . $consulta_paciente->error;
}

$consulta_paciente->close();

//variables tabla diagnostico
$diagnostico_ingreso = $_POST['diagnostico_ingreso'];
$servicio_clinico = $_POST['servicio_clinico'];
$hora_caida = $_POST['hora_caida'];
$dia_caida = $_POST['dia_caida'];
$sala = $_POST['sala'];


//consulta tabla diagnostico
$consulta_diagnostico = $conexion->prepare("INSERT INTO diagnostico (paciente_id, diagnostico_ingreso, servicio_clinico, hora_caida, dia_caida, sala) VALUES (?, ?, ?, ?, ?, ?)");
$consulta_diagnostico->bind_param("isssss", $paciente_id, $diagnostico_ingreso, $servicio_clinico, $hora_caida, $dia_caida, $sala);


if ($consulta_diagnostico->execute()) {
    echo "";  
} else {
    echo "Error al insertar datos: " . $consulta_diagnostico->error;
}

$consulta_diagnostico->close();

//variables tabla lesiones
if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['lesiones'])){
        $lesiones_array = $_POST['lesiones'];
        $lesiones = implode(',', $lesiones_array);
    }                 
}
    
//consulta tabla lesiones
$consulta_lesiones = $conexion->prepare('INSERT INTO lesiones (paciente_id, lesiones) VALUES (?, ?)');
$consulta_lesiones->bind_param("is", $paciente_id, $lesiones);

if ($consulta_lesiones === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_lesiones->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_lesiones->error;
}

$consulta_lesiones->close();


//variables tabla localización texto
$ubicacion_lesion = $_POST['ubicacion_lesion'];

$consulta_localizacion = $conexion->prepare("INSERT INTO localizacion (paciente_id, ubicacion_lesion) VALUES (?, ?)");
$consulta_localizacion->bind_param('is', $paciente_id, $ubicacion_lesion);

if ($consulta_localizacion->execute()) {
    echo "";
}else{
    echo("Error al insertar datos:" . $consulta_localizacion->error);
}

//variables tabla descripcion_caida texto
$descripcion_caida = $_POST['descripcion_caida'];

$consulta_caida = $conexion->prepare("INSERT INTO descripcion (paciente_id, descripcion_caida) VALUES (?, ?)");
$consulta_caida->bind_param('is', $paciente_id, $descripcion_caida);

if ($consulta_caida->execute()) {
    echo "";
}else{
    echo("Error al insertar datos:" . $consulta_caida->error);
}

$consulta_caida->close();

//variables tabla sitio
if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['sitio_caida'])){
        $sitio_array = $_POST['sitio_caida'];
        $sitio = implode(',', $sitio_array);
    }                 
}

$consulta_sitio = $conexion->prepare('INSERT INTO sitio (paciente_id, sitio_caida) VALUES (?, ?)');
$consulta_sitio->bind_param("is", $paciente_id, $sitio);

if ($consulta_sitio === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_sitio->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_sitio->error;
}

$consulta_sitio->close();

//variable tabla equipo
$otro = $_POST['otro_equipo'];

if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['equipo_mobiliario'])){
        $equipo_array = $_POST['equipo_mobiliario'];
        $equipo = implode(',', $equipo_array);
    }                 
}

$consulta_equipo = $conexion->prepare("INSERT INTO equipo (paciente_id, equipo_mobiliario, otro_equipo) VALUES (?, ?, ?)");
$consulta_equipo->bind_param("iss", $paciente_id, $equipo, $otro);

if ($consulta_equipo === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_equipo->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_equipo->error;
}

$consulta_equipo->close();

//variable tabla entorno
if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['entorno'])){
        $entorno_array = $_POST['entorno'];
        $entorno = implode(',', $entorno_array);
    }                 
}

$consulta_entorno = $conexion->prepare("INSERT INTO entorno (paciente_id, entorno_paciente) VALUES (?, ?)");
$consulta_entorno->bind_param("is", $paciente_id, $entorno);

if ($consulta_entorno === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_entorno->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_entorno->error;
}

$consulta_entorno->close();

//variable tabla actividad
if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['actividad'])){
        $actividad_array = $_POST['actividad'];
        $actividad = implode(',', $actividad_array);
    }                 
}

$consulta_actividad = $conexion->prepare("INSERT INTO actividad (paciente_id, actividad_asociada) VALUES (?, ?)");
$consulta_actividad->bind_param("is", $paciente_id, $actividad);

if ($consulta_entorno === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_actividad->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_actividad->error;
}

$consulta_actividad->close();

//variable tabla medicamentos
if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['medicamentos_paciente'])){
        $medicamentos_array = $_POST['medicamentos_paciente'];
        $medicamentos = implode(',', $medicamentos_array);
    }                 
}

$consulta_medicamentos = $conexion->prepare("INSERT INTO medicamentos (paciente_id, medicamentos_paciente) VALUES (?, ?)");
$consulta_medicamentos->bind_param("is", $paciente_id, $medicamentos);

if ($consulta_medicamentos === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_medicamentos->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_medicamentos->error;
}

$consulta_medicamentos->close();

//variable tabla estado paciente
if( $_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['estado_paciente'])){
        $estado_paciente_array = $_POST['estado_paciente'];
        $estado_paciente = implode(',', $estado_paciente_array);
    }                 
}

$consulta_estado_paciente = $conexion->prepare("INSERT INTO estado (paciente_id, estado_paciente) VALUES (?, ?)");
$consulta_estado_paciente->bind_param("is", $paciente_id, $estado_paciente);

if ($consulta_estado_paciente === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

if ($consulta_estado_paciente->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_estado_paciente->error;
}

$consulta_estado_paciente->close();

//declaracion variable tabla observaciones
$observaciones = $_POST['observaciones'];

$consulta_obersevaciones = $conexion->prepare("INSERT INTO observaciones(paciente_id, obs_paciente) VALUES (?, ?)");
$consulta_obersevaciones->bind_param('is', $paciente_id, $observaciones);

if ($consulta_obersevaciones->execute()) {
    echo "";
} else {
    echo "Error al insertar datos: " . $consulta_obersevaciones->error;
}

$consulta_obersevaciones->close();


$conexion->close();

// INCLUDE ENVIO DE CORREO -- TODO: SECCIONAR CODIGO EN OTROS ARCHIVOS

?>   
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/*require 'vendor/autoload.php';*/

require_once "vendor/autoload.php";
$mail = new PHPMailer;

/*echo "enviar correo";
echo "<br> $nombre";*/

 // Convertir arreglos a cadenas separadas por comas
$lesiones_str = is_array($lesiones) ? implode(', ', $lesiones) : $lesiones;
$sitio_str = is_array($sitio) ? implode(', ', $sitio) : $sitio;
$equipo_str = is_array($equipo) ? implode(', ', $equipo) : $equipo;
$entorno_str = is_array($entorno) ? implode(', ', $entorno) : $entorno;
$actividad_str = is_array($actividad) ? implode(', ', $actividad) : $actividad;
$medicamentos_str = is_array($medicamentos) ? implode(', ', $medicamentos) : $medicamentos;
$estado_paciente_str = is_array($estado_paciente) ? implode(', ', $estado_paciente) : $estado_paciente;


try {
    // Configuración del servidor de correo
    $mail->SMTPDebug = 0;
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
<button><a href="index.html">Generar otro formulario</a></button>
