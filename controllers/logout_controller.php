<?php
session_start();
session_destroy();

header("Location: ../views/login.php?message=Logged out successfully");
exit;
