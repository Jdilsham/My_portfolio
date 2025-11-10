<?php
// Enable error display on Heroku for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php'; 

// Check if form data exists
if (!isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    echo "Invalid form submission!";
    exit();
}

// Clean data
function clean($value) {
    return htmlspecialchars(trim($value));
}

$name    = clean($_POST['name']);
$email   = clean($_POST['email']);
$subject = clean($_POST['subject']);
$message = clean($_POST['message']);

try {

    // Create mail instance
    $mail = new PHPMailer(true);

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'janithadilsham@gmail.com';  
    $mail->Password = 'ptdazwhvnkfmuzli';        
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email sender & receiver
    $mail->setFrom('janithadilsham@gmail.com', 'Portfolio Contact');
    $mail->addAddress('janitha1717@gmail.com'); // receiver

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "Portfolio Contact Form: $subject";

    $mail->Body = "
        <h2>New Contact Message</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
    ";

    // Send
    if ($mail->send()) {
        echo "Message Sent Successfully!";
    } else {
        echo "Failed to send message.";
    }

} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
