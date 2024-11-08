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
    $qry =mysql_query("SELECT * FROM resale_category where id = '".$id."'");
    $result = mysql_fetch_assoc($qry);
    $name=$result['name'];
    $status=$result['status'];
} else {
    $name = $_POST['name'];
    $status=$_POST['status'];
    $id= 0;
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
                   <form name="myForm" action="Add_resaleCategory_process.php"  method="post" class="well form-horizontal" >
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input name="id" value="<?php echo $id;?>" type="hidden">
                                   <input id="name" name="name" placeholder="Category Name" class="form-control" required="true" value="<?php echo $name;?>" type="text">
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select class="selectpicker form-control">
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
                               <input type="button" value="Back"  class="btn-warning" onclick="window.history.go(-1)">
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