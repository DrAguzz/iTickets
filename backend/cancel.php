<?php
session_start();
include('config.php');

$id=$_REQUEST['id'];
$query=mysqli_query($con,"UPDATE tickets SET status='2' WHERE id_tkt='$id'");

if($query){
    $_SESSION['title']='Berjaya';
    $_SESSION['icon']='success';
    $_SESSION['text']='Pembelian berjaya dikemaskini.';
    header('Location: ../frontend/statistic.php');
    exit();
}else{
    $_SESSION['title']='Gagal';
    $_SESSION['icon']='error';
    $_SESSION['text']='Pembelian gagal dikemaskini. Sila cuba sebentar lagi.';
    header('Location: statistic.php');
    exit();
}