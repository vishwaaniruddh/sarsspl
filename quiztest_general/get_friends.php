<?php
if (!isset($_SESSION)) session_start();
include("config.php");
$id= $_SESSION['userid'];


$qr=mysqli_query($con,"select * from quiz_friends where user_id='".$id."'");
while($rws=mysqli_fetch_array($qr))
{
    
    $gts=mysqli_query($con,"select * from quiz_regdetails where id='".$rws["friend_id"]."'");
    $rwsc2n=mysqli_fetch_array($gts);
    
     $nm=$rwsc2n["name"]." ".$rwsc2n["lname"];
 
 if($rwsc2n["img_path"]!="")
 {
    
   $imgs=$rwsc2n["img_path"]; 
 }
 
?>
    <table>
    <tr>
        <td>
            <img src="<?php echo $imgs;?>" style="width:100px;height:100px;"><?php echo $nm;?>
            
        </td>
         <td>
            <button type="button" onclick="sendreqfunc(<?php echo $rws["friend_id"]; ?>);">Send Request</button>
            
        </td>
    </tr>
    </table>
    
    
<?php
}
?>
<button type="button" id="othbtn"  class="btn btn-primary  btn-lg" onclick="shwdivfunc();">Back</button>