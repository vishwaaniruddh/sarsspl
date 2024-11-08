<?php
session_start();
 include('connect.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function get_username($id){
    global $con1;
    global $con;
    // var_dump($_SESSION['gid']);
    // var_dump($_SESSION['mem_id']);
if($_SESSION['gid']!=''){    
    $sql = mysqli_query($con1, "select * from Registration where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['Firstname'];
  }
  if($_SESSION['mem_id']!=''){    
    $query="SELECT * FROM new_member WHERE id='".$id."'";
    $result = mysqli_query($con,$query);
    $row  = mysqli_fetch_assoc($result); 
    // var_dump($row);
    return $row['name'];    
  }

}



function total_count($cid){
    
    $qrya="select * from main_cat where id='".$cid."' and status=1"; 
    $resulta=mysqli_query($con1,$qrya);
    $rowa = mysqli_fetch_row();
    
    $aa=$rowa[2];

    //5:blouse  8:kurti  10:lehanga  22:evening gowns  27 : kalmakari  28 : indo western  29 : trail gowns
    
    if($aa!=0) {
        $qrya1="select * from main_cat where id='".$aa."' and status=1";
        $resulta1=mysqli_query($con1,$qrya1);
        $rowa1 = mysqli_fetch_row($resulta1);
        $Maincate= $rowa1[4];
    } 

    $jewellery = false;
    $garment = false;
    
    $count_sri_products = 0;
    $allmart_count = 0;
    
    if($cid==80) {
        $maincatid = ' in(22,27,28,29)';
        $garment = true;
        
    } else if($cid == 82) {
        $garment = true;
        $maincatid = ' in(8)';
        
    } else if($cid == 84) {
        $garment = true;
        $maincatid = ' in(10)';
        
    } else if($cid == 85) {
        $garment = true;
        $maincatid = ' in(5)';
        
    } else if($cid == 117) {
        // jewellery
        $jewellery = true;
        $maincatid = ' in(19)';
    }

    if($Maincate==1)
    {
        if($jewellery) {
            $sql="SELECT * FROM `product` WHERE `categories_id` ".$maincatid;
        } else if($garment) {
            $sql="select * from  `garment_product` where product_for ".$maincatid." and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
        }

        $qrytotalproduct = mysqli_query($con1,"select * from fashion where category ='".$cid."' and status=1 ");
        
        
    }
    else if($Maincate==190)
    {
        $qrytotalproduct = mysqli_query($con1,"select * from electronics where category ='".$cid."'  and status=1 ");
    }
    else if($Maincate==218)
    {   
        $qrytotalproduct = mysqli_query($con1,"select * from grocery where category ='".$cid."'  and status=1 ");
    }
    else if($Maincate==760)
    {
        $qrytotalproduct = mysqli_query($con1,"select * from kits where category ='".$cid."'  and status=1 ");
    }
    else 
    {
        $qrytotalproduct = mysqli_query($con1,"select * from products where category ='".$cid."' and status=1 "); 
    }
    
    $sql_sri_products = mysqli_query($con1,$sql);
    $count_sri_products = mysqli_num_rows($sql_sri_products);
    
    $allmart_count = mysqli_num_rows($qrytotalproduct);
    $total = $allmart_count + $count_sri_products;
    
    //$total_records = $total;
    //echo $total;
}

?>