<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "formulariocaida";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$paciente_id = $_GET['id'];


// Consulta para obtener los datos del paciente
$consulta_paciente = $conexion->prepare("SELECT * FROM paciente WHERE id = ?");
$consulta_paciente->bind_param("i", $paciente_id);
$consulta_paciente->execute();
$resultado_paciente = $consulta_paciente->get_result();
$datos_paciente = $resultado_paciente->fetch_assoc();


// Consulta para obtener los datos del diagnóstico
$consulta_diagnostico = $conexion->prepare("SELECT * FROM diagnostico WHERE paciente_id = ?");
$consulta_diagnostico->bind_param("i", $paciente_id);
$consulta_diagnostico->execute();
$resultado_diagnostico = $consulta_diagnostico->get_result();
$datos_diagnostico = $resultado_diagnostico->fetch_assoc();

// Consulta para obtener las lesiones
$consulta_lesiones = $conexion->prepare("SELECT * FROM lesiones WHERE paciente_id = ?");
$consulta_lesiones->bind_param("i", $paciente_id);
$consulta_lesiones->execute();
$resultado_lesiones = $consulta_lesiones->get_result();
$datos_lesiones = $resultado_lesiones->fetch_assoc();

// Consultas para descripcion, equipo, entorno, actividad, medicamentos, estado, observaciones

$consulta_descripcion = $conexion->prepare("SELECT * FROM descripcion WHERE paciente_id = ?");
$consulta_descripcion->bind_param("i", $paciente_id);
$consulta_descripcion->execute();
$resultado_descripcion = $consulta_descripcion->get_result();
$datos_descripcion = $resultado_descripcion->fetch_assoc();

$consulta_equipo = $conexion->prepare("SELECT * FROM equipo WHERE paciente_id = ?");
$consulta_equipo->bind_param("i", $paciente_id);
$consulta_equipo->execute();
$resultado_equipo = $consulta_equipo->get_result();
$datos_equipo = $resultado_equipo->fetch_assoc();

$consulta_entorno = $conexion->prepare("SELECT * FROM entorno WHERE paciente_id = ?");
$consulta_entorno->bind_param("i", $paciente_id);
$consulta_entorno->execute();
$resultado_entorno = $consulta_entorno->get_result();
$datos_entorno = $resultado_entorno->fetch_assoc();

$consulta_actividad = $conexion->prepare("SELECT * FROM actividad WHERE paciente_id = ?");
$consulta_actividad->bind_param("i", $paciente_id);
$consulta_actividad->execute();
$resultado_actividad = $consulta_actividad->get_result();
$datos_actividad = $resultado_actividad->fetch_assoc();

$consulta_medicamentos = $conexion->prepare("SELECT * FROM medicamentos WHERE paciente_id = ?");
$consulta_medicamentos->bind_param("i", $paciente_id);
$consulta_medicamentos->execute();
$resultado_medicamentos = $consulta_medicamentos->get_result();
$datos_medicamentos = $resultado_medicamentos->fetch_assoc();

$consulta_estado = $conexion->prepare("SELECT * FROM estado WHERE paciente_id = ?");
$consulta_estado->bind_param("i", $paciente_id);
$consulta_estado->execute();
$resultado_estado = $consulta_estado->get_result();
$datos_estado = $resultado_estado->fetch_assoc();

$consulta_observaciones = $conexion->prepare("SELECT * FROM observaciones WHERE paciente_id = ?");
$consulta_observaciones->bind_param("i", $paciente_id);
$consulta_observaciones->execute();
$resultado_observaciones = $consulta_observaciones->get_result();
$datos_observaciones = $resultado_observaciones->fetch_assoc();

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Reporte</title>
</head>
<body>
    <h3>Detalles del Reporte de Caída</h3>
    
    <?php if ($datos_paciente): ?>
        <p>Nombre: <?php echo $datos_paciente['nombre']; ?></p>
        <p>Apellido: <?php echo $datos_paciente['apellido']; ?></p>
        <p>RUT: <?php echo $datos_paciente['rut']; ?></p>
        <p>Sexo: <?php echo $datos_paciente['sexo']; ?></p>
        <p>Edad: <?php echo $datos_paciente['edad']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos del paciente.</p>
    <?php endif; ?>

    <h3>Diagnóstico</h3>
    <?php if ($datos_diagnostico): ?>
        <p>Diagnóstico de Ingreso: <?php echo $datos_diagnostico['diagnostico_ingreso']; ?></p>
        <p>Servicio Clínico: <?php echo $datos_diagnostico['servicio_clinico']; ?></p>
        <p>Hora de la Caída: <?php echo $datos_diagnostico['hora_caida']; ?></p>
        <p>Día de la Caída: <?php echo $datos_diagnostico['dia_caida']; ?></p>
        <p>Sala: <?php echo $datos_diagnostico['sala']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos del diagnóstico.</p>
    <?php endif; ?>

    <h3>Lesiones</h3>
    <?php if ($datos_lesiones): ?>
        <p><?php echo $datos_lesiones['lesiones']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos de lesiones.</p>
    <?php endif; ?>

    <h3>Descripción de la Caída</h3>
    <?php if ($datos_descripcion): ?>
        <p><?php echo $datos_descripcion['descripcion_caida']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos de la descripción de la caída.</p>
    <?php endif; ?>

    <h3>Equipo</h3>
    <?php if ($datos_equipo): ?>
        <p>Equipo Mobiliario: <?php echo $datos_equipo['equipo_mobiliario']; ?></p>
        <p>Otro Equipo: <?php echo $datos_equipo['otro_equipo']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos del equipo.</p>
    <?php endif; ?>

    <h3>Entorno</h3>
    <?php if ($datos_entorno): ?>
        <p><?php echo $datos_entorno['entorno_paciente']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos del entorno.</p>
    <?php endif; ?>

    <h3>Actividad</h3>
    <?php if ($datos_actividad): ?>
        <p><?php echo $datos_actividad['actividad_asociada']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos de la actividad.</p>
    <?php endif; ?>

    <h3>Medicamentos</h3>
    <?php if ($datos_medicamentos): ?>
        <p><?php echo $datos_medicamentos['medicamentos_paciente']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos de los medicamentos.</p>
    <?php endif; ?>

    <h3>Estado del Paciente</h3>
    <?php if ($datos_estado): ?>
        <p><?php echo $datos_estado['estado_paciente']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos del estado del paciente.</p>
    <?php endif; ?>

    <h3>Observaciones</h3>
    <?php if ($datos_observaciones): ?>
        <p><?php echo $datos_observaciones['obs_paciente']; ?></p>
    <?php else: ?>
        <p>No se encontraron datos de las observaciones.</p>
    <?php endif; ?>

    
</body>
</html>

<br>
    <button><a href="formulario.html">Guardar formulario</a></button>


