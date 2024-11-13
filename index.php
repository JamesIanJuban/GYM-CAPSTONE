<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Gym Management System</title>
</head>
<body class="bg-black text-yellow-400">x`
<div class="container mx-auto py-10">
    <h1 class="text-3xl mb-4">Welcome to the Gym Management System</h1>
    <div class="space-y-4">
        <?php if ($user_role == 'admin'): ?>
            <a href="manage_equipment.php" class="block bg-yellow-400 text-black py-2 px-4 rounded">Manage Equipment</a>
            <a href="manage_classes.php" class="block bg-yellow-400 text-black py-2 px-4 rounded">Manage Classes</a>
        <?php endif; ?>
        <a href="trainers.php" class="block bg-yellow-400 text-black py-2 px-4 rounded">Trainers</a>
        <a href="classes.php" class="block bg-yellow-400 text-black py-2 px-4 rounded">Classes</a>
        <a href="logout.php" class="block bg-yellow-400 text-black py-2 px-4 rounded">Logout</a>
    </div>
</div>
</body>
</html>
