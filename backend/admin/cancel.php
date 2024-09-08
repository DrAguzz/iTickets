<?php
session_start();
include('../config.php');
$path = "../..";
$get=$_REQUEST['id'];
$query=mysqli_query($con,"UPDATE tickets SET status='2' WHERE id_tkt='$get'");

if($query){
    $_SESSION['title']='Berjaya';
    $_SESSION['icon']='success';
    $_SESSION['text']='Penempahan berjaya dikemaskini.';
    $_SESSION['location']='dashboard.php';
    header('location: '.$path.'/admin/dashboard.php');

    exit();
}else{
    $_SESSION['title']='Gagal';
    $_SESSION['icon']='error';
    $_SESSION['text']='Penempahan gagal dikemaskini. Sila cuba sebentar lagi.';
    $_SESSION['location']='dashboard.php';
    header('location: '.$path.'/admin/dashboard.php');
    exit();
}

?>