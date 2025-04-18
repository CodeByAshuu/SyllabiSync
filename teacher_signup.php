<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Database connection failed"]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate input
    $required = ['fullName', 'firstName', 'password', 'idNumber', 'universityName'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            echo json_encode(['success' => false, 'error' => "$field is required"]);
            exit;
        }
    }
    
    // Hash password
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    
   
    $stmt = $conn->prepare("INSERT INTO teachers 
        (full_name, first_name, password, id_number, university_name) 
        VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", 
        $data['fullName'],
        $data['firstName'],
        $hashedPassword,
        $data['idNumber'],
        $data['universityName']
    );
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'teacherId' => $stmt->insert_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

$conn->close();
?>