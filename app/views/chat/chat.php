<?php

$css = "chat";

require_once "app/views/layouts/header.php";

?>

<script>
    document.body.dataset.conversacion = "<?= $id_conversacion ?>";
</script>

<div class="dashboard">

    <?php require_once "app/views/components/sidebar.php"; ?>

    <div class="chat-page">

        <?php require_once "app/views/components/chatHeader.php"; ?>

        <?php require_once "app/views/components/chatMensajes.php"; ?>

        <?php require_once "app/views/components/chatInput.php"; ?>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>

<script src="<?= URL ?>public/js/chat.js"></script>