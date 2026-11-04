
<div class="card-actividad">

    <h2>📊 Tu actividad</h2>

    <p>Conversaciones</p>

    <h1><?= (int) $totalConversaciones ?></h1>

    <hr>

    <p>Emoción más registrada</p>

    <strong>
        <?php if (!empty($emocionFrecuente)): ?>
            <?= htmlspecialchars(
                $emocionFrecuente["nombre"],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
            (<?= (int) $emocionFrecuente["cantidad"] ?>)
        <?php else: ?>
            Sin registros
        <?php endif; ?>
    </strong>

</div>
