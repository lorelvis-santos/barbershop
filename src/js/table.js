// app.js

document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll("tbody tr");
    const menuPopup = document.getElementById("menuPopup");
  
    rows.forEach(row => {
        row.addEventListener("click", (event) => {
            const rowId = row.getAttribute("data-id");
  
            // Guarda el ID de la fila seleccionada en el menú emergente
            menuPopup.setAttribute("data-id", rowId);

            // Posiciona el popup fuera de la pantalla temporalmente para calcular su tamaño
            menuPopup.style.left = "-9999px";
            menuPopup.style.top = "-9999px";
            menuPopup.style.display = "block"; // Mostrar el popup de forma invisible
  
            // Obtén el tamaño del popup
            const popupWidth = menuPopup.offsetWidth;
            const popupHeight = menuPopup.offsetHeight;

            // Obtén las coordenadas del click y ajusta con el scroll
            let popupX = event.pageX;
            let popupY = event.pageY;

            // Calcula los límites de la página y el tamaño del viewport
            const pageWidth = document.documentElement.scrollWidth;
            const pageHeight = document.documentElement.scrollHeight;
            const viewportWidth = document.documentElement.clientWidth;
            const viewportHeight = document.documentElement.clientHeight;

            // Ajuste si el popup se sale por la derecha de la ventana visible
            if (popupX + popupWidth > viewportWidth + window.scrollX) {
                popupX = viewportWidth + window.scrollX - popupWidth - 10;
            }

            // Ajuste si el popup se sale por abajo de la ventana visible
            if (popupY + popupHeight > viewportHeight + window.scrollY) {
                popupY = viewportHeight + window.scrollY - popupHeight - 10;
            }


            // Aplica la posición ajustada
            menuPopup.style.left = `${popupX}px`;
            menuPopup.style.top = `${popupY}px`;

            menuPopup.style.display = "block";
        });
    });
  
    // Ocultar el menú emergente al hacer clic fuera de él
    document.addEventListener("click", (event) => {
        if (!menuPopup.contains(event.target) && !event.target.closest("tbody tr")) {
            menuPopup.style.display = "none";
        }
    });
});

  
function updateItem(model) {
    const id = document.getElementById("menuPopup").getAttribute("data-id");
    const url = `/administracion/${model}/actualizar?id=${id}`;
    
    window.location.href = url;
}
  
async function deleteItem(apiName) {
    const id = document.getElementById("menuPopup").getAttribute("data-id");
    
    try {
        const data = new FormData();
        const url = `/api/${apiName}`;

        data.append("id", id);
        data.append("method", "DELETE");

        const response = await fetch(url, {
            method: "POST",
            body: data
        });

        const result = await response.json();

        if (result.result) {
            document.querySelector(`tr[data-id="${id}"]`).remove();
        }

        document.querySelector("#menuPopup").style.display = "none";
    } catch (error) {
        console.error(error);
    }
}
  