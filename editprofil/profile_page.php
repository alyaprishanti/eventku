<?php
  include 'db.php';

  $id_umkm = 1;
  $query = "
    SELECT u.nama_usaha_umkm, u.nama_pemilik_umkm, u.nmr_telepon_umkm, u.email_umkm, u.bidang_usaha_umkm, u.alamat_umkm, 
           p.deskripsi_umkm, p.foto_profil 
    FROM eventku.umkm u 
    JOIN eventku.profil_umkm p ON u.id_umkm = p.Id_umkm 
    WHERE u.id_umkm = $id_umkm
  ";
  
  $result = mysqli_query($db, $query);
  $data = mysqli_fetch_assoc($result);

  $query_get_portfolio = "SELECT id_portofolio, portofolio_url FROM portofolio_umkm WHERE id_profil = $id_umkm";
  $result_portfolio = mysqli_query($db, $query_get_portfolio);
  $portfolio_files = [];
  if ($result_portfolio) {
      while ($row = mysqli_fetch_assoc($result_portfolio)) {
          $portfolio_files[] = $row;
      }
  } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Usaha - Eventku</title>
    <link rel="stylesheet" href="css/profilecss.css">
</head>

<body>
    <!-- Header -->
    <div class="header">
        <button onclick="window.location.href='UMKM_Dashboard.php'">Kembali</button>
        <h1 class="header-title">Eventku</h1>
        <button onclick="window.location.href='editprofile_page.php'">Edit</button>
    </div>

    <div class="container">
      <!-- Baris 1: Foto Profil + Informasi Profil -->
      <div class="row">
        <?php
          $foto_profil = !empty($data['foto_profil']) ? 'uploads/' . $data['foto_profil'] . '?t=' . time() : 'pictures/defaultprofile.png';
        ?>
        <div class="profile-photo">
          <img src="<?php echo $foto_profil; ?>" alt="Logo Usaha">
        </div>
        <div class="profile-info">
          <div class="category"><?php echo $data['bidang_usaha_umkm']; ?></div>
          <h1><?php echo $data['nama_usaha_umkm']; ?></h1>
          <div class="rating">⭐⭐⭐⭐☆</div>
          <p class="description"><?php echo $data['deskripsi_umkm']; ?></p>
        </div>
      </div>

      <!-- Baris 2: Portofolio Produk + Info Usaha -->
      <div class="row">
        <div class="product-portfolio">
          <h2>Produk & Portofolio</h2>
          <div class="portfolio-images">
            <?php foreach ($portfolio_files as $file): ?>
              <div class="portfolio-images" data-id="<?= $file['id_portofolio']; ?>">
                <img src="uploads/<?= urlencode($file['portofolio_url']); ?>" alt="Portfolio Image" style="width: 150px; height: 150px;">
              </div>
            <?php endforeach; ?>   
          </div>
        </div>

        <div class="info-section">
          <h2>INFO</h2>
          <label for="pemilik">Pemilik Usaha</label>
          <input type="text" id="pemilik" value="<?php echo $data['nama_pemilik_umkm']; ?>" readonly>

          <label for="alamat">Alamat</label>
          <input type="text" id="alamat" value="<?php echo $data['alamat_umkm']; ?>" readonly>

          <label for="kontak">Kontak</label>
          <input type="text" id="kontak" value="<?php echo $data['nmr_telepon_umkm']; ?>" readonly>
        </div>
      </div>
    </div>

</body>
</html>
