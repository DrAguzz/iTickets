<?php
session_start();
include('../include/config.php');
$get=$_REQUEST['id_admin'];

$_SESSION['title']='Berjaya';
$_SESSION['icon']='success';
$_SESSION['text']='Pentadbir berjaya dipadam.';
$_SESSION['location']='add_admin.php';
$query=mysqli_query($con,"DELETE FROM admin WHERE id_admin='$get'");
header('Location: add_admin.php');
?>