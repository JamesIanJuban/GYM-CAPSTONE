<?php
include 'db.php';
session_start();

// Fetch all equipment data from the database
$stmt = $pdo->query("SELECT * FROM equipment");
$equipment = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Gym Equipment</title>
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
        <h2 class="text-4xl font-bold mb-6 text-center">Gym Equipment</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($equipment as $item): ?>
                <div class="bg-black rounded-lg p-4 text-center border border-yellow-400">
                    <img src="img/<?= htmlspecialchars($item['name']) ?>.jpg" alt="<?= htmlspecialchars($item['name']) ?>" class="h-40 w-full object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold"><?= htmlspecialchars($item['name']) ?></h3>
                    <p>Quantity: <?= $item['quantity'] ?> units</p>
                    <p>Maintenance Date: <?= date("F j, Y", strtotime($item['maintenance_date'])) ?></p>
                    <p>Status: <?= $item['status'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
