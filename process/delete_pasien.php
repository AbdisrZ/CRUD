<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $conn->real_escape_string($_POST['id']);
    
    $query = "DELETE FROM pasien WHERE id = '$id'";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}

$conn->close();
?>