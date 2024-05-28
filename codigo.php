<?php



$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "formulariocaida";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}


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
    

    echo "el id del paciente creado es: " . $consulta_paciente->insert_id;
} else {
    echo "Error al insertar datos: " . $consulta_paciente->error;
}


$consulta_paciente->close();
echo "el id del paciente recien creado es: " . $paciente_id;



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

if ($consulta_lesiones === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}


$consulta_lesiones->bind_param("is", $paciente_id, $lesiones);

//Ejecutar 
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

if ($consulta_sitio === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

$consulta_sitio->bind_param("is", $paciente_id, $sitio);

//Ejecutar 
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

if ($consulta_equipo === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

$consulta_equipo->bind_param("iss", $paciente_id, $equipo, $otro);

//ejecutar
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

if ($consulta_entorno === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

$consulta_entorno->bind_param("is", $paciente_id, $entorno);

//ejecutar
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

if ($consulta_entorno === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

$consulta_actividad->bind_param("is", $paciente_id, $actividad);

//ejecutar
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

if ($consulta_medicamentos === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

$consulta_medicamentos->bind_param("is", $paciente_id, $medicamentos);

//ejecutar
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

if ($consulta_estado_paciente === false) {
    die("Error al preparar la declaración: " . $conexion->error);
}

$consulta_estado_paciente->bind_param("is", $paciente_id, $estado_paciente);

//ejecutar
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
header("Location: ver_datos.php?id=$paciente_id");
exit();

/*print_r($_POST);*/

?>   
