<?php
// Incluye los archivos necesarios
include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'usuarioController.php');

$object = new usuarioController();

// Verifica que se haya pasado un ID
if (isset($_GET['id'])) {
    $usuario_id = $_GET['id'];
    $usuario = $object->search($usuario_id); // Obtienes los datos del usuario

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "ID no válido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(ROOT_PATH . 'header.php'); ?>
    <title>Editar Usuario</title>
</head>
<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>
    
    <section class="intro">
        <div class="container">
            <h2>Editar Usuario</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="rol_id" class="form-label">Rol</label>
                    <select name="rol_id" id="rol_id" class="form-control" required>
                        <!-- Asegúrate de cargar los roles disponibles desde la base de datos -->
                        <option value="1" <?= $usuario['rol_id'] == 1 ? 'selected' : '' ?>>Administrador</option>
                        <option value="2" <?= $usuario['rol_id'] == 2 ? 'selected' : '' ?>>Usuario</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </section>

</body>
<?php include_once(ROOT_PATH . 'footer.php'); ?>
</html>
