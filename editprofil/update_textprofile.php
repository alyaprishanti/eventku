<?php
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pemilik_usaha = $_POST['pemilik_usaha'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    // Query untuk update data
    $query_umkm = "
        UPDATE eventku.umkm 
        SET 
            nama_lengkap_umkm = '$pemilik_usaha',
            nmr_telepon_umkm = '$kontak',
            alamat_umkm = '$alamat'
        WHERE id_umkm = $id_umkm
    ";

    // Eksekusi query
    $update_umkm = mysqli_query($db, $query_umkm);

    // Redirect kembali ke halaman edit profil
    if ($update_umkm) {
        header('Location: editprofile_page.php?success=1');
    } else {
        header('Location: editprofile_page.php?error=1');
    }
}
?>
