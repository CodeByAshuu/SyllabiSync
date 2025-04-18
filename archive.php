<?php
session_start();
// Directory where PDFs are stored
$id_number = $_SESSION['id_number'];

$id_number = (int)$id_number;
//echo $id_number;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";
$conn = new mysqli($servername, $username, $password, $dbname);


$uploadDir = 'uploads/';

// Get the list of all files in the directory
$files = scandir($uploadDir);

// Remove '.' and '..' from the array
$files = array_diff($files, array('.', '..'));

// Filter out only the PDF files
$pdfFiles = array_filter($files, function($file) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
});

$query = "SELECT id, file_name, subject_name, stream, admin_feedback, uploaded_at, processed_at FROM syllabus_approvals
WHERE teacher_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_number);
$stmt->execute();
$result = $stmt->get_result();

// Return the list of PDF files as a JSON response
$approvals = [];
while ($row = $result->fetch_assoc()) {
    $approvals[] = $row['file_name'];
}

// Filter the PDF files based on the file names in the database
$matchingPdfFiles = array_intersect($pdfFiles, $approvals);

// Return the matching PDF files as a JSON response
echo json_encode(array_values($matchingPdfFiles));

?>
