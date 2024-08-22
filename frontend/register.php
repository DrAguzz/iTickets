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
<style>
    #step2{
        display: none;
    }
</style>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h4>Daftar Pengguna</h4>
                            <form class="pt-3" action="../backend/register.php" method="post">
                                <div class="step" id="step1"> 
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama Penuh" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="nric" placeholder="No. Kad Pengenalan" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control form-control-lg p-3 border-light" name="program" id="exampleFormControlSelect2" required>
                                            <option selected disabled value="">Program</option>
                                            <?php
                                            $getProgram=mysqli_query($con,"SELECT * FROM programs");
                                            while($fetchProgram=mysqli_fetch_array($getProgram)){
                                            ?>

                                            <option value="<?=$fetchProgram['id_program'];?>"><?=$fetchProgram['course'];?> - <?=$fetchProgram['year'];?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Alamat E-mel" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="nrtel" placeholder="No. Telefon" required>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-block btn-secondary btn-lg font-weight-medium auth-form-btn" onclick="nextStep(1)">SETERUSNYA</button>
                                    </div>
                                </div>
                                <div class="step" id="step2"> 
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="name_father" placeholder="Nama Penuh Bapa" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="nrtel_father" placeholder="No. Telefon Bapa" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="name_mother" placeholder="Nama Penuh Ibu" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" name="nrtel_mother" placeholder="No. Telefon Ibu" required>
                                    </div>
                                    <div class="mt-3">
                                        <center>
                                            <button type="button" style="width:49%;" class="btn btn-outline-secondary btn-lg" onclick="prevStep(2)">KEMBALI</button>
                                            <button type="submit" style="width:49%;" class="btn btn-secondary btn-lg" name="register">DAFTAR</button>
                                        </center>
                                    </div>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Sudah berdaftar? <a href="login.php" class="text-secondary">Log masuk</a>
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
    <!-- step -->
    <script>
    function nextStep(currentStep) {
    if (currentStep === 1) {
        var nama = document.getElementsByName('name')[0].value;
        var nokp = document.getElementsByName('nric')[0].value;
        var program = document.getElementsByName('program')[0].value;
        var emel = document.getElementsByName('email')[0].value;
        var no_tel = document.getElementsByName('nrtel')[0].value;

            
        if (nama === '' || nokp === '' || program === '' || emel === '' || no_tel === '') {
            return;
        }
    }
        document.getElementById('step' + currentStep).style.display = 'none';
        document.getElementById('step' + (currentStep + 1)).style.display = 'block';
    }

    function prevStep(currentStep) {
        document.getElementById('step' + currentStep).style.display = 'none';
        document.getElementById('step' + (currentStep - 1)).style.display = 'block';
    }
    </script>
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
        unset($_SESSION['title']); 
        ?>
    </script>
</html>
