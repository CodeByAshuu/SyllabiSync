<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend_backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $updateQuery = "UPDATE syllabus_approvals SET status='Approved', admin_feedback='', processed_at=NOW() WHERE id=$id";
    mysqli_query($conn, $updateQuery);
}

mysqli_close($conn);
header("Location: pendingApproval.php");
exit;
