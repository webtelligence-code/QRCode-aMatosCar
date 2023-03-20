let cities = [
    'Evora OI',
    'Evora Colisao',
    'Evora B',
    'Evora C',
    'Evora F',
    'Evora K',
    'Evora V',
    'Evora S',
    'Guarda',
    'Guarda CFO',
    'Castelo Branco OI',
    'Castelo Branco VW',
    'Castelo Branco CV',
    'Elvas',
    'Beja OC',
    'Beja IIKH',
    'Portalegre Oficina',
    'Fundão VK'
];

document.addEventListener("DOMContentLoaded", function () {
    updateTableByCity(""); // Fetch all users initially
});

let dropdownConcession = document.getElementById('concession-list');
let concessionText = document.getElementById('concession-text');

// Loop through the array and create html list
cities.forEach((city) => {
    let dropdownConcessionItem = document.createElement('a');
    dropdownConcessionItem.className = 'dropdown-item bg-m-h-orange';
    dropdownConcessionItem.href = `#${city}`;
    dropdownConcessionItem.innerText = city;

    // add event listener to each dropdown item
    dropdownConcessionItem.addEventListener('click', ((city) => {
        return () => {
            // Clean html
            $("#users-tbody").html('');

            concessionText.innerText = city;
            console.log(`You clicked on ${city}!`);

            // Send AJAX request to update the table content
            updateTableByCity(city);
        }
    })(city));

    dropdownConcession.appendChild(dropdownConcessionItem);
});

/**
 * This function will make an AJAX request to update the table content
 * by city name
 * @param {string} city 
 */
function updateTableByCity(city) {
    $.get(`db/filter_users.php`, {city}, function (data) {
        console.log(data)
        $('#users-tbody').html(data);
    }).fail(function () {
        console.error("AJAX request failed");
    });
}

///////////////////////////////////////////////////////////////////////////////
// For Search
let searchByList = [
    'Nome',
    'Concessão',
    'Função'
];
let dropdownSearchBy = document.getElementById('search-by');
let dropdownSearchByText = document.getElementById('dropdown-search-by-text');
let searchForm = document.querySelector('form[role="search"]');
let searchInput = searchForm.querySelector('input[type="search"]');


// Change dropdown search by text
dropdownSearchByText.innerText = `Procurar por ${searchByList[0]}`;
searchInput.placeholder = `Procurar ${searchByList[0]}`;

// Loop through the array and create html list
searchByList.forEach((searchBy) => {
    let dropdownSearchByItem = document.createElement('a');
    dropdownSearchByItem.className = 'dropdown-item bg-m-h-orange';
    dropdownSearchByItem.href = `#`;
    dropdownSearchByItem.innerText = searchBy;

    dropdownSearchByItem.addEventListener('click', ((searchBy) => {
        return () => {
            console.log(`You clicked on ${searchBy}!`);
            let selectedSearchBy = event.target.innerText;
            searchInput.placeholder = `Procurar ${selectedSearchBy}`;
            dropdownSearchByText.innerText = `Procurar por ${searchBy}`;
        };
    })(searchBy));

    dropdownSearchBy.appendChild(dropdownSearchByItem);
});