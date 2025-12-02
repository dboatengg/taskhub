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
    <title>Edit Task</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #4c6ef5;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .message {
            padding: 10px;
            background: #ffe3e3;
            color: #c92a2a;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            height: 120px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4c6ef5;
            border: none;
            color: #fff;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #364fc7;
        }

    </style>
</head>
<body>

<div class="container">

    <a class="back-btn" href="list.php">← Back to Tasks</a>

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

</body>
</html>
