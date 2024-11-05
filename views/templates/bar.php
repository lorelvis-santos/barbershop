<div class="bar">
    <div class="user">
        <svg class="no-cursor-events" viewBox="-5.44 -5.44 26.88 26.88" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="" transform="rotate(0)matrix(1, 0, 0, 1, 0, 0)">
            <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)">
                <rect x="-5.44" y="-5.44" width="26.88" height="26.88" rx="13.44" fill="#076493" strokewidth="0"></rect>
            </g>

            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.064"></g>
            <g id="SVGRepo_iconCarrier">
                <path d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z" fill="#ffffff"></path> 
                <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z" fill="#ffffff"></path> 
            </g>
        </svg>

        <p><?php echo escape_html($name); ?> </p>
    </div>

    <a href="/logout">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M2 6.5C2 4.01472 4.01472 2 6.5 2H12C14.2091 2 16 3.79086 16 6V7C16 7.55228 15.5523 8 15 8C14.4477 8 14 7.55228 14 7V6C14 4.89543 13.1046 4 12 4H6.5C5.11929 4 4 5.11929 4 6.5V17.5C4 18.8807 5.11929 20 6.5 20H12C13.1046 20 14 19.1046 14 18V17C14 16.4477 14.4477 16 15 16C15.5523 16 16 16.4477 16 17V18C16 20.2091 14.2091 22 12 22H6.5C4.01472 22 2 19.9853 2 17.5V6.5ZM18.2929 8.29289C18.6834 7.90237 19.3166 7.90237 19.7071 8.29289L22.7071 11.2929C23.0976 11.6834 23.0976 12.3166 22.7071 12.7071L19.7071 15.7071C19.3166 16.0976 18.6834 16.0976 18.2929 15.7071C17.9024 15.3166 17.9024 14.6834 18.2929 14.2929L19.5858 13L11 13C10.4477 13 10 12.5523 10 12C10 11.4477 10.4477 11 11 11L19.5858 11L18.2929 9.70711C17.9024 9.31658 17.9024 8.68342 18.2929 8.29289Z"
                    fill="#CB0000"></path>
            </g>
        </svg>
    </a>
</div>

<?php if (isType("employee") || isType("admin")) {?>
    <nav class="navigation">
        <?php if (isType("admin")) { ?> 
            <a href="/administracion" class="button <?php if ($currentPage === 0) echo "current"; ?>">Administración</a> 
        <?php }?>
        <a href="/empleado/configuracion" class="button <?php if ($currentPage === 1) echo "current"; ?>">Mis ajustes</a>
        <a href="/empleado/agenda" class="button <?php if ($currentPage === 2) echo "current"; ?>">Citas</a>
    </nav>
<?php } else if (isType("customer")) { ?>
    <nav class="navigation">
        <a href="/cliente/mis-citas" class="button <?php if ($currentPage === 0) echo "current"; ?>">Mis citas</a>
        <a href="/cliente/agendar-cita" class="button <?php if ($currentPage === 1) echo "current"; ?>">Nueva cita</a>
    </nav>
<?php } ?>