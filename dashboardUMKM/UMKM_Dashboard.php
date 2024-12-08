<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventku</title>
    <link rel="stylesheet" href="eventku/dashboardUMKM/styles/stylesDashboard.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@100..700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script>
        
        function toggleNotification() {
            var notification = document.querySelector('.notification');
            var button = document.querySelector('.expand-button');
            if (notification.style.maxHeight === '150px') {
                notification.style.maxHeight = 'none';
                button.innerHTML = '&#9650;'; 
            } else {
                notification.style.maxHeight = '150px';
                button.innerHTML = '&#9660;'; 
            }
        }

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('click', function (event) {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const btnUmkm = document.querySelector('.btn-umkm');
            if (!dropdownMenu.contains(event.target) && !btnUmkm.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });
    </script>
</head>
<body>
    <div class="header">
        <div class="logo">Eventku</div>
        <div class="search-bar">
            <input placeholder="Search..." type="text"/>
        </div>
        <div class="nav-links">
            <a href="eventku/FAQ/FAQUMKM.php">FAQ &amp; Support</a>
        </div>
        <div class="header-right">
        <button class="btn-umkm" onclick="toggleDropdown()">
            <i class="fas fa-user"></i> UMKM</button>
        <div class="dropdown-menu" id="dropdownMenu">
<<<<<<< HEAD
            <a href="/eventku/editprofil/profile_page.php">Profil</a>  
            <a href="#">Daftar Favorit</a>
            <a href="#">Log Out</a>
=======
              <a href="eventku/editprofil/profile_page.php">Profil</a>  
              <a href="#">Daftar Favorit</a>
              <a href="#">Log Out</a>
>>>>>>> 0d7d86db7d49aae48f8fa074bdb2c0eac88bbc94
        </div>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            <div class="upcoming-event">UPCOMING EVENT</div>
            <div class="event-item">
                <img alt="Event image with blue background and floating lights" src="https://storage.googleapis.com/a1aa/image/zft2aUFkRpSScS6bCWaVcgfb27bZ8cjfUZkWbskYmtpe3CPPB.jpg"/>
                <div class="event-details">
                    <h3>Festival Seni Budaya Malang</h3>
                    <div class="info">
                        <span class="category">SENI</span>
                        <span class="attendees"><i class="fas fa-user"></i>0</span>
                        <span class="date"><i class="fas fa-calendar-alt"></i>01/10/2024</span>
                        <span class="location"><i class="fas fa-map-marker-alt"></i>MALANG</span>
                    </div>
                </div>
                <button class="button">Lihat Detail</button>
            </div>
            <div class="event-item">
                <img alt="Event image with people at a market" src="https://storage.googleapis.com/a1aa/image/541pDNdHsHKjNJI3o6ckH1HHKDw8tBT5ZPasv9SrN2SgL88E.jpg"/>
                <div class="event-details">
                    <h3>Pesta Kuliner Nusantara</h3>
                    <div class="info">
                        <span class="category">KULINER</span>
                        <span class="attendees"><i class="fas fa-user"></i>0</span>
                        <span class="date"><i class="fas fa-calendar-alt"></i>01/10/2024</span>
                        <span class="location"><i class="fas fa-map-marker-alt"></i>MALANG</span>
                    </div>
                </div>
                <button class="button">Lihat Detail</button>
            </div>
            <div class="event-item">
                <img alt="Event image with blue background and floating lights" src="https://storage.googleapis.com/a1aa/image/zft2aUFkRpSScS6bCWaVcgfb27bZ8cjfUZkWbskYmtpe3CPPB.jpg"/>
                <div class="event-details">
                    <h3>Bazar UMKM Dinoyo</h3>
                    <div class="info">
                        <span class="category">KULINER</span>
                        <span class="attendees"><i class="fas fa-user"></i>0</span>
                        <span class="date"><i class="fas fa-calendar-alt"></i>01/10/2024</span>
                        <span class="location"><i class="fas fa-map-marker-alt"></i>MALANG</span>
                    </div>
                </div>
                <button class="button">Lihat Detail</button>
            </div>
            <div class="event-item">
                <img alt="Event image with people at a market" src="https://storage.googleapis.com/a1aa/image/541pDNdHsHKjNJI3o6ckH1HHKDw8tBT5ZPasv9SrN2SgL88E.jpg"/>
                <div class="event-details">
                    <h3>Music Fest Malang</h3>
                    <div class="info">
                        <span class="category">SENI</span>
                        <span class="attendees"><i class="fas fa-user"></i>0</span>
                        <span class="date"><i class="fas fa-calendar-alt"></i>01/10/2024</span>
                        <span class="location"><i class="fas fa-map-marker-alt"></i>MALANG</span>
                    </div>
                </div>
                <button class="button">Lihat Detail</button>
            </div>
        </div>
        <div class="sidebar">
            <div class="notification">
                <h3><i class="fas fa-bell"></i> Notifikasi</h3>
                <p>Pendaftaran tenant untuk *Festival Seni Budaya Malang* telah dibuka! Jangan lewatkan kesempatan untuk mempromosikan produk Anda.</p>
                <p>Perbarui profil UMKM Anda untuk meningkatkan peluang diterima sebagai tenant di event mendatang.</p>
                <p>Pendaftaran tenant di *Bazar UMKM Dinoyo* hanya tersisa 10 slot! Jangan lewatkan kesempatan ini untuk memperluas jaringan bisnis Anda.</p>
                <p>Selamat! Anda telah berhasil terdaftar sebagai tenant di *Music Fest Malang*. Persiapkan produk terbaik Anda!</p>
                <p>Event baru ditambahkan: *Pesta Kuliner Nusantara*. Segera daftar sebagai tenant dan bawa produk lokal Anda ke panggung besar.</p>
                <button class="expand-button" onclick="toggleNotification()">&#9660;</button>
            </div>
        </div>
    </div>
</body>
</html>
