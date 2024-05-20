print_r($_POST);

//Declaracion de variables de input
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$diagnostico_ingreso = $_POST['diagnostico_ingreso'];
$servicio_clinico = $_POST['servicio_clinico'];
$sala = $_POST['sala'];
/*$hora_caida = $_POST['hora_caida'];
$dia_caida = $_POST['dia_caida'];*/


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

$consulta = $conexion->prepare("INSERT INTO datos (nombre, edad, sexo, diagnostico_ingreso, servicio_clinico, sala/*, hora_caida, dia_caida*/) VALUES (?, ?, ?, ?, ?, ?/*, ?, ?*/)");
$consulta->bind_param("sissss", $nombre, $edad, $sexo, $diagnostico_ingreso, $servicio_clinico, $sala/*, $hora_caida, $dia_caida*/);

if ($consulta->execute()) {
    echo "Datos enviados";  
} else {
    echo "Error al insertar datos: " . $consulta->error;
}

$consulta->close();
$conexion->close();

//Validacion de existencia de lista//
if(isset($_POST["enviar"])){
    if(isset($_POST["consecuencia"])){
        if(count($_POST["consecuencia"])>0){
            foreach ($_POST["consecuencia"] as $value) {
                echo "<br/> $value";
            }
        }
    }else{
        echo "No has seleccionado ninguna casilla";
    }
}
?>   
    <br>
    <button><a href="formulario.html">Enviar otra Notificación de caída</a></button>



