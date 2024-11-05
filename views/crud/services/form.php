<div class="field">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" value="<?php echo escape_html($service->name); ?>">
</div>

<div class="field">
    <label for="price">Precio</label>
    <input type="number" name="price" id="price" value="<?php echo escape_html($service->price); ?>">
</div>

<div class="field">
    <label for="roleId">El rol al que pertenece</label>
    <select name="roleId" id="roleId" value="<?php echo escape_html($service->roleId); ?>">
        <option disabled selected>Selecciona una opción</option>
        <?php foreach ($roles as $role) { ?>
            <option 
                <?php echo $role->id === $service->roleId ? "selected" : ""; ?>
                value="<?php echo escape_html($role->id); ?>"><?php echo escape_html($role->name) ?></option>
        <?php } ?>
    </select>
</div>