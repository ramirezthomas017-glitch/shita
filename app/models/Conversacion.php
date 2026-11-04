<?php

require_once "app/core/Model.php";

class Conversacion extends Model
{
    public function crear($id_usuario)
    {
        $sql = "INSERT INTO conversaciones (id_usuario)
                VALUES (:id_usuario)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_usuario" => $id_usuario
        ]);

        return $this->db->lastInsertId();
    }

    public function obtenerUltima($id_usuario)
    {
        $sql = "SELECT *
                FROM conversaciones
                WHERE id_usuario = :id_usuario
                ORDER BY fecha DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_usuario" => $id_usuario
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerResumen($id_conversacion)
{
    $sql = "SELECT resumen
            FROM conversaciones
            WHERE id_conversacion = :id_conversacion
            LIMIT 1";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        "id_conversacion" => $id_conversacion
    ]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado["resumen"] ?? "";
}


public function actualizarResumen($id_conversacion, $resumen)
{
    $sql = "UPDATE conversaciones
            SET resumen = :resumen
            WHERE id_conversacion = :id_conversacion";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        "resumen" => $resumen,
        "id_conversacion" => $id_conversacion
    ]);
}

    public function perteneceAUsuario($id_conversacion, $id_usuario)
{
    $sql = "SELECT id_conversacion
            FROM conversaciones
            WHERE id_conversacion = :id_conversacion
            AND id_usuario = :id_usuario
            LIMIT 1";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        "id_conversacion" => $id_conversacion,
        "id_usuario" => $id_usuario
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function obtenerPorId($id_conversacion, $id_usuario)
{
    $sql = "SELECT *
            FROM conversaciones
            WHERE id_conversacion = :id_conversacion
            AND id_usuario = :id_usuario
            LIMIT 1";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        "id_conversacion" => $id_conversacion,
        "id_usuario" => $id_usuario
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function obtenerPorUsuario($id_usuario)
{
    $sql = "SELECT id_conversacion, fecha, resumen
            FROM conversaciones
            WHERE id_usuario = :id_usuario
            ORDER BY fecha DESC";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        "id_usuario" => $id_usuario
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function eliminar($id_conversacion, $id_usuario)
{
    $sql = "DELETE FROM conversaciones
            WHERE id_conversacion = :id_conversacion
            AND id_usuario = :id_usuario";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        "id_conversacion" => $id_conversacion,
        "id_usuario" => $id_usuario
    ]);
}

}