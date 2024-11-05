<?php
    $currentPage = 0;
    include_once __DIR__ . "/../../templates/bar.php";
?>

<div class="crud-actions">
    <a href="/administracion/servicios" class="crud-action button">Atrás</a>
</div>

<h1 class="page__name">Nuevo servicio</h1>
<p class="page__description">Añade un servicio a un rol existente</p>

<?php 
    include_once __DIR__ . "/../../templates/alerts.php";
?>

<form action="/administracion/servicios/crear" class="form" method="POST">
    <?php 
        include_once __DIR__ . "/form.php";
    ?>

    <div class="place-right">
        <input type="submit" class="button" value="Crear">
    </div>
</form>