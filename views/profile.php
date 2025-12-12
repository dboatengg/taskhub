<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=Please login first");
    exit;
}

require "../config/pdo.php";

$userId = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT username, email, profile_picture FROM users WHERE id = :uid LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([':uid' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$profilePic = $user['profile_picture'] ?: "default.png";
$message = $_GET['message'] ?? "";
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>


    <link rel="stylesheet" href="../public/css/style.css">

    <style>
        .profile-container {
            max-width: 600px;
            width: 90%;
            margin: 40px auto;
            padding: 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.12);
            text-align: center;
        }

        .profile-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #4c6ef5;
            margin-bottom: 20px;
        }

        input[type="file"] {
            margin: 15px 0;
        }

        .message {
            background: #ffe3e3;
            color: #c92a2a;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .success {
            background: #d3f9d8;
            color: #2b8a3e;
        }
    </style>
</head>

<body>
    <a href="dashboard.php" class="btn" 
   style="margin-top:10px; margin-bottom:20px; display:inline-block; background:#e4e6eb; color:#1e1e24;">
    ← Back to Dashboard
</a>
<div class="profile-container">

    <h2>Profile Settings</h2>

    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, 'success') !== false ? 'success' : ''; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <img src="../uploads/profile/<?php echo $profilePic; ?>" alt="Profile Picture">

    <h3><?php echo htmlspecialchars($user['username']); ?></h3>
    <p><?php echo htmlspecialchars($user['email']); ?></p>

    <form action="../controllers/profile_upload_controller.php" method="POST" enctype="multipart/form-data">
        <label><strong>Upload New Profile Picture</strong></label><br>
        <input type="file" name="profile" accept="image/*" required><br>
        <button type="submit">Upload</button>
    </form>

</div>

</body>
</html>
