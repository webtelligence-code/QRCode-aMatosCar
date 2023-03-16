<?php

// Function to open connection
function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "matoscarroot";
    $db = "aMatosCar";

    // Create a connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);


    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connection successful! <br />";
    }

    return $conn;
}

// Function to close connection
function CloseCon($conn)
{
    $conn->close();
}
