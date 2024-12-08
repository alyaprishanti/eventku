<?php
  include 'auth.php';

  $query = "
      SELECT 
          u.nama_usaha_umkm, u.nama_lengkap_umkm, u.nmr_telepon_umkm, 
          u.email_umkm, u.bidang_usaha_umkm, u.alamat_umkm, 
          p.deskripsi_umkm, p.foto_profil
      FROM 
          eventku.umkm u
      JOIN 
          eventku.profil_umkm p ON u.id_umkm = p.id_umkm
      WHERE 
          u.id_umkm = $id_umkm
  ";
  $result = mysqli_query($db, $query);
  $data = mysqli_fetch_assoc($result);

  $query_foto = "SELECT foto_profil FROM eventku.profil_umkm WHERE id_umkm = $id_umkm";
    $result_foto = mysqli_query($db, $query_foto);
    $data_foto = mysqli_fetch_assoc($result_foto);
    
   
    $fotoProfil = $data_foto['foto_profil'] ? 'uploads/' . $data_foto['foto_profil'] : 'pictures/drag-file.png'; // Gambar default jika tidak ada foto
    
    
    $showDeleteBtn = $data_foto['foto_profil'] ? true : false;

    $query_get_portfolio = "SELECT id_portofolio, portofolio_url FROM eventku.portofolio_umkm WHERE id_profil = $id_umkm";
    $result_portfolio = mysqli_query($db, $query_get_portfolio);
    $portfolio_files = [];
    if ($result_portfolio) {
        while ($row = mysqli_fetch_assoc($result_portfolio)) {
            $portfolio_files[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>  
    <link rel="stylesheet" href="css/editprofilecss.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
  <!-- Header -->
  <div class="header">
    <span>Eventku</span>
    <span>Edit Profil</span>
  </div>

<div class="container">
    <!-- Baris Pertama -->
        <div class="row">

            <!-- Upload Foto -->
            <div class="left-1-3">
                <form id="form1" method="POST" action="update_photoprofile.php" enctype="multipart/form-data">
                    <div class="file-upload" id="fileUpload">
                        <img id="uploadIcon" src="<?php echo $fotoProfil . '?t=' . time(); ?>" alt="Upload Icon">
                        <?php if ($showDeleteBtn): ?>
                            <button id="deleteBtn" class="delete-btn" type="button" <?php if (!$showDeleteBtn) echo 'style="display:none;"'; ?>>Hapus Foto</button>
                        <?php endif; ?>
                        <p id="uploadText">Letakkan foto Anda di sini atau</p>
                        <p><strong id="fileButton">Pilih file</strong></p>
                        <input type="file" id="fileInput" name="foto_profil" accept="image/png, image/jpeg">
                        <span id="fileName"></span>
                    </div>
                    <div class="file-info">
                        <span>Supported format: PNG, JPG, PDF</span><br>
                        <span>Ukuran maksimum: 25MB</span>
                    </div>
                    </form>
            </div>
            
            <!-- Bidang Usaha, Nama Usaha, Deskripsi  -->
            <div class="right-2-3">  
                <form id="form2" method="POST" action="update_textprofile1.php">
                    <select name="bidang_usaha" class="category-select">
                        <option value="Fashion" <?php echo $data['bidang_usaha_umkm'] == 'Fashion' ? 'selected' : ''; ?>>Fashion</option>
                        <option value="Kuliner" <?php echo $data['bidang_usaha_umkm'] == 'Kuliner' ? 'selected' : ''; ?>>Kuliner</option>
                        <option value="Musik" <?php echo $data['bidang_usaha_umkm'] == 'Musik' ? 'selected' : ''; ?>>Musik</option>
                        <option value="Seni" <?php echo $data['bidang_usaha_umkm'] == 'Seni' ? 'selected' : ''; ?>>Seni</option>
                        <option value="Teknologi" <?php echo $data['bidang_usaha_umkm'] == 'Teknologi' ? 'selected' : ''; ?>>Teknologi</option>
                    </select>
                    <input type="text" name="nama_usaha" class="text-input" value="<?php echo htmlspecialchars($data['nama_usaha_umkm']); ?>">
                    <textarea name="deskripsi" class="text-input" rows="4"><?php echo htmlspecialchars($data['deskripsi_umkm']); ?></textarea>
                </form>
            </div>
        </div>

    <!-- Baris Kedua (tidak mengikuti layout baris pertama) -->
        <div class="row">    
            <!-- Portfolio -->
            <div class="product-portfolio">
                <form id="form3" method="POST" action="update_portfolio.php" enctype="multipart/form-data">
                    <h2>Produk & Portofolio</h2>
                    <div class="portfolio-section">
                        <div class="portfolio-upload">
                            <img src="pictures/camera.png" alt="Portfolio Upload Icon">
                            <input type="file" id="portfolioInput" name="portfolio_upload[]" accept="image/png, image/jpeg" multiple style="display: none;">
                            <p>Pilih file</p>
                        </div>
                        <?php foreach ($portfolio_files as $file): ?>
                            <div class="portfolio-item" data-id="<?= $file['id_portofolio']; ?>">
                            <img src="uploads/<?= urlencode($file['portofolio_url']); ?>" alt="Portfolio Image" style="width: 150px; height: 150px;">
                            <button class="delete-button" type="button">
                                <i class="fa fa-trash"></i>
                            </button>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="portfolio-info">
                        <span>Supported format: PNG, JPG, PDF</span>
                        <span>Ukuran maksimum: 25MB</span>
                    </div>
                </form>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <form id="form4" method="POST" action="update_textprofile.php">
                    <h2>INFO</h2>
                    <label for="pemilik">Pemilik Usaha</label>
                    <input type="text" id="pemilik" name="pemilik_usaha" value="<?php echo htmlspecialchars($data['nama_lengkap_umkm']); ?>">
                    
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($data['alamat_umkm']); ?>">
                    
                    <label for="kontak">Kontak</label>
                    <input type="text" id="kontak" name="kontak" value="<?php echo htmlspecialchars($data['nmr_telepon_umkm']); ?>">
                </form>
            </div>
        </div>

    <!-- Tombol Footer -->
    <div class="footer-buttons">
        <!-- Tombol Batal -->
        <button type="button" class="cancel-button" onclick="window.location.href='profile_page.php'">Batal</button>
        <!-- Tombol Simpan -->
        <button type="submit" id="save-button" class="save-button">Simpan</button>
    </div>
        
    <!-- Popup Pesan Berhasil -->
    <div id="successPopup" class="popup-overlay" style="display: none;">
        <div class="popup-content">
            <img src="pictures/success.png" alt="Success">
            <p>Profil Berhasil Diperbarui!</p>
            <button onclick="window.location.href='profile_page.php'">Kembali</button>
        </div>
    </div>

    <!-- Popup Pesan Error -->
    <div id="errorPopup" class="popup-overlay" style="display: none;">
        <div class="popup-content">
            <img src="pictures/error.png" alt="Error">
            <p id="errorMessage"></p>
            <button onclick="document.getElementById('errorPopup').style.display='none';">Tutup</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Script submit
    document.getElementById('save-button').addEventListener('click', async function (e) {
    e.preventDefault(); 

    const forms = [
        { formId: 'form1', url: 'update_photoprofile.php' },
        { formId: 'form2', url: 'update_textprofile1.php' },
        { formId: 'form3', url: 'update_portfolio.php' },
        { formId: 'form4', url: 'update_textprofile.php' },
    ];

    let allSuccessful = true;

    for (const formObj of forms) {
        const formElement = document.getElementById(formObj.formId);
        const formData = new FormData(formElement);

        try {
            const response = await fetch(formObj.url, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                allSuccessful = false;
                console.error(`Error while submitting ${formObj.url}:`, await response.text());
                alert(`Gagal mengirim data untuk ${formObj.url}`);
            } else {
                console.log(`${formObj.url} Response:`, await response.text());
            }
        } catch (error) {
            allSuccessful = false;
            console.error(`Error while submitting ${formObj.url}:`, error);
            alert(`Terjadi kesalahan saat mengirim data untuk ${formObj.url}`);
        }
    }

    if (allSuccessful) {
        document.getElementById('successPopup').style.display = 'flex';
    }
    });

    // Handle klik pada div dengan class .portfolio-upload untuk membuka input file tersembunyi
    document.querySelector('.portfolio-upload').addEventListener('click', function() {
        document.querySelector('#portfolioInput').click();
    });

    // Handle perubahan file pada input #portfolioInput
    document.querySelector('#portfolioInput').addEventListener('change', function() {
        const files = this.files;
        if (files.length > 0) {
            console.log("Files selected:", files);
        }
    });

    // Menampilkan pop-up jika parameter URL menunjukkan penyimpanan berhasil
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('update') && urlParams.get('update') === 'success') {
            document.getElementById('successPopup').style.display = 'flex';
        }
    };

    // Menutup pop-up saat area luar pop-up diklik
    window.onclick = function(event) {
        const popup = document.getElementById('successPopup');
        if (event.target == popup) {
            popup.style.display = "none";
        }
    };

    // Variabel elemen untuk file upload
    const fileInput = document.getElementById('fileInput');
    const fileButton = document.getElementById('fileButton');
    const uploadIcon = document.getElementById('uploadIcon');
    const uploadText = document.getElementById('uploadText');
    const fileName = document.getElementById('fileName');

    // Membuka input file saat tombol "Pilih File" diklik
    fileButton.addEventListener('click', function() {
        fileInput.click();
    });

    // Menampilkan nama file setelah file dipilih
    fileInput.addEventListener('change', function() {
        const selectedFile = fileInput.files[0];
        if (selectedFile) {
            // Sembunyikan ikon dan teks instruksi, tampilkan nama file
            uploadIcon.style.display = 'none';
            uploadText.style.display = 'none';
            fileName.textContent = selectedFile.name;
        } else {
            // Kembalikan tampilan awal jika file tidak dipilih
            uploadIcon.style.display = 'block';
            uploadText.style.display = 'block';
            fileName.textContent = '';
        }
    });

    // Menampilkan pratinjau gambar setelah file dipilih pada #portfolioInput
    document.getElementById('portfolioInput').addEventListener('change', function() {
    const file = this.files[0];
    const cameraIcon = document.getElementById('cameraIcon');
    const previewContainer = document.querySelector('.portfolio-section');

    // Hapus pratinjau sebelumnya jika ada
    let existingPreview = previewContainer.querySelector('img.preview ');
    if (existingPreview) {
        existingPreview.remove();
    }

    // Cek apakah file dipilih
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImage = document.createElement('img');
            previewImage.src = e.target.result;
            previewImage.className = 'preview';
            previewImage.style.width = '150px';
            previewImage.style.height = '150px';
            previewImage.style.border = '2px solid #ccc'; 
            previewImage.style.borderRadius = '10px'; 
            previewContainer.appendChild(previewImage);
        };
        reader.readAsDataURL(file);
    }
    });

    // Menangani penghapusan item portfolio
    document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
        const portfolioItem = this.closest('.portfolio-item');
        const portfolioId = portfolioItem.dataset.id;

        fetch('delete_portfolio.php', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `delete_portfolio=1&id_portfolio=${portfolioId}`  
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Server memberikan respons tidak valid.');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                portfolioItem.remove();
            } else {
                console.error('Kesalahan dari server:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    });


    // Menghapus foto profil saat tombol hapus diklik
    document.getElementById('deleteBtn').addEventListener('click', function (event) {
    event.preventDefault();
    const id_umkm = $id_umkm;

    fetch('delete_photoprofile.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `delete_foto=1&id_umkm=${id_umkm}`, 
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`); 
        }
        return response.json();
    })
                document.getElementById('uploadIcon').src = 'pictures/drag-file.png';
                document.getElementById('deleteBtn').style.display = 'none';       
  });
</script>
</body>
</html>
