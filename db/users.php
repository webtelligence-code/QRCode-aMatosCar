<?php 
    include 'connect.php';    

    function fetchUsers() {
        $mysqli = OpenCon();

        $sql = "SELECT * FROM users";

        $result = $mysqli->query($sql);
        
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                printf(
                    "Nome: %s,Concessão: %s, Função: %s <br />",
                    $row["NAME"],
                    $row["CONCESSAO"],
                    $row["FUNCAO"],
                );
            }
        } else {
            printf("No record found on database. <br />");
        }
        mysqli_free_result($result);
        $mysqli->close();
    }
?>