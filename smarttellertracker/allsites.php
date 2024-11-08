<?php include('./header.php'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div class="row">
    <div class="col-sm-12 grid-margin">










    <style>
    th, td{
        white-space:nowrap;
    }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>

<h2>Sites Master</h2>

<form method="GET" action="">
    <div class="row">
         <div class="col-sm-2">
                 <label for="site_id">Site ID:</label>
    <input type="text" name="site_id" id="site_id" value="<?= isset($_GET['site_id']) ? $_GET['site_id'] : '' ?>" class="form-control">

         </div>
         <div class="col-sm-2">
    
    <label for="client">Client:</label>
    <input type="text" name="client" id="client" value="<?= isset($_GET['client']) ? $_GET['client'] : '' ?>" class="form-control">
             
         </div>
         <div class="col-sm-2">
    <label for="state">State:</label>
    <input type="text" name="state" id="state" value="<?= isset($_GET['state']) ? $_GET['state'] : '' ?>" class="form-control">
             
         </div>
         <div class="col-sm-2">
    <label for="city">City:</label>
    <input type="text" name="city" id="city" value="<?= isset($_GET['city']) ? $_GET['city'] : '' ?>" class="form-control">
             
         </div>
         <div class="col-sm-2">
    <label for="zone">Zone:</label>
    <input type="text" name="zone" id="zone" value="<?= isset($_GET['zone']) ? $_GET['zone'] : '' ?>" class="form-control">
             
         </div>
         <div class="col-sm-2">
    <label for="status">Status:</label>
    <select name="status" id="status" class="form-control">
        <option value="">Select</option>
        <?php 
        $statussql = mysqli_query($con,"select distinct(status) as status from sitesmaster");
        while($statussql_result = mysqli_fetch_assoc($statussql)){
            $status = $statussql_result['status'];
            ?>
            <option value="<?php echo $status ; ?>" <?php if($_REQUEST['status']==$status ){ { echo 'selected'; } } ?> ><?php echo $status ; ?></option>   
            <?php 
        }
        ?>
    </select>             
         </div>
    </div>
    
    
    
    
    

    
    <button type="submit">Filter</button>
</form>

     
<?php


// Define how many results you want per page
$results_per_page = 10;

// Find out the number of results stored in the database
$sql = "SELECT COUNT(*) as total FROM `sitesmaster` WHERE 1=1";

// Adding filters to the query
if (!empty($_GET['site_id'])) {
    $sql .= " AND `site_id` LIKE '%" . $con->real_escape_string($_GET['site_id']) . "%'";
}
if (!empty($_GET['client'])) {
    $sql .= " AND `client` LIKE '%" . $con->real_escape_string($_GET['client']) . "%'";
}
if (!empty($_GET['state'])) {
    $sql .= " AND `state` LIKE '%" . $con->real_escape_string($_GET['state']) . "%'";
}
if (!empty($_GET['city'])) {
    $sql .= " AND `city` LIKE '%" . $con->real_escape_string($_GET['city']) . "%'";
}
if (!empty($_GET['zone'])) {
    $sql .= " AND `zone` LIKE '%" . $con->real_escape_string($_GET['zone']) . "%'";
}
if (!empty($_GET['status'])) {
    $sql .= " AND `status` LIKE '%" . $con->real_escape_string($_GET['status']) . "%'";
}

// echo $sql ; 

$result = $con->query($sql);
$row = $result->fetch_assoc();
$total_results = $row['total'];

// Determine number of total pages available
$total_pages = ceil($total_results / $results_per_page);

// Determine which page number visitor is currently on
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page > $total_pages) {
    $page = $total_pages;
}
if ($page < 1) {
    $page = 1;
}

// Determine the SQL LIMIT starting number for the results on the displaying page
$start_limit = ($page - 1) * $results_per_page;

// Retrieve the data
$sql = "SELECT * FROM `sitesmaster` WHERE 1=1";

// Adding filters to the query again
if (!empty($_GET['site_id'])) {
    $sql .= " AND `site_id` LIKE '%" . $con->real_escape_string($_GET['site_id']) . "%'";
}
if (!empty($_GET['client'])) {
    $sql .= " AND `client` LIKE '%" . $con->real_escape_string($_GET['client']) . "%'";
}
if (!empty($_GET['state'])) {
    $sql .= " AND `state` LIKE '%" . $con->real_escape_string($_GET['state']) . "%'";
}
if (!empty($_GET['city'])) {
    $sql .= " AND `city` LIKE '%" . $con->real_escape_string($_GET['city']) . "%'";
}
if (!empty($_GET['zone'])) {
    $sql .= " AND `zone` LIKE '%" . $con->real_escape_string($_GET['zone']) . "%'";
}
if (!empty($_GET['status'])) {
    $sql .= " AND `status` LIKE '%" . $con->real_escape_string($_GET['status']) . "%'";
}

