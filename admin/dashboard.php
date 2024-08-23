<?php
require('../backend/config.php');
include('../backend/redirectAdmin.php');

$fetchStat=mysqli_query($con,"SELECT COUNT(id_tkt) AS purchased_amount, SUM(amount) AS ticket_amount, COUNT(CASE WHEN status='1' THEN 1 END) AS done, COUNT(CASE WHEN status='2' THEN 1 END) AS cancel FROM tickets");
$getStat=mysqli_fetch_array($fetchStat);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>iTicket KVKS</title>
    <link rel="shortcut icon" href="../images/icon.png" />
    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
    <!-- boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
    <!-- data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- header icon -->
    <link rel="shortcut icon" href="../images/icon.png" />
</head>

<body>
    <div class="container-scroller">

        <!-- partial:../../partials/_navbar.html -->
        <?php 
        include('../partials/_navbarAdmin.php');
        ?>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">


            <!-- partial -->
             
            <div class="main-panel">        
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0 font-weight-bold">Statistik</h3>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-3 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-description mb-3 text-muted">Jumlah Pembelian</h4>
                                    </div>
                                    <div class="d-flex display-2 text-secondary justify-content-between">
                                        <div class="font-weight-medium"><?=$getStat['purchased_amount']?></div>
                                        <div><i class="typcn typcn-shopping-cart"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-description mb-3 text-muted">Jumlah Pendapatan</h4>
                                    </div>
                                    <div class="d-flex display-2 text-warning justify-content-between">
                                        <div class="font-weight-medium">RM <?=$getStat['ticket_amount']*15?></div>
                                        <div><i class="typcn typcn-chart-line"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-description mb-3 text-muted">Pembelian Selesai</h4>
                                    </div>
                                    <div class="d-flex display-2 text-success justify-content-between">
                                        <div class="font-weight-medium"><?=$getStat['done']?></div>
                                        <div><i class="typcn typcn-tick"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-description mb-3 text-muted">Pembelian Batal</h4>
                                    </div>
                                    <div class="d-flex display-2 text-danger justify-content-between">
                                        <div class="font-weight-medium"><?=$getStat['cancel']?></div>
                                        <div><i class="typcn typcn-times"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pembelian <span class="text-warning">Tertunggak</span></h4>
                                    <div class="table-responsive">
                                        <table id="dataTablePending" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">#</th>
                                                    <th>Nama</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no='1';
                                                $fetchPending=mysqli_query($con,"SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user WHERE tickets.status='0'");
                                                while($getPending=mysqli_fetch_array($fetchPending)){
                                                ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$getPending['name']?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-icon m-1 cancel" data-id="<?=$getPending['id_tkt']?>">
                                                            <i class="typcn typcn-times"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-icon m-1 done" data-id="<?=$getPending['id_tkt']?>">
                                                            <i class="typcn typcn-tick"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Pembelian <span class="text-danger">Batal</span></h4>
                                    <div class="table-responsive">
                                        <table id="dataTableCancel" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">#</th>
                                                    <th>Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no='1';
                                                $fetchCancel=mysqli_query($con,"SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user WHERE tickets.status='2'");
                                                while($getCancel=mysqli_fetch_array($fetchCancel)){
                                                ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$getCancel['name']?></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->

                <!-- partial:../../partials/_footer.html -->
                <?php
                include('../partials/_footer.php');
                ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
</body>
    <!-- base:js -->
    <script src="../vendors/js/vendor.bundle.base.js"></script>
    <!-- inject:js -->
    <script src="../js/off-canvas.js"></script>
    <script src="../js/hoverable-collapse.js"></script>
    <script src="../js/template.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/todolist.js"></script>
    <!-- plugin js for this page -->
    <script src="../vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="../vendors/select2/select2.min.js"></script>
    <!-- Custom js for this page-->
    <script src="../js/file-upload.js"></script>
    <script src="../js/typeahead.js"></script>
    <script src="../js/select2.js"></script>
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.done').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Anda Pasti?',
                text: 'Tiket ini akan disahkan',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                confirmButtonColor: '#5453a6',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../backend/done.php?id='+id;
                }
            });
        });

        $('.cancel').click(function() {
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
                    window.location.href = '../backend/cancel.php?id='+id;
                }
            });
        });
    </script>
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
    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#dataTablePending');
        new DataTable('#dataTableCancel');
    </script>
</html>
