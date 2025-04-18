<?php
session_start();
header('Content-Type: application/json');

// Database connection
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "frontend&backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Connection failed: " . $conn->connect_error]));
}

// Get teacher ID from session (using sample IDs for demonstration)
$teacher_id = isset($_SESSION['id_number']) ? $_SESSION['id_number'] : '1234567';

// Fetch teacher's syllabi
$sql = "SELECT 
            id,
            file_name as title,
            subject_name as code,
            status,
            teacher_id,
            uploaded_at as lastUpdated
        FROM syllabus_approvals
        WHERE teacher_id = ?
        ORDER BY uploaded_at DESC
        LIMIT 5";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();

$syllabi = [];
while ($row = $result->fetch_assoc()) {
    $syllabi[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'code' => $row['code'],
        'status' => $row['status'],
        'teacher_id' => $row['teacher_id'],
        'lastUpdated' => $row['lastUpdated']
    ];
}

// Count different statuses for this teacher
$statusCounts = [
    'approved' => 0,
    'pending' => 0,
    'rejected' => 0
];

// Also get counts for all teacher's syllabi
$countSql = "SELECT 
                status, 
                COUNT(*) as count 
             FROM syllabus_approvals 
             WHERE teacher_id = ?
             GROUP BY status";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("s", $teacher_id);
$countStmt->execute();
$countResult = $countStmt->get_result();

while ($row = $countResult->fetch_assoc()) {
    if (isset($statusCounts[$row['status']])) {
        $statusCounts[$row['status']] = $row['count'];
    }
}

// Prepare response
$response = [
    'success' => true,
    'data' => [
        'syllabi' => $syllabi,
        'stats' => [
            'active' => $statusCounts['approved'] + $statusCounts['pending'],
            'pending' => $statusCounts['pending'],
            'approved' => $statusCounts['approved'],
            'revisions' => $statusCounts['rejected'],
            'active_change' => rand(1, 5),
            'approved_change' => rand(1, 3)
        ]
    ]
];

echo json_encode($response);

$conn->close();
?>