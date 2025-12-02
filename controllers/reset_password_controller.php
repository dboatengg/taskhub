<?php
require "../config/pdo.php";

$token = $_POST['token'] ?? "";
$newPassword = $_POST['password'] ?? "";

if (!$token || !$newPassword) {
    die("Invalid request.");
}

// Check if token exists
$sql = "SELECT id FROM users WHERE reset_token = :token LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':token' => $token]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Invalid or expired token.");
}

$userId = $user['id'];

// Hash new password
$hashed = password_hash($newPassword, PASSWORD_DEFAULT);

// Update password + remove token
$sql = "UPDATE users SET password = :password, reset_token = NULL WHERE id = :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':password' => $hashed,
    ':uid' => $userId
]);

// Redirect to login
header("Location: ../views/login.php?message=Password updated successfully!");
exit;
