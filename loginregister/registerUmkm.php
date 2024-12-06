<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventku";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is POST for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap_umkm = $conn->real_escape_string($_POST['nama_lengkap_umkm']);
    $alamat_umkm = $conn->real_escape_string($_POST['alamat_umkm']);
    $email_umkm = $conn->real_escape_string($_POST['email_umkm']);
    $nmr_telepon_umkm = $conn->real_escape_string($_POST['nmr_telepon_umkm']);
    $nama_usaha_umkm = $conn->real_escape_string($_POST['nama_usaha_umkm']);
    $bidang_usaha_umkm = $conn->real_escape_string($_POST['bidang_usaha_umkm']);
    $password_umkm = $conn->real_escape_string($_POST['password_umkm']);
    $konfirmasi_password_umkm = $conn->real_escape_string($_POST['konfirmasi_password_umkm']);

    // Check if passwords match
    if ($password_umkm !== $konfirmasi_password_umkm) {
        echo "Passwords do not match!";
        exit;
    }

    // Insert data into database
    $sql = "INSERT INTO umkm (nama_lengkap_umkm, alamat_umkm, email_umkm, nmr_telepon_umkm, nama_usaha_umkm, bidang_usaha_umkm, password_umkm) 
        VALUES ('$nama_lengkap_umkm', '$alamat_umkm', '$email_umkm', '$nmr_telepon_umkm', '$nama_usaha_umkm', '$bidang_usaha_umkm', '$password_umkm')";

    if ($conn->query($sql) === TRUE) {
        header('Location: emailVerif.php'); // Redirect to email verification page
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventku - Buat Akun UMKM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/registerUmkm.css"> 
</head>
<body>
    <div class="header">
        <h1>Eventku</h1>
        <div class="auth-buttons">
            <a href="/loginregister/landingLogin.php">Masuk</a>
            <a href="/loginregister/landingRegister.php">Daftar</a>
        </div>
    </div>
    <div class="register-card">
        <h2>Buat Akun UMKM</h2>
        <!-- Registration Form for UMKM -->
        <form method="POST" action="registerUmkm.php">
    <div>
        <label for="nama_lengkap_umkm">Nama Lengkap</label>
        <input type="text" id="nama_lengkap_umkm" name="nama_lengkap_umkm" placeholder="Nama Lengkap" required>
    </div>
    <div>
        <label for="alamat_umkm">Alamat</label>
        <input type="text" id="alamat_umkm" name="alamat_umkm" placeholder="Alamat" required>
    </div>
    <div>
        <label for="email_umkm">Email</label>
        <input type="email" id="email_umkm" name="email_umkm" placeholder="Email" required>
    </div>
    <div>
        <label for="nmr_telepon_umkm">Nomor Telepon</label>
        <input type="text" id="nmr_telepon_umkm" name="nmr_telepon_umkm" placeholder="Nomor Telepon" required>
    </div>
    <div>
        <label for="nama_usaha_umkm">Nama Usaha</label>
        <input type="text" id="nama_usaha_umkm" name="nama_usaha_umkm" placeholder="Nama Usaha" required>
    </div>
    <div>
        <label for="bidang_usaha_umkm">Bidang Usaha</label>
        <input type="text" id="bidang_usaha_umkm" name="bidang_usaha_umkm" placeholder="Bidang Usaha" required>
    </div>
    <div>
        <label for="password_umkm">Password</label>
        <input type="password" id="password_umkm" name="password_umkm" placeholder="Password" required>
    </div>
    <div>
        <label for="konfirmasi_password_umkm">Konfirmasi Password</label>
        <input type="password" id="konfirmasi_password_umkm" name="konfirmasi_password_umkm" placeholder="Konfirmasi Password" required>
    </div>
    <button type="submit" class="btn-submit">Buat Akun</button>
    </form>
        <div class="auth-option">
            Sudah mempunyai akun? <a href="/loginregister/landingLogin.php">Login</a>
        </div>
    </div>
</body>
</html>