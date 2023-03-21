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

// Include the database connection file
$conn = include 'connect.php';

// Create a prepared statement
$stmt = $conn->prepare("SELECT * FROM users ORDER BY CONCESSAO");

// Execute the statement
$stmt->execute();

// Bind the result variables
$stmt->bind_result($name, $concessao, $funcao);

// Create an array of users
$users = array();

while ($stmt->fetch()) {
    // Filename path
    $filename = 'assets/qrcodes/qrcode-' . $name . '-' . $concessao . '.png';

    // Check if the QR code image file already exists
    if (file_exists($filename)) {
        // Retrieve the data URI of the existing QR code image
        $dataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($filename));
    } else {
        // Grab the return value of generated QR code image
        $dataUri = generateQrCode($filename, $name);
    }

    // Specify user fields
    $user = array(
        "NAME" => $name,
        "CONCESSAO" => $concessao,
        "FUNCAO" => $funcao,
        "QRCODE" => $dataUri
    );

    array_push($users, $user); // push users to array
}

// Enconde the array as JSON and print it out
echo json_encode($users);

// Close connection
$conn->close();

/**
 * This function will generate a QR code image.
 * @param mixed $filename Receives the filepath of the QR code image.
 * @return string Return URI string of the QR code image.
 * @throws Exception 
 * @throws IllegalArgumentException 
 * @throws WriterException 
 * @throws InvalidArgumentException 
 */
function generateQrCode($filename, $name)
{
    // Initialize the writer
    $writer = new PngWriter();

    // Create QR code
    $qrCode = QrCode::create($name)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(125)
        ->setMargin(0)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));

    // Create generic logo
    $logo = Logo::create('https://amatoscar.pt/assets/media/general/logoamatoscar.webp')
        ->setResizeToWidth(75);

    // Create generic label
    $label = Label::create('')
        ->setTextColor(new Color(237, 99, 55));

    // Add logo and label to the QR code
    $qrCodeResult = $writer->write($qrCode, $logo, $label);

    // Save it to a file
    $qrCodeResult->saveToFile($filename);

    // REturn the generated QR Code URI
    return $qrCodeResult->getDataUri();
}
