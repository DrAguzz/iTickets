<?php
session_start();
$path = "../..";
include('../config.php');
$get=$_REQUEST['id'];

$_SESSION['title']='Berjaya';
$_SESSION['icon']='success';
$_SESSION['text']='Kenderaan berjaya dipadam.';
$_SESSION['location']='add_bus.php';
$query=mysqli_query($con, "DELETE FROM vehicles  WHERE id_vehicle='$get'");
$query1=mysqli_query($con, "DELETE FROM tickets  WHERE id_vehicle='$get'");

header('location: '.$path.'/admin/add_bus.php');

?>
