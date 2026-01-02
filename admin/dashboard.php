<?php
require('../backend/config.php');
include('../backend/redirectAdmin.php');

$fetchStat=mysqli_query($con,"SELECT COUNT(id_tkt) AS purchased_amount, SUM(amount) AS ticket_amount, COUNT(CASE WHEN status='1' THEN 1 END) AS done, COUNT(CASE WHEN status='2' THEN 1 END) AS cancel FROM tickets");
$getStat=mysqli_fetch_array($fetchStat);

// Get current QR code
$getQR = mysqli_query($con, "SELECT * FROM payment_qr ORDER BY id DESC LIMIT 1");
$currentQR = mysqli_fetch_array($getQR);

// Get pending count
$pendingCount = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) as total FROM tickets WHERE status='0'"))['total'];
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
    
    <style>
        .qr-preview {
            max-width: 100%;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background: white;
        }
        .stat-card {
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .qr-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .qr-card .card-body {
            padding: 20px;
        }
        .qr-info {
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
        }
    </style>
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
                            <h3 class="mb-0 font-weight-bold">Dashboard Admin</h3>
                            <p class="text-muted">Selamat datang ke sistem pengurusan tiket</p>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mt-3">
                        <div class="col-xl-3 d-flex grid-margin stretch-card">
                            <div class="card stat-card">
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
                            <div class="card stat-card">
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
                            <div class="card stat-card">
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
                            <div class="card stat-card">
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

                    <!-- QR Code Management Section -->
                    <div class="row">
                        <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card qr-card">
                                <div class="card-body">
                                    <h4 class="card-title text-white mb-3">
                                        <i class='bx bx-qr'></i> QR Code Pembayaran
                                    </h4>
                                    
                                    <?php if($currentQR): ?>
                                    <div class="text-center">
                                        <img src="../images/qrcodes/<?= $currentQR['qr_image'] ?>" class="qr-preview img-fluid" alt="Current QR Code">
                                    </div>
                                    <div class="qr-info">
                                        <p class="mb-2"><strong><?=htmlspecialchars($currentQR['qr_name'] ?? 'Touch n Go QR Code')?></strong></p>
                                        <small>Dikemaskini: <?=date('d/m/Y H:i', strtotime($currentQR['updated_at']))?></small>
                                    </div>
                                    <?php else: ?>
                                    <div class="alert alert-warning">
                                        <i class='bx bx-error-circle'></i> Tiada QR code. Sila muat naik QR code.
                                    </div>
                                    <?php endif; ?>
                                    
                                    <button type="button" class="btn btn-light btn-block mt-3" data-toggle="modal" data-target="#uploadQRModal">
                                        <i class='bx bx-upload'></i> <?=$currentQR ? 'Kemaskini' : 'Muat Naik'?> QR Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Tickets Summary -->
                        <div class="col-lg-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-0">Ringkasan Tiket Pending</h4>
                                        <span class="badge badge-warning badge-pill" style="font-size: 16px; padding: 8px 15px;">
                                            <?=$pendingCount?> Tiket
                                        </span>
                                    </div>
                                    
                                    <?php
                                    $recentPending = mysqli_query($con, "SELECT tickets.*, users.name, users.email 
                                                                         FROM tickets 
                                                                         JOIN users ON tickets.id_user = users.id_user 
                                                                         WHERE tickets.status = '0' 
                                                                         ORDER BY tickets.id_tkt DESC 
                                                                         LIMIT 5");
                                    
                                    if(mysqli_num_rows($recentPending) > 0):
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Kaedah</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($ticket = mysqli_fetch_array($recentPending)): ?>
                                                <tr>
                                                    <td>#<?=$ticket['id_tkt']?></td>
                                                    <td>
                                                        <?=htmlspecialchars($ticket['name'])?><br>
                                                        <small class="text-muted"><?=htmlspecialchars($ticket['email'])?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?=$ticket['method']=='Tunai'?'success':'info'?>">
                                                            <?=htmlspecialchars($ticket['method'])?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success btn-sm done" data-id="<?=$ticket['id_tkt']?>" title="Lulus">
                                                            <i class="typcn typcn-tick"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm cancel" data-id="<?=$ticket['id_tkt']?>" title="Tolak">
                                                            <i class="typcn typcn-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if($pendingCount > 5): ?>
                                    <div class="text-center mt-3">
                                        <a href="#dataTablePending" class="btn btn-primary btn-sm">
                                            Lihat Semua (<?=$pendingCount?> tiket)
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <?php else: ?>
                                    <div class="alert alert-info">
                                        <i class='bx bx-info-circle'></i> Tiada tiket menunggu pengesahan
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detailed Tables -->
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
                                                    <th>Kaedah</th>
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
                                                    <td><?=htmlspecialchars($getPending['name'])?></td>
                                                    <td>
                                                        <span class="badge badge-<?=$getPending['method']=='Tunai'?'success':'info'?>">
                                                            <?=htmlspecialchars($getPending['method'])?>
                                                        </span>
                                                        <?php if($getPending['method']=='Touch n Go' && !empty($getPending['reciept'])): ?>
                                                        <br>
                                                        <a href="<?=htmlspecialchars($getPending['reciept'])?>" target="_blank" class="badge badge-primary mt-1">
                                                            <i class='bx bx-receipt'></i> Resit
                                                        </a>
                                                        <?php endif; ?>
                                                    </td>
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
                                                    <th>Kaedah</th>
                                                    <th>Tarikh</th>
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
                                                    <td><?=htmlspecialchars($getCancel['name'])?></td>
                                                    <td>
                                                        <span class="badge badge-<?=$getCancel['method']=='Tunai'?'success':'info'?>">
                                                            <?=htmlspecialchars($getCancel['method'])?>
                                                        </span>
                                                    </td>
                                                    <td><?=date('d/m/Y', strtotime($getCancel['date']))?></td>
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

    <!-- Modal Upload QR Code -->
    <div class="modal fade" id="uploadQRModal" tabindex="-1" role="dialog" aria-labelledby="uploadQRModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <h5 class="modal-title" id="uploadQRModalLabel">
                        <i class='bx bx-qr'></i> <?=$currentQR ? 'Kemaskini' : 'Muat Naik'?> QR Code Pembayaran
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../backend/admin/upload_qr.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label><i class='bx bx-label'></i> Nama QR Code</label>
                            <input type="text" class="form-control" name="qr_name" value="<?=$currentQR ? htmlspecialchars($currentQR['qr_name']) : 'Touch n Go QR Code'?>" required>
                            <small class="form-text text-muted">Contoh: Touch n Go QR Code, QR Pembayaran KVKS</small>
                        </div>
                        <div class="form-group">
                            <label><i class='bx bx-image-add'></i> Pilih Gambar QR Code</label>
                            <input type="file" name="qr_image" class="form-control-file" accept="image/*" required id="qrImageInput">
                            <small class="form-text text-muted">Format: JPG, PNG. Maksimum 2MB</small>
                        </div>
                        <div id="qrPreview" class="text-center mt-3" style="display:none;">
                            <p><strong>Preview:</strong></p>
                            <img id="qrPreviewImg" src="" class="img-fluid qr-preview" style="max-width: 300px;">
                        </div>
                        
                        <?php if($currentQR): ?>
                        <div class="alert alert-info mt-3">
                            <i class='bx bx-info-circle'></i> QR code lama akan digantikan dengan yang baru
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class='bx bx-x'></i> Batal
                        </button>
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class='bx bx-upload'></i> Muat Naik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
        // Preview QR image before upload
        document.getElementById('qrImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (2MB)
                if(file.size > 2097152) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Saiz Fail Terlalu Besar',
                        text: 'Saiz maksimum adalah 2MB',
                        confirmButtonColor: '#5453a6'
                    });
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('qrPreviewImg').src = e.target.result;
                    document.getElementById('qrPreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    
        $('.done').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Sahkan Tiket?',
                text: 'Tiket ini akan diluluskan dan pengguna akan menerima email pengesahan',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Sahkan',
                confirmButtonColor: '#28a745',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../backend/admin/done.php?id='+id;
                }
            });
        });

        $('.cancel').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Batalkan Tiket?',
                text: 'Tiket ini akan dibatalkan dan pengguna akan menerima email',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Batalkan',
                confirmButtonColor: '#dc3545',
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../backend/admin/cancel.php?id='+id;
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