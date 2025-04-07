<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Sanitize input
    $name    = htmlspecialchars(strip_tags(trim($_GET["name"])));
    $email   = filter_var(trim($_GET["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags(trim($_GET["subject"])));
    $message = htmlspecialchars(strip_tags(trim($_GET["message"])));

    // Validate input
    if (empty($name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please complete the form correctly.";
        exit;
    }

    $to      = "your-email@example.com"; // 🔁 Replace with your actual email
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $body    = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Sorry, the email failed to send.";
    }
} else {
    echo "Invalid request.";
}
?>