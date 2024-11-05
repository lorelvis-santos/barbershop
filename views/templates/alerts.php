<?php

foreach ($alerts as $key => $messages) {
    foreach ($messages as $message) { ?>
        <p class="alert <?php echo $key; ?>">
            <?php echo $message; ?>
        </p>
    <?php } 
} 