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
//var_dump($_GET);
if(isset($_GET['id']) && $_GET['id']>0){
    $id=$_GET['id'];
    $qry =mysql_query("SELECT r.*,rc.*,r.name as pname,rc.name as cname FROM Resale r join resale_category rc on r.category = rc.id where r.code = '".$id."'");
    //echo "SELECT * FROM resale r join resale_category rc on r.category = rc.id where r.code = '".$id."'";
    $result = mysql_fetch_assoc($qry);
    //var_dump($result);
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
                   <form name="myForm" action="edit_resaleProduct_process.php"  method="post" class="well form-horizontal" >
                      <fieldset>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Product Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input name="id" value="<?php echo $id;?>" type="hidden">
                                   <input id="pname" name="pname" placeholder="Product Name" class="form-control" required="true" value="<?php echo $result['pname'];?>" type="text">
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Price</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input id="price" name="price" placeholder="Category Name" class="form-control" required="true" value="<?php echo $result['price'];?>" type="text">
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input id="desc" name="desc" placeholder="" class="form-control" required="true" value="<?php echo $result['description'];?>" type="text">
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Brand</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <input id="brand" name="brand" placeholder="" class="form-control" required="true" value="<?php echo $result['brand'];?>" type="text">
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Product Category</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select name="category" class="selectpicker form-control">
                                      <?php 
                                       //get category
                                      $qry_category =mysql_query("SELECT* FROM resale_category where status!=2");
                                      while($row=mysql_fetch_assoc($qry_category)){ ?>
                                     <option value="<?php echo $row['id'];?>" <?php if($row['id']==$_GET['cid']){echo "selected";}?>><?php echo $row['name'];?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-6 control-label">  </label>
                            <div class="col-md-4 inputGroupContainer">
                               <input type="Submit" value="Save"  class="btn-success" >
                              <a href="resale_productapproval.php"> <input type="button" value="Back"  class="btn-warning" ></a>
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