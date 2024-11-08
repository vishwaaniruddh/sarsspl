<?php
include '../src/config/db.php';
include '../src/includes/header.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$user_id = $_SESSION['user_id']; // Ensure you have user ID in session

// Fetch clients for the client dropdown
$clients = $conn->query("SELECT client_id, client_name FROM clients");

require './emailNotification.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $project_id = $_POST['project_id']; // Fetch project_id from form

    $status = 'Pending';
    // Prepare to upload files
    $attachmentPaths = [];
    $emailAttachmentPath = '';

    // Insert ticket to get ticket ID for folder structure
    $query = "INSERT INTO tickets (project_id, client_id, user_id, title, description, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiisss", $project_id, $client_id, $user_id, $title, $description, $status);

    if ($stmt->execute()) {
        $ticket_id = $stmt->insert_id; // Get the newly created ticket ID
        
        // Create folder structure
        $uploadDir = '../uploads/tickets/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . $ticket_id . '/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory structure
        }

        // Handle file uploads for ticket attachments
        if (isset($_FILES['attachments'])) {
            $files = $_FILES['attachments'];
            $totalFiles = count($files['name']);
            for ($i = 0; $i < $totalFiles; $i++) {
                if ($files['error'][$i] === 0 && $files['size'][$i] <= 10 * 1024 * 1024) { // max 10 MB
                    $fileName = basename($files['name'][$i]);
                    $targetFilePath = $uploadDir . uniqid() . '_' . $fileName;

                    if (move_uploaded_file($files['tmp_name'][$i], $targetFilePath)) {
                        $attachmentPaths[] = $targetFilePath; // Store file path for database
                    }
                }
            }
        }

        // Handle email attachment
        if (isset($_FILES['email_attachment']) && $_FILES['email_attachment']['error'] === 0 && $_FILES['email_attachment']['size'] <= 10 * 1024 * 1024) {
            $emailUploadDir = '../uploads/emails/';
            if (!file_exists($emailUploadDir)) {
                mkdir($emailUploadDir, 0777, true); // Create directory for email attachments
            }
            $emailFileName = basename($_FILES['email_attachment']['name']);
            $emailAttachmentPath = $emailUploadDir . uniqid() . '_' . $emailFileName;

            if (move_uploaded_file($_FILES['email_attachment']['tmp_name'], $emailAttachmentPath)) {
                // Email attachment uploaded successfully
            }
        }

        // Convert attachment paths to a string
        $attachmentsString = implode(',', $attachmentPaths);

        // Update ticket with attachment paths
        $updateQuery = "UPDATE tickets SET attachment = ?, email_attachment = ? WHERE ticket_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ssi", $attachmentsString, $emailAttachmentPath, $ticket_id);
        $updateStmt->execute();

        // Prepare to send notification email
        // Get emails of all clients associated with the project
   
   $software_team = 0; 


// Build the query with parameters
$ccQuery = "SELECT email, username FROM users WHERE client_id IN (?, ?)";
$ccStmt = $conn->prepare($ccQuery);

// Bind parameters
$ccStmt->bind_param("ii", $software_team, $client_id);

// Execute the statement
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
            'title' => $title,
            'status' => $status,
            'description' => $description
        ];

$attachments = array_merge($attachmentPaths); // Add all attachment paths to the array

sendTicketEmail('tickets@sarsspl.com', 'Ticketing System', 'Ticket Created', $ticketDetails, $ccEmails, $attachments);

        echo "<script>alert('Ticket Created successfully!');
        window.location.href='./view_ticket.php?ticket_id=$ticket_id';</script>";

    } else {
        echo "Error: " . $stmt->error;
    }
}

?>

