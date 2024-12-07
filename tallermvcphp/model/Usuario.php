<?php
class Usuario {
    // Otros métodos

    public function insertarUsuario($nombre, $email, $rol_id, $clave) {
        // Obtener la conexión de PDO
        $db = (new dataConex())->conexion();

        // Consulta SQL para insertar el usuario
        $sql = "INSERT INTO usuarios (nombre, email, rol_id, clave) VALUES (:nombre, :email, :rol_id, :clave)";

        // Preparar la sentencia
        $stmt = $db->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':rol_id', $rol_id);
        $stmt->bindParam(':clave', $clave);

        // Ejecutar la sentencia
        return $stmt->execute();
    }
}
