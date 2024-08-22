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
    <!-- header icon -->
    <link rel="shortcut icon" href="../images/icon.png" />
</head>

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
                            <h3 class="mb-0 font-weight-bold">Dashboard</h3>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8 d-flex grid-margin stretch-card">
                            <div class="card" onclick="window.location='profile.php'">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3">Profil</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="text-muted">Nama</th>
                                                    <th class="font-size-4"><?=$fetchAcc['name']?></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">No. Telefon</th>
                                                    <th class="font-size-4"><?=$fetchAcc['nrtel']?></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Email</th>
                                                    <th class="font-size-4"><?=$fetchAcc['email']?></th>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Program</th>
                                                    <th class="font-size-4"><?=$fetchAcc['program']?></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex grid-margin stretch-card">
                            <div class="card" onclick="window.location='detailticket.php'">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3">Tiket Saya</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="d-flex justify-content-center mb-4 text-center">
                                                        <?php
                                                        $checkTkt = mysqli_query($con,"SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user JOIN vehicles ON tickets.id_vehicle = vehicles.id_vehicle WHERE users.id_user='$id'");
                                                        $getTkt = mysqli_fetch_array($checkTkt);
                                                        if($getTkt){
                                                        ?>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID Tiket</th>
                                                                        <th>Tarikh</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>ITKT<?=$getTkt['id_tkt'];?></td>
                                                                        <td><?=date('d/m/Y', strtotime($getTkt['date']))?></td>
                                                                        <?php
                                                                        if($getTkt['status'] == '0'){
                                                                        ?>
                                                                        <td><label class="badge badge-warning text-white">TERTUNGGAK</label></td> 
                                                                        <?php
                                                                        }else if($getTkt['status'] == '1'){
                                                                        ?>
                                                                        <td><label class="badge badge-success">SELESAI</label></td>
                                                                        <?php
                                                                        }else{
                                                                        ?>
                                                                        <td><label class="badge badge-danger">BATAL</label></td>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <?php
                                                            if($getTkt['status'] == '0'){
                                                            ?>
                                                            <div class="text-danger">* Sila langsaikan tunggakan.</div>
                                                            <?php   
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <div class="text-muted">
                                                            <i class=" typcn typcn-ticket" style="font-size: 100px;"></i><br>
                                                            Tiket akan muncul di sini setelah tersedia
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3">Pengangkutan</h4>
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
    <!-- End custom js for this page-->
    <!-- sweetalert -->
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
