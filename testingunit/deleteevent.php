<?php
// testingunit/deleteevent.php

function deleteEvent($id) {
    if ($id <= 0) {
        return "Error: Event tidak ditemukan!";
    }

    // Simulasi penghapusan event dari database
    return "Event dengan ID $id berhasil dihapus!";
}
