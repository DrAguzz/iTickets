<?php
include('../include/config.php');

$query = mysqli_query($con, "SELECT tiket.*, pelajar.*, program.*, kenderaan.*, kenderaan.date 
                             FROM tiket 
                             JOIN pelajar ON tiket.id_std = pelajar.id_std 
                             JOIN program ON pelajar.id_program = program.id_program 
                             JOIN kenderaan ON tiket.id_vehicle = kenderaan.id_vehicle 
                             WHERE tiket.status='1'");

require '../vendor/autoload.php';

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
    $activeWorksheet->setCellValue('A' . $num, $fetch['nama_std']);
    $activeWorksheet->setCellValue('B' . $num, $fetch['program']);
    $activeWorksheet->setCellValue('C' . $num, $fetch['no_kp']);
    $activeWorksheet->setCellValue('D' . $num, $fetch['no_tel']);
    $num++;
} while ($fetch = mysqli_fetch_array($query, MYSQLI_ASSOC));

$writer = new Xlsx($spreadsheet);
$writer->save($file);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $file . '"');
$writer->save("php://output");
?>


