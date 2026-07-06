<?php

class Controller
{
    public function model($modelo)
    {
        require_once "app/models/" . $modelo . ".php";
        return new $modelo();
    }

    public function view($vista, $datos = [])
    {
        extract($datos);

        require_once "app/views/" . $vista . ".php";
    }
}