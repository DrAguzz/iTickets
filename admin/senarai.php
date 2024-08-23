<?php
require('../backend/config.php');
include('../backend/redirectAdmin.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTicket KVKS</title>
    <link rel="shortcut icon" href="../images/icon.png" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
</head>
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .table, .table * {
            visibility: visible;
        }

        .table th:not(:first-child):not(:nth-child(2)):not(:nth-child(3)),
        .table td:not(:first-child):not(:nth-child(2)):not(:nth-child(3)) {
            display: none;
        }

        .table {
            position: relative;
            top: 0;
            left: 0;
        }
    
    }
</style>

<body class="bg-light pt-4">
    <?php
    include('../partials/_navbarAdmin.php');
    ?>

    <div class="container-fluid">
        <span class="text-dark fw-bold fs-2">Senarai Pembeli</span>
        <br><br>
        <button class="btn btn-primary" onclick="window.print()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
            </svg>
            Cetak Senarai Pembeli
        </button>
        <button class="btn btn-info text-white" onclick="window.location='report.php'">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
            </svg>
            Muat Turun CSV
        </button>
        <br><br>
        <div class='rounded-1 bg-white p-2 shadow-sm table-responsive'>
            <table id="dataTableList" class="table printable">
                <thead>
                    <tr>
                        <th>BIL</th>
                        <th>NAMA</th>
                        <th>NO. TELEFON</th>
                        <th>INFO</th>
                        <th>BATAL</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $bil = '1';
                $query = mysqli_query($con, "SELECT * FROM tickets 
                                            JOIN users ON tickets.id_user = users.id_user
                                            WHERE tickets.status='1'");
                                            
                while($row = mysqli_fetch_array($query)) {
                ?>
                
                    <tr>
                        <th><?php echo $bil++ ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['nrtel'] ?></td>
                        <td>
                            <a href="butiran.php?id=<?= $row['id_user']; ?>" class="btn btn-info">
                                <i class='bx bxs-user-detail fs-5 text-light'></i>
                            </a>
                        </td>
                        <td>
                            <button class="btn btn-danger" id="cancel" data-id="<?= $row['id_tkt']; ?>">
                                <i class='bx bxs-x-square fs-5 text-light'></i>
                            </button>
                        </td>
                    </tr>
                
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <br><br>
        <?php include('footer.php'); ?>
    </div>
</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>new DataTable('#dataTableList');</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#cancel').click(function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Anda Pasti?',
            text: 'Tiket ini akan dibatalkan',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            confirmButtonColor: '#5453a6',
            cancelButtonText: 'Tidak',
            cancelButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'cancel.php?id='+id;
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
