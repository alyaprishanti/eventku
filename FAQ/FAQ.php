<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ & Support</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/eventku/FAQ/styles/stylesFAQ.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

    <div class="header">
        <h1><a href="/eventku/dashboardUMKM/UMKM_Dashboard.php" style="text-decoration: none; color: inherit;">Eventku</a></h1>
        <div class="nav-links">
            <a href="/eventku/kelolaAkun/kelolaAkun.php" class="btn-umkm"><i class="fas fa-user"></i>AKUN</a>
        </div>
    </div>

    <div class="faq-section">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item" onclick="toggleFAQ(this)">
        Bagaimana cara mendaftar sebagai tenant untuk suatu event?
        <span>&#x25BC;</span>
    </div>
    <div class="faq-answer">
        Untuk mendaftar sebagai tenant, buka halaman event yang ingin Anda ikuti, klik tombol "Daftar sebagai Tenant", dan isi formulir yang tersedia. Pastikan semua informasi yang dimasukkan sudah benar sebelum mengirimkan.
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
        Apa saja persyaratan untuk menjadi tenant?
        <span>&#x25BC;</span>
    </div>
    <div class="faq-answer">
        Anda perlu memiliki profil UMKM yang lengkap, termasuk nama usaha, deskripsi produk, dan dokumen pendukung seperti NPWP atau SIUP. Pastikan semua dokumen sudah diunggah di akun Anda.
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
        Bagaimana jika kuota tenant untuk event sudah penuh?
        <span>&#x25BC;</span>
    </div>
    <div class="faq-answer">
        Jika kuota tenant sudah penuh, Anda dapat masuk ke daftar tunggu. Jika ada tenant yang batal atau slot tambahan dibuka, Anda akan dihubungi melalui notifikasi di aplikasi.
    </div>

    <div class="faq-item" onclick="toggleFAQ(this)">
        Apakah ada biaya pendaftaran untuk menjadi tenant?
        <span>&#x25BC;</span>
    </div>
    <div class="faq-answer">
        Tidak ada biaya pendaftaran. Selagi memiliki kualifikasi untuk berpartisipasi, Anda dapat mendaftar.
    </div>
</div>

    <div class="faq-footer">
        <h3>Tidak menemukan jawaban?</h3>
        <p>Jika Anda memiliki pertanyaan lebih lanjut atau memerlukan bantuan, jangan ragu untuk menghubungi kami melalui tombol di bawah ini.</p>
        <a href="https://wa.me/081916525507" class="btn-contact" target="_blank">Hubungi Kami</a>
    </div>

    <script>
        function toggleFAQ(item) {
            const answer = item.nextElementSibling;
            if (answer.style.display === "block") {
                answer.style.display = "none";
                item.querySelector('span').innerHTML = "&#x25BC;";
            } else {
                answer.style.display = "block";
                item.querySelector('span').innerHTML = "&#x25B2;";
            }
        }
    </script>
</body>
</html>
