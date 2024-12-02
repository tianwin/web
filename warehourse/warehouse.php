<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Warehouse | Frank Dong's Toolbox</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav>
        <ul class="nav-list">
            <li><a href="../index.html"><strong>Home</strong></a></li>
            <li><a href="../experience.html"><strong>CV</strong></a></li>
            <li><a href="../#contact"><strong>Contact</strong></a></li>
            <li><a href="logout.php"><strong>Logout</strong></a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <h1>Welcome to the Warehouse</h1>
        <p>Here are my personal tools and resources:</p>
        <ul>
            <li><a href="https://github.com/tianwin" target="_blank"><strong>GitHub Repository</strong></a></li>
            <li><a href="https://www.kaggle.com/" target="_blank"><strong>Kaggle</strong></a></li>
            <li><a href="https://colab.research.google.com/" target="_blank"><strong>Google Colab</strong></a></li>
            <li><a href="https://www.tableau.com/" target="_blank"><strong>Tableau</strong></a></li>
            <li><a href="https://spark.apache.org/" target="_blank"><strong>Apache Spark</strong></a></li>
            <!-- Add more resources as needed -->
        </ul>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Frank Dong. All Rights Reserved.</p>
    </footer>
</body>

</html>
