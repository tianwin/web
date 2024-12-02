<?php
session_start();

// Simulate a successful login
if ($_POST['username'] === 'tianwin' && $_POST['password'] === 'Qwer1234') {
    $_SESSION['loggedin'] = true;

    // Redirect to warehouse.php
    header("Location: /warehouse/warehouse.php");
    exit();
} else {
    echo "Invalid username or password.";
}
?>
