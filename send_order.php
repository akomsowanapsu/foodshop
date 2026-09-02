<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Download PHPMailer from GitHub and include these files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $food = htmlspecialchars($_POST['food']);
    $address = htmlspecialchars($_POST['address']);

    $mail = new PHPMailer(true);

    try {
        // SMTP Server Settings
        $mail->isSMTP();
        $mail->Host       = '://gmail.com';             // Use your SMTP provider
        $mail->SMTPAuth   = true;
        $mail->Username   = 'akom.s@psu.ac.th';       // Your email
        $mail->Password   = 'Sowana12345678#';          // Your app password (not your login password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('yakom.s@psu.ac.th', 'Food App');
        $mail->addAddress('aaaaakom@gmail.com');  // Where the order goes

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Food Order from $name";
        $mail->Body    = "
            <h3>New Order Details</h3>
            <p><strong>Customer Name:</strong> $name</p>
            <p><strong>Food Ordered:</strong> $food</p>
            <p><strong>Delivery Address:</strong> $address</p>
        ";

        $mail->send();
        echo 'Order sent successfully!';
    } catch (Exception $e) {
        echo "Order could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request";
}
?>
