<?php
session_start();
require "../config/pdo.php";

$userId = $_SESSION['user_id'];

// Check if file exists
if (!isset($_FILES['profile']) || $_FILES['profile']['error'] !== UPLOAD_ERR_OK) {
    header("Location: ../views/profile.php?message=Upload failed");
    exit;
}

$file = $_FILES['profile'];

// 1. Validate file type
$allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
if (!in_array($file['type'], $allowedTypes)) {
    header("Location: ../views/profile.php?message=Only JPG or PNG allowed");
    exit;
}

// 2. Validate size (max 2MB)
if ($file['size'] > 2 * 1024 * 1024) {
    header("Location: ../views/profile.php?message=File too large. Max 2MB.");
    exit;
}

// 3. Generate unique filename
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$newName = "profile_" . $userId . "_" . time() . "." . $ext;

// 4. Move file to folder
$destination = "../uploads/profile/" . $newName;

if (!move_uploaded_file($file['tmp_name'], $destination)) {
    header("Location: ../views/profile.php?message=Could not save file");
    exit;
}

// 5. Save new filename in DB
$sql = "UPDATE users SET profile_picture = :pic WHERE id = :uid";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':pic' => $newName,
    ':uid' => $userId
]);

// 6. Update session
$_SESSION['profile_picture'] = $newName;

header("Location: ../views/profile.php?message=Upload successful!");
exit;
