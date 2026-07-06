<?php

class Router
{
    public function cargar()
    {
        if(isset($_GET["url"]))
        {
            $url = strtolower($_GET["url"]);
        }
        else
        {
            $url = "home";
        }

        switch($url)
        {
            case "guardarusuario":

                require_once "app/controllers/AuthController.php";

                $controller = new AuthController();

                $controller->guardar();

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

            default:

                require_once "app/controllers/HomeController.php";

                $controller = new HomeController();

                $controller->index();

        }

    }
}