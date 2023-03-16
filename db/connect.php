<?php 

    function OpenCon() {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "matoscarroot";
        $db = "aMatosCar";
        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
        
        if($mysqli->connect_errno) {
            printf("Connect falied: %s<br/>", $mysqli->connect_error);
            exit();
        }
        printf("Connected succesfully! <br/>");

        return $mysqli;
    }

    function CloseCon($conn) {
        $conn -> close();
    }
?>