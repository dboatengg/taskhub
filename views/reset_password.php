<?php
require "../config/pdo.php";

$token = $_GET['token'] ?? "";

if (!$token) {
    die("Invalid token.");
}

// Check if token exists in DB
$sql = "SELECT id FROM users WHERE reset_token = :token LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':token' => $token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Invalid or expired token.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>

<div class="container-layout">
    <div class="card" style="max-width:450px;">

        <h2>Reset Password</h2>

        <form method="POST" action="../controllers/reset_password_controller.php">

            <input type="hidden" name="token" value="<?php echo $token; ?>">

            <label>New Password</label>
            <input type="password" name="password" required>

            <button type="submit">Update Password</button>

        </form>

    </div>
</div>

</body>
</html>
