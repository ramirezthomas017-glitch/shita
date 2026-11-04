
<?php
require_once "app/core/Controller.php";

class EmocionesController extends Controller
{
    public function registrar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . URL . "?url=dashboard");
            exit;
        }

        $idEmocion = filter_input(
            INPUT_POST,
            "id_emocion",
            FILTER_VALIDATE_INT
        );

        if (!$idEmocion || $idEmocion < 1) {
            header("Location: " . URL . "?url=dashboard&emocion=error");
            exit;
        }

        $modelo = $this->model("RegistroEmocional");

        try {
            $guardado = $modelo->registrar(
                (int) $_SESSION["id_usuario"],
                $idEmocion
            );

            if (!$guardado) {
                header("Location: " . URL . "?url=dashboard&emocion=error");
                exit;
            }

            header("Location: " . URL . "?url=dashboard&emocion=ok");
            exit;

        } catch (PDOException $e) {
            error_log("Error al registrar emoción: " . $e->getMessage());

            header("Location: " . URL . "?url=dashboard&emocion=error");
            exit;
        }
    }
}
