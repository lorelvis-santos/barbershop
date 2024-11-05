let step = 1;
let slider = null;

let currentEmployeeContainer = null;
let currentTimeContainer = null;

const appointment = {
    name: "",
    date: "",
    time: "",
    services: [],
    totalPrice: 0,
    userId: "",
    employee: {
        id: "",
        name: "",
        phone: "",
        email: "",
        roleId: "",
        role: "",
        image: ""
    }
};

document.addEventListener("DOMContentLoaded", function() {
    init();
})

function init() {
    showSection(step);
    checkPagination(step);

    tabs(); // Switch between tabs.
    setPagination();
    setEmployeesSlider();
    getServices(); // Making an API query to get the database's services.
    //getEmployees();

    // Appointment related.
    getUserId();
    getDate();
    getAvailableTimes();

    showSummary();
}

function tabs() {
    const buttons = document.querySelectorAll(".tabs button");

    buttons.forEach(button => {
        button.addEventListener("click", event => {
            step = event.target.dataset.step;

            showSection(step);
            checkPagination(step);
        });
    })
}

function setPagination() {
    const back = document.querySelector("#back");
    const next = document.querySelector("#next");

    back.addEventListener("click", event => {
        const step = parseInt(document.querySelector("button.current").dataset.step);

        if (step > 1) {
            showSection(step - 1);
            checkPagination(step - 1);
        }

        scrollTo(0, document.body.scrollHeight);
    });

    next.addEventListener("click", event => {
        const step = parseInt(document.querySelector("button.current").dataset.step);

        if (step < 2) {
            showSection(step + 1);
            checkPagination(step + 1);
        }

        document.querySelector("#step-2").scrollIntoView();
    })
}

function checkPagination(step) {
    const back = document.querySelector("#back");
    const next = document.querySelector("#next");

    if (step == 1) {
        back.classList.add("hide");
        next.classList.remove("hide");
    } else if (step == 2) {
        back.classList.remove("hide");
        next.classList.add("hide");
    }
}

function showSection(step) {
    const currentTab = document.querySelector(`button[data-step="${step}"]`);
    const lastTab = document.querySelector("button.current");

    const currentSection = document.querySelector(`#step-${step}`);
    const lastSection = document.querySelector(".show");

    if (step == 2) {
        showSummary();
    }

    if (lastTab)
        lastTab.classList.remove("current");
    
    currentTab.classList.add("current");

    if (lastSection)
        lastSection.classList.remove("show");

    currentSection.classList.add("show");
}

async function setEmployeesSlider() {
    slider = new KeenSlider("#employees",
        {
            mode: "snap",
            slides: {
            perView: 1,
            spacing: 20,
            },
            dragSpeed: .8,
            breakpoints: {
                "(min-width: 768px)": {
                    mode: "free-snap",
                    slides: {
                        perView: 2,
                        spacing: 20
                    }
                },
                "(min-width: 1400px)": {
                    mode: "free-snap",
                    slides: {
                        perView: 2,
                        spacing: 20
                    }
                }
            }
        }
    );

    const employeesList = document.querySelector("#employees");
    const employeesContainers = document.querySelectorAll("li.employee");
    const arrows = document.querySelectorAll(".arrow");

    employeesContainers.forEach(employeeContainer => {
        employeeContainer.onclick = async function () {
            employee = await getEmployee(employeeContainer.dataset.id);

            employeeSelection(employee, employeeContainer);
        }
    });

    employeesList.addEventListener("mousedown", e => {
        employeesList.classList.add("dragging");
    });
    
    employeesList.addEventListener("mouseup", e => {
        employeesList.classList.remove("dragging");
    });

    arrows.forEach(arrow => {
        arrow.addEventListener("click", e => {
            if (arrow.id === "right-employee") 
                slider.next();
            else {
                slider.prev();
            }
        });
    });
}

async function getEmployee(id) {
    try {
         const url = `/api/employees?id=${id}`;
         const result = await fetch(url);
         const employee = await result.json();
        
         return employee;
     } catch (error) {
         console.error(error);
     }
}

// async function getEmployees() {
//     try {
//         const url = "/api/employees";
//         const result = await fetch(url);
//         const employees = await result.json();

//         showEmployees(employees);
//     } catch (error) {
//         console.error(error);
//     }
// }

// function showEmployees(employees) {
//     employees.forEach(employee => {
//         const employeeContainer = document.createElement("LI");
//         const employeeImage = document.createElement("IMG");
//         const employeeName = document.createElement("P");
//         const employeeRole = document.createElement("P");

//         const { id, roleId, name, role, image } = employee;
        
