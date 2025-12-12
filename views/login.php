<?php
$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/style.css">

</head>
<body>

<div class="container-layout">
    <div class="card">

        <h2>Login</h2>

        <?php if ($message): ?>
            <div class="message error">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../controllers/login_controller.php">

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>

        </form>

        <p class="footer-text">
            Don’t have an account?  
            <a href="register.php">Register</a><br>
            <a href="forgot_password.php">Forgot Password?</a>

        </p>

    </div>
</div>

</body>
</html>
