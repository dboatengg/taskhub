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
    <link rel="stylesheet" href="../../public/css/style.css">

    <style>

        .task-wrapper {
            max-width: 900px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .header-row h2 {
            font-size: 28px;
            font-weight: 600;
        }

        /* .tasks-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        } */
            
    .tasks-list {
    display: grid;
    grid-template-columns: 1fr; /* mobile (default) */
    gap: 20px;
}
.task-item {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}


/* 2 columns on tablets & large screens */
@media (min-width: 700px) {
    .tasks-list {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Optional: 3 columns on extra-wide monitor */
@media (min-width: 1200px) {
    .tasks-list {
        grid-template-columns: repeat(3, 1fr);
    }
}


        .task-item {
            padding: 20px 25px;
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e9ecef;
            transition: 0.2s ease;
            cursor: pointer;
        }

        .task-item:hover {
            border-color: #d0d7de;
            background: #fafbff;
        }

        .task-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .task-desc {
            font-size: 15px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 12px;
        }

        /* MODERN STATUS CHIP */
        .status-chip {
            display: inline-block;
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 50px;
            font-weight: 500;
        }

        .chip-pending {
            background: #fff6d7;
            color: #ad7b00;
        }

        .chip-completed {
            background: #e2ffe6;
            color: #2f8d46;
        }

        /* ACTION ROW */
        .task-actions {
            margin-top: 12px;
            display: flex;
            gap: 20px;
        }

        .task-actions a {
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .edit-link {
            color: #4c6ef5;
        }

        .delete-link {
            color: #e03131;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            margin-top: 40px;
            color: #666;
            font-size: 16px;
        }
        
    </style>
            <link rel="stylesheet" href="../../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="task-wrapper">

    <div class="header-row">
        <h2>Your Tasks</h2>
        <a href="create.php" class="btn" style="width:auto;">+ Add Task</a>
    </div>

    <?php if (empty($tasks)): ?>
        <p class="empty-state">No tasks yet. Start by creating one.</p>
    <?php endif; ?>

    <div class="tasks-list">

        <?php foreach ($tasks as $task): ?>
            <div class="task-item">

                <div class="task-title">
                    <?php echo htmlspecialchars($task['title']); ?>
                </div>

                <div class="task-desc">
                    <?php echo nl2br(htmlspecialchars($task['description'])); ?>
                </div>

                <!-- Status Chip -->
                <?php if ($task['status'] === 'completed'): ?>
                    <span class="status-chip chip-completed">Completed</span>
                <?php else: ?>
                    <span class="status-chip chip-pending">Pending</span>
                <?php endif; ?>

                <div class="task-actions">
                    <a href="edit.php?id=<?php echo $task['id']; ?>" class="edit-link">Edit</a>
                    <a href="delete.php?id=<?php echo $task['id']; ?>" class="delete-link">Delete</a>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>

</body>
</html>
