<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "frontend_backend";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT file_name FROM syllabus_approvals WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $file_name = $row['file_name'];
        $url = "uploads/" . $file_name;
        header("Location: $url");
        exit();
    } else {
        echo "Invalid ID or no file found for the given ID.";
    }
} else {
    echo "ID parameter is missing.";
}

mysqli_close($conn);
