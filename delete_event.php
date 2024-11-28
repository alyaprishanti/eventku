<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $eventId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    $stmt->close();
    $conn->close();
}
