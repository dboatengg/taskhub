<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please login first");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p><a href="tasks/list.php">Go to My Tasks</a></p>

    <p>You are now logged in!</p>

    <a href="../controllers/logout_controller.php">Logout</a>
</body>
</html>
