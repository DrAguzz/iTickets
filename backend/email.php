<?php
// session_start();
// include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


// $id=$_REQUEST['id'];
$fetchBuyer=mysqli_query($con,"SELECT * FROM tickets JOIN users ON tickets.id_user=users.id_user WHERE tickets.id_tkt='$id'");
$getBuyer=mysqli_fetch_array($fetchBuyer);

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
$mail->Host = 'erfanbagus06.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'erfanbagus06@gmail.com';
$mail->Password = 'echfgegaxlgadryo';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
    
$mail->setFrom('test@ticketease.com', 'ITket KVKS'); 

$mail->addAddress($getBuyer['email']);
    

$mail->isHTML(true);

$mail->Subject = "PENGESAHAN TIKET ".$getBuyer['name'];
$mail->Body =  $emailTemplate;

$mail->send();
?>