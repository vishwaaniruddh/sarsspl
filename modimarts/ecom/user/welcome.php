<?php session_start();
// var_dump($_SESSION);
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{   
    $id=$_SESSION['id'];
    include "config.php"; 
    $sql = mysqli_query($con1,"SELECT * FROM `clients` WHERE code ='$id'");
    $row = mysqli_fetch_array($sql);
?>
    <?php
        include('header.php');
    ?>        
    <!-- Title & Sitemap -->
    <div class="title-sitemap grid-12">
      <h1 class="grid-6"><i>&#xf132;</i>
        <span>Welcome to User Panel</span>
      </h1>
    </div>
    <!--</header>--> 
    <!-- Data -->
    <!--Ruchi-->
    <?php 
        $num_rows = 0;
        $qry =mysqli_query($con1,"SELECT * FROM merchant_offers where status=1 and city=".$row['city']);
        $num_rows = mysqli_num_rows($qry); 
    ?>
    <!--<div class="container">-->
        <!-- Trigger the modal with a button -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog"> 
              <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">My Offers</h4>
                    </div>
                    <div class="modal-body">
                        <?php 
                        $cnt = 1;
                        while($rows=mysqli_fetch_assoc($qry)) { ?>
                            <div>
                                <?php if($rows['file_type']=='image') { ?>
                                    <img src="http://sarmicrosystems.in/oc1/adminpanel/<?php echo $rows['content_file'];?>" width="90%">
                                <?php } else if($rows['file_type']=='video') { ?>
                                        <video source src="http://sarmicrosystems.in/oc1/adminpanel/<?php echo $rows['content_file'];?>" type="video/mp4" autoplay controls></video>
                                <?php } else if($rows['file_type']=='pdf' || $rows['file_type']=='text') { ?>
                                <?php } else  { ?>
                                <?php }  ?>
                            </div>
                            <div class="margin-prop">
                                <a href="payumoney/pay.php?id=<?php echo $rows['id'];?>&mid=<?php echo $rows['code'];?>&tr=ofr" class="btn btn-success" >Activate Offers</a>
                            </div>
                        <?php $cnt++;} ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!--</div>-->
    <script type="text/javascript">
    $(document).ready(function() {
         <?php 
        if($num_rows>0) { ?>
            var s = <?php echo $num_rows; ?>
        
        <?php } else { ?>
            var s = 0 ;
        <?php } ?>
        /*alert(s)*/
        if(s>0){
            $('#myModal').modal('show');
        }
    });
    </script>
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Profile details</strong></h3>
            </header>
            <div class="widget-body">
                <div>
                    <table class="tables" align="center" cellpadding="4" cellspacing="0">
                        <tbody>
                            <tr>
                                <td  align="center" >You are successfully registered as a Merabazar user</td>
                            </tr> 
                            <tr>
                                <td align="left">
                                    <p align="center">
                                        <span >Your personal details  given during  registration process are as under...</span><br />
                                        <span class="style257">(in case of modification required you need to do the same from the view profile section). </span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="tables" width="679" height="376" align="center">
                                        <tbody>
                                            <tr>
                                                <td >&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td >Registration Date : </td>
                                                <td ><?php $dt= $row['rdate'];
                                                    echo   date('d/m/Y',strtotime($dt));?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Company Name : </td>
                                                <td ><?php echo $row['name']; ?>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td > Address : </td>
                                                <td ><?php echo $row['address']; ?></td>
                                            </tr>
                                            <tr>
                                                <td > City : </td>
                                                <td>
                                                    <?php 
                                                    $selctcity=mysqli_query($con1,"select name from cities where code='".$row['city']."'");
                                                    //echo "select state_name from cities where code='".$row['city']."'";
                                                    $selctcityf=mysqli_fetch_row($selctcity);
                                                    echo $selctcityf[0]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >State : </td>
                                                <td ><?php 
                                                    $selctstate=mysqli_query($con1,"select state_name from states where state_code='".$row['state']."'");
                                                    $selctstatef=mysqli_fetch_row($selctstate);
                                                    echo $selctstatef[0]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Email : </td>
                                                <td ><?php echo $row['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Category :</td>
                                                <td ><?php echo $row['category']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Contact Name : </td>
                                                <td ><?php echo $row['contact']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Mobile : </td>
                                                <td ><?php echo $row['mobile']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Phone : </td>
                                                <td ><?php echo $row['phone']; ?></td>
                                            </tr>
                                            <?php /*$Q1="select amount from Subscription where mid='".$id."' and status='".Active."'";
                                            echo $Q1; 
                                            $ret1 = mysqli_query($con1,$Q1);
                                            $rows1 = mysqli_fetch_array($ret1);
                                            ?>
                                            <tr>
                                                <td >Amount Paid : </td>
                                                <td ><?php echo $rows1[0]; ?></td>
                                            </tr>
                                            <?php //} 
                                            */?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!--content-->
</div><!--Container-->

<script>
function subscription(){ 
    <?php 
    $Q="select tilldate from Subscription where mid='".$id."'";
    $ret = mysqli_query($con1,$Q);
    $rows = mysqli_fetch_array($ret);
    $sdate=date("Y-m-d"); 
    $mont=$rows[0];
    $date1=date_create("$sdate");
    $date2=date_create("$mont"); 
    $diff=date_diff($date1,$date2);
     $diffck= $diff->format("%R%a ");
    $txt="";
    if($diffck==+2){$txt = "Subscription expire after two days"; }
    if($diffck==+1){$txt = "Subscription expire after one days";}
    if($txt!=""){ ?>
        alert("<?php echo $txt ?>");
    <?php }?>
}
 $(document).ready(function() {
  subscription();
});
    </script>
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>