<?php
require('../backend/config.php');
include('../backend/redirectAdmin.php');
include('../backend/admin/add_passenger.php');

$get=$_REQUEST['id'];
$query=mysqli_query($con, "SELECT * FROM vehicles WHERE id_vehicle=$get");
$fetch=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>iTicket KVKS</title>
  <link rel="shortcut icon" href="../images/icon.png" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
</head>

<style>
	body{
		font-family: quicksand;
		background-color: #dcdcdc;
	}
</style>
<body>
  <div class="container-fluid text-light sticky-top p-4" style="background-color: #5453a6;">
  	<span class="fs-2 fw-bold">Tambah Penumpang</span>
	  <button class="btn bg-white text-dark float-lg-end" onclick="window.location='add_bus.php'">Kembali</button>
  </div>
  <div class="container-fluid p-3">
    <div class="container col-md col-12 bg-light p-3 rounded-3 shadow align-middle border">
      <form method="POST">
        <div class="container mt-3">
            <label class="form-label">No. Kad Pengenalan</label>
            <input class="form-control" name="nokp" type="text">
        </div>

        <div class="container mt-3">
            <input class="form-control" name="id_vehicle" type="hidden" value="<?=$fetch['id_vehicle'];?>">
        </div>

        <div class="container mt-3">
          <label class="form-label">Kaedah Pembayaran</label>
          <br>
          <div class="col-sm-3 col-md-12 col-lg-3 p-3 border shadow-sm rounded-3 mt-2 mb-2">
            <input type="radio" class="form-check-input" name="method" value="Tunai" required>
            Tunai
            <center>
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
              </svg>
            </center>
          </div>
          <div class="col-sm-3 col-md-12 col-lg-3 p-3 border shadow-sm rounded-3 mt-2 mb-2">
            <input type="radio" class="form-check-input" name="method" id="../image/qr.jpeg" value="Touch n Go" required>
            Touch n' Go
            <center>
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
              </svg>
            </center>
          </div>
        </div>

        <br>
        <div class="container">
            <input type="submit" class="btn btn-success w-100" name="submit" value="Hantar">
        </div>
      </form>
    </div>
  </div>
  <?php include('../partials/_footerAdmin.php');?>

</body>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    <?php if (isset($_SESSION['title']) && $_SESSION['title'] != '') { ?>
        Swal.fire({
            confirmButtonColor: '#5453a6',
            title: '<?php echo $_SESSION['title']; ?>',
            text: '<?php echo $_SESSION['text']; ?>',
            icon: '<?php echo $_SESSION['icon']; ?>'
        }).then((result) => {
        if (result.isConfirmed) {
          window.location.href='<?=$_SESSION['location']?>';
        }
      });
    <?php }
    unset($_SESSION['title']); ?>
</script>
</html>