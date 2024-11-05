<?php
    $currentPage = 0;
    include_once __DIR__ . "/../../templates/bar.php";
?>

<div class="crud-actions">
    <a href="/administracion/roles" class="crud-action button">Atrás</a>
</div>

<h1 class="page__name">Nuevo rol</h1>
<p class="page__description">Crea un nuevo rol</p>

<?php 
    include_once __DIR__ . "/../../templates/alerts.php";
?>

<form action="/administracion/roles/crear" class="form" method="POST">
    <?php 
        include_once __DIR__ . "/form.php";
    ?>

    <div class="place-right">
        <input type="submit" class="button" value="Crear">
    </div>
</form>