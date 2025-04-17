<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend_backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["admin_feedback"])) {
    $id = $_POST["id"];
    $feedback = mysqli_real_escape_string($conn, $_POST["admin_feedback"]);
    $updateQuery = "UPDATE syllabus_approvals SET status='Rejected', admin_feedback='$feedback', processed_at=NOW() WHERE id=$id";
    mysqli_query($conn, $updateQuery);
}

mysqli_close($conn);
header("Location: pendingApproval.php");
exit;
