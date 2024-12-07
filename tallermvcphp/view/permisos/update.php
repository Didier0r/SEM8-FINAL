<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'permisosController.php');

// Crear instancia del controlador
$object = new permisosController();

// Recuperar los datos enviados mediante la solicitud
$idPermiso = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : null;  
$fechaInicio = isset($_REQUEST['fecha_inicio']) ? $_REQUEST['fecha_inicio'] : null; 
$fechaFin = isset($_REQUEST['fecha_fin']) ? $_REQUEST['fecha_fin'] : null;      
$idUsuario = isset($_REQUEST['usuario_id']) ? intval($_REQUEST['usuario_id']) : null;     
$tipoPermiso = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : null;  
$estado = isset($_REQUEST['estado']) ? $_REQUEST['estado'] : null;            

// Validar que todos los datos necesarios estén presentes
if ($idPermiso && $fechaInicio && $fechaFin && $idUsuario && $tipoPermiso && $estado) {
    // Llamar al método para actualizar el permiso
    $object->update($idPermiso, $idUsuario, $tipoPermiso, $fechaInicio, $fechaFin, $estado);
} else {
    // Manejo de error si faltan datos
    echo "Error: Datos incompletos. Por favor revise la solicitud.";
}
?>

<script>
    // Evitar reenvíos accidentales del formulario al recargar la página
    history.replaceState(null, null, location.pathname);
</script>
