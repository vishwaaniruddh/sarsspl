<?php
include '../src/config/db.php';

$client_id = $_GET['client_id'];
$query = $conn->prepare("SELECT project_id, project_name FROM projects WHERE client_id = ?");
$query->bind_param("i", $client_id);
$query->execute();
$result = $query->get_result();

$projects = [];
while ($row = $result->fetch_assoc()) {
    $projects[] = $row;
}

header('Content-Type: application/json');
echo json_encode($projects);
