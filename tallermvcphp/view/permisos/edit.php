<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
session_start();

if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
    exit;
}

$Usuario = $_SESSION["usuario"];

require_once(CONTROLLER_PATH . 'permisosController.php');
$object = new permisosController();
$idPermiso = $_GET['id'];
$permiso = $object->search($idPermiso);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <title>Editar Permiso</title>
</head>
<body>
    <?php
    require_once(VIEW_PATH . 'navbar/navbar.php');
    ?>
    <div class="container">
        <div class="mb-3">
            <h2>Editando Permiso</h2>
        </div>
        <form id="formPermiso" action="update.php" method="post" class="g-3 needs-validation" novalidate>
            <div class="mb-3">
                <label for="usuario_id" class="form-label">Usuario ID</label>
                <input value="<?= $permiso['usuario_id'] ?>" type="text" class="form-control" id="usuario_id" name="usuario_id" readonly>
            </div>
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <input value="<?= $permiso['fecha_inicio'] ?>" type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                <div class="invalid-feedback">Ingrese o seleccione una fecha válida!</div>
            </div>
            <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <input value="<?= $permiso['fecha_fin'] ?>" type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                <div class="invalid-feedback">Ingrese o seleccione una fecha válida!</div>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Permiso</label>
                <select class="form-control" name="tipo" id="tipo" required>
                    <option value="Vacaciones" <?= $permiso['tipo'] == 'Vacaciones' ? 'selected' : '' ?>>Vacaciones</option>
                    <option value="Enfermedad" <?= $permiso['tipo'] == 'Enfermedad' ? 'selected' : '' ?>>Enfermedad</option>
                    <option value="Otro" <?= $permiso['tipo'] == 'Otro' ? 'selected' : '' ?>>Otro</option>
                </select>
                <div class="invalid-feedback">Seleccione un tipo válido!</div>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="Pendiente" <?= $permiso['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="Aprobado" <?= $permiso['estado'] == 'Aprobado' ? 'selected' : '' ?>>Aprobado</option>
                    <option value="Rechazado" <?= $permiso['estado'] == 'Rechazado' ? 'selected' : '' ?>>Rechazado</option>
                </select>
                <div class="invalid-feedback">Seleccione un estado válido!</div>
            </div>
            <input type="hidden" name="id" value="<?= $permiso['id'] ?>">
            <button type="submit" class="btn btn-primary btn-lg col-4">Guardar</button>
        </form>
    </div>
</body>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/validate.js"></script>
</html>
