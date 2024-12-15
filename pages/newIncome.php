<?php if(defined("LEWAT_INDEX") == false) die("Tidak boleh akses langsung!"); ?>

<?php
// Include the database connection
require_once 'lib/koneksi.php';

// Check if the form is submitted
$success = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = 1; // Replace with dynamic user ID as needed
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO incomes (user_id, date, description, amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issd", $user_id, $date, $description, $amount);

    // Execute the statement
    if ($stmt->execute()) {
        $success = true; // Set success flag
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Income</title>
    <script>
        // Redirect if form submission was successful
        <?php if ($success): ?>
        window.location.href = '?page=income';
        <?php endif; ?>
    </script>
</head>
<body>
    <h1>Add New Income</h1>
    <form action="" method="post">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required><br><br>

        <input type="submit" value="Add Income">
    </form>
</body>
</html>