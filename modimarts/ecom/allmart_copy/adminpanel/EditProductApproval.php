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

if(isset($_GET['mid'])){
    $Maincate = $_GET['mid'];
}
//echo $Maincate;
if($Maincate==1){	
	 $slting=mysqli_query($con3,"SELECT * FROM `fashion` where  code='".$_GET['pcode']."'");
	 //echo "SELECT * FROM `fashion` where  code='".$_GET['pcode']."'";
	 $pimg=mysqli_query($con3,"SELECT * FROM `fashion_img` where product_id='".$_GET['pcode']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `fashionSpecification` where product_id='".$_GET['pcode']."'");
}
else if($Maincate==190)
{	
     $slting=mysqli_query($con3,"SELECT * FROM `electronics` where  code='".$_GET['pcode']."'");
     //echo "SELECT * FROM `electronics` where name='".$_GET['pcode']."'";
     $pimg=mysqli_query($con3,"SELECT * FROM `electronics_img` where product_id='".$_GET['pcode']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `electronicsSpecification` where product_id='".$_GET['pcode']."'");
}
else if($Maincate==218)
{	
     $slting=mysqli_query($con3,"SELECT * FROM `grocery` where code='".$_GET['pcode']."'");
     //echo "SELECT * FROM `grocery` where code='".$_GET['pcode']."'";
     $pimg=mysqli_query($con3,"SELECT * FROM `grocery_img` where product_id='".$_GET['pcode']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `grocerySpecification` where product_id='".$_GET['pcode']."'");
} 
else if($Maincate==482)
{	
     $slting=mysqli_query($con3,"SELECT * FROM `Resale` where  code='".$_GET['pcode']."'");
     //echo "SELECT * FROM `Resale` where status=0 and code='".$_GET['pcode']."'";
     //$pimg=mysqli_query($con3,"SELECT * FROM `fashion_img` where product_id='".$_GET['pid']."'");
	 //$pspecification=mysqli_query($con3,"SELECT * FROM `fashionSpecification` where product_id='".$_GET['pid']."'");
} 
else
{	
     $slting=mysqli_query($con3,"SELECT * FROM `products` where code='".$_GET['pcode']."'");
     //echo "SELECT * FROM `products` where status=0 and code='".$_GET['pcode']."'";
     $pimg=mysqli_query($con3,"SELECT * FROM `product_img` where product_id='".$_GET['pcode']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `productspecification` where product_id='".$_GET['pcode']."'");
}

$result=mysqli_fetch_assoc($slting);
//var_dump($result);

if(isset($_GET['pid']) && $_GET['pid']>0){
    $pid=$_GET['pid'];
    $qry =mysqli_query($con3,"SELECT * FROM product_model where id = '".$pid."'");
    $pdetails = mysqli_fetch_assoc($qry);
    $pname=$pdetails['name'];
    //var_dump($pdetails);echo '<br>new : ';
    
    /*$qry1 =mysqli_query($con3,"SELECT * FROM product_additional_details where product_id = '".$pid."'");*/
    $qry1 =mysqli_query($con3,"SELECT * FROM product_additional_details where product_id = '".$_GET['pcode']."'");
    //echo "SELECT * FROM product_additional_details where product_id = '".$_GET['pcode']."'";
    $result1 = mysqli_fetch_assoc($qry1);
    if(mysqli_num_rows($qry1)>0){
      //echo 't';  
    //} else {
        $new_desc = $result1['description'];
        $new_long_desc = $result1['Long_description'];
        $new_others = $result1['others'];
        $new_price = $result1['price'];
        $new_discount = $result1['discount'];
        $new_brand = $result1['brand_id'];
    }
    //$pname=$result1['product_model'];
    // var_dump($result1);
} 
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="css/custom.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div class="container register">
            <div class="row">
                <div class="col-md-2 register-left">
                    <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                    <h3>Welcome</h3>
                    <p>To Allmart!</p>
                    <!--<input type="submit" name="" value="Login"/><br/>-->
                </div> 
                <div class="col-md-10 register-right">
                    <form action="process_approveProduct.php" method="post" enctype="multipart/form-data">
                    <div class="tab-content" id="myTabContent">
                        <input type="hidden" name="main_cat" value="<?php echo $_GET['mid']; ?>">
                        <input type="hidden" name="pid" value="<?php echo $_GET['pcode']; ?>">
                        <input type="hidden" name="bid" value="<?php echo $_GET['bid']; ?>">
                        <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>">
                        <input type="hidden" name="productModel_id" value="<?php echo $_GET['pid']; ?>">
                        <div class="tab-pane fade show active in" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3 class="register-heading">Approve Product</h3>
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <h3>Existing</h3>
                                    <div class="form-group display-prop">
                                        <label >Brand   </label>&nbsp;
                                        <select name="brand" class="selectpicker form-control">
                                          <?php 
                                           //get category
                                          $qry_br =mysqli_query($con3,"SELECT* FROM brand where status!=2");
                                          while($row=mysqli_fetch_assoc($qry_br)){ ?>
                                         <option value="<?php echo $row['id'];?>" <?php if($row['id']==$result['brand_id']){echo "selected";}?>><?php echo $row['brand'];?></option>
                                         <?php } ?>
                                      </select>
                                     </div>
                                     <div class="form-group display-prop">
                                          <label >product</label>&nbsp;
                                      <select name="product" class="selectpicker form-control">
                                         <?php 
                                         //get category
                                         $qry_pr =mysqli_query($con3,"SELECT* FROM product_model where status!=2");
                                         while($row=mysqli_fetch_assoc($qry_pr)){ ?>
                                         <option value="<?php echo $row['id'];?>" <?php if($row['id']==$pdetails['id']){echo "selected";}?>><?php echo $row['product_model'];?></option>
                                         <?php } ?>
                                      </select>
                                     </div>
                                    <div class="form-group display-prop">
                                        <label >Image</label>&nbsp;
                                        <?php while($img=mysqli_fetch_assoc($pimg)){?>
                                            <img src="<?php echo $img['img']; ?>" alt="no img" width= '17%'>
                                        <?php }  ?>
                                        <img src="http://sarmicrosystems.in/oc1/adminpanel/logomera.png" alt="no img" width='17%'>
                                    </div>
                                    <div class="form-group display-prop">
                                        <label >Price</label>&nbsp;
                                        <input type="text" name="price" class="form-control"  value="<?php echo $pdetails['price']; ?>" />
                                    </div>
                                    <div class="form-group display-prop">
                                        <label >Discount</label>&nbsp;
                                        <input type="text" name="discount" class="form-control"  value="<?php echo $pdetails['discount']; ?>" />
                                    </div>
                                    <div class="form-group display-prop">
                                        <label >Long Description</label>&nbsp;
                                        <textarea name="long_desc" id="long_desc" rows="4" cols="48"><?php echo $pdetails['Long_desc']; ?></textarea>
                                    </div>
                                    <div class="form-group display-prop">
                                        <label >Description</label>&nbsp;
                                        <input type="text" name="description" id="description" class="form-control"  value="<?php echo $pdetails['description']; ?>" />
                                    </div>
                                    <div class="form-group display-prop">
                                        <label >Others</label>&nbsp;
                                        <textarea name="others" id="others" rows="4" cols="48"><?php echo $pdetails['others']; ?></textarea>
                                    </div>
                                    
                                    <div class="form-group display-prop">
                                        <label >Specification</label>&nbsp;
                                        <ol>
                                            <?php 
                                        	    while($row = mysqli_fetch_assoc($pspecification)) {  ?>
                                                    <li><?php echo $row['product_specification'];?></li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Additional</h3>
                                    <div class="form-group display-prop">
                                        <?php 
                                            $qry_brand =mysqli_query($con3,"SELECT* FROM brand where status!=2 and id=".$_GET['bid']);
                                            //echo "SELECT* FROM brand where status!=2 and id=".$_GET['bid'];
                                            $br=mysqli_fetch_assoc($qry_brand);
                                            //var_dump($br);
                                            if($result1['brand_id']){
                                        ?>
                                        <input type="text" name="new_brand" class="form-control" value="<?php if($result1['brand_id']){echo $br['brand'];} ?>" />
                                        <?php } else { ?>
                                        <select name="brand1" class="selectpicker form-control">
                                          <?php 
                                           //get category
                                          $qry_brands =mysqli_query($con3,"SELECT* FROM brand where status!=2");
                                          while($rows=mysqli_fetch_assoc($qry_brands)){ ?>
                                         <option value="<?php echo $rows['id'];?>" <?php if($rows['id']==$_GET['bid']){echo "selected";}?>><?php echo $rows['brand'];?></option>
                                         <?php } ?>
                                      </select>
                                      <?php } ?>
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_brand" value="yes">approve
                                        </div>
                                     </div>
                                     <div class="form-group display-prop">
                                         <?php 
                                            $qry_product =mysqli_query($con3,"SELECT* FROM product_model where status!=2 and id=".$result['name']);
                                            //echo "SELECT* FROM product_model where status!=2 and id=".$result['name'];
                                            $prod=mysqli_fetch_assoc($qry_product);
                                           // var_dump($result1['product_id']);
                                          if($result1['product_id']) {
                                        ?>
                                        <input type="text" name="new_product" class="form-control" value="<?php if($result1['product_id']){echo $prod['product_model'];} ?>" />
                                        <?php } else { ?>
                                        <select name="product1" class="selectpicker form-control">
                                        <?php 
                                        //get category
                                        $qry_prod =mysqli_query($con3,"SELECT* FROM product_model where status!=2");
                                        while($row=mysqli_fetch_assoc($qry_prod)){ ?>
                                            <option value="<?php echo $row['id'];?>" <?php if($row['id']==$_GET['pid']){echo "selected";}?>><?php echo $row['product_model'];?></option>
                                         <?php } ?>
                                      </select>
                                      <?php } ?>
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_product" value="yes">approve
                                        </div>
                                     </div>
                                    <div class="form-group display-prop" >
                                        <img src="" alt="no img">
                                         <div class="pull-right">
                                            <input type="checkbox" name="is_image" value="yes">approve
                                        </div>
                                    </div>
                                    <div class="form-group display-prop">
                                        <input type="text" name="new_price" class="form-control" value="<?php if($result1['price']){echo $result1['price'];} ?>" />
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_price" value="yes">approve
                                        </div>
                                    </div>
                                    <div class="form-group display-prop">
                                        <input type="text" name="new_discount" class="form-control"  value="<?php if($result1['discount']) {echo $result1['discount'];} ?>" />
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_discount" value="yes">approve
                                        </div>
                                    </div>
                                    <div class="form-group display-prop">
                                        <textarea name="new_long_desc" id="new_long_desc" rows="4" cols="48"><?php if($result1['long_desc']) { echo $result1['long_desc'];} ?></textarea>
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_long_desc" value="yes">approve
                                        </div>
                                    </div>
                                    <div class="form-group display-prop">
                                        <input type="text" name="new_description" id="new_description" class="form-control" value="<?php if($result1['description']) { echo $result1['description'];} ?>" />
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_description" value="yes">approve
                                        </div>
                                    </div>
                                    <div class="form-group display-prop">
                                        <textarea name="new_others" id="new_others" rows="4" cols="48"><?php if($result1['others']) { echo $result1['others'];} ?></textarea>
                                        <div class="pull-right">
                                            <input type="checkbox" name="is_other" value="yes">approve
                                        </div>
                                    </div>
                                    <div class="form-group display-prop">
                                        <ol type="I">
                                            <li>Speci1</li>
                                            <li>Speci1</li>
                                        </ol>
                                    </div>
                                    <input type="submit" class="btnRegister btn-success"  value="Approve"/>
                                    <a href="productapproval.php"><input type="button" class="btn-warning"  value="Back"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>