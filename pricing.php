<?php
include 'db.php';
session_start();

// Redirect non-admin users
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Add a new plan
if (isset($_POST['add'])) {
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO pricing (plan_name, price) VALUES (?, ?)");
    $stmt->execute([$plan_name, $price]);

    header("Location: pricing.php");
    exit();
}

// Update a plan
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $plan_name = $_POST['plan_name'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE pricing SET plan_name = ?, price = ? WHERE id = ?");
    $stmt->execute([$plan_name, $price, $id]);

    header("Location: pricing.php");
    exit();
}

// Delete a plan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM pricing WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: pricing.php");
    exit();
}

// Fetch all pricing plans
$stmt = $pdo->prepare("SELECT * FROM pricing");
$stmt->execute();
$pricing = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Pricing Plans</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Manage Pricing Plans</h1>

        <!-- Add New Plan Form -->
        <form method="POST" class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-2xl font-bold mb-4">Add New Plan</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Plan Name</label>
                <input type="text" name="plan_name" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Price</label>
                <input type="number" name="price" step="0.01" class="border p-2 w-full" required>
            </div>
            <button type="submit" name="add" class="bg-blue-500 text-white px-4 py-2 rounded">Add Plan</button>
        </form>

        <!-- Display Plans -->
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Plan Name</th>
                    <th class="py-2 px-4 border-b text-left">Price</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pricing as $plan): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= $plan['id'] ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($plan['plan_name']) ?></td>
                        <td class="py-2 px-4 border-b"><?= number_format($plan['price'], 2) ?></td>
                        <td class="py-2 px-4 border-b">
                            <!-- Edit Button -->
                            <button onclick="document.getElementById('editModal-<?= $plan['id'] ?>').style.display='block'" class="text-yellow-500">Edit</button>
                            <!-- Delete Button -->
                            <a href="pricing.php?delete=<?= $plan['id'] ?>" class="text-red-500 ml-4" onclick="return confirm('Are you sure you want to delete this plan?');">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div id="editModal-<?= $plan['id'] ?>" class="fixed z-10 inset-0 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white p-4 rounded shadow-lg w-1/3">
                                <h2 class="text-2xl font-bold mb-4">Edit Plan</h2>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $plan['id'] ?>">
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Plan Name</label>
                                        <input type="text" name="plan_name" value="<?= htmlspecialchars($plan['plan_name']) ?>" class="border p-2 w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Price</label>
                                        <input type="number" name="price" value="<?= $plan['price'] ?>" step="0.01" class="border p-2 w-full" required>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="button" onclick="document.getElementById('editModal-<?= $plan['id'] ?>').style.display='none'" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                        <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Script to toggle modal visibility -->
    <script>
        document.querySelectorAll('.modal').forEach(modal => {
            modal.querySelector('[data-dismiss]').addEventListener('click', () => {
                modal.style.display = 'none';
            });
        });
    </script>
</body>
</html>