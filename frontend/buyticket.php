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
                            <h3 class="mb-0 font-weight-bold">Pembelian Tiket</h3>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12 d-flex grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-between">
                                      <h4 class="card-title mb-3">KV Kuala Selangor <i class="typcn typcn-media-play"></i> MRT Sungai Buloh</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <?php
                                                $checkBus = mysqli_query($con, "SELECT * FROM vehicles");

                                                if (mysqli_num_rows($checkBus) > 0) {
                                                while ($fetchBus = mysqli_fetch_array($checkBus)) {
                                                $getSoldTicket = mysqli_query($con, "SELECT COUNT(amount) AS sold_tickets FROM tickets WHERE id_vehicle = " . $fetchBus['id_vehicle'] . " AND status != '2'");
                                                $fetchSoldTicket = mysqli_fetch_array($getSoldTicket);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div>
                                                                <div class="font-weight-bold"><?=$fetchBus['type']?></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Tarikh Bertolak
                                                        <div class="font-weight-bold mt-3"><?=date('d/m/Y', strtotime($fetchBus['date']))?></div>
                                                    </td>
                                                    <td>
                                                        Tempat Duduk
                                                        <div class="font-weight-bold mt-3">
                                                            <?php
                                                            $seat = $fetchBus['seat'];
                                                            $availableSeat = $seat - $fetchSoldTicket['sold_tickets'];
                                                            echo $availableSeat;
                                                            ?>
                                                            tersedia
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Harga
                                                        <div class="mt-3">RM <span class="font-weight-bold h3">15</span></div>
                                                          </>
                                                    <td>
                                                    <?php if ($availableSeat > 0): ?>
                                                            <button type="button" class="btn btn-sm btn-secondary" onclick="window.location='payment.php?id=<?=$fetchBus['id_vehicle']?>'">Beli</button>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-sm btn-danger" disabled>Penuh</button>
                                                    <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                  }
                                                } else {
                                                ?>
                                                <div class="text-muted text-center">
                                                    <i class="typcn typcn-times"  style="font-size: 100px;"></i><br>
                                                    Tiada bas/van disediakan
                                                </div>
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
