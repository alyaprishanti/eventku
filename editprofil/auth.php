<?php
session_start();
include 'db.php';

// Memastikan user sudah login
if (!isset($_SESSION['id_umkm'])) {
  header('Location: loginregister/loginUMKM.php');
  exit;
}

// Gunakan ID UMKM dari session
  $id_umkm = $_SESSION['id_umkm'];

// Periksa apakah profil UMKM sudah ada untuk id_umkm
$query = "SELECT * FROM profil_umkm WHERE id_umkm = '$id_umkm'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) == 0) {
    // Inisialisasi Profil UMKM
    $insertQuery = "INSERT INTO profil_umkm (id_umkm) VALUES ('$id_umkm')";
    if (mysqli_query($db, $insertQuery)) {
      // Inisialisasi Portfolio UMKM
      $portfolioQuery = "INSERT INTO portofolio_umkm (id_profil) 
                         VALUES ('$id_umkm')";
      if (!mysqli_query($db, $portfolioQuery)) {
          echo "Error: " . mysqli_error($db);
      }
  } else {
      echo "Error: " . mysqli_error($db);
  }
}
?>