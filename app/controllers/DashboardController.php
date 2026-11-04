
<?php
require_once "app/core/Controller.php";

class DashboardController extends Controller
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

        $idUsuario = (int) $_SESSION["id_usuario"];

        $configuracion = $this->model("Configuracion");
        $registro = $this->model("RegistroEmocional");

        $this->view("usuario/dashboard", [
            "pagina" => "dashboard",

            "fraseDelDia" =>
                $configuracion->obtener("frase_del_dia"),

            "autorFrase" =>
                $configuracion->obtener("autor_frase"),

            "catalogoEmociones" =>
                $registro->obtenerCatalogo(),

            "progresoEmocional" =>
                $registro->obtenerProgreso($idUsuario),

            "ultimasEmociones" =>
                $registro->obtenerUltimos($idUsuario),

            "totalRegistrosEmocionales" =>
                $registro->contarRegistros($idUsuario),

            "emocionFrecuente" =>
                $registro->obtenerEmocionFrecuente($idUsuario),

            "totalConversaciones" =>
                $registro->contarConversaciones($idUsuario)
        ]);
    }
}
