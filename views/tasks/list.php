<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?message=Login required");
    exit;
}

require "../../config/pdo.php";

// Fetch tasks for the logged-in user
$sql = "SELECT * FROM tasks WHERE user_id = :uid ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([':uid' => $_SESSION['user_id']]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Tasks</title>

    <style>
        .task-container {
            max-width: 700px;
            margin: auto;
        }

        .task {
            background: #fff;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0px 3px 12px rgba(0,0,0,0.1);
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .status {
            padding: 5px 10px;
            background: #e7f5ff;
            color: #1c7ed6;
            border-radius: 6px;
            display: inline-block;
            margin-top: 8px;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            margin-right: 15px;
            color: #4c6ef5;
            text-decoration: none;
        }
    </style>

        <link rel="stylesheet" href="../../public/css/style.css">
        <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>
<body>

<h2>Your Tasks</h2>

<div class="task-container">

    <a href="create.php">+ Create New Task</a>
    <br><br>

    <?php foreach ($tasks as $task): ?>
        <div class="task">
            <div class="title"><?php echo htmlspecialchars($task['title']); ?></div>

            <div class="description">
                <?php echo nl2br(htmlspecialchars($task['description'])); ?>
            </div>

            <div class="status">
                Status: <?php echo $task['status']; ?>
            </div>

            <div class="actions">
                <a href="edit.php?id=<?php echo $task['id']; ?>">Edit</a>
                <!-- <a href="../../controllers/tasks_controller.php?action=delete&id=<?php echo $task['id']; ?>">Delete</a> -->
                <a href="delete.php?id=<?php echo $task['id']; ?>" style="color:#e03131;">Delete</a>

            </div>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
