<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'permisosController.php');

// Crear instancia del controlador
$object = new permisosController();

// Recuperar datos enviados mediante la solicitud
$fechaInicio = isset($_REQUEST['fecha_inicio']) ? $_REQUEST['fecha_inicio'] : null;  
$fechaFin = isset($_REQUEST['fecha_fin']) ? $_REQUEST['fecha_fin'] : null;        
$usuarioId = isset($_REQUEST['usuario_id']) ? intval($_REQUEST['usuario_id']) : null;  
$tipoPermiso = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : null;  
$estado = isset($_REQUEST['estado']) ? $_REQUEST['estado'] : 'Pendiente'; // Valor por defecto

// Validar que los datos necesarios estén presentes
if ($fechaInicio && $fechaFin && $usuarioId && $tipoPermiso) {
    // Insertar el nuevo registro en la base de datos
    $registro = $object->insert($usuarioId, $tipoPermiso, $fechaInicio, $fechaFin, $estado);
    if ($registro) {
        echo "Permiso registrado exitosamente.";
    } else {
        echo "Error al registrar el permiso.";
    }
} else {
    // Manejo de error si faltan datos
    echo "Error: Datos incompletos. Por favor revise la solicitud.";
}
?>

<script>
    // Evitar reenvío accidental del formulario
    history.replaceState(null, null, location.pathname);
</script>
