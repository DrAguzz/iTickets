<?php
require('../backend/config.php');
session_start();
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
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <button type="button" class="btn btn-inverse-dark btn-rounded btn-icon">
                                <i class='bx bx-left-arrow-alt'></i>
                            </button>
                            <hr>
                            <div class="brand-logo text-center">
                                <img src="../images/icon.png" alt="logo">
                            </div>
                            <h4>Log Masuk</h4>
                            <form class="pt-3" action="../backend/login.php" method="post">
                                <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" placeholder="Alamat E-mel" required>
                                </div>
                                <div class="form-group">
                                <input type="password" class="form-control form-control-lg" name="nric" placeholder="No. Kad Pengenalan Tanpa (-)" required>
                                </div>
                                <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-secondary btn-lg font-weight-medium auth-form-btn" name="login">LOG MASUK</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                Pengguna baharu? <a href="register.php" class="text-secondary">Daftar</a>
                                </div>
                            </form>
                        </div>
                        <?php
                        include('../partials/_footer.php');
                        ?>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
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
