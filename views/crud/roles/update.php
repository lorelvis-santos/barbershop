<?php
    $currentPage = 0;
    include_once __DIR__ . "/../../templates/bar.php";
?>

<h1 class="page__name">Actualizar rol</h1>
<p class="page__description">Modifica un rol ya existente</p>

<div class="crud-actions">
    <a href="/administracion/roles" class="crud-action button">Atrás</a>
</div>

<form class="form" method="POST">
    <?php include_once __DIR__ . "/form.php"; ?>

    <div class="place-right">
        <input type="submit" class="button" value="Actualizar">
    </div>
</form>