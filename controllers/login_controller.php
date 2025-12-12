<?php
require "../config/pdo.php";
session_start();

// 1. Receive the form data safely
$email = trim($_POST['email'] ?? "");
$password = $_POST['password'] ?? "";

// 2. Basic validation
if ($email === "" || $password === "") {
    header("Location: ../views/login.php?message=All fields are required");
    exit;
}

// 3. Try to find the user by email
$sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 4. If user doesn't exist
if (!$user) {
    header("Location: ../views/login.php?message=User not found");
    exit;
}

// 5. Verify password
if (!password_verify($password, $user['password'])) {
    header("Location: ../views/login.php?message=Incorrect password");
    exit;
}

// 6. If password is correct → create a session
session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: ../views/dashboard.php");
exit;
