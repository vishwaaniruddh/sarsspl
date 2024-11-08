<?php
session_start();
// Load the database configuration file
include('config.php');
	
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
}*/
?>
<?php 

include('config.php');
include('access.php');
include('header.php'); 


if(isset($_POST['import'])){
    $tmpName = $_FILES['csv']['tmp_name'];
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            // Parse data from CSV file line by line
            $ln = 0;
            $err = array();
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $mid   = $line[0];
                $name  = $line[1];
                $email  = $line[2];
                $phone = $line[3];
                $status = $line[4];
                //$pid = $line[5];
                
                // Check whether data exists in the database
                $prevQuery = "SELECT rate FROM order_details WHERE mrc_id = '".$line[0]."' and total_amt= '".$line[5]."' and item_id= '".$line[8]."'";
                //echo $prevQuery;
                $prevResult = mysql_query($prevQuery);
                $n = mysql_num_rows($prevResult);
                //echo 'c:'.$n;
                
                if($n> 0){
                    
                } else {
                    $err[]=$ln;
                }
                $ln++;
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
        //echo 'invalid';
    }
}

?>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
        <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    </head>
    <body>
        
        <?php
        foreach($err as $e){
            echo '<p>Error at line :'.$e.'</p>';
        }
        if(count($err)>=0){ ?>
            <a href="pay.php?mid=<?php echo $_GET['mid'];?>">
                <input type="submit"  name="pay" value ="Pay" class="btn-submit btn-success">
            </a>
            
       <?php } ?>
    </body>
</html>
