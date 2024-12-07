<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'usuarioController.php');

// Verificar que el id se pasó correctamente por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $object = new usuarioController();
    
    // Llamar al método de eliminación en el controlador
    if ($object->delete($id)) {
        echo "Usuario eliminado correctamente.";
        // Redirigir a la página principal o mostrar un mensaje
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el usuario.";
    }
} else {
    echo "Solicitud no válida. Asegúrate de enviar un ID válido.";
}
?>
