<?php

use Model\User;

if ($employee->id === null) { ?>
    <div class="field search-container">
    <label for="search">Busca el usuario que te interesa</label>
        <div>
            <div class="search-bar">
                <input type="text" name="search" id="search" maxlength="40" placeholder="Ingresa el nombre">
                <svg class="no-cursor-events" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>

            <ul class="search-results-container">
                <!-- <p>Lorelvis Santos</p>
                <p>Anabelis Tejada</p>
                <p>Abdiel Paredes</p>
                <p>Alan Stanley</p>
                <p>Bryant Almonte</p> -->
            </ul>
        </div>
    </div>

    <input type="hidden" name="userId" id="userId" value="<?php echo escape_html($employee->userId); ?>">
<?php } else { ?>
    <div class="field">
        <label for="name">Nombre del empleado</label>
        <input type="text" name="name" id="name" 
               value="<?php echo escape_html(User::getFullName($employee->userId)); ?>"
               disabled>
    </div>
<?php } ?>

<div class="field">
    <label for="roleId">Selecciona el rol del empleado</label>
    <select name="roleId" id="roleId" value="<?php echo escape_html($employee->roleId); ?>">
        <option disabled selected>Selecciona una opción</option>
        <?php foreach ($roles as $role) { ?>
            <option 
                <?php echo $role->id === $employee->roleId ? "selected" : ""; ?>
                value="<?php echo escape_html($role->id); ?>"><?php echo escape_html($role->name) ?></option>
        <?php } ?>
    </select>
</div>