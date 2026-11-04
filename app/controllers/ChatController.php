<?php

require_once "app/core/Controller.php";
require_once "app/services/OpenAIService.php";

class ChatController extends Controller
{
    private $conversacion;
    private $mensaje;
    private $openai;
    private $memoriaUsuario;

    public function __construct()
    {
        $this->conversacion = $this->model("Conversacion");
        $this->mensaje = $this->model("Mensaje");
        $this->openai = new OpenAIService();
        $this->memoriaUsuario = $this->model("MemoriaUsuario");
    }

    public function index()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {

            header("Location: " . URL . "?url=login");
            exit;

        }

        $id_usuario = $_SESSION["id_usuario"];

        $id_conversacion = intval($_GET["id"] ?? 0);

        if ($id_conversacion > 0) {

            $conversacion = $this->conversacion->obtenerPorId(
                $id_conversacion,
                $id_usuario
            );

            if (!$conversacion) {
                header("Location: " . URL . "?url=chat");
                exit;
            }

        } else {

            $conversacion = $this->conversacion->obtenerUltima(
                $id_usuario
            );

            if (!$conversacion) {

                $id_conversacion = $this->conversacion->crear(
                    $id_usuario
                );

            } else {

                $id_conversacion = $conversacion["id_conversacion"];
            }
        }

        $mensajes = $this->mensaje->obtenerPorConversacion($id_conversacion);
        $conversaciones = $this->conversacion->obtenerPorUsuario(
            $id_usuario
        );

        foreach ($conversaciones as &$chat) {

            $chat["titulo"] = $this->mensaje->obtenerPrimerMensajeUsuario(
                $chat["id_conversacion"]
            );
        }

        unset($chat);

        $usuario = $this->model("Usuario")->obtenerPorId($id_usuario);

