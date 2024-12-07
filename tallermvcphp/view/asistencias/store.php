<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH.'asistenciaController.php');

$object = new asistenciaController();

// Captura los datos enviados desde el formulario
$usuario_id = $_REQUEST['usuario_id'];
$fecha = $_REQUEST['fecha'];
$hora_entrada = $_REQUEST['hora_entrada'];
$hora_salida = $_REQUEST['hora_salida'];
$comentarios = $_REQUEST['comentarios'];

// Inserta el registro en la tabla `asistencia`
$registro = $object->insert($usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios);
?>
<script>
   history.replaceState(null, null, location.pathname);
</script>
