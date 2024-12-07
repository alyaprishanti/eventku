<?php
include 'db.php';

$id_umkm = 1; // ID UMKM yang akan diupdate
if (isset($_FILES['portfolio_upload']) && !empty($_FILES['portfolio_upload']['name'][0])) {
  $files = $_FILES['portfolio_upload'];
  $allowedExtensions = ['jpg', 'jpeg', 'png'];
  $uploadDir = 'uploads/';

  // Loop melalui semua file yang diunggah
  for ($i = 0; $i < count($files['name']); $i++) {
      $fileTmpPath = $files['tmp_name'][$i];
      $fileName = $files['name'][$i];
      $fileSize = $files['size'][$i];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      // Validasi file
      if ($fileSize <= 25 * 1024 * 1024 && in_array($fileExtension, $allowedExtensions)) {
          // Buat nama file baru agar unik
          $newFileName = 'portfolio_' . uniqid() . '.' . $fileExtension;
          $uploadFilePath = $uploadDir . $newFileName;

          // Simpan file ke direktori
          if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
              // Simpan path file ke database
              $query_insert_portfolio = "
                  INSERT INTO portofolio_umkm (id_profil, portofolio_url)
                  VALUES ($id_umkm, '$newFileName')
              ";
              $insert_portfolio = mysqli_query($db, $query_insert_portfolio);

              if (!$insert_portfolio) {
                  echo "<script>alert('Gagal menyimpan file ke database.');</script>";
              }
          } else {
              echo "<script>alert('Gagal menyimpan file ke server.');</script>";
          }
      } else {
          echo "<script>alert('Format file salah atau ukuran melebihi 25MB.');</script>";
      }
  }
}

?>
