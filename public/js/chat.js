const input = document.getElementById("mensajeInput");
const boton = document.getElementById("btnEnviar");
const chatBody = document.getElementById("chatBody");
const indicadorEscribiendo =
    document.getElementById("indicadorEscribiendo");

const idConversacion = document.body.dataset.conversacion;


function mostrarMensajeUsuario(texto) {

    const mensaje = document.createElement("div");

    mensaje.classList.add("mensaje", "usuario");

    const burbuja = document.createElement("div");

    burbuja.classList.add("burbuja");

    burbuja.textContent = texto;

    mensaje.appendChild(burbuja);

    chatBody.appendChild(mensaje);

    chatBody.scrollTop = chatBody.scrollHeight;
}


function mostrarMensajeBot(texto) {

    const mensaje = document.createElement("div");

    mensaje.classList.add("mensaje");

    const imagen = document.createElement("img");

    imagen.src = "public/img/robot.png";

    const burbuja = document.createElement("div");

    burbuja.classList.add("burbuja");

    const nombre = document.createElement("strong");

    nombre.textContent = "SHITA";

    const salto = document.createElement("br");

    burbuja.appendChild(nombre);

    burbuja.appendChild(salto);
    burbuja.appendChild(document.createElement("br"));

    const contenido = document.createElement("span");

    contenido.textContent = texto;

    burbuja.appendChild(contenido);

    mensaje.appendChild(imagen);

    mensaje.appendChild(burbuja);

    chatBody.appendChild(mensaje);

    chatBody.scrollTop = chatBody.scrollHeight;
}

function mostrarIndicador() {

    indicadorEscribiendo.style.display = "flex";

    chatBody.appendChild(indicadorEscribiendo);

    chatBody.scrollTop = chatBody.scrollHeight;
}


function ocultarIndicador() {

    indicadorEscribiendo.style.display = "none";
}


async function enviarMensaje() {

    const texto = input.value.trim();

    if (texto === "") {
        return;
    }

    boton.disabled = true;

    input.disabled = true;

    mostrarIndicador();

    try {

        const respuesta = await fetch(
            "?url=chat/enviar",
            {
                method: "POST",

                headers: {
                    "Content-Type": "application/json"
                },

                body: JSON.stringify({

                    mensaje: texto,

                    id_conversacion: idConversacion

                })
            }
        );

        const textoRespuesta = await respuesta.text();

console.log("Respuesta del servidor:", textoRespuesta);

let datos;

try {

    datos = JSON.parse(textoRespuesta);

} catch (error) {

    console.error("El servidor no devolvió JSON válido.");
    console.error(textoRespuesta);

    alert("El servidor respondió algo inesperado. Mira la consola.");

    return;
} 

        ocultarIndicador();

mostrarMensajeUsuario(datos.mensaje);

if (datos.respuestaBot) {

    mostrarMensajeBot(datos.respuestaBot);

}

        input.value = "";

    } catch (error) {

        console.error(error);

        alert("No se pudo enviar el mensaje.");

    } finally {

        ocultarIndicador();

        boton.disabled = false;

        input.disabled = false;

        input.focus();

    }
}


boton.addEventListener("click", enviarMensaje);


input.addEventListener("keydown", function (event) {

    if (event.key === "Enter") {

        event.preventDefault();

        enviarMensaje();

    }

});