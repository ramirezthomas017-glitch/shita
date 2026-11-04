
<div class="card-frase">

    <h2>💜 Frase del día</h2>

    <p>
        "<?= htmlspecialchars($fraseDelDia ?? 'No tienes que resolver todo hoy.', ENT_QUOTES, 'UTF-8') ?>"
    </p>

    <?php if (!empty($autorFrase)): ?>
        <small>
            <?= htmlspecialchars($autorFrase, ENT_QUOTES, 'UTF-8') ?>
        </small>
    <?php endif; ?>

</div>
