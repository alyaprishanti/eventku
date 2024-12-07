<?php
// Database connection information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventku";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // Query to check if email exists in EO table
    $sqlEO = "SELECT 'eo' AS role FROM eo WHERE email_eo = :email LIMIT 1";
    $stmtEO = $conn->prepare($sqlEO);
    $stmtEO->bindParam(':email', $email, PDO::PARAM_STR);
    $stmtEO->execute();
    $userEO = $stmtEO->fetch(PDO::FETCH_ASSOC);

    // Query to check if email exists in UMKM table
    $sqlUMKM = "SELECT 'umkm' AS role FROM umkm WHERE email_umkm = :email LIMIT 1";
    $stmtUMKM = $conn->prepare($sqlUMKM);
    $stmtUMKM->bindParam(':email', $email, PDO::PARAM_STR);
    $stmtUMKM->execute();
    $userUMKM = $stmtUMKM->fetch(PDO::FETCH_ASSOC);

    // Determine role based on which table contains the email
    if ($userEO) {
        $role = 'eo';
    } elseif ($userUMKM) {
        $role = 'umkm';
    } else {
        // If the email does not exist in either table
        echo "<script>alert('Email not found.'); window.location.href = 'forgotPassword.php';</script>";
        exit();
    }

    // Redirect to resetPassword.php with email and role
    echo "<form id='redirectForm' action='resetPassword.php' method='POST'>
            <input type='hidden' name='email' value='" . htmlspecialchars($email) . "' />
            <input type='hidden' name='role' value='" . htmlspecialchars($role) . "' />
          </form>
          <script>document.getElementById('redirectForm').submit();</script>";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Eventku</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/forgotPassword.css">
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

    <!-- Forgot Password Card -->
    <div class="auth-card">
        <h2>Lupa Password?</h2>
        <p>Masukkan email yang telah terdaftar pada Eventku</p>
        <form action="forgotPassword.php" method="POST">
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email" required />
            </div>
            <button type="submit" class="btn-full">Lanjutkan</button>
        </form>
        <div class="auth-option">
            Belum mempunyai akun? <a href="landingRegister.php">Daftar</a>
        </div>
    </div>
</body>
</html>
