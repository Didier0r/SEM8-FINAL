<?php
     session_start();
    error_reporting(E_ALL);
     ini_set('display_errors', 1);
     

 
     $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : null;
     $clave = (isset($_POST['clave'])) ? $_POST['clave'] : null;
 
     include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
     require_once(CONTROLLER_PATH.'usuarioController.php');
     $object = new usuarioController();
     $resultado = $object->search($usuario);
     
    if ( $resultado ) {
         $data = $resultado;
         $idUsuario = $resultado['idUsuario'];        
        $usuario = $resultado['alias'];
         $hash = $resultado['clave'];
         $rol_id = $resultado['rol_id']; 
 
         if (password_verify($clave, $hash)) {
             $_SESSION["idUsuario"] = $idUsuario;
             $_SESSION["usuario"] = $usuario; 
             $_SESSION["rol_id"] = $rol_id; 
        } else {
             $_SESSION["idUsuario"] = null;
             $_SESSION["usuario"] = null;
             $_SESSION["rol_id"] = null;
             $data = null;
         }
     } else {
         $_SESSION["idUsuario"] = null;
         $_SESSION["usuario"] = null;
         $data = null;
     }
     print json_encode($data);
     exit();
  ?>