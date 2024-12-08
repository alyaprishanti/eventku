<?php
include 'db.php';

$id_umkm = 1; 
$errorMessage='';
if (isset($_FILES['portfolio_upload']) && !empty($_FILES['portfolio_upload']['name'][0])) {
  $files = $_FILES['portfolio_upload'];
  $allowedExtensions = ['jpg', 'jpeg', 'png'];
  $uploadDir = 'uploads/';

  for ($i = 0; $i < count($files['name']); $i++) {
      $fileTmpPath = $files['tmp_name'][$i];
      $fileName = $files['name'][$i];
      $fileSize = $files['size'][$i];
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

      if ($fileSize <= 25 * 1024 * 1024 && in_array($fileExtension, $allowedExtensions)) {
          $newFileName = 'portfolio_' . uniqid() . '.' . $fileExtension;
          $uploadFilePath = $uploadDir . $newFileName;

          if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
              $query_insert_portfolio = "
                  INSERT INTO portofolio_umkm (id_profil, portofolio_url)
                  VALUES ($id_umkm, '$newFileName')
              ";
              $insert_portfolio = mysqli_query($db, $query_insert_portfolio);

              if (!$insert_portfolio) {
                  $errorMessage = "Gagal menyimpan file ke database.";
              }
          } else {
            $errorMessage = "Gagal menyimpan file ke server";
          }
      } else {
          $errorMessage = "Format file salah atau ukuran melebihi 25MB.";
      }
  }
}

if (!empty($errorMessage)) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('errorPopup').style.display = 'flex';
            document.getElementById('errorMessage').innerText = '$errorMessage';
        });
    </script>";
}
?>
