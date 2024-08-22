<?php
include('config.php');
session_start();

if(isset($_POST['register'])){
    $name=filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $nric=filter_input(INPUT_POST,'nric',FILTER_SANITIZE_NUMBER_INT);
    $nric = str_replace('-', '', $nric);
    $program=filter_input(INPUT_POST,'program',FILTER_SANITIZE_SPECIAL_CHARS);
    $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $nrtel=filter_input(INPUT_POST,'nrtel',FILTER_SANITIZE_NUMBER_INT);
    $nrtel = str_replace('-', '', $nrtel);
  
    $name_father=filter_input(INPUT_POST,'name_father',FILTER_SANITIZE_SPECIAL_CHARS);
    $nrtel_father=filter_input(INPUT_POST,'nrtel_father',FILTER_SANITIZE_NUMBER_INT);
    $nrtel_father = str_replace('-', '', $nrtel_father);
    $name_mother=filter_input(INPUT_POST,'name_mother',FILTER_SANITIZE_SPECIAL_CHARS);
    $nrtel_mother=filter_input(INPUT_POST,'nrtel_mother',FILTER_SANITIZE_NUMBER_INT);
    $nrtel_mother = str_replace('-', '', $nrtel_mother);
  
    $checkAcc=mysqli_query($con,"SELECT * FROM users WHERE nric='$nric'");
  
    if(mysqli_num_rows($checkAcc)>0){
        echo"
        <script>
            window.location='../frontend/register.php';
        </script>
        ";
        $_SESSION['title']='Pendaftaran Gagal';
        $_SESSION['icon']='error';
        $_SESSION['text']='Akaun Telah Berdaftar';
    }else{
      $registerAcc=mysqli_query($con,"INSERT INTO users(name, nric, nrtel, email, id_program, name_father, nrtel_father, name_mother, nrtel_mother) VALUES (UPPER('$name'),'$nric','$nrtel','$email','$program',UPPER('$name_father'),'$nrtel_father',UPPER('$name_mother'),'$nrtel_mother')");
  
      if ($registerAcc) {
        echo"
        <script>
            window.location='../frontend/login.php';
        </script>
        ";
        $_SESSION['title']='Pendaftaran Berjaya';
        $_SESSION['icon']='success';
        $_SESSION['text']='Pendaftaran Berjaya';
      }else{
        echo"
        <script>
            window.location='../frontend/register.php';
        </script>
        ";
        $_SESSION['title']='Ralat';
        $_SESSION['icon']='error';
        $_SESSION['text']='Ralat. Sila cuba sebentar lagi';
        $_SESSION['location']='../frontend/register.php';
      }
    }
  }