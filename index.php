<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode-aMatosCar</title>
    <link rel="icon" type="image" href="https://amatoscar.pt/assets/media/general/logoamatoscar.webp">
</head>

<body>
    <table>
        <tr>
            <th>Nome</th>
            <th>Concessão</th>
            <th>Função</th>
            <th>QRCode</th>
        </tr>
        <?php
            include 'db/users.php';

            // Grab the custom array
            $data_array = fetchUsers();

            // Loop through the users in the custom array
            foreach ($data_array as $row) {
                echo '<tr>';
                echo '<td>' . $row['Nome'] . '</td>';
                echo '<td>' . $row['Concessão'] . '</td>';
                echo '<td>' . $row['Função'] . '</td>';
                echo '<td><img src="' . $row['QRCode'] . '"></td>';
                echo '</tr>';
            }
        ?>
    </table>

</body>

</html>