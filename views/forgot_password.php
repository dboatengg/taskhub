<?php
$message = $_GET['message'] ?? "";
if ($message):
?>


    <?php if (strpos($message, 'success') !== false): ?>
        <div class="message success">
            Password reset link generated!<br><br>

            <!-- Show the reset link -->
            <a href="<?php echo $_GET['link']; ?>" target="_blank" class="btn" style="width:auto;">
                Open Reset Link
            </a>
        </div>

    <?php else: ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

<?php endif; ?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>

<div class="container-layout">
    <div class="card" style="max-width:450px;">

        <h2>Forgot Password</h2>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="../controllers/forgot_password_controller.php">
            <label>Enter your email</label>
            <input type="email" name="email" required>
            <button type="submit">Send Reset Link</button>
        </form>

        <p style="text-align:center; margin-top:15px;">
            <a href="login.php">Back to Login</a>
        </p>

    </div>
</div>



</body>
</html>
