<?php

class Database
{
    private $host = "localhost";
    private $dbname = "shita";
    private $username = "root";
    private $password = "";
    private $charset = "utf8mb4";

    public function conectar()
    {
        try {

            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

            $conexion = new PDO(
                $dsn,
                $this->username,
                $this->password
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }
    }
}