<?php
include 'db.php';

$result = $conn->query("SELECT * FROM memberships");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Memberships</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold">Membership Plans</h2>
        <table class="min-w-full bg-white border mt-5">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border">Type</th>
                    <th class="py-2 px-4 border">Price</th>
                    <th class="py-2 px-4 border">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="border px-4 py-2"><?= ucfirst($row['membership_type']) ?></td>
                    <td class="border px-4 py-2">₱<?= number_format($row['price'], 2) ?></td>
                    <td class="border px-4 py-2"><?= $row['description'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
