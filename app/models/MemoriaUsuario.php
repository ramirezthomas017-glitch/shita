<?php

require_once "app/core/Model.php";

class MemoriaUsuario extends Model
{
    public function obtener($id_usuario)
    {
        $sql = "SELECT memoria
                FROM memorias_usuario
                WHERE id_usuario = :id_usuario
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_usuario" => $id_usuario
        ]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado["memoria"] ?? "";
    }

    public function guardar($id_usuario, $memoria)
    {
        $sql = "SELECT id_memoria
                FROM memorias_usuario
                WHERE id_usuario = :id_usuario
                LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id_usuario" => $id_usuario
        ]);

        $existente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existente) {

            $sql = "UPDATE memorias_usuario
                    SET memoria = :memoria
                    WHERE id_usuario = :id_usuario";

        } else {

            $sql = "INSERT INTO memorias_usuario
                    (id_usuario, memoria)
                    VALUES
                    (:id_usuario, :memoria)";
        }

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "id_usuario" => $id_usuario,
            "memoria" => $memoria
        ]);
    }
}   