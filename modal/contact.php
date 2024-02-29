<?php

// Fetching Values from URL
$name       = $_POST['ajax_name'];
$email_from = $_POST['ajax_email'];
$email_to   = $_POST['ajax_emailto'];
$message    = $_POST['ajax_message'];
$phone      = $_POST['ajax_tel'];

// Sanitize and Validate Email
if (filter_var($email_from, FILTER_VALIDATE_EMAIL) && filter_var($email_to, FILTER_VALIDATE_EMAIL)) {
    
    // Sanitizing other fields
    $name    = filter_var($name, FILTER_SANITIZE_STRING);
    $message = filter_var($message, FILTER_SANITIZE_STRING);
    $phone   = filter_var($phone, FILTER_SANITIZE_STRING);

    // Prepare Email Headers
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: ' . $email_from . "\r\n"; // Sender's Email
    $headers .= 'Cc: ' . $email_from . "\r\n"; // Carbon copy to Sender

    // Prepare Email Template
    $template = '<div style="padding:50px;">Hello ' . $name . ',<br/>'
        . 'Thank you for contacting us.<br/><br/>'
        . '<strong style="color:#f00a77;">Name:</strong>  ' . $name . '<br/>'
        . '<strong style="color:#f00a77;">Email:</strong>  ' . $email_from . '<br/>'
        . '<strong style="color:#f00a77;">Subject:</strong>  Message from contact form Persono<br/>'
        . '<strong style="color:#f00a77;">Phone:</strong>  ' . $phone . '<br/>'
        . '<strong style="color:#f00a77;">Message:</strong>  ' . $message . '<br/><br/>'
        . 'This is a Contact Confirmation mail.'
        . '<br/>'
        . 'We will contact you as soon as possible.</div>';

    // Wrap message lines to not exceed 70 characters (PHP rule)
    $message = wordwrap($template, 70);

    // Send mail using PHP Mail Function
    if (mail($email_to, "Message from contact form Persono", $message, $headers)) {
        echo ''; // Successfully sent message
    } else {
        echo "<span class='contact_error'>* Failed to send email *</span>";
    }
} else {
    echo "<span class='contact_error'>* Invalid email address *</span>";
}

?>
