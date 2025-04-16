<?php
session_start();
header('Content-Type: application/json');
require 'config.php'; // contains DB connection

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Check if user exists
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
    exit;
}

// Successful login
$_SESSION['user'] = $email;
echo json_encode(['success' => true, 'message' => 'Login successful']);
?>
