<?php
// session_start();
// header('Content-Type: application/json');
include 'config.php'; // contains DB connection

if(isset($POST['signUp'])){
    $name = $_POST['name1'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($password);
    
    $checkEmail="SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'User already exists.']);
        exit;
    }else{
        $insertQuery = "INSERT INTO users (name1, phone, email, password) VALUES ($name, $phone, $email, $password)";

        if($conn->query($insertQuery) === TRUE) {
            header('Location: ../landing_page.php');
        } else {
            echo json_encode(['success' => false, 'message' => 'Signup failed. Try again.']);
        }
    }
}

if(isset($POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password); //encryption

    
    $checkEmail="SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();

        if($row['password'] == md5($password)){
            header('Location: ../landing_page.php');
        }else{
            echo json_encode(['success' => false, 'message' => 'Invalid password.']);
        }
    }else{
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }
}

$conn->close();
// header('Location: ../index.php'); // Redirect to the index page after processing
// exit;
?>
