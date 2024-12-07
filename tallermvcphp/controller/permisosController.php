<?php
class permisosController {
    private $model;
    
    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
        require_once(MODEL_PATH . 'permisosModel.php');
        $this->model = new permisosModel();
    }
    
    // Seleccionar todos los permisos, incluyendo el nombre del usuario
    public function select() {
        // Llamamos a la función 'listar' del modelo que obtiene los permisos con el nombre del usuario
        return $this->model->listar() ?: false;
    } 
    
    // Insertar un nuevo permiso
    public function insert($usuario_id, $tipo, $fecha_inicio, $fecha_fin, $estado) {
        $id = $this->model->insertar($usuario_id, $tipo, $fecha_inicio, $fecha_fin, $estado);
        if ($id !== false) {
            header('Location: ./index.php');
        } else {
            header('Location: ./create.php');
        }
    }
    
    // Actualizar un permiso existente
    public function update($id, $usuario_id, $tipo, $fecha_inicio, $fecha_fin, $estado) {
        $resultado = $this->model->actualizar($id, $usuario_id, $tipo, $fecha_inicio, $fecha_fin, $estado);
        if ($resultado) {
            header('Location: ./index.php');
        } else {
            header('Location: ./edit.php?id=' . $id);
        }
    }
    
    // Eliminar un permiso
    public function delete($id) {
        if ($this->model->eliminar($id)) {
            header('Location: ./index.php');
        } else {
            header('Location: ./index.php');
        }
    }
    
    // Buscar un permiso por ID
    public function search($id) {
        $resultado = $this->model->buscar($id);
        return $resultado ?: header('Location: ./index.php');
    }
    
    // Obtener la lista de usuarios para un desplegable
    public function combolistUsuarios() {
        return $this->model->cargarDesplegableUsuarios() ?: false;
    }
}

?>
