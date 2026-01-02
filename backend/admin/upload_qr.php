<?php
include('../config.php');
session_start();

if(isset($_POST['submit'])){

    $qr_name = mysqli_real_escape_string($con, $_POST['qr_name']);
    $admin_id = $_SESSION['id_user'];
    
    $qr_filename = null;
    
    if(isset($_FILES['qr_image']) && $_FILES['qr_image']['error'] == 0) {

        $allowed_types = ['jpg','jpeg','png'];
        $file_name = $_FILES['qr_image']['name'];
        $file_size = $_FILES['qr_image']['size'];
        $file_tmp  = $_FILES['qr_image']['tmp_name'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate extension
        if(!in_array($file_ext, $allowed_types)){
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Format fail tidak sah. Hanya JPG/PNG dibenarkan.';
            header("Location: ../../admin/dashboard.php"); exit();
        }

        // Validate size (2MB max)
        if($file_size > 2097152){
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Saiz fail terlalu besar. Maksimum 2MB.';
            header("Location: ../../admin/dashboard.php"); exit();
        }

        // Validate actual image
        if(!getimagesize($file_tmp)){
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Fail bukan gambar sah.';
            header("Location: ../../admin/dashboard.php"); exit();
        }

        // Unique filename
        $qr_filename = 'qrcode_' . time() . '.' . $file_ext;
        $upload_dir = '../../images/qrcodes/';

        if(!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

        $full_path = $upload_dir . $qr_filename;

        if(!move_uploaded_file($file_tmp, $full_path)){
            $_SESSION['title'] = 'Ralat';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Gagal upload fail. Semak permission folder.';
            header("Location: ../../admin/dashboard.php"); exit();
        }

        // **Delete all old QR images (keep default 'qrcode.jpeg')**
        $old_files = glob($upload_dir . '*');
        foreach($old_files as $file){
            if(is_file($file) && basename($file) != 'qrcode.jpeg' && basename($file) != $qr_filename){
                @unlink($file);
            }
        }

        // Insert into database
        $stmt = $con->prepare("INSERT INTO payment_qr (qr_image, qr_name, updated_by) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $qr_filename, $qr_name, $admin_id);

        if($stmt->execute()){
            $_SESSION['title'] = 'Berjaya!';
            $_SESSION['icon'] = 'success';
            $_SESSION['text'] = 'QR code berjaya dimuat naik dan lama dipadam!';
        } else {
            // Delete uploaded file if DB fail
            if(file_exists($full_path)) unlink($full_path);

            $_SESSION['title'] = 'Ralat Database';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Ralat menyimpan ke database: ' . $con->error;
        }

        $stmt->close();

    } else {
        $_SESSION['title'] = 'Ralat Upload';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Sila pilih gambar QR code.';
    }

    header("Location: ../../admin/dashboard.php");
    exit();

} else {
    header("Location: ../../admin/dashboard.php");
    exit();
}
?>
