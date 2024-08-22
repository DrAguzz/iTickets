<?php
include('../backend/config.php');
include('../backend/redirectAdmin.php');

// $msg="";

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
        }else{
            $_SESSION['title']='Gagal';
            $_SESSION['icon']='error';
            $_SESSION['text']='Kehadiran sudah ditanda';
        } 
    }else{
        $_SESSION['title']='Gagal';
        $_SESSION['icon']='error';
        $_SESSION['text']='ID tidak wujud';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketEase KVKS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
</head>

<body class="bg-light pt-4">
    <?php
    include('../partials/_navbarAdmin.php');
    ?>

    <div class="container-fluid">
        <span class="text-dark fw-bold fs-2">Pengesahan Tiket</span>
        <br><br>

        <div class="col-sm col-lg-4 bg-white p-3 rounded-2 shadow-sm">
            <form method="POST">
                <span class="">Masukkan ID tiket</span>
                <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control" placeholder="ID Tiket" aria-describedby="button-addon2" name="id" required>
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2" name="validate">
                        <i class='bx bxs-coupon fs-5'></i>
                    </button>
                </div>
            </form>
            <hr>
            
            <!-- <button class="btn btn-primary w-100 mt-2">
                <i class='bx bx-qr-scan'></i>
                Imbas QR Code
            </button> -->
        </div>
        
         <div class="rounded-1 bg-white p-2 shadow-sm table-responsive mt-4">
            <table id="dataTableAttendance" class="table">
                <thead>
                    <tr>
                        <th>BIL</th>
                        <th>ID TIKET</th>
                        <th>NAMA</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $bil = '1';
                $query = mysqli_query($con, "SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user WHERE tickets.status='1'");
                
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $bil++;?></td>
                        <td><?php echo $row['id_tkt'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td>
                        <?php
                            if($row['attendance']=='1'){
                        ?>
                            <span class="alert alert-danger p-1">TIDAK HADIR</span>
                        <?php   
                            }else if($row['attendance']=='2'){
                        ?>
                            <span class="alert alert-success p-1">HADIR</span>
                        <?php
                            }
                        ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <br><br>
        <?php include('../partials/_footer.php'); ?>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>new DataTable('#dataTableAttendance');</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    <?php if (isset($_SESSION['title']) && $_SESSION['title'] != '') { ?>
        Swal.fire({
            confirmButtonColor: '#5453a6',
            title: '<?php echo $_SESSION['title']; ?>',
            text: '<?php echo $_SESSION['text']; ?>',
            icon: '<?php echo $_SESSION['icon']; ?>'
        });
    <?php }
    unset($_SESSION['title']); ?>
</script>

</html>
