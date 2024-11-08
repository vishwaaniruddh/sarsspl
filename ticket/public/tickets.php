<?php
include '../src/config/db.php';
include '../src/includes/header.php';

// Pagination settings
$limit = 10; // Number of tickets per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Filter settings
$filterStatus = isset($_GET['status']) ? $_GET['status'] : '';
$filterClient = isset($_GET['client_id']) ? $_GET['client_id'] : '';
$filterQuery = "";

// Building the query based on filters
if (!empty($filterStatus)) {
    $filterQuery .= " AND t.status = '{$filterStatus}'";
}
if (!empty($filterClient)) {
    $filterQuery .= " AND t.client_id = '{$filterClient}'";
}



if ($logged_in_user_role_id == 3) { 
$ticketQuery = "SELECT t.ticket_id, t.title, t.status, t.created_at, c.client_name 
                FROM tickets t 
                LEFT JOIN clients c ON t.client_id = c.client_id 
                WHERE 1 {$filterQuery}
                 AND t.client_id = ?
                ORDER BY t.created_at DESC 
                LIMIT ?, ?";
                
                
$stmt = $conn->prepare($ticketQuery);
$stmt->bind_param("iii", $global_client_id, $offset, $limit);
$clients = $conn->query("SELECT * FROM clients where client_id='".$global_client_id."'");


}else{
    
$ticketQuery = "SELECT t.ticket_id, t.title, t.status, t.created_at, c.client_name 
                FROM tickets t 
                LEFT JOIN clients c ON t.client_id = c.client_id 
                WHERE 1 {$filterQuery}
                ORDER BY t.created_at DESC 
                LIMIT ?, ?";
                
                
$stmt = $conn->prepare($ticketQuery);
$stmt->bind_param("ii", $offset, $limit);

$clients = $conn->query("SELECT * FROM clients");

}
$stmt->execute();
$tickets = $stmt->get_result();

// Fetch total tickets count for pagination
$countQuery = "SELECT COUNT(ticket_id) as total FROM tickets t WHERE 1 {$filterQuery}";
$countResult = $conn->query($countQuery);
$totalTickets = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalTickets / $limit);

// Fetch all clients for client filter dropdown


?>

<div class="container">
    <h2>Tickets</h2>

    <!-- Filters for tickets -->
    <form method="GET" action="tickets.php">
        <label for="status">Status:</label>
        <select name="status">
            <option value="">All</option>
            <option value="Pending" <?= ($filterStatus == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Verfication_in_progress" <?= ($filterStatus == 'Verfication_in_progress') ? 'selected' : ''; ?>>Verification In Progress</option>
            <option value="Close" <?= ($filterStatus == 'Close') ? 'selected' : ''; ?>>Resolved and Closed</option>
            <option value="Wrongly_open" <?= ($filterStatus == 'Wrongly_open') ? 'selected' : ''; ?>>Wrongly Open</option>
        </select>

        <label for="client_id">Client:</label>
        <select name="client_id">
            <option value="">All</option>
            <?php while ($client = $clients->fetch_assoc()) { ?>
                <option value="<?= $client['client_id']; ?>" <?= ($filterClient == $client['client_id']) ? 'selected' : ''; ?>>
                    <?= $client['client_name']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Apply Filters</button>
    </form>

    <!-- Tickets Table -->
    <table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Title</th>
                <th>Client</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tickets->num_rows > 0) { ?>
                <?php while ($ticket = $tickets->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $ticket['ticket_id']; ?></td>
                        <td><?= $ticket['title']; ?></td>
                        <td><?= $ticket['client_name']; ?></td>
                        <td><?= $ticket['status']; ?></td>
                        <td><?= date("Y-m-d H:i:s", strtotime($ticket['created_at'])); ?></td>
                        <td>
                            <a href="view_ticket.php?ticket_id=<?= $ticket['ticket_id']; ?>">View</a> 
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6">No tickets found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="?page=<?= $page - 1; ?>&status=<?= $filterStatus; ?>&client_id=<?= $filterClient; ?>">&laquo; Previous</a>
        <?php } ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?= $i; ?>&status=<?= $filterStatus; ?>&client_id=<?= $filterClient; ?>" <?= ($i == $page) ? 'class="active"' : ''; ?>>
                <?= $i; ?>
            </a>
        <?php } ?>

        <?php if ($page < $totalPages) { ?>
            <a href="?page=<?= $page + 1; ?>&status=<?= $filterStatus; ?>&client_id=<?= $filterClient; ?>">Next &raquo;</a>
        <?php } ?>
    </div>
</div>

<?php include '../src/includes/footer.php'; ?>
