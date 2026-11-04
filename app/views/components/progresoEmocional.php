
<div class="card-progreso">

    <h2>💜 Progreso emocional</h2>

    <?php if (empty($ultimasEmociones)): ?>

        <div class="sin-progreso">
            <div class="icono">📊</div>

            <h3>Aún no hay progreso emocional</h3>

            <p>
                Registra cómo te sientes para comenzar a ver
                tu evolución emocional.
            </p>
        </div>

    <?php else: ?>

        <div class="progreso-resumen">
            <strong>
                <?= (int) $totalRegistrosEmocionales ?>
            </strong>
            <span>registros emocionales</span>
        </div>

        <div class="progreso-frecuencias">

            <?php foreach ($progresoEmocional as $item): ?>

                <?php if ((int) $item["cantidad"] > 0): ?>

                    <div class="progreso-fila">

                        <div class="progreso-etiqueta">
                            <span>
                                <?= htmlspecialchars($item["nombre"], ENT_QUOTES, 'UTF-8') ?>
                            </span>

                            <strong>
                                <?= (int) $item["cantidad"] ?>
                            </strong>
                        </div>

                        <div class="progreso-barra">
                            <div
                                class="progreso-barra-valor"
                                style="width: <?= round(
                                    ((int) $item["cantidad"] / max(1, (int) $totalRegistrosEmocionales)) * 100
                                ) ?>%; background: <?= htmlspecialchars($item["color"] ?: "#8B8CF6", ENT_QUOTES, 'UTF-8') ?>;"
                            ></div>
                        </div>

                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

        <h3 class="progreso-subtitulo">Registros recientes</h3>

        <div class="progreso-recientes">

            <?php foreach ($ultimasEmociones as $item): ?>

                <div class="progreso-reciente">
                    <span>
                        <?= htmlspecialchars($item["nombre"], ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <small>
                        <?= date(
                            "d/m/Y H:i",
                            strtotime($item["fecha_registro"])
                        ) ?>
                    </small>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>
