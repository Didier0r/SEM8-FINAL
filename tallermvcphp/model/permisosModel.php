<?php
class permisosModel {
    private $PDO;
    
    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/Empresa/tallermvcphp/routes.php');
        require_once(DAO_PATH . 'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // Listar todos los permisos con el nombre del usuario
    public function listar() {
        // Realizamos el JOIN con la tabla usuarios para obtener el nombre del usuario
        $sql = 'SELECT p.id, p.usuario_id, p.tipo, p.fecha_inicio, p.fecha_fin, p.estado, u.nombre AS usuario_nombre
                FROM permisos p
                JOIN usuarios u ON p.usuario_id = u.id
                ORDER BY p.id DESC';
        
        $statement = $this->PDO->prepare($sql);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    // Insertar un nuevo permiso
    public function insertar($usuario_id, $tipo, $fecha_inicio, $fecha_fin, $estado) {
        $sql = 'INSERT INTO permisos (usuario_id, tipo, fecha_inicio, fecha_fin, estado) 
                VALUES (:usuario_id, :tipo, :fecha_inicio, :fecha_fin, :estado)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':usuario_id', $usuario_id);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':fecha_inicio', $fecha_inicio);
        $statement->bindParam(':fecha_fin', $fecha_fin);
        $statement->bindParam(':estado', $estado);
        $statement->execute();
        return ($this->PDO->lastInsertId());
    }

    // Actualizar un permiso existente
    public function actualizar($id, $usuario_id, $tipo, $fecha_inicio, $fecha_fin, $estado) {
        $sql = 'UPDATE permisos SET 
                usuario_id = :usuario_id, tipo = :tipo, fecha_inicio = :fecha_inicio, 
                fecha_fin = :fecha_fin, estado = :estado 
                WHERE id = :id';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':usuario_id', $usuario_id);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':fecha_inicio', $fecha_inicio);
        $statement->bindParam(':fecha_fin', $fecha_fin);
        $statement->bindParam(':estado', $estado);
        $statement->bindParam(':id', $id);
        return ($statement->execute()) ? true : false;
    }

    // Eliminar un permiso
    public function eliminar($id) {
        $sql = 'DELETE FROM permisos WHERE id = :id';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id', $id);
        return ($statement->execute()) ? true : false;
    }

    // Obtener usuarios para un desplegable
    public function cargarDesplegableUsuarios() {
        $sql = 'SELECT id, nombre FROM usuarios ORDER BY id ASC';
        $statement = $this->PDO->prepare($sql);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }

    // Buscar un permiso por su ID con el nombre del usuario
    public function buscar($id) {
        $sql = 'SELECT p.*, u.nombre AS usuario_nombre FROM permisos p
                JOIN usuarios u ON p.usuario_id = u.id
                WHERE p.id = :id';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id', $id);
        return ($statement->execute()) ? $statement->fetch() : false;
    }
}

?>
