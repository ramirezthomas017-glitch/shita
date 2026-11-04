<?php require_once "app/views/layouts/header.php"; ?>

<div class="contenedor">

    <div class="card">

        <img
            src="<?= URL ?>public/img/logo.png"
            class="logo">

        <p>Bienvenido de nuevo 💜</p>

        <body class="auth-page">

        <form
            action="<?= URL ?>?url=iniciarSesion"
            method="POST">

            <input
                type="email"
                name="correo"
                placeholder="Correo"
                required>

            <input
                type="password"
                name="password"
                placeholder="Contraseña"
                required>

            <button type="submit">

                Iniciar sesión

            </button>

        </form>

        <p>

            ¿No tienes cuenta?

            <a href="<?= URL ?>?url=registro">

                Regístrate

            </a>

        </p>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>
