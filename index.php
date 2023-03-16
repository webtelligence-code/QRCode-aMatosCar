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
    <?php 
        include "db/users.php"; // This will include all users functions

        fetchUsers(); // fetch users from database
    ?>
</body>
</html>