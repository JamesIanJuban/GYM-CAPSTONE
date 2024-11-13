<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex flex-col items-center">
    <h1 class="text-5xl font-bold mt-10">Admin Dashboard</h1>
    <p class="mt-4">Welcome, Admin!</p>
    <div class="mt-6">
        <a href="logout.php" class="bg-yellow-400 text-black py-2 px-4 rounded">Logout</a>
    </div>
</body>
</html>
