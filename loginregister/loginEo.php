<?php
// Informasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventku";

try {
    // Koneksi ke database menggunakan PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Cek apakah form sudah disubmit menggunakan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data email dan password dari form POST
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM eo WHERE email_eo = :email LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Ambil hasil query
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cek apakah email ada di database
    if (!$user) {
        // Email tidak ditemukan
        echo "<script>
                alert('Email Anda salah.');
                window.location.href = 'loginEo.php';
              </script>";
        exit();
    } 
    
    // Verifikasi password jika email ditemukan
    if ($pass !== $user['password_eo']) {
        // Password salah
        echo "<script>
                alert('Password Anda salah.');
                window.location.href = 'loginEo.php';
              </script>";
        exit();
    }

    // Jika email dan password benar, arahkan ke halaman emailVerif.php
    header("Location: /loginregister/homeEo.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/loginEo.css"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Eventku</h1>
        <div class="auth-buttons">
            <a href="/loginregister/landingLogin.php">Masuk</a>
            <a href="/loginregister/landingRegister.php">Daftar</a>
        </div>
    </div>

    <!-- Auth Card -->
    <div class="auth-card">
        <h2>Masuk ke EO Eventku</h2>
        <form action="loginEo.php" method="POST">
    <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Email" required />
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required />
    </div>
    <div class="forgot-password">
        <a href="/loginregister/forgotPassword.php">Lupa password?</a>
    </div>
    <button type="submit" class="btn-full">Login</button>
    </form>

        <div class="auth-option">
            Belum mempunyai akun? <a href="/loginregister/landingRegister.php">Daftar</a>
        </div>
    </div>
</body>
</html>
