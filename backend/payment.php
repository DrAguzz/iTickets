<?php
include('config.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

if(isset($_POST['submit'])){
    $id_user = $_POST['id_user'];
    $id_vehicle = $_POST['id_vehicle'];
    $method = $_POST['method'];
    $date = date('Y-m-d');

    // Fix auto-increment issue
    $get_max = mysqli_query($con, "SELECT MAX(id_tkt) as max_id FROM tickets");
    $max_row = mysqli_fetch_assoc($get_max);
    $next_id = ($max_row['max_id'] ?? 0) + 1;
    mysqli_query($con, "ALTER TABLE tickets AUTO_INCREMENT = $next_id");

    // Check if user already has ACTIVE ticket (status 0 or 1)
    $stmt_check = $con->prepare("SELECT * FROM tickets WHERE id_user = ? AND status IN ('0', '1') ORDER BY id_tkt DESC LIMIT 1");
    $stmt_check->bind_param("i", $id_user);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $checkPurchase = $result->fetch_assoc();

    // User already has active ticket
    if($checkPurchase){
        $_SESSION['title'] = 'Pembelian Gagal';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Anda sudah mempunyai tiket aktif. Setiap pelajar hanya dibenarkan membeli satu tiket sahaja.';
        
        header('Location: ../frontend/buyticket.php');
        exit();
    }

    // User doesn't have active ticket - proceed with purchase
    if($method == 'Touch n Go'){
        // Store in session for TNG payment page
        $_SESSION['id_user'] = $id_user;
        $_SESSION['id_vehicle'] = $id_vehicle;
        $_SESSION['method'] = $method;
        $_SESSION['date'] = $date;
        
        header('Location: ../frontend/paymenttng.php');
        exit();
        
    } else if($method == 'Tunai'){
        // Insert cash ticket with status '0' (pending approval)
        $stmt = $con->prepare("INSERT INTO tickets (id_user, id_vehicle, method, date, status, attendance) VALUES (?, ?, ?, ?, '0', '1')");
        $stmt->bind_param("iiss", $id_user, $id_vehicle, $method, $date);
        
        if ($stmt->execute()) {
            $last_id_tkt = $con->insert_id;
            
            // Get user and vehicle info
            $stmt2 = $con->prepare("SELECT tickets.*, users.*, vehicles.* 
                                    FROM tickets 
                                    JOIN users ON tickets.id_user = users.id_user 
                                    LEFT JOIN vehicles ON tickets.id_vehicle = vehicles.id_vehicle 
                                    WHERE tickets.id_tkt = ?");
            $stmt2->bind_param("i", $last_id_tkt);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $getTicket = $result->fetch_assoc();

            if($getTicket){
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'erfanbagus06@gmail.com';
                    $mail->Password = 'echfgegaxlgadryo';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom('erfanbagus06@gmail.com', 'ITket KVKS');

                    // ============================================
                    // EMAIL 1: Customer Confirmation (Pending)
                    // ============================================
                    $mail->addAddress($getTicket['email']);
                    $mail->isHTML(true);
                    $mail->Subject = "Permohonan Tiket Tunai - Menunggu Pengesahan";
                    
                    $customerBody = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; line-height: 1.6; }
                            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                            .header { background: #5453a6; color: white; padding: 20px; text-align: center; }
                            .content { padding: 20px; background: #f9f9f9; }
                            .info-box { background: white; padding: 15px; margin: 10px 0; border-left: 4px solid #5453a6; }
                            .pending { background: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0; }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h2>ITket KVKS</h2>
                                <p>Permohonan Tiket Diterima</p>
                            </div>
                            <div class='content'>
                                <p>Salam " . htmlspecialchars($getTicket['name']) . ",</p>
                                <p>Terima kasih kerana menggunakan ITket KVKS. Permohonan tiket tunai anda telah diterima.</p>
                                
                                <div class='info-box'>
                                    <strong>Maklumat Tiket:</strong><br>
                                    ID Tiket: #" . htmlspecialchars($getTicket['id_tkt']) . "<br>
                                    Tarikh: " . date('d/m/Y', strtotime($getTicket['date'])) . "<br>
                                    Kaedah Bayaran: Tunai<br>
                                    Kenderaan: " . htmlspecialchars($getTicket['type'] ?? 'N/A') . "
                                </div>
                                
                                <div class='pending'>
                                    <strong>⏳ Status: MENUNGGU PENGESAHAN</strong><br>
                                    Permohonan tiket anda sedang disemak oleh pihak yang terlibat. Anda akan menerima email pengesahan dalam tempoh 1-2 hari bekerja.
                                    <br><br>
                                    <strong>Penting:</strong> Pembayaran hendaklah diberikan kepada bendahari majlis perwakilan pelajar sesegera mungkin.
                                </div>
                                
                                <p>Jika ada sebarang pertanyaan, sila hubungi kami.</p>
                            </div>
                        </div>
                    </body>
                    </html>
                    ";
                    
                    $mail->Body = $customerBody;
                    $mail->send();

                    // ============================================
                    // EMAIL 2: Admin Notification
                    // ============================================
                    $mail->clearAddresses();
                    
                    $admin_email = 'erfanbagus06@gmail.com'; // TUKAR KE EMAIL ADMIN
                    $mail->addAddress($admin_email);
                    
                    $mail->Subject = "PERMOHONAN TIKET TUNAI #" . $getTicket['id_tkt'] . " - " . htmlspecialchars($getTicket['name']);
                    
                    $adminBody = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; line-height: 1.6; }
                            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                            .header { background: #ffc107; color: #333; padding: 20px; text-align: center; }
                            .content { padding: 20px; background: #f9f9f9; }
                            .info-row { background: white; padding: 10px; margin: 5px 0; }
                            .label { font-weight: bold; color: #333; display: inline-block; width: 150px; }
                            .action-box { background: #d4edda; border: 1px solid #c3e6cb; padding: 15px; margin: 20px 0; border-radius: 5px; }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h2>💰 Permohonan Tiket Tunai Baru</h2>
                                <p>Memerlukan Pengesahan</p>
                            </div>
                            <div class='content'>
                                <h3>Maklumat Pelajar:</h3>
                                <div class='info-row'>
                                    <span class='label'>ID Tiket:</span> #" . htmlspecialchars($getTicket['id_tkt']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Nama:</span> " . htmlspecialchars($getTicket['name']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Email:</span> " . htmlspecialchars($getTicket['email']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>No. Telefon:</span> " . htmlspecialchars($getTicket['nrtel']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Kaedah Bayaran:</span> <strong>TUNAI</strong>
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Tarikh:</span> " . date('d/m/Y', strtotime($getTicket['date'])) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Kenderaan:</span> " . htmlspecialchars($getTicket['vname'] ?? 'N/A') . "
                                </div>
                                
                                <div class='action-box'>
                                    <strong>📋 Tindakan Diperlukan:</strong><br>
                                    Sila semak dan sahkan permohonan tiket tunai ini melalui sistem admin.
                                    <br><br>
                                    Pelajar akan membayar secara tunai kepada ahli majlis perwakilan pelajar selepas tiket diluluskan.
                                </div>
                            </div>
                        </div>
                    </body>
                    </html>
                    ";
                    
                    $mail->Body = $adminBody;
                    $mail->send();

                } catch (Exception $e) {
                    error_log("Mail Error: " . $mail->ErrorInfo);
                }
            }
            
            $_SESSION['title'] = 'Permohonan Dihantar';
            $_SESSION['icon'] = 'info';
            $_SESSION['text'] = 'Permohonan tiket tunai anda telah dihantar. Sila tunggu pengesahan daripada admin. Anda akan menerima email selepas tiket diluluskan.';
            
            header('Location: ../frontend/dashboard.php');
            exit();
        } else {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Ralat database: ' . $con->error;
            
            header('Location: ../frontend/buyticket.php');
            exit();
        }
    }
} else {
    header('Location: ../frontend/buyticket.php');
    exit();
}
?>