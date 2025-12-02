<?php
require "../config/pdo.php";

// 1. Get email
$email = trim($_POST['email'] ?? "");

if ($email == "") {
    header("Location: ../views/forgot_password.php?message=Email is required");
    exit;
}

// 2. Check if a user with this email exists
$sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: ../views/forgot_password.php?message=No account found with that email");
    exit;
}

$userId = $user['id'];

// 3. Generate reset token
$token = bin2hex(random_bytes(32)); // 64-character secure token

// 4. Save token to database
$sql = "UPDATE users SET reset_token = :token WHERE id = :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':token' => $token,
    ':uid' => $userId
]);

// 5. Generate reset URL (fake email link)
$resetLink = "http://localhost/taskhub/views/reset_password.php?token=" . $token;

// Redirect and show the link to simulate email sending
header("Location: ../views/forgot_password.php?message=success: Reset link generated! &link=" . urlencode($resetLink));
exit;
