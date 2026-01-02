<?php
session_start();

$msg = "";

if (isset($_POST["login"])) {

    $id = trim($_POST['id'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($id) || empty($password)) {
        $_SESSION['title'] = 'Gagal';
        $_SESSION['icon']  = 'error';
        $_SESSION['text']  = 'Sila Isi Form Terlebih Dahulu';
        header("Location: login.php");
        exit;
    }

    // Prepare statement (MySQLi procedural)
    $sql = "SELECT * FROM admin WHERE id_admin = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['katalaluan'])) {

            session_regenerate_id(true);
            $_SESSION['id_admin']  = $user['id_admin'];
            $_SESSION['logged_in'] = true;

            header("Location: dashboard.php");
            exit;

        } else {
            $_SESSION['title'] = 'Gagal';
            $_SESSION['icon']  = 'error';
            $_SESSION['text']  = 'Nama Pengguna atau Kata Laluan anda salah';
            header("Location: login.php");
            exit;
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Query error");
    }
}
?>
