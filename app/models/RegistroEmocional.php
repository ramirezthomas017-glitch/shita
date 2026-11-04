
<?php
require_once "app/core/Model.php";

class RegistroEmocional extends Model
{
    public function obtenerCatalogo()
    {
        $sql = "SELECT id_emocion, nombre, color
                FROM emociones
                ORDER BY id_emocion ASC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrar($idUsuario, $idEmocion)
    {
        $sql = "INSERT INTO registros_emocionales
                    (id_usuario, id_emocion)
                SELECT :usuario, e.id_emocion
                FROM emociones e
                WHERE e.id_emocion = :emocion";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "usuario" => $idUsuario,
            "emocion" => $idEmocion
        ]);

        return $stmt->rowCount() === 1;
    }

    public function obtenerProgreso($idUsuario)
    {
        $sql = "SELECT e.id_emocion, e.nombre, e.color,
                       COUNT(r.id_registro) AS cantidad
                FROM emociones e
                LEFT JOIN registros_emocionales r
                    ON r.id_emocion = e.id_emocion
                    AND r.id_usuario = :usuario
                GROUP BY e.id_emocion, e.nombre, e.color
                ORDER BY cantidad DESC, e.id_emocion ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["usuario" => $idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUltimos($idUsuario)
    {
        $sql = "SELECT e.nombre, e.color, r.fecha_registro
                FROM registros_emocionales r
                INNER JOIN emociones e
                    ON e.id_emocion = r.id_emocion
                WHERE r.id_usuario = :usuario
                ORDER BY r.fecha_registro DESC, r.id_registro DESC
                LIMIT 7";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["usuario" => $idUsuario]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarRegistros($idUsuario)
    {
        $sql = "SELECT COUNT(*)
                FROM registros_emocionales
                WHERE id_usuario = :usuario";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["usuario" => $idUsuario]);

        return (int) $stmt->fetchColumn();
    }

    public function obtenerEmocionFrecuente($idUsuario)
    {
        $sql = "SELECT e.nombre, COUNT(*) AS cantidad
                FROM registros_emocionales r
                INNER JOIN emociones e
                    ON e.id_emocion = r.id_emocion
                WHERE r.id_usuario = :usuario
                GROUP BY e.id_emocion, e.nombre
                ORDER BY cantidad DESC, MAX(r.fecha_registro) DESC
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["usuario" => $idUsuario]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }

    public function contarConversaciones($idUsuario)
    {
        $sql = "SELECT COUNT(*)
                FROM conversaciones
                WHERE id_usuario = :usuario";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(["usuario" => $idUsuario]);

        return (int) $stmt->fetchColumn();
    }
}
