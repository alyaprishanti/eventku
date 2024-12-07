<?php
// testingunit/updateevent.php

function updateEvent($id, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description) {
    // Validasi input
    if (empty($title) || empty($date) || empty($time_start) || empty($time_end) || empty($location)) {
        return "Error: Semua field wajib diisi!";
    }

    if (!is_numeric($price)) {
        return "Error: Harga sewa harus berupa angka!";
    }

    if (strtotime($time_end) < strtotime($time_start)) {
        return "Error: Jam selesai tidak boleh lebih awal dari jam mulai!";
    }

    // Simulasi update event di database (di sini bisa menggunakan mock untuk database)
    if ($id <= 0) {
        return "Error: Event tidak ditemukan!";
    }

    // Jika sukses
    return "Event '$title' berhasil diperbarui!";
}
