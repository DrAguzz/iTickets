<?php
include('../config.php');
session_start();


if(isset($_POST['submit'])){
    $qr_name = mysqli_real_escape_string($con, $_POST['qr_name']);
    $admin_id = $_SESSION['id_user'];
    
    // Handle file upload
    $qr_filename = null;
    
    if(isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png');
        $file_name = $_FILES['qr_image']['name'];
        $file_size = $_FILES['qr_image']['size'];
        $file_tmp = $_FILES['qr_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Validate file extension
        if(!in_array($file_ext, $allowed_types)) {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Format fail tidak sah. Hanya JPG dan PNG dibenarkan.';
            header("Location: ../../admin/dashboard.php");
            exit();
        }
        
        // Validate file size (2MB max)
        if($file_size > 2097152) {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Saiz fail terlalu besar. Maksimum 2MB.';
            header("Location: ../../admin/dashboard.php");
            exit();
        }
        
        // Validate it's actually an image
        $image_info = getimagesize($file_tmp);
        if($image_info === false) {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'File yang dipilih bukan gambar yang sah.';
            header("Location: ../../admin/dashboard.php");
            exit();
        }
        
        // Create unique filename - SAVE ONLY FILENAME
        $new_filename = 'qrcode_' . time() . '.' . $file_ext;
        
        // Physical upload directory (relative from this file)
        $upload_dir = '../../images/qrcodes/';
        
        // Create directory if not exists
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $full_path = $upload_dir . $new_filename;
        
        // Move uploaded file
        if(!move_uploaded_file($file_tmp, $full_path)) {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Gagal memuat naik fail. Sila semak permission folder.';
            header("Location: ../../admin/dashboard.php");
            exit();
        }
        
        // Save only filename in database
        $qr_filename = $new_filename;
        
    } else {
        $error_msg = 'Sila pilih gambar QR code.';
        if(isset($_FILES['qr_image']['error'])){
            switch($_FILES['qr_image']['error']){
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    $error_msg = 'File terlalu besar (melebihi had server)';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $error_msg = 'Tiada file dipilih';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $error_msg = 'Folder temporary tidak wujud';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $error_msg = 'Gagal menulis file ke disk';
                    break;
            }
        }
        $_SESSION['title'] = 'Ralat Upload';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = $error_msg;
        header("Location: ../../admin/dashboard.php");
        exit();
    }

    // Insert new QR code record - SAVE ONLY FILENAME
    if($qr_filename) {
        // Optional: Delete old physical files (keep only latest 3)
        $getOldQR = mysqli_query($con, "SELECT qr_image FROM payment_qr ORDER BY id DESC LIMIT 100 OFFSET 3");
        $upload_dir = '../../images/qrcodes/';
        while($oldQR = mysqli_fetch_array($getOldQR)){
            $old_file = $upload_dir . $oldQR['qr_image'];
            if(file_exists($old_file) && $oldQR['qr_image'] != 'qrcode.jpeg'){
                @unlink($old_file);
            }
        }
        
        $stmt = $con->prepare("INSERT INTO payment_qr (qr_image, qr_name, updated_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $qr_filename, $qr_name, $admin_id);
        
        if ($stmt->execute()) {
            $_SESSION['title'] = 'Berjaya!';
            $_SESSION['icon'] = 'success';
            $_SESSION['text'] = 'QR code berjaya dimuat naik dan dikemaskini!';
        } else {
            // Delete uploaded file if database insert fails
            $full_path = $upload_dir . $qr_filename;
            if(file_exists($full_path)){
                unlink($full_path);
            }
            
            $_SESSION['title'] = 'Ralat Database';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Ralat menyimpan ke database: ' . $con->error;
        }
    }
    
    header("Location: ../../admin/dashboard.php");
    exit();
} else {
    header("Location: ../../admin/dashboard.php");
    exit();
}
?>