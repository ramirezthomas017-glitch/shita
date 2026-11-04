
<?php

$css = "dashboard";

require_once "app/views/layouts/header.php";

$nombreUsuario = $_SESSION["nombre"] ?? "amigo";

?>

<div class="dashboard">

    <?php require_once "app/views/components/sidebar.php"; ?>

    <main class="contenido">

        <!-- BIENVENIDA Y ROBOT ANIMADO -->
        <section class="bienvenida">

            <div class="texto-bienvenida">
                <h1>
                    Hola, <?= htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8') ?>
                    <span class="saludo-mano">👋</span>
                </h1>

                <p>¿Cómo te sientes hoy?</p>
            </div>

            <div class="robot-escena" aria-label="Robot amigable de SHITA" role="img">

                <div class="robot-aura"></div>
                <span class="robot-destello destello-uno">✦</span>
                <span class="robot-destello destello-dos">✧</span>
                <span class="robot-corazon">♡</span>

                <div class="robot-antena">
                    <span></span>
                </div>

                <div class="robot-cabeza">
                    <div class="robot-oreja oreja-izquierda"></div>
                    <div class="robot-oreja oreja-derecha"></div>

                    <div class="robot-ojos">
                        <span class="robot-ojo"></span>
                        <span class="robot-ojo"></span>
                    </div>

                    <div class="robot-mejillas">
                        <span></span>
                        <span></span>
                    </div>

                    <div class="robot-sonrisa"></div>
                </div>

                <div class="robot-cuello"></div>

                <div class="robot-cuerpo">
                    <div class="robot-emblema">♡</div>
                </div>

                <div class="robot-sombra"></div>

                <div class="robot-mensaje robot-mensaje-arriba">
                    <span class="mensaje-icono">☀️</span>
                    <div>
                        <strong>Respira.</strong>
                        <small>No tienes que resolverlo todo hoy.</small>
                    </div>
                </div>

                <div class="robot-mensaje robot-mensaje-abajo">
                    <span class="mensaje-icono mensaje-emocion">😌</span>
                    <div>
                        <strong>¿Cómo te sientes?</strong>
                        <small>Todo lo que sientes merece espacio.</small>
                    </div>
                </div>

            </div>

        </section>

        <!-- SELECTOR DE EMOCIONES -->
        <div class="emociones">

            <?php
            $iconosEmociones = [
                "feliz" => "😊",
                "tranquilo" => "😌",
                "ansioso" => "😰",
                "estresado" => "😨",
                "cansado" => "😴"
            ];
            ?>

            <?php foreach ($catalogoEmociones as $emocion): ?>

                <?php
                $nombre = $emocion["nombre"];

                $clave = function_exists("mb_strtolower")
                    ? mb_strtolower($nombre, "UTF-8")
                    : strtolower($nombre);

                $icono = $iconosEmociones[$clave] ?? "💜";
                ?>

                <div class="emocion-form">

                    <form action="<?= URL ?>?url=emociones/registrar" method="POST">

                        <input
                            type="hidden"
                            name="id_emocion"
                            value="<?= (int) $emocion["id_emocion"] ?>"
                        >

                        <button
                            type="submit"
                            class="emocion-boton"
                            aria-label="<?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>"
                        >
                            <span class="emocion-emoji"><?= $icono ?></span>
                        </button>

                    </form>

                    <span class="emocion-nombre">
                        <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>
                    </span>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- MENSAJES DE REGISTRO -->
        <?php if (($_GET["emocion"] ?? "") === "ok"): ?>

            <p class="emocion-mensaje">
                💜 Tu emoción quedó registrada.
            </p>

        <?php elseif (($_GET["emocion"] ?? "") === "error"): ?>

            <p class="emocion-mensaje">
                No se pudo registrar la emoción. Inténtalo de nuevo.
            </p>

        <?php endif; ?>

        <!-- TARJETAS DEL DASHBOARD -->
        <div class="grid-dashboard">

            <?php require_once "app/views/components/tarjetaBot.php"; ?>

            <?php require_once "app/views/components/tarjetaFrase.php"; ?>

            <?php require_once "app/views/components/tarjetaActividad.php"; ?>

        </div>

    </main>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>