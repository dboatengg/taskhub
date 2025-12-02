<?php
require "../config/pdo.php";     // connect to database

// Get form data
$username = trim($_POST['username'] ?? "");
$email    = trim($_POST['email'] ?? "");
$password = $_POST['password'] ?? "";

// Some Basic validation
if ($username === "" || $email === "" || $password === "") {
    header("Location: ../views/register.php?message=All fields are required");
    exit;
}

// Check if the email already exists
$sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$existing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    header("Location: ../views/register.php?message=Email already in use");
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert into the database
$sql = "INSERT INTO users (username, email, password) 
        VALUES (:username, :email, :password)";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':username' => $username,
    ':email'    => $email,
    ':password' => $hashedPassword
]);

// Redirect with success message
header("Location: ../views/register.php?message=Registration successful!");
exit;
