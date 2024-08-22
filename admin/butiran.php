<?php
require('../backend/config.php');
include('../backend/redirectAdmin.php');

$query=mysqli_query($con,"SELECT * FROM admin WHERE id_admin='$id'");
$fetch=mysqli_fetch_array($query);

$get=$_REQUEST['id'];
$query2=mysqli_query($con,"SELECT * FROM tickets JOIN users ON users.id_user - tickets.id_tkt JOIN programs ON users.id_user - programs.id_program WHERE users.id_user='$get'");
$fetch2=mysqli_fetch_array($query2); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketEase KVKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    body{
        font-family: quicksand;
        background-color: #dcdcdc;
    }
</style>
<body>
    <div class="container-fluid text-light sticky-top p-4" style="background-color: #5453a6;">
  	    <span class="fs-2 fw-bold">Butiran Penumpang</span>
	    <button class="btn bg-white text-dark float-lg-end" onclick="window.location='senarai.php'">Kembali</button>
    </div>
    <div class="container-fluid p-3">
        <div class="container col-md-12 col-lg-6 bg-light p-3 rounded-2 shadow align-middle table-responsive">
            <div class=" text-light p-3 w-100" style="background-color: #4e5180;">
                MAKLUMAT PERIBADI
            </div>
            <br>
         
            <table class="table">
                <tr>
                    <th class="col-3">Nama</th>
                    <td>:</td>
                    <td><?php echo $fetch2['name']?></td>
                </tr>
                <tr>
                    <th class="col-3">No. Kad Pengenalan</th>
                    <td>:</td>
                    <td><?php echo $fetch2['nric']?></td>
                </tr>
                <tr>
                    <th class="col-3">Program</th>
                    <td>:</td>
                    <td><?php echo $fetch2['program']?></td>
                </tr>
                <tr>
                    <th class="col-3">No. Telefon</th>
                    <td>:</td>
                    <td><?php echo $fetch2['nrtel']?></td>
                </tr>
                <tr>
                    <th class="col-3">E-mel</th>
                    <td>:</td>
                    <td><?php echo $fetch2['email']?></td>
                </tr>
            </table>

            <br>
            <div class="text-light p-3" style="background-color: #4e5180;">
                MAKLUMAT IBU BAPA
            </div>
            <br>

            <table class="table">
            `   <tr>
                    <th class="col-3">Nama Bapa</th>
                    <td>:</td>
                    <td><?php echo $fetch2['name_father']?></td>
                </tr>
                <tr>
                    <th class="col-3">No. Telefon Bapa</th>
                    <td>:</td>
                    <td><?php echo $fetch2['nrtel_father']?></td>
                </tr>
                <tr>
                    <th class="col-3">Nama Ibu</th>
                    <td>:</td>
                    <td><?php echo $fetch2['name_mother']?></td>
                </tr>
                <tr>
                    <th class="col-3">No. Telefon Ibu</th>
                    <td>:</td>
                    <td><?php echo $fetch2['nrtel_mother']?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</html>