<?php
if(isset($_POST['submit'])){
    $nokp=$_POST['nokp'];
  
    $check=mysqli_query($con,"SELECT * FROM users WHERE nric='$nokp'");
  
    if(mysqli_num_rows($check)>0){
      $take=mysqli_fetch_array($check);
      $id_std=$take['id_user'];
      $check1=mysqli_query($con,"SELECT * FROM tickets WHERE id_tkt='$id_std'");
  
      if(mysqli_num_rows($check1)>0){
        $_SESSION['title']='Gagal Ditambah';
        $_SESSION['icon']='error';
        $_SESSION['text']='Pelajar sudah menempah tiket';
        $_SESSION['location']='add_bus.php';
      }else{
        $id=$_POST['id_vehicle'];
        $method=$_POST['method'];
        $query=mysqli_query($con,"INSERT INTO  tickets(id_vehicle, id_user, method) VALUES ('$id', '$id_std','$method')");
        $_SESSION['title']='Berjaya Ditempah';
        $_SESSION['icon']='success';
        $_SESSION['text']='Berjaya menambah penumpang';
        $_SESSION['location']='add_bus.php';
      }
    }else{
      $_SESSION['title']='Gagal';
      $_SESSION['icon']='error';
      $_SESSION['text']='Pelajar belum mendaftar TicketEase';
      $_SESSION['location']='add_bus.php';
    }
  }
?>