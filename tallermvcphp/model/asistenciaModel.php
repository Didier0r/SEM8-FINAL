<?php
class asistenciaModel {
    private $PDO;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
        require_once(DAO_PATH.'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();  // Establecer la conexión con la base de datos
    }

    public function insertar($usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios) {
        $sql = 'INSERT INTO asistencias (usuario_id, fecha, hora_entrada, hora_salida, comentarios) 
                VALUES (:usuario_id, :fecha, :hora_entrada, :hora_salida, :comentarios)';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':usuario_id', $usuario_id);
        $statement->bindParam(':fecha', $fecha);
        $statement->bindParam(':hora_entrada', $hora_entrada);
        $statement->bindParam(':hora_salida', $hora_salida);
        $statement->bindParam(':comentarios', $comentarios);
        $statement->execute();
        return $this->PDO->lastInsertId();  // Devuelve el último ID insertado
    }

    public function actualizar($id, $usuario_id, $fecha, $hora_entrada, $hora_salida, $comentarios) {
        $sql = 'UPDATE asistencias 
                SET usuario_id = :usuario_id, fecha = :fecha, hora_entrada = :hora_entrada, 
                    hora_salida = :hora_salida, comentarios = :comentarios 
                WHERE id = :id';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':usuario_id', $usuario_id);
        $statement->bindParam(':fecha', $fecha);
        $statement->bindParam(':hora_entrada', $hora_entrada);
        $statement->bindParam(':hora_salida', $hora_salida);
        $statement->bindParam(':comentarios', $comentarios);
        return $statement->execute();  // Ejecuta la actualización y devuelve el resultado
    }

    public function eliminar($id) {
        // Usamos $this->PDO para la conexión a la base de datos
        $query = "DELETE FROM asistencias WHERE id = :id";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Ejecutar la consulta y devolver el resultado
        return $stmt->execute();  // Devuelve true si se ejecutó correctamente
    }

    public function listar() {
        $sql = 'SELECT a.id, a.usuario_id, u.nombre AS usuario, a.fecha, a.hora_entrada, a.hora_salida, a.comentarios 
                FROM asistencias a 
                JOIN usuarios u ON a.usuario_id = u.id 
                ORDER BY a.fecha DESC, a.hora_entrada DESC';
        $statement = $this->PDO->prepare($sql);
        return $statement->execute() ? $statement->fetchAll() : false;
    }
    
    public function buscar($id) {
        $sql = 'SELECT a.id, a.usuario_id, u.nombre AS usuario, a.fecha, a.hora_entrada, a.hora_salida, a.comentarios 
                FROM asistencias a 
                JOIN usuarios u ON a.usuario_id = u.id 
                WHERE a.id = :id';
        $statement = $this->PDO->prepare($sql);
        $statement->bindParam(':id', $id);
        return $statement->execute() ? $statement->fetch() : false;
    }
}

?>
