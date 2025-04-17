<?php
$to = "sagarsahu5976@gmail.com";
$subject = "Test Mail";
$message = "This is a test email sent from PHP using Gmail SMTP.";
$headers = "From: sagarsahu5976@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Mail sent successfully.";
} else {
    echo "Mail sending failed.";
}
?>
