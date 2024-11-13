<?php
session_start();
include 'db.php';

// Ensure only admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

try {
    // Fetch all trainers for the dropdown
    $trainers = $pdo->query("SELECT * FROM trainers")->fetchAll();

    // Fetch all classes with trainer details
    $classes = $pdo->query("SELECT classes.*, trainers.name AS trainer_name 
                            FROM classes 
                            LEFT JOIN trainers ON classes.trainer_id = trainers.id")->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// Handle Create Class request
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $trainer_id = $_POST['trainer_id'];
    $schedule = $_POST['schedule'];

    $stmt = $pdo->prepare("INSERT INTO classes (name, trainer_id, schedule) VALUES (?, ?, ?)");
    $stmt->execute([$name, $trainer_id, $schedule]);
    header("Location: manage_classes.php");
    exit;
}

// Handle Update Class request
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $trainer_id = $_POST['trainer_id'];
    $schedule = $_POST['schedule'];

    $stmt = $pdo->prepare("UPDATE classes SET name = ?, trainer_id = ?, schedule = ? WHERE id = ?");
    $stmt->execute([$name, $trainer_id, $schedule, $id]);
    header("Location: manage_classes.php");
    exit;
}

// Handle Delete Class request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage_classes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Manage Classes</title>
</head>
<body class="bg-black text-yellow-400">
<div class="container mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold mb-8">Manage Classes</h2>

    <!-- Add Class Form -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
        <h3 class="text-2xl font-semibold mb-4">Add New Class</h3>
        <form method="POST" action="" class="space-y-4">
            <input type="text" name="name" placeholder="Class Name" required class="w-full p-3 border border-yellow-400 bg-black text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <select name="trainer_id" required class="w-full p-3 border border-yellow-400 bg-black text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="">Select Trainer</option>
                <?php foreach ($trainers as $trainer): ?>
                    <option value="<?= $trainer['id'] ?>"><?= htmlspecialchars($trainer['name']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="datetime-local" name="schedule" required class="w-full p-3 border border-yellow-400 bg-black text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <button type="submit" name="create" class="w-full bg-yellow-400 text-black py-3 font-semibold rounded-md hover:bg-yellow-500 transition duration-200">Add Class</button>
        </form>
    </div>

    <!-- Display Classes -->
    <table class="w-full bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
        <thead>
            <tr class="bg-gray-700">
                <th class="p-4 text-left font-semibold">Class Name</th>
                <th class="p-4 text-left font-semibold">Trainer</th>
                <th class="p-4 text-left font-semibold">Schedule</th>
                <th class="p-4 text-left font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($classes)): ?>
                <tr>
                    <td colspan="4" class="p-4 text-center">No classes available</td>
                </tr>
            <?php else: ?>
                <?php foreach ($classes as $class): ?>
                    <tr class="border-b border-gray-700 hover:bg-gray-900 transition duration-150 ease-in-out">
                        <td class="p-4"><?= htmlspecialchars($class['name']) ?></td>
                        <td class="p-4"><?= htmlspecialchars($class['trainer_name'] ?? 'No Trainer Assigned') ?></td>
                        <td class="p-4"><?= htmlspecialchars($class['schedule']) ?></td>
                        <td class="p-4">
                            <a href="manage_classes.php?edit=<?= $class['id'] ?>" class="text-yellow-400 underline mr-2">Edit</a>
                            <a href="manage_classes.php?delete=<?= $class['id'] ?>" onclick="return confirm('Are you sure?')" class="text-red-400 underline">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Edit Class Form -->
    <?php if (isset($_GET['edit'])): ?>
        <?php
        $id = $_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->execute([$id]);
        $class = $stmt->fetch();
        ?>
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h3 class="text-2xl font-semibold mb-4">Edit Class</h3>
            <form method="POST" action="" class="space-y-4">
                <input type="hidden" name="id" value="<?= $class['id'] ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($class['name']) ?>" required class="w-full p-3 border border-yellow-400 bg-black text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <select name="trainer_id" required class="w-full p-3 border border-yellow-400 bg-black text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <option value="">Select Trainer</option>
                    <?php foreach ($trainers as $trainer): ?>
                        <option value="<?= $trainer['id'] ?>" <?= $trainer['id'] == $class['trainer_id'] ? 'selected' : '' ?>><?= htmlspecialchars($trainer['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="datetime-local" name="schedule" value="<?= date('Y-m-d\TH:i', strtotime($class['schedule'])) ?>" required class="w-full p-3 border border-yellow-400 bg-black text-yellow-400 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <button type="submit" name="update" class="w-full bg-yellow-400 text-black py-3 font-semibold rounded-md hover:bg-yellow-500 transition duration-200">Update Class</button>
            </form>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
