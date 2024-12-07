<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EO Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFF9EB;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FFC700;
            padding: 10px 20px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .profile-btn {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
        }

        .welcome-section {
            background-color: #FFD74F;
            text-align: center;
            padding: 60px 20px;
            border-radius: 8px;
            margin: 20px;
        }

        .welcome-section h1 {
            font-size: 32px;
            margin: 0;
            color: #fff;
        }

        .rising-umkm {
            margin: 20px;
        }

        .rising-umkm h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .umkm-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .umkm-item {
            display: flex;
            background-color: #FFF2C7;
            padding: 20px;
            border-radius: 8px;
        }

        .umkm-item .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .umkm-item .details {
            margin-left: 20px;
        }

        .umkm-item h3 {
            font-size: 18px;
            margin: 0;
        }

        .umkm-item .tag {
            background-color: #FF6F00;
            color: #fff;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 10px;
        }

        .umkm-item p {
            font-size: 14px;
            margin: 10px 0 0;
        }

        .notification {
            margin: 20px;
            text-align: right;
        }

        .notif-box {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            max-width: 300px;
            margin-left: auto;
            text-align: left;
        }

        .promo-section {
            background-color: #FFC700;
            text-align: center;
            padding: 40px 20px;
            border-radius: 8px;
            margin: 20px;
        }

        .promo-section h2 {
            font-size: 24px;
            margin: 0;
            color: #fff;
        }

        .promo-section p {
            font-size: 16px;
            margin: 10px 0 0;
            color: #fff;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">Eventku</div>
        <nav>
            <a href="#">Home</a>
            <a href='/eventku/kelolaevent/dashboard.php'>Kelola Event</a>
            <a href="#">FAQ & Support</a>
        </nav>
        <div class="profile">
            <button class="profile-btn">EO</button>
        </div>
    </header>

    <main>
        <section class="welcome-section">
            <h1>Selamat Datang!<br> Mari cari tenantmu!</h1>
        </section>

        <section class="rising-umkm">
            <h2>Rising UMKM</h2>
            <div class="umkm-list">
                <?php
                // Data UMKM untuk ditampilkan
                $umkms = [
                    ['name' => 'Serabite', 'category' => 'Kuliner', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
                    ['name' => 'Serabite', 'category' => 'Kuliner', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
                    ['name' => 'Serabite', 'category' => 'Kuliner', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
                ];

                foreach ($umkms as $umkm) {
                    echo '
                    <div class="umkm-item">
                        <div class="logo">
                            <img src="serabite-logo.png" alt="Serabite Logo">
                        </div>
                        <div class="details">
                            <h3>' . $umkm['name'] . ' <span class="tag">' . $umkm['category'] . '</span></h3>
                            <p>' . $umkm['description'] . '</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </section>

        <section class="notification">
            <div class="notif-box">
                <h3>Notifikasi</h3>
                <p>Lorem ipsum dolor sit amet consectetur. Turgis magna ac odio volutpat luctus sit magna risus.</p>
            </div>
        </section>

        <section class="promo-section">
            <h2>Gabung dan promosikan Eventmu!</h2>
            <p>Dengan platform Eventku, semuanya lebih mudah!</p>
        </section>
    </main>
</body>
</html>