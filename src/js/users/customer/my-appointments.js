document.addEventListener("DOMContentLoaded", function () {
    init();
});

async function init() {
    const result = await getBookedAppointments("customers", "customer", false);

    if (!result) {
        showAlert("error", "No hay citas agendadas", ".app", false);

        const buttonContainer = document.createElement("DIV");
        const button = document.createElement("A");

        button.textContent = "Agendar cita";
        button.href = "/cliente/agendar-cita";
        button.classList.add("button");
        button.classList.add("button-responsive");

        buttonContainer.classList.add("place-center");
        buttonContainer.appendChild(button);

        document.querySelector(".app").appendChild(buttonContainer);
    }
}