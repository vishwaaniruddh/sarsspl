<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
?>
<html>
<head>
<title>Bulk Dispatch Material Upload</title>
<?php include ('header.php');
include ('config.php');

?>

<style>
      table, td {
                 border: 1px solid black;
                
                }
#border {
    border: 2px solid red;
    border-radius: 12px;
}
</style>
 

<script>

function validation()
{

  
     if(userfile=="")
     {
     swal("You Forgot to select an *.xls File to Import");
     return false;
     }
     else{
 
     
     return true;
          }
          
}

 
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
    
       
                                        
                                      <? 
                                      
                                      var_dump($_SESSION);
                                      
 if(isset($_POST['submit'])){
   // $userid = $_SESSION['userid']; 

    $date = date('Y-m-d h:i:s a', time());
    $only_date = date('Y-m-d');
    $target_dir = 'PHPExcel/';
    $file_name=$_FILES["images"]["name"];
    $file_tmp=$_FILES["images"]["tmp_name"];
    $file =  $target_dir.'/'.$file_name;

    $availability ='available';                      
    $userid = $_SESSION['userid'];
    $created_at = date('Y-m-d H:i:s');
    $date = date('Y-m-d');

    move_uploaded_file($file_tmp=$_FILES["images"]["tmp_name"],$target_dir.'/'.$file_name);
    include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
    $inputFileName = $file;

  try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
  } catch (Exception $e) {
    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . 
        $e->getMessage());
  }

  $sheet = $objPHPExcel->getSheet(0);
  $highestRow = $sheet->getHighestRow();
  $highestColumn = $sheet->getHighestColumn();

  for ($row = 1; $row <= $highestRow; $row++) { 
    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
                                    null, true, false);
                                
  }

$row = $row-2;
$error = '0';
$contents='';
 // echo '<pre>';print_r($rowData);echo '</pre>';die;
    for($i = 1; $i<=$row; $i++){
        
      $ticketid = $rowData[$i][0][1];
      $atmid = $rowData[$i][0][2]; 
      $mis_id = $rowData[$i][0][12];
      $dispatch_date = $rowData[$i][0][13];
      $remark = $rowData[$i][0][14]; 
      $serial_number = $rowData[$i][0][15];
      $pod = $rowData[$i][0][16]; 
      $courier_name = $rowData[$i][0][17];
     // echo $ticketid."--".$atmid."--".$misid."</br>";
        if($mis_id){
            $sql = mysqli_query($css,"select * from mis_details where ticket_id = '".$ticketid."' and id = '".$mis_id."' ");
            if($sql_result = mysqli_fetch_assoc($sql)){
                    $misid = $sql_result['mis_id'];
                    $mis_details_status = $sql_result['status'];
                    if($mis_details_status=='material_in_process'){
                        if($mis_id){
                            
                            $material_update = "insert into material_update(mis_id,availibility,dispatch_date,remark,created_at,created_by,serial_number,pod,courier) 
                            values('".$mis_id."','".$availability."','".$dispatch_date."','".$remark."','".$created_at."','".$userid."','".$serial_number."','".$pod."','".$courier_name."')";
                            
                            $update_mis = "insert into mis_history(mis_id,type,remark,dispatch_date,created_at,serial_number,is_material_dept,pod,courier_agency) 
                            values('".$mis_id."','material_dispatch','".$remark."','".$dispatch_date."','".$date."','".$serial_number."',1,'".$pod."','".$courier_name."')";  
                            
                            if(mysqli_query($css,$material_update) && mysqli_query($css,$update_mis)){
                                $material_inventory = "update material_inventory set status=4 where mis_id='".$mis_id."'";
                                $mis_sql = "update mis_details set status='material_dispatch' where id='".$mis_id."'";
                                if(mysqli_query($css,$material_inventory) && mysqli_query($css,$mis_sql)){
                                    echo 'record dispatched for Ticket ID :' . $ticketid ; 
                                    echo '<br>';
                                }else{
                                    echo 'Check material_inventory and mis_details why record not dispatched in mis_details table for TICKET ID :' . $ticketid . 'and MIS ID :'.$mis_id; 
                                    echo '<br>';
                                }
                            }else{
                                echo 'Check material_update and mis_history why record not dispatched in mis_details table for TICKET ID :' . $ticketid . 'and MIS ID :'.$mis_id; 
                                    echo '<br>';
                            }
                            
                        }
                    }else{
                        echo 'Check status why record not dispatched in mis_details table for TICKET ID :' . $ticketid . 'and MIS ID :'.$mis_id; 
                                    echo '<br>';
                    }
            }
        } 
     }


                                    
                                }
                                ?>
                                
                                
   
<?php include 'menu.php';?>
<h2 align="center">Bulk Dispatch Material Upload</h2>

<div class="container" style="margin-left:0px;">
<form id="myname" method="post" action="<? echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" name="form">
    <!--<form action="process_qrtsite_excel.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">-->

   
    </table>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<table style="width:40%" align="center";>
<tr>
    <td width="432" height="35"><b>Upload Excel:  <a href="Excel/Material_Dispatch_Format.xlsx" download>Download format </a></b></td>  
</tr>
<tr>
<td width="432" height="35"><b>Select *.xlsx File to Import :</b>
<input type="file" name="images"  id="userfile" required /></td>
</tr>
<tr>

</tr>



<tr>
<td height="35" colspan="2"><input type="submit" name="submit" value="upload" class="readbutton" /></td>
</tr>
</table>


<?php
}else
{ 
 header("location: login.php");
}
?>
