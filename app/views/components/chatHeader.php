<div class="chat-header">

    <div class="chat-info">

        <img src="<?= URL ?>public/img/robot.png" class="chat-logo">

        <div>

            <h2>SHITA</h2>

            <p>Siempre contigo 💜</p>

            <span>● En línea</span>

        </div>

    </div>


    <div class="usuario-chat">

        <div class="avatar-usuario" style="
            width:55px;
            height:55px;
            min-width:55px;
            max-width:55px;
            min-height:55px;
            max-height:55px;
            border-radius:50%;
            overflow:hidden;
            flex-shrink:0;
        ">
            <img src="<?= URL ?>public/img/<?= htmlspecialchars($usuario["foto"] ?? "default.png") ?>"
                alt="Foto de perfil" style="
                width:55px !important;
                height:55px !important;
                min-width:55px !important;
                max-width:55px !important;
                min-height:55px !important;
                max-height:55px !important;
                object-fit:cover !important;
                border-radius:50% !important;
                display:block !important;
            ">
        </div>

        <div class="usuario-info">
            <strong><?= htmlspecialchars($usuario["nombre"]) ?></strong>
            <small>Usuario</small>
        </div>

    </div>

</div>