<?php
class Ticket {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($project_id, $title, $description, $created_by) {
        $query = "INSERT INTO tickets (project_id, title, description, created_by) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issi", $project_id, $title, $description, $created_by);
        return $stmt->execute();
    }

    public function getAll() {
        $query = "SELECT * FROM tickets";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
