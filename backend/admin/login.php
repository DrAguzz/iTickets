<?php
    session_start();

$msg = "";
    if (isset($_POST["login"])) {
        $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
    
        if (empty($id) || empty($password)) {
            $_SESSION['title'] = 'Gagal';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Sila Isi Form Terlebih Dahulu';
        } else {
            $stmt = $pdo->prepare('SELECT * FROM admin WHERE id_admin = :id');
            $stmt->execute(['id' => $id]);
            $user = $stmt->fetch();
    
            if ($user && password_verify($password, $user['katalaluan'])) {
                session_regenerate_id(true);
                $_SESSION['id_admin'] = $id;
    
                echo "
                <script>
                    window.location.href='./dashboard.php?id=" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "';
                </script>";
                exit;
            } else {
                $_SESSION['title'] = 'Gagal';
                $_SESSION['icon'] = 'error';
                $_SESSION['text'] = 'Nama Pengguna atau Kata Laluan anda salah';
            }
        }
    }
?>