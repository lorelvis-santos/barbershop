<h1 class="page__name">Recuperación</h1>
<p class="page__description">Reestablece tu contraseña ingresando tu correo electrónico a continuación</p>

<?php
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form method="POST" class="form">
    <div class="field">
        <label for="email" class="field__name">Correo electrónico</label>
        <input type="email" id="email" name="email" required>
    </div>

    <div class="place-right">
        <input type="submit" value="Enviar instrucciones" class="button">
    </div>
</form>

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/registrar">¿Aún no tienes una cuenta? Crea una</a>
</div>