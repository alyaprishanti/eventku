<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_umkm = 1; // ID UMKM yang ingin diupdate
    $bidang_usaha = $_POST['bidang_usaha'];
    $nama_usaha = $_POST['nama_usaha'];
    $deskripsi = $_POST['deskripsi'];

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
