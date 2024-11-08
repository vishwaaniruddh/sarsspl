<?php
include '../src/config/db.php';
include '../src/includes/header.php';


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



// Get the user_id from the query string
$user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;

// Fetch user details
$userQuery = "SELECT u.user_id, u.username, u.email, u.phone, r.role_name, c.client_name 
              FROM users u 
              LEFT JOIN roles r ON u.role_id = r.role_id 
              LEFT JOIN clients c ON u.client_id = c.client_id 
              WHERE u.user_id = ?";

$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Check if user exists
if (!$user) {
    echo "<p>User not found.</p>";
    exit;
}

?>

<div class="container">
    <h2>User Details</h2>
    <table>
        <tr>
            <th>User ID</th>
            <td><?= $user['user_id']; ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= $user['username']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $user['email']; ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?= $user['phone']; ?></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?= $user['role_name']; ?></td>
        </tr>
        <tr>
            <th>Client</th>
            <td><?= $user['client_name']; ?></td>
        </tr>
    </table>
    <br>
    <a href="edit_user.php?user_id=<?= $user['user_id']; ?>" class="btn">Edit User</a>
</div>

<?php include '../src/includes/footer.php'; ?>
