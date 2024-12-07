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
    $nama_eo = $conn->real_escape_string($_POST['nama_eo']);
    $alamat_eo = $conn->real_escape_string($_POST['alamat_eo']);
    $email_eo = $conn->real_escape_string($_POST['email_eo']);
    $nmr_telepon_eo = $conn->real_escape_string($_POST['nmr_telepon_eo']);
    $password_eo = $conn->real_escape_string($_POST['password_eo']);
    $konfirmasi_password_eo = $conn->real_escape_string($_POST['konfirmasi_password_eo']);

    // Check if passwords match
    if ($password_eo !== $konfirmasi_password_eo) {
        echo "Passwords do not match!";
        exit;
    }

    // Insert data into database
    $sql = "INSERT INTO eo (nama_eo, alamat_eo, email_eo, nmr_telepon_eo, password_eo) 
            VALUES ('$nama_eo', '$alamat_eo', '$email_eo', '$nmr_telepon_eo', '$password_eo')";

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
    <title>Eventku - Buat Akun EO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/registerEo.css"> 
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Eventku</h1>
        <div class="auth-buttons">
            <a href="landingLogin.php">Masuk</a>
            <a href="landingRegister.php">Daftar</a>
        </div>
    </div>
    <div class="register-card">
        <h2>Buat Akun EO</h2>
        <!-- Registration Form for EO -->
        <form method="POST" action="registerEo.php">
            <div>
                <label for="nama_eo">Nama Lengkap</label>
                <input type="text" id="nama_eo" name="nama_eo" placeholder="Nama Lengkap" required>
            </div>
            <div>
                <label for="alamat_eo">Alamat</label>
                <input type="text" id="alamat_eo" name="alamat_eo" placeholder="Alamat" required>
            </div>
            <div>
                <label for="email_eo">Email</label>
                <input type="email" id="email_eo" name="email_eo" placeholder="Email" required>
            </div>
            <div>
                <label for="nmr_telepon_eo">Nomor Telepon</label>
                <input type="text" id="nmr_telepon_eo" name="nmr_telepon_eo" placeholder="Nomor Telepon" required>
            </div>
            <div>
                <label for="password_eo">Password</label>
                <input type="password" id="password_eo" name="password_eo" placeholder="Password" required>
            </div>
            <div>
                <label for="konfirmasi_password_eo">Konfirmasi Password</label>
                <input type="password" id="konfirmasi_password_eo" name="konfirmasi_password_eo" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="btn-submit">Buat Akun</button>
        </form>
        <div class="auth-option">
            Sudah mempunyai akun? <a href="landingLogin.php">Login</a>
        </div>
    </div>
</body>
</html>