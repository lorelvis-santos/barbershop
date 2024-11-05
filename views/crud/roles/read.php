<?php
    $currentPage = 0;
    include_once __DIR__ . "/../../templates/bar.php";
?>

<h1 class="page__name">Roles</h1>
<p class="page__description">Administra los roles existentes</p>

<?php 
    include_once __DIR__ . "/../../templates/bar.php";
?>

<div class="crud-actions">
    <a href="/administracion/roles/crear" class="crud-action button">Nuevo rol</a>
</div>

<div class="table-container table-roles">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role) { ?>
                <tr data-id="<?php echo escape_html($role->id); ?>">
                    <td><?php echo escape_html($role->id); ?></td>
                    <td><?php echo escape_html($role->name); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Menú emergente con opciones -->
<div class="menu-popup" id="menuPopup">
    <button onclick="updateItem('roles')">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8477 1.87868C19.6761 0.707109 17.7766 0.707105 16.605 1.87868L2.44744 16.0363C2.02864 16.4551 1.74317 16.9885 1.62702 17.5692L1.03995 20.5046C0.760062 21.904 1.9939 23.1379 3.39334 22.858L6.32868 22.2709C6.90945 22.1548 7.44285 21.8693 7.86165 21.4505L22.0192 7.29289C23.1908 6.12132 23.1908 4.22183 22.0192 3.05025L20.8477 1.87868ZM18.0192 3.29289C18.4098 2.90237 19.0429 2.90237 19.4335 3.29289L20.605 4.46447C20.9956 4.85499 20.9956 5.48815 20.605 5.87868L17.9334 8.55027L15.3477 5.96448L18.0192 3.29289ZM13.9334 7.3787L3.86165 17.4505C3.72205 17.5901 3.6269 17.7679 3.58818 17.9615L3.00111 20.8968L5.93645 20.3097C6.13004 20.271 6.30784 20.1759 6.44744 20.0363L16.5192 9.96448L13.9334 7.3787Z" fill="#076493"></path> </g></svg>
        <p>Actualizar</p>
    </button>
    
    <button onclick="deleteItem('roles')">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 6H20L18.4199 20.2209C18.3074 21.2337 17.4512 22 16.4321 22H7.56786C6.54876 22 5.69264 21.2337 5.5801 20.2209L4 6Z" stroke="#CB0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M7.34491 3.14716C7.67506 2.44685 8.37973 2 9.15396 2H14.846C15.6203 2 16.3249 2.44685 16.6551 3.14716L18 6H6L7.34491 3.14716Z" stroke="#CB0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 6H22" stroke="#CB0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10 11V16" stroke="#CB0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V16" stroke="#CB0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        <p>Eliminar</p>
    </button>
</div>



