<?php
session_start();
include('../include/config.php');
include('../phpqrcode/qrlib.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


$get=$_REQUEST['id'];
$query1=mysqli_query($con,"SELECT * FROM tiket JOIN pelajar ON tiket.id_std=pelajar.id_std WHERE tiket.id_tkt='$get'");
$fetch=mysqli_fetch_array($query1);

// Your data and ID parameter
$text = 'heh';

// Set other options like error correction level and matrix point size
$errorCorrectionLevel = 'L'; // L, M, Q, H
$matrixPointSize = 10; // 1 to 10

// Generate QR code with ID parameter
    ob_start(); // Start output buffering to capture the image data
    QRcode::png($get, null, $errorCorrectionLevel, $matrixPointSize);
    $imageData = ob_get_clean(); // Get the buffered image data

    // Encode the image data to base64
    $base64Image = base64_encode($imageData);


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'muhammadsyahmi422@gmail.com';
    $mail->Password = 'jhes rclp ftzq erxj';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    
    $mail->setFrom('test@ticketease.com', 'TicketEase KVKS'); 

    $mail->addAddress($fetch['emel']);
    

    $mail->isHTML(true);

    $mail->Subject = "PENGESAHAN TIKET ".$fetch['nama_std'];
    $mail->Body =  "
    
    <div style=\"background-color: #a2b2ee; padding: 10px; font-family: arial;\">
        <center><h2>PENGESAHAN PEMBELIAN TIKET ".$fetch['nama_std']."</h2></center>
    </div>
    <div style=\"padding: 10px; font-family: arial;\">
        <center>
        <p><h3 style=\"color: green;\">TIKET ANDA TELAH DISAHKAN</h3></p>
        <p>Terima kasih kerana telah menggunakan TicketEaseKVKS.</p>
        </center>        
    </div>
    <div style=\"background-color: #a2b2ee; padding: 15px; font-family: arial;\">
        <center>
            <p>Berikut adalah maklumat untuk rujukan anda</p>
        </center>
        <div style=\"background-color: #5f7adb; padding: 10px; color: white;\">
            <center>
                <strong><p><h3>BUTIRAN</h3></p></strong>
            </center>
            <table cellpadding='5' border='0' style=\"width: 100%; color: white;\">
                <tr>
                    <th style=\"width: 50%;\">Id Tiket</th>
                    <th style=\"width: 50%;\">Id Bas</th>
                </tr>
                <tr>
                    <td><center>TE".$fetch['id_tkt']."</center></td>
                    <td><center>TEV".$fetch['id_vehicle']."</center></td>
                </tr>
            </table>
            <hr style=\"border: 2px solid #2e3239;\">
            <table cellpadding='5' border='0' style=\"width: 100%; color: white;\">
                <tr>
                    <th style=\"width: 50%;\">Nama</th>
                    <th style=\"width: 50%;\">No Telefon</th>
                </tr>
                <tr>
                    <td><center>".$fetch['nama_std']."</center></td>
                    <td><center>".$fetch['no_tel']."</center></td>
                </tr>
            </table>
            <hr style=\"border: 2px solid #2e3239;\">
            <table cellpadding='5' border='0' style=\"width: 100%; color: white;\">
                <tr>
                    <th style=\"width: 50%;\">Kaedah Pembayaran</th>
                    <th style=\"width: 50%;\">Jumlah Harga</th>
                </tr>
                <tr>
                    <td><center>".$fetch['method']."</center></td>
                    <td><center>RM 15.00</center></td>
                </tr>
            </table>
        </div>
        <br>
    </div>
    ";

    if ($mail->send()) {

        $_SESSION['title']='Berjaya';
        $_SESSION['icon']='success';
        $_SESSION['text']='Penempahan berjaya dikemaskini.';
        $_SESSION['location']='dashboard.php';
        $query=mysqli_query($con,"UPDATE tiket SET status='1', bil_tiket='1' WHERE id_tkt='$get'");
        header('Location: dashboard.php');
        exit();

    } else {
        $_SESSION['title']='Gagal';
        $_SESSION['icon']='error';
        $_SESSION['text']='Penempahan gagal dikemaskini. Sila cuba sebentar lagi.';
        $_SESSION['location']='dashboard.php';
        header('Location: dashboard.php');
        exit();
    }
?>