<?php

require_once "app/core/Model.php";

class Configuracion extends Model
{
    public function obtener($clave)
    {
        $sql = "SELECT valor
                FROM configuracion_sitio
                WHERE clave = :clave
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["clave" => $clave]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado["valor"] : "";
    }

    public function guardar($clave, $valor)
    {
        $sql = "INSERT INTO configuracion_sitio (clave, valor)
                VALUES (:clave, :valor)
                ON DUPLICATE KEY UPDATE valor = VALUES(valor)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            "clave" => $clave,
            "valor" => $valor
        ]);
    }
}