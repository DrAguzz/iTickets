<?php
include('../config.php');
$path = "../..";
session_start();
$get=$_REQUEST['id_admin'];

$_SESSION['title']='Berjaya';
$_SESSION['icon']='success';
$_SESSION['text']='Pentadbir berjaya dipadam.';
$_SESSION['location']= "add_admin.php";
$query=mysqli_query($con,"DELETE FROM admin WHERE id_admin='$get'");
header('location: '.$path.'/admin/add_admin.php');
?>