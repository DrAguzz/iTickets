<?php
require('../backend/config.php');
include('../backend/redirectAdmin.php');

//fetch admin data
$query=mysqli_query($con,"SELECT * FROM admin WHERE id_admin='$id'");
$fetch=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTicket KVKS</title>
    <link rel="shortcut icon" href="../images/icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
</head>
<body class="bg-light pt-4">
    <?php
    include('../partials/_navbarAdmin.php');
    ?>
   
    <div class="container-fluid">
        <span class="text-dark fw-bold fs-2">Tambah Bas/Van</span>
        <br><br>
        <div class="row p-3 d-flex justify-content-center">
            <div class="col-xl-5 container border bg-white p-2 rounded-3 mb-3 shadow-sm">
                <br>
                <form method="POST" action="../backend/admin/add_bus.php">
                    <div class="row">
                        <div class="col mb-2"> 
                            <label class="form-label">Kenderaan</label>
                            <select name="jenis" class="form-select" required>
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="Bas">Bas</option>
                                <option value="Van">Van</option>
                            </select>
                        </div>
                        <div class="col mb-2"> 
                            <label class="form-label">Tarikh</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <center>
                        <button type="submit" name="tambah" class="btn btn-primary rounded-2 mt-3 p-2" style="width: 100%;">Tambah</button>
                    </center>
                </form>
            </div>
            <div class="col-xl-5 container border bg-white p-2 rounded-3 mb-3 shadow-sm table-responsive">
            <table id="dataTableVehicle" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>JENIS</th>
                        <th>TARIKH</th>
                        <th>TIKET</th>
                        <th>TAMBAH PENUMPANG</th>
                        <th>PADAM</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query=mysqli_query($con,"SELECT * FROM vehicles");
                while($data=mysqli_fetch_array($query)){

                    $query1=mysqli_query($con, "SELECT COUNT(id_tkt) AS bil_tiket FROM tickets WHERE id_vehicle =".$data['id_vehicle']);
                    $fetch1=mysqli_fetch_array($query1);
                ?>
                    <tr>
                        <td><?=$data['id_vehicle']?></td>
                        <td><?=$data['type']?></td>
                        <td><?=date('d/m/Y', strtotime($data['date']))?></td>
                        <td><?=$fetch1['bil_tiket'];?>/<?=$data['seat'];?></td>
                        <td class="text-center">
                            <a href="add_passenger.php?id=<?=$data['id_vehicle'];?>" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger delete" data-id="<?=$data['id_vehicle'];?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php 
                }
                ?>
                </tbody>
            </table>
        </div>
        </div>

        <br><br>
        <?php include('footer.php');?>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>new DataTable('#dataTableVehicle');</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.delete').click(function(e){
        const id = $(this).data('id');
        Swal.fire({
            title: 'Anda Pasti?',
            text: 'Kenderaan ini akan dipadam',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#5453a6',
            cancelButtonText: 'Tidak',
            cancelButtonColor: '#dc3545'
        }).then((result) =>{
            if(result.isConfirmed){
                window.location.href='delete_bus.php?id='+id;
            }
        });
    });
</script>
<script>
    <?php if (isset($_SESSION['title']) && $_SESSION['title'] != '') { ?>
        Swal.fire({
            confirmButtonColor: '#5453a6',
            title: '<?=$_SESSION['title']; ?>',
            text: '<?=$_SESSION['text']; ?>',
            icon: '<?=$_SESSION['icon']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
          window.location.href='<?=$_SESSION['location']?>';
        }
      });
    <?php }
    unset($_SESSION['title']); ?>
</script>

</html>