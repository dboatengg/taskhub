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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>


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
    <!-- <link rel="stylesheet" href="../public/css/style.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="container-layout">
    <a class="back-btn" href="list.php">← Back to Tasks</a>
    <div class="container">
    
    
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
</div>

</body>
</html>
