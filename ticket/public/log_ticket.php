<?php
// Include the database connection
include '../src/config/db.php';

// Fetch clients
$query = "SELECT user_id, username FROM users WHERE role = 'client'";
$clients = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $project_id = $_POST['project_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $created_by = 1; // Assuming admin ID is 1

    $query = "INSERT INTO tickets (project_id, title, description, created_by) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issi", $project_id, $title, $description, $created_by);

    if ($stmt->execute()) {
        echo "Ticket logged successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Ticket</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Log New Ticket</h2>
        <form method="POST">
            <label for="client_id">Client:</label>
            <select name="client_id" required>
                <option value="">Select Client</option>
                <?php while ($row = $clients->fetch_assoc()) { ?>
                    <option value="<?= $row['user_id']; ?>"><?= $row['username']; ?></option>
                <?php } ?>
            </select>

            <label for="project_id">Project ID:</label>
            <input type="number" name="project_id" required>

            <label for="title">Ticket Title:</label>
            <input type="text" name="title" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <button type="submit">Log Ticket</button>
        </form>
    </div>
</body>
</html>
