<?php

declare(strict_types=1);

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

include 'connect.php';

// This function will fetch all the database users to an array.
function fetchUsers()
{
    $conn = OpenCon();

    // Prepare the query
    $sql = "SELECT * FROM users";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    $users = array();

    if (mysqli_num_rows($result) > 0) {
        // Assign data to an array
        while ($row = mysqli_fetch_assoc($result)) {

            $user = array(
                "Nome" => $row["NAME"],
                "Concessão" => $row["CONCESSAO"],
                "Função" => $row["FUNCAO"],
            );

            array_push($users, $user);
        }

        return $users;
    } else {
        // No records found
        printf("No record found on database. <br />");
    }

    // Close connection
    CloseCon($conn);
}
