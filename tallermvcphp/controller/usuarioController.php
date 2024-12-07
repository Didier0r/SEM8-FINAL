<?php
class usuarioController{
    private $model;

    public function __construct() {
        include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
        require_once(MODEL_PATH.'usuarioModel.php');
        $this->model = new usuarioModel();
    }

    // Método de búsqueda del usuario
    public function search($usuario) {
        // Obtener la conexión de PDO
        $db = (new dataConex())->conexion();
        
        // Consulta SQL para obtener el usuario
        $sql = "SELECT id, nombre AS alias, clave, rol_id FROM usuarios WHERE nombre = :usuario LIMIT 1";
        
        // Preparar la sentencia
        $stmt = $db->prepare($sql);
        
        // Vincular el parámetro
        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        
        // Ejecutar la sentencia
        $stmt->execute();
        
        // Verificar si hay resultados
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el usuario encontrado
        } else {
            return null; // Si no se encontró ningún usuario
        }
    }

    // Método para iniciar sesión
    public function login($usuario, $clave) {
        // Buscar el usuario en la base de datos
        $user = $this->search($usuario);

        // Verificar si el usuario existe
        if ($user) {
            // Verificar si la clave es correcta
            if (password_verify($clave, $user['clave'])) {
                // Iniciar sesión y guardar los datos en la sesión
                session_start();
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['alias'];
                $_SESSION['usuario_rol'] = $user['rol_id'];

                // Redirigir dependiendo del rol
                if ($user['rol_id'] == 1) {
                    header('Location: /admin/dashboard.php'); // Redirigir a la página del administrador
                    exit();
                } else {
                    header('Location: /home.php'); // Redirigir a la página de inicio para otros roles
                    exit();
                }
            } else {
                return "Contraseña incorrecta";
            }
        } else {
            return "Usuario no encontrado";
        }
    }

    // Verificar si el usuario está autenticado y tiene el rol adecuado
    public function checkAuth() {
        session_start();
        if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_rol'] == 1) {
            return true;
        }
        return false;
    }

    public function select(){
        return ($this->model->listar()) ? $this->model->listar() : false;
    }

    public function listUsuarios() {
        return ($this->model->listarUsuarios()) ? $this->model->listarUsuarios() : false;
    }

    public function getUsuarioById($id) {
        return ($this->model->obtenerPorId($id)) ? $this->model->obtenerPorId($id) : false;
    }

    public function comboListRoles() {
        return ($this->model->listarRoles()) ? $this->model->listarRoles() : false;
    }

    public function update($id) {
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['rol_id'])) {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $rol_id = $_POST['rol_id'];

            // Llama al método en el modelo para actualizar los datos
            return $this->model->actualizarUsuario($id, $nombre, $email, $rol_id);
        }
        return false;
    }

    public function getById($id) {
        return $this->model->obtenerPorId($id);
    }

    public function agregarUsuario($nombre, $email, $rol_id, $clave) {
        require_once(MODEL_PATH . 'Usuario.php');
        $usuario = new Usuario();
        return $usuario->insertarUsuario($nombre, $email, $rol_id, $clave);
    }

    public function insertarUsuario($nombre, $email, $rol_id, $clave) {
        // Obtener la conexión de PDO
        $db = (new dataConex())->conexion();
        
        // Consulta SQL para insertar el usuario
        $sql = "INSERT INTO usuarios (nombre, email, rol_id, clave) VALUES (:nombre, :email, :rol_id, :clave)";
        
        // Preparar la sentencia
        $stmt = $db->prepare($sql);
        
        // Vincular los parámetros
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':rol_id', $rol_id, PDO::PARAM_INT);
        $stmt->bindValue(':clave', $clave, PDO::PARAM_STR);
        
        // Ejecutar la sentencia
        return $stmt->execute();
    }

    public function delete($id) {
        var_dump($id);  
        return $this->model->eliminarUsuario($id);
    }
    
}
?>
