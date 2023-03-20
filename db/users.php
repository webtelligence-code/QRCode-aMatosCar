<?php

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

require_once 'vendor/autoload.php';

function fetchUsers()
{
    // Include the database connection file
    $conn = include 'connect.php';

    $sql = "SELECT * FROM users";

    // Execute the query
    $result = $conn->query($sql);

    // Create an array of users
    $users = array();

    // Check if there are records on database
    if ($result->num_rows > 0) {
        // Loop through each record
        while ($row = mysqli_fetch_assoc($result)) {
            // Filename
            $filename = 'assets/qrcodes/qrcode-' . $row['NAME'] . '-' . $row['CONCESSAO'] . '.png';

            // Check if the QR code image file already exists
            if (file_exists($filename)) {
                // Retrieve the data URI of the existing QR code image
                $dataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($filename));
            } else {
                // Grab the return value of generated QR code image
                $dataUri = generateQrCode($filename);
            }

            // Specify user fields
            $user = array(
                "Nome" => $row["NAME"],
                "Concessão" => $row["CONCESSAO"],
                "Função" => $row["FUNCAO"],
                "QRCode" => $dataUri
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


// This function will fetch all the database users to an array.
function fetchUsersByCity($city)
{
    // Include the database connection file
    $conn = include 'connect.php';

    $sql = "SELECT * FROM users WHERE CONCESSAO = '$city'";

    // Execute the query
    $result = $conn->query($sql);

    // Create an array of users
    $users = array();

    // Check if there are records on database
    if ($result->num_rows > 0) {
        // Loop through each record
        while ($row = mysqli_fetch_assoc($result)) {
            // Filename
            $filename = 'assets/qrcodes/qrcode-' . $row['NAME'] . '-' . $row['CONCESSAO'] . '.png';

            // Check if the QR code image file already exists
            if (file_exists($filename)) {
                // Retrieve the data URI of the existing QR code image
                $dataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($filename));
            } else {
                // Grab the return value of generated QR code image
                $dataUri = generateQrCode($filename);
            }

            // Specify user fields
            $user = array(
                "Nome" => $row["NAME"],
                "Concessão" => $row["CONCESSAO"],
                "Função" => $row["FUNCAO"],
                "QRCode" => $dataUri
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

/**
 * This function will generate a QR code image.
 * @param mixed $filename Receives the filepath of the QR code image.
 * @return string Return URI string of the QR code image.
 * @throws Exception 
 * @throws IllegalArgumentException 
 * @throws WriterException 
 * @throws InvalidArgumentException 
 */
function generateQrCode($filename)
{
    // Initialize the writer
    $writer = new PngWriter();

    // Create QR code
    $qrCode = QrCode::create($filename)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(125)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));

    // Create generic logo
    $logo = Logo::create('https://amatoscar.pt/assets/media/general/logoamatoscar.webp')
        ->setResizeToWidth(75);

    // Create generic label
    $label = Label::create('')
        ->setTextColor(new Color(237, 99, 55));

    $qrCodeResult = $writer->write($qrCode, $logo, $label);

    // Save it to a file
    $qrCodeResult->saveToFile($filename);

    // REturn the generated QR Code URI
    return $qrCodeResult->getDataUri();
}