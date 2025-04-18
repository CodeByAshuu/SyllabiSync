<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Database connection failed"]));
}

// Update teacher data
$stmt = $conn->prepare("UPDATE teachers SET 
    full_name = ?,
    gender = ?,
    country = ?,
    id_number = ?,
    university_name = ?
    WHERE id = ?");
    
$stmt->bind_param("sssssi", 
    $data['fullName'],
    $data['gender'],
    $data['country'],
    $data['idNumber'],
    $data['universityName'],
    $_SESSION['teacher_id']
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>