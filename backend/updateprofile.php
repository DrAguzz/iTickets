<?php
include('config.php');
session_start();

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $program=filter_input(INPUT_POST,'program',FILTER_SANITIZE_SPECIAL_CHARS);
    $nrtel=filter_input(INPUT_POST,'nrtel',FILTER_SANITIZE_NUMBER_INT);
    $nrtel = str_replace('-', '', $nrtel);
  
    $name_father=filter_input(INPUT_POST,'name_father',FILTER_SANITIZE_SPECIAL_CHARS);
    $nrtel_father=filter_input(INPUT_POST,'nrtel_father',FILTER_SANITIZE_NUMBER_INT);
    $nrtel_father = str_replace('-', '', $nrtel_father);
    $name_mother=filter_input(INPUT_POST,'name_mother',FILTER_SANITIZE_SPECIAL_CHARS);
    $nrtel_mother=filter_input(INPUT_POST,'nrtel_mother',FILTER_SANITIZE_NUMBER_INT);
    $nrtel_mother = str_replace('-', '', $nrtel_mother);
    
    $updateProfile=mysqli_query($con,"UPDATE users SET name='$name', id_program='$program', nrtel='$nrtel', name_father='$name_father', nrtel_father='$nrtel_father', name_mother='$name_mother', nrtel_mother='$nrtel_mother' WHERE id_user='$id'");

    if ($updateProfile) {
        echo"
        <script>
            window.location='../frontend/profile.php';
        </script>
        ";
        $_SESSION['title']='Kemaskini Berjaya';
        $_SESSION['icon']='success';
        $_SESSION['text']='Profil Telah Dikemaskini';
    }else{
        echo"
        <script>
            window.location='../frontend/profile.php';
        </script>
        ";
        $_SESSION['title']='Ralat';
        $_SESSION['icon']='error';
        $_SESSION['text']='Ralat. Sila cuba sebentar lagi';
        $_SESSION['location']='../frontend/register.php';
    }
  }