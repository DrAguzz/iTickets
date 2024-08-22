<?php
require('config.php');
session_start();

if(!isset($_SESSION['id_admin'])){
    header("Location: ../admin/index.php");
}else{
    $id=$_SESSION['id_admin'];
    $queryAdmin=mysqli_query($con,"SELECT * FROM admin WHERE id_admin='$id'");
    $fetchAdmin=mysqli_fetch_array($queryAdmin);    
}
?>