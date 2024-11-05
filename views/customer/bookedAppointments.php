<?php
    $currentPage = 0;
    include_once __DIR__ . "/../templates/bar.php" 
?>

<h1 class="page__name">Mis citas</h1>
<p class="page__description">¡Aquí puedes ver las citas que has agendado!</p>

<form id="info">
    <input type="hidden" id="id" value="<?php echo escape_html($id); ?>">
</form>

<div class="appointments">
</div>