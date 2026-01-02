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
    
    // ==========================================
    // HANDLE FILE UPLOAD
    // ==========================================
    $receipt_path = null;
    $upload_error = false;
    
    if(isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'pdf');
        $file_name = $_FILES['receipt']['name'];
        $file_size = $_FILES['receipt']['size'];
        $file_tmp = $_FILES['receipt']['tmp_name'];
        $file_type = $_FILES['receipt']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Validate file extension
        if(!in_array($file_ext, $allowed_types)) {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Format fail tidak sah. Hanya JPG, PNG, dan PDF dibenarkan.';
            header("Location: ../frontend/paymenttng.php");
            exit();
        }
        
        // Validate file size (5MB max)
        if($file_size > 5242880) {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Saiz fail terlalu besar. Maksimum 5MB.';
            header("Location: ../frontend/paymenttng.php");
            exit();
        }
        
        // Create unique filename
        $new_filename = 'receipt_' . $id_user . '_' . time() . '.' . $file_ext;
        $upload_dir = '../uploads/receipts/';
        
        // Create directory if not exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $receipt_path = $upload_dir . $new_filename;
        
        // Move uploaded file
        if(!move_uploaded_file($file_tmp, $receipt_path)) {
            $upload_error = true;
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Gagal memuat naik fail. Sila cuba lagi.';
            header("Location: ../frontend/paymenttng.php");
            exit();
        }
    } else {
        $_SESSION['title'] = 'Ralat';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Sila muat naik resit pembayaran.';
        header("Location: ../frontend/paymenttng.php");
        exit();
    }

    // ==========================================
    // INSERT INTO DATABASE
    // ==========================================
    if(!$upload_error && $receipt_path) {
        // Fix auto-increment
        $get_max = mysqli_query($con, "SELECT MAX(id_tkt) as max_id FROM tickets");
        $max_row = mysqli_fetch_assoc($get_max);
        $next_id = ($max_row['max_id'] ?? 0) + 1;
        mysqli_query($con, "ALTER TABLE tickets AUTO_INCREMENT = $next_id");

        // Insert with status '0' (pending approval)
        $stmt = $con->prepare("INSERT INTO tickets (id_user, id_vehicle, method, reciept, date, status, attendance) VALUES (?, ?, ?, ?, ?, '0', '1')");
        $stmt->bind_param("iisss", $id_user, $id_vehicle, $method, $receipt_path, $date);
        $tktPurchase = $stmt->execute();

        if ($tktPurchase) {
            $last_id_tkt = $con->insert_id;
            
            // Get buyer and vehicle info
            $stmt2 = $con->prepare("SELECT tickets.*, users.*, vehicles.* 
                                    FROM tickets 
                                    JOIN users ON tickets.id_user = users.id_user 
                                    LEFT JOIN vehicles ON tickets.id_vehicle = vehicles.id_vehicle 
                                    WHERE tickets.id_tkt = ?");
            $stmt2->bind_param("i", $last_id_tkt);
            $stmt2->execute();
            $result = $stmt2->get_result();
            $getBuyer = $result->fetch_assoc();

            if($getBuyer){
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
                    // EMAIL 1: Customer Confirmation
                    // ============================================
                    $mail->addAddress($getBuyer['email']);
                    $mail->isHTML(true);
                    $mail->Subject = "Permohonan Tiket Diterima - Menunggu Pengesahan";
                    
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
                                <p>Salam " . htmlspecialchars($getBuyer['name']) . ",</p>
                                <p>Terima kasih kerana menggunakan ITket KVKS. Permohonan tiket anda telah diterima.</p>
                                
                                <div class='info-box'>
                                    <strong>Maklumat Tiket:</strong><br>
                                    ID Tiket: #" . htmlspecialchars($getBuyer['id_tkt']) . "<br>
                                    Tarikh: " . date('d/m/Y', strtotime($getBuyer['date'])) . "<br>
                                    Kaedah Bayaran: " . htmlspecialchars($getBuyer['method']) . "
                                </div>
                                
                                <div class='pending'>
                                    <strong>⏳ Status: MENUNGGU PENGESAHAN</strong><br>
                                    Pembayaran anda sedang disemak oleh pihak pengurusan. Anda akan menerima email pengesahan dalam tempoh 1-2 hari bekerja.
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
                    // EMAIL 2: Admin/MPP Notification
                    // ============================================
                    $mail->clearAddresses();
                    $mail->clearAttachments();
                    
                    $mpp_email = 'erfanbagus06@gmail.com'; // TUKAR KE EMAIL MPP
                    $mail->addAddress($mpp_email);
                    
                    // Attach receipt
                    if(file_exists($receipt_path)){
                        $mail->addAttachment($receipt_path);
                    }
                    
                    $mail->Subject = "TIKET BARU #" . $getBuyer['id_tkt'] . " - " . htmlspecialchars($getBuyer['name']);
                    
                    $adminBody = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <style>
                            body { font-family: Arial, sans-serif; line-height: 1.6; }
                            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                            .header { background: #28a745; color: white; padding: 20px; text-align: center; }
                            .content { padding: 20px; background: #f9f9f9; }
                            .info-row { background: white; padding: 10px; margin: 5px 0; }
                            .label { font-weight: bold; color: #333; display: inline-block; width: 150px; }
                        </style>
                    </head>
                    <body>
                        <div class='container'>
                            <div class='header'>
                                <h2>🎫 Tiket Baru Memerlukan Pengesahan</h2>
                            </div>
                            <div class='content'>
                                <h3>Maklumat Pembeli:</h3>
                                <div class='info-row'>
                                    <span class='label'>ID Tiket:</span> #" . htmlspecialchars($getBuyer['id_tkt']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Nama:</span> " . htmlspecialchars($getBuyer['name']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Email:</span> " . htmlspecialchars($getBuyer['email']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>No. Telefon:</span> " . htmlspecialchars($getBuyer['nrtel']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Kaedah Bayaran:</span> " . htmlspecialchars($getBuyer['method']) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Tarikh:</span> " . date('d/m/Y', strtotime($getBuyer['date'])) . "
                                </div>
                                <div class='info-row'>
                                    <span class='label'>Kenderaan:</span> " . htmlspecialchars($getBuyer['type'] ?? 'N/A') . "
                                </div>
                                
                                <p style='margin-top: 20px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107;'>
                                    <strong>📎 Bukti Pembayaran:</strong> Sila semak fail yang dilampirkan.
                                </p>
                                
                                <p>Sila sahkan pembayaran melalui sistem admin.</p>
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

            $_SESSION['title'] = 'Berjaya Dihantar';
            $_SESSION['icon'] = 'success';
            $_SESSION['text'] = 'Permohonan tiket anda sedang dalam proses pengesahan. Anda akan menerima email selepas pembayaran disahkan.';
            
            header("Location: ../frontend/dashboard.php");
            exit();
            
        } else {
            // Delete uploaded file if database insert fails
            if(file_exists($receipt_path)){
                unlink($receipt_path);
            }
            
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Ralat database. Sila cuba lagi: ' . $con->error;
            
            header("Location: ../frontend/paymenttng.php");
            exit();
        }
    }
}
?>
