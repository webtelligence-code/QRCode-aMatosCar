<?php
include 'users.php';

var_dump($_GET);

if (isset($_GET['city'])) {
    $data_array = fetchUsersByCity($_GET['city']);
} else {
    $data_array = fetchUsers();
}

foreach ($data_array as $row) {
    echo '<tr>';
    echo '<td>' . $row['Nome'] . '</td>';
    echo '<td>' . $row['Concessão'] . '</td>';
    echo '<td>' . $row['Função'] . '</td>';
    echo '<td><img src="' . $row['QRCode'] . '"></td>';
    echo '</tr>';
}
?>