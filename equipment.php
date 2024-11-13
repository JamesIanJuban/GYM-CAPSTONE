<?php
include 'db.php';

// Fetch all equipment data from the database
$stmt = $pdo->query("SELECT * FROM equipment");
$equipment = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Gym Equipment</title>
</head>
<body class="bg-gray-900 text-yellow-400">
    <div class="container mx-auto py-10">
        <h2 class="text-3xl mb-6">Gym Equipment</h2>

        <!-- Equipment Table -->
        <table class="min-w-full bg-black border border-yellow-400">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Quantity</th>
                    <th class="px-4 py-2 text-left">Maintenance Date</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipment as $item): ?>
                    <tr>
                        <td class="px-4 py-2"><?= htmlspecialchars($item['name']) ?></td>
                        <td class="px-4 py-2"><?= $item['quantity'] ?></td>
                        <td class="px-4 py-2"><?= $item['maintenance_date'] ?></td>
                        <td class="px-4 py-2"><?= $item['status'] ?></td>
                        <td class="px-4 py-2">
                            <a href="edit_equipment.php?id=<?= $item['id'] ?>" class="text-yellow-400 hover:underline">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
