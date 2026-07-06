<?php require_once "app/views/layouts/header.php"; ?>

<div class="contenedor">

    <div class="card">
    <img
        src="<?= URL ?>public/img/logo.png"
        class="logo">

    <p>Tu bienestar importa </p>
    <p>Crea tu cuenta para comenzar. </p>

        <form action="<?= URL ?>?url=guardarUsuario" method="POST">

            <input
                type="text"
                name="nombre"
                placeholder="Nombre"
                required>

            <input
                type="text"
                name="apellido"
                placeholder="Apellido"
                required>

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

            <input
                type="password"
                name="confirmar"
                placeholder="Confirmar contraseña"
                required>

            <button type="submit">

                Registrarme

            </button>

        </form>

        <p>

            ¿Ya tienes cuenta?

            <a href="<?= URL ?>?url=login">

                Inicia sesión

            </a>

        </p>

    </div>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>