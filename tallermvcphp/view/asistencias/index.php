<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH.'asistenciaController.php');
$object = new AsistenciaController();
$rows = $object->select();
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php include_once(ROOT_PATH . 'header.php'); ?>
   <title>Asistencias</title>
   
 
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

   
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <style>
      body {
         background-color: #f8f9fa; /
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
            <h2 class="text-dark">Listado de Asistencias</h2>
            <div>
               <a href="create.php" class="btn btn-custom">Agregar</a>
               <a href="pdf/asistencias.php" target="_blank" class="btn btn-info">Imprimir</a>
            </div>
         </div>

         <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="height:700px;">
            <table id="myTabla" class="table table-striped mb-0">
               <thead>
                  <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Usuario</th>
                     <th scope="col">Fecha</th>
                     <th scope="col">Hora Entrada</th>
                     <th scope="col">Hora Salida</th>
                     <th scope="col">Comentarios</th>
                     <th scope="col">Operaciones</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ((array)$rows as $row) { ?>
                  <tr>
                     <td><?=$row['id']?></td>
                     <td><?=$row['usuario']?></td>
                     <td><?=$row['fecha']?></td>
                     <td><?=$row['hora_entrada']?></td>
                     <td><?=$row['hora_salida']?></td>
                     <td><?=$row['comentarios']?></td>
                     <td>
                        
                        <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#idver<?= $row['id'] ?>">Ver</a>
                        <a href="edit.php?id=<?=$row['id']?>" class="btn btn-warning">Editar</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar esta asistencia?');">Eliminar</a>
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
         <h2>Listado de Asistencias</h2>
      </div>
      <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="height:700px;">
         <table class="table table-striped mb-0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Usuario</th>
                  <th>Fecha</th>
                  <th>Hora Entrada</th>
                  <th>Hora Salida</th>
                  <th>Comentarios</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($rows as $row) { ?>
               <tr>
                  <td><?=$row['id']?></td>
                  <td><?=$row['usuario']?></td>
                  <td><?=$row['fecha']?></td>
                  <td><?=$row['hora_entrada']?></td>
                  <td><?=$row['hora_salida']?></td>
                  <td><?=$row['comentarios']?></td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
   
  
   <script>
      $(document).ready(function() {
         var table = new DataTable('#myTabla', {
            language: {
               url: '../../assets/js/es-ES.json',
            },
            'paging': true,
            lengthMenu: [
               [5, 10, 25, 50, -1],
               [5, 10, 25, 50, 'Todos']
            ]
         });
      });
   </script>
</body>
<?php include_once(ROOT_PATH . 'footer.php'); ?>
</html>
