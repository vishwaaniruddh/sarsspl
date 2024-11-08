<?php
session_start();
	//var_dump($_SESSION['designation']);
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == ''))   
	{
		header("location: access-denied.php");
		exit();
	}*/
?>
<?php 
//	ini_set( "display_errors", 0);  

include('config.php');
include('access.php');
include('header.php'); 

if(isset($_GET['id']) && $_GET['id']>0){
    $id=$_GET['id'];
    echo $id;
    $qry =mysql_query("SELECT s.id as sid,s.period,s.type,sd.rate,sd.discount FROM subscriptions s join subscription_details sd on s.id=sd.subscription_id where sd.status!=2 and sd.id = ".$id);
    $result = mysql_fetch_assoc($qry);
    var_dump($result);
    $num_rows = mysql_num_rows($qry);
    $sid=$result['sid'];
    $type=$result['type'];
    $period=$result['period'];
    $rate=$result['rate'];
    $discount=$result['discount'];
    $status=$result['status'];
} else {
    $id = 0;
    $sid=0;
    $type='';
    $period='';
    $rate='';
    $discount='';
    $status=1;
}
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
    <div class="container">
       <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   <form name="myForm" action="add_subscription_process.php"  method="post" class="well form-horizontal" >
                      <fieldset>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Subscription Type</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <input type="hidden" name="id" value="<?php echo $id;?>">
                                  <input type="hidden" name="sid" value="<?php echo $sid;?>">
                                  <select class="selectpicker form-control" name="type" <?php if(isset($_GET['id']) && $_GET['id']>0){ echo 'disabled'; }?>>
                                     <option value="0" >Choose Type</option>
                                     <option value="Days" <?php if($type == 'Days'){echo 'selected';}?> >Days</option>
                                     <option value="Week" <?php if($type == 'Week'){echo 'selected';}?> >Week</option>
                                     <option value="Months" <?php if($type == 'Months'){echo 'selected';}?> >Months</option>
                                     <option value="Year" <?php if($type == 'Year'){echo 'selected';}?> >Year</option>
                                  </select>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Period</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                    <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                    <input type="text" id="period" name="period" placeholder="period" class="form-control" required="true" value="<?php echo $period; ?>" <?php if(isset($_GET['id']) && $_GET['id']>0){echo 'readonly';} ?> >
                               </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Rate</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input type="text" id="rate" name="rate" placeholder="rate" class="form-control" required="true" value="<?php echo $rate;?>" >
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Discount</label>
                            <div class="col-md-8 inputGroupContainer"> 
                               <div class="input-group">
                                    <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                    <input type="text" id="discount" name="discount" placeholder="discount" class="form-control" required="true" value="<?php echo $discount; ?>"  >
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Subscription Grace Type</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" name="gtype" >
                                     <option value="0" >Choose Type</option>
                                     <option value="Days" <?php if($gtype == 'Days'){echo 'selected';}?> >Days</option>
                                     <option value="Week" <?php if($gtype == 'Week'){echo 'selected';}?> >Week</option>
                                     <option value="Months" <?php if($gtype == 'Months'){echo 'selected';}?> >Months</option>
                                     <option value="Year" <?php if($gtype == 'Year'){echo 'selected';}?> >Year</option>
                                  </select>
                               </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Grace Period</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                    <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                    <input type="text" id="gperiod" name="gperiod" placeholder="grace period" class="form-control" required="true" value="<?php echo $gperiod; ?>" >
                               </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" name="status">
                                     <option value="1" <?php if($status=='1'){echo "selected";}?>>Active</option>
                                     <option value="0" <?php if($status=='0'){echo "selected";}?>>InActive</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-6 control-label">  </label>
                            <div class="col-md-4 inputGroupContainer">
                               <input type="Submit" value="Save"  class="btn-success" >
                               <a href="view_subscriptions.php"><input type="button" value="cancel"  class="btn-warning" ></a>
                            </div>
                         </div>
                      </fieldset>
                   </form>
                </td>
             </tr>
          </tbody>
       </table>
    </div>
</body>
</html>