<?php
session_start();
include 'db.php';

// Memastikan user sudah login
if (!isset($_SESSION['id_umkm'])) {
  header('Location: login.php'); // Arahkan ke halaman login jika belum login
  exit;
}

// Gunakan ID UMKM dari session
  $id_umkm = $_SESSION['id_umkm'];
?>