<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please login first");
    exit;
}

require "../config/pdo.php";

// Fetch total tasks
$sql = "SELECT COUNT(*) AS total FROM tasks WHERE user_id = :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute([':uid' => $_SESSION['user_id']]);
$totalTasks = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Fetch completed tasks
$sql = "SELECT COUNT(*) AS completed FROM tasks WHERE user_id = :uid AND status = 'completed'";
$stmt = $pdo->prepare($sql);
$stmt->execute([':uid' => $_SESSION['user_id']]);
$completedTasks = $stmt->fetch(PDO::FETCH_ASSOC)['completed'];

$pendingTasks = $totalTasks - $completedTasks;

// Profile picture (will be empty for now)
$profilePicture = $_SESSION['profile_picture'] ?? "default.png";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/css/style.css">

    <style>
        .dashboard-wrapper {
            max-width: 900px;
            margin: 40px auto;
        }

        .profile-card {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 25px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.12);
            margin-bottom: 30px;
        }

        .profile-card img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4c6ef5;
        }

        .stats-card {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #4c6ef5;
        }

        .actions {
            text-align: center;
        }

        .dashboard-btn {
            display: inline-block;
            padding: 14px 22px;
            background: #4c6ef5;
            color: #fff;
            border-radius: 10px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.2s;
            margin-right: 15px;
        }

        .dashboard-btn:hover {
            background: #364fc7;
        }
    </style>
</head>

<body>

<div class="dashboard-wrapper">

    <!-- Profile Section -->
    <div class="profile-card">
        <img src="../uploads/profile/<?php echo $profilePicture; ?>" alt="Profile Picture">

        <div>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>
            <a href="profile.php" class="btn" style="width:auto;">Update Profile</a>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-card">
        <div class="stat-box">
            <div class="stat-number"><?php echo $totalTasks; ?></div>
            <div>Total Tasks</div>
        </div>

        <div class="stat-box">
            <div class="stat-number"><?php echo $completedTasks; ?></div>
            <div>Completed</div>
        </div>

        <div class="stat-box">
            <div class="stat-number"><?php echo $pendingTasks; ?></div>
            <div>Pending</div>
        </div>
    </div>

    <!-- Actions -->
    <div class="actions">
        <a href="tasks/create.php" class="dashboard-btn">+ Create Task</a>
        <a href="tasks/list.php" class="dashboard-btn" style="background:#20c997;">View Tasks</a>
        <a href="../controllers/logout_controller.php" class="dashboard-btn" style="background:#e03131;">Logout</a>
    </div>

</div>

</body>
</html>
