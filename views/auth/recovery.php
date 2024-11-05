<h1 class="page__name">Reestablecer contraseña</h1>
<p class="page__description">Establece tu nueva contraseña a continuación</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";

    if ($error)
        return;
?>
    <form method="POST" class="form">
    <div class="field">
        <label for="password" class="field__name">Nueva contraseña</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div class="field">
        <label for="confirmPassword" class="field__name">Confirma tu nueva contraseña</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
    </div>

    <div class="place-right">
        <input type="submit" value="Reestablecer" class="button">
    </div>
</form> 

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/registrar">¿Aún no tienes una cuenta? Crea una</a>
</div>