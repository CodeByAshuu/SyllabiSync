<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Connection failed: " . $conn->connect_error]));
}

// Fetch individual file details
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fileName'])) {
    $fileName = $conn->real_escape_string($_GET['fileName']);
    
    $sql = "SELECT teacher_id, university_name FROM syllabus_approvals WHERE file_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fileName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'teacherId' => $row['teacher_id'],
            'universityName' => $row['university_name']
        ]);
    } else {
        echo json_encode([
            'teacherId' => '',
            'universityName' => ''
        ]);
    }
    exit;
}

// Get pending PDFs
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT file_name FROM syllabus_approvals WHERE status = 'pending'";
    $result = $conn->query($sql);
    
    $pdfFiles = [];
    while ($row = $result->fetch_assoc()) {
        $pdfFiles[] = $row['file_name'];
    }
    
    echo json_encode($pdfFiles);
    exit;
}

// Handle approval/rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $fileName = $conn->real_escape_string($data['fileName']);
    $action = $data['action'];
    
    // First get the current values from database
    $currentValues = [];
    $getSql = "SELECT teacher_id, university_name FROM syllabus_approvals WHERE file_name = ?";
    $stmt = $conn->prepare($getSql);
    $stmt->bind_param("s", $fileName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $currentValues = $result->fetch_assoc();
    }
    
    // Prepare update data
    $status = $action === 'approve' ? 'approved' : 'rejected';
    $subjectName = isset($data['subjectName']) ? $conn->real_escape_string($data['subjectName']) : null;
    $stream = isset($data['stream']) ? $conn->real_escape_string($data['stream']) : null;
    $teacherId = $currentValues['teacher_id'] ?? null; // Always preserve existing teacher_id
    $universityName = $currentValues['university_name'] ?? null; // Always preserve existing university_name
    $feedback = isset($data['feedback']) ? $conn->real_escape_string($data['feedback']) : null;
    
    // Build the update query
    $updateFields = [
        "status = '$status'",
        "processed_at = CURRENT_TIMESTAMP"
    ];
    
    // Only update subject_name and stream if approving
    if ($action === 'approve') {
        if ($subjectName) $updateFields[] = "subject_name = '$subjectName'";
        if ($stream) $updateFields[] = "stream = '$stream'";
    }
    
    // Always preserve teacher_id and university_name
    if ($teacherId) $updateFields[] = "teacher_id = '$teacherId'";
    if ($universityName) $updateFields[] = "university_name = '$universityName'";
    
    // Set feedback for rejection
    if ($action === 'reject' && $feedback) {
        $updateFields[] = "admin_feedback = '$feedback'";
    }
    
    $sql = "UPDATE syllabus_approvals SET " . implode(', ', $updateFields) . " WHERE file_name = '$fileName'";
    
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

$conn->close();
?>