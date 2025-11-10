<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';   // ✅ correct path

// Validate function
function validate($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check fields
if (!isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {
    die("Error: Missing fields.");
}

// Sanitize
$name    = validate($_POST['name']);
$email   = validate($_POST['email']);
$subject = validate($_POST['subject']);
$message = validate($_POST['message']);

// Create PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'janithadilsham@gmail.com';      // Your Gmail
    $mail->Password   = 'uhnkysnkyaffmvwm';              // App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // From & To
    $mail->setFrom('janithadilsham@gmail.com', 'Portfolio Contact Form');
    $mail->addAddress('janitha1717@gmail.com', 'Janitha Dilsham');

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Message: " . $subject;
    $mail->Body = "
        <h2>New Portfolio Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Subject:</strong> {$subject}</p>
        <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
    ";

    // Send email
    $mail->send();

    echo "<script>
        alert('Message sent successfully!');
        window.location.href = '../contact.html';
    </script>";
    
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
