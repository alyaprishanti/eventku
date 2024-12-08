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
            overflow: hidden;
            background-color: #fdf8f3;
            font-family: "Plus Jakarta Sans", sans-serif;
        }
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 20px;
            background-color: #fbbd08;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        .header h1 {
            margin: 0;
            color: #000;
            font-weight: 700;
        }
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
        .header .auth-buttons a:hover {
            background-color: #ffe8a1;
        }
        .content {
            margin-top: 110px; 
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
        }
        .card {
            width: 90%;
            max-width: 1200px; 
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }
        .card img {
            width: 100%;
            height: auto;
            display: block;
        }
        .card-content {
            position: absolute;
            bottom: 40px; 
            left: 40px; 
            text-align: left;
            color: white;
        }
        .card-content h1 {
            margin: 0;
            font-size: 60px; 
            line-height: 1.2; 
            color: #fff;
        }
        .card-content p {
            margin-top: 10px;
            font-size: 18px;
            color: #fff;
        }
        .card-content-secondary {
            position: absolute;
            bottom: 28px;
            left: 32px;
            color: white; 
            text-align: left;
        }
        .card-content-secondary h1 {
            font-size: 32px; 
            margin: 0;
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

    <div class="content">
        <!-- Card Atas -->
        <div class="card">
            <img src="/eventku/uploadsLanding/card1.png" alt="Card Atas">
            <div class="card-content">
                <h1>Selamat datang di<br>Eventku!</h1>
            </div>
        </div>

        <!-- Card Bawah -->
        <div class="card">
            <img src="/eventku/uploadsLanding/card2.png" alt="Card Bawah">
            <div class="card-content-secondary">
                <h1>Gabung dan promosikan Eventmu atau UMKM-mu!</h1>
                <p>Dengan platform Eventku, semuanya lebih mudah!</p>
            </div>
        </div>
    </div>
</body>
</html>