//         employeeImage.classList.add("employee__image");
//         employeeImage.src = `/build/img/${image}`;
        
//         employeeName.classList.add("employee__name");
//         employeeName.textContent = name;
        
//         employeeRole.classList.add("employee__role");
//         employeeRole.textContent = role;
        
//         employeeContainer.classList.add("keen-slider__slide");
//         employeeContainer.classList.add("employee");
//         employeeContainer.dataset.id = id;
//         employeeContainer.dataset.roleId = roleId;
        
//         employeeContainer.appendChild(employeeImage);
//         employeeContainer.appendChild(employeeName);
//         employeeContainer.appendChild(employeeRole);
//         employeeContainer.onclick = function () {
//             employeeSelection(employee, employeeContainer);
//         }

//         document.querySelector("#employees").appendChild(employeeContainer);    
//     })

//     setEmployeesSlider();
// }

function employeeSelection(employee, employeeContainer) {
    // A tomar en cuenta.
            
    // Estamos trabajando con dos variables. 
    //      Al momento de seleccionar, seleccionamos un contenedor y cambiamos  
    //      el valor de el empleado seleccionado.

    // Entonces, debemos de tener la versión del contenedor anterior y la nueva, con estas operaremos
    // y en caso de realizar un cambio, lo hacemos en ambas variables.

    // Casos:
    //      1. Si no hay contenedor, significa que estamos seleccionando un nuevo empleado.
    //              Simplemente añadimos la clase "selected" al contenedor y asignamos el nuevo empleado.

    //      2. Si ya existe un contenedor, significa que tenemos ambas variables ocupadas.
    //              Quitamos el selected del anterior contenedor, lo añadimos al nuevo contenedor.
    //              Reemplazamos el empleado anterior con el nuevo.
    let differentRole = false;

    if (currentEmployeeContainer === null) {
        currentEmployeeContainer = employeeContainer;
        currentEmployeeContainer.classList.add("selected");

        appointment.employee = employee;
        differentRole = true;

    } else if (currentEmployeeContainer != employeeContainer) {
        currentEmployeeContainer.classList.remove("selected");
                
        currentEmployeeContainer = employeeContainer;
        currentEmployeeContainer.classList.add("selected");

        if (currentEmployeeContainer.roleId != appointment.employee.roleId)
            differentRole = true;
            
        appointment.employee = employee;
    }

    // Obtener servicios del empleado.
    if (differentRole) {
       getServices();

       appointment.services = [];
    }

    if (appointment.time != "")
        appointment.time = "";

    getAvailableTimes();
}

async function getServices() {
    if (appointment.employee.id === "") {
        showAlert("error", "Debes de seleccionar un empleado", ".services-container", false);
    
        return false;
    } else {
        try {
            const url = `/api/services?id=${appointment.employee.roleId}`;

            const result = await fetch(url);
            const services = await result.json();
    
            showServices(services);
        } catch (error) {
            console.error(error);
        }
    }
}

function showServices(services) {
    const containerSelector = "#services";
    const servicesContainer = document.querySelector(containerSelector);

    clearContainer(containerSelector);

    alert = document.querySelector(".services-container .alert");

    if (alert != null)
        alert.remove();

    if (services.length > 0) {
        services.forEach(service => {
            const { id, name, price } = service;
    
            const serviceContainer = document.createElement("DIV");
            const serviceName = document.createElement("P");
            const servicePrice = document.createElement("P");
    
            serviceName.classList.add("service__name");
            serviceName.textContent = name;
    
            servicePrice.classList.add("service__price");
            servicePrice.textContent = `RD$${price}`;
    
            serviceContainer.classList.add("service");
            serviceContainer.classList.add("clickable");
            serviceContainer.dataset.serviceId = id;
    
            serviceContainer.appendChild(serviceName);
            serviceContainer.appendChild(servicePrice);
            serviceContainer.onclick = function () {
                serviceSelection(service);
            }
    
            servicesContainer.appendChild(serviceContainer);
        });
    } else {
        showAlert("error", "No hay ningún servicio asociado a ese rol", ".services-container", false);
    }
}

function serviceSelection(service) {
    const { id } = service;
    const { services } = appointment;
    const isSelected = services.includes(service);
    const serviceContainer = document.querySelector(`[data-service-id="${id}"]`);

    if (!serviceContainer)
        return;

    // Descomenta si quieres seleccionar más de un servicio.
    // if (!isSelected) {
    //     appointment.services = [...services, service];

    //     serviceContainer.classList.add("selected");
    // } else {
    //     deleteService(service);
    // }

    // Solo se permite la seleccion de un servicio.

    if (!isSelected) {
        if (appointment.services.length > 0) {
            deleteService(appointment.services[0]);
        }

        appointment.services = [service];

        serviceContainer.classList.add("selected");
    } else {
        deleteService(service);
    }
}

