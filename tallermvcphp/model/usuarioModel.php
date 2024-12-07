<?php
class usuarioModel {
    private $PDO;

    public function __construct(){
        include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
        require_once(DAO_PATH.'database.php');
        $data = new dataConex();
        $this->PDO = $data->conexion();
    }

    // Listar todos los usuarios
    public function listar() {
        try {
            $sql = 'SELECT * FROM usuarios ORDER BY id';
            $statement = $this->PDO->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en listar usuarios: " . $e->getMessage());
            return false;
        }
    }

    // Buscar un usuario por su nombre
    public function buscar($usuario) {
        try {
            $sql = 'SELECT * FROM usuarios WHERE nombre = :nombre';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre', $usuario);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en buscar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Insertar un nuevo usuario
    public function insertar($nombre, $email, $clave, $rol_id) {
        try {
            $clave = password_hash($clave, PASSWORD_DEFAULT);
            $sql = 'INSERT INTO usuarios (nombre, email, clave, rol_id) VALUES (:nombre, :email, :clave, :rol_id)';
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':clave', $clave);
            $statement->bindParam(':rol_id', $rol_id);
            $statement->execute();
            return $this->PDO->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en insertar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Listar usuarios (solo id y nombre)
    public function listarUsuarios() {
        try {
            $query = "SELECT id, nombre FROM usuarios";
            $stmt = $this->PDO->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en listar usuarios: " . $e->getMessage());
            return false;
        }
    }

    // Listar roles (para combobox)
    public function listarRoles() {
        try {
            $query = "SELECT id, nombre FROM roles";  // Suponiendo que tienes una tabla 'roles'
            $stmt = $this->PDO->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en listar roles: " . $e->getMessage());
            return false;
        }
    }

    // Obtener un usuario por su ID
    public function obtenerPorId($id) {
        try {
            $query = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->PDO->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtener usuario por ID: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar un usuario
    public function actualizarUsuario($id, $nombre, $email, $rol_id) {
        try {
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, rol_id = :rol_id WHERE id = :id";
            $statement = $this->PDO->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':rol_id', $rol_id);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } catch (PDOException $e) {
            error_log("Error en actualizar usuario: " . $e->getMessage());
            return false;
        }
    }
    
    public function eliminarUsuario($id) {
        $db = (new dataConex())->conexion();
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
