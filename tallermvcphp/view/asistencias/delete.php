<?php
   include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');

   require_once(CONTROLLER_PATH.'asistenciaController.php');
   $object = new asistenciaController();

   $idAsistencia = $_REQUEST['id'];
   $object->delete($idAsistencia);
?>
