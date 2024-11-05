let searchTimeout;
let currentElement = null;

const searchBarContainer = document.querySelector(".search-bar");
const resultsContainer = document.querySelector(".search-results-container");
const searchInput = document.querySelector(".search-bar input");

document.addEventListener("DOMContentLoaded", () => {
    const delay = 275;
    const model = "employees";

    searchbar(model, delay);
})

function searchbar(model, delay) {
    searchInput.addEventListener("input", e => {
        debounceSearch(model, delay);
    });

    searchInput.addEventListener("focusin", e => {
        if (!searchInput.value.trim() < 2) {
            debounceSearch(model, delay);
        }
    })

    searchInput.addEventListener("focusout", e => {
        setTimeout(() => {
            searchBarContainer.classList.remove("active");
            resultsContainer.classList.remove("show");
        }, 100);
    })
}

// Función para manejar el debounce
function debounceSearch(model, delay) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        fetchResults(model);
    }, delay);
}
  
  // Función para obtener los resultados
async function fetchResults(model) {
    const query = searchInput.value.trim();

    if (query.length < 2) {
        clearContainer(".search-results-container");
        searchBarContainer.classList.remove("active");
        resultsContainer.classList.remove("show");
        
        return;
    }
  
    try {
        const response = await fetch(`/api/search/${model}?query=${query}`);
        const results = await response.json();
  
        displayResults(results);
    } catch (error) {
        console.error("Error fetching results:", error);
    }
}
  
  // Función para mostrar los resultados de búsqueda
function displayResults(results) {
    clearContainer(".search-results-container");

    if (results.length === 0) {
        // Mostrar feedback al usuario.
        searchBarContainer.classList.remove("active");
        resultsContainer.classList.remove("show");
    } else {
        searchBarContainer.classList.add("active");
        resultsContainer.classList.add("show");

        results.forEach(result => {
            const element = document.createElement("P");
            const container = document.createElement("LI");

            element.textContent = result.data;

            container.appendChild(element);
            
            container.onclick = function () {
                selectElement(result);
            }

            resultsContainer.appendChild(container);
        });
    }
}

function selectElement(element) {
    if (element != currentElement) {
        currentElement = element;

        document.querySelector("#userId").value = currentElement.id;

        searchInput.value = currentElement.data;
    }

    clearContainer(".search-results-container");
}