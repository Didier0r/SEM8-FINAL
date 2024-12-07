<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH.'usuarioController.php');
$object = new usuarioController();
$rows = $object->select();
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include_once(ROOT_PATH . 'header.php'); ?>
   <title>Gestión de Usuarios</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <style>
      body {
         background-color: #f8f9fa;
      }
      .table th, .table td {
         text-align: center;
      }
      .btn-custom {
         background-color: #212529; 
         color: white;
      }
      .btn-custom:hover {
         background-color: #343a40;
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
      .table thead {
         background-color: #212529; 
         color: white;
      }
      .table tbody tr:hover {
         background-color: #f1f1f1; 
      }
   </style>
</head>
<body>
   <?php require_once(VIEW_PATH.'navbar/navbar.php'); ?>

   <section class="intro">
      <div class="container">
         <div class="d-flex justify-content-between mb-4">
            <h2 class="text-dark">Listado de Usuarios</h2>
            <div>
               <a href="create.php" class="btn btn-custom">Agregar Usuario</a>
               <a href="javascript:imprimirWindow('ventana')" class="btn btn-info">Imprimir</a>
            </div>
         </div>

         <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="height:700px;">
            <table id="myTabla" class="table table-striped mb-0">
               <thead>
                  <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Nombre</th>
                     <th scope="col">Email</th>
                     <th scope="col">Rol</th>
                     <th scope="col">Operaciones</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ((array)$rows as $row) { ?>
                  <tr>
                     <td><?= htmlspecialchars($row['id']) ?></td>
                     <td><?= htmlspecialchars($row['nombre']) ?></td>
                     <td><?= htmlspecialchars($row['email']) ?></td>
                     <td><?= htmlspecialchars($row['rol_id']) ?></td>
                     <td>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalVer<?= $row['id'] ?>">Ver</button>
                       
                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#iddel<?= $row['id'] ?>">Eliminar</a>
                     </td>
                  </tr>
                  <?php 
                  include('viewModal.php'); 
                  include('deleteModal.php'); 
                  ?>
                  <?php } ?>
               </tbody>
            </table>
         </div>
      </div>
   </section>

   <div class="container" id="ventana" style="display:none;">
      <div class="mb-3">
         <h2>Listado de Usuarios</h2>
      </div>
      <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="height:700px;">
         <table class="table table-striped mb-0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Rol</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($rows as $row) { ?>
               <tr>
                  <td><?= $row['id'] ?></td>
                  <td><?= $row['nombre'] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td><?= $row['rol_id'] ?></td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>

   <script>
      $(document).ready(function() {
         new DataTable('#myTabla', {
            language: {
               url: '../../assets/js/es-ES.json',  // Asegúrate de tener el archivo de idioma en el lugar correcto
            },
            paging: true,
            lengthMenu: [
               [5, 10, 25, 50, -1],
               [5, 10, 25, 50, 'Todos']
            ],
            info: true,  // Habilita la visualización de la información de paginación
            infoCallback: function( settings, start, end, max, total, pre ) {
                return 'Mostrando ' + start + ' a ' + end + ' de ' + total + ' usuarios';
            }
         });
      });
   </script>

   <!-- Modal para ver detalles del usuario -->
   <?php foreach ($rows as $row): ?>
   <div class="modal fade" id="modalVer<?= $row['id'] ?>" tabindex="-1" aria-labelledby="modalVerLabel<?= $row['id'] ?>" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="modalVerLabel<?= $row['id'] ?>">Detalles de Usuario</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p><strong>ID:</strong> <?= $row['id'] ?></p>
               <p><strong>Nombre:</strong> <?= $row['nombre'] ?></p>
               <p><strong>Email:</strong> <?= $row['email'] ?></p>
               <p><strong>Rol:</strong> <?= $row['rol_id'] ?></p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   <?php endforeach; ?>

   <!-- Modal para eliminar usuario -->
   <?php foreach ($rows as $row): ?>
   <div class="modal fade" id="iddel<?= $row['id'] ?>" tabindex="-1" aria-labelledby="iddelLabel<?= $row['id'] ?>" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="iddelLabel<?= $row['id'] ?>">Eliminar Usuario</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               ¿Estás seguro de que deseas eliminar a este usuario?
            </div>
            <div class="modal-footer">
               <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Eliminar</a>
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
         </div>
      </div>
   </div>
   <?php endforeach; ?>

</body>
<?php include_once(ROOT_PATH . 'footer.php'); ?>
</html>
