<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?message=Please login first");
    exit;
}

require "../../config/pdo.php";

$taskId = $_GET['id'] ?? 0;

// Fetch task that belongs to logged-in user
$sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :uid LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $taskId,
    ':uid' => $_SESSION['user_id']
]);

$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    die("Task not found or access denied.");
}
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Task</title>

    <link rel="stylesheet" href="../../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="container-layout">

    <div class="card" style="max-width: 500px; text-align:center;">

        <h2>Delete Task?</h2>

        <p>Are you sure you want to delete: <br>
            <strong><?php echo htmlspecialchars($task['title']); ?></strong>
        </p>

        <div style="margin-top: 25px;">
            <a href="../../controllers/tasks_controller.php?action=delete&id=<?php echo $task['id']; ?>" 
               class="btn" 
               style="background:#e03131;margin-bottom:10px;">
               Yes, Delete
            </a>

            <a href="list.php" class="btn" style="background:#adb5bd;">Cancel</a>
        </div
