<?php
// tests/DeleteEventTest.php

// Mengimpor fungsi deleteEvent dari file testingunit/deleteevent.php
require_once __DIR__ . '/../testingunit/deleteevent.php';

use PHPUnit\Framework\TestCase;

class DeleteEventTest extends TestCase
{
    // Test Case: Delete Event - Success
    public function testDeleteEventSuccess()
    {
        // Simulasi ID event yang valid
        $id = 1;

        // Panggil fungsi yang diuji
        $result = deleteEvent($id);

        // Periksa apakah hasilnya sesuai yang diharapkan
        $this->assertEquals("Event dengan ID 1 berhasil dihapus!", $result);
    }

    // // Test Case: Delete Event - Event Not Found
    // public function testDeleteEventNotFound()
    // {
    //     // Simulasi ID tidak valid
    //     $id = -1;

    //     // Panggil fungsi yang diuji
    //     $result = deleteEvent($id);

    //     // Periksa apakah pesan error muncul
    //     $this->assertEquals("Error: Event tidak ditemukan!", $result);
    // }
}
