<?php
// Include necessary files (database connection, session, etc.)
include '../src/config/db.php';

// Get ticket ID from URL
$ticket_id = isset($_GET['ticket_id']) ? (int)$_GET['ticket_id'] : null;

if (!$ticket_id) {
    die("Ticket ID is missing.");
}

// Start session to access logged-in user details
session_start();
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
$role_id = $_SESSION['role_id'];
$ticket_status = 'Reopen';
$user_name = getuserInfo($user_id,'username');
// Check if form was submitted or link was clicked to update status
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_GET['ticket_id'])) {

    // Update the ticket status to "Reopen" in the tickets table
    $updateTicketStatusQuery = "UPDATE tickets SET status = 'Reopen' WHERE ticket_id = ?";
    $stmt = $conn->prepare($updateTicketStatusQuery);
    $stmt->bind_param("i", $ticket_id);
    if ($stmt->execute()) {

        // Insert a new comment in the comments table
        $comment = "Ticket reopened by $user_name";
        $insertCommentQuery = "INSERT INTO ticket_comments (ticket_id, created_by, comment, created_at,ticket_status) VALUES (?, ?, ?, NOW(), ?)";
        $stmt = $conn->prepare($insertCommentQuery);
        $stmt->bind_param("iiss", $ticket_id, $user_id, $comment,$ticket_status);
        $stmt->execute();

        // Redirect to the ticket view page
        header("Location: view_ticket.php?ticket_id=$ticket_id");
        exit();
    } else {
        echo "Error updating ticket: " . $stmt->error;
    }
}
