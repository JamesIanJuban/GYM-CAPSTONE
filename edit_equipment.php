<?php
include 'db.php';
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: user_equipment.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    // Redirect or handle the error if 'id' is not present
    header("Location: admin_equipment.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM equipment WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    // Handle the case where the equipment with the specified ID does not exist
    header("Location: admin_equipment.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $maintenance_date = $_POST['maintenance_date'];
    $status = $_POST['status'];

    // Handle image upload
    $image = $item['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target = "img/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $stmt = $pdo->prepare("UPDATE equipment SET name = ?, quantity = ?, maintenance_date = ?, status = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $quantity, $maintenance_date, $status, $image, $id]);

    header("Location: admin_equipment.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit Equipment</title>
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex items-center justify-center">
    <div class="container max-w-md mx-auto py-10 px-6 bg-gray-900 bg-opacity-90 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-center">Edit Equipment</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">
            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">
            <input type="date" name="maintenance_date" value="<?= $item['maintenance_date'] ?>" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">
            <select name="status" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">
                <option value="Available" <?= $item['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                <option value="Unavailable" <?= $item['status'] == 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
            </select>
            <input type="file" name="image" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">
            <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded-md font-semibold">Save Changes</button>
        </form>
    </div>
</body>
</html>
