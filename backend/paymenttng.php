<?php
include('config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

if(isset($_POST['submit'])){
    $id_user = $_SESSION['id_user'];
    $id_vehicle = $_SESSION['id_vehicle'];
    $method = $_SESSION['method'];
    $date = $_SESSION['date'];
    $reciept = $_POST['reciept'];

    $tktPurchase = mysqli_query($con, "INSERT INTO tickets (id_user, id_vehicle, method, reciept, date, status) VALUES ('$id_user', '$id_vehicle', '$method', '$reciept', '$date', '1')");

    if ($tktPurchase) {

        $fetchBuyer = mysqli_query($con, "SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user WHERE tickets.id_user = '$id_user'");
        $getBuyer = mysqli_fetch_array($fetchBuyer);

        $emailTemplate = file_get_contents('emailtemplate.php');

        $emailTemplate = str_replace('{{name}}', $getBuyer['name'], $emailTemplate);
        $emailTemplate = str_replace('{{id_tkt}}', $getBuyer['id_tkt'], $emailTemplate);
        $emailTemplate = str_replace('{{nrtel}}', $getBuyer['nrtel'], $emailTemplate);
        $emailTemplate = str_replace('{{method}}', $getBuyer['method'], $emailTemplate);
        $emailTemplate = str_replace('{{date}}', date('d/m/Y', strtotime($getBuyer['date'])), $emailTemplate);
        $emailTemplate = str_replace('{{currentdate}}', date('Y'), $emailTemplate);

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'muhammadsyahmi422@gmail.com';
        $mail->Password = 'jhes rclp ftzq erxj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('test@ticketease.com', 'ITket KVKS'); 
        $mail->addAddress($getBuyer['email']);

        $mail->isHTML(true);
        $mail->Subject = "PENGESAHAN TIKET " . $getBuyer['name'];
        $mail->Body = $emailTemplate;

        $mail->send();

        echo "
        <script>
            window.location='../frontend/dashboard.php';
        </script>
        ";
        $_SESSION['title'] = 'Berjaya Dibeli';
        $_SESSION['icon'] = 'success';
        $_SESSION['text'] = 'Terima kasih kerana menggunakan ITket KVKS';
    } else {
        echo "
        <script>
            window.location='../frontend/buyticket.php';
        </script>
        ";
        $_SESSION['title'] = 'Ralat';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Ralat. Sila cuba sebentar lagi';
    }
}
?>
