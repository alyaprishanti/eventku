<?php
include 'db.php';

$id_umkm = 1; // ID UMKM yang akan diupdate

if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['foto_profil']['tmp_name'];
    $fileName = $_FILES['foto_profil']['name'];
    $fileSize = $_FILES['foto_profil']['size'];
    $fileType = $_FILES['foto_profil']['type'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Daftar ekstensi file yang diperbolehkan
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    if (in_array($fileExtension, $allowedExtensions)) {
        // Tentukan folder penyimpanan
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

            if ($update_foto) {
                echo "Foto profil berhasil diperbarui.";
            } else {
                echo "Gagal memperbarui foto profil di database.";
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Format file tidak didukung. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
    }
}
?>
