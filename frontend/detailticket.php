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
                            <h3 class="mb-0 font-weight-bold">Butiran Pembelian</h3>
                        </div>
                    </div>
                    <?php
                    $checkTkt = mysqli_query($con,"SELECT * FROM tickets JOIN users ON tickets.id_user = users.id_user JOIN vehicles ON tickets.id_vehicle = vehicles.id_vehicle WHERE users.id_user='$id'");
                    $getTkt = mysqli_fetch_array($checkTkt);
                    if($getTkt){
                    ?>
                    <div class="row mt-3">
                        <div class="col-xl-4 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3 text-muted">Status Pembelian</h4>
                                    </div>
                                    <div>
                                        <div class="mr-1">
                                            <h1 class="mb-2 mt-2 font-weight-bold">
                                                <?php
                                                if($getTkt['status'] == '0'){
                                                ?>
                                                <span class="text-warning">TERTUNGGAK</span>
                                                <?php
                                                }else if($getTkt['status'] == '1'){
                                                ?>
                                                <span class="text-success">SELESAI</span>
                                                <?php
                                                }else{
                                                ?>
                                                <span class="text-danger">BATAL</span>
                                                <?php
                                                }
                                                ?>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card" onclick="window.location='profile.php'">
                                <div class="card-body">
                                    <!-- <div class="d-flex flex-wrap justify-content-between">
                                    <h4 class="card-title mb-3">Butiran Pembelian</h4>
                                    </div> -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="text-muted col-2">Nama</th>
                                                    <td class="font-size-4"><?=$getTkt['name']?></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">No. Telefon</th>
                                                    <td class="font-size-4"><?=$getTkt['nrtel']?></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Tarikh Pembelian</th>
                                                    <td class="font-size-4"><?=date('d/m/Y', strtotime($getTkt['date']))?></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Kaedah Pembelian</th>
                                                    <td class="font-size-4"><?=$getTkt['method']?></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-muted">Status</th>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }else{
                    ?>
                    <div class="text-muted text-center mt-3">
                        <i class="typcn typcn-shopping-cart"  style="font-size: 100px;"></i><br>
                        Tiada pembelian dilakukan
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
