<?php
    $currentPage = 2;
    include_once __DIR__ . "/../templates/bar.php" 
?>

<h1 class="page__name">Citas por atender</h1>
<p class="page__description">Citas por atender en los siguientes días</p>

<form id="info">
    <input type="hidden" id="id" value="<?php echo escape_html($employeeId); ?>">
</form>

<div class="appointments">
</div>
