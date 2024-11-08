<?php
include '../src/config/db.php';
include '../src/includes/header.php';

// Fetch clients
$clients = $conn->query("SELECT * FROM clients");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = $_POST['client_name'];

    $query = "INSERT INTO clients (client_name) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $client_name);

    if ($stmt->execute()) {
        header('Location: create_client.php'); // Reload to reflect new client in table
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<div class="container">
    <h2>Create Client</h2>
    <form method="POST">
        <label for="client_name">Client Name:</label>
        <input type="text" name="client_name" required>
        <button type="submit">Create Client</button>
    </form>

    <h3>Existing Clients</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $clients->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['client_id']; ?></td>
                    <td><?= $row['client_name']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../src/includes/footer.php'; ?>
