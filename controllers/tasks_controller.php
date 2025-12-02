<?php
require "../config/pdo.php";
session_start();

$action = $_GET['action'] ?? '';

/*======================CREATE task=====================*/
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


/*======================UPDATE task=====================*/
if ($action === "update") {
    
    $id = $_POST['id'] ?? 0;
    $title = trim($_POST['title'] ?? "");
    $description = trim($_POST['description'] ?? "");
    $status = $_POST['status'] ?? "pending";
    $userId = $_SESSION['user_id'];
    
    // Validate
    if ($title === "") {
        header("Location: ../views/tasks/edit.php?id=$id&message=Title is required");
        exit;
    }

    // Ensure task belongs to user
    $sql = "SELECT id FROM tasks WHERE id = :id AND user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':uid' => $userId
    ]);
    
    if (!$stmt->fetch()) {
        die("Unauthorized or invalid task.");
    }
    
    // Update the task
    $sql = "UPDATE tasks 
            SET title = :title,
                description = :description,
                status = :status,
                updated_at = NOW()
            WHERE id = :id AND user_id = :uid";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':title' => $title,
    ':description' => $description,
    ':status' => $status,
    ':id' => $id,
    ':uid' => $userId
]);

    header("Location: ../views/tasks/list.php");
    exit;
}

/*======================DELETE task=====================*/

if ($action === "delete") {
    
    $id = $_GET['id'] ?? 0;
    $userId = $_SESSION['user_id'];
    
    // Check ownership
    $sql = "SELECT id FROM tasks WHERE id = :id AND user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':uid' => $userId
    ]);

    if (!$stmt->fetch()) {
        die("Unauthorized or invalid task.");
    }
    
    // Delete the task
    $sql = "DELETE FROM tasks WHERE id = :id AND user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':uid' => $userId
    ]);
    
    header("Location: ../views/tasks/list.php");
    exit;
}
