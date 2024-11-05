<?php
    $currentPage = 0;
    include_once __DIR__ . "/../../templates/bar.php";
?>

<h1 class="page__name">Actualizar servicio</h1>
<p class="page__description">Modifica un servicio ya existente</p>

<div class="crud-actions">
    <a href="/administracion/servicios" class="crud-action button">Atrás</a>
</div>

<form class="form" method="POST">
    <?php include_once __DIR__ . "/form.php"; ?>

    <div class="place-right">
        <input type="submit" class="button" value="Actualizar">
    </div>
</form>

