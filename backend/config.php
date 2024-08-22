<?php
$con=mysqli_connect('localhost','root','','kvkualas_bas')or die();

// Database connection
$host = 'localhost';
$db   = 'kvkualas_bas';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options); // Establishing the connection
} catch (\PDOException $e) {
    die("Could not connect to the database. Please check your connection settings.");
}
?>