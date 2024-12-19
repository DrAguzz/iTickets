<?php
if (isset($_POST['tambah'])) {
    $id = trim($_POST['id']);
    $name = trim($_POST['name']);
    $notel = trim($_POST['notel']);
    $role = trim($_POST['role']);
    $ps = $_POST['ps'];
    $cps = $_POST['cps'];

    $query1 = mysqli_query($con, "SELECT * FROM admin WHERE id_admin='$id'");

    if (mysqli_num_rows($query1) > 0) {
        $_SESSION['title'] = 'Gagal';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Nama Pentadbir Sudah Wujud.';
        $_SESSION['location'] = 'add_admin.php';
    } else {
        if ($ps === $cps) {
            $hashedPassword = password_hash($ps, PASSWORD_DEFAULT);

            $query = mysqli_query($con, "INSERT INTO admin (id_admin, nama, katalaluan, nrtel, role) VALUES ('$id', UPPER('$name'), '$hashedPassword', '$notel', '$role')");

            if ($query) {
                $_SESSION['title'] = 'Berjaya';
                $_SESSION['icon'] = 'success';
                $_SESSION['text'] = 'Pentadbir Berjaya Ditambah.';
                $_SESSION['location'] = 'add_admin.php';
            } else {
                $_SESSION['title'] = 'Gagal';
                $_SESSION['icon'] = 'error';
                $_SESSION['text'] = 'Ralat Semasa Menambah Pentadbir.';
                $_SESSION['location'] = 'add_admin.php';
            }
        } else {
            $_SESSION['title'] = 'Gagal';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Kata Laluan Tidak Sepadan.';
            $_SESSION['location'] = 'add_admin.php';
        }
    }
}
?>
