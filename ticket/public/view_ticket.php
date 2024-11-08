<?php
include '../src/config/db.php';
include '../src/includes/header.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require './emailNotification.php';

if (!isset($_GET['ticket_id'])) {
    die("Ticket ID is required.");
}

$ticket_id = $_GET['ticket_id'];

// Fetch ticket details
$query = "SELECT t.*, c.client_name, p.project_name, u.username
          FROM tickets t
          JOIN clients c ON t.client_id = c.client_id
          JOIN projects p ON t.project_id = p.project_id
          JOIN users u ON t.user_id = u.user_id
          WHERE t.ticket_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $ticket_id);
$stmt->execute();
$result = $stmt->get_result();
$ticket = $result->fetch_assoc();

$currentStatus = $ticket['status'];
if (!$ticket) {
    die("Ticket not found.");
}

// Fetch attachments
$attachments = explode(',', $ticket['attachment']);
$email_attachment = $ticket['email_attachment'];

// Fetch comments for the ticket
$comments = $conn->query("SELECT * FROM ticket_comments WHERE ticket_id = $ticket_id ORDER BY comment_id  DESC");

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment'])) {

        // Build the query with parameters
        $get_ticketssql = "SELECT * FROM tickets WHERE ticket_id = ?";
        $get_ticketssqlStmt = $conn->prepare($get_ticketssql);

        // Bind parameters
        $get_ticketssqlStmt->bind_param("i", $ticket_id);

        // Execute the statement
        $get_ticketssqlStmt->execute();
        $ticket_result = $get_ticketssqlStmt->get_result();

        // Fetch the ticket details
        if ($ticket = $ticket_result->fetch_assoc()) { // Fetch the row as an associative array

            $ticket_status = $_POST['ticket_status'];
            $datetime = date('Y-m-d H:i:s'); // Make sure to set datetime properly
            

            $updateQuery = "UPDATE tickets SET status = ?, updated_at = ?, updated_by = ? WHERE ticket_id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ssii", $ticket_status, $datetime, $logged_in_user_id, $ticket_id);
            $updateStmt->execute();

            // Add new comment
            $comment = $_POST['comment'];
            $commentAttachment = $_FILES['comment_attachment']['name'];

            // Handle file upload for comment attachment
            if ($commentAttachment) {
                $uploadDir = '../uploads/comments/' . date('Y/m/d/') . $ticket_id . '/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $commentAttachmentPath = $uploadDir . basename($commentAttachment);
                move_uploaded_file($_FILES['comment_attachment']['tmp_name'], $commentAttachmentPath);
            } else {
                $commentAttachmentPath = null; // Set to null if no attachment
            }

            // Insert comment into the database
            $commentQuery = "INSERT INTO ticket_comments (ticket_id, comment, attachment, ticket_status, created_by, created_at) VALUES (?, ?, ?, ?, ?, ?)";
            $commentStmt = $conn->prepare($commentQuery);
            $commentStmt->bind_param("isssis", $ticket_id, $comment, $commentAttachmentPath, $ticket_status, $logged_in_user_id, $datetime);
            $commentStmt->execute();

            // Notify the client
            $client_id = $ticket['client_id']; // Assuming you have client_id in the ticket details
            $notification_message = "New comment added to your ticket ID: " . $ticket_id;
            $notificationQuery = "INSERT INTO notifications (client_id, ticket_id, message, created_at) VALUES (?, ?, ?, ?)";
            $notificationStmt = $conn->prepare($notificationQuery);
            $notificationStmt->bind_param("iiss", $client_id, $ticket_id, $notification_message, $datetime);
            $notificationStmt->execute();

            // Initialize CC emails and names
            $software_team = 0; 

            // Build the query with parameters for CC emails
            $ccQuery = "SELECT email, username FROM users WHERE client_id IN (?, ?)";
            $ccStmt = $conn->prepare($ccQuery);
            $ccStmt->bind_param("ii", $software_team, $client_id);
            $ccStmt->execute();
            $ccResult = $ccStmt->get_result();

            // Initialize arrays for emails and names
            $ccEmails = [];
            $ccNames = [];

            // Fetch results
            while ($user = $ccResult->fetch_assoc()) {
                $ccEmails[] = $user['email']; // Store client email for CC
                $ccNames[] = $user['username']; // Store client name
            }

            // Prepare ticket details for email
            $ticketDetails = [
                'ticket_id' => $ticket_id,
                'title' => $ticket['title'], // Ensure 'title' is fetched from the ticket data
                'status' => $ticket_status,
                'description' => $comment
            ];

            // Prepare the attachments array
            $attachments = []; 
            if ($commentAttachmentPath) {
                $attachments[] = $commentAttachmentPath; // Add the attachment path if it exists
            }

            // Send email notification
            sendTicketEmail('tickets@sarsspl.com', 'Ticketing System', 'Ticket Updated', $ticketDetails, $ccEmails, $attachments);

            // Alert user and redirect
            echo "<script>alert('Ticket Updated successfully!'); window.location.href='./view_ticket.php?ticket_id=$ticket_id';</script>";
        } else {
            echo "<script>alert('Ticket not found!');</script>";
        }
    }
}

