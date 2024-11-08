<?php
include '../src/config/db.php';
include '../src/includes/header.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Fetch user role
$user_id = $_SESSION['user_id'];
$role_id = $_SESSION['role_id'];

// Fetch total counts

// Fetch tickets for the current page
$limit = 10; // Number of tickets per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if ($role_id == 3) { // Client role


$totalTickets = $conn->query("SELECT COUNT(*) AS count FROM tickets where client_id='".$client_id."'")->fetch_assoc()['count'];
// $totalOpenTickets = $conn->query("SELECT COUNT(*) AS count FROM tickets WHERE status in ('Open','Pending') and client_id='".$client_id."'")->fetch_assoc()['count'];
$totalClosedTickets = $conn->query("SELECT COUNT(*) AS count FROM tickets WHERE status = 'Close' and client_id='".$client_id."'")->fetch_assoc()['count'];
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users where client_id='".$client_id."'")->fetch_assoc()['count'];



    $stmt = $conn->prepare("SELECT t.ticket_id, c.client_name, t.title, t.status, t.created_at,t.user_id,t.updated_at,t.updated_by
                             FROM tickets t
                             JOIN clients c ON t.client_id = c.client_id
                             WHERE c.client_id = (SELECT client_id FROM users WHERE user_id = ?)
                             order by t.ticket_id desc
                             LIMIT ? OFFSET ?");
    $stmt->bind_param("iii", $user_id, $limit, $offset); 
    
    $notisql =  "SELECT * FROM notifications WHERE client_id = '".$client_id."' ORDER BY created_at DESC" ;
    
            $notificationsql = mysqli_query($conn,"select a.*,b.title, c.username from
        ticket_comments a
        INNER JOIN tickets b 
        ON a.ticket_id = b.ticket_id
         LEFT JOIN users c ON c.user_id = a.created_by 
        where b.client_id = '".$client_id."' 
        order by a.comment_id desc limit 20");
        
        
} else {
    
$totalTickets = $conn->query("SELECT COUNT(*) AS count FROM tickets")->fetch_assoc()['count'];
// $totalOpenTickets = $conn->query("SELECT COUNT(*) AS count FROM tickets WHERE status in ('Open','Pending')")->fetch_assoc()['count'];
$totalClosedTickets = $conn->query("SELECT COUNT(*) AS count FROM tickets WHERE status in('Close','Wrongly_open') ")->fetch_assoc()['count'];
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];




    $stmt = $conn->prepare("SELECT t.ticket_id, c.client_name, t.title, t.status, t.created_at, t.user_id,t.updated_at,t.updated_by
                             FROM tickets t
                             JOIN clients c ON t.client_id = c.client_id
                             order by t.ticket_id desc
                             LIMIT ? OFFSET ?");
    $stmt->bind_param("ii", $limit, $offset); // Binding parameters
    
    $notisql =  "SELECT * FROM notifications ORDER BY created_at DESC" ;
    
            $notificationsql = mysqli_query($conn,"select a.*,b.title, c.username from
        ticket_comments a
        INNER JOIN tickets b 
        ON a.ticket_id = b.ticket_id
        LEFT JOIN users c ON c.user_id = a.created_by 
        order by a.comment_id desc limit 20");
}
$stmt->execute();
$tickets = $stmt->get_result();

$totalPages = ceil($totalTickets / $limit);


$notistmt = $conn->prepare($notisql);

$notistmt->execute();
$notifications = $notistmt->get_result();
$totalOpenTickets = $totalTickets - $totalClosedTickets ; 
?>

<div class="container">
    <div class="dashboard-cards">

        <a href="./users.php" class="card-link">
            <div class="card">
                <h3>Total Users</h3>
                <p><?= $totalUsers; ?></p>
            </div>
        </a>

        <a href="./tickets.php" class="card-link">
            <div class="card">
                <h3>Total Tickets</h3>
                <p><?= $totalTickets; ?></p>
            </div>
        </a>

        <a href="./open_tickets.php" class="card-link">
            <div class="card">
                <h3>Total Open Tickets</h3>
                <p><?= $totalOpenTickets; ?></p>
            </div>
        </a>

        <a href="./closed_tickets.php" class="card-link">
            <div class="card">
                <h3>Total Closed Tickets</h3>
                <p><?= $totalClosedTickets; ?></p>
            </div>
        </a>

    </div>
</div>

<br />
<div class="container" style="overflow:auto;">
    <h3>Existing Tickets</h3>
    <table>
        <thead>
            <tr>
                <th style="white-space:nowrap;">Ticket ID</th>
                <th>View</th>
                <th>Client</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Updated</th>
                <th>Updated By</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $tickets->fetch_assoc()) { ?>
                <tr>
                    <td> <?= $row['ticket_id']; ?></td>
                    <td> <a href="view_ticket.php?ticket_id=<?= $row['ticket_id']; ?>" class="btn">View</a> </td>
                    <td  style="white-space:nowrap;"><?= $row['client_name']; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td style="white-space:nowrap;"><?= ucwords(getuserInfo($row['user_id'], 'username')); ?></td>
                    
                    <td style="white-space:nowrap;"><?= $row['created_at']; ?></td>
                    <td style="white-space:nowrap;"><?= $row['updated_at'];?></td>
                    <td style="white-space:nowrap;"><?= ucwords(getuserInfo($row['updated_by'], 'username')); ?></td>
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

<br />
<div class="container">
    <h3>Notifications</h3>
    <div class="notification-list">
        
        
        <table>
            <tr>
                <th>Sr no</th>
                <th>Ticket Title</th>
                <th>Comment</th>
                <th>Attachment</th>
                <th>Created At</th>
                <th>Created By</th>
            </tr>
         
        <?php 
        
        $counter = 1 ; 

        while($notificationsqlResult = mysqli_fetch_assoc($notificationsql)){

            ?>
            
            <tr>
                  <td><?php echo $counter ; ?></td>
                <td><?php echo $notificationsqlResult['title']; ?></td>
                <td><?php echo $notificationsqlResult['comment']; ?></td>
                <td>
                    <?php 
                    if ($notificationsqlResult['attachment']) {
                        echo '<a href="' . $notificationsqlResult['attachment'] . '" target="_blank">View</a>';
                    }
                    ?>
                </td>

                <td><?php echo $notificationsqlResult['created_at']; ?></td>
                <td><?php echo $notificationsqlResult['username']; ?></td>
            </tr>
            
            <?php 
            
            
            
            $counter++ ;
            
        }
        
        ?>
        </table>
    </div>
</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        color: #333;
    }

    h3 {
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .dashboard-cards {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .card {
        background: linear-gradient(135deg, #6D5BFF, #4FC4F8);
        color: #fff;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .card h3 {
        font-size: 1.6rem;
        margin-bottom: 15px;
    }

    .card p {
        font-size: 2.2rem;
        font-weight: bold;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 0.9rem;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    table th {
        background-color: #f8f8f8;
        font-weight: bold;
    }

    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        text-decoration: none;
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        color: #333;
        margin: 0 4px;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #6D5BFF;
        color: #fff;
    }

    .pagination .active {
        background-color: #6D5BFF;
        color: #fff;
        border: 1px solid #6D5BFF;
    }

    .notification-list {
        margin-top: 20px;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .notification-list ul {
        list-style: none;
        padding: 0;
    }

    .notification-list li {
        margin-bottom: 10px;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .notification-list li p:first-child {
        font-weight: bold;
        color: #333;
    }

    .notification-list li p:last-child {
        color: #555;
    }

    /* Button Styling */
    .btn {
        background-color: #6D5BFF;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #4FC4F8;
    }
</style>

<?php include '../src/includes/footer.php'; ?>
