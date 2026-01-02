<?php
require('../backend/config.php');
include('../backend/redirect.php');

    $stmt_checkQr = $con->prepare(
        "SELECT * FROM payment_qr 
        ORDER BY id DESC 
        LIMIT 1"
    );


    $stmt_checkQr->execute();
    $result = $stmt_checkQr->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // guna data
        echo $row['qr_code'];
    } else {
        echo "Tiada QR";
    }


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
                                    <h5 class="card-title mb-3">QR Code Pembayaran</h5>
                                    <!-- qr code pembayaran  -->
                                    <img src="../images/qrcodes/<?= $row['qr_image'] ?>" class="w-100" alt="QR Code Touch n Go">
                                    <div class="mt-3">
                                        <p class="mb-1"><strong>Cara Bayar:</strong></p>
                                        <ol class="small">
                                            <li>Scan QR Code menggunakan Touch n Go eWallet</li>
                                            <li>Masukkan jumlah bayaran</li>
                                            <li>Buat pembayaran</li>
                                            <li>Screenshot atau save resit</li>
                                            <li>Upload resit di sebelah</li>
                                        </ol>
                                    </div>
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
                                        Muat naik bukti pembayaran anda
                                    </p>
                                    
                                    <!-- TAMBAH enctype untuk file upload -->
                                    <form action="../backend/paymenttng.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Muat naik resit pembayaran (JPG, PNG, PDF)</label>
                                            <input type="file" name="receipt" id="receipt" class="file-upload-default" accept="image/*,application/pdf" required>
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Pilih fail..." required>
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-secondary" type="button">Muat Naik</button>
                                                </span>
                                            </div>
                                            <small class="form-text text-muted">Maksimum saiz fail: 5MB</small>
                                        </div>
                                        
                                        <!-- Preview image -->
                                        <div id="imagePreview" class="mt-3" style="display: none;">
                                            <label>Preview:</label>
                                            <img id="preview" src="" class="img-fluid" style="max-height: 300px;">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-secondary mt-3" name="submit">
                                            <i class='bx bx-send'></i> Hantar
                                        </button>
                                        <a href="buyticket.php" class="btn btn-light mt-3">
                                            <i class='bx bx-arrow-back'></i> Kembali
                                        </a>
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
    
    <!-- Preview image script -->
    <script>
        // Preview image sebelum upload
        document.getElementById('receipt').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if(file.type.startsWith('image/')) {
                        document.getElementById('preview').src = e.target.result;
                        document.getElementById('imagePreview').style.display = 'block';
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    
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