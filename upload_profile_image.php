<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['teacher_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

if (!isset($_FILES['profileImage'])) {
    echo json_encode(['success' => false, 'error' => 'No image uploaded']);
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Database connection failed"]));
}

// Upload directory
$uploadDir = 'profile_images/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Generate unique filename
$extension = pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
$filename = 'teacher_' . $_SESSION['teacher_id'] . '_' . time() . '.' . $extension;
$targetPath = $uploadDir . $filename;

// Move uploaded file
if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetPath)) {
    // Update database with image path
    $stmt = $conn->prepare("UPDATE teachers SET profile_image = ? WHERE id = ?");
    $stmt->bind_param("si", $targetPath, $_SESSION['teacher_id']);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'imagePath' => $targetPath]);
    } else {
        unlink($targetPath); // Delete the uploaded file if DB update fails
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to upload image']);
}

$conn->close();
?>