<?php session_start();
ini_set('memory_limit', '-1');
include('config.php');

$FromDat=$_POST['FromDt'];
$Todat=$_POST['ToDt'];
$FromDt=date('Y-m-d', strtotime($FromDat));
$Todt=date('Y-m-d', strtotime($Todat));
$FromDt1=date('d-m-Y', strtotime($FromDat));
$Todt1=date('d-m-Y', strtotime($Todat));

 $currDt=date('Y-m-d');
  $sourceQ= mysqli_query($conn,"select m.Primary_nameOnTheCard,m.ExpiryDate,l.MobileNumber,l.LeadSource,m.MembershipDetails_Level,l.Lead_id from Members m INNER JOIN Leads_table l on m.Static_LeadID=l.Lead_id where  m.ExpiryDate='2020-04-23' and l.Status='5'");

?>

                                <table id="example" class="table  " style="width:99%">
                                    <thead>
                                        
                                    <tr>
                                        <th>Member_name</th>
                                        <th>MobileNumber</th> 
                                        <th>Level</th> 
                                        <th>Lead Source</th>  
                                        <th>ExpiryDate</th>     
                                        <th>Delegate</th>    
                                    </tr>
                                     </thead>
                                    <tbody >
                                          <?php 
                                             
                                             while($sourceF= mysqli_fetch_array($sourceQ)){
                                                 
                                                    $runsql2=mysqli_query($conn,"SELECT Name FROM `Lead_Sources` where SourceId='".$sourceF['LeadSource']."' ");
                                                	$sql2fetch=mysqli_fetch_array($runsql2);
                                                 
                                                	$runsql3=mysqli_query($conn,"SELECT level_name FROM `Level` where Leval_id='".$sourceF['MembershipDetails_Level']."' ");
                                                	$sql3fetch=mysqli_fetch_array($runsql3);
                                        ?>
                                      <tr> <td><?php echo $sourceF['Primary_nameOnTheCard']; ?></td>
                                   <td><?php echo $sourceF['MobileNumber']; ?></td>
                                   <td><?php echo $sql3fetch['level_name']; ?></td>
                                   <td><?php echo $sql2fetch['Name']; ?></td>
                                      <td><?php echo $sourceF['ExpiryDate']; ?></td>
              
              <?php  
              $QRenwal=mysqli_query($conn,"select SalesmanId from Lead_Renewal_Delegation where  LeadId ='".$sourceF[5]."' ");
               $n=mysqli_num_rows($QRenwal);
               if($n>0){
                 $FRenwal= mysqli_fetch_array($QRenwal);
              
               $QRenwal2=mysqli_query($conn,"select FirstName from SalesAssociate where  SalesmanId ='".$FRenwal[0]."' ");
               $FRenwal2= mysqli_fetch_array($QRenwal2);
               }
              ?>
              
     
     <?php  if($_SESSION['usertype']=='Admin'){  if($n<='0'){?> <td><input type="checkbox" name="check[]" value="<?php echo $sourceF[5];?>"></td>
    <?php }else{?><td><?php echo $FRenwal2[0];?> </td> <?php }}?>
     
     
                                      </tr>
                                         <?php  } ?>
	




                                    </tbody>
                                    
                                   
                                    
                                    
                                  
                                    
                                </table>
                                 
             <?php  if($_SESSION['usertype']=='Admin'){ ?>	<div align="center" > <button id="myButtonControlID" class="btn btn-primary" onClick="delfunc();">Delegate</button></div><?php } ?>
