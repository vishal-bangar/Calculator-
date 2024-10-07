

 
<?php

// Include Composer's autoloader
require 'vendor/autoload.php'; // Adjust the path if necessary

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "div";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inserting data and sending email
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = $conn->real_escape_string(trim($_POST["name"]));
    $number = $conn->real_escape_string(trim($_POST["number"]));
    $rating = $conn->real_escape_string(trim($_POST["rating"]));
    $rating1 = $conn->real_escape_string(trim($_POST["rating1"]));
    $rating2 = $conn->real_escape_string(trim($_POST["rating2"]));
    $rating3 = $conn->real_escape_string(trim($_POST["rating3"]));

    // Prepare an insert statement
    $sql = "INSERT INTO `new` (name, number, rating, rating1, rating2, rating3) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssss", $name, $number, $rating, $rating1, $rating2, $rating3);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "New record created successfully.<br>";

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'staging.ccomdigital.in';                     // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'admin@staging.ccomdigital.in';               // SMTP username
                $mail->Password   = 'j;v2s!j4!A&W';                  // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also available
                $mail->Port       = 587;                                    // TCP port to connect to

                // Recipients
                $mail->setFrom('admin@staging.ccomdigital.in', 'From name');   // Sender's email and name
                $mail->addAddress('vishal111bangar@gmail.com', 'Recipient Name');            // Add a recipient

                // Content
                $mail->isHTML(true);                                        // Set email format to HTML
                $mail->Subject = 'New Feedback Received';
                
                // Construct the email body
                $mailContent = "
                    <h2>New Feedback Received</h2>
                    <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                    <p><strong>Number:</strong> " . htmlspecialchars($number) . "</p>
                    <p><strong>Rating:</strong> " . htmlspecialchars($rating) . "</p>
                    <p><strong>Rating1:</strong> " . htmlspecialchars($rating1) . "</p>
                    <p><strong>Rating2:</strong> " . htmlspecialchars($rating2) . "</p>
                    <p><strong>Rating3:</strong> " . htmlspecialchars($rating3) . "</p>
                ";
                $mail->Body    = $mailContent;
                $mail->AltBody = "New Feedback Received\n\n" .
                                 "Name: $name\n" .
                                 "Number: $number\n" .
                                 "Rating: $rating\n" .
                                 "Rating1: $rating1\n" .
                                 "Rating2: $rating2\n" .
                                 "Rating3: $rating3\n";

                $mail->send();
                echo 'Feedback sent to admin successfully.';
            } catch (Exception $e) {
                echo "Feedback record created, but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>






