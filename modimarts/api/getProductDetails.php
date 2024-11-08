<?php 
include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$pid=$_GET['pid'];
$cid=$_GET['catid'];

//Ruchi
if(isset($_GET['gid'])) {
    $prod_id=$_GET['gid'];  
} else {
    $prod_id=$_GET['prod_id'];  
} 

//$prod_id=$_GET['prod_id'];  
/*$_GET['gid']='1836';  
$pid='1836';
$catid='84';
$prod_id='1836';*/

function get_kit_info($id,$parameter) {
    
    global $con1;
     
    $sql = mysqli_query($con1,"select $parameter from kits where code ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}
//=================================================== query for get category which under 0 =================================================

$qrya="select * from main_cat where id='".$cid."' and status=1";

$resulta=mysqli_query($con1,$qrya);
$rowa = mysqli_fetch_row($resulta); 

$aa=$rowa[2]; 

if($cid==80) {
    $maincatid = 5;
    $sql="select * from  `garment_product` where product_for='".$maincatid."' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
    
} else {
    if($aa!=0) {
        $qrya1="select * from main_cat where id='".$aa."' and status=1";
        $resulta1=mysqli_query($con1,$qrya1);
        $rowa1 = mysqli_fetch_row($resulta1);
        $Maincate= $rowa1[4];
    }

    //=================================================================================================
    
    if($Maincate==1)
    {
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt` , `color` ,`size`,Long_desc FROM `fashion` WHERE code='".$pid."'";
    }
    else if($Maincate==190)
    {   
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `electronics` WHERE code='".$pid."'";
    }
    else if($Maincate==218)
    {   
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `grocery` WHERE code='".$pid."'";
    }
    else if($Maincate==757)
    {   
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `services` WHERE code='".$pid."'";
    }
    else if($Maincate==767)
    {   
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `promotion_product` WHERE code='".$pid."'";
    }
        else if($Maincate==760)
    {   
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `kits` WHERE code='".$pid."'";
    }
    else 
    {
        $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc FROM `products` WHERE code='".$pid."'";
    }
}

$descriptionQry = mysqli_query($con1,"select description,others,Long_desc from product_model where id='".$prod_id."'");
$desc_data = mysqli_fetch_assoc($descriptionQry);

$qrylatfrws=mysqli_query($con1,$qrylatf);   
$latstprnrws=mysqli_fetch_array($qrylatfrws);

$prod = mysqli_query($con1,"SELECT product_model FROM product_model where id='".$latstprnrws['name']."'");
$product_name = mysqli_fetch_assoc($prod);

if($Maincate==1){
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc ");
}
else if($Maincate==190)
{
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc ");
     
}
else if($Maincate==218)
{
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit");
}
else if($Maincate==757)
{
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' order by id asc limit");
}
else if($Maincate==767)
{
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid' order by id asc limit");
}
else if($Maincate==760)
{
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
}

else 
{
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit ");
}
//$frtu=mysqli_fetch_array($sqlimg23mn);

if($Maincate==1) {
    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from fashionSpecification where product_id='".$pid."'");
}
else if($Maincate==190)
{
    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from electronicsSpecification where product_id='".$pid."'");
}
else if($Maincate==218)
{
    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from grocerySpecification where product_id='".$pid."'");
}
else if($Maincate==757)
{
    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from services_Specification where product_id='".$pid."'");
}
else if($Maincate==767)
{
    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from promotion_product_Specification where product_id='".$pid."'");
}
else
{
    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from productspecification where product_id='".$pid."'");
}

$thumbnail = array();
$pro_img = '';
$specification = array();
$rating = '';

if(isset($_GET['gid'])) { 
	    
	   // $maincatid = ' in(5,10,22,27,28)';
	   
	   if($cid==80) {
            $maincatid = ' in(22,27,28,29)';
        } else if($cid == 82) {
            $maincatid = ' in(8)';
        } else if($cid == 84) {
            $maincatid = ' in(10)';
        } else if($cid == 85) {
            $maincatid = ' in(5)';
        } else if($cid == 117) {
            // jewellery
            $jewellery = true;
            $maincatid = ' in(19)';
        } 
        
        if($jewellery) {
            $prcode = $data['product_code'];
            $sql="SELECT * FROM `product` WHERE `categories_id` ".$maincatid." and product_id=".$_GET['gid'];
            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `product_id`=".$_GET['gid'];
        } else {
            $prcode = $data['gproduct_code'];
            $sql="select * from  `garment_product` where product_for ".$maincatid." and gproduct_id=".$_GET['gid'];
            $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=".$_GET['gid'];
        }
        
        $result = mysqli_query($con1,$sql);
        $data = mysqli_fetch_array($result);
        
         if($jewellery) {
            $prcode = $data['product_code'];
        } else {
            $prcode = $data['gproduct_code'];
        }
        $rate_qry = mysqli_query($con1,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rate=mysqli_fetch_row($rate_qry);
        
        $qryimg=mysqli_query($con1,$sqlimg);
        $rowimg=mysqli_fetch_row($qryimg);
        
        $path=trim($pathmain."uploads".$rowimg[0]);
        
        $expl=explode('/',$path);
        
        $pth1=trim($pathmain."mid1/".$expl[$cnt-1]);
        
    	$categogy = $_GET['catid'];
    	//$prod_id= $_GET['prod_id'];
    	//$amount = $latstprnrws['total_amt'];
    	if($data[2]!=''){
    	    $pro_name = $data[2];
    	} else {
    	    $pro_name = $data[2];
    	}
    	$amount = $rate[0];
    	$description = $data['short_desc'];
    	$desc_others ='';
    	$long_desc = $data[4];
    	
    	$pro_img = "http://yosshitaneha.com/".$path;
    	$data1[]=['productid'=>$prod_id,'productname'=>$pro_name,'productprice'=>$amount,'productDescription'=>strip_tags($description), 'other'=> strip_tags($desc_others), 'longdesc'=>strip_tags($long_desc),'imageViewproduct'=>$pro_img,'thumbnail'=>$thumbnail,'productRating'=>$rating,'specification'=>$specification];
}  else {
    $categogy = $_GET['catid'];
	$prod_id= $_GET['prod_id'];
    $cust_pid = $_GET['pid'];
    if($categogy=='761'){
        
        $amount = get_kit_info($cust_pid,'total_amt');
    	$pro_name = get_kit_info($cust_pid,'name');
    	$pro_img =  'https://allmart.world/ecom/'.get_kit_info($cust_pid,'photo');
    
    	$description = get_kit_info($cust_pid,'description');
    	$long_desc = get_kit_info($cust_pid,'Long_desc'); 
    	$desc_others = get_kit_info($cust_pid,'others');	
    }
    else {
        $amount = $latstprnrws['total_amt'];
    	$pro_name = $product_name['product_model'];
        //$pro_img =  'https://allmart.world/ecom/'.$frtu[2];
    	$discount = $latstprnrws['price'];
    	
    	$description = $desc_data['description'];
    	$long_desc = $desc_data['Long_desc'];
    	$desc_others = $desc_data['others']; 
    	
    	$nr=1;
        
        while($rte=mysqli_fetch_array($sqlimg23mn))
        {
            if($nr==1) {
                $pro_img="https://allmart.world/ecom/".$rte["img"];
            }
            
            $thumbnail[] = "https://allmart.world/ecom/".$rte["thumbs"];
            
            $nr++;
        }
    }
    
    // specification
    
    while($fetcspcf=mysqli_fetch_array($qry)){
        $specification[] = ['specification_name'=>$fetcspcf[1] , 'specification'=>$fetcspcf[0]];
    }
    $sql_rating="select avg(rating_count) from product_review where product_id='".$prod_id."' and category_id='".$categogy."' ";
    
    $run=mysqli_query($con1,$sql_rating);
    $row=mysqli_num_rows($run);
    
    $fetch=mysqli_fetch_array($run);
    
    if($row>0){
        if($fetch[0]==""){
          
          $rating=0;
          
        } else {
            $rating=round($fetch[0]);
        }
    } else {
        $rating=0;
    }
    
    
     $data1[]=['productid'=>$prod_id,'productname'=>$pro_name,'productprice'=>$amount,'productDescription'=>strip_tags($description), 'other'=> strip_tags($desc_others), 'longdesc'=>strip_tags($long_desc),'imageViewproduct'=>$pro_img,'thumbnail'=>$thumbnail,'productRating'=>$rating,'specification'=>$specification,'category_id'=>$cid];
}

//print_r($data1);
echo json_encode($data1);

?>
