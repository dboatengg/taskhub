<?php
require "../config/pdo.php";
session_start();

$action = $_GET['action'] ?? '';

// CREATE task
if ($action === "create") {

    $title = trim($_POST['title'] ?? "");
    $description = trim($_POST['description'] ?? "");
    $userId = $_SESSION['user_id'];

    // Validation
    if ($title === "") {
        header("Location: ../views/tasks/create.php?message=Title is required");
        exit;
    }

    // Insert into tasks table
    $sql = "INSERT INTO tasks (user_id, title, description) 
            VALUES (:uid, :title, :description)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':uid' => $userId,
        ':title' => $title,
        ':description' => $description
    ]);

    // Redirect to task list
    header("Location: ../views/tasks/list.php");
    exit;
}
