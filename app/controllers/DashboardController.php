<?php

require_once "app/core/Controller.php";

class DashboardController extends Controller
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {

            header("Location: " . URL . "?url=login");
            exit;

        }

        $this->view("usuario/dashboard");
    }
}