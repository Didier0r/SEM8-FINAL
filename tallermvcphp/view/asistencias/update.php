<?php
   include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
   
  
   require_once(CONTROLLER_PATH.'asistenciaController.php');
   $object = new asistenciaController();

   
   $idAsistencia = $_REQUEST['id'];  // ID de la asistencia
   $usuario_id = $_REQUEST['usuario_id'];  // ID del usuario
   $fecha = $_REQUEST['fecha'];  
   $hora_entrada = $_REQUEST['hora_entrada'];  
   $hora_salida = $_REQUEST['hora_salida'];  
   $comentarios = $_REQUEST['comentarios']; 

  
   $object->update($idAsistencia, $usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios);
?>
<script>
   
   history.replaceState(null, null, location.pathname);
</script>
