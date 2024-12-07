<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventku - Verifikasi Email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/emailVerif.css">
</head>
<body>
    <div class="header">
        <h1>Eventku</h1>
        <div class="auth-buttons">
            <a href="/login">Masuk</a>
            <a href="/register">Daftar</a>
        </div>
    </div>

    <div class="verification-card">
        <h2>Cek Emailmu</h2>
        <p>Sebuah email telah terkirim ke timotius05@gmail.com</p>

        <div class="code-inputs">
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
            <input type="text" maxlength="1" required>
        </div>

        <div class="resend-link">
            Tidak mendapat email? <a href="#">Klik disini</a>
        </div>

        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <button class="btn-half btn-cancel">Batalkan</button>
            <button class="btn-half btn-verify">Verifikasi</button>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="verificationModal" class="modal">
        <div class="modal-content">
            <div class="success-icon">
            <img src="/loginregister/checkICON.png" alt="Success">
            </div>
            <h3>Akun telah diverifikasi!</h3>
            <button id="loginButton" class="modal-button">Masuk</button>
        </div>
    </div>

    <script>
        // Input Focus Handling
        const inputs = document.querySelectorAll('.code-inputs input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                if (event.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && event.target.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Show Modal and Redirect
        document.querySelector('.btn-verify').addEventListener('click', function () {
            document.getElementById('verificationModal').style.display = 'flex';
        });
        
        document.getElementById('loginButton').addEventListener('click', function () {
            window.location.href = '/loginregister/landingLogin.php';
        });
    </script>
</body>
</html>
