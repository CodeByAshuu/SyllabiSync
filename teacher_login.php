<?php
header('Content-Type: application/json');

// Database connection
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
    if (empty($data['idNumber']) || empty($data['password'])) {
        echo json_encode(['success' => false, 'error' => "ID Number and password are required"]);
        exit;
    }
    
    // Find teacher
    $stmt = $conn->prepare("SELECT id, full_name, id_number, password FROM teachers WHERE id_number = ?");
    $stmt->bind_param("s", $data['idNumber']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'error' => "Invalid credentials"]);
        exit;
    }
    
    $teacher = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($data['password'], $teacher['password'])) {
        // Start session (you may want to use JWT in production)
        session_start();
        $_SESSION['teacher_id'] = $teacher['id'];
        $_SESSION['teacher_name'] = $teacher['full_name'];
      $_SESSION['id_number']=(int)$teacher['id_number']; // Assuming id_number is an integer this is new code
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => "Invalid credentials"]);
    }
    exit;
}

$conn->close();
?>