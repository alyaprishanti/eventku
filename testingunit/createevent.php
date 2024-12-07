<?php
// testingunit/createevent.php

function createEvent($kategori, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description, $image = null) {
    // Validasi input
    if (empty($kategori) || empty($title) || empty($date) || empty($time_start) || empty($time_end) || empty($location)) {
        return "Error: Semua field wajib diisi!";
    }

    // Validasi harga
    if (!is_numeric($price)) {
        return "Error: Harga sewa harus berupa angka!";
    }

    // Simulasi penyimpanan data ke database (di sini bisa menggunakan mock untuk pengujian)
    return "Event '$title' berhasil dibuat pada $date di $location.";
}
