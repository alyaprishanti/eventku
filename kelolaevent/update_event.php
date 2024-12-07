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

    $error_message = null; // Variable untuk menyimpan pesan error
    $uploaded_image = ''; // Variable untuk menyimpan nama gambar yang di-upload
    $target = null; // Variabel untuk gambar baru

    // Validasi input
    if (empty(trim($kategori)) || empty(trim($title)) || empty(trim($date)) || empty(trim($time_start)) || empty(trim($time_end)) || empty(trim($location))) {
        $error_message = "Semua field wajib diisi!";
    } elseif (!is_numeric($price)) {
        $error_message = "Harga sewa harus berupa angka!";
    } elseif (strtotime($time_end) < strtotime($time_start)) {
        $error_message = "Jam selesai tidak boleh lebih awal dari jam mulai!";
    }

    // Proses upload gambar baru jika ada
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        // Jika gambar tidak di-upload, biarkan $target null
    } elseif (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $error_message = "Gagal mengunggah gambar.";
        }
    }

    // Jika ada error, tampilkan popup error
    if ($error_message) {
        echo "
        <div id='popup' style='display: flex; position: fixed; top: 0; left: 0; width: 100%; height: 100%; justify-content: center; align-items: center; background-color: rgba(0, 0, 0, 0.5); z-index: 9999;'>
            <div style='background-color: #ffebe9; padding: 40px; border-radius: 15px; text-align: center; box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2); width: 400px;'>
                <div style='margin-bottom: 20px;'>
                    <div style='width: 70px; height: 70px; background-color: #ff4d4d; border-radius: 50%; margin: 0 auto; display: flex; justify-content: center; align-items: center;'>
                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white' width='40' height='40'>
                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' />
                        </svg>
                    </div>
                </div>
                <h3 style='font-family: Arial, sans-serif; font-size: 24px; color: #000;'>$error_message</h3>
                <button id='backButton' style='margin-top: 30px; padding: 15px 30px; background-color: #ffca28; border: none; border-radius: 8px; color: #000; font-size: 18px; cursor: pointer;'>Kembali</button>
            </div>
        </div>
        <script>
            document.getElementById('backButton').addEventListener('click', function() {
                window.location.href = 'edit_event.php?id=$eventId';
            });
        </script>
        ";
        exit; // Hentikan eksekusi jika ada error
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
        // Tampilkan pop-up berhasil
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
                <h3 style='font-family: Arial, sans-serif; font-size: 24px; color: #000;'>Event Berhasil Diupdate!</h3>
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
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
