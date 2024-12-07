<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
session_start();

if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

$Usuario = $_SESSION["usuario"];

require_once(CONTROLLER_PATH.'permisosController.php');
$object = new permisosController();
$usuarios = $object->combolistUsuarios(); // Lista de usuarios que pueden tener permisos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Registro de Permisos</title>
</head>
<body>
    <?php require_once(VIEW_PATH.'navbar/navbar.php'); ?>
    <div class="container">
        <div class="mb-3">
            <h2>Solicitar Permiso</h2>
        </div>
        <form id="formPermiso" action="store.php" method="post" class="g-3 needs-validation" novalidate>
            <!-- Tipo de Permiso -->
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Permiso</label>
                <select class="form-control" name="tipo" id="tipo" required>
                    <option selected disabled value="">Seleccione un tipo de permiso</option>
                    <option value="Vacaciones">Vacaciones</option>
                    <option value="Enfermedad">Enfermedad</option>
                    <option value="Otro">Otro</option>
                </select>
                <div class="invalid-feedback">Seleccione un tipo de permiso válido!</div>
            </div>

            <!-- Usuario -->
            <div class="mb-3">
                <label for="usuario_id" class="form-label">Usuario</label>
                <select class="form-control" name="usuario_id" id="usuario_id" required>
                    <option selected disabled value="">Seleccione un usuario</option>
                    <?php foreach ($usuarios as $user) { ?>
                    <option value="<?=$user['id']?>"><?=$user['nombre']?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Seleccione un usuario válido!</div>
            </div>

            <!-- Fecha de Inicio -->
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                <div class="invalid-feedback">Ingrese una fecha válida!</div>
            </div>

            <!-- Fecha de Fin -->
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                <div class="invalid-feedback">Ingrese una fecha válida!</div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg col-4">Guardar</button>
        </form>
    </div>
</body>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/validate.js"></script>
</html>
