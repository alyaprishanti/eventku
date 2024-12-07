<?php
$host = "localhost"; 
$user = "root";      
$password = "";      
$dbname = "eventku"; 
$port = 3307;

$db = mysqli_connect($host, $user, $password, $dbname, $port);

if ($db->connect_error) {
  echo "koneksi rusak";  
  die("error!");
} 
?>