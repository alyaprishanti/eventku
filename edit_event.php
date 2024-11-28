<?php
include 'db.php';

// Mendapatkan ID event dari URL
$eventId = $_GET['id'];

// Mendapatkan detail event dari database
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/tambahevent.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Eventku</a>
            <button class="navbar-toggler" type="button" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="navbar-nav" id="navbarNav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kelola Event</a>
                </li>
                <li class="nav-item">
                    <div class="user-box">
                        <i class="fa-solid fa-user user-icon"></i>
                        <span>EO</span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Form Content -->
    <div class="content-container">
        <h1 class="kelola-title">Edit Event</h1>
        <div class="form-container">
            <div class="left-section">
                <div class="upload-section">
                    <div class="image-preview" id="imagePreviewContainer">
                        <img id="imagePreview" src="<?= htmlspecialchars($event['image']) ?>" alt="Preview Gambar" style="max-width: 100%; height: auto; margin-top: 10px;">
                    </div>
                    <p class="upload-text">Letakkan poster event Anda di sini atau</p>
                    <input type="file" class="form-control" id="eventImage" name="image" accept="image/*" onchange="updateImagePreview(event)">
                </div>
                <div class="info-row">
                    <div class="info-text">Supported format: PNG, JPG, PDF</div>
                    <div class="info-text">Ukuran maksimum: 25 MB</div>
                </div>
            </div>

            <div class="right-section">
                <form action="update_event.php" method="POST" enctype="multipart/form-data">
                    <!-- Kirim ID event ke server -->
                    <input type="hidden" name="id" value="<?= $eventId ?>">

                    <div class="form-group-horizontal">
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="kategori" value="<?= htmlspecialchars($event['kategori']) ?>" placeholder="Kategori">
                    </div>

                    <div class="form-group-horizontal">
                        <label for="nama-event">Nama Event</label>
                        <input type="text" id="nama-event" name="title" value="<?= htmlspecialchars($event['title']) ?>" placeholder="Nama Event">
                    </div>

                    <div class="form-row">
                        <div class="form-group-horizontal">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" id="tanggal" name="date" value="<?= htmlspecialchars($event['date']) ?>" required>
                        </div>
                        <div class="form-group-horizontal">
                            <label for="waktu">Jam Mulai</label>
                            <input type="time" id="waktu" name="time_start" value="<?= htmlspecialchars($event['time_start']) ?>" required>
                        </div>
                        <div class="form-group-horizontal">
                            <label for="waktu_akhir">Jam Selesai</label>
                            <input type="time" id="waktu_akhir" name="time_end" value="<?= htmlspecialchars($event['time_end']) ?>" required>
                        </div>
                    </div>

                    <div class="form-group-horizontal">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="description" placeholder="Deskripsi lengkap event" required><?= htmlspecialchars($event['description']) ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group-horizontal">
                            <label for="harga">Harga Sewa</label>
                            <input type="text" id="harga" name="price" value="<?= htmlspecialchars($event['price']) ?>" placeholder="Rp50.000" required>
                        </div>
                        <div class="form-group-horizontal">
                            <label for="booth">Jumlah Booth</label>
                            <input type="number" id="booth" name="booth_count" value="<?= htmlspecialchars($event['booth_count']) ?>" placeholder="35" required>
                        </div>
                    </div>

                    <div class="form-group-horizontal">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="location" value="<?= htmlspecialchars($event['location']) ?>" placeholder="Lokasi event" required>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn btn-cancel" onclick="window.location.href='index.php'">Batal</button>
                        <button type="submit" class="btn btn-submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateImagePreview(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
