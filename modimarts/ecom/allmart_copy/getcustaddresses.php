<?php
session_start();
include('config.php');
//echo "select * from user_address where user_id='".$_SESSION['gid']."'";
$getdts=mysql_query("select * from user_address where user_id='".$_SESSION['gid']."'");

?>
<div id="content" class="col-sm-9"> 
<h2>Address Book Entries</h2>
            <div class="table-responsive">
        <table class="table table-bordered table-hover">
                    <tbody>
                        
                        
                        <?php 
                        
                        while($rws=mysql_fetch_array($getdts))
                        {
                            
                            $sqlm=mysql_query("select * from states where state_code='".$rws["state"]."'");
$rowm=mysql_fetch_array($sqlm);

$sqlm1=mysql_query("select * from cities where code='".$rws["city"]."'");
$rowm1=mysql_fetch_array($sqlm1);
                        ?>
                        <tr>
            <td class="text-left"><?php echo $rws["address"];?><br><?php echo $rowm["state_name"];?><br><?php echo $rowm1["name"];?><br><?php echo $rws["pin"];?></td>
            <td class="text-right"><a href="javascript:void(0);" onclick="editfn('<?php echo $rws[0];?>')" class="btn btn-info">Edit</a> &nbsp;<a  href="javascript:void(0);" onclick="delfn('<?php echo $rws[0];?>')"  class="btn btn-danger">Delete</a></td>
          </tr>
          <?php } ?>
                  </tbody></table>
      </div>
            <div class="buttons clearfix">
        
        <div class="pull-right"><a href="javascript:void(0);" onclick="editfn('')" class="btn btn-primary">New Address</a></div>
      </div>
      </div>

