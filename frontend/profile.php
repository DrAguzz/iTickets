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
                            <h3 class="mb-0 font-weight-bold">Profil</h3>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="card-title">Profil Saya</h4> -->
                                    <form class="form-sample" action="../backend/updateprofile.php" method="post">
                                        <p class="card-description">
                                        Maklumat Pelajar
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Nama Penuh</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="id" value="<?=$fetchAcc['id_user']?>">
                                                    <input type="text" class="form-control" name="name" value="<?=$fetchAcc['name']?>" required/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">No. Kad Pengenalan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" value="<?=$fetchAcc['nric']?>" readonly/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Program</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control p-3" name="program" required>
                                                            <option value="<?=$fetchAcc['id_program'];?>"><?=$fetchAcc['course'];?> - <?=$fetchAcc['year'];?></option>
                                                            <?php
                                                            $currentProgram = $fetchAcc['id_program'];
                                                            $getProgram=mysqli_query($con,"SELECT * FROM programs WHERE id_program != '$currentProgram'");
                                                            while($fetchProgram=mysqli_fetch_array($getProgram)){
                                                            ?>

                                                            <option value="<?=$fetchProgram['id_program'];?>"><?=$fetchProgram['course'];?> - <?=$fetchProgram['year'];?></option>

                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">No. Telefon</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="nrtel" value="<?=$fetchAcc['nrtel']?>" required/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Alamat E-mel</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" value="<?=$fetchAcc['email']?>" readonly/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="card-description">
                                        Maklumat Ibu Bapa
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Nama Penuh Bapa</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_father" value="<?=$fetchAcc['name_father']?>" required/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">No. Telefon Bapa</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="nrtel_father" value="<?=$fetchAcc['nrtel_father']?>" required/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Nama Penuh Ibu</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="name_mother" value="<?=$fetchAcc['name_mother']?>" required/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">No. Telefon Ibu</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="nrtel_mother" value="<?=$fetchAcc['nrtel_mother']?>" required/>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-secondary mb-2" name="update">Kemaskini</button>
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
