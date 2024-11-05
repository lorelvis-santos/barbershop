let appointmentsList = {
    today: [],
    tomorrow: [],
    postTomorrow: [],
    week: [],
    nextWeek: [],
    others: []
};

const containerSelector = ".appointments";

function getInfo() {
    return document.querySelector("#info #id").value;
}

async function getBookedAppointments(model, field, isEmployee = false) {
    id = getInfo();

    if (!id)
        return false;

    try {
        const url = `/api/${model}/bookedappointments?id=${id}&field=${field}`;

        const result = await fetch(url);

        const appointmentsUnordered = await result.json();

        if (appointmentsUnordered.length === 0) {
            return false;
        }

        const appointments = groupAppointments(appointmentsUnordered);

        orderAppointmentsByDate(appointments, isEmployee);

        return true;
    } catch (error) {
        console.error(error);

        return false;
    }
}

function orderAppointmentsByDate(appointments, isEmployee = false) {
    const todayDay = new Date();
    const tomorrowDay = new Date(todayDay.getFullYear(), todayDay.getMonth(), todayDay.getDate() + 1);
    const postTomorrowDay = new Date(tomorrowDay.getFullYear(), tomorrowDay.getMonth(), tomorrowDay.getDate() + 1);
    const lastDayOfWeek = todayDay.GetLastDayOfWeek();
    const nextWeekStart = new Date(lastDayOfWeek.getFullYear(), lastDayOfWeek.getMonth(), lastDayOfWeek.getDate() + 1);
    const nextWeekEnd = nextWeekStart.GetLastDayOfWeek();

    appointments.forEach(appointment => {
        const { date } = appointment;

        if (date === getDateISO(todayDay)) {
            appointmentsList.today.push(appointment);
        } else if (date === getDateISO(tomorrowDay)) {
            appointmentsList.tomorrow.push(appointment);
        } else if (date === getDateISO(postTomorrowDay)) {
            appointmentsList.postTomorrow.push(appointment);
        } else if (date > getDateISO(postTomorrowDay) && date <= getDateISO(lastDayOfWeek)) {
            appointmentsList.week.push(appointment);
        } else if (date >= getDateISO(nextWeekStart) && date <= getDateISO(nextWeekEnd)) {
            appointmentsList.nextWeek.push(appointment);
        } else {
            appointmentsList.others.push(appointment);
        }
    });

    showAppointments(isEmployee);
}

function groupAppointments(appointments) {
    const groupedAppointments = {};
  
    appointments.forEach(appointment => {
      const { id, date, time, totalPrice, customerId, customerName, customerEmail, customerPhone, employeeId, employeeName, employeeRoleId, employeeRoleName, serviceId, serviceName, servicePrice } = appointment;
  
      // Si la cita aún no existe en el objeto agrupado, la creamos
      if (!groupedAppointments[id]) {
        groupedAppointments[id] = {
          id,
          date,
          time,
          totalPrice,
          customer: {
            id: customerId,
            name: customerName,
            email: customerEmail,
            phone: customerPhone
          },
          employee: {
            id: employeeId,
            name: employeeName,
            roleId: employeeRoleId,
            roleName: employeeRoleName
          },
          services: []
        };
      }
  
      // Agregamos el servicio al arreglo de servicios de la cita existente
      groupedAppointments[id].services.push({
        id: serviceId,
        name: serviceName,
        price: servicePrice
      });
    });
  
    // Convertimos el objeto agrupado en un array de citas
    return Object.values(groupedAppointments).sort((a, b) => {
        const timeA = a.time.split(':').map(Number);
        const timeB = b.time.split(':').map(Number);

        // Comparar las horas y minutos
        return timeA[0] - timeB[0] || timeA[1] - timeB[1];
    });
}

