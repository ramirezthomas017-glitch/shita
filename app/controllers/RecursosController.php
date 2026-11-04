
<?php
require_once "app/core/Controller.php";

class RecursosController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $this->view("usuario/recursos", [
            "pagina" => "recursos"
        ]);
    }
}
