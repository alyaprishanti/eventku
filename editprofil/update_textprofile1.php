<?php
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bidang_usaha = $_POST['bidang_usaha'];
    $nama_usaha = $_POST['nama_usaha'];
    $deskripsi = $_POST['deskripsi'];

    if (empty($bidang_usaha) || empty($nama_usaha)) {
        header('Location: editprofile_page.php?error=empty_fields');
        exit; // Hentikan eksekusi skrip jika ada kolom yang kosong
    }

    if (strlen($nama_usaha) > 100) {
        header('Location: editprofile_page.php?error=nama_usaha_invalid');
        exit;
    }
    
    // Query untuk update data
    $query_umkm = "
        UPDATE eventku.umkm 
        SET 
            nama_usaha_umkm = '$nama_usaha',
            bidang_usaha_umkm = '$bidang_usaha'
        WHERE id_umkm = $id_umkm
    ";

    $query_profil = "
        UPDATE eventku.profil_umkm 
        SET deskripsi_umkm = '$deskripsi'
        WHERE id_umkm = $id_umkm
    ";

    // Eksekusi query
    $update_umkm = mysqli_query($db, $query_umkm);
    $update_profil = mysqli_query($db, $query_profil);

    // Redirect kembali ke halaman edit profil
    if ($update_umkm && $update_profil) {
        header('Location: editprofile_page.php?success=1');
    } else {
        header('Location: editprofile_page.php?error=1');
    }
}
?>