function showAppointments(isEmployee = false) {
    const { today, tomorrow, postTomorrow, week, nextWeek, others } = appointmentsList;

    if (today.length > 0) {
        listAppointments("Hoy", today, isEmployee);
    }
        

    if (tomorrow.length > 0) {
        listAppointments("Mañana", tomorrow, isEmployee);
    }
        

    if (postTomorrow.length > 0) {
        listAppointments("Pasado mañana", postTomorrow, isEmployee);
    }
        

    if (week.length > 0) {
        listAppointments("Esta semana", week, isEmployee);
    }
        

    if (nextWeek.length > 0) {
        listAppointments("Próxima semana", nextWeek, isEmployee);
    }
        

    if (others.length > 0) {
        listAppointments("Otras fechas", others, isEmployee);
    }
}

function listAppointments(sectionName, appointments, isEmployee = false) {
    const container = document.querySelector(containerSelector);
    
    if (!container)
        return false;

    const sectionContainer = document.createElement("DIV");
    const sectionTitle = document.createElement("H3");
    const bookedAppointments = document.createElement("UL");

    appointments.forEach(appointment => {
        const appointmentContainer = document.createElement("LI");

        const appointmentInfo = document.createElement("DIV");
        const appointmentDay = document.createElement("DIV");
        
        const appointmentDate = document.createElement("DIV");
        const appointmentDateIcon = dateIconSVG();
        const appointmentDateText = document.createElement("P");

        const appointmentTime = document.createElement("DIV");
        const appointmentTimeIcon = timeIconSVG();
        const appointmentTimeText = document.createElement("P");

        const appointmentServicesTitle = document.createElement("H4");
        const appointmentServices = document.createElement("UL");
        
        const appointmentTotalPrice = document.createElement("DIV");
        const appointmentTotalPriceText = document.createElement("P");

        const appointmentActions = document.createElement("DIV");

        const deleteAppointmentButton = document.createElement("BUTTON");
        const deleteAppointmentButtonIcon = deleteIconWhiteSVG();

        //appointmentDateIcon = dateIconSVG();
        appointmentDateText.textContent = capitalizeFirstLetter(formatDate(appointment.date));

        appointmentDate.appendChild(appointmentDateIcon);
        appointmentDate.appendChild(appointmentDateText);
        appointmentDate.classList.add("appointment__date");

        appointmentTimeText.textContent = to12hr(appointment.time);

        appointmentTime.appendChild(appointmentTimeIcon);
        appointmentTime.appendChild(appointmentTimeText);
        appointmentTime.classList.add("appointment__time");

        appointmentDay.appendChild(appointmentDate);
        appointmentDay.appendChild(appointmentTime);
        appointmentDay.classList.add("appointment__day");

        appointmentInfo.appendChild(appointmentDay);

        const appointmentCustomer = document.createElement("DIV");
        const appointmentCustomerIcon = userIconSVG();
        const appointmentCustomerName = document.createElement("P");

        appointmentCustomerName.textContent = isEmployee ? appointment.customer.name : appointment.employee.name;

        appointmentCustomer.appendChild(appointmentCustomerIcon);
        appointmentCustomer.appendChild(appointmentCustomerName);
        appointmentCustomer.classList.add("appointment__customer");

        appointmentInfo.appendChild(appointmentCustomer);

        if (isEmployee) {
            
        }

        appointmentInfo.classList.add("appointment__info");

        appointmentServicesTitle.textContent = "Servicios solicitados";
        appointmentServices.classList.add("appointment__services");

        appointment.services.forEach(service => {
            const serviceContainer = document.createElement("LI");
            const serviceName = document.createElement("P");
            const servicePrice = document.createElement("P");

            serviceName.textContent = service.name;
            serviceName.classList.add("appointment__service__name");

            servicePrice.textContent = "RD$" + service.price;
            servicePrice.classList.add("appointment__service__price");

            serviceContainer.appendChild(serviceName);
            serviceContainer.appendChild(servicePrice);
            serviceContainer.classList.add("appointment__service");

            appointmentServices.appendChild(serviceContainer);
        });

        appointmentTotalPriceText.innerHTML = `Total a pagar: <span>RD$${appointment.totalPrice}</span>`;
        appointmentTotalPriceText.classList.add("total-price");

        appointmentTotalPrice.appendChild(appointmentTotalPriceText);
        appointmentTotalPrice.classList.add("appointment__total-price");

        if (isEmployee) {
            const messageCustomerButton = document.createElement("BUTTON");
            const messageCustomerButtonIcon = whatsappIconSVG();
            
            const callCustomerButton = document.createElement("BUTTON");
            const callCustomerButtonIcon = callIconSVG();

            messageCustomerButton.appendChild(messageCustomerButtonIcon);
            messageCustomerButton.attributes.type = "button";
            messageCustomerButton.classList.add("clickable");
            messageCustomerButton.id = "message-customer";
            messageCustomerButton.addEventListener("click", function () {
                messageCustomer(appointment.customer.phone);
            });

            callCustomerButton.appendChild(callCustomerButtonIcon);
            callCustomerButton.attributes.type = "button";
            callCustomerButton.classList.add("clickable");
            callCustomerButton.id = "call-customer";
            callCustomerButton.addEventListener("click", function() {
                callCustomer(appointment.customer.phone);
            });

            appointmentActions.appendChild(messageCustomerButton);
            appointmentActions.appendChild(callCustomerButton);
        }

        if (!isEmployee) {
            // make edit button for customers.
        }

        deleteAppointmentButton.appendChild(deleteAppointmentButtonIcon);
        deleteAppointmentButton.attributes.type = "button";
        deleteAppointmentButton.classList.add("clickable");
        deleteAppointmentButton.id = "delete-appointment";
        deleteAppointmentButton.addEventListener("click", function() {
            deleteAppointment(appointment, appointmentContainer, isEmployee);
        })

        appointmentActions.appendChild(deleteAppointmentButton);
        appointmentActions.classList.add("appointment__actions");

        appointmentContainer.appendChild(appointmentInfo);
        appointmentContainer.appendChild(appointmentServicesTitle);
        appointmentContainer.appendChild(appointmentServices);
        appointmentContainer.appendChild(appointmentTotalPrice);
        appointmentContainer.appendChild(appointmentActions);
        appointmentContainer.classList.add("appointment");

        bookedAppointments.appendChild(appointmentContainer);
    });

    sectionTitle.textContent = sectionName;
    bookedAppointments.classList.add("booked-appointments");
    
    sectionContainer.appendChild(sectionTitle);
    sectionContainer.appendChild(bookedAppointments);

    container.appendChild(sectionContainer);
}

