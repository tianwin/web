<?php
// Database credentials
$servername = "localhost";
$username = "tianwing_tianwin"; // Your database username
$password = "Dong2000jiao";     // Your database password
$dbname = "tianwing_warehouse_notes";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set response header for JSON
header('Content-Type: application/json');

// Handle API Requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'addCategory') {
        $name = $conn->real_escape_string($_POST['name']);
        $sql = "INSERT INTO categories (name) VALUES ('$name')";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'id' => $conn->insert_id]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } elseif ($action === 'addNote') {
        $categoryId = intval($_POST['category_id']);
        $content = $conn->real_escape_string($_POST['content']);
        $sql = "INSERT INTO notes (category_id, content) VALUES ($categoryId, '$content')";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true, 'id' => $conn->insert_id]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } elseif ($action === 'deleteNote') {
        $noteId = intval($_POST['note_id']);
        $sql = "DELETE FROM notes WHERE id = $noteId";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } elseif ($action === 'editNote') {
        $noteId = intval($_POST['note_id']);
        $content = $conn->real_escape_string($_POST['content']);
        $sql = "UPDATE notes SET content = '$content' WHERE id = $noteId";
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } elseif ($action === 'deleteCategory') {
        $categoryId = intval($_POST['category_id']);
        $sql = "DELETE FROM categories WHERE id = $categoryId"; // Deletes notes via FK constraints
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } elseif ($action === 'fetchData') {
        $data = [];
        $categories = $conn->query("SELECT * FROM categories");
        while ($row = $categories->fetch_assoc()) {
            $categoryId = $row['id'];
            $notes = $conn->query("SELECT * FROM notes WHERE category_id = $categoryId");
            $row['notes'] = [];
            while ($note = $notes->fetch_assoc()) {
                $row['notes'][] = $note;
            }
            $data[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $data]);
    }
}

// Close connection
$conn->close();
?>
