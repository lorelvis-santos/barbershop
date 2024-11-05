<h1 class="page__name">Login</h1>
<p class="page__description">Inicia sesión con tus datos</p>

<?php
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form method="POST" class="form">
    <div class="field">
        <label for="email" class="field__name">Correo electrónico</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="field">
        <label for="password" class="field__name">Contraseña</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="place-right">
        <input type="submit" value="Entrar" class="button">
    </div>
</form>

<div class="actions">
    <a href="/registrar">¿Aún no tienes una cuenta? Crea una</a>
    <a href="/olvide">Olvidé mi contraseña</a>
</div>