<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../index.html");
    exit();
}
?>
<div class="navbar">
    <div class="logo">Warehouse</div>
    <div class="dropdown">
        <a href="#">Categories</a>
        <div id="category-dropdown" class="dropdown-content">
            <!-- Categories dynamically populated -->
        </div>
    </div>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
