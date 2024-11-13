<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in and has the role of admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirect to login if not admin
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: admin_dashboard.php"); // Redirect back if no user ID is set
    exit;
}

$userId = $_GET['id'];

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found!";
    exit;
}

// Fetch billing records for the user
$stmt = $pdo->prepare("SELECT amount, billing_date FROM billing WHERE member_id = ?");
$stmt->execute([$userId]);
$billingRecords = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex flex-col items-center">
    <h1 class="text-4xl font-bold mt-10">User Details</h1>
    
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <strong>Username:</strong> <?= htmlspecialchars($user['username']) ?><br>
        <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?><br>
        <strong>Billing Records:</strong>
        
        <ul class="mt-4 space-y-2">
            <?php if (count($billingRecords) > 0): ?>
                <?php foreach ($billingRecords as $record): ?>
                    <li>
                        Amount: $<?= htmlspecialchars($record['amount']) ?> - 
                        Date: <?= htmlspecialchars($record['billing_date']) ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No billing records found for this user.</li>
            <?php endif; ?>
        </ul>
        
        <div class="mt-6">
            <a href="admin_dashboard.php" class="bg-yellow-400 text-black py-2 px-4 rounded">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
