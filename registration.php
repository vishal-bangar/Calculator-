<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $website = test_input($_POST["website"]);
    $comment = test_input($_POST["comment"]);
    $gender = test_input($_POST["gender"]);
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

require 'vendor/autoload.php'; // Adjust based on your installation method

$mail = new PHPMailer(true); // Enable exceptions

// SMTP Configuration
$mail->isSMTP();
$mail->Host = 'staging.ccomdigital.in'; // Your SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'admin@staging.ccomdigital.in'; // Your Mailtrap username
$mail->Password = 'j;v2s!j4!A&W'; // Your Mailtrap password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

// Sender and recipient settings
$mail->setFrom('admin@staging.ccomdigital.in', 'From Name');
$mail->addAddress($email, 'Recipient Name');

// Sending plain text email
$mail->isHTML(false); // Set email format to plain text
$mail->Subject = 'Your Subject Here';
$mail->Body    = '<p>' . $name . '</p>';

// Send the email
if(!$mail->send()){
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 
    "<script>
    alert('Message has been sent');
    document.location.href = 'demo.php';
    </script>
    ";
}
?>