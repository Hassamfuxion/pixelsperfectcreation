<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars(trim($_POST['first-name']));
    $lastname  = htmlspecialchars(trim($_POST['last-name']));
    $email     = htmlspecialchars(trim($_POST['email']));
    $subject   = htmlspecialchars(trim($_POST['subject']));
    $message   = htmlspecialchars(trim($_POST['message']));

    // Check required fields
    if (empty($firstname) || empty($lastname) || empty($email) || empty($subject) || empty($message)) {
        echo "All fields are required!";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Recipient email
    $to = "hassamazam999@gmail.com";

    // Email subject
    $email_subject = "Contact Form: " . $subject;

    // Email body
    $email_body = "
        First Name: $firstname\n
        Last Name: $lastname\n
        Email: $email\n
        Subject: $subject\n
        Message:\n$message
    ";

    // Headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request!";
}
?>
