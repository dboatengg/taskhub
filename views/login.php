<?php
$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4c6ef5, #7950f2);
            margin: 0;
            padding: 0;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .card {
            background: #fff;
            width: 100%;
            max-width: 380px;
            padding: 25px;
            border-radius: 12px;
            margin: auto;
            box-shadow: 0px 6px 30px rgba(0,0,0,0.15);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        .error {
            background: #ffe3e3;
            color: #c92a2a;
        }

        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #4c6ef5;
            box-shadow: 0px 0px 5px rgba(76,110,245,0.6);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            background: #4c6ef5;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #364fc7;
        }

        .footer-text {
            text-align: center;
            margin-top: 12px;
            color: #333;
        }

        .footer-text a {
            color: #4c6ef5;
            text-decoration: none;
            font-weight: bold;
        }

    </style>

</head>
<body>

<div class="container">
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
            <a href="register.php">Register</a>
        </p>

    </div>
</div>

</body>
</html>
