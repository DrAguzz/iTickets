<?php
 $path = $_SERVER['REQUEST_URI'];

 if($path == "/"){
    include "frontend/login.php";
 }elseif($path == "/admin"){
    include "./admin/index.php";
 }else{
    echo "Not Found !!  Please double check your address again";
 }

?>