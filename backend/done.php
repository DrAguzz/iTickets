<?php
session_start();
include('config.php');

$id=$_REQUEST['id'];
$query=mysqli_query($con,"UPDATE tickets SET status='1' WHERE id_tkt='$id'");

if($query){
    include('email.php');
    $_SESSION['title']='Berjaya';
    $_SESSION['icon']='success';
    $_SESSION['text']='Pembelian berjaya dikemaskini.';
    header('Location: ../admin/dashboard.php');
    exit();
}else{
    $_SESSION['title']='Gagal';
    $_SESSION['icon']='error';
    $_SESSION['text']='Pembelian gagal dikemaskini. Sila cuba sebentar lagi.';
    header('Location: statistic.php');
    exit();
}