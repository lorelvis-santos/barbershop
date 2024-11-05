<?php 
    $currentPage = 0;
    include_once __DIR__ . "/../../templates/bar.php";
?>

<div class="crud-actions">
    <a href="/administracion/empleados" class="crud-action button">Atrás</a>
</div>

<h1 class="page__name">Nuevo empleado</h1>
<p class="page__description">Crea un nuevo empleado</p>

<?php 
    include_once __DIR__ . "/../../templates/alerts.php";
?>

<form action="/administracion/empleados/crear" class="form" method="POST">
    <?php 
        include_once __DIR__ . "/form.php";
    ?>

    <div class="place-right">
        <input type="submit" class="button" value="Crear">
    </div>
</form>