<div class="container">
    <h2>Create Ticket</h2>
    <form method="POST" enctype="multipart/form-data">
       
        
        <?php 
        if($logged_in_user_role_id==3){ ?>
            
           <input type="hidden" name="client_id" value="<?php echo $global_client_id; ?>" /> 
        <?php }else{ ?>
         <label for="client_id">Select Client:</label>
        <select name="client_id" id="client_id" required>
            <option value="">Select Client</option>
            
            <?php while ($row = $clients->fetch_assoc()) { ?>
                <option value="<?= $row['client_id']; ?>"><?= $row['client_name']; ?></option>
            <?php } ?>
            
        </select>
        
        <?php }
        
        ?>
        
        
 

        <label for="project_id">Select Project:</label>
        <select name="project_id" id="project_id" required>
            <option value="">Select Project</option>
        <?php 
        if($logged_in_user_role_id==3){ 
            
            $projectsql = mysqli_query($conn,"select * from projects where client_id='".$global_client_id."'");
            while($projectsql_result = mysqli_fetch_assoc($projectsql)){
                $project_name = $projectsql_result['project_name'];
                $project_id  = $projectsql_result['project_id'];
            ?>
            <option value="<?php echo $project_id ; ?>"><?php echo $project_name ; ?></option>
            <?php
            }
            
            
             }else { 
                 
              
            $projectsql = mysqli_query($conn,"select * from projects");
            while($projectsql_result = mysqli_fetch_assoc($projectsql)){
                $project_name = $projectsql_result['project_name'];
                $project_id  = $projectsql_result['project_id'];
            ?>
            <option value="<?php echo $project_id ; ?>"><?php echo $project_name ; ?></option>
            <?php
            }     
            
              } ?>
        </select>

        <label for="title">Ticket Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="attachments">Attachments (Max 5 files, 10MB each) (Optional):</label>
        <input type="file" name="attachments[]" multiple accept=".jpg,.jpeg,.png,.pdf">

        <label for="email_attachment">Email Attachment (Optional):</label>
        <input type="file" name="email_attachment">


        <label for="email_attachment">Assign To</label>
        
        <select name="assigned_to" id="assigned_to" required>
            <option value="">Select</option>
            <?php 
            $teamsql = mysqli_query($conn,"select * from users where role_id=2 and status=1");
            while($teamsqlResult = mysqli_fetch_assoc($teamsql)){ 
            
            $thisuserid = $teamsqlResult['user_id'];
            $thisusername = $teamsqlResult['username'];
            
            ?>
            
            <option value="<?php echo $thisuserid ; ?>"><?php echo $thisusername ; ?></option>
                
            <?php } ?>
        </select>





        <button type="submit" id="submitButton">Create Ticket</button>

    </form>

 
</div>

<br />
<div class="container">
       <h3>Existing Tickets</h3>
    <table>
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Client</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch existing tickets
            
            if($logged_in_user_role_id==3){ 
            
            
            $tickets = $conn->query("SELECT t.ticket_id, c.client_name, t.title, t.status, t.created_at
                                      FROM tickets t
                                      JOIN clients c ON t.client_id = c.client_id AND c.client_id='".$global_client_id."'");
                                      
            }else{
                
            $tickets = $conn->query("SELECT t.ticket_id, c.client_name, t.title, t.status, t.created_at
                                      FROM tickets t
                                      JOIN clients c ON t.client_id = c.client_id");
                
            }                          
                                      
            while ($row = $tickets->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['ticket_id']; ?></td>
                    <td><?= $row['client_name']; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
document.getElementById('client_id').addEventListener('change', function() {
    var clientId = this.value;
    var projectSelect = document.getElementById('project_id');
    projectSelect.innerHTML = '<option value="">Select Project</option>'; // Reset options

    if (clientId) {
        // Fetch projects for the selected client
        fetch(`get_projects.php?client_id=${clientId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(function(project) {
                    var option = document.createElement('option');
                    option.value = project.project_id;
                    option.textContent = project.project_name;
                    projectSelect.appendChild(option);
                });
            });
    }
});

let isSubmitting = false; // Flag to track form submission

// Prevent multiple submissions
document.querySelector('form').addEventListener('submit', function(event) {
    var submitButton = document.getElementById('submitButton');
    
    // Check if form is already being submitted
    if (isSubmitting) {
        event.preventDefault(); // Prevent the form from submitting again
        return;
    }
    
    // Set the flag and disable the button
    isSubmitting = true;
    submitButton.disabled = true; // Disable the button
    submitButton.innerText = 'Processing...'; // Optional: Change button text to indicate processing
});
</script>

<?php include '../src/includes/footer.php'; ?>
