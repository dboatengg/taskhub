<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?message=Please login first");
    exit;
}

$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>

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

        h2 {
            text-align: center;
            margin-bottom: 20px;
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

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            color: #4c6ef5;
        }

        .message {
            padding: 10px;
            background: #ffe3e3;
            color: #c92a2a;
            margin-bottom: 15px;
            border-radius: 6px;
            text-align: center;
        }
    </style>

</head>
<body>

<div class="container">

    <a class="back-btn" href="list.php">← Back to Tasks</a>

    <h2>Create New Task</h2>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="../../controllers/tasks_controller.php?action=create">

        <label>Task Title</label>
        <input type="text" name="title" placeholder="Enter task title" required>

        <label>Description</label>
        <textarea name="description" placeholder="Describe your task..."></textarea>

        <button type="submit">Create Task</button>

    </form>

</div>

</body>
</html>
