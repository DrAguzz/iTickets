<?php
include('../backend/config.php');
include('../backend/redirectAdmin.php');
include("../backend/admin/add_admin.php");




//fetch admin data
$query=mysqli_query($con,"SELECT * FROM admin WHERE id_admin='$id'");
$fetch=mysqli_fetch_array($query);

// $msg="";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTicket KVKS</title>
    <link rel="shortcut icon" href="../images/icon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
</head>
<body class="bg-light pt-4">
    <?php
        include('../partials/_navbarAdmin.php');

    ?>
   
    <div class="container-fluid">
        <span class="text-dark fw-bold fs-2">Tambah Pentadbir</span>
        <br><br>
        <div class="row p-3 d-flex justify-content-center">
            <div class="col-xl-5 container border bg-white p-3 rounded-3 mb-3 shadow-sm">
                <!-- <center>
                    <img src="../image/admin.png" alt="" class="img w-25">
                    <br>
                    <span class="fs-3 fw-bold">Tambah Admin</span>
                </center>
                <br> -->
                <form method="POST">
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Nama Pengguna (Username)</label>
                            <input type="text" name="id" class="form-control" placeholder="Masukkan Nama Pengguna (Username)" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col"> 
                            <label class="form-label">Nama Penuh</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Penuh" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col"> 
                            <label class="form-label">No. Telefon</label>
                            <input type="text" name="notel" class="form-control" placeholder="Masukkan No. Telefon (tanpa -)" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col"> 
                            <label class="form-label">Peranan</label>
                            <select id="" name="role" class="form-select" required>
                                <option value="" selected disabled>Sila Pilih</option>
                                <option value="1">Exco Kebajikan Pelajar</option>
                                <option value="0">AMT Majlis Perwakilan Pelajar</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-6">
                            <label class="form-label">Kata Laluan</label>
                            <input type="password" name="ps" class="form-control" placeholder="Masukkan Kata Laluan" required>
                        </div>
                        <div class="col-xl-6">
                            <label class="form-label">Pastikan Kata Laluan</label>
                            <input type="password" name="cps" class="form-control" placeholder="Masukkan Kata Laluan" required>
                        </div>
                    </div>
                    <center>
                        <button type="submit" name="tambah" class="btn btn-primary rounded-2 mt-3 p-2" style="width: 100%;">Tambah</button>
                    </center>
                </div>
                <div class="col-xl-5 container border bg-white p-2 rounded-3 mb-3 shadow-sm table-responsive">
                    <table id="dataTableAdmin" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAMA</th>
                                <th>PERANAN</th>
                                <th>TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $query=mysqli_query($con,"SELECT * FROM admin");
                    while($data=mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?=$data['id_admin'];?></td>
                        <td><?=$data['nama'];?></td>
                        <td>
                            <?php
                            if($data['role']=='1'){
                                echo"Exco Kebajikan Pelajar";
                            }else if($data['role']=='2'){
                                echo"Majlis Perwakilan Pelajar";
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-danger delete" data-id="<?=$data['id_admin'];?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    </form>
                    <?php 
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <br><br>
        <?php include('../partials/_footerAdmin.php');?>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>new DataTable('#dataTableAdmin');</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.delete').click(function(e){
        const id = $(this).data('id');
        Swal.fire({
            title: 'Anda Pasti?',
            text: 'Pentadbir ini akan dipadam',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#5453a6',
            cancelButtonText: 'Tidak',
            cancelButtonColor: '#dc3545'
        }).then((result) =>{
            if(result.isConfirmed){
                window.location.href='../backend/admin/delete_admin.php?id_admin='+id;
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