<?php
require_once 'config.php';

// Function to send email
function sendConfirmationEmail($email) {
    $to = $email;
    $subject = "Welcome to SyllabiSync Newsletter";
    
    // HTML email template
    $message = '
    <html>
    <head>
        <title>Welcome to SyllabiSync Newsletter</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #3b82f6; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f9fafb; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #6b7280; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Welcome to SyllabiSync!</h1>
            </div>
            <div class="content">
                <p>Thank you for subscribing to our newsletter!</p>
                <p>You\'ll now receive updates about our latest features and special offers.</p>
                <p>If you did not subscribe to our newsletter, please ignore this email.</p>
            </div>
            <div class="footer">
                <p>© ' . date('Y') . ' SyllabiSync. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';
    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: SyllabiSync <noreply@syllabisync.com>\r\n";
    $headers .= "Reply-To: support@syllabisync.com\r\n";
    
    return mail($to, $subject, $message, $headers);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subscribe'])) {
    $response = ['success' => false, 'message' => ''];
    
    // Validate email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Please enter a valid email address.';
        echo json_encode($response);
        exit();
    }
    
    // Get database connection
    $conn = getDBConnection();
    if (!$conn) {
        $response['message'] = 'Database connection error. Please try again later.';
        echo json_encode($response);
        exit();
    }
    
    try {
        // Check if email already exists
        $check_sql = "SELECT id FROM newsletter_subscribers WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows > 0) {
            $response['message'] = 'This email is already subscribed to our newsletter.';
            echo json_encode($response);
            exit();
        }
        
        // Insert new subscriber
        $sql = "INSERT INTO newsletter_subscribers (email, subscription_date) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            // Send confirmation email
            if (sendConfirmationEmail($email)) {
                $response['success'] = true;
                $response['message'] = 'Thank you for subscribing to our newsletter!';
            } else {
                $response['message'] = 'Subscription successful, but confirmation email could not be sent.';
            }
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
        
    } catch (Exception $e) {
        error_log("Newsletter subscription error: " . $e->getMessage());
        $response['message'] = 'An error occurred. Please try again later.';
    }
    
    echo json_encode($response);
    exit();
}

// If not a POST request, redirect to contact page
header("Location: contact.php");
exit();
?> 