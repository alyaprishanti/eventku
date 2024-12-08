<?php
include 'db.php';

$id_umkm = 1;
$errorMessage = "";

if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto_profil']['tmp_name'];
    $fileName = $_FILES['foto_profil']['name'];
    $fileSize = $_FILES['foto_profil']['size'];
    $fileType = $_FILES['foto_profil']['type'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExtension, $allowedExtensions)) {
        $uploadDir = 'uploads/';
        $newFileName = 'foto_profil_umkm_' . $id_umkm . '.' . $fileExtension;
        $uploadFilePath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            $query_update_foto = "
                UPDATE eventku.profil_umkm 
                SET foto_profil = '$newFileName'
                WHERE id_umkm = $id_umkm
            ";

            $update_foto = mysqli_query($db, $query_update_foto);

            if (!$update_foto) {
                $errorMessage = "Gagal memperbarui foto profil di database.";
            } 
        } else {
            $errorMessage= "Gagal mengunggah file.";
        }
    } else {
        $errorMessage = "Format file salah atau ukuran melebihi 25MB.";
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
