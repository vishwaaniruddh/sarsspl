<?php
// Load the database configuration file
include('config.php');

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
//exit;

// Redirect to the listing page
header("Location: bill.php".$qstring);
?>