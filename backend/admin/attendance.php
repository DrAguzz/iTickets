<?php
if(isset($_POST['validate'])){
    $id=$_POST['id'];

    $check=mysqli_query($con,"SELECT * FROM tickets WHERE id_tkt='$id'");

    if(mysqli_num_rows($check)){
        $review=mysqli_query($con,"SELECT * FROM tickets WHERE id_tkt='$id' AND attendance='1'");
        if(mysqli_num_rows($review)>0){
            $update=mysqli_query($con,"UPDATE tickets SET attendance='2' WHERE id_tkt='$id'");
            $_SESSION['title']='Berjaya';
            $_SESSION['icon']='success';
            $_SESSION['text']='Kehadiran berjaya ditanda';
            $_SESSION['location']='add_admin.php';
        }else{
            $_SESSION['title']='Gagal';
            $_SESSION['icon']='error';
            $_SESSION['text']='Kehadiran sudah ditanda';
            $_SESSION['location']='add_admin.php';

        } 
    }else{
        $_SESSION['title']='Gagal';
        $_SESSION['icon']='error';
        $_SESSION['text']='ID tidak wujud';
        $_SESSION['location']='add_admin.php';
    }
}
?>