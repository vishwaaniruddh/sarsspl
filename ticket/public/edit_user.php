<?php
include '../src/config/db.php';
include '../src/includes/header.php';

// Get user ID
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

// Fetch user details
$userQuery = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Check if user exists
if (!$user) {
    echo "<p>User not found.</p>";
    exit;
}

// Update user details if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role_id = $_POST['role_id'];
    $client_id = $_POST['client_id'];

    // Update query
    $updateQuery = "UPDATE users SET username = ?, email = ?, phone = ?, role_id = ?, client_id = ? WHERE user_id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssiis", $username, $email, $phone, $role_id, $client_id, $user_id);
    
    if ($updateStmt->execute()) {

                    echo "<script>alert('User updated successfully!'); window.location.href='./edit_user.php?user_id=$user_id';</script>";

    } else {
        echo "<p>Failed to update user.</p>";
    }
}

// Fetch roles and clients for dropdown
$roles = $conn->query("SELECT * FROM roles");
$clients = $conn->query("SELECT * FROM clients");

?>

<div class="container">
    <h2>Edit User</h2>

    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?= $user['username']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= $user['email']; ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?= $user['phone']; ?>" required>

        <label for="role_id">Role:</label>
        <select name="role_id" required>
            <?php while ($role = $roles->fetch_assoc()) { ?>
                <option value="<?= $role['role_id']; ?>" <?= ($role['role_id'] == $user['role_id']) ? 'selected' : ''; ?>>
                    <?= $role['role_name']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="client_id">Client:</label>
        <select name="client_id" >
            <option value="">Select</option>
            <?php while ($client = $clients->fetch_assoc()) { ?>
                <option value="<?= $client['client_id']; ?>" <?= ($client['client_id'] == $user['client_id']) ? 'selected' : ''; ?>>
                    <?= $client['client_name']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Update User</button>
    </form>
</div>

<?php include '../src/includes/footer.php'; ?>
