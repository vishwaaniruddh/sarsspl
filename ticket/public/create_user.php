<?php
include '../src/config/db.php';
include '../src/includes/header.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// Fetch clients and roles
$clients = $conn->query("SELECT client_id, client_name FROM clients");
$roles = $conn->query("SELECT role_id, role_name FROM roles");

// Check if the logged-in user is of role_id 3
$role_id = $_SESSION['role_id'] ?? null;
$client_id_for_role_3 = null;


if ($role_id == 3) {
    // Fetch the client associated with the logged-in user (assuming user_id is stored in session)
    $user_id = $_SESSION['user_id'];
    $query = "SELECT client_id FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $client_id_for_role_3 = $row['client_id'];

        $clients_query = $conn->query("SELECT client_id, client_name FROM clients where client_id='" . $client_id_for_role_3 . "'");
        $clients_fetch = mysqli_fetch_assoc($clients_query);
        $client_name_for_role_3 = $clients_fetch['client_name'];
    }
}

if ($logged_in_user_role_id == 3) {
    // If the user has role_id 3, fetch only users belonging to the same client
    $query_user = "SELECT u.user_id, u.username, u.email, r.role_name, c.client_name 
              FROM users u 
              LEFT JOIN roles r ON u.role_id = r.role_id 
              LEFT JOIN clients c ON u.client_id = c.client_id 
              WHERE u.client_id = (SELECT client_id FROM users WHERE user_id = ?)";
    $stmt_users = $conn->prepare($query_user);
    $stmt_users->bind_param("i", $logged_in_user_id);
} else {
    $query_user = "SELECT u.user_id, u.username, u.email, r.role_name, c.client_name 
              FROM users u 
              LEFT JOIN roles r ON u.role_id = r.role_id 
              LEFT JOIN clients c ON u.client_id = c.client_id";
    $stmt_users = $conn->prepare($query_user);
}

$stmt_users->execute();
$users = $stmt_users->get_result();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // No password encryption based on your requirement
    $role_id = $_POST['role_id'];

$client_id = $_POST['client_id'];
    // If the role is 3, set the client_id to the client's ID for that role
    // $client_id = ($role_id == 3) ? $client_id_for_role_3 : ($_POST['client_id'] ?? NULL);
// echo '$client_id = ' . $client_id;
    $query = "INSERT INTO users (username, email, password, role_id, client_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $username, $email, $password, $role_id, $client_id);

    if ($stmt->execute()) {
        header('Location: create_user.php'); // Reload to show new user
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<div class="container">

    <h2>Create User</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>



        <label for="role_id">Role:</label>
        <select name="role_id" required >
            <option value="">Select Role</option>
            <?php if ($role_id != 3) {
                while ($row = $roles->fetch_assoc()) { ?>
                    <option value="<?= $row['role_id']; ?>"><?= $row['role_name']; ?></option>
                <?php } ?>
            <?php } else { ?>
                <option value="3">User</option>
            <?php } ?>

        </select>



        <label for="client_id">Client (if applicable):</label>
        <select name="client_id" id="client_id" >
            <option value="">Select Client</option>
            <?php if ($role_id != 3) { // Only show clients if role_id is not 3 
            ?>
                <?php while ($row = $clients->fetch_assoc()) { ?>
                    <option value="<?= $row['client_id']; ?>"><?= $row['client_name']; ?></option>
                <?php } ?>
            <?php } else { ?>
                <option value="<?= $client_id_for_role_3; ?>" selected>
                    <?php echo $client_name_for_role_3; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Create User</button>
    </form>

    <h3>Existing Users</h3>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Client</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['user_id']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['role_name']; ?></td>
                    <td><?= $row['client_name'] ? $row['client_name'] : 'N/A'; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    function toggleClientSelection(role_id) {
        const clientSelect = document.getElementById('client_id');
        if (role_id == 3) {
            clientSelect.disabled = true;
        } else {
            clientSelect.disabled = false;
        }
    }
</script>

<?php include '../src/includes/footer.php'; ?>