$sql .= " LIMIT $start_limit, $results_per_page";

$result = $con->query($sql);

$serial_number = $start_limit + 1;
 
 
 ?>
 
 
 
<div class="card">
    <div class="card-body" style="overflow:auto;">

<h2>Total Records : <?php echo $total_results ; ?></h2>
<hr/>
<table class="table">
    <thead>
        <tr class="table-primary">
            <th>SrNo</th>
            <th>Reference ID</th>
            <th>Client</th>
            <th>Status</th>
            <th>Site Name</th>
            <th>Branch Code</th>
            <th>Address</th>
            <th>Branch Two Way Number</th>
            <th>State</th>
            <th>Zone</th>
            <th>City</th>
            <th>ATM Two Way Number</th>
            <th>Contact Person</th>
            <th>Contact No</th>
            <th>DVR Model</th>
            <th>DVR UserName</th>
            <th>DVR Password</th>
            <th>DVR Port</th>
            <th>DVR IP</th>
            <th>Panel ID</th>
            <th>Email</th>
            <th>Pincode</th>
            <th>Panel Type</th>
            <th>Panel Port</th>
            <th>Panel Model</th>
            <th>Site ID</th>
            <th>CRA Company</th>
            <th>HK Company</th>
            <th>ATM 1 ID</th>
            <th>ATM 2 ID</th>
            <th>Router Name</th>
            <th>Router Serial Number</th>
            <th>DVR Serial Number</th>
            <th>Router Connection Number</th>
            <th>Router SIM Num</th>
            <th>Router SIM ICCID Number</th>
            <th>Customer Live Date</th>
            <th>Remark</th>
            <th>Site ID2</th>
            <th>Account Number</th>
        </tr>
    </thead>
    <tbody>
        
   <?php 
   
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        
        // Display serial number
        echo "<td>" . $serial_number . "</td>";
        
        // Increment the serial number for the next row
        $serial_number++;

        // Display other columns
        foreach ($row as $column) {
            

                echo "<td>" . htmlspecialchars($column) . "</td>";

        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='39'>No results found</td></tr>";
}
?>




        <!-- Data rows will go here -->
    </tbody>
</table>


<hr>


<?php
// Define the range of pages to display
$pages_to_show = 5;
$half_range = floor($pages_to_show / 2);

// Determine the start and end pages for the pagination
$start_page = max(1, $page - $half_range);
$end_page = min($total_pages, $page + $half_range);

// Adjust start_page and end_page if near the beginning or end of the page range
if ($page <= $half_range) {
    $end_page = min($total_pages, $pages_to_show);
}

if ($page > $total_pages - $half_range) {
    $start_page = max(1, $total_pages - $pages_to_show + 1);
}

// Display "First" button
if ($page > 1) {
    echo "<a href='?page=1&site_id=" . $_GET['site_id'] . "&client=" . $_GET['client'] . "&state=" . $_GET['state'] . "&city=" . $_GET['city'] . "&zone=" . $_GET['zone'] . "&status=" . $_GET['status'] . "'>First</a> ";
}

// Display "Previous" button
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "&site_id=" . $_GET['site_id'] . "&client=" . $_GET['client'] . "&state=" . $_GET['state'] . "&city=" . $_GET['city'] . "&zone=" . $_GET['zone'] . "&status=" . $_GET['status'] . "'>Previous</a> ";
}

// Display page numbers
for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $page) {
        echo "<strong>" . $i . "</strong> ";
    } else {
        echo "<a href='?page=" . $i . "&site_id=" . $_GET['site_id'] . "&client=" . $_GET['client'] . "&state=" . $_GET['state'] . "&city=" . $_GET['city'] . "&zone=" . $_GET['zone'] . "&status=" . $_GET['status'] . "'>" . $i . "</a> ";
    }
}

if ($page < $total_pages) {
    echo "<a href='?page=" . ($page + 1) . "&site_id=" . $_GET['site_id'] . "&client=" . $_GET['client'] . "&state=" . $_GET['state'] . "&city=" . $_GET['city'] . "&zone=" . $_GET['zone'] . "&status=" . $_GET['status'] . "'>Next</a> ";
}

if ($page < $total_pages) {
    echo "<a href='?page=" . $total_pages . "&site_id=" . $_GET['site_id'] . "&client=" . $_GET['client'] . "&state=" . $_GET['state'] . "&city=" . $_GET['city'] . "&zone=" . $_GET['zone'] . "&status=" . $_GET['status'] . "'>Last</a> ";
}
?>

    </div>
</div>





<?php
$con->close();
?>

    </div>
</div>


<?php include('./footer.php'); ?>