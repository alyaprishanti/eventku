<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventku</title>
    <style>
        * {
    box-sizing: border-box;
    }
    body, html {
        height: 100%;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fdf8f3;
        font-family: "Plus Jakarta Sans", sans-serif;
    }
            .header {
            position: absolute;
            top: 0;
            width: 100%;
            padding: 20px;
            background-color: #fbbd08;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { margin: 0; color: #000; font-weight: 700; }
        .header .auth-buttons {
            display: flex;
            gap: 10px;
        }
        .header .auth-buttons a {
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 20px;
            text-decoration: none;
            color: #000;
            background-color: white;
            font-weight: 600;
        }
        .header .auth-buttons a:hover { background-color: #ffe8a1; }

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

        .promo-section {
            background-color: #FFC700;
            text-align: center;
            padding: 40px 20px;
            border-radius: 8px;
            margin: 20px;
            position: relative;
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

        .promo-section::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            background-image: url('decorative-pattern.png'); /* Ganti dengan gambar dekorasi */
            background-size: cover;
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Eventku</h1>
        <div class="auth-buttons">
            <a href="loginregister/landingLogin.php">Masuk</a>
            <a href="loginregister/landingRegister.php">Daftar</a>
        </div>
    </div>

    <!-- Bagian Selamat Datang -->
    <section class="welcome-section">
        <h1>Selamat Datang di Eventku!</h1>
    </section>

    <!-- Bagian Promosi -->
    <section class="promo-section">
        <h2>Gabung dan promosikan Eventmu atau UMKM-mu!</h2>
        <p>Dengan platform Eventku, semuanya lebih mudah!</p>
    </section>
</body>
</html>