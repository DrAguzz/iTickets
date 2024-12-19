<?php
include('config.php');
session_start();

if(isset($_POST['submit'])){
    $id_user=$_POST['id_user'];
    $id_vehicle=$_POST['id_vehicle'];
    $method=$_POST['method'];
    $date=date('Y-m-d');

    $checkPurchase=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tickets WHERE id_user='$id_user'"));
    $rows = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tickets WHERE id_user='$id_user'"));

    if($rows == 0){
        if($method == 'Touch n Go'){
            $_SESSION['id_user'] = $id_user;
            $_SESSION['id_vehicle'] = $id_vehicle;
            $_SESSION['method'] = $method;
            $_SESSION['date'] = $date;
            header('Location: ../frontend/paymenttng.php');
        }else if($method == 'Tunai'){
            $tktPurchase=mysqli_query($con, "INSERT INTO tickets (id_user, id_vehicle, method, date) VALUES ('$id_user', '$id_vehicle', '$method', '$date')");
    
            if ($tktPurchase) {
                echo"
                <script>
                    window.location='../frontend/dashboard.php';
                </script>
                ";
                $_SESSION['title']='Berjaya Ditempah';
                $_SESSION['icon']='success';
                $_SESSION['text']='Terima kasih kerana menggunakan ITket KVKS';
            }else{
                echo"
                <script>
                    window.location='../frontend/buyTicket.php';
                </script>
                ";
                $_SESSION['title']='Ralat';
                $_SESSION['icon']='error';
                $_SESSION['text']='Ralat. Sila cuba sebentar lagi';
            }
        }
    }else{
        if($checkPurchase['status'] == 0){
            echo"
            <script>
                window.location='../frontend/buyTicket.php';
            </script>
            ";
            $_SESSION['title']='Pembelian Gagal';
            $_SESSION['icon']='error';
            $_SESSION['text']='Setiap pelajar hanya dibenarkan untuk membeli satu tiket sahaja';
        }else if($checkPurchase['status'] == 1){
            echo"
            <script>
                window.location='../frontend/buyTicket.php';
            </script>
            ";
            $_SESSION['title']='Pembelian Gagal';
            $_SESSION['icon']='error';
            $_SESSION['text']='Setiap pelajar hanya dibenarkan untuk membeli satu tiket sahaja';
        }else if($checkPurchase['status'] == 2){
            if($method == 'Touch n Go'){
                $_SESSION['id_user'] = $id_user;
                $_SESSION['id_vehicle'] = $id_vehicle;
                $_SESSION['method'] = $method;
                $_SESSION['date'] = $date;
                header('Location: ../frontend/paymenttng.php');
            }else if($method == 'Tunai'){
                $tktPurchase=mysqli_query($con, "UPDATE tickets SET status = '0' WHERE id_user = '$id_user' ");
        
                if ($tktPurchase) {
                    echo"
                    <script>
                        window.location='../frontend/dashboard.php';
                    </script>
                    ";
                    $_SESSION['title']='Berjaya Ditempah';
                    $_SESSION['icon']='success';
                    $_SESSION['text']='Terima kasih kerana menggunakan ITket KVKS';
                }else{
                    echo"
                    <script>
                        window.location='../frontend/buyTicket.php';
                    </script>
                    ";
                    $_SESSION['title']='Ralat';
                    $_SESSION['icon']='error';
                    $_SESSION['text']='Ralat. Sila cuba sebentar lagi';
                }
            }
        }
    }
}