<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode-aMatosCar</title>
    <link rel="icon" type="image" href="https://amatoscar.pt/assets/media/general/logoamatoscar.webp">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body>
    <table class="table text-center align-middle">
        <thead class="bg-m-orange text-light">
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Concessão</th>
                <th scope="col">Função</th>
                <th scope="col">QRCode</th>
            </tr>
        </thead>

        <?php
        include 'db/users.php';

        // Grab the custom array
        $data_array = fetchUsers();

        // Loop through the users in the custom array
        foreach ($data_array as $row) {
            echo '<tbody>';
                echo '<tr>';
                    echo '<td>' . $row['Nome'] . '</td>';
                    echo '<td>' . $row['Concessão'] . '</td>';
                    echo '<td>' . $row['Função'] . '</td>';
                    echo '<td><img src="' . $row['QRCode'] . '"></td>';
                echo '</tr>';
            echo '</tbody>';
        }
        ?>
    </table>
</body>
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</html>