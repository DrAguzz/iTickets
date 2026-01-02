<?php
require('../backend/config.php');
include('../backend/redirect.php');

// Validate and sanitize ID
$idBus = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

if($idBus <= 0){
    header('Location: dashboard.php');
    exit();
}

// Use prepared statement
$stmt = $con->prepare("SELECT * FROM vehicles WHERE id_vehicle = ?");
$stmt->bind_param("i", $idBus);
$stmt->execute();
$result = $stmt->get_result();
$fetchStat = $result->fetch_assoc();

if(!$fetchStat){
    $_SESSION['title'] = 'Ralat';
    $_SESSION['icon'] = 'error';
    $_SESSION['text'] = 'Kenderaan tidak dijumpai';
    header('Location: dashboard.php');
    exit();
}

// Check if user already has active ticket
$stmt_check = $con->prepare("SELECT * FROM tickets WHERE id_user = ? AND status IN ('0', '1')");
$stmt_check->bind_param("i", $fetchAcc['id_user']);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$hasActiveTicket = $result_check->num_rows > 0;
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
                    <?php if($hasActiveTicket): ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-warning" role="alert">
                                <i class='bx bx-error-circle'></i>
                                <strong>Perhatian!</strong> Anda sudah mempunyai tiket aktif. Setiap pelajar hanya dibenarkan membeli satu tiket sahaja.
                            </div>
                            <a href="dashboard.php" class="btn btn-secondary">
                                <i class='bx bx-arrow-back'></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-lg-4 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <h4 class="card-title mb-3">Butiran</h4>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4 mt-3">
                                        <div>Pengangkutan</div>
                                        <div class="text-muted"><?=htmlspecialchars($fetchStat['type'])?></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>Nama</div>
                                        <div class="text-muted"><?=htmlspecialchars($fetchStat['type'])?></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>Tarikh Bertolak</div>
                                        <div class="text-muted"><?=date('d M Y', strtotime($fetchStat['date']))?></div>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="font-weight-bold">Jumlah</div>
                                        <div class="font-weight-bold">RM <?=number_format($fetchStat['price'] ?? 15, 2)?></div>
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
                                    <form action="../backend/payment.php" method="post" id="paymentForm">
    <input type="hidden" name="id_user" value="<?=$fetchAcc['id_user']?>">
    <input type="hidden" name="id_vehicle" value="<?=$idBus?>">
    
    <div class="card mb-3">
        <div class="card-body">
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="method" id="cash" value="Tunai" required style="width: 20px; height: 20px;">
                <label class="form-check-label ml-2" for="cash" style="font-size: 16px;">
                    <i class='bx bx-money' style="font-size: 24px; vertical-align: middle;"></i>
                    <strong>Tunai</strong>
                    <br>
                    <small class="text-muted ml-4">Bayar terus kepada pemandu bas</small>
                </label>
            </div>
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-body">
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="method" id="tng" value="Touch n Go" required style="width: 20px; height: 20px;">
                <label class="form-check-label ml-2" for="tng" style="font-size: 16px;">
                    <i class='bx bx-wallet' style="font-size: 24px; vertical-align: middle;"></i>
                    <strong>Touch n' Go</strong>
                    <br>
                    <small class="text-muted ml-4">Bayar melalui Touch n Go eWallet</small>
                </label>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-secondary btn-lg" name="submit">
        <i class='bx bx-check-circle'></i> Teruskan
    </button>
    <a href="dashboard.php" class="btn btn-light btn-lg ml-2">
        <i class='bx bx-x-circle'></i> Batal
    </a>
</form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
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
        function confirmPurchase() {
            const method = document.querySelector('input[name="method"]:checked');
            if(method && method.value === 'Tunai') {
                return confirm('Adakah anda pasti untuk membeli tiket tunai? Anda perlu membayar kepada pemandu bas.');
            }
            return true;
        }
    
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