?>

<div class="ticketPrimaryInfo">
    <div class="container">
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
        <h2>Ticket Details</h2>

        <table class="ticket-details-table">
            <tr>
                <th>Ticket ID</th>
                <td><?= $ticket['ticket_id']; ?></td>
            </tr>
            <tr>
                <th>Client</th>
                <td><?= $ticket['client_name']; ?></td>
            </tr>
            <tr>
                <th>Project</th>
                <td><?= $ticket['project_name']; ?></td>
            </tr>
            <tr>
                <th>User</th>
                <td><?= $ticket['username']; ?></td>
            </tr>
            <tr>
                <th>Title</th>
                <td><?= $ticket['title']; ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?= nl2br($ticket['description']); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $ticket['status']; ?></td>
            </tr>
            <tr>
                <th>Created At</th>
                <td><?= $ticket['created_at']; ?></td>
            </tr>
        </table>

        <h3>Attachments</h3>
        <div class="attachment-grid">
            <?php foreach ($attachments as $attachment): ?>
                <div class="attachment-item">
                    <a href="<?= $attachment; ?>" target="_blank">
                        <img src="<?= $attachment; ?>" style="    width: 250px;" alt="<?= basename($attachment); ?>" class="attachment-image">
                    </a>

                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($email_attachment): ?>
            <h3>Email Attachment</h3>
            <a href="<?= $email_attachment; ?>" target="_blank"><?= basename($email_attachment); ?></a>
        <?php endif; ?>

    </div>


    <br />
    <div class="updateTikcet container">
        <h3>Update Ticket</h3>

        <?php
        if ($currentStatus == 'Close') { ?>
            <a href="openTicket.php?ticket_id=<?php echo $ticket_id; ?>" onclick="return confirmReopen()">Reopen</a>

        <?php } else { ?>

            <form method="POST" enctype="multipart/form-data">


                <?php
                if ($logged_in_user_role_id == 3) { ?>

                    <select name="ticket_status" id="ticket_status">
                        <option value="Pending" <?php if ($currentStatus == 'Pending') {
                                                    echo 'selected';
                                                } ?>>Pending</option>
                        <option value="Verfication_in_progress" <?php if ($currentStatus == 'Verfication_in_progress') {
                                                                    echo 'selected';
                                                                } ?>>Verfication In Progress</option>
                        <option value="Close" <?php if ($currentStatus == 'Close') {
                                                    echo 'selected';
                                                } ?>>Resolved And Close</option>
                        <option value="Wrongly_open" <?php if ($currentStatus == 'Wrongly_open') {
                                                            echo 'selected';
                                                        } ?>>Wrongly Open</option>
                        <?php if ($currentStatus == 'Close') { ?>
                            <option value="Reopen" <?php if ($currentStatus == 'Reopen') {
                                                        echo 'selected';
                                                    } ?>>Reopen</option>
                        <?php } ?>
                    </select>

                <?php } else { ?>
                    <select name="ticket_status" id="ticket_status">
                        <option value="Pending" <?php if ($currentStatus == 'Pending') {
                                                    echo 'selected';
                                                } ?>>Pending</option>
                        <option value="Verfication_in_progress" <?php if ($currentStatus == 'Verfication_in_progress') {
                                                                    echo 'selected';
                                                                } ?>>Verfication In Progress</option>
                        <option value="Wrongly_open" <?php if ($currentStatus == 'Wrongly_open') {
                                                            echo 'selected';
                                                        } ?>>Wrongly Open</option>
                        <?php if ($currentStatus == 'Close') { ?>
                            <option value="Reopen" <?php if ($currentStatus == 'Reopen') {
                                                        echo 'selected';
                                                    } ?>>Reopen</option>
                        <?php } ?>
                    </select>
                <?php } ?>


                <label for="comment">Add Comment:</label>
                <textarea name="comment" rows="10" cols="50" required></textarea>

                <label for="comment_attachment">Attachment (optional):</label>
                <input type="file" name="comment_attachment" />

                <button type="submit">Add Comment</button>
            </form>



        <?php } ?>


    </div>

    <br>
    <div class="container">

        <h3>Comments</h3>
        <div class="comments-timeline">
            <?php while ($comment = $comments->fetch_assoc()): ?>
                <div class="comment-item">
                    <p><strong><?= $comment['created_at']; ?> - <?= ucwords(getuserInfo($comment['created_by'], 'username')); ?> </strong></p>
                    <p><?= nl2br($comment['comment']); ?></p>
                    <?php if ($comment['attachment']): ?>
                        <a href="<?= $comment['attachment']; ?>" target="_blank">View Attachment</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

</div>

<script>
    function confirmReopen() {
        return confirm("Are you sure you want to reopen this ticket?");
    }
</script>

<style>
    .ticket-details-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .ticket-details-table th,
    .ticket-details-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .ticket-details-table th {
        background-color: #f2f2f2;
    }

    .attachment-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .attachment-item {
        flex: 1 1 150px;
        text-align: center;
    }

    .attachment-image {
        max-width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .comments-timeline {
        margin-top: 20px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }

    .comment-item {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
    }
</style>

<?php include '../src/includes/footer.php'; ?>