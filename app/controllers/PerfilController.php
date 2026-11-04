<?php

require_once "app/core/Controller.php";

class PerfilController extends Controller
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = $this->model("Usuario");
    }

    // Mostrar perfil
    public function index()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $usuario = $this->usuario->obtenerPorId($id_usuario);

        $this->view("perfil/perfil", [
            "pagina" => "perfil",
            "usuario" => $usuario
        ]);
    }


    // Actualizar nombre, apellido y correo
    public function actualizar()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . URL . "?url=perfil");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $nombre = trim($_POST["nombre"] ?? "");
        $apellido = trim($_POST["apellido"] ?? "");
        $correo = trim($_POST["correo"] ?? "");

        if (
            $nombre === "" ||
            $apellido === "" ||
            $correo === ""
        ) {
            die("Todos los campos son obligatorios.");
        }

        $usuarioExistente = $this->usuario->buscarCorreo($correo);

        if (
            $usuarioExistente &&
            $usuarioExistente["id_usuario"] != $id_usuario
        ) {
            die("Ese correo ya está siendo utilizado.");
        }

        $actualizado = $this->usuario->actualizarPerfil(
            $id_usuario,
            $nombre,
            $apellido,
            $correo
        );

        if ($actualizado) {

            $_SESSION["nombre"] = $nombre;

            header("Location: " . URL . "?url=perfil");
            exit;
        }

        die("No se pudieron actualizar los datos.");
    }


    // Cambiar contraseña
    public function cambiarPassword()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . URL . "?url=perfil");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $passwordActual = $_POST["password_actual"] ?? "";
        $passwordNueva = $_POST["password_nueva"] ?? "";
        $confirmar = $_POST["confirmar_password"] ?? "";

        if (
            $passwordActual === "" ||
            $passwordNueva === "" ||
            $confirmar === ""
        ) {
            die("Todos los campos de contraseña son obligatorios.");
        }

        $usuario = $this->usuario->obtenerPorId($id_usuario);

        if (!$usuario) {
            die("Usuario no encontrado.");
        }

        if (!password_verify($passwordActual, $usuario["password"])) {
            die("La contraseña actual es incorrecta.");
        }

        if ($passwordNueva !== $confirmar) {
            die("Las nuevas contraseñas no coinciden.");
        }

        if (strlen($passwordNueva) < 6) {
            die("La nueva contraseña debe tener al menos 6 caracteres.");
        }

        $cambiado = $this->usuario->cambiarPassword(
            $id_usuario,
            $passwordNueva
        );

        if ($cambiado) {
            header("Location: " . URL . "?url=perfil");
            exit;
        }

        die("No se pudo cambiar la contraseña.");
    }

    // Actualizar foto de perfil
    public function actualizarFoto()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: " . URL . "?url=perfil");
            exit;
        }

        if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
            header("Location: " . URL . "?url=perfil");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $archivo = $_FILES["foto"];

        $extension = strtolower(
            pathinfo($archivo["name"], PATHINFO_EXTENSION)
        );

        $extensionesPermitidas = [
            "jpg",
            "jpeg",
            "png",
            "webp"
        ];

        if (!in_array($extension, $extensionesPermitidas)) {
            die("Formato de imagen no permitido.");
        }

        if ($archivo["size"] > 5 * 1024 * 1024) {
            die("La imagen no puede superar los 5 MB.");
        }

        $nombreArchivo = "usuario_" . $id_usuario . "_" . time() . "." . $extension;

        $ruta = "public/img/usuarios/" . $nombreArchivo;

        if (!move_uploaded_file($archivo["tmp_name"], $ruta)) {
            die("No se pudo guardar la imagen.");
        }

        $actualizado = $this->usuario->actualizarFoto(
            $id_usuario,
            "usuarios/" . $nombreArchivo
        );

        if ($actualizado) {
            header("Location: " . URL . "?url=perfil");
            exit;
        }

        die("No se pudo actualizar la foto.");
    }


    // Eliminar cuenta
    public function eliminarCuenta()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $eliminado = $this->usuario->eliminarCuenta($id_usuario);

        if ($eliminado) {

            session_unset();
            session_destroy();

            header("Location: " . URL . "?url=login");
            exit;
        }

        die("No se pudo eliminar la cuenta.");
    }
}