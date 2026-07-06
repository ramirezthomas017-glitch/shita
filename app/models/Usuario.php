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
}