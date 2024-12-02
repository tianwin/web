<?php
ob_start();
session_start();
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse | Manage Categories and Notes</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Warehouse</h1>
        <h2>Manage Categories and Notes</h2>
        <div>
            <input type="text" id="category-input" placeholder="Add a new category..." class="category-input">
            <button id="add-category-btn" class="add-btn">Add Category</button>
        </div>
        <div id="categories-list"></div>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>
<?php
ob_end_flush();
?>
