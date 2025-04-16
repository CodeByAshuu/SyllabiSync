<?php
require_once 'db/config.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Institute ID is required']);
    exit;
}

$id = (int)$_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM institutes WHERE id = ?");
    $stmt->execute([$id]);
    $institute = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$institute) {
        http_response_code(404);
        echo json_encode(['error' => 'Institute not found']);
        exit;
    }

    echo json_encode($institute);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
?>