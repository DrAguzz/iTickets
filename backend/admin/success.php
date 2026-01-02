<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';


$get=$_REQUEST['id'];
$query1=mysqli_query($con,"SELECT * FROM tickets JOIN users ON tickets.id_user=users.id_user WHERE tickets.id_tkt='$get'");
$fetch=mysqli_fetch_array($query1);

// Your data and ID parameter
$text = 'heh';

// Set other options like error correction level and matrix point size
$errorCorrectionLevel = 'L'; // L, M, Q, H
$matrixPointSize = 10; // 1 to 10

// Generate QR code with ID parameter
    ob_start(); // Start output buffering to capture the image data
    // QRcode::png($get, null, $errorCorrectionLevel, $matrixPointSize);
    $imageData = ob_get_clean(); // Get the buffered image data

    // Encode the image data to base64
    $base64Image = base64_encode($imageData);


    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'erfanbagus06@gmail.com';
    $mail->Password = 'echfgegaxlgadryo';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    $mail->setFrom('erfanbagus06@gmail.com', 'TicketEase KVKS'); 

    $mail->addAddress($fetch['email']);
    

    $mail->isHTML(true);

    $mail->Subject = "PENGESAHAN TIKET ".$fetch['name'];
    $mail->Body =  '
    
    <div style="background-color: #fff;
            margin: 0 auto;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;">
        <div style="background-color: #A96BAC;
            color: #fff;    
            padding: 10px;
            text-align: center;">
            <h2 style="margin: 0;">PENGESAHAN PEMBELIAN TIKET '.$fetch['name'].'</h2>
        </div>
        <div style="padding: 10px;">
            <center>
                <h3 style="color: #342338; margin: 0;">TIKET ANDA TELAH DISAHKAN</h3>
                <p>Terima kasih atas pembelian anda di ITket KVKS</p>
            </center>
        </div>
        <div style="background-color: #A96BAC;
            color: #fff;
            padding: 15px;
            margin: 10px 0;">
            <center><p>Berikut adalah maklumat untuk rujukan anda</p></center>
            <div style="background-color: #7F4E84;
            padding: 10px;
            color: white;">
                <center><strong><h4 style="margin: 0;">BUTIRAN PEMBELIAN</h4></strong></center>
                <center>
                    <p>ID Tiket</p>
                    <h1 style="margin: 0;">ITKT '.$fetch['id_tkt'].'</h1>
                    <hr style="border: 1px solid black #000;">
                    <table style="width: 80%; color: white; border-collapse: collapse;">
                        <tr>
                            <th style="text-align: left; padding: 5px; text-align: left; width: 50%;">Nama Pembeli</th>
                            <td style="text-align: right; padding: 5px; text-align: left width: 50%;">'.$fetch['name'].'</td>
                        </tr>
                    </table>
                    <hr style="border: 1px solid black #000;">
                    <table style="width: 80%; color: white; border-collapse: collapse;">
                        <tr>
                            <th style="text-align: left; padding: 5px; text-align: left; width: 50%;">No. Telefon</th>
                            <td style="text-align: right; padding: 5px; text-align: left; width: 50%;">'.$fetch['nrtel'].'</td>
                        </tr>
                    </table>
                    <hr  style="border: 1px solid #000;">
                    <table style="width: 80%; color: white; border-collapse: collapse;">
                        <tr>
                            <th style="text-align: left; padding: 5px; text-align: left; width: 50%;">Tarikh Pembelian</th>
                            <td style="text-align: right; padding: 5px; text-align: left; width: 50%;">'.$fetch['date'].'</td>
                        </tr>
                    </table>
                    <hr style="border: 1px solid black #000;">
                    <table style="width: 80%; color: white; border-collapse: collapse;">
                        <tr>
                            <th style="text-align: left; padding: 5px;
            text-align: left; width: 50%;">Kaedah Pembelian</th>
                            <td style="text-align: right; padding: 5px;
            text-align: left; width: 50%;">'.$fetch['method'].'</td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
        <div class="footer">
            '.include('../../partials/_footer.php').'
        </div>
    </div>
    ';

    if ($mail->send()) {

        $_SESSION['title']='Berjaya';
        $_SESSION['icon']='success';
        $_SESSION['text']='Penempahan berjaya dikemaskini.';
        $_SESSION['location']='dashboard.php';
        $query=mysqli_query($con,"UPDATE tickets SET status='1' WHERE id_tkt='$get'");
        header('location: '.$path.'/admin/dashboard.php');

        exit();

    } else {
        $_SESSION['title']='Gagal';
        $_SESSION['icon']='error';
        $_SESSION['text']='Penempahan gagal dikemaskini. Sila cuba sebentar lagi.';
        $_SESSION['location']='dashboard.php';
        header('location: '.$path.'/admin/dashboard.php');


        exit();
    }

?>