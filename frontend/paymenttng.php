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
                        <div class="col-lg-5 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <img src="../images/qrcode.jpeg" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title mb-3">Pembayaran</h4>
                                    </div>
                                    <p class="card-description">
                                        Bukti pembayaran
                                    </p>
                                    <form action="../backend/paymenttng.php" method="post" >
                                        <div class="form-group">
                                        <label>Muat naik resit pembayaran</label>
                                            <input type="file" name="reciept" class="file-upload-default" required>
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled required>
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-secondary" type="button">Muat Naik</button>
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-secondary mt-3" name="submit">Hantar</button>
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
