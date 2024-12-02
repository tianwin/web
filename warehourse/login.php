<?php
session_start();

// Define the correct password (you should store this securely)
$correct_password = 'Qwer1234';

// Get the password from the POST request
$entered_password = $_POST['password'] ?? '';

if ($entered_password === $correct_password) {
    // Password is correct; set session variable
    $_SESSION['loggedin'] = true;
    header('Location: warehouse.php'); // Redirect to protected page
    exit();
} else {
    // Password is incorrect; display an error
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Access Denied</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body>
        <h1>Incorrect Password</h1>
        <p><a href="index.html">Try Again</a></p>
    </body>
    </html>';
}
?>
