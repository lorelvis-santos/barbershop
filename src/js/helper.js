function getDateISO(date) {
    const offsetDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);
    return offsetDate.toISOString().split("T")[0];
}

Date.prototype.GetFirstDayOfWeek = function() {
    let copyOfDate = new Date(this);

    return (new Date(copyOfDate.setDate(copyOfDate.getDate() - copyOfDate.getDay()+ (copyOfDate.getDay() == 0 ? -6:1) )));
}
Date.prototype.GetLastDayOfWeek = function() {
    let copyOfDate = new Date(this);

    return (new Date(copyOfDate.setDate(copyOfDate.getDate() - copyOfDate.getDay() +7)));
}

function capitalizeFirstLetter(toCapitalize) {
    return toCapitalize.charAt(0).toUpperCase() + toCapitalize.slice(1);
}

function formatPhoneNumber(phoneNumberString) {
    var cleaned = ('' + phoneNumberString).replace(/\D/g, '');
    var match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);

    if (match) {
        return '(' + match[1] + ') ' + match[2] + '-' + match[3];
    }

    return null;
}

function formatDate(date, location = "es-ES") {
    const dateObj = new Date(date);

    const month = dateObj.getMonth();
    const day   = dateObj.getDate() + 2;
    const year  = dateObj.getFullYear();

    const dateUTC = new Date( Date.UTC(year, month, day));

    return dateUTC.toLocaleDateString(location, {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric"
    });
}

function clearContainer($container) {
    const toClear = document.querySelector($container);

    while (toClear.firstChild) {
        toClear.removeChild(toClear.firstChild);
    }
}

function showAlert(type, message, element, destroy = true) {
    // if (document.querySelector(".alert"))
    //     deleteAlerts();

    const place = document.querySelector(element);
    const alert = document.createElement("P");

    alert.classList.add("alert");
    alert.classList.add(type);

    alert.textContent = message;

    if (!place)
        return false;

    place.appendChild(alert);

    if (destroy) {
        setTimeout(() => {
            alert.remove();
        }, 5000)
    }

    return true;
}

function deleteAlerts() {
    const alert = document.querySelector(".alert");

    if (alert) {
        alert.remove();
    }
}

function to12hr(timeString) {
    // Hago un split de la hora en base al ":".
    // Separo las horas de los minutos y las convierto en enteros.
    // Si es mayor que 12, le resto 12 y añado los minutos junto con PM al final.
    // Caso contrario solo añado los minutos y AM.

    let time = timeString.split(":");
    let hour = parseInt(time[0]);
    let minutes = time[1];

    let period = hour >= 12 ? "PM" : "AM";
    
    if (hour > 12) {
        hour -= 12;
    } else if (hour === 0) {
        hour = 12; // Para la medianoche
    } else if (hour === 12) {
        // Se mantiene como 12 PM
    }

    return `${hour}:${minutes} ${period}`;
}