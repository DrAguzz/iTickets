<?php
session_start();
$path = "../..";
include('../config.php');
$id=$_REQUEST['id'];
$query = mysqli_query($con, "UPDATE tickets SET status='1', date=CURDATE() WHERE id_tkt='$id'");


if($query){
    include('success.php');
    $_SESSION['title']='Berjaya';
    $_SESSION['icon']='success';
    $_SESSION['text']='Pembelian berjaya dikemaskini.';
    header('location: '.$path.'/admin/dashboard.php');

    exit();
}else{
    $_SESSION['title']='Gagal';
    $_SESSION['icon']='error';
    $_SESSION['text']='Pembelian gagal dikemaskini. Sila cuba sebentar lagi.';
    header('location: '.$path.'/admin/dashboard.php');

    exit();
}