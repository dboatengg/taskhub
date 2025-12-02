<?php
$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <style>
    *, *::before, *::after {
        box-sizing: border-box;   
    }
    
    input,
    button,
    textarea,
    select {
        display: block;
        width: 100%;
        box-sizing: inherit;      
    }

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
        max-width: 420px;
        /* padding: 25px 30px; */
        padding: 22px 24px;
        border-radius: 12px;
        margin: auto;
        overflow: hidden;
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
    
    .success {
        background: #d3f9d8;
        color: #2b8a3e;
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

/* ------------------------------
        RESPONSIVE FIXES
------------------------------ */

@media (max-width: 600px) {

    .card {
        padding: 20px;
        max-width: 90%;
        border-radius: 10px;
    }

    input, button {
        font-size: 14px;
        padding: 10px;
    }

    h2 {
        font-size: 22px;
    }
}

@media (max-width: 380px) {

    .card {
        padding: 18px;
        max-width: 95%;
    }

    h2 {
        font-size: 20px;
    }

    button {
        padding: 12px;
    }
}

    </style>

</head>
<body>

<div class="container">
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
