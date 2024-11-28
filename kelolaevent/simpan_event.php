<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $booth_count = $_POST['booth_count'];
    $description = $_POST['description'];

    // Debug: Tampilkan isi dari $_FILES untuk memastikan file dikirim
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    // Periksa apakah file gambar ada dalam $_FILES dan cek error
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Persiapan query untuk memasukkan data ke database
            $stmt = $conn->prepare("INSERT INTO events (title, date, time_start, time_end, location, price, booth_count, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssiiss", $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description, $target);

            // Eksekusi query dan cek hasil
            if ($stmt->execute()) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or an error occurred during upload.";
        // Tambahkan ini untuk melihat kode error
        if (isset($_FILES['image'])) {
            echo "Error code: " . $_FILES['image']['error'];
        }
    }
}
?>
