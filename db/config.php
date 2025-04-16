<?php
session_start(); // Start the session

$host = "localhost";  // or use "127.0.0.1"
$username = "root";   // MySQL username
$password = "";       // MySQL password
$database = "aicte";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
