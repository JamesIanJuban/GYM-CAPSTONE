<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $membership_type = $_POST['membership_type'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO memberships (membership_type, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $membership_type, $price, $description);

    if ($stmt->execute()) {
        echo "Membership added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Membership</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold">Add Membership Plan</h2>
        <form action="" method="post" class="bg-white p-5 shadow-md mt-5">
            <label class="block">Membership Type:</label>
            <select name="membership_type" class="border p-2 w-full mt-2" required>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
            <label class="block mt-4">Price:</label>
            <input type="number" name="price" step="0.01" class="border p-2 w-full mt-2" required>
            <label class="block mt-4">Description:</label>
            <textarea name="description" class="border p-2 w-full mt-2" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-4">Add Membership</button>
        </form>
    </div>
</body>
</html>
