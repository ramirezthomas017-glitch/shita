<?php

$css = "dashboard";

require_once "app/views/layouts/header.php";

?>

<div class="dashboard">

    <?php require_once "app/views/components/sidebar.php"; ?>

    <main class="contenido">

        <?php require_once "app/views/components/bienvenida.php"; ?>

        <div class="emociones">

            <button>😊</button>
            <button>😌</button>
            <button>😢</button>
            <button>😰</button>
            <button>😴</button>

        </div>

        <div class="grid-dashboard">

            <?php require_once "app/views/components/tarjetaBot.php"; ?>

            <?php require_once "app/views/components/tarjetaFrase.php"; ?>

            <?php require_once "app/views/components/tarjetaActividad.php"; ?>

        </div>

    </main>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>