<?php
    $currentPage = 0;
    include_once __DIR__ . "/../templates/bar.php";
?>

<h1 class="page__name">Administración</h1>
<p class="page__description">Accede, actualiza y elimina registros</p>

<nav class="navigation">
    <a href="/administracion/empleados" class="button">Empleados</a>
    <a href="/administracion/roles" class="button">Roles</a>
    <a href="/administracion/servicios" class="button">Servicios</a>
</nav>