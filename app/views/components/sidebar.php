<aside class="sidebar">

    <img src="<?= URL ?>public/img/logo.png" class="logo-menu">

    <a href="<?= URL ?>?url=dashboard" class="<?= ($pagina ?? '') == 'dashboard' ? 'activo' : '' ?>">
        🏠 Inicio
    </a>


    <!-- CHAT -->

    <a href="<?= URL ?>?url=chat" class="<?= ($pagina ?? '') == 'chat' ? 'activo' : '' ?>">
        💬 Chat
    </a>

    <?php if (($pagina ?? '') == 'chat'): ?>

        <div style="
        margin: -4px 0 16px 14px;
        padding-left: 12px;
        border-left: 2px solid rgba(255,255,255,0.25);
    ">

            <a href="<?= URL ?>?url=chat/nueva" style="
                display: block;
                margin: 0 0 10px 0;
                padding: 6px 8px;
                color: rgba(255,255,255,0.82);
                background: transparent;
                font-size: 14px;
                font-weight: 500;
                text-decoration: none;
                white-space: nowrap;
                border-radius: 8px;
            ">
                ＋ Nueva conversación
            </a>


            <?php if (!empty($conversaciones)): ?>

                <div>

                    <span style="
                    display: block;
                    margin: 2px 0 4px 8px;
                    color: rgba(255,255,255,0.42);
                    font-size: 9px;
                    font-weight: 600;
                    letter-spacing: 1.4px;
                ">
                        TUS CHATS
                    </span>


                    <?php foreach ($conversaciones as $conversacion): ?>

                        <?php
                        $idChat = $conversacion["id_conversacion"];

                        $titulo = !empty($conversacion["titulo"])
                            ? $conversacion["titulo"]
                            : "Nueva conversación";

                        $titulo = mb_substr($titulo, 0, 35);

                        $activo = ($idChat == ($id_conversacion ?? 0));
                        ?>

                        <div style="
    display: flex;
    align-items: center;
    width: 100%;
">

                            <a href="<?= URL ?>?url=chat&id=<?= $idChat ?>" style="
            flex: 1;
            min-width: 0;
            padding: 6px 8px;
            border-radius: 8px;
            color: <?= $activo ? 'white' : 'rgba(255,255,255,0.68)' ?>;
            background: <?= $activo ? 'rgba(255,255,255,0.13)' : 'transparent' ?>;
            font-size: 13px;
            font-weight: <?= $activo ? '500' : '400' ?>;
            text-decoration: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        ">
                                💬 <?= htmlspecialchars($titulo) ?>
                            </a>

                            <a href="<?= URL ?>?url=chat/eliminar&id=<?= $idChat ?>"
                                onclick="return confirm('¿Seguro que quieres eliminar esta conversación?');"
                                title="Eliminar conversación" style="
            padding: 5px;
            margin-left: 3px;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-size: 12px;
            border-radius: 6px;
        ">
                                🗑️
                            </a>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        </div>

    <?php endif; ?>


    <a href="<?= URL ?>?url=recursos" class="<?= ($pagina ?? '') == 'recursos' ? 'activo' : '' ?>">
        📚 Recursos
    </a>

    <a href="<?= URL ?>?url=historial" class="<?= ($pagina ?? '') == 'historial' ? 'activo' : '' ?>">
        📜 Historial
    </a>

    <a href="<?= URL ?>?url=perfil" class="<?= ($pagina ?? '') == 'perfil' ? 'activo' : '' ?>">
        👤 Perfil
    </a>

    <?php if (isset($_SESSION["rol"]) && (int) $_SESSION["rol"] === 1): ?>

        <a href="<?= URL ?>?url=admin" class="menu-item <?= ($pagina ?? '') === 'admin' ? 'activo' : '' ?>">
            🛡️ Panel de administración
        </a>

    <?php endif; ?>

    <a href="<?= URL ?>?url=salir">
        🚪 Cerrar sesión
    </a>

</aside>