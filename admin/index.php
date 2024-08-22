<?php
include('../backend/config.php');
$msg="";
session_start();
    if(isset($_POST["login"])){
        $id = $_POST['id'];
        $password = $_POST['password'];
    
        if (empty($id) || empty($password)) {
            $_SESSION['title']='Gagal';
            $_SESSION['icon']='error';
            $_SESSION['text']='Sila Isi Form Terlebih Dahulu';
        }
    
        $stmt = $pdo->prepare('SELECT * FROM admin WHERE id_admin= :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
    
        if ($user && password_verify($password, $user['katalaluan'])) {
            $password = $user['katalaluan'];
            $_SESSION['id_admin']=$id;
    
            echo "
            <script>
            window.location.href='./dashboard.php?id=".$id."';
            </script>
            ";
        } else {
            $_SESSION['title']='Gagal';
            $_SESSION['icon']='error';
            $_SESSION['text']='Nama Pengguna atau Kata laluan anda salah';
        }
    }
?>
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketEase KVKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
</head>
<style>
    body{
        font-family: quicksand;
    }
</style>
<body style="background-color: #5453a6;">
    <div class="container border rounded-4 shadow-sm position-absolute top-50 start-50 translate-middle p-2 bg-white">
        <center>
            <img src="../images/logo.png" class="img-fluid w-25">
            <p class="fw-bold fs-4">Log Masuk Pentadbir</p>
        </center>
        <div class="row container p-3 d-flex justify-content-center">
            <div class="col-xl-5">
                <form method="POST">
                    <div class="mb-3">
                        <?php echo $msg;?>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="id" class="form-control" placeholder="Masukkan Nama Pengguna" required>
                        <label>Nama Pengguna</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Kata Laluan" required>
                        <label>Kata Laluan</label>
                    </div>
                    <center>
                        <button type="submit" name="login" class="btn rounded-2 mt-3 p-2 text-white" style="width: 100%; background-color: #5453a6;">Log Masuk</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
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