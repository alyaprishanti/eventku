<?php
// tests/UpdateEventTest.php

// Mengimpor fungsi updateEvent dari file testingunit/updateevent.php
require_once __DIR__ . '/../testingunit/updateevent.php';

use PHPUnit\Framework\TestCase;

class UpdateEventTest extends TestCase
{
    // Test Case: Update Event - Success
    // public function testUpdateEventSuccess()
    // {
    //     // Simulasi input yang valid
    //     $id = 1;  // ID event yang valid
    //     $title = "Konser Musik 2024";
    //     $date = "2024-12-01";
    //     $time_start = "18:00";
    //     $time_end = "21:00";
    //     $location = "Jakarta";
    //     $price = 500000;
    //     $booth_count = 10;
    //     $description = "Konser musik terbesar tahun 2024";

    //     // Panggil fungsi yang diuji
    //     $result = updateEvent($id, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description);

    //     // Periksa apakah hasilnya sesuai yang diharapkan
    //     $this->assertEquals("Event 'Konser Musik 2024' berhasil diperbarui!", $result);
    // }

    // Test Case: Update Event - Validation Error (Invalid Time)
    public function testUpdateEventValidationErrorInvalidTime()
    {
        // Simulasi input dengan waktu yang tidak valid
        $id = 1;  // ID event yang valid
        $title = "Konser Musik 2024";
        $date = "2024-12-01";
        $time_start = "21:00";
        $time_end = "18:00";  // Jam selesai lebih awal dari jam mulai
        $location = "Jakarta";
        $price = 500000;
        $booth_count = 10;
        $description = "Konser musik terbesar tahun 2024";

        // Panggil fungsi yang diuji
        $result = updateEvent($id, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description);

        // Periksa apakah pesan error muncul
        $this->assertEquals("Error: Jam selesai tidak boleh lebih awal dari jam mulai!", $result);
    }

    // // Test Case: Update Event - Event Not Found
    // public function testUpdateEventNotFound()
    // {
    //     // Simulasi ID tidak valid
    //     $id = -1;  // ID event yang tidak valid
    //     $title = "Konser Musik 2024";
    //     $date = "2024-12-01";
    //     $time_start = "18:00";
    //     $time_end = "21:00";
    //     $location = "Jakarta";
    //     $price = 500000;
    //     $booth_count = 10;
    //     $description = "Konser musik terbesar tahun 2024";

    //     // Panggil fungsi yang diuji
    //     $result = updateEvent($id, $title, $date, $time_start, $time_end, $location, $price, $booth_count, $description);

    //     // Periksa apakah pesan error muncul
    //     $this->assertEquals("Error: Event tidak ditemukan!", $result);
    // }
}
