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

// Check if form has been submitted with new password fields
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    // Retrieve email, role, and new passwords from POST data
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    $newPassword = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Check if new password and confirmation password match
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.'); window.history.back();</script>";
        exit();
    }

    // Determine the correct table and columns based on the user's role
    if ($role === 'eo') {
        $table = 'eo';
        $emailColumn = 'email_eo';
        $passwordColumn = 'password_eo';
    } elseif ($role === 'umkm') {
        $table = 'umkm';
        $emailColumn = 'email_umkm';
        $passwordColumn = 'password_umkm';
    } else {
        echo "<script>alert('Invalid user role.'); window.location.href = 'forgotPassword.php';</script>";
        exit();
    }

    // Update the password in the correct table
    $sql = "UPDATE $table SET $passwordColumn = :newPassword WHERE $emailColumn = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    // Execute the update query
    if ($stmt->execute()) {
        echo "<script>alert('Password has been successfully updated.'); window.location.href = 'landingLogin.php';</script>";
    } else {
        echo "<script>alert('Failed to update password. Please try again.'); window.history.back();</script>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/resetPassword.css"> 
</head>
<body>
    <!-- Header with links -->
    <div class="header">
        <h1>Eventku</h1>
        <div class="auth-buttons">
            <a href="loginregister/landingLogin.php">Masuk</a>
            <a href="loginregister/landingRegister.php">Daftar</a>
        </div>
    </div>
    <!-- Password reset form -->
    <div class="reset-card">
        <h2>Atur password baru</h2>
        <p>Masukkan kata sandi baru minimal 8 karakter</p>
        <form action="resetPassword.php" method="POST">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
            <input type="hidden" name="role" value="<?php echo htmlspecialchars($_POST['role'] ?? ''); ?>" />
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required minlength="8" />
            
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required minlength="8" />
            
            <button type="submit">Lanjutkan</button>
        </form>
    </div>

</body>
</html>

