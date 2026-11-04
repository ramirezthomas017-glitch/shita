<?php
$css = "perfil";
require_once "app/views/layouts/header.php";
?>

<div class="dashboard">

    <?php require_once "app/views/components/sidebar.php"; ?>

    <main class="perfil-page">

        <div class="perfil-header">
            <h1>Mi perfil</h1>
            <p>Administra tu información personal y tu cuenta.</p>
        </div>


        <!-- INFORMACIÓN PERSONAL -->

        <section class="perfil-card">

            <div class="perfil-card-header">
                <div>
                    <h2>Información personal</h2>
                    <p>Actualiza tus datos básicos.</p>
                </div>
            </div>


            <div class="perfil-foto">

                <img src="<?= URL ?>public/img/<?= htmlspecialchars($usuario["foto"] ?? "default.png") ?>"
                    alt="Foto de perfil">

                <div>

                    <h3>
                        <?= htmlspecialchars($usuario["nombre"]) ?>
                        <?= htmlspecialchars($usuario["apellido"]) ?>
                    </h3>

                    <span>
                        <?= htmlspecialchars($usuario["correo"]) ?>
                    </span>

                    <form action="<?= URL ?>?url=perfil/foto" method="POST" enctype="multipart/form-data"
                        class="foto-form">

                        <label for="foto">
                            Cambiar foto
                        </label>

                        <input type="file" id="foto" name="foto" accept="image/png,image/jpeg,image/webp" required>

                        <button type="submit">
                            Subir foto
                        </button>

                    </form>

                </div>

            </div>


            <form action="<?= URL ?>?url=perfil/actualizar" method="POST" class="perfil-form">

                <div class="campo-grupo">

                    <div class="campo">
                        <label>Nombre</label>

                        <input type="text" name="nombre" value="<?= htmlspecialchars($usuario["nombre"]) ?>" required>
                    </div>


                    <div class="campo">
                        <label>Apellido</label>

                        <input type="text" name="apellido" value="<?= htmlspecialchars($usuario["apellido"]) ?>"
                            required>
                    </div>

                </div>


                <div class="campo">

                    <label>Correo electrónico</label>

                    <input type="email" name="correo" value="<?= htmlspecialchars($usuario["correo"]) ?>" required>

                </div>


                <button type="submit" class="btn-principal">
                    Guardar cambios
                </button>

            </form>

        </section>



        <!-- SEGURIDAD -->

        <section class="perfil-card">

            <div class="perfil-card-header">

                <div>
                    <h2>Seguridad</h2>
                    <p>Cambia la contraseña de tu cuenta.</p>
                </div>

            </div>


            <form action="<?= URL ?>?url=perfil/password" method="POST" class="perfil-form">

                <div class="campo">

                    <label>Contraseña actual</label>

                    <input type="password" name="password_actual" required>

                </div>


                <div class="campo-grupo">

                    <div class="campo">

                        <label>Nueva contraseña</label>

                        <input type="password" name="password_nueva" minlength="6" required>

                    </div>


                    <div class="campo">

                        <label>Confirmar contraseña</label>

                        <input type="password" name="confirmar_password" minlength="6" required>

                    </div>

                </div>


                <button type="submit" class="btn-principal">
                    Cambiar contraseña
                </button>

            </form>

        </section>



        <!-- PLAN -->

        <section class="perfil-card">

            <div class="perfil-card-header">

                <div>
                    <h2>Mi plan</h2>
                    <p>Gestiona tu suscripción de SHITA.</p>
                </div>

            </div>


            <div class="plan-actual">

                <div>

                    <span class="plan-label">
                        PLAN ACTUAL
                    </span>

                    <h3>Plan gratuito</h3>

                    <p>
                        Acceso básico a las funciones de SHITA.
                    </p>

                </div>


                <button type="button" class="btn-secundario" disabled>
                    Próximamente
                </button>

            </div>

        </section>



        <!-- ZONA PELIGROSA -->

        <section class="perfil-card peligro">

            <div class="perfil-card-header">

                <div>
                    <h2>Zona peligrosa</h2>

                    <p>
                        Esta acción eliminará permanentemente tu cuenta
                        y tus datos asociados.
                    </p>

                </div>

            </div>


            <a href="<?= URL ?>?url=perfil/eliminar" class="btn-eliminar" onclick="return confirm(
                    '¿Seguro que quieres eliminar tu cuenta? Esta acción no se puede deshacer.'
                );">
                🗑️ Eliminar mi cuenta
            </a>

        </section>

    </main>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>