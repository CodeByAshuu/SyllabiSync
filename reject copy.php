<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "curriculum_admin";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $admin_name = $_POST['admin_name'];

    $query = "UPDATE course_curriculums SET status = 'Rejected', admin_name = '$admin_name', updated_at = NOW() WHERE id = $id";
    mysqli_query($conn, $query);
}

mysqli_close($conn);
header("Location: pendingApproval.php");
exit;
?>
