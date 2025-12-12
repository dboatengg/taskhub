<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?message=Please login first");
    exit;
}

require "../../config/pdo.php";

// Get ID from URL
$taskId = $_GET['id'] ?? 0;

// Fetch task if it belongs to the logged in user
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

$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
        }

        textarea {
            resize: vertical;
            height: 120px;
        }
    </style>
        <link rel="stylesheet" href="../../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="container-layout">
    <a class="back-btn" href="list.php">← Back to Tasks</a>
    <div class="container">
    
    
        <h2>Edit Task</h2>
    
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    
        <form method="POST" action="../../controllers/tasks_controller.php?action=update">
    
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
    
            <label>Task Title</label>
            <input type="text" name="title" required
                value="<?php echo htmlspecialchars($task['title']); ?>">
    
            <label>Description</label>
            <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
    
            <label>Status</label>
            <select name="status">
                <option value="pending"   <?php echo $task['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?php echo $task['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
            </select>
    
            <button type="submit">Update Task</button>
    
        </form>
    
    </div>
</div>

</body>
</html>
