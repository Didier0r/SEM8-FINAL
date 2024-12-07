<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'permisosController.php');
$object = new permisosController();
$rows = $object->select();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once(ROOT_PATH . 'header.php') ?>
    <title>Permisos</title>
    
    <!-- Carga de Bootstrap CSS desde el CDN oficial -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa; /* Fondo claro */
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-custom {
            background-color: #212529; /* Color de fondo oscuro */
            color: white;
        }
        .btn-custom:hover {
            background-color: #343a40; /* Un tono más oscuro al pasar el mouse */
        }
        .table-scroll {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .intro {
            margin-top: 30px;
        }
        .container {
            max-width: 90%;
        }
        /* Encabezado de la tabla */
        .table thead {
            background-color: #212529; /* Fondo oscuro */
            color: white;
        }
        /* Fila de la tabla al pasar el mouse */
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Fila de color gris claro */
        }
    </style>
</head>
<body>
    <?php require_once(VIEW_PATH . 'navbar/navbar.php'); ?>
    
    <section class="intro">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <h2 class="text-dark">Listado de Permisos</h2>
                <div>
                    <a href="create.php" class="btn btn-custom">Agregar</a>
                    <a href="javascript:imprimirWindow('ventana')" class="btn btn-info">Imprimir</a>
                </div>
            </div>
            
            <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="height:700px;">
                <table id="myTabla" class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">USUARIO</th>
                            <th scope="col">TIPO</th>
                            <th scope="col">FECHA INICIO</th>
                            <th scope="col">FECHA FIN</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">OPERACIONES</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ((array)$rows as $row) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['usuario_nombre'] ?></td> 
            <td><?= $row['tipo'] ?></td>
            <td><?= $row['fecha_inicio'] ?></td>
            <td><?= $row['fecha_fin'] ?></td>
            <td><?= $row['estado'] ?></td>
            <td>
                <!-- Botón para abrir modal de Ver -->
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalVer<?= $row['id'] ?>">Ver</button>

                <!-- Modal de Ver -->
                <div class="modal fade" id="modalVer<?= $row['id'] ?>" tabindex="-1" aria-labelledby="verLabel<?= $row['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="verLabel<?= $row['id'] ?>">Detalles del Permiso</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>ID:</strong> <?= $row['id'] ?></p>
                                <p><strong>Usuario:</strong> <?= $row['usuario_nombre'] ?></p> <!-- Mostrar el nombre del usuario -->
                                <p><strong>Tipo:</strong> <?= $row['tipo'] ?></p>
                                <p><strong>Fecha Inicio:</strong> <?= $row['fecha_inicio'] ?></p>
                                <p><strong>Fecha Fin:</strong> <?= $row['fecha_fin'] ?></p>
                                <p><strong>Estado:</strong> <?= $row['estado'] ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Editar</a>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#iddel<?= $row['id'] ?>">Eliminar</a>

                <!-- Modal de Eliminar -->
                <?php include('deleteModal.php'); ?>
            </td>
        </tr>
    <?php } ?>
</tbody>

                </table>
            </div>
        </div>
    </section>

    <!-- Div área de impresión -->
    <div class="container" id="ventana" style="display:none;">
        <div class="mb-3">
            <h2 style="font-size: 3.00rem;">Listado de permisos</h2>
        </div>
        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="height:700px;">
            <table class="table table-striped mb-0" style="font-size: 1.50rem;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['fecha_inicio'] ?></td>
                            <td><?= $row['fecha_fin'] ?></td>
                            <td><?= $row['usuario_id'] ?></td>
                            <td><?= $row['tipo'] ?></td>
                            <td><?= $row['estado'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <script>
        $(document).ready(function () {
            new DataTable('#myTabla', {
                language: {
                    url: '../../assets/js/es-ES.json',
                },
                paging: true,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'Todos']
                ]
            });
        });
    </script>
</body>
<?php include_once(ROOT_PATH . 'footer.php') ?>
</html>
