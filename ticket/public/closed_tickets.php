<?php
include '../src/config/db.php';
include '../src/includes/header.php';

// Pagination settings
$limit = 10; // Number of tickets per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch closed tickets with pagination


if ($logged_in_user_role_id == 3) { 
    $ticketQuery = "SELECT t.ticket_id, t.title, t.status, t.created_at, c.client_name 
                FROM tickets t 
                LEFT JOIN clients c ON t.client_id = c.client_id 
                WHERE t.status in('Close','close','Wrongly_open','wrongly_open') 
                  AND t.client_id = ?
                ORDER BY t.created_at DESC 
                LIMIT ?, ?";
$stmt = $conn->prepare($ticketQuery);
$stmt->bind_param("iii", $global_client_id,$offset, $limit);

}else{
$ticketQuery = "SELECT t.ticket_id, t.title, t.status, t.created_at, c.client_name 
                FROM tickets t 
                LEFT JOIN clients c ON t.client_id = c.client_id 
                WHERE t.status in('Close','close','Wrongly_open','wrongly_open') 
                ORDER BY t.created_at DESC 
                LIMIT ?, ?";
$stmt = $conn->prepare($ticketQuery);
$stmt->bind_param("ii", $offset, $limit);    
}

$stmt->execute();
$tickets = $stmt->get_result();

// Fetch total closed tickets count for pagination
$countQuery = "SELECT COUNT(ticket_id) as total FROM tickets WHERE status = 'Closed'";
$countResult = $conn->query($countQuery);
$totalClosedTickets = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalClosedTickets / $limit);

?>

<div class="container">
    <h2>Closed Tickets</h2>

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
                    <td colspan="6">No closed tickets found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="?page=<?= $page - 1; ?>">&laquo; Previous</a>
        <?php } ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?= $i; ?>" <?= ($i == $page) ? 'class="active"' : ''; ?>>
                <?= $i; ?>
            </a>
        <?php } ?>

        <?php if ($page < $totalPages) { ?>
            <a href="?page=<?= $page + 1; ?>">Next &raquo;</a>
        <?php } ?>
    </div>
</div>

<?php include '../src/includes/footer.php'; ?>
