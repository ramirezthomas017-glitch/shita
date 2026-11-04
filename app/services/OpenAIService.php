<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class OpenAIService
{
    private $client;

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(
            __DIR__ . "/../../config"
        );

        $dotenv->load();

        $apiKey = $_ENV["OPENAI_API_KEY"] ?? "";

        if ($apiKey === "") {
            throw new Exception("No se encontró OPENAI_API_KEY.");
        }

        $this->client = \OpenAI::client($apiKey);
        
    }

    public function responder($resumen, $memoriaUsuario, $historial)
{
    $input = [];

    $contextoMemoria = "";

if (trim($memoriaUsuario) !== "") {
    $contextoMemoria .= "

Memoria permanente del usuario:
" . $memoriaUsuario;
}

if (trim($resumen) !== "") {
    $contextoMemoria .= "

Resumen de esta conversación:
" . $resumen;
}

    foreach ($historial as $mensaje) {

        $rol = $mensaje["emisor"] === "Bot"
            ? "assistant"
            : "user";

        $input[] = [
            "role" => $rol,
            "content" => $mensaje["mensaje"]
        ];
    }

    $respuesta = $this->client->responses()->create([
        "model" => "gpt-4o",

        "instructions" => "
    Eres SHITA, un asistente virtual diseñado para acompañar
    a los usuarios de manera amable, empática y respetuosa.

    Habla de forma natural y cercana.

    No afirmes ser una persona real.

    No afirmes ser psicólogo, médico ni profesional de la salud.

    Mantén tus respuestas claras y no excesivamente largas.

    Utiliza el contexto de la conversación para responder
    de forma coherente y recordar lo que el usuario acaba
    de decir.

    Si el usuario simplemente quiere conversar, conversa
    naturalmente con él.
    
    " . $contextoMemoria,

        "input" => $input
    ]);

    return $respuesta->outputText;
}

public function generarResumen($resumenActual, $mensajes)
{
    $conversacion = "";

    if ($resumenActual !== "") {

        $conversacion .= "Resumen anterior:\n";
        $conversacion .= $resumenActual;
        $conversacion .= "\n\n";

    }

    $conversacion .= "Mensajes recientes:\n";

    foreach ($mensajes as $mensaje) {

        $emisor = $mensaje["emisor"] === "Bot"
            ? "SHITA"
            : "Usuario";

        $conversacion .= $emisor . ": ";
        $conversacion .= $mensaje["mensaje"];
        $conversacion .= "\n";
    }

    $respuesta = $this->client->responses()->create([

        "model" => "gpt-4o",

        "instructions" => "
            Crea un resumen breve y útil de esta conversación
            para que SHITA pueda recordar el contexto posteriormente.

            Conserva únicamente información relevante para
            comprender la conversación y responder de forma coherente.

            No inventes información.

            No hagas comentarios sobre el resumen.

            Devuelve únicamente el resumen.
        ",

        "input" => $conversacion
    ]);

    return trim($respuesta->outputText);
}

public function extraerMemoria($memoriaActual, $mensajes)
{
    $conversacion = "";

    if (trim($memoriaActual) !== "") {
        $conversacion .= "Memoria actual del usuario:\n";
        $conversacion .= $memoriaActual;
        $conversacion .= "\n\n";
    }

    $conversacion .= "Mensajes recientes:\n";

    foreach ($mensajes as $mensaje) {

        if ($mensaje["emisor"] !== "Usuario") {
            continue;
        }

        $conversacion .= "Usuario: ";
        $conversacion .= $mensaje["mensaje"];
        $conversacion .= "\n";
    }

    $respuesta = $this->client->responses()->create([
        "model" => "gpt-4o",

        "instructions" => "
            Analiza la información proporcionada y actualiza la
            memoria permanente del usuario.

            Conserva únicamente información personal o preferencias
            que puedan ser útiles para futuras conversaciones.

            No guardes conversaciones triviales, estados pasajeros,
            preguntas aisladas ni información irrelevante.

            No inventes información.

            Si ya existe una memoria, conserva la información útil
            y agrega únicamente información nueva y relevante.

            Devuelve únicamente la memoria actualizada.

            Mantén el resultado breve y organizado.
        ",

        "input" => $conversacion
    ]);

    return trim($respuesta->outputText);
}

}