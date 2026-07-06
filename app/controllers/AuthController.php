<?php

require_once "app/core/Controller.php";

class AuthController extends Controller
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = $this->model("Usuario");
    }

    public function login()
    {
        $this->view("auth/login");
    }

    public function registro()
    {
        $this->view("auth/registro");
    }

    public function guardar()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header("Location: " . URL . "?url=registro");
            exit;
        }

        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $correo = trim($_POST["correo"]);
        $password = $_POST["password"];
        $confirmar = $_POST["confirmar"];

        if (
            empty($nombre) ||
            empty($apellido) ||
            empty($correo) ||
            empty($password) ||
            empty($confirmar)
        ) {
            die("Todos los campos son obligatorios.");
        }

        if ($password !== $confirmar) {
            die("Las contraseñas no coinciden.");
        }

        if ($this->usuario->buscarCorreo($correo)) {
            die("Ese correo ya está registrado.");
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $datos = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "correo" => $correo,
            "password" => $passwordHash,
            "id_rol" => 2
        ];

        if ($this->usuario->registrar($datos)) {

            header("Refresh:2; url=" . URL . "?url=login");

            echo "
            <h2 style='text-align:center;margin-top:80px;color:#4F46E5;'>
                ✅ Cuenta creada correctamente.
            </h2>

            <p style='text-align:center;font-size:18px;'>
                Redirigiendo al inicio de sesión...
            </p>
            ";

            exit;

        } else {

            die("Error al registrar el usuario.");

        }
    }

    public function iniciarSesion()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $correo = trim($_POST["correo"]);
        $password = $_POST["password"];

        $usuario = $this->usuario->login($correo);

        if (!$usuario) {
            die("Correo o contraseña incorrectos.");
        }

        if (!password_verify($password, $usuario["password"])) {
            die("Correo o contraseña incorrectos.");
        }

        session_start();

        $_SESSION["id_usuario"] = $usuario["id_usuario"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["id_rol"];

        header("Location: " . URL . "?url=dashboard");
        exit;
    }

    public function salir()
    {
        session_start();
        session_destroy();

        header("Location: " . URL);
        exit;
    }
}