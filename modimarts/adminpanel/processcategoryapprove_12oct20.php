<?php 
session_start();
include('config.php');
//var_dump($_POST);
$tempid=$_POST['tempid'];
    //echo $tempid;
    $qTempdata=mysql_query("select * from approval_category where temp_id='".$tempid."'");
    $fetchTempdata=mysql_fetch_array($qTempdata);
    $check_category=mysql_query("select name from main_cat where name like '".$fetchTempdata['name']."'");
   // echo "select * from main_cat where name like '".$fetchTempdata['name']."'";
     $fetchCateg=mysql_fetch_assoc($check_category);
    //var_dump($fetchCateg);
    
if($_POST['stts']==1){
    if(!$fetchCateg){
        //echo '01';
        $QmainCategory=  mysql_query("insert into main_cat(name,under,cat_img,base_cat) values('".$fetchTempdata['name']."','".$fetchTempdata['under']."','".$fetchTempdata['cat_img']."','".$fetchTempdata['base_cat']."')");
       $pcat= mysql_insert_id(); 
    } else {
        echo '3';
    }
     //echo 'ss'.$pcat;
    /*$fetchTempdata=mysql_fetch_array($qTempdata);
    $QmainCategory=  mysql_query("insert into main_cat(name,under,cat_img,base_cat) values('".$fetchTempdata['name']."','".$fetchTempdata['under']."','".$fetchTempdata['cat_img']."','".$fetchTempdata['base_cat']."')");
    $pcat= mysql_insert_id();*/
    //$update_statement = mysql_query("update approval_category set status='".$_POST['stts']."' where temp_id='".$_POST['tempid']."'");
    // insert into table by category wise ==============================================
    $qrya="select * from main_cat where id='".$pcat."'";
    $resulta=mysql_query($qrya);
    $rowa = mysql_fetch_row($resulta);
    $aa=$rowa[2];
    //echo "gup".$aa;
    if($aa!=0){
        $qrya1="select * from main_cat where id='".$aa."'";
        $resulta1=mysql_query($qrya1);
        $rowa1 = mysql_fetch_row($resulta1);
        $Maincate= $rowa1[4];
        //var_dump($Maincate);
        $p_type=mysql_real_escape_string($rowa1[1]);
        // $p_type=$rowa1[1];
    } 
    /*  Ruchi : 29 aug 19  */
    $sql_statement = mysql_query("update approval_category set status='".$_POST['stts']."',main_cat_id='".$pcat."' where temp_id='".$_POST['tempid']."'");
    $update_prodApproval = mysql_query("update Approval_products set status='".$_POST['stts']."' where  code='".$fetchTempdata['Product_id']."'");
    //echo "update Approval_products set status='".$_POST['stts']."' where code='select Product_id from approval_category where temp_id='".$_POST['tempid']."'";
   // echo "update Approval_products set status='".$_POST['stts']."' where  code='".$fetchTempdata['Product_id']."'";

    $QryApprovalProduct= mysql_query("select * from Approval_products where code='".$fetchTempdata['Product_id']."'");
    $fetchAppProdut= mysql_fetch_array($QryApprovalProduct);
    
    $QryApprovalSpecification= mysql_query("select * from Approval_productspecification where product_id='".$fetchTempdata['Product_id']."'");
    $QryApprovalImg= mysql_query("select * from Approval_product_img where product_id='".$fetchTempdata['Product_id']."'");

if($Maincate==1) {
    $key=$pbrand." ".$p_type;
    $qry=mysql_query("INSERT INTO `fashion`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc,keyword1) VALUES 
    ('".$fetchAppProdut['name']."','".$fetchAppProdut['ccode']."','".$fetchAppProdut['description']."','$pcat','".$fetchAppProdut['photo']."','".$fetchAppProdut['price']."','".$fetchAppProdut['others']."',
    '".$fetchAppProdut['discount']."','".$fetchAppProdut['discount_type']."','".$fetchAppProdut['total_amt']."','".$fetchAppProdut['thumbs']."'
    ,'".$fetchAppProdut['midsize']."','".$fetchAppProdut['size']."','".$fetchAppProdut['color']."','".$fetchAppProdut['brand']."'
    ,'".$fetchAppProdut['size_id']."','".$fetchAppProdut['product_type']."','".$fetchAppProdut['long_desc']."','".$fetchAppProdut['keyword1']."')");
    //echo "INSERT INTO `fashion`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc) VALUES ('$pname','$ccode','$pdesc','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$hidden_sizeid','$p_type','$Longdesc')";
    echo "INSERT INTO `fashion`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,size_id,product_type,long_desc,keyword1) VALUES 
    ('".$fetchAppProdut['name']."','".$fetchAppProdut['ccode']."','".$fetchAppProdut['description']."','$pcat','".$fetchAppProdut['photo']."','".$fetchAppProdut['price']."','".$fetchAppProdut['others']."',
    '".$fetchAppProdut['discount']."','".$fetchAppProdut['discount_type']."','".$fetchAppProdut['total_amt']."','".$fetchAppProdut['thumbs']."'
    ,'".$fetchAppProdut['midsize']."','".$fetchAppProdut['size']."','".$fetchAppProdut['color']."','".$fetchAppProdut['brand']."'
    ,'".$fetchAppProdut['size_id']."','".$fetchAppProdut['product_type']."','".$fetchAppProdut['long_desc']."','".$fetchAppProdut['keyword1']."')";
    $insid=mysql_insert_id(); 
    $specification=array();
 
    while($fetchAppSpecification= mysql_fetch_array($QryApprovalSpecification)){
    $qry1=mysql_query("INSERT INTO `fashionSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$fetchAppSpecification['product_specification']."','".$fetchAppSpecification['specificationname']."','".$pcat."')");
 }
    /* if (is_array($spfc))
        {
            for($i=0;$i<count($spfc);$i++)
            {  $qry1=mysql_query("INSERT INTO `fashionSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$_POST['specification1'][$i]."','".$_POST['specification'][$i]."','".$pcat."')");
            }
        }*/
        while($fetchApprovalImage=mysql_fetch_array($QryApprovalImg)){
            $sql2=mysql_query("INSERT INTO `fashion_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$fetchApprovalImage['img']."','".$fetchApprovalImage['thumbs']."','".$fetchApprovalImage['midsize']."','".$pcat."','".$fetchApprovalImage['largeSize']."')");
        }
                     
    /* for($a=0;$a<count($image_name3);$a++)
    {
        $sql2="INSERT INTO `fashion_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$image_name3[$a]."','".$image_name4[$a]."','".$image_name5[$a]."','".$pcat."','".$image_name6[$a]."')";

        $result2 = mysql_query($sql2);

        if(!$result2)
        {
            $errormsg_arr[]=mysql_error();
            $errors++;
        }
    }*/
}
else if($Maincate==190){
    $key=$pbrand." ".$p_type;
  //  $qry=mysql_query("INSERT INTO `electronics`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type','$Longdesc','$key')");
      $qry=mysql_query("INSERT INTO `electronics`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES ('".$fetchAppProdut['name']."','".$fetchAppProdut['ccode']."','".$fetchAppProdut['description']."','$pcat','".$fetchAppProdut['photo']."','".$fetchAppProdut['price']."','".$fetchAppProdut['others']."',
    '".$fetchAppProdut['discount']."','".$fetchAppProdut['discount_type']."','".$fetchAppProdut['total_amt']."','".$fetchAppProdut['thumbs']."'
    ,'".$fetchAppProdut['midsize']."','".$fetchAppProdut['size']."','".$fetchAppProdut['color']."','".$fetchAppProdut['brand']."'
    ,'".$fetchAppProdut['size_id']."','".$fetchAppProdut['product_type']."','".$fetchAppProdut['long_desc']."','".$fetchAppProdut['keyword1']."')");
    $insid=mysql_insert_id(); 
    $specification=array();
    while($fetchAppSpecification= mysql_fetch_array($QryApprovalSpecification)){
        $qry1=mysql_query("INSERT INTO `electronicsSpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$fetchAppSpecification['product_specification']."','".$fetchAppSpecification['specificationname']."','".$pcat."')");
    }
 
   while($fetchApprovalImage=mysql_fetch_array($QryApprovalImg)){
        $sql2=mysql_query("INSERT INTO `electronics_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$fetchApprovalImage['img']."','".$fetchApprovalImage['thumbs']."','".$fetchApprovalImage['midsize']."','".$pcat."','".$fetchApprovalImage['largeSize']."')");

    }
}
else if($Maincate==218){
    //echo 'grocer';exit;
      $key=$pbrand." ".$p_type;
    //  $qry=mysql_query("INSERT INTO `grocery`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES ('$pname','$ccode','$p_other','$pcat','$dirs','$price','$others','$discntamt','$dicnttyp','$ttlprs','','','$hidden_size','$hidden_color','$pbrand','$p_type','$Longdesc','$key')");
    $qry=mysql_query("INSERT INTO `grocery`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES('".$fetchAppProdut['name']."','".$fetchAppProdut['ccode']."','".$fetchAppProdut['description']."','$pcat','".$fetchAppProdut['photo']."','".$fetchAppProdut['price']."','".$fetchAppProdut['others']."',
    '".$fetchAppProdut['discount']."','".$fetchAppProdut['discount_type']."','".$fetchAppProdut['total_amt']."','".$fetchAppProdut['thumbs']."'
    ,'".$fetchAppProdut['midsize']."','".$fetchAppProdut['size']."','".$fetchAppProdut['color']."','".$fetchAppProdut['brand']."'
    ,'".$fetchAppProdut['product_type']."','".$fetchAppProdut['long_desc']."','".$fetchAppProdut['keyword1']."')");
     /* echo "INSERT INTO `grocery`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,size,color,brand,product_type,long_desc,keyword1) VALUES('".$fetchAppProdut['name']."','".$fetchAppProdut['ccode']."','".$fetchAppProdut['description']."','$pcat','".$fetchAppProdut['photo']."','".$fetchAppProdut['price']."','".$fetchAppProdut['others']."',
    '".$fetchAppProdut['discount']."','".$fetchAppProdut['discount_type']."','".$fetchAppProdut['total_amt']."','".$fetchAppProdut['thumbs']."'
    ,'".$fetchAppProdut['midsize']."','".$fetchAppProdut['size']."','".$fetchAppProdut['color']."','".$fetchAppProdut['brand']."'
    ,'".$fetchAppProdut['size_id']."','".$fetchAppProdut['product_type']."','".$fetchAppProdut['long_desc']."','".$fetchAppProdut['keyword1']."')";*/
    $insid=mysql_insert_id(); 
    $specification=array();
    //var_dump($qry);
    //echo $insid;
 
    while($fetchAppSpecification= mysql_fetch_array($QryApprovalSpecification)){
        $qry1=mysql_query("INSERT INTO `grocerySpecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$fetchAppSpecification['product_specification']."','".$fetchAppSpecification['specificationname']."','".$pcat."')");
    }
    while($fetchApprovalImage=mysql_fetch_array($QryApprovalImg)){
        $sql2=mysql_query("INSERT INTO `grocery_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$fetchApprovalImage['img']."','".$fetchApprovalImage['thumbs']."','".$fetchApprovalImage['midsize']."','".$pcat."','".$fetchApprovalImage['largeSize']."')");
    }
} else {
    //echo 'else ';exit;
    $key=$pbrand." ".$p_type;
    //echo 'b : '.$pbrand.'  ty:  '.$p_type.' end';
    //var_dump($key);
    $qry=mysql_query("INSERT INTO `products`(`name`, `ccode`, `description`, `category`, `photo`, `price`, `others`,discount,discount_type,total_amt,thumbs,midsize,brand,product_type,long_desc,keyword1) VALUES 
    ('".$fetchAppProdut['name']."','".$fetchAppProdut['ccode']."','".$fetchAppProdut['description']."','$pcat','".$fetchAppProdut['photo']."','".$fetchAppProdut['price']."','".$fetchAppProdut['others']."',
    '".$fetchAppProdut['discount']."','".$fetchAppProdut['discount_type']."','".$fetchAppProdut['total_amt']."','".$fetchAppProdut['thumbs']."'
    ,'".$fetchAppProdut['midsize']."','".$fetchAppProdut['size']."','".$fetchAppProdut['color']."','".$fetchAppProdut['brand']."'
    ,'".$fetchAppProdut['size_id']."','".$fetchAppProdut['product_type']."','".$fetchAppProdut['long_desc']."','".$fetchAppProdut['keyword1']."')");
    $insid=mysql_insert_id(); 
    $specification=array();
 
    while($fetchAppSpecification= mysql_fetch_array($QryApprovalSpecification)){
        $qry1=mysql_query("INSERT INTO `productspecification`(`product_id`, `product_specification`,`specificationname`,category) VALUES('".$insid."','".$fetchAppSpecification['product_specification']."','".$fetchAppSpecification['specificationname']."','".$pcat."')");
    }
    while($fetchApprovalImage=mysql_fetch_array($QryApprovalImg)){
        $sql2=mysql_query("INSERT INTO `product_img`(`product_id`, `img`,thumbs,midsize,category,largeSize) values('".$insid."','".$fetchApprovalImage['img']."','".$fetchApprovalImage['thumbs']."','".$fetchApprovalImage['midsize']."','".$pcat."','".$fetchApprovalImage['largeSize']."')");
    }
}
 //=====================================
 if(!$qry1){
     echo '2';
 } else {
     echo '1';
 }
} 
/* Ruchi */
else {
    
    $sql_statement = mysql_query("update approval_category set status=2 where temp_id='".$_POST['tempid']."'");
    $update_prodApproval = mysql_query("update Approval_products set status=2 where  code='".$fetchTempdata['Product_id']."'");
    if($update_prodApproval)
    {
        $to=$_POST['em'];
        $to='developer.ruchi@gmail.com';
        $subject = "Rejection";
        $txt = $_POST['re'].' '.$_POST['em'];
        //$txt='NA';
        //echo  'em : '.$to.'rs: '.$txt;
        $headers = "From: Merabazaar@example.com" . "\r\n" .
        "CC: sarmicrosystems@example.com";
        mail($to,$subject,$txt,$headers);
        echo 1;
    }else{
        echo 2;
    }
}

?>
