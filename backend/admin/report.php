<?php
include('../backend/config.php');

$query = mysqli_query($con, "SELECT tickets.*, users.*, programs.*, vehicles.*, vehicles.date 
                             FROM tickets 
                             JOIN users ON tickets.id_user = users.id_user 
                             JOIN programs ON users.id_program = programs.id_program 
                             JOIN vehicles ON tickets.id_vehicle = vehicles.id_vehicle 
                             WHERE tickets.status='1'");

if (!$query) {
    die('Error: ' . mysqli_error($con));
}

require "../vendors/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fetch the first row to get the date for the title
$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
$fileDate = isset($fetch['date']) ? date('d-m-Y', strtotime($fetch['date'])) : date('d-m-Y');

$file = 'LAPORAN PELAJAR PULANG(' . $fileDate . ').xlsx';
$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$activeWorksheet->setCellValue('A1', 'Nama');
$activeWorksheet->setCellValue('B1', 'Program');
$activeWorksheet->setCellValue('C1', 'No KP');
$activeWorksheet->setCellValue('D1', 'No Telefon');

$num = 2;
do {
    $activeWorksheet->setCellValue('A' . $num, $fetch['name']);
    $activeWorksheet->setCellValue('B' . $num, $fetch['course']);
    $activeWorksheet->setCellValue('C' . $num, $fetch['nric']);
    $activeWorksheet->setCellValue('D' . $num, $fetch['nrtel']);
    $num++;
} while ($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC));

$writer = new Xlsx($spreadsheet);
$writer->save($file);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file . '"');
$writer->save("php://output");
?>
