<?php 
session_destroy(); // Destroy the session
header('Location: ../login.php'); // Redirect to the index page after processing
?>