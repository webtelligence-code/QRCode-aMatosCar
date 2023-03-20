<?php
include 'users.php';

if (isset($_GET['city'])) {
    $data_array = fetchUsersByCity($_GET['city']);
} else {
    $data_array = fetchUsers();
}

var_dump($_GET);

foreach ($data_array as $row) {
    echo '<tr>';
    echo '<td>' . $row['Nome'] . '</td>';
    echo '<td>' . $row['Concessão'] . '</td>';
    echo '<td>' . $row['Função'] . '</td>';
    echo '<td><img src="' . $row['QRCode'] . '"></td>';
    echo '</tr>';
}
?>