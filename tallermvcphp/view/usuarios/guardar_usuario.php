<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'usuarioController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol_id = $_POST['rol_id'];
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT); // Hasheando la contraseña

    // Crear un objeto del controlador de usuarios
    $object = new usuarioController();

    // Llamar a la función para agregar el usuario
    $resultado = $object->agregarUsuario($nombre, $email, $rol_id, $clave);

    // Redirigir o mostrar mensaje de éxito
    if ($resultado) {
        header('Location: index.php'); // Redirigir a la lista de usuarios
    } else {
        echo "Hubo un error al guardar el usuario.";
    }
}
