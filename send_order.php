<?php
if (isset($_POST['submit'])) {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $food = htmlspecialchars($_POST['food']);
    $quantity = htmlspecialchars($_POST['quantity']);

    // Define recipient and subject
    $to = "akom.s@psu.ac.th"; // Change to your email
    $subject = "New Food Order from " . $name;

    // Build HTML email header
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $email . "\r\n";

    // Build HTML email body
    $message = "<html><body>";
    $message .= "<h2>New Food Order Received</h2>";
    $message .= "<p><strong>Customer Name:</strong> " . $name . "</p>";
    $message .= "<p><strong>Customer Email:</strong> " . $email . "</p>";
    $message .= "<p><strong>Food Item:</strong> " . $food . "</p>";
    $message .= "<p><strong>Quantity:</strong> " . $quantity . "</p>";
    $message .= "</body></html>";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "<h3>Thank you! Your order has been sent successfully.</h3>";
    } else {
        echo "<h3>Sorry, something went wrong. Please try again later.</h3>";
    }
} else {
    header("Location: order.html");
    exit();
}
?>
