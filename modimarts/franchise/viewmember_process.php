<?php session_start(); //Start the session
include ("config.php");

$strPage = $_POST['Page'];

$strdt=$_POST['strdt'];
//echo $strdt;

$endt=$_POST['endt'];

$fname=$_POST['fname'];
$email=$_POST['email'];
$Mobile=$_POST['Mobile'];
$calltype=$_POST['calltype'];
$Pincode=$_POST['Pincode'];
   // $View="select * from member where Waiting IN ('Y','N')  ";
        $View="select * from member where 1";
    // echo $View;
       if($_POST['strdt']!="" & $_POST['endt']!="")
	{
	$dt1=str_replace("/","-",$_POST['strdt']);
	$start=date('Y-m-d', strtotime($dt1));
	$dt2=str_replace("/","-",$_POST['endt']);
	$end=date('Y-m-d', strtotime($dt2));

	$View.=" and entrydt between '".$start."' and '".$end."'";
// 	echo $View;
}
         if($_POST['typeoftest']!="")
         {
             	$View.=" and testtype='".$_POST['typeoftest']."'";
         }

//echo $View;
if($fname!=""){
  $View.=" and name LIKE '%".$fname."%'";  
  
}
if($email!=""){
  $View.=" and email LIKE '%".$email."%'";  
}
if($Mobile!=""){
  $View.=" and mobile LIKE '%".$Mobile."%'";  
}

if($calltype!="" && $calltype=="3"){
    $View.=" and status='0' and Waiting='N'  ";  
}else{

if($calltype!=""){
  $View.=" and status='".$calltype."'  and Waiting='Y' ";  
}
}




if($Pincode!=""){
  $View.=" and pincode LIKE '%".$Pincode."%'";  
}
// echo $View;
$table=mysqli_query($conn,$View);

$Num_Rows = mysqli_num_rows ($table);

