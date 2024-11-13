<?php
include 'db.php';
session_start();

// Redirect non-admin users
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all trainers
$stmt = $pdo->prepare("SELECT id, username FROM users WHERE role = 'trainer'");
$stmt->execute();
$trainers = $stmt->fetchAll();

// Add a new class
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $trainer_id = $_POST['trainer_id'];
    $schedule = $_POST['schedule'];

    $stmt = $pdo->prepare("INSERT INTO classes (name, trainer_id, schedule) VALUES (?, ?, ?)");
    $stmt->execute([$name, $trainer_id, $schedule]);

    header("Location: classes.php");
    exit();
}

// Update a class
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $trainer_id = $_POST['trainer_id'];
    $schedule = $_POST['schedule'];

    $stmt = $pdo->prepare("UPDATE classes SET name = ?, trainer_id = ?, schedule = ? WHERE id = ?");
    $stmt->execute([$name, $trainer_id, $schedule, $id]);

    header("Location: classes.php");
    exit();
}

// Delete a class
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM classes WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: classes.php");
    exit();
}

// Fetch all classes
$stmt = $pdo->prepare("SELECT classes.*, users.username AS trainer_name FROM classes JOIN users ON classes.trainer_id = users.id");
$stmt->execute();
$classes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Manage Classes</h1>

        <!-- Add New Class Form -->
        <form method="POST" class="bg-white p-4 rounded shadow mb-6">
            <h2 class="text-2xl font-bold mb-4">Add New Class</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Class Name</label>
                <input type="text" name="name" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Trainer</label>
                <select name="trainer_id" class="border p-2 w-full" required>
                    <?php foreach ($trainers as $trainer): ?>
                        <option value="<?= $trainer['id'] ?>"><?= htmlspecialchars($trainer['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Schedule</label>
                <input type="datetime-local" name="schedule" class="border p-2 w-full" required>
            </div>
            <button type="submit" name="add" class="bg-blue-500 text-white px-4 py-2 rounded">Add Class</button>
        </form>

        <!-- Display Classes -->
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Class Name</th>
                    <th class="py-2 px-4 border-b text-left">Trainer</th>
                    <th class="py-2 px-4 border-b text-left">Schedule</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $class): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= $class['id'] ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($class['name']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($class['trainer_name']) ?></td>
                        <td class="py-2 px-4 border-b"><?= date('Y-m-d H:i', strtotime($class['schedule'])) ?></td>
                        <td class="py-2 px-4 border-b">
                            <!-- Edit Button -->
                            <button onclick="document.getElementById('editModal-<?= $class['id'] ?>').style.display='block'" class="text-yellow-500">Edit</button>
                            <!-- Delete Button -->
                            <a href="classes.php?delete=<?= $class['id'] ?>" class="text-red-500 ml-4" onclick="return confirm('Are you sure you want to delete this class?');">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div id="editModal-<?= $class['id'] ?>" class="fixed z-10 inset-0 overflow-y-auto hidden">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white p-4 rounded shadow-lg w-1/3">
                                <h2 class="text-2xl font-bold mb-4">Edit Class</h2>
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?= $class['id'] ?>">
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Class Name</label>
                                        <input type="text" name="name" value="<?= htmlspecialchars($class['name']) ?>" class="border p-2 w-full" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Trainer</label>
                                        <select name="trainer_id" class="border p-2 w-full" required>
                                            <?php foreach ($trainers as $trainer): ?>
                                                <option value="<?= $trainer['id'] ?>" <?= $class['trainer_id'] == $trainer['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($trainer['username']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Schedule</label>
                                        <input type="datetime-local" name="schedule" value="<?= date('Y-m-d\TH:i', strtotime($class['schedule'])) ?>" class="border p-2 w-full" required>
                                    </div>
                                    <div<div class="flex justify-end">
                                        <button type="button" onclick="document.getElementById('editModal-<?= $class['id'] ?>').style.display='none'" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
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
