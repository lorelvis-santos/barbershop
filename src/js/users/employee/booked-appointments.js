document.addEventListener("DOMContentLoaded", function () {
    init();
});

async function init() {
    const result = await getBookedAppointments("employees", "employees", true);

    if (!result) {
        showAlert("error", "No hay citas agendadas", ".app", false);
    }
}