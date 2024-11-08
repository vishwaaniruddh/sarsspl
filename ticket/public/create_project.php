<?php
include '../src/config/db.php';
include '../src/includes/header.php';

// Fetch clients and projects
$clients = $conn->query("SELECT client_id, client_name FROM clients");
$projects = $conn->query("SELECT p.project_id, p.project_name, p.project_description, c.client_name 
                         FROM projects p 
                         JOIN clients c ON p.client_id = c.client_id");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];

    $query = "INSERT INTO projects (client_id, project_name, project_description) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $client_id, $project_name, $project_description);

    if ($stmt->execute()) {
        header('Location: create_project.php'); // Reload to show new project
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<div class="container">
    <h2>Create Project</h2>
    <form method="POST">
        <label for="client_id">Select Client:</label>
        <select name="client_id" required>
            <option value="">Select Client</option>
            <?php while ($row = $clients->fetch_assoc()) { ?>
                <option value="<?= $row['client_id']; ?>"><?= $row['client_name']; ?></option>
            <?php } ?>
        </select>

        <label for="project_name">Project Name:</label>
        <input type="text" name="project_name" required>

        <label for="project_description">Project Description:</label>
        <textarea name="project_description" required></textarea>

        <button type="submit">Create Project</button>
    </form>

    <h3>Existing Projects</h3>
    <table>
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Client</th>
                <th>Project Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $projects->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['project_id']; ?></td>
                    <td><?= $row['client_name']; ?></td>
                    <td><?= $row['project_name']; ?></td>
                    <td><?= $row['project_description']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../src/includes/footer.php'; ?>
