<?php
    $currentPage = 1;
    include_once __DIR__ . "/../templates/bar.php" 
?>

<div class="app">
    <!-- <nav class="tabs">
        <button class="current" type="button">Mis citas</button>
        <button type="button">Agendar cita</button>
    </nav> -->

    <h1 class="page__name">Agenda una cita</h1>
    <p class="page__description">Con la posibilidad de elegir empleado, fecha y servicios</p>

    <nav class="tabs">
        <button class="current" type="button" data-step="1">Cita</button>
        <button type="button" data-step="2">Resumen</button>
    </nav>

    <div id="step-1" class="section">
        <h2>Información de la cita</h2>
            
        <div class="subsection">
            <p class="text-center employees-text">Selecciona un empleado</p>

            <div class="employees-container">
                <button type="button" class="arrow" id="left-employee">
                    <svg viewBox="-0.96 -0.96 25.92 25.92" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="" stroke-width="0.00024000000000000003" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-0.96" y="-0.96" width="25.92" height="25.92" rx="12.96" fill="#076493" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.672"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#fff"></path> </g></svg>
                </button>

                <ul class="keen-slider employees-list" id="employees">
                    <?php foreach ($employees as $employee) { ?>
                        <li class="keen-slider__slide employee" data-id="<?php echo escape_html($employee["id"]); ?>" data-role-id="<?php echo escape_html($employee["roleId"]); ?>">
                            <img src="/build/img/<?php echo escape_html($employee["image"]); ?>" alt="Imagen de empleado" class="employee__image">
                            <p class="employee__name"><?php echo escape_html($employee["name"]); ?></p>
                            <p class="employee__role"><?php echo escape_html($employee["role"]); ?></p>
                        </li>
                    <?php } ?>    
                </ul>

                <button type="button" class="arrow" id="right-employee">
                    <svg viewBox="-0.96 -0.96 25.92 25.92" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="" stroke-width="0.00024000000000000003" transform="rotate(180)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"><rect x="-0.96" y="-0.96" width="25.92" height="25.92" rx="12.96" fill="#076493" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.672"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2893 5.70708C13.8988 5.31655 13.2657 5.31655 12.8751 5.70708L7.98768 10.5993C7.20729 11.3805 7.2076 12.6463 7.98837 13.427L12.8787 18.3174C13.2693 18.7079 13.9024 18.7079 14.293 18.3174C14.6835 17.9269 14.6835 17.2937 14.293 16.9032L10.1073 12.7175C9.71678 12.327 9.71678 11.6939 10.1073 11.3033L14.2893 7.12129C14.6799 6.73077 14.6799 6.0976 14.2893 5.70708Z" fill="#fff"></path> </g></svg>
                </button>
            </div>
        </div>

        <div class="subsection">
            <p class="text-center">Elige la fecha y hora</p>

            <form class="form date-info">
                <div class="field">
                    <label for="date">Fecha</label>
                    <input class="clickable" type="date" id="date" placeholder="Haz click aquí para seleccionar una fecha">
                </div>

                <div class="field">
                    <label for="time">Horas disponibles</label>
                    <ul class="available-times">
                    </ul>
                </div>

                <input type="hidden" id="userId" value="<?php echo $id; ?>">
            </form>
        </div>

        <div class="subsection services-container">
            <!-- <h2>Servicios</h2> -->

            <!-- Descomentar si se añadirán varios servicios -->
            <!-- <p class="text-center">Selecciona tus servicios</p> -->
            <p class="text-center">Selecciona un servicio</p>

            <div id="services" class="services-list">
            
            </div>
        </div>
    </div>

    <div id="step-2" class="section summary">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información es correcta</p>
    </div>

    <div class="pagination">
        <button id="back" class="button hide">
            &laquo; Atrás
        </button>

        <button id="next" class="button">
            Siguiente &raquo;
        </button>
    </div>
</div>