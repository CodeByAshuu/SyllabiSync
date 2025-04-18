<?php
header("Content-Type: application/json");
session_start();
if (!isset($_SESSION['teacher_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";

// Create connection (consider using PDO for better security)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}
//new code inserted
$teacherStmt = $conn->prepare("SELECT id_number, university_name FROM teachers WHERE id = ?");
$teacherStmt->bind_param("i", $_SESSION['teacher_id']);
$teacherStmt->execute();
$teacherResult = $teacherStmt->get_result();

if ($teacherResult->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Teacher not found']);
    exit;
}

$teacher = $teacherResult->fetch_assoc();
$idNumber = $teacher['id_number'];
$universityName = $teacher['university_name'];
//new code end 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["pdf"])) {
        // Validate file type
        $fileType = strtolower(pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION));
        if ($fileType !== "pdf") {
            http_response_code(400);
            echo json_encode(["message" => "Only PDF files are allowed."]);
            exit;
        }

        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                http_response_code(500);
                echo json_encode(["message" => "Could not create upload directory."]);
                exit;
            }
        }

        // Generate unique filename to prevent overwrites
        $filename = uniqid() . '_' . basename($_FILES["pdf"]["name"]);
        $target = $uploadDir . $filename;

        if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $target)) {
            // Prepare SQL statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO syllabus_approvals (file_name, teacher_id, university_name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $filename, $idNumber, $universityName);
            
            if ($stmt->execute()) {
                echo json_encode([
                    "message" => "Success", 
                    "filename" => $filename,
                    "id" => $stmt->insert_id
                ]);
            } else {
                // Delete the uploaded file if DB insert fails
                unlink($target);
                http_response_code(500);
                echo json_encode(["message" => "Database error: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Could not save file."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "No PDF uploaded."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Only POST allowed."]);
}

$conn->close();
?>