        $this->view("chat/chat", [
            "pagina" => "chat",
            "id_conversacion" => $id_conversacion,
            "mensajes" => $mensajes,
            "conversaciones" => $conversaciones,
            "usuario" => $usuario
        ]);


    }

    public function enviar()
    {
        session_start();

        header("Content-Type: application/json; charset=utf-8");

        if (!isset($_SESSION["id_usuario"])) {

            http_response_code(401);

            echo json_encode([
                "ok" => false,
                "mensaje" => "Sesión no válida."
            ]);

            exit;
        }

        $datos = json_decode(
            file_get_contents("php://input"),
            true
        );

        $texto = trim($datos["mensaje"] ?? "");
        $id_conversacion = intval(
            $datos["id_conversacion"] ?? 0
        );

        if ($texto === "" || $id_conversacion <= 0) {

            http_response_code(400);

            echo json_encode([
                "ok" => false,
                "mensaje" => "Mensaje inválido."
            ]);

            exit;
        }

        if (mb_strlen($texto) > 4000) {

            http_response_code(400);

            echo json_encode([
                "ok" => false,
                "mensaje" => "El mensaje es demasiado largo."
            ]);

            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        /*
        Comprobar que la conversación pertenece
        al usuario conectado.
        */

        if (
            !$this->conversacion->perteneceAUsuario(
                $id_conversacion,
                $id_usuario
            )
        ) {

            http_response_code(403);

            echo json_encode([
                "ok" => false,
                "mensaje" => "No tienes acceso a esta conversación."
            ]);

            exit;
        }

        /*
        Guardar mensaje del usuario
        */

        $guardadoUsuario = $this->mensaje->guardar([
            "id_conversacion" => $id_conversacion,
            "mensaje" => $texto,
            "emisor" => "Usuario"
        ]);

        if (!$guardadoUsuario) {

            http_response_code(500);

            echo json_encode([
                "ok" => false,
                "mensaje" => "No se pudo guardar el mensaje."
            ]);

            exit;
        }

        /*
        Pedir respuesta a SHITA
        */

        try {

            $resumen = $this->conversacion->obtenerResumen(
                $id_conversacion
            );



            $memoriaUsuario = $this->memoriaUsuario->obtener(
                $id_usuario
            );

            $memoriaActual = $this->memoriaUsuario->obtener(
                $id_usuario
            );

            $totalMensajes = $this->mensaje->contarPorConversacion(
                $id_conversacion
            );

            if ($totalMensajes > 0 && $totalMensajes % 10 === 0) {

                try {

                    $mensajesParaMemoria = $this->mensaje->obtenerUltimos(
                        $id_conversacion,
                        10
                    );

                    $nuevaMemoria = $this->openai->extraerMemoria(
                        $memoriaActual,
                        $mensajesParaMemoria
                    );

                    if (trim($nuevaMemoria) !== "") {

                        $this->memoriaUsuario->guardar(
                            $id_usuario,
                            $nuevaMemoria
                        );
                    }

                } catch (Throwable $e) {

                    error_log(
                        "Error actualizando memoria del usuario: "
                        . $e->getMessage()
                    );
                }
            }

            $historial = $this->mensaje->obtenerUltimos(
                $id_conversacion,
                12
            );

            $respuestaBot = $this->openai->responder(
                $resumen,
                $memoriaUsuario,
                $historial
            );

        } catch (Throwable $e) {

            http_response_code(500);

            echo json_encode([
                "ok" => false,
                "mensaje" => "SHITA no pudo responder en este momento."
            ]);

            exit;
        }

        /*
        Guardar respuesta de SHITA
        */

        $guardadoBot = $this->mensaje->guardar([
            "id_conversacion" => $id_conversacion,
            "mensaje" => $respuestaBot,
            "emisor" => "Bot"
        ]);

        if (!$guardadoBot) {

            http_response_code(500);

            echo json_encode([
                "ok" => false,
                "mensaje" => "La respuesta fue generada, pero no pudo guardarse."
            ]);

            exit;
        }

        $memoriaActual = $this->memoriaUsuario->obtener(
            $id_usuario
        );

        $totalMensajes = $this->mensaje->contarPorConversacion(
            $id_conversacion
        );

        if ($totalMensajes > 0 && $totalMensajes % 10 === 0) {

            try {

                $mensajesParaMemoria = $this->mensaje->obtenerUltimos(
                    $id_conversacion,
                    10
                );

                $nuevaMemoria = $this->openai->extraerMemoria(
                    $memoriaActual,
                    $mensajesParaMemoria
                );

                if (trim($nuevaMemoria) !== "") {

                    $this->memoriaUsuario->guardar(
                        $id_usuario,
                        $nuevaMemoria
                    );
                }

            } catch (Throwable $e) {

                error_log(
                    "Error actualizando memoria del usuario: "
                    . $e->getMessage()
                );
            }
        }

        $totalMensajes = $this->mensaje->contarPorConversacion(
            $id_conversacion
        );

        if ($totalMensajes > 0 && $totalMensajes % 30 === 0) {

            try {

                $mensajesParaResumen = $this->mensaje->obtenerUltimos(
                    $id_conversacion,
                    30
                );

                $nuevoResumen = $this->openai->generarResumen(
                    $resumen,
                    $mensajesParaResumen
                );

                $this->conversacion->actualizarResumen(
                    $id_conversacion,
                    $nuevoResumen
                );

            } catch (Throwable $e) {

                error_log(
                    "Error generando resumen SHITA: "
                    . $e->getMessage()
                );

            }
        }

        /*
        Enviar ambas respuestas al navegador
        */

        echo json_encode([
            "ok" => true,
            "mensaje" => $texto,
            "respuestaBot" => $respuestaBot
        ]);

        exit;
    }

    public function nueva()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $id_conversacion = $this->conversacion->crear(
            $id_usuario
        );

        header(
            "Location: " .
            URL .
            "?url=chat&id=" .
            $id_conversacion
        );

        exit;
    }

    public function eliminar()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];
        $id_conversacion = intval($_GET["id"] ?? 0);

        if ($id_conversacion <= 0) {
            header("Location: " . URL . "?url=chat");
            exit;
        }

        $conversacion = $this->conversacion->obtenerPorId(
            $id_conversacion,
            $id_usuario
        );

        if (!$conversacion) {
            header("Location: " . URL . "?url=chat");
            exit;
        }

        $this->conversacion->eliminar(
            $id_conversacion,
            $id_usuario
        );

        header("Location: " . URL . "?url=chat");
        exit;
    }

    public function historial()
    {
        session_start();

        if (!isset($_SESSION["id_usuario"])) {
            header("Location: " . URL . "?url=login");
            exit;
        }

        $id_usuario = $_SESSION["id_usuario"];

        $conversaciones = $this->conversacion->obtenerPorUsuario(
            $id_usuario
        );

        foreach ($conversaciones as &$chat) {

            $chat["titulo"] = $this->mensaje->obtenerPrimerMensajeUsuario(
                $chat["id_conversacion"]
            );
        }

        unset($chat);

        $this->view("historial/historial", [
            "pagina" => "historial",
            "conversaciones" => $conversaciones
        ]);
    }

}