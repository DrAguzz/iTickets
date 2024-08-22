<?php
require('config.php');
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../frontend/login.php");
}else{
    $id=$_SESSION['id'];
    $getAcc=mysqli_query($con,"SELECT * FROM users JOIN programs ON users.id_program = programs.id_program WHERE users.id_user='$id'");
    $fetchAcc=mysqli_fetch_array($getAcc);
}
?>