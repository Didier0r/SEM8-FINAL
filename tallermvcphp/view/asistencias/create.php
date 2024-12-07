<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'asistenciaController.php');

$object = new asistenciaController();

try {
    $usuarios = $object->combolist();

    if (!$usuarios || !is_array($usuarios)) {
        throw new Exception("No se pudo obtener la lista de usuarios.");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
    <title>Registro de Asistencias</title>
    <style>
        body {
            background-color: #f4f4f9;
        }
        .container {
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .select2-container {
            width: 100% !important;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>
    <div class="container">
        <h2 class="mb-4 text-center">Registrar Asistencia</h2>
        <form id="formAsistencia" action="store.php" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="usuario_id" class="form-label">Usuario</label>
                <select class="form-control" name="usuario_id" id="usuario_id" required>
                    <option selected disabled value="">Seleccione un usuario</option>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <option value="<?= htmlspecialchars($usuario['id'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($usuario['nombre'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Seleccione un usuario válido!</div>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
                <div class="invalid-feedback">Ingrese una fecha válida!</div>
            </div>
            <div class="mb-3">
                <label for="hora_entrada" class="form-label">Hora de Entrada</label>
                <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
                <div class="invalid-feedback">Ingrese una hora válida!</div>
            </div>
            <div class="mb-3">
                <label for="hora_salida" class="form-label">Hora de Salida</label>
                <input type="time" class="form-control" id="hora_salida" name="hora_salida">
                <div class="invalid-feedback">Ingrese una hora válida!</div>
            </div>
            <div class="mb-3">
                <label for="comentarios" class="form-label">Comentarios</label>
                <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-custom btn-lg col-6">Guardar</button>
            </div>
        </form>
    </div>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usuario_id').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Seleccione un usuario'
            });
        });
    </script>
</body>
</html>
