<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_eo'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: /loginregister/loginEo.php");
    exit();
}

// Informasi pengguna yang login
$user_id = $_SESSION['id_eo'];  

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventku";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- test -->
