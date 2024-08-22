<?php
require('config.php');
session_start();

if(isset($_POST['login'])){
  $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
  $nric=filter_input(INPUT_POST,'nric',FILTER_SANITIZE_NUMBER_INT);

  $getCredential=mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND nric='$nric'");

  if(mysqli_num_rows($getCredential)>0){
    while($row=mysqli_fetch_assoc($getCredential)){
        $_SESSION['id']=$row['id_user'];
          
        echo"
        <script>
            window.location='../frontend/dashboard.php';
        </script>
        ";      
    }
  }else{
    $_SESSION['title']='Log Masuk Gagal';
    $_SESSION['icon']='error';
    $_SESSION['text']='E-mel atau No. Kad Pengenalan Tidak Sah';
    echo"
    <script>
        window.location='../frontend/login.php';
    </script>
    ";  
  }

}