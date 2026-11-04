<?php
$css = "recursos";
require_once "app/views/layouts/header.php";
?>

<div class="dashboard">

    <?php require_once "app/views/components/sidebar.php"; ?>

    <main class="recursos-page">

        <header class="recursos-header">
            <span class="recursos-etiqueta">TU ESPACIO PERSONAL</span>
            <h1>📚 Recursos emocionales</h1>
            <p>
                Herramientas para conocerte mejor, cuidar de ti
                y comprender lo que sientes.
            </p>
        </header>

        <section class="recursos-destacado">
            <div>
                <span>💜 UN MOMENTO PARA TI</span>
                <h2>No tienes que tener todo resuelto hoy</h2>
                <p>
                    Dedicar unos minutos a reconocer tus emociones
                    también es una forma de cuidarte.
                </p>
            </div>
        </section>

        <section class="recursos-seccion">
            <h2>Explora los recursos</h2>
            <p class="recursos-subtitulo">
                Elige el tema que más necesites en este momento.
            </p>

            <div class="recursos-grid">

                <article class="recurso-card">
                    <div class="recurso-icono">🌬️</div>
                    <h3>Respiración y calma</h3>
                    <p>
                        Tómate una pausa y practica una respiración
                        tranquila cuando necesites relajarte.
                    </p>

                    <details>
                        <summary>Ver ejercicio</summary>
                        <div class="recurso-contenido">
                            <ol>
                                <li>Busca una posición cómoda.</li>
                                <li>Inhala suavemente durante 4 segundos.</li>
                                <li>Exhala despacio durante 6 segundos.</li>
                                <li>Repite unas cuantas veces sin forzar la respiración.</li>
                            </ol>
                            <p>
                                Si te mareas o sientes incomodidad,
                                vuelve a respirar con normalidad.
                            </p>
                        </div>
                    </details>
                </article>

                <article class="recurso-card">
                    <div class="recurso-icono">📝</div>
                    <h3>Autoconocimiento</h3>
                    <p>
                        Dedica unos minutos a poner en palabras
                        lo que estás viviendo.
                    </p>

                    <details>
                        <summary>Ver actividad</summary>
                        <div class="recurso-contenido">
                            <p>Reflexiona sobre estas preguntas:</p>
                            <ul>
                                <li>¿Qué emoción siento ahora?</li>
                                <li>¿Qué pudo haberla provocado?</li>
                                <li>¿Qué necesito en este momento?</li>
                                <li>¿Qué pequeño paso puedo dar hoy?</li>
                            </ul>
                        </div>
                    </details>
                </article>

                <article class="recurso-card">
                    <div class="recurso-icono">💙</div>
                    <h3>Manejo de emociones</h3>
                    <p>
                        Aprende a reconocer lo que sientes
                        sin juzgarte por ello.
                    </p>

                    <details>
                        <summary>Ver consejos</summary>
                        <div class="recurso-contenido">
                            <ul>
                                <li>Ponle un nombre a la emoción.</li>
                                <li>Identifica qué situación la acompaña.</li>
                                <li>Date tiempo antes de reaccionar.</li>
                                <li>Habla con alguien de confianza si lo necesitas.</li>
                            </ul>
                        </div>
                    </details>
                </article>

                <article class="recurso-card">
                    <div class="recurso-icono">🌱</div>
                    <h3>Hábitos de bienestar</h3>
                    <p>
                        Pequeñas actividades cotidianas también
                        pueden ayudarte a sentirte mejor.
                    </p>

                    <details>
                        <summary>Ver recomendaciones</summary>
                        <div class="recurso-contenido">
                            <ul>
                                <li>Procura mantener horarios de sueño regulares.</li>
                                <li>Haz pausas durante tus actividades.</li>
                                <li>Dedica tiempo a algo que disfrutes.</li>
                                <li>Mantén contacto con personas de confianza.</li>
                            </ul>
                        </div>
                    </details>
                </article>

            </div>
        </section>

        <section class="recursos-ayuda">
            <h2>Recuerda 💜</h2>
            <p>
                No tienes que gestionar todo por tu cuenta.
                Hablar con alguien de confianza o buscar apoyo
                profesional también es una forma de cuidarte.
            </p>
        </section>

    </main>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>