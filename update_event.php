<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $eventId = $_POST['id'];
    $kategori = $_POST['kategori'] ?? '';
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $time_start = $_POST['time_start'] ?? '';
    $time_end = $_POST['time_end'] ?? '';
    $location = $_POST['location'] ?? '';
    $price = $_POST['price'] ?? 0;
    $booth_count = $_POST['booth_count'] ?? '';
    $description = $_POST['description'] ?? '';

    // Validasi input dasar
    if (empty($kategori) || empty($title) || empty($date) || empty($time_start) || empty($time_end) || empty($location)) {
        die("Error: Semua field wajib diisi!");
    }

    // Validasi khusus untuk price (harga sewa)
    if (!is_numeric($price)) {
        die("Error: Harga sewa harus berupa angka!");
    }

    // Proses upload gambar baru jika ada
    $target = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        // Pindahkan file ke folder 'uploads'
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            die("Error: Gagal mengupload file.");
        }
    }

    // Siapkan query update
    if ($target) {
        // Jika ada gambar baru
        $stmt = $conn->prepare("UPDATE events SET kategori = ?, title = ?, date = ?, time_start = ?, time_end = ?, location = ?, price = ?, booth_count = ?, description = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssssssisssi", $kategori, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description, $target, $eventId);
    } else {
        // Jika tidak ada gambar baru
        $stmt = $conn->prepare("UPDATE events SET kategori = ?, title = ?, date = ?, time_start = ?, time_end = ?, location = ?, price = ?, booth_count = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssssssissi", $kategori, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description, $eventId);
    }

    // Eksekusi query
    if ($stmt->execute()) {
        echo "
        <div id='popup' style='display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center; background-color: rgba(0, 0, 0, 0.2); z-index: 9999;'>
            <div style='background-color: #fffbea; padding: 30px; border-radius: 15px; text-align: center; box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2); width: 350px;'>
                <div style='margin-bottom: 20px;'>
                    <div style='width: 70px; height: 70px; background-color: #32cd32; border-radius: 50%; margin: 0 auto; display: flex; justify-content: center; align-items: center;'>
                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white' width='40' height='40'>
                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' />
                        </svg>
                    </div>
                </div>
                <h3 style='font-family: Arial, sans-serif; font-size: 20px; color: #000;'>Event Berhasil Diupdate!</h3>
                <button id='backButton' style='margin-top: 20px; padding: 10px 20px; background-color: #ffca28; border: none; border-radius: 5px; color: #000; font-size: 16px; cursor: pointer;'>Kembali</button>
            </div>
        </div>
        <script>
            document.getElementById('backButton').addEventListener('click', function() {
                window.location.href = 'index.php';
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