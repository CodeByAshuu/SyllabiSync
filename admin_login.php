<?php
session_start();

$adminId = 'admin';
$adminPassword = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputId = $_POST['admin_id'];
    $inputPassword = $_POST['admin_password'];

    if ($inputId === $adminId && $inputPassword === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials'); window.location.href = 'admin_login.html';</script>";
        exit();
    }
}
?>
