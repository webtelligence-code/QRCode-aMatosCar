<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode - A MatosCar</title>
    <link rel="icon" type="image" href="https://amatoscar.pt/assets/media/general/logoamatoscar.webp">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body style="padding-top: 70px;">
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg" style="background-color: white;">
        <div class="container-fluid">
            <div class="container-fluid">

                <!-- Row with 3 centered columns -->
                <div class="row align-items-center">
                    <!-- Left Column -->
                    <div class="col text-white">
                        <a href="/">
                            <img src="https://amatoscar.pt/assets/media/general/logoamatoscar.webp" height="50px" />
                        </a>
                    </div>

                    <!-- Center Column -->
                    <div class="col-4 text-white text-center">
                        <input placeholder="Insira o nome" class="text-center" id="search-input">
                    </div>

                    <!-- Right Column -->
                    <div class="col text-white text-end">

                        <!-- Row with download button and concession dropdown -->
                        <div class="row align-items-center">

                            <!-- Download Button -->
                            <div class="col">
                                <button type="button" id="download-button">Download PDF</button>
                            </div>

                            <!-- Concession list select dropdown -->
                            <div class="col">
                                <select id="concession-select">
                                    <option value="all" selected>Todas as concessões</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Users Table -->
    <table class="table text-center align-middle" id="users-table">
        <!-- Table head with columns name -->
        <thead class="text-dark align-items-center">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Concessão</th>
                <th scope="col">Função</th>
                <th scope="col">QRCode</th>
            </tr>
        </thead>

        <!-- Table body that will be populated -->
        <tbody id="users-tbody"></tbody>
    </table>

    <!-- Script -->
    <script>
        const users = <?php include 'db/fetch_users.php' ?>; // Grab all the users from database
        const concessions = []; // Concessions array

        // Grab elements by ID
        const concessionSelect = document.getElementById('concession-select');
        const tbody = document.getElementById('users-tbody');
        const searchInput = document.getElementById('search-input');
        const downloadButton = document.getElementById('download-button');

        // Loop through the users array to populate the concessions array
        for (const user of users) {
            if (!concessions.includes(user.CONCESSAO)) {
                concessions.push(user.CONCESSAO); // push concessions to array
            }
        }

        // Loop to populate concessions select options
        for (const concession of concessions) {
            var option = document.createElement('option');
            option.textContent = concession;
            option.value = concession;
            concessionSelect.appendChild(option) // Add concession option to select list
        }

        // Iterate users array to filtered users
        let filteredUsers = [...users];

        // Function to update and populate the table
        const updateTable = () => {
            // Clear the table body
            tbody.innerHTML = '';

            // Loop to populate row in the users table
            filteredUsers.forEach(user => {
                const tr = document.createElement('tr');
                tr.className = 'table-row'
                tr.innerHTML = `
                    <td>${user.NAME}</td>
                    <td>${user.CONCESSAO}</td>
                    <td>${user.FUNCAO}</td>
                    <td><img src="${user.QRCODE}"></td>
                `;
                tbody.appendChild(tr); // Append user row to table body
            });
        }
        updateTable(); // Fetch all users initially

        // Call filteredUsers function when the concession select element changes
        concessionSelect.addEventListener('change', event => {
            const selectedConcession = event.target.value;
            if (selectedConcession === 'all') {
                // Fetch all users
                filteredUsers = [...users];
            } else {
                // Fetch only the users associated with the selected concession
                filteredUsers = users.filter(user => user.CONCESSAO === selectedConcession);
            }
            updateTable(); // Update the table
        });

        // Search input event listener on input event
        searchInput.addEventListener('input', event => {
            const searchQuery = event.target.value.trim().toLowerCase(); // Search query formated
            const selectedConcession = concessionSelect.value; // Grab the selected concession value

            // Condition to verify if search query matches selected concession
            if (searchQuery === '' && selectedConcession === 'all') {
                filteredUsers = [...users]; // Output all users
            } else if (searchQuery === '') {
                // Output all users associated with selected concession
                filteredUsers = users.filter(user => user.CONCESSAO === selectedConcession);
            } else if (selectedConcession === 'all') {
                // Output all users if no concession is selected
                filteredUsers = users.filter(user => user.NAME.toLowerCase().includes(searchQuery));
            } else {
                // Output only users with matching name and selected concession
                filteredUsers = users.filter(user => user.NAME.toLowerCase().includes(searchQuery) && user.CONCESSAO === selectedConcession);
            }

            updateTable(); // Update the table
        });

        // Event listener for download pdf button
        downloadButton.addEventListener('click', () => {
            window.print(); // Print the page to pdf
        })
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="scripts/index.js"></script>

</html>