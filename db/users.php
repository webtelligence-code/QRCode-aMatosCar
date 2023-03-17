<?php

// This function will fetch all the database users to an array.
function fetchUsers()
{
    // Include the database connection file
    $conn = include 'connect.php';

    // Include the phpqrcode library
    require_once 'qrcode/phpqrcode/qrlib.php';

    var_dump(class_exists('QRCode'));

    // Prepare the query
    $sql = "SELECT * FROM users";

    // Execute the query
    $result = $conn->query($sql);

    // Create an array of users
    $users = array();

    // Check if there are records on database
    if ($result->num_rows > 0) {
        // Loop through each record
        while ($row = mysqli_fetch_assoc($result)) {
            // Create a QR code message with the user's name
            $message = "Nome: " . $row['NAME'];

            // Generate a QR code image for the current user
            $qr_code_path = 'assets/qrcodes/' . $row['NAME'] . '.png';
            QRcode::png($message, $qr_code_path);

            // Get the data URI for the QR code image
            $qr_code_data_uri = 'data:image/png;base64,' . base64_encode(file_get_contents($qr_code_path));


            // Specify user fields
            $user = array(
                "Nome" => $row["NAME"],
                "Concessão" => $row["CONCESSAO"],
                "Função" => $row["FUNCAO"],
                "QRCode" => $qr_code_data_uri
            );

            array_push($users, $user); // push users to array
        }

        return $users; // return users array
    } else {
        // No records found
        printf("No record found on database. <br />");
    }

    // Close connection
    $conn->close();
}
