<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION["usuario"])) {
    header('location: ../usuario/login.php');
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'usuarioController.php');

$object = new usuarioController();
$roles = $object->comboListRoles(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once(ROOT_PATH . 'header.php'); ?>
    <title>Agregar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
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
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .form-label {
            font-weight: bold;
        }
        .select2-container {
            width: 100% !important;
        }
        .modal-footer {
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>

    <div class="container">
        <h4 class="mb-4">Agregar Nuevo Usuario</h4>
        <form id="addUsuario" role="form" class="g-3 needs-validation" novalidate method="POST" action="guardar_usuario.php">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="invalid-feedback">Ingrese un nombre válido!</div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="invalid-feedback">Ingrese un correo válido!</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="rol_id" class="form-label">Rol</label>
                    <select class="form-control" name="rol_id" id="rol_id" required>
                        <option selected disabled value="">Seleccione un rol</option>
                        <?php foreach ($roles as $rol): ?>
                            <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Seleccione un rol válido!</div>
                </div>
                <div class="col-md-6">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave" required>
                    <div class="invalid-feedback">Ingrese una contraseña válida!</div>
                </div>
            </div>

            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-custom">
                    <span class="fa fa-save"></span> Guardar Usuario
                </button>
            </div>
        </form>
    </div>

    <?php require_once(ROOT_PATH . 'footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#rol_id').select2({
                theme: "bootstrap-5",
                width: '100%',
                placeholder: "Seleccione un rol"
            });
        });
    </script>
</body>
</html>
