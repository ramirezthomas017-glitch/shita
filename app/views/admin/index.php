<?php
$css = "admin";
require_once "app/views/layouts/header.php";
?>

<div class="admin-page">

    <header class="admin-header">
        <div>
            <h1>Panel de administración</h1>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION["nombre"] ?? "Administrador") ?></p>
        </div>

        <a href="<?= URL ?>?url=dashboard">Volver a SHITA</a>
    </header>

    <section class="admin-card">
        <h2>Personalizar SHITA</h2>
        <p>Modifica la frase que se mostrará como frase del día.</p>

        <form action="<?= URL ?>?url=admin/frase" method="POST">

            <label for="frase">Frase del día</label>
            <textarea id="frase" name="frase" maxlength="1000" required><?= htmlspecialchars($frase ?? "") ?></textarea>

            <label for="autor">Autor</label>
            <input type="text" id="autor" name="autor" maxlength="150"
                value="<?= htmlspecialchars($autorFrase ?? "") ?>">

            <button type="submit">Guardar cambios</button>

        </form>
    </section>

    <section class="admin-card">
        <h2>Usuarios registrados</h2>

        <p class="admin-total">
            Total de usuarios: <?= count($usuarios) ?>
        </p>

        <div class="admin-tabla">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Registro</th>
                        <th>Restablecer contraseña</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= (int) $u["id_usuario"] ?></td>

                            <td>
                                <?= htmlspecialchars(
                                    $u["nombre"] . " " . $u["apellido"]
                                ) ?>
                            </td>

                            <td><?= htmlspecialchars($u["correo"]) ?></td>

                            <td><?= htmlspecialchars($u["nombre_rol"]) ?></td>

                            <td><?= htmlspecialchars($u["estado"] ?? "Sin estado") ?></td>

                            <td><?= htmlspecialchars($u["fecha_registro"] ?? "") ?></td>

                            <td>
                                <?php if ((int) $u["id_usuario"] !== (int) $_SESSION["id_usuario"]): ?>

                                    <form action="<?= URL ?>?url=admin/password" method="POST"
                                        onsubmit="return confirm('¿Confirmas el restablecimiento de esta contraseña?');">
                                        <input type="hidden" name="id_usuario" value="<?= (int) $u["id_usuario"] ?>">

                                        <input type="password" name="password_nueva" placeholder="Nueva contraseña"
                                            minlength="8" required>

                                        <button type="submit">Restablecer</button>
                                    </form>

                                <?php else: ?>
                                    Tu cuenta
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($usuarios)): ?>
                        <tr>
                            <td colspan="7">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?php require_once "app/views/layouts/footer.php"; ?>