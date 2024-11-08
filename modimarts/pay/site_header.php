<?php session_start(); 
include('../functions.php'); 

if($_SESSION['email']){
    $userid = $_SESSION['gid'];
    $username = get_username($userid);
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="copyright" content="">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> Allmart </title>
        <link rel="icon" href="https://allmart.world/assets/allmart.png" type="image/x-icon">
    	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="../requiredfunctions.js"></script>
    
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../new/style.css">
        <link rel="stylesheet" href="../css/themify-icons.css">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="new/script.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    
        <style>
            .nav_search img{
                width:25px;
                margin:auto 1%;
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@800&display=swap" rel="stylesheet">
    </head>
    <body>
        
        <?
function get_all_cat($cat){
    global$con1;
    
    $sql = "select * from main_cat where under ='".$cat."'";


if(mysqli_query($con1,$sql)){
$sql = mysqli_query($con1,$sql);

    while($sql_result = mysqli_fetch_assoc($sql)){

        $ids[] = $sql_result['id'];
    }
    
    foreach($ids as $key=>$val){
        
        if($val>0 && $val != NULL){
            $ids[] = get_all_cat($val);            
        	}
    	}

	return $ids;
	}
	else{
		$category[] = $cat;
		return $category;
	}

}

 


function filter_cat($result){
    
foreach($result as $key =>$val){
    
    if(!is_array($val)){
        $all_cat[]= $val;
        
    }
    else{
        
        foreach($val as $k => $v){
            if(!is_array($v)){
                $all_cat[]= $v;
            }
            else{
                foreach($v as $ke => $va){
                    $all_cat[]=$va;
                }
            }

        }
    }
    
}
    $filter = array_filter($all_cat);
    return $filter;   
}




function if_top($cat){

	global $con1;

	$sql = mysqli_query($con1,"select * from main_cat where id='".$cat."'");
	$sql_result = mysqli_fetch_assoc($sql);
	$id = $sql_result['id'];
	$under = $sql_result['under'];
	if($under==0){
		return $cat;
	}else{
		return 0;
	}
}



function get_top_cat($cat){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from main_cat where id='".$cat."'");
    $sql_result = mysqli_fetch_assoc($sql);
    $under = $sql_result['under'];
    
    if(if_top($cat)==0){
    	return get_top_cat($under);
    }
    else{
    	return $cat;

    }

}


function get_count($cat){

	global $con1;

	

	$result = get_all_cat($cat);

	$filter = filter_cat($result);

	$id = "'" . implode ( "', '", $filter )."'";



    
    




    // if($cat==80){    
    //     $sri = true;
    //     $id = "'22','27','28','29'";
    // } else if($cat == 82) {
    //     $sri = true;
    //     $id = "'8'";
    // } else if($cat == 84) {
    //     $sri = true;
    //     $id = "'10'";
    // } else if($cat == 85) {
    // $sri = true;
    // $id = "'5'";
    // } else if($cat == 117) {
    //     $jwel = true;
    //     $id = "'19'";
    // }


	if(get_top_cat($cat) == 1 || $cat == '133' || $cat == '765'){
		$table = 'fashion';
	}

	else if(get_top_cat($cat) == 190){
		$table = 'electronics';
	}
	else if(get_top_cat($cat) == 218){
		$table = 'grocery';
	}
	else if(get_top_cat($cat) == 260 || get_top_cat($cat) == 160){
		$table = 'products';
	}
	else if(get_top_cat($cat) == 767 ){
		$table = 'products';
	}
	else if(get_top_cat($cat) == '757' ){
		$table = 'services';
	}
	
// 	if($jwel){
// 	    $table = 'product';
// echo "SELECT count(product_id) as total FROM product WHERE categories_id in ($id)";
//       $sql=mysqli_query($con1,"SELECT count(product_id) as total FROM product WHERE categories_id in ($id)");
// 	}
// 	else if($sri){
// 	    	    $table = 'garment_product';
// echo "SELECT count(gproduct_id) as total FROM $table WHERE product_for in ($id)";
//       $sql=mysqli_query($con1,"SELECT count(gproduct_id) as total FROM $table WHERE product_for in ($id)");
// 	}
	
	
	



// if(!$sql){
    // echo "select count(code) as total from $table where category in ('".$cat."',$id)";
// 	$sql = mysqli_query($con1,"select count(code) as total from $table where category in ('".$cat."',$id) "); 
// echo "select count(code) as total from $table where category in ('".$cat."',$id) and status=1";

    	$sql = mysqli_query($con1,"select count(code) as total from $table where category in ('".$cat."',$id) and status=1"); 
	
// }
	$sql_result = mysqli_fetch_assoc($sql);

	return $sql_result['total'];

}





// echo get_count(198);
// return;
  
  function categories($catid,$sub_menu){
            
global $con1;
    $sql2 = "select * from main_cat where under ='".$catid."' and status=1";
    
    $result = mysqli_query($con1,$sql2);

    
    if($result){
        
        if($sub_menu == 0){
            
                echo '<span class="nav-icon"></span>
                <ul class="dropdown-menu">
                ';
        }
        else{
            echo '<span class="nav-icon"></span>
            <ul class="submenu dropdown-menu" id="submenu">
            '
            ;            
        }

    
    while($row = mysqli_fetch_object($result)){
        
        $idc=$row->id;
        $chku=mysqli_query($con1,"select * from main_cat where id ='".$idc."' and status=1 order by name asc");
        
        $chkufr=mysqli_fetch_array($chku);
        $aa=$chkufr[2];
        if($aa!=0) {
            $qrya1="select * from main_cat where id='".$aa."' and status=1";
            $resulta1=mysqli_query($con1,$qrya1);
            $rowa1 = mysqli_fetch_row($resulta1);
            $Maincate= $rowa1[4];
        } 
    
    if($Maincate==1) {
        $chkqrnrprodcts=mysqli_query($con1,"select * from fashion where category ='".$idc."'"); 
    }
    else if($Maincate==190) {
        $chkqrnrprodcts=mysqli_query($con1,"select * from electronics where category ='".$idc."'");
    }
    else if($Maincate==218) {
        $chkqrnrprodcts=mysqli_query($con1,"select * from grocery where category ='".$idc."'");
        
    } else {
        $chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
    }
    $cprodexs=mysqli_num_rows($chkqrnrprodcts);
    
    $chkundrexs=mysqli_query($con1,"select * from main_cat where under ='".$idc."' and status=1 order by name asc");
    $chkundrexsrws=mysqli_num_rows($chkundrexs);


    $chkqrnr=mysqli_query($con1,"select * from main_cat where id ='".$chkufr[2]."' and status=1");
    $chkissubcat=mysqli_fetch_array($chkqrnr);
    
    if($chkissubcat[2]==0 or $chkundrexsrws>0)
        { ?>
          
            <li>
                
                <a class="dropdown-item"  href="../new_product.php?catid=<?php echo $idc;?>">
                	<?php echo $row->name;?>(<? echo get_count($idc); ?>)
                		
                	</a>
                
                <?php
                $sub_menu = 1; 
                if(categories($row->id,$sub_menu) > 0 ){
                 categories($row->id,$sub_menu);   
                }
                
                ?>
            </li>


<?php } else { ?>


<li>
<a class="dropdown-item" href="../new_product.php?catid=<?php echo $idc;?>">

    <?php if(strlen($row->name)>20) { ?>
         <span href="#" data-toggle="tooltip" title="<?php echo $row->name;?>">
         	<?php   echo $row->name.'('. get_count($idc).')';?>
         </span>
    <?php } else {
        echo $row->name. ' (' .get_count($idc) .')' ;
    }
    ?>

</a>


</li>
<?php } } }
    
    echo '</ul>';
        } 
        ?>
        
        
        
        
        
        
        
                <header id="masthead" class="site-header logo-center">
            
        
<div class="container-fluid">
<div class="fixed-header">
    
    <div class="navigation">
        
        <div class="logo">
            
            
            <a href="https://allmart.world/" class="custom-logo-link" rel="home" itemprop="url">
                
                <img src="https://allmart.world/assets/allmart.png" class="custom-logo" alt="All Mart " itemprop="logo"></a>
        </div>
            
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        
<div class="nav_search">
    
   <form action="../search.php" method="POST" class="newsletter-inner">
		<input name="search" value="<? echo $_POST['search'];?>" placeholder="Search Product" required="" type="text">
		<button class="btn">Search</button>
	</form>

</div>
        
        
        <div class="nav-links">
  
  
            <div class="nav-profile">
            <a href="https://allmart.world/new_account/my-account.php" class="colored-btn">            
            <?
            if($_SESSION['fname']){
                echo 'Hello, '.$username;
            }
            else{
                echo 'Login / Register';
            }
            ?>
            </a>
            </div>
            
            <div class="nav-cart" id="cartshowid" style="display:flex;"></div>
            
            

            
            
            
            
            </div>

        
      
    </div>
    
    
</div>

        
</div>
</header>


<nav class="container-fluid main-nav" id="nav">

        
        

        <div class="logo_text" id="logo_text">
            <h2><a href="https://allmart.world">All Mart</a></h2>
        </div>
        
        
        

        <ul  class="navbar-nav">
        
        <?php  $sql23 = mysqli_query($con1,"select * from main_cat where under ='0' and name!='Resale' and status=1 order by name"); 
        while($result23 =mysqli_fetch_array($sql23))
        {  ?> 
        <li class="nav-item dropdown">
        <a class="nav-link" href="#<?php echo $result23[0];?>" >
        	<?php  echo $result23['name'];?>(<? echo get_count($result23['id']); ?>)
		</a>
        
        <?php categories($result23[0],0); ?>
        </li>
        
        <?php } ?>
        </ul>
        
        
        

        <div class="nav-links">
  
  
            <div class="nav-profile">
            <a href="https://allmart.world/new_account/my-account.php" class="colored-btn">            
            <?
            if($_SESSION['fname']){
                echo 'Hello, '.$username;
            }
            else{
                echo 'Login / Register';
            }
            ?>
            </a>  
            </div>
            
            <div class="nav-cart" id="cartshowid1" style="display:flex;"></div>
            
        </div>



        </nav>
        
        
        <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("nav");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
        $(document).ready(function(){
            // var mar = document.getElementById('masthead').offsetHeight;
            
            // document.getElementById("nav").style.marginTop = mar+"px";
            
                    

        });
    
        </script>
        
        

        
<!--<div style="margin:5% auto"></div>-->