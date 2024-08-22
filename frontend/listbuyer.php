<?php
require('../backend/config.php');
include('../backend/redirect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ITket KVKS</title>
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
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .table-container, .table-container, .table-container * {
            visibility: visible;
        }

        .table th:not(:first-child):not(:nth-child(2)):not(:nth-child(3)),
        .table td:not(:first-child):not(:nth-child(2)):not(:nth-child(3)) {
            display: none;
        }

        .table-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
    }
</style>
<body>
    <div class="container-scroller">

        <!-- partial:../../partials/_navbar.html -->
        <?php 
        include('../partials/_navbar.php');
        ?>
        <!-- partial -->

        <div class="container-fluid page-body-wrapper">

            <!-- partial:../../partials/_sidebar.html -->
            <?php 
            include('../partials/_sidebar.php');
            ?>
            <!-- partial -->
             
            <div class="main-panel">        
                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0 font-weight-bold">Senarai Penumpang</h3>
                        </div>
                    </div>

                    <!-- <button type="button" class="btn btn-info btn-icon-text mt-3" onclick="window.print()">
                        Cetak
                        <i class="typcn typcn-printer btn-icon-append"></i>                                                                              
                    </button>
                    <button type="button" class="btn btn-info btn-icon-text mt-3">
                        Muat turun XLSX
                        <i class="typcn typcn-download-outline btn-icon-append"></i>                                                                              
                    </button> -->
                    
                    <?php
                    $fetchVehicle = mysqli_query($con, "SELECT * FROM vehicles");
                    while($getVehicle = mysqli_fetch_array($fetchVehicle)){
                    ?>
                    <div class="row table-container mt-3">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3">Penumpang <?=$getVehicle['type']?> (<?=date('d/m/Y', strtotime($getVehicle['date']))?>)</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">#</th>
                                                    <th>Nama</th>
                                                    <th>No. Telefon</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $fetchBuyer = mysqli_query($con, "SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user WHERE tickets.id_vehicle = '".$getVehicle['id_vehicle']."' AND tickets.status = '1'");
                                                while($getBuyer = mysqli_fetch_array($fetchBuyer)){
                                                ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td><?=$getBuyer['name']?></td>
                                                    <td><?=$getBuyer['nrtel']?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-icon m-1 cancel" data-id="<?=$getBuyer['id_tkt']?>">
                                                            <i class="typcn typcn-times"></i>
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
                    </div>   
                    <?php
                    }
                    ?>
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
    <!-- End custom js for this page-->
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
        new DataTable('.table');
    </script>
</html>
