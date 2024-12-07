<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH.'permisosController.php');

$object = new permisosController();

// Verificar si el parámetro 'id' existe en la solicitud
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $idPermiso = intval($_REQUEST['id']);
    
    // Intentar eliminar el permiso
    if ($object->delete($idPermiso)) {
        header('Location: index.php?success=1'); // Redirigir con éxito
    } else {
        header('Location: index.php?error=1'); // Redirigir con error
    }
} else {
    header('Location: index.php?error=2'); // Redirigir si el ID no es válido
}
