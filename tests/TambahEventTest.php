<?php
// tests/TambahEventTest.php

// Mengimpor fungsi createEvent dari file testingunit/createevent.php
require_once __DIR__ . '/../testingunit/createevent.php';

use PHPUnit\Framework\TestCase;

class TambahEventTest extends TestCase
{
    // Test Case: Create Event - Success
    public function testCreateEventSuccess()
    {
        // Simulasi input yang valid
        $kategori = "Musik";
        $title = "Konser Musik 2024";
        $date = "2024-12-01";
        $time_start = "18:00";
        $time_end = "21:00";
        $location = "Jakarta";
        $price = 500000;
        $booth_count = 10;
        $description = "Konser musik terbesar tahun 2024";

        // Panggil fungsi yang diuji
        $result = createEvent($kategori, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description);

        // Periksa apakah hasilnya sesuai yang diharapkan
        $this->assertEquals("Event 'Konser Musik 2024' berhasil dibuat pada 2024-12-01 di Jakarta.", $result);
    }

    // Test Case: Create Event - Validation Error (Field Kosong)
    public function testCreateEventValidationErrorEmptyField()
    {
        // Simulasi input dengan field kosong
        $kategori = "Musik";
        $title = "";
        $date = "2024-12-01";
        $time_start = "18:00";
        $time_end = "21:00";
        $location = "Jakarta";
        $price = 500000;
        $booth_count = 10;
        $description = "Konser musik terbesar tahun 2024";

        // Panggil fungsi yang diuji
        $result = createEvent($kategori, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description);

        // Periksa apakah pesan error muncul
        $this->assertEquals("Error: Semua field wajib diisi!", $result);
    }
}