function deleteService(service) {
    const { id } = service;
    const serviceContainer = document.querySelector(`[data-service-id="${id}"]`);

    if (serviceContainer && appointment.services.includes(service)) {
        appointment.services = appointment.services.filter(element => element["id"] != service["id"]);
        serviceContainer.classList.remove("selected");
    }
}

function getUserId() {
    appointment.userId = document.querySelector("#userId").value;
}

// function getName() {
//     appointment.name  = document.querySelector("#name").value;
// }

function getDate() {
    const inputDate = document.querySelector("#date");

    datepicker = flatpickr(inputDate, {
        minDate: "today",
        maxDate: new Date().fp_incr(21), // 14 days from now
        altInput: true,
        altFormat: "l, j \\de F \\de Y",
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                // return true to disable
                // here I will add the functionality of employees being capable of disable some days for them.
                return (date.getDay() === 2); /*||
                        ["2024-10-02", "2024-10-03"].includes(date.toISOString().split("T")[0]);*/
            }
        ],
        locale: {
          firstDayOfWeek: 1,
          weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
          }, 
          months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          },
        },
      }
    ); 

    inputDate.addEventListener("input", event => {
        appointment.date = event.target.value;

        if (!appointment.employee.id) {
            clearContainer(".available-times");
            showAlert("error", "Debes de seleccionar un empleado", ".available-times", false);
    
            return false;
        }

        getAvailableTimes();
    });
}

function getTotalPrice() {
    if (appointment.services.length === 0) {
        appointment.totalPrice = 0;

        return false;
    }

    let total = 0;

    appointment.services.forEach(service => {
        total += parseFloat(service.price);

    })

    appointment.totalPrice = total.toFixed(2);
}

async function getAvailableTimes() {
    if (appointment.date === "") {
        clearContainer(".available-times");
        showAlert("error", "Selecciona un empleado y luego la fecha", ".available-times", false);

        return false;
    }

    try {
        const url = `/api/employees/availabletimes?id=${appointment.employee.id}&date=${appointment.date}`;
        const result = await fetch(url);
        const times = await result.json();

        showAvailableTimes(times);
    } catch (error) {
        console.error(error);
    }
}

function showAvailableTimes(times) {
    const containerSelector = ".available-times";

    clearContainer(containerSelector);

    if (!times) {
        showAlert("error", "No hay horarios disponibles para ese día", containerSelector, false);

        return false;
    }

    const timesContainer = document.querySelector(containerSelector);

    times.forEach(time => {
        const timeContainer = document.createElement("LI");

        timeContainer.dataset.id = time.id;
        timeContainer.textContent = to12hr(time.time);
        timeContainer.classList.add("available-time");
        timeContainer.onclick = function () {
            timeSelection(time, timeContainer);
        }

        timesContainer.appendChild(timeContainer);
    });
}

function timeSelection(time, timeContainer) {
    if (currentTimeContainer === null) {
        currentTimeContainer = timeContainer;
        currentTimeContainer.classList.add("selected");

        appointment.time = time;

    } else if (currentTimeContainer != timeContainer) {
        currentTimeContainer.classList.remove("selected");
                
        currentTimeContainer = timeContainer;
        currentTimeContainer.classList.add("selected");
            
        appointment.time = time;
    }
}

/*
    0 = sunday.
    1 = monday.
    2 = tuesday.
    3 = wednesday.
    4 = thursday.
    5 = saturday.
*/

