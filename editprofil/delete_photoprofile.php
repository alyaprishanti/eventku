<?php
include 'auth.php';

$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_foto'])) {

    $query_foto = "SELECT foto_profil FROM eventku.profil_umkm WHERE id_umkm = $id_umkm";
    $result_foto = mysqli_query($db, $query_foto);
    $data_foto = mysqli_fetch_assoc($result_foto);

    if ($data_foto) {
        $fotoProfil = $data_foto['foto_profil'];

        $filePath = 'uploads/' . $fotoProfil;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $query_update_foto = "UPDATE eventku.profil_umkm SET foto_profil = NULL WHERE id_umkm = $id_umkm";
        $update_foto = mysqli_query($db, $query_update_foto);

        if (!$update_foto) {
            $errorMessage= "Gagal menghapus foto profil dari database";
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
