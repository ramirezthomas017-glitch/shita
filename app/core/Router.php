<?php

class Router
{
    public function cargar()
    {
        if (isset($_GET["url"])) {
            $url = strtolower($_GET["url"]);
        } else {
            $url = "home";
        }

        switch ($url) {
            case "guardarusuario":

                require_once "app/controllers/AuthController.php";

                $controller = new AuthController();

                $controller->guardar();

                break;

            case "chat/enviar":

                require_once "app/controllers/ChatController.php";

                $controller = new ChatController();

                $controller->enviar();

                break;

            case "login":

                require_once "app/controllers/AuthController.php";

                $controller = new AuthController();

                $controller->login();

                break;

            case "registro":

                require_once "app/controllers/AuthController.php";

                $controller = new AuthController();

                $controller->registro();

                break;

            case "iniciarsesion":

                require_once "app/controllers/AuthController.php";

                $controller = new AuthController();

                $controller->iniciarSesion();

                break;

            case "dashboard":

                require_once "app/controllers/DashboardController.php";

                $controller = new DashboardController();

                $controller->index();

                break;

            case "chat":

                require_once "app/controllers/ChatController.php";

                $controller = new ChatController();

                $controller->index();

                break;

            case "chat/nueva":
                require_once "app/controllers/ChatController.php";
                $controller = new ChatController();
                $controller->nueva();
                break;

            case "chat/eliminar":
                require_once "app/controllers/ChatController.php";
                $controller = new ChatController();
                $controller->eliminar();
                break;

            case "historial":
                require_once "app/controllers/ChatController.php";
                $controller = new ChatController();
                $controller->historial();
                break;

            case "perfil":

                require_once "app/controllers/PerfilController.php";

                $controller = new PerfilController();

                $controller->index();

                break;

            case "perfil/eliminar":

                require_once "app/controllers/PerfilController.php";

                $controller = new PerfilController();

                $controller->eliminarCuenta();

                break;

            case "perfil/actualizar":

                require_once "app/controllers/PerfilController.php";

                $controller = new PerfilController();

                $controller->actualizar();

                break;

            case "perfil/password":

                require_once "app/controllers/PerfilController.php";

                $controller = new PerfilController();

                $controller->cambiarPassword();

                break;

            case "perfil/foto":

                require_once "app/controllers/PerfilController.php";

                $controller = new PerfilController();

                $controller->actualizarFoto();

                break;

            case "admin":

                require_once "app/controllers/AdminController.php";

                $controller = new AdminController();

                $controller->index();

                break;

            case "admin/frase":

                require_once "app/controllers/AdminController.php";

                $controller = new AdminController();
                $controller->guardarFrase();

                break;

            case "admin/password":

                require_once "app/controllers/AdminController.php";

                $controller = new AdminController();
                $controller->restablecerPassword();

                break;


            case "recursos":
                require_once "app/controllers/RecursosController.php";
                $controller = new RecursosController();
                $controller->index();
                break;


            case "emociones/registrar":
                require_once "app/controllers/EmocionesController.php";
                $controller = new EmocionesController();
                $controller->registrar();
                break;



            default:

                require_once "app/controllers/HomeController.php";

                $controller = new HomeController();

                $controller->index();

        }

    }


}