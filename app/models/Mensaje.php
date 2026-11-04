<?php

require_once "app/core/Model.php";

class Mensaje extends Model
{
    public function guardar($datos)
    {
        $sql = "INSERT INTO mensajes
                (id_conversacion, mensaje, emisor)
                VALUES
                (:id_conversacion, :mensaje, :emisor)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($datos);
    }

    public function obtenerPorConversacion($id_conversacion)
    {
        $sql = "SELECT *
                FROM mensajes
                WHERE id_conversacion = :id_conversacion
                ORDER BY fecha ASC";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_conversacion" => $id_conversacion
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUltimos($id_conversacion, $limite = 12)
    {
        $limite = intval($limite);

        $sql = "SELECT emisor, mensaje, fecha
                FROM mensajes
                WHERE id_conversacion = :id_conversacion
                ORDER BY fecha DESC, id_mensaje DESC
                LIMIT $limite";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_conversacion" => $id_conversacion
        ]);

        $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_reverse($mensajes);
    }

    public function contarPorConversacion($id_conversacion)
{
    $sql = "SELECT COUNT(*) AS total
            FROM mensajes
            WHERE id_conversacion = :id_conversacion";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        "id_conversacion" => $id_conversacion
    ]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return (int)$resultado["total"];
}

public function obtenerPrimerMensajeUsuario($id_conversacion)
{
    $sql = "SELECT mensaje
            FROM mensajes
            WHERE id_conversacion = :id_conversacion
            AND emisor = 'Usuario'
            ORDER BY id_mensaje ASC
            LIMIT 1";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        "id_conversacion" => $id_conversacion
    ]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado["mensaje"] ?? "Nueva conversación";
}
}