function showSummary() {
    clearContainer(".summary");

    const summary = document.querySelector(".summary");

    if (appointment.services.length === 0) {
        showAlert("error", "Debes seleccionar mínimo un servicio", ".summary", false);

        return false;
    }

    if (appointment.date === "" || appointment.time === "") {
        showAlert("error", "Debes seleccionar una fecha y una hora", ".summary", false);

        return false;
    }

    const { date, time, services, employee } = appointment;

    const formattedDate = formatDate(date);

    const summaryTitle = document.createElement("H2");
    const appointmentTitle = document.createElement("H3");
    const form = document.createElement("FORM");
    const servicesTitle = document.createElement("H3");
    const servicesContainer = document.createElement("DIV");
    const buttonContainer = document.createElement("DIV");
    const button = document.createElement("BUTTON");
    const totalPriceDiv = document.createElement("DIV");
    const totalPriceText = document.createElement("P");
    const totalPriceSpan = document.createElement("SPAN");

    summaryTitle.textContent = "Resumen";

    const fields = [
        {
            id: "established-employee-name",
            label: "Te atenderá",
            inputInfo: employee.name
        },
        {
            id: "established-date",
            label: "Fecha de la cita",
            inputInfo: capitalizeFirstLetter(formattedDate)
        },
        {
            id: "established-hour",
            label: "Hora establecida",
            inputInfo: to12hr(time.time)
        }
    ]

    appointmentTitle.textContent = "Información de la cita";
    appointmentTitle.classList.add("text-center");

    form.classList.add("form");

    fields.forEach(field => {
        const divField = document.createElement("DIV");
        const labelField = document.createElement("LABEL");
        const inputField = document.createElement("INPUT");

        divField.classList.add("field");

        labelField.textContent = field.label;
        labelField.setAttribute("for", field.id);
        
        inputField.setAttribute("type", "text");
        inputField.setAttribute("id", field.id);
        inputField.setAttribute("value", field.inputInfo);
        inputField.setAttribute("disabled", true);

        divField.appendChild(labelField);
        divField.appendChild(inputField);

        form.appendChild(divField);
    })

    servicesTitle.textContent = "Servicios seleccionados";
    servicesTitle.classList.add("text-center");

    services.forEach(service => {
        const serviceContainer = document.createElement("DIV");
        const serviceName = document.createElement("P");
        const serviceLeftDiv = document.createElement("DIV");
        const serviceRightDiv = document.createElement("DIV");
        const servicePrice = document.createElement("P");
        const serviceDeleteIcon = deleteIconSVG();
        const { id, name, price } = service;

        serviceName.textContent = name;
        serviceName.classList.add("service__name");

        servicePrice.textContent = `RD$${price}`;
        servicePrice.classList.add("service__price");

        serviceLeftDiv.appendChild(serviceName);
        serviceLeftDiv.appendChild(servicePrice);

        serviceDeleteIcon.classList.add("clickable");
        serviceDeleteIcon.onclick = function () {
            deleteService(service);
            serviceContainer.remove();

            if (appointment.services.length === 0) {
                showAlert("error", "Debes seleccionar mínimo un servicio", ".summary .services-container", false);

                document.querySelector(".total-price").remove();
                document.querySelector("#book-button").remove();

                return false;
            }

            getTotalPrice();
            document.querySelector(".total-price span").textContent = "RD$" + appointment.totalPrice;
        }

        serviceRightDiv.appendChild(serviceDeleteIcon);
        serviceRightDiv.classList.add("service__right");

        serviceContainer.appendChild(serviceLeftDiv);
        serviceContainer.appendChild(serviceRightDiv);
        serviceContainer.classList.add("service-container");

        servicesContainer.appendChild(serviceContainer);
        servicesContainer.classList.add("services-container");
    })

    getTotalPrice();
    
    totalPriceSpan.textContent = "RD$" + appointment.totalPrice;

    totalPriceText.textContent = "Total a pagar: ";
    totalPriceText.classList.add("total-price");
    
    totalPriceText.append(totalPriceSpan);
    
    totalPriceDiv.appendChild(totalPriceText);
    totalPriceDiv.classList.add("total-price-container");

    button.classList.add("button");
    button.textContent = "Reservar";
    button.id = "book-button";
    button.onclick = bookAppointment;

    buttonContainer.classList.add("place-right");
    buttonContainer.appendChild(button);

    summary.appendChild(summaryTitle);
    summary.appendChild(appointmentTitle);
    summary.appendChild(form);
    summary.appendChild(servicesTitle);
    summary.appendChild(servicesContainer);
    summary.appendChild(totalPriceDiv);
    summary.appendChild(buttonContainer);
}

async function bookAppointment() {
    const url = "/api/appointments";
    const servicesId = appointment.services.map(service => service.id);
    const { date, totalPrice, time, userId, employee } = appointment;
    const data = new FormData();

    data.append("date", date);
    data.append("totalPrice", totalPrice);
    data.append("timeId", time.id);
    data.append("services", servicesId);
    data.append("userId", userId);
    data.append("employeeId", employee.id)

    // Leer FormData.
    //console.log([...data]);

    try {
        const response = await fetch(url, {
            method: "POST",
            body: data
        });
    
        //const result = await response.json();

        Swal.fire({
            icon: "success",
            title: "Cita reservada",
            text: "Tu cita ha sido reservada correctamente!"
        }).then(() => window.location.href = "/cliente/mis-citas");
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ha ocurrido un error!",
            footer: `${error}`
        });
    }
}

