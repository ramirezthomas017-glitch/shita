<?php

require_once "app/core/Model.php";

class Usuario extends Model
{
    protected $tabla = "usuarios";

    // Buscar si el correo ya existe
    public function buscarCorreo($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":correo", $correo);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar usuario
    public function registrar($datos)
    {
        $sql = "INSERT INTO usuarios
        (nombre, apellido, correo, password, id_rol)
        VALUES
        (:nombre, :apellido, :correo, :password, :id_rol)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($datos);
    }

    // Buscar usuario por correo
    public function login($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = :correo";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":correo", $correo);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Eliminar cuenta
    public function eliminarCuenta($id_usuario)
    {
        $sql = "DELETE FROM usuarios
                WHERE id_usuario = :id_usuario";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "id_usuario" => $id_usuario
        ]);
    }

    // Obtener usuario por ID
    public function obtenerPorId($id_usuario)
    {
        $sql = "SELECT *
                FROM usuarios
                WHERE id_usuario = :id_usuario
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_usuario" => $id_usuario
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar datos del perfil
    public function actualizarPerfil($id_usuario, $nombre, $apellido, $correo)
    {
        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    apellido = :apellido,
                    correo = :correo
                WHERE id_usuario = :id_usuario";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "nombre" => $nombre,
            "apellido" => $apellido,
            "correo" => $correo,
            "id_usuario" => $id_usuario
        ]);
    }

    // Cambiar contraseña
    public function cambiarPassword($id_usuario, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios
                SET password = :password
                WHERE id_usuario = :id_usuario";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "password" => $passwordHash,
            "id_usuario" => $id_usuario
        ]);
    }

    // Actualizar foto de perfil
    public function actualizarFoto($id_usuario, $foto)
    {
        $sql = "UPDATE usuarios
                SET foto = :foto
                WHERE id_usuario = :id_usuario";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "foto" => $foto,
            "id_usuario" => $id_usuario
        ]);
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                u.id_usuario,
                u.nombre,
                u.apellido,
                u.correo,
                u.estado,
                u.fecha_registro,
                r.nombre AS nombre_rol
            FROM usuarios u
            INNER JOIN roles r
                ON u.id_rol = r.id_rol
            ORDER BY u.id_usuario DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}