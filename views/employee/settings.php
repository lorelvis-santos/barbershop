<?php
    $currentPage = 1;
    include_once __DIR__ . "/../templates/bar.php" 
?>

<h1 class="page__name">Ajustes</h1>
<p class="page__description">Configura tu perfil y preferencias</p>

<form id="info">
    <input type="hidden" id="id" value="<?php echo escape_html($employeeId); ?>">
</form>
