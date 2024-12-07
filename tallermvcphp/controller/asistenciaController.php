<?php
class asistenciaController {
    private $model;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
        require_once(MODEL_PATH.'asistenciaModel.php');
        $this->model = new asistenciaModel();
    }

    public function insert($usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios) {
        $id = $this->model->insertar($usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios);
        return ($id != false) ? header('location: ./index.php') : header('location: ./create.php');
    }

    public function update($id, $usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios) {
        return ($this->model->actualizar($id, $usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios) != false) 
            ? header('location: ./index.php') 
            : header('location: ./edit.php?id='.$id);
    }

    public function delete($id) {
       
        if ($this->model->eliminar($id)) {
            $_SESSION["success"] = "Asistencia eliminada con éxito.";
        } else {
            $_SESSION["error"] = "No se pudo eliminar la asistencia. Intenta nuevamente.";
        }
   
        header('Location: ./index.php');
        exit();
    }

    public function search($id) {
        $result = $this->model->buscar($id);
        return ($result != false) ? $result : header('location: ./index.php');
    }

    public function select() {
        $result = $this->model->listar();
        return ($result) ? $result : false;
    }

    public function combolist() {
        include_once(MODEL_PATH . 'usuarioModel.php');
        $usuarioModel = new usuarioModel();
        return $usuarioModel->listarUsuarios(); 
    }
}

?>
