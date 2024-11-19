<?php
session_start();
require('db.php'); // Dodaj połączenie z bazą danych

header('Content-Type: application/json');

// Sprawdź, czy użytkownik jest zalogowany
if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Musisz być zalogowany.']);
    exit;
}

$userId = $_SESSION['id'];

// Pobierz dane z żądania
$data = json_decode(file_get_contents('php://input'), true);
$artId = $data['art_id'] ?? null;

if (!$artId) {
    echo json_encode(['status' => 'error', 'message' => 'Nieprawidłowy identyfikator arta.']);
    exit;
}

// Sprawdź, czy art jest już w ulubionych
$query = "SELECT * FROM likes WHERE user_id = ? AND art_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $userId, $artId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jeśli jest, usuń
    $deleteQuery = "DELETE FROM likes WHERE user_id = ? AND art_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param('ii', $userId, $artId);
    $deleteStmt->execute();
    echo json_encode(['status' => 'removed']);
} else {
    // Jeśli nie ma, dodaj
    $insertQuery = "INSERT INTO likes (user_id, art_id) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param('ii', $userId, $artId);
    $insertStmt->execute();
    echo json_encode(['status' => 'added']);
}
