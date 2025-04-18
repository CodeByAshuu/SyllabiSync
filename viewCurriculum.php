<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $conn = mysqli_connect("localhost", "root", "", "frontend&backend");
    if (!$conn) die("Connection failed: " . mysqli_connect_error());

    $id = intval($_GET['id']);
    $query = "SELECT file_name FROM syllabus_approvals WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Construct the correct file path
        $file = __DIR__ . "/uploads/" . $row['file_name'];  // Adjust the path to the uploads directory

        // Debugging output
        echo "File path: " . $file . "<br>";

        if (file_exists($file)) {
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=" . $row['file_name']);
            @readfile($file);
            exit;
        } else {
            echo "File not found: " . $file;
        }
    } else {
        echo "Invalid ID.";
    }

    mysqli_close($conn);
} else {
    echo "No ID specified.";
}
?>
