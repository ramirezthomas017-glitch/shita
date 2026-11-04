<div class="chat-body" id="chatBody">

    <?php foreach ($mensajes as $mensaje): ?>

        <?php if ($mensaje["emisor"] === "Bot"): ?>

            <div class="mensaje">

                <img src="<?= URL ?>public/img/robot.png">

                <div class="burbuja">

                    <strong>SHITA</strong>

                    <br><br>

                    <?= htmlspecialchars($mensaje["mensaje"]) ?>

                </div>

            </div>

        <?php else: ?>

            <div class="mensaje usuario">

                <div class="burbuja">

                    <?= htmlspecialchars($mensaje["mensaje"]) ?>

                </div>

            </div>

        <?php endif; ?>

    <?php endforeach; ?>

    <div class="mensaje escribiendo" id="indicadorEscribiendo" style="display: none;">

    <img src="<?= URL ?>public/img/robot.png">

    <div class="burbuja">

        <strong>SHITA</strong>

        <div class="puntos-escribiendo">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>

</div>

</div>