<?php
include '../src/config/db.php';
include '../src/includes/header.php';


$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch users data
if ($logged_in_user_role_id == 3) { 

$usersQuery = "SELECT u.user_id, u.username, u.email, r.role_name, c.client_name 
               FROM users u 
               LEFT JOIN roles r ON u.role_id = r.role_id 
               LEFT JOIN clients c ON u.client_id = c.client_id 
               WHERE
               u.client_id = ?
               LIMIT ? OFFSET ?";

$stmt = $conn->prepare($usersQuery);
$stmt->bind_param("iii", $global_client_id ,$limit, $offset);

}else{

$usersQuery = "SELECT u.user_id, u.username, u.email, r.role_name, c.client_name 
               FROM users u 
               LEFT JOIN roles r ON u.role_id = r.role_id 
               LEFT JOIN clients c ON u.client_id = c.client_id 
               LIMIT ? OFFSET ?";
               
               
$stmt = $conn->prepare($usersQuery);
$stmt->bind_param("ii", $limit, $offset);
    
}

$stmt->execute();
$users = $stmt->get_result();

// Fetch total number of users for pagination
$totalUsersResult = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc();
$totalUsers = $totalUsersResult['count'];
$totalPages = ceil($totalUsers / $limit);

?>

<div class="container">
    <h2>All Users</h2>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Client</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['user_id']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['role_name']; ?></td>
                    <td><?= $row['client_name']; ?></td>
                    <td>
                        <a href="view_user.php?user_id=<?= $row['user_id']; ?>" class="btn">View</a>
                        <a href="edit_user.php?user_id=<?= $row['user_id']; ?>" class="btn">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1; ?>">&laquo; Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i; ?>" class="<?= ($i === $page) ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1; ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
</div>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .pagination a {
        padding: 10px 15px;
        margin: 5px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        text-decoration: none;
        color: #333;
    }

    .pagination a.active {
        background-color: #333;
        color: white;
    }

    .btn {
        padding: 5px 10px;
        background-color: #007BFF;
        color: white;
        text-decoration: none;
        border-radius: 3px;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>

<?php include '../src/includes/footer.php'; ?>
