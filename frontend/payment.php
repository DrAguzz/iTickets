<?php
require('../backend/config.php');
include('../backend/redirect.php');
$idBus=$_REQUEST['id'];
$getStat=mysqli_query($con,"SELECT * FROM vehicles WHERE id_vehicle='$idBus'");
$fetchStat=mysqli_fetch_array($getStat);
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
                        <div class="col-lg-4 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title mb-3">Butiran</h4>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4  mt-3">
                                        <div>Pengangkutan</div>
                                        <div class="text-muted"><?=$fetchStat['type']?></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>Tarikh Bertolak</div>
                                        <div class="text-muted"><?=date('d M Y', strtotime($fetchStat['date']))?></div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="font-weight-bold">Jumlah</div>
                                        <div class="font-weight-bold">RM 15</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title mb-3">Pembayaran</h4>
                                    </div>
                                    <p class="card-description">
                                        Pilih kaedah pembayaran
                                    </p>
                                    <form action="../backend/payment.php" method="post">
                                        <div class="form-group row">
                                            <div class="col">
                                                <input type="hidden" name="id_user" value="<?=$fetchAcc['id_user']?>">
                                                <input type="hidden" name="id_vehicle" value="<?=$idBus?>">
                                                <div class="form-check form-check-secondary">
                                                    <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="Tunai" name="method" required>
                                                    Tunai
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-secondary">
                                                    <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" value="Touch n Go" name="method" required>
                                                    Touch n' Go
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-secondary mt-3" name="submit">Hantar</button>
                                            </div>
                                        </div>
                                    </form>
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
