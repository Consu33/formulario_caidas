<?php

print_r($_POST);

//Declaracion de variables de tablas
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$rut = $_POST['rut'];
$sexo = $_POST['sexo']; // "Hombre o Mujer"
$edad = $_POST['edad'];


$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "formulariocaida";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if(isset($_POST['consecuencia'])){
    $consecuencia = $_POST['consecuencia'];
}else{
    $consecuencia = ""; 
}


 //consulta tabla paciente
$consulta_paciente = $conexion->prepare("INSERT INTO paciente (nombre, apellido, rut, sexo, edad) VALUES (?, ?, ?, ?, ?)");
$consulta_paciente->bind_param("ssssi", $nombre, $apellido, $rut, $sexo, $edad);

if ($consulta_paciente->execute()) {
    echo "Datos enviados";  
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
$consulta_diagnostico = $conexion->prepare("INSERT INTO diagnostico (diagnostico_ingreso, servicio_clinico, hora_caida, dia_caida, sala) VALUES (?, ?, ?, ?, ?)");
$consulta_diagnostico->bind_param("ssssi", $diagnostico_ingreso, $servicio_clinico, $hora_caida, $dia_caida, $sala);

if ($consulta_diagnostico->execute()) {
    echo "";  
} else {
    echo "Error al insertar datos: " . $consulta_diagnostico->error;
}

$consulta_diagnostico->close();

//variables tabla lesiones
$nombre = $_POST['nombre'];

//consulta tabla lesiones
$consulta_lesiones = $conexion->prepare("INSERT INTO lesiones (nombre, lesiones) VALUES (?, ?)");
$consulta_lesiones->bind_param("ss",  $nombre, $lesiones );

if ($consulta_lesiones->execute()) {
    echo "";  
} else {
    echo "Error al insertar datos: " . $consulta_lesiones->error;
}

$consulta_lesiones->close();


//Validacion de existencia de lista//
if(isset($_POST["enviar"])){
    if(isset($_POST["lesiones[]"])){
        if(count($_POST["lesiones[]"])>0){
            foreach ($_POST["lesiones[]"] as $value) {
                echo "<br/> $value";
            }
        }
    }else{
        echo "No has seleccionado ninguna casilla";
    }
}

// Cerrar la conexión
$conexion->close();
?>   
    <br>
    <button><a href="formulario.html">Enviar otra Notificación de caída</a></button>


