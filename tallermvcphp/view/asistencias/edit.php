<?php
   include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
   require_once(CONTROLLER_PATH.'asistenciaController.php');
   $object = new asistenciaController();
   $idAsistencia = $_GET['id'];
   $asistencia = $object->search($idAsistencia);  // Obtiene los datos de la asistencia
   $usuarios = $object->combolist();  // Lista de usuarios para el desplegable
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar Asistencia</title>
   <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body>
   <?php
      require_once(VIEW_PATH.'/navbar/navbar.php');
   ?>
   <div class="container">
      <div class="mb-3">
         <h2>Editando Asistencia</h2>
      </div>
      <form id="formAsistencia" action="update.php" method="post" class="g-3 needs-validation" novalidate>
         <div class="mb-3">
            <label for="id" class="form-label">ID Asistencia</label>
            <input value="<?=$asistencia['id']?>" type="text" class="form-control" id="id" name="id" readonly>
         </div>
         <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select class="form-control" name="usuario_id" id="usuario_id" required>
               <option selected disabled value="">Seleccione un usuario</option>
               <?php foreach ($usuarios as $usuario) { 
                  if ($asistencia['usuario_id'] == $usuario['id']) { ?>
                     <option selected="selected" value="<?=$usuario['id']?>"><?=$usuario['nombre']?></option> 
                  <?php } else { ?>
                     <option value="<?=$usuario['id']?>"><?=$usuario['nombre']?></option> 
                  <?php } 
               } ?>
            </select>
            <div class="invalid-feedback">Seleccione un usuario válido!</div>
         </div>
         <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input value="<?=$asistencia['fecha']?>" type="date" class="form-control" id="fecha" name="fecha" required>
            <div class="invalid-feedback">Ingrese una fecha válida!</div>
         </div>
         <div class="mb-3">
            <label for="hora_entrada" class="form-label">Hora de Entrada</label>
            <input value="<?=$asistencia['hora_entrada']?>" type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
            <div class="invalid-feedback">Ingrese una hora válida!</div>
         </div>
         <div class="mb-3">
            <label for="hora_salida" class="form-label">Hora de Salida</label>
            <input value="<?=$asistencia['hora_salida']?>" type="time" class="form-control" id="hora_salida" name="hora_salida">
            <div class="invalid-feedback">Ingrese una hora válida!</div>
         </div>
         <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea class="form-control" id="comentarios" name="comentarios" rows="3"><?=$asistencia['comentarios']?></textarea>
         </div>
         <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
   </div>
</body>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/js/validate.js"></script>
</html>
