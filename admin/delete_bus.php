<?php
session_start();
include('../include/config.php');
$get=$_REQUEST['id'];

$_SESSION['title']='Berjaya';
$_SESSION['icon']='success';
$_SESSION['text']='Kenderaan berjaya dipadam.';
$_SESSION['location']='add_bus.php';
$query=mysqli_query($con, "DELETE FROM kenderaan  WHERE id_vehicle='$get'");
$query1=mysqli_query($con, "DELETE FROM tiket  WHERE id_vehicle='$get'");

header('Location: add_bus.php');
?>
