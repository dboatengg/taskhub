<?php
$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>

<div class="container-layout">
    <div class="card">

        <h2>Create an Account</h2>

        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'successful') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../controllers/register_controller.php">

            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Create password" required>

            <button type="submit">Register</button>

        </form>

        <p class="footer-text">
            Already have an account? 
            <a href="login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>
