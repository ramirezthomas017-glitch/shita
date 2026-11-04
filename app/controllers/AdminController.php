<?php

require_once "app/core/Controller.php";

class AdminController extends Controller
{
    private $usuario;
    private $configuracion;

    public function __construct()
    {
        $this->usuario = $this->model("Usuario");
        $this->configuracion = $this->model("Configuracion");
    }

    private function verificarAdministrador()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        if ((int) ($_SESSION["rol"] ?? 0) !== 1) {
            header("Location: " . URL . "?url=dashboard");
            exit;
        }
    }

    public function index()
    {
        $this->verificarAdministrador();

        $usuarios = $this->usuario->obtenerTodos();

        $this->view("admin/index", [
            "pagina" => "admin",
            "usuarios" => $usuarios,
            "frase" => $this->configuracion->obtener("frase_del_dia"),
            "autorFrase" => $this->configuracion->obtener("autor_frase")
        ]);
    }

    public function guardarFrase()
    {
        $this->verificarAdministrador();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . URL . "?url=admin");
            exit;
        }

        $frase = trim($_POST["frase"] ?? "");
        $autor = trim($_POST["autor"] ?? "");

        if ($frase === "" || mb_strlen($frase) > 1000) {
            die("La frase es obligatoria y no puede superar los 1000 caracteres.");
        }

        if (mb_strlen($autor) > 150) {
            die("El nombre del autor es demasiado largo.");
        }

        $this->configuracion->guardar("frase_del_dia", $frase);
        $this->configuracion->guardar(
            "autor_frase",
            $autor !== "" ? $autor : "SHITA"
        );

        header("Location: " . URL . "?url=admin&guardado=frase");
        exit;
    }

    public function restablecerPassword()
    {
        $this->verificarAdministrador();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . URL . "?url=admin");
            exit;
        }

        $id_usuario = filter_input(INPUT_POST, "id_usuario", FILTER_VALIDATE_INT);
        $password = $_POST["password_nueva"] ?? "";

        if (!$id_usuario || strlen($password) < 8) {
            die("Selecciona una cuenta válida e introduce una contraseña de al menos 8 caracteres.");
        }

        if ((int) $id_usuario === (int) $_SESSION["id_usuario"]) {
            die("Para cambiar tu propia contraseña, utiliza la sección Perfil.");
        }

        $cuenta = $this->usuario->obtenerPorId($id_usuario);

        if (!$cuenta) {
            die("No se encontró esa cuenta.");
        }

        $actualizado = $this->usuario->cambiarPassword($id_usuario, $password);

        if (!$actualizado) {
            die("No se pudo restablecer la contraseña.");
        }

        header("Location: " . URL . "?url=admin&guardado=password");
        exit;
    }
}