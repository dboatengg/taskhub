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
</head>

<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <p>You are now logged in 🚀</p>

    <a href="../controllers/logout_controller.php">Logout</a>
</body>
</html>
