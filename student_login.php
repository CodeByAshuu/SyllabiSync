<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frontend&backend";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();
        if (password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['student_username'] = $student['username'];
            header("Location: landing_page.php");
            exit;
        }
    }

    echo "<script>alert('Invalid credentials'); window.history.back();</script>";
}

$conn->close();
?>
