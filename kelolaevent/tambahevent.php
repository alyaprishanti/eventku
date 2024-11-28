<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori = $_POST['kategori'] ?? '';
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $time_start = $_POST['time_start'] ?? '';
    $time_end = $_POST['time_end'] ?? '';
    $location = $_POST['location'] ?? '';
    $price = $_POST['price'] ?? 0;
    $booth_count = $_POST['booth_count'] ?? '';
    $description = $_POST['description'] ?? '';

    // Validasi input
    if (empty($kategori) || empty($title) || empty($date) || empty($time_start) || empty($time_end) || empty($location)) {
        die("Error: Semua field wajib diisi!");
    }

    // Validasi khusus untuk price (harga sewa)
    if (!is_numeric($price)) {
        die("Error: Harga sewa harus berupa angka!");
    }

    // Validasi file upload
    $target = null; // Default jika tidak ada gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            die("Error: Gagal mengupload file.");
        }
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO events (kategori, title, date, time_start, time_end, location, price, booth_count, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    // Perbaikan: Parameter binding menggunakan 's' untuk semua field kecuali price yang menggunakan 'i'
    $stmt->bind_param("ssssssisss", $kategori, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description, $target);

    if ($stmt->execute()) {
        // Jika berhasil, tampilkan pop-up
        echo "
        <div id='popup' style='display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center; background-color: rgba(0, 0, 0, 0.5); z-index: 9999;'>
            <div style='background-color: #fffbea; padding: 40px; border-radius: 15px; text-align: center; box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2); width: 400px;'>
                <div style='margin-bottom: 20px;'>
                    <div style='width: 70px; height: 70px; background-color: #32cd32; border-radius: 50%; margin: 0 auto; display: flex; justify-content: center; align-items: center;'>
                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white' width='40' height='40'>
                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' />
                        </svg>
                    </div>
                </div>
                <h3 style='font-family: Arial, sans-serif; font-size: 24px; color: #000;'>Event Berhasil Dibuat!</h3>
                <button id='backButton' style='margin-top: 30px; padding: 15px 30px; background-color: #ffca28; border: none; border-radius: 8px; color: #000; font-size: 18px; cursor: pointer;'>Kembali</button>
            </div>
        </div>
        <script>
            document.getElementById('backButton').addEventListener('click', function() {
                window.location.href = 'dashboard.php';
            });
        </script>
        ";
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
            .button-group .btn {
        text-decoration: none;
        box-shadow: none;
        transition: none;
    }

    .btn-primary {
        background-color: #ffca28;
        border: none;
        color: #000; /* Warna teks tombol Simpan */
        cursor: pointer;
    }

    .btn-secondary {
        background-color: #fff; /* Warna latar tombol Batal */
        border: 1px solid #ddd;
        color: #000; /* Warna teks tombol Batal */
        cursor: pointer;
    }

    /* Hilangkan hover effect */
    .btn-primary:hover,
    .btn-secondary:hover {
        background-color: inherit;
        color: inherit;
    }
        body {
            background-color: #FFF9EB;
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .navbar {
            background-color: #FFC533;
            padding: 1rem;
        }
        .navbar-brand {
            font-size: 32px;
            font-weight: bold;
        }
        .nav-link {
            font-weight: bold;
            font-size: 20px;
            margin-right: 40px;
        }
        .user-box {
            background-color: #12101C;
            color: #FFC533;
            padding: 8px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
        }
        .user-icon {
            font-size: 24px;
            margin-right: 8px;
        }
        .content-container {
            margin-top: 50px;
        }
        .form-container {
            display: flex;
            gap: 30px;
        }
        .left-section, .right-section {
            flex: 1;
        }
        .upload-section {
            border: 2px dashed #FFC533;
            padding: 40px;
            text-align: center;
            border-radius: 12px;
            background-color: #FFF9EB;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }
        .upload-section label {
            font-weight: bold;
            color: #12101C;
            display: block;
            margin-bottom: 20px;
        }
        .upload-section input {
            display: none; /* Hide the input but keep functionality */
        }
        .upload-section img {
            max-width: 100%;
            max-height: 250px;
            display: none;
            margin-top: 20px;
            border-radius: 8px;
        }
        .upload-info {
            display: flex;
            justify-content: space-between; /* Atur kiri-kanan */
            font-size: 14px;
            color: #888888;
            margin-top: 15px;
        }
        .upload-info div {
            flex: 1;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        .form-control {
            border-radius: 8px;
            padding: 10px;
        }
        .row {
            margin-bottom: 20px;
        }
        .btn {
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #FFC533;
            border: none;
            color: #12101C;
        }
        .btn-secondary {
            background-color: white;
            border: 1px solid #ddd;
        }
        .btn-secondary:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Eventku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kelola Event</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">FAQ & Support</a></li>
                    <li class="nav-item">
                        <div class="user-box">
                            <i class="fa-solid fa-user user-icon"></i>
                            <span>EO</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Tambah Event -->
    <div class="container content-container">
        <h1>Tambah Event</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <!-- Bagian Kiri -->
                <div class="left-section">
                    <div class="upload-section">
                        <label for="image">
                            <i class="fa-solid fa-upload" style="font-size: 24px;"></i>
                            <br>Letakkan poster event Anda di sini atau
                            <span style="color: #FFC533; cursor: pointer;">Pilih file</span>
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        <img id="preview" alt="Preview Gambar">
                    </div>
                    <div class="upload-info">
                        <div>Supported format: PNG, JPG, PDF</div>
                        <div>Ukuran maksimum: 25MB</div>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div class="right-section">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan kategori event" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Nama Event</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan nama event" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="time_start">Jam Mulai</label>
                            <input type="time" class="form-control" id="time_start" name="time_start" required>
                        </div>
                        <div class="col">
                            <label for="time_end">Jam Selesai</label>
                            <input type="time" class="form-control" id="time_end" name="time_end" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Masukkan deskripsi event" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="price">Harga Sewa</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Masukkan harga sewa" required>
                        </div>
                        <div class="col">
                            <label for="booth_count">Jumlah Booth</label>
                            <input type="number" class="form-control" id="booth_count" name="booth_count" placeholder="Masukkan jumlah booth" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location">Lokasi</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Masukkan lokasi event" required>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='dashboard.php'">Batal</button>
                    </div>
                    <br>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
