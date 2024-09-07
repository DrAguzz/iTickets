<?php
    include('../config.php');
    $path = "../..";
    if(isset($_POST['tambah'])){
        $jenis=$_POST['jenis'];
        $date=$_POST['date'];
    
        if($jenis=="Bas"){
            $seat='40';
        }else if($jenis=="Van"){
            $seat='10';
        }
    
        $query=mysqli_query($con, "INSERT INTO vehicles VALUES (NULL,'$jenis','$date','$seat')");
        header('location: '.$path.'/admin/add_bus.php');
    }
?>