<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in and has the role of admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirect to login if not admin
    exit;
}

// Fetch all registered users along with their billing information
$stmt = $pdo->prepare("
    SELECT u.user_id, u.username, u.email, b.amount, b.billing_date 
    FROM users u 
    LEFT JOIN billing b ON u.user_id = b.member_id
");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex flex-col items-center">
    <h1 class="text-5xl font-bold mt-10">Admin Dashboard</h1>
    <p class="mt-4">Welcome, Admin!</p>
    
    <div class="mt-6 space-y-4">
        <div class="flex space-x-4">
            <a href="manage_memberships.php" class="bg-yellow-400 text-black py-2 px-4 rounded shadow hover:shadow-lg transition-shadow duration-200">Manage Memberships</a>
            <a href="manage_inventory.php" class="bg-yellow-400 text-black py-2 px-4 rounded shadow hover:shadow-lg transition-shadow duration-200">Manage Equipment</a>
            <a href="manage_pricing.php" class="bg-yellow-400 text-black py-2 px-4 rounded shadow hover:shadow-lg transition-shadow duration-200">Manage Pricing Plans</a>
            <a href="manage_trainers.php" class="bg-yellow-400 text-black py-2 px-4 rounded shadow hover:shadow-lg transition-shadow duration-200">Manage Trainers</a>
            <a href="manage_billing.php" class="bg-yellow-400 text-black py-2 px-4 rounded shadow hover:shadow-lg transition-shadow duration-200">Manage Billing</a>
            <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded shadow hover:shadow-lg transition-shadow duration-200">Logout</a>
        </div>
    </div>

    <h2 class="text-3xl font-bold mt-10">Registered Users</h2>
    <div class="mt-6 bg-gray-800 p-6 rounded shadow-lg w-full max-w-2xl">
        <ul class="space-y-4">
            <?php foreach ($users as $user): ?>
                <li class="border-b border-gray-600 pb-2 mb-2">
                    <strong>Username:</strong> <?= htmlspecialchars($user['username']) ?><br>
                    <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?><br>
                    
                    <strong>Billing Information:</strong>
                    <?php if ($user['amount'] !== null): ?>
                        <span>
                            Amount: $<?= htmlspecialchars($user['amount']) ?> - 
                            Date: <?= htmlspecialchars($user['billing_date']) ?>
                        </span>
                    <?php else: ?>
                        <span>No billing records found.</span>
                    <?php endif; ?>
                    
                    <br>
                    <a href="user_details.php?id=<?= htmlspecialchars($user['user_id']) ?>" class="text-yellow-400 hover:underline">View Details</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