//echo $Num_Rows;
?>
<div align="center">
 Records Per Page :<select name="perpg" id="perpg" onChange="func('1','perpg');"><br>
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
<?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
$Page = $strPage;
if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
//echo $Page_Start;
$srn=$Page_Start+1;
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$View.=" ORDER BY id  DESC ";
//$View.=" Name LIKE '%".$Name."%' ";
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($conn,$View);
//	echo $qry;	
//echo $View;
	?>
	<div class="container">
	<form  method="post" action="delegation.php">
	<!--<div class="table-responsive">-->
	<div class="table">
	<table align="center" class="table table-bordered table-striped">
			<tr>
			    <th class="th-prop">Sr No</th>
				<th class="th-prop">Level</th>
				<th class="th-prop">Location</th>
				<th class="th-prop">position</th>
				<th class="th-prop">name</th>
				<th class="th-prop">address</th>
				<th class="th-prop">email</th>
				<th class="th-prop">mobile</th>
				<th class="th-prop">pincode</th>
			
				<th class="th-prop">entrydt</th>
				<th class="th-prop">Profile</th>
					<?php if(isset($_POST['calltype']) && $_POST['calltype']== 3 ){ ?>
				<th class="th-prop">Waiting Approval</th>
				<?php } ?>
				<?php if(isset($_POST['calltype']) && $_POST['calltype']==0  ){	?>
                    <th class="th-prop">Approve</th>
                <?php } ?>
                <?php if(isset($_POST['calltype']) && $_POST['calltype']==0 || $_POST['calltype']==1 || $_POST['calltype']==3 ){ ?>
        		    <th class="th-prop">Disapprove</th>
        		<?php } ?>
        		<?php if(isset($_POST['calltype']) && $_POST['calltype']== 2 ){ ?>
        		    <th class="th-prop">Put in waitlist</th>
        		<?php } ?>
			</tr>
			<?php
			    while($_row=mysqli_fetch_array($qrys))
			    {
                $sql2="select dasignation_name from committee_structure where id='".$_row['position_id']."'";
                $runsql2=mysqli_query($conn,$sql2);
                $sql2fetch=mysqli_fetch_array($runsql2);
                /*
                $sql3="select Name from Lead_Sources where SourceId='".$_row['LeadSource']."'";
                $runsql3=mysqli_query($conn,$sql3);
                $sql2fetch3=mysqli_fetch_array($runsql3);*/
                $table="";
                if($_row['level_id']==1){
                $table="country";
                }else if($_row['level_id']==2){
                $table="zone";
                }else if($_row['level_id']==3){
                $table="state";
                }else if($_row['level_id']==4){
                $table="city";
                }else if($_row['level_id']==5){
                $table="district";
                }else if($_row['level_id']==6){
                $table="taluka";
                }else if($_row['level_id']==7){
                $table="pincode";
                }else if($_row['level_id']==8){
                $table="village";
                }
                $qryLevel="select $table from $table where  id='".$_row['loc_id']."' ";
                //	echo $qryLevel;
                $run=mysqli_query($conn,$qryLevel);
                if($run){
                $fetchloc=mysqli_fetch_array($run);
                }
                ?>
                <tr>
                <td class="th-prop"><?php echo $srn; ?></td>
                <td class="th-prop"><?php echo $table; ?></td>
                <td class="th-prop"><?php echo $fetchloc[$table]; ?></td>
                <td class="th-prop"><?php echo $sql2fetch[0]; ?></td>
                <td class="th-prop"><?php echo ucwords($_row['name']) ; ?></td>
                <td class="th-prop"><?php echo $_row['address']; ?></td>
                <td class="th-prop"><?php echo $_row['email']; ?></td>
                
                <td class="th-prop"><?php echo $_row['mobile']; ?></td>
                <td class="th-prop"><?php echo $_row['pincode']; ?></td>
                
                <td class="th-prop"><?php echo $_row['entrydt']; ?></td>
                <td class="th-prop">
                <?php if($_row['file']!=''){?>
                <img src="<?php echo $_row['file'];?>" height="40px" width="40px">
                <?php } else { ?>
                <img src="image/noimageavailable.png" width="60px" style="height:80px" />
                <?php } ?>
                </td>
               <?php  if($_row['Waiting']=='N'){?>  <td><input type="button" id="canc<?php echo $srn;?>" onclick="waitlist('<?php echo $_row[0];?>');" class="btn btn-warning btn-text" value="Waiting Approve"> </td><?php } ?>
              
           
        
          
                 <?php if( $_row['status']==0  && $calltype!="3"){?> <td>
                 
              <?php   $qcount=mysqli_query($conn,"select * from member where level_id='".$_row['level_id']."' and  loc_id='".$_row['loc_id']."' and position_id ='".$_row['position_id']."' and Waiting='Y' and status='1' ");
                        
                 if(mysqli_num_rows($qcount)<1){ ?>
                 <input type="button" id="canc<?php echo $srn;?>" onclick="cnctestfn('<?php echo $_row[0];?>');" class="btn btn-success btn-text" value="Approve<?php// echo $_row[0];?>"> 
                 
                 <?php } ?>
                 </td>
                 <?php } ?>
         
             
             
                <?php if($_row['status']==0 || $_row['status']==1){ ?><td><input type="button" id="canc1<?php echo $srn;?>" onclick="cnctestfn1('<?php echo $_row[0];?>');" class="btn btn-danger btn-text"  value="DisApprove"> </td><?php } ?>
               
             
                <?php if($_row['status']==2){?><td><input type="button" id="wait<?php echo $srn;?>" onclick="wait('<?php echo $_row[0];?>','wait');" class="btn btn-warning btn-text"  value="Put in Waiting List"> </td><?php } ?>
                
           
                <!--<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['id'];?>','_self');" value="Disapprove">  </td>-->
                
                
                <!--<td><?php if($_row['Status']!='0'){echo "delegated";}?></td>-->
                
                
                <!--<td><input type="button" onclick="window.open('editlead.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Edit Lead">  </td>-->
                <!--<td><input type="button" id="qtnview<?php echo $srn;?>" onclick="window.open('leadupdate.php?id=<?php echo $_row['Lead_id'];?>','_self');" value="Lead Update">  </td>
                --><!--<?php if($_row['Status']=='0'){?>
                <td><input type="checkbox" name="check[]" value="<?php echo $_row['Lead_id'];?>"></td>
                <?php }else{?>
                <td> </td>
                <?php }?>
                -->
				</tr>
			<?php 
			   $srn++;
			}			
			?>
	
		</table>
		</div>
	<!--<div align="center"><button id="myButtonControlID" onClick="expfunc();">Delegate</button></div>-->
	<a href="member1.php"><input type="button" class="btn btn-info btn-text"  value="Back"></a>
	</form>
	
<div class="pagination" style="width:100%; margin:0;" align="center"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:func('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:func('$Next_Page','perpg')\">Next >></a> ";
}
?>
	</font>
	</div>

</div>

	