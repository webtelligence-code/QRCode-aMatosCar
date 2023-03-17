<?php

// Define the database credentials
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "matoscarroot";
$db = "aMatosCar";

// Create a new mysqli object and establish a connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Close the connection using mysqli object's close() method
return $conn;;
