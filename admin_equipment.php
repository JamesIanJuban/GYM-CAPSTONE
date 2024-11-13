<?php
include 'db.php';
session_start();

// Redirect if not admin
if ($_SESSION['role'] != 'admin') {
    header("Location: user_equipment.php");
    exit;
}

// Fetch all equipment data from the database
$stmt = $pdo->query("SELECT * FROM equipment");
$equipment = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Admin - Update Gym Equipment</title>
    <style>
        body {
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-900 bg-opacity-80 text-yellow-400 min-h-screen flex flex-col items-center">
    <div class="w-full max-w-4xl mx-auto mt-10 flex justify-center">
        <img src="img/logo.jpg" alt="Gym Logo" class="h-24 mb-4">
    </div>

    <div class="container mx-auto py-10 px-6 bg-gray-900 bg-opacity-90 rounded-lg shadow-lg max-w-4xl">
        <h2 class="text-4xl font-bold mb-6 text-center">Admin - Update Gym Equipment</h2>

        <table class="min-w-full bg-black border border-yellow-400 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-yellow-500 text-black">
                    <th class="px-6 py-3 text-left font-semibold">Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Quantity</th>
                    <th class="px-6 py-3 text-left font-semibold">Maintenance Date</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                    <th class="px-6 py-3 text-left font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipment as $item): ?>
                    <tr class="border-t border-yellow-400">
                        <td class="px-6 py-3"><?= htmlspecialchars($item['name']) ?></td>
                        <td class="px-6 py-3"><?= $item['quantity'] ?> units</td>
                        <td class="px-6 py-3"><?= date("F j, Y", strtotime($item['maintenance_date'])) ?></td>
                        <td class="px-6 py-3"><?= $item['status'] ?></td>
                        <td class="px-6 py-3">
                            <a href="edit_equipment.php?id=<?= $item['id'] ?>" class="text-yellow-400 hover:underline">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
