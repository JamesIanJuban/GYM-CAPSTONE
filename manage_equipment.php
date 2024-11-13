<?php
include 'db.php';
session_start();

// Redirect non-admin users to the user equipment page
if ($_SESSION['role'] != 'admin') {
    header("Location: user_equipment.php");
    exit;
}

// Get equipment ID from the URL and redirect if not provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: admin_equipment.php");
    exit;
}

// Fetch the current equipment details
$stmt = $pdo->prepare("SELECT * FROM equipment WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    // Redirect if the equipment item doesn't exist
    header("Location: admin_equipment.php");
    exit;
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $maintenance_date = $_POST['maintenance_date'];
    $status = $_POST['status'];

    // Handle image upload
    $image = $item['image']; // Keep the existing image by default
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $target = "img/" . $image;
        
        // Move the uploaded file to the 'img' directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // Optionally, delete the old image if a new one is uploaded
            if (!empty($item['image']) && file_exists("img/" . $item['image'])) {
                unlink("img/" . $item['image']);
            }
        } else {
            echo "Failed to upload the image.";
        }
    }

    // Update the equipment details in the database
    $stmt = $pdo->prepare("UPDATE equipment SET name = ?, quantity = ?, maintenance_date = ?, status = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $quantity, $maintenance_date, $status, $image, $id]);

    // Redirect back to the admin equipment page after updating
    header("Location: admin_equipment.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit Equipment</title>
</head>
<body class="bg-gray-900 text-yellow-400 min-h-screen flex items-center justify-center">
    <div class="container max-w-md mx-auto py-10 px-6 bg-gray-900 bg-opacity-90 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6 text-center">Edit Equipment</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400" required>

            <label for="quantity" class="block font-semibold">Quantity:</label>
            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400" required>

            <label for="maintenance_date" class="block font-semibold">Maintenance Date:</label>
            <input type="date" name="maintenance_date" value="<?= $item['maintenance_date'] ?>" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">

            <label for="status" class="block font-semibold">Status:</label>
            <select name="status" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400" required>
                <option value="Active" <?= $item['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Under Maintenance" <?= $item['status'] == 'Under Maintenance' ? 'selected' : '' ?>>Under Maintenance</option>
                <option value="Out of Service" <?= $item['status'] == 'Out of Service' ? 'selected' : '' ?>>Out of Service</option>
            </select>

            <label for="image" class="block font-semibold">Image:</label>
            <input type="file" name="image" class="w-full p-3 rounded-md bg-gray-800 text-yellow-400">
            
            <!-- Display current image if it exists -->
            <?php if (!empty($item['image'])): ?>
                <p>Current Image:</p>
                <img src="img/<?= htmlspecialchars($item['image']) ?>" alt="Equipment Image" class="w-32 h-32 mb-4 object-cover rounded-md">
            <?php endif; ?>

            <button type="submit" class="w-full bg-yellow-400 text-black py-3 rounded-md font-semibold">Save Changes</button>
        </form>
    </div>
</body>
</html>
