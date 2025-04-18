<?php
header('Content-Type: application/json');
session_start();

// Check if teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
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

// Get teacher data
$stmt = $conn->prepare("SELECT 
    full_name, 
    first_name, 
    gender, 
    country, 
    id_number, 
    university_name, 
    profile_image 
    FROM teachers WHERE id = ?");
$stmt->bind_param("i", $_SESSION['teacher_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $teacher = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'data' => [
            'fullName' => $teacher['full_name'],
            'firstName' => $teacher['first_name'],
            'gender' => $teacher['gender'],
            'country' => $teacher['country'],
            'idNumber' => $teacher['id_number'],
            'universityName' => $teacher['university_name'],
            'profileImage' => $teacher['profile_image'] ?: 'https://cdn-icons-png.freepik.com/256/12533/12533276.png'
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Teacher not found']);
}

$conn->close();
?>