function messageCustomer(phone) {
    const phoneString = phone.charAt(0) === "1" ? phone : "1" + phone;

    window.location.href = "https://wa.me/" + phoneString;
}

function callCustomer(phone) {
    const phoneString = phone.charAt(0) === "1" ? phone : "+1" + phone;

    window.location.href = "tel:" + phoneString;
}

async function deleteAppointment(appointment, appointmentContainer, isEmployee = false) {
    if (!appointment.id)
        return false;

    try {
        const url = `/api/appointments`;

        const data = new FormData();

        data.append("method", "DELETE");
        data.append("id", appointment.id);

        const result = await fetch(url, {
            method: "POST",
            body: data
        });

        Swal.fire({
            icon: "success",
            title: "Cita eliminada",
            text: "La cita ha sido eliminada correctamente!"
        });

        const container = document.querySelector(containerSelector)
        const bookedAppointments = appointmentContainer.parentElement;
        const div = bookedAppointments.parentElement;

        if (bookedAppointments.childElementCount === 1) {
            div.remove();
        } else {
            appointmentContainer.remove();
        }

        if (container.childElementCount === 0) {
            showAlert("error", "No hay citas agendadas", ".app", false);

            if (!isEmployee) {
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
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ha ocurrido un error!",
            footer: `${error}`
        });
    }
}