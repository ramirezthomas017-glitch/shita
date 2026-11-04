<?php
$css = "historial";
require_once "app/views/layouts/header.php";
?>

<div class="dashboard">

    <?php require_once "app/views/components/sidebar.php"; ?>

    <main class="historial-page">

        <div class="historial-header">
            <h1>📜 Historial</h1>
            <p>Tus conversaciones anteriores</p>
        </div>

        <div class="historial-lista">

            <?php if (empty($conversaciones)): ?>

                <div class="historial-vacio">
                    <h2>No tienes conversaciones todavía</h2>
                    <p>Crea una nueva conversación para empezar.</p>

                    <a href="<?= URL ?>?url=chat/nueva">
                        ＋ Nueva conversación
                    </a>
                </div>

            <?php else: ?>

                <?php foreach ($conversaciones as $conversacion): ?>

                    <?php
                    $titulo = !empty($conversacion["titulo"])
                        ? $conversacion["titulo"]
                        : "Nueva conversación";

                    $titulo = mb_substr($titulo, 0, 70);

                    $fecha = date(
                        "d/m/Y H:i",
                        strtotime($conversacion["fecha"])
                    );
                    ?>

                    <div class="historial-item">

                        <div class="historial-info">

                            <div class="historial-titulo">
                                💬 <?= htmlspecialchars($titulo) ?>
                            </div>

                            <div class="historial-fecha">
                                <?= $fecha ?>
                            </div>

                        </div>

                        <div class="historial-acciones">

                            <a
                                href="<?= URL ?>?url=chat&id=<?= $conversacion["id_conversacion"] ?>"
                                class="historial-abrir"
                            >
                                Abrir
                            </a>

                            <a
                                href="<?= URL ?>?url=chat/eliminar&id=<?= $conversacion["id_conversacion"] ?>"
                                class="historial-eliminar"
                                onclick="return confirm('¿Seguro que quieres eliminar esta conversación?');"
                            >
                                🗑️
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </main>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>