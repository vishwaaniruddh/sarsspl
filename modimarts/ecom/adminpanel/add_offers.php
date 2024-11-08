<?php
session_start();
	/*var_dump($_SESSION);*/
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
    $qry =mysql_query("SELECT * FROM merchant_offers where id = '".$id."'");  
    $result = mysql_fetch_assoc($qry);
    $rate=$result['rate'];
    $status=$result['status'];
} else {
    $rate = $_POST['rate'];
    $status=$_POST['status'];  
    $id= 0;
}
$qry =mysql_query("SELECT * FROM subscriptions where status =1 and  end_date =0");
$data = array();
/*while($row=mysql_fetch_assoc($qry)){    
    $data[] = $row;
}*/
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
                   <form name="myForm" action="add_offers_process.php"  method="post" class="well form-horizontal" enctype='multipart/form-data' >
                      <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Select city for offer</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control" name="city" <?php if(isset($_GET['id']) && $_GET['id']>0){ echo 'disabled'; }?>>
                                    <option value="0" >Choose city</option>
                                    <?php $qry = mysql_query("select * from cities");
                                        while($city = mysql_fetch_assoc($qry)) { 
                                    ?>
                                    <option value="<?php echo $city['code'];?>" ><?php echo $city['name'];?></option>
                                    <?php } ?> 
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Start Date</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input name="id" value="<?php echo $id;?>" type="hidden">
                                   <input type="date" id="name" name="start_date" placeholder="valid from" class="form-control" required="true" value="" >
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">End Date</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input name="id" value="<?php echo $id;?>" type="hidden">
                                   <input type="date" id="end_date" name="end_date" placeholder="valid to" class="form-control" required="true" value="" >
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
                            <label class="col-md-4 control-label">Subscription Type</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
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
                                    <input type="text" id="period" name="period" placeholder="rate" class="form-control" required="true" value="" >
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Content</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                    <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                    <input type="text"  name="content" placeholder="Content here" class="form-control"  value="" >
                                    <input type="file" name="offer_content" id="offer_content" >
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
                               <a href="view_offers.php"><input type="button" value="cancel"  class="btn-warning" ></a>
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