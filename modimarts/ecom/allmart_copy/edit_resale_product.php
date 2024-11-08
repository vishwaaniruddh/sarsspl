<?php
session_start();
if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){
    header("location:index.php");
}

?>
<?php 

include('config.php');

//var_dump($_GET);
if(isset($_GET['id']) && $_GET['id']>0){
    $id=$_GET['id'];
    $qry =mysqli_query($con1,"SELECT r.*,rc.*,r.name as pname,r.status as rstatus,rc.name as cname FROM Resale r join resale_category rc on r.category = rc.id where r.code = '".$id."'");
    //echo "SELECT * FROM resale r join resale_category rc on r.category = rc.id where r.code = '".$id."'";
    $result = mysqli_fetch_assoc($qry);
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
                   <form name="myForm" action="edit_resale_process.php"  method="post" class="well form-horizontal" >
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
                                      $qry_category =mysqli_query($con1,"SELECT* FROM resale_category where status!=2");
                                      while($row=mysqli_fetch_assoc($con1,$qry_category)){ ?>
                                     <option value="<?php echo $row['id'];?>" <?php if($row['id']==$_GET['cid']){echo "selected";}?>><?php echo $row['name'];?></option>
                                     <?php } ?>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Specifications</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <?php 
                                    $qry=mysqli_query($con1,"SELECT id,product_specification,specificationname from ResaleSpecification where product_id='".$id."'");
                                    $c = 0;
                                    while($fetcspcf=mysqli_fetch_assoc($qry)){
                                    ?>
                                        <input type="hidden" id="<?php echo $c; ?>" name="spec[<?php echo $c; ?>][id]" class="form-control"  value="<?php echo $fetcspcf['id'];?>" >
                                        <input  type="text"  name="spec[<?php echo $c; ?>][specf]" class="form-control" value="<?php echo $fetcspcf['product_specification'];?>" >
                                        <input  name="spec[<?php echo $c; ?>][name]" class="form-control" value="<?php echo $fetcspcf['specificationname'];?>" type="text">
                                    <?php $c++; } ?>
                                </div>
                            </div>
                         </div>
                         <div class="form-group">   
                            <label class="col-md-4 control-label">Images</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                   <?php 
                                    $qry=mysqli_query($con1,"SELECT id,img from Resale_img where product_id='".$id."'");
                                    while($fetcspcf=mysqli_fetch_assoc($qry)){
                                    ?>
                                        <input id="img_id<?php echo $fetcspcf['id'];?>" name="img_id<?php echo $fetcspcf['id'];?>" class="form-control"  value="<?php echo $fetcspcf['id'];?>" type="hidden">
                                        <img src="<?php echo $fetcspcf['img'];?>" alt = 'No Img' width="10px">  
                                        
                                    <?php } ?>
                                </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Product Sold</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group">
                                  <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                  <select name="is_sold" class="selectpicker form-control">
                                     <option value="1" >Yes</option>
                                     <option value="0" >No</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">  </label>
                            <div class="col-md-4 inputGroupContainer">
                               <input type="Submit" value="Save" class="btn-success" >
                            </div>
                            <?php if($result['rstatus']==2) { ?>
                            <div class="col-md-4 inputGroupContainer">
                               <a href="edit_resale_process.php?reapprove=<?php echo $result['code']; ?>"><input type="button" value="Reapprove" class="btn-success" ></a>
                            </div>
                            <?php }?>
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