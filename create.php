<?php
session_start();
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create']))
{
    $name        = $_POST['name'] ?? null;
    $surname     = $_POST['surname'] ?? null;
    $father_name = $_POST['fathers_name'] ?? null;
    $dob         = $_POST['dob'] ?? null;
    require_once './vendor/autoload.php'; // Include PHPWord library
//    require_once './vendor/phpoffice/phpword/bootstrap.php';

// Creating the new document...
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
    // Adding Text element with font customized inline...
    $section->addText(
        'Имя - '.$name,
        ['name' => 'Times New Roman', 'size' => 18,'color'=> '2c03fc']
    );
    $section->addText(
        'Фамилия – '.$surname,
        ['name' => 'Bahnschrift SemiBold Condensed', 'size' => 14,'color'=> 'fc0303','underline' => 'line']
    );
    $section->addText(
        'Отчество – '.$father_name,
        ['name' => 'Calibri', 'size' => 72,'color'=> 'ded5d5','bold'=>true,'italic'=>true]
    );
    $section->addText(
        'Дата рождения – '.$dob,
        ['name' => 'Times New Roman', 'size' => 8,'color'=> '07e80e','bold'=>true,'underline'=>'line','superScript' => true,'doubleStrikethrough'=>true]
    );

    // Create a writer for Word (docx)
    try {
        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
        echo $e->getMessage();
        exit();
    }

    $baseFileName =  generateRandomString(10);
    // Define the file name
    $filename = $baseFileName.'.docx';

    // Save the document to a file
    $writer->save($filename);

   // Set the appropriate headers to force a download
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    readfile($filename);
    header('Location: index.php');
    exit;
}else{
    header('Location: index.php');
    exit();
}


function generateRandomString($length = 10): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}