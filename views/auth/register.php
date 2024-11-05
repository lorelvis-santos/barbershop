<h1 class="page__name">Regístrate</h1>
<p class="page__description">Crea tu cuenta y accede a nuestros servicios</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form method="POST" class="form">
    <div class="field">
        <label for="name" class="field__name">Nombre</label>
        <input type="text" id="name" name="name" value="<?php echo escape_html($user->name); ?>" required>
    </div>

    <div class="field">
        <label for="lastname" class="field__name">Apellidos</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo escape_html($user->lastname); ?>" required>
    </div>

    <div class="field">
        <label for="phone" class="field__name">Teléfono</label>
        <input type="tel" id="phone" name="phone" value="<?php echo escape_html($user->phone); ?>" required>
    </div>
    
    <div class="field">
        <label for="email" class="field__name">Correo electrónico</label>
        <input type="email" id="email" name="email" value="<?php echo escape_html($user->email); ?>" required>
    </div>

    <div class="field">
        <label for="password" class="field__name">Contraseña</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div class="field">
        <label for="confirmPassword" class="field__name">Confirma tu contraseña</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
    </div>

    <div class="place-right">
        <input type="submit" value="Registrarme" class="button">
    </div>
</form>

<div class="actions">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
</div>