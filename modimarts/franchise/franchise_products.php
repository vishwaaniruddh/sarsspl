<?php session_start();
include('ecommerce_config.php');

if(isset($_SESSION['id']))
{
      $usrid=$_SESSION['id'];
      $upd="SELECT * FROM `new_member` WHERE  id='".$usrid."' ";
      $runsql=mysqli_query($con_web,$upd) or  die(mysqli_error($con_web));
      $sql_result = mysqli_fetch_assoc($runsql);
      $payamount=$sql_result['payment_received'];
} 
else
{
    ?>
    <script> 
      alert('Login Please');
      // update member purchase product
      window.location.href = 'get_members.php';
      </script>
      <?php
}     
function get_kit_info($id,$parameter) {
    
    global $con_web;
     
    $sql = mysqli_query($con_web,"select $parameter from kits where code ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
     
    return $sql_result[$parameter];
    
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>AllMart | Franchise</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Sweetalert Css -->
    <link href="https://allmart.world/franchise/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

</head>


<script>
if (!!window.performance && window.performance.navigation.type === 2) {
    // value 2 means "The page was accessed by navigating into the history"
    // console.log('Reloading');
    window.location.reload(); // reload whole page

}
</script>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    background-color: rgb(240, 240, 240);
    scroll-behavior: smooth;
}

/* Style the top navigation bar */
.heading {
    overflow: hidden;
    background-color: red;
    padding-top: 10px;
}

/* Style the topnav links */
.heading a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    text-decoration: none;
    font-size: 50px;

}

/* Change color on hover */
.heading a:hover {
    color: black;
}

.main {
    background-color: white;
    padding: 20px;
    box-shadow: 5px 10px #888888;
}


table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: center;
    padding: 8px;
    /*white-space: nowrap;*/
    border: 1px solid;
}

input {
    width: 140px;
    margin-bottom: 10px;
}


#member_pic img {
    height: 150px;
}



@media only screen and (max-width: 768px) {
    .col {
        margin-top: 20px;
    }

    .row {
        display: flex;
        flex-direction: column;
    }
}




/* Style the footer */
.footer {
    background-color: red;
    padding: 10px;
    text-align: center;
    padding: 30px;
    height: 280px;
    padding-left: 20px;
    padding-right: 20px;

}

.contact_us {
    color: white;
    line-height: 30px;
    font-size: 18px;
    margin-top: 20px;

}


.social_a {
    text-decoration: none;
    color: white;
}

.social_label {
    margin-left: 10px;
    margin-right: 10px;
    padding: 20px;

}

.heading {
    display: flex;
}

.logo {
    width: 30%;
}

.menu {
    width: 70%;
}

.menu ul {
    float: right;
}

.menu_ul {
    padding: 0;
    margin: 3%;
    list-style-type: none;
}

.menu ul li a {
    font-size: 18px;
}

.menu_ul {
    width: 100%;
    display: flex;
    justify-content: flex-end;
}

.menu_ul li {
    margin: auto 2%;
}

.custom_row {
    display: flex;
}

.col input,
.col select {
    width: 100%;
}

.cust_col {
    padding-left: 1%;
    padding-right: 1%;
}

.typeahead li a {
    font-size: 14px;
}


input {
    border-left: none;
    border-top: none;
    border-right: none;
}

input:focus {
    border-left: none;
    border-top: none;
    border-right: none;
}

#myModal td {
    text-align: left;
}

.sweet-alert button {
    margin: 0 !important;
    font-size: 12px !important;
}

.sweet-alert h2 {
    font-size: 20px !important;
    margin: 10px 0 !important;
}

.confirm {
    font-size: 18px;
    color: red;
    font-weight: 700;
}

.heading a:hover {
    color: cyan;
}

.nav>li>a:focus,
.nav>li>a:hover {
    background-color: red;
}


ul.typeahead {
    width: 100%;
}

#franchise_of {
    text-align: center;
    color: red;
    text-decoration: underline;
    font-weight: 700;
}
</style>
<style>
.single-product .product-img .product-action-2 a {
    color: white;
}

.single-product .product-img .product-action-2 {
    left: 8%;
    bottom: 42%;
}

.single-product .button-head {
    background: gray;
}

.card {
    height: 366px;
    width: 100%;
}

.single-product .product-content {
    margin-top: 0px;
}

.single-product .product-content h3 {
    line-height: 10px;
}

.single-product {
    margin-top: 50px;
}
</style>

<body>
    <div class="heading" style="padding-top:0px !important;">
        <div class="logo">
            <a href="https://allmart.world/franchise/get_members.php" style="padding:10px;"><img
                    src="https://allmart.world/assets/allmart.png" alt=""
                    style="width: 105px; padding:5px;background:white;"><span
                    style="font-size:0.7em;padding:10px;">Allmart.world</span></a>
        </div>
        <div class="menu">
            <?php include('menu.php');?>
        </div>
    </div>
    <?php
      $qrygetvalueproduct = mysqli_query($con1,"select * from products where category ='803' and status=1 "); 
      $total_records = mysqli_num_rows($qrygetvalueproduct);
?>
    <section class="product-area shop-sidebar shop section">
        <div class="container">
       
            <?php


        $user=$_SESSION['id'];
        $check="SELECT * FROM `franchise_product` WHERE franchise_id='".$user."'";
        $result=mysqli_query($con_web,$check);
        $rowcount=mysqli_num_rows($result);
        if($rowcount){

        
            $rws2=mysqli_fetch_assoc($result);
            $product_ids=$rws2['product_ids'];
           $proid=explode(',',$product_ids);
           $prices = explode(', ', $rws2['amounts']);
           $quntitys = explode(', ', $rws2['quantities']);

           for ($i=0; $i < count($proid) ; $i++) { 


            $quntity=$quntitys[$i];
            $amount=$prices[$i];

            $proiddata=explode('/',$proid[$i]);
         $prod_id=trim($proiddata[2]);
         
         $pid=trim($proiddata[0]);
         
        $cid=trim($proiddata[1]);
     
        

//=================================================== query for get category which under 0 =================================================

 $qrylatf="SELECT `code`, `name`, `ccode`, `description`, `category`, `photo`, `price`, `others`, `discount`, `discount_type`, `total_amt`, `color` ,`size`,Long_desc,shipping_in_area,shipping_out_state FROM `products` WHERE code='".$pid."'";


/*Date:26/02/2021*/
/*$descriptionQry = mysqli_query($con1,"select description,others,Long_desc,shipping_in_area from product_model where id='".$prod_id."'");*/


     $qrylatfrws=mysqli_query($con1,$qrylatf);   
     

     $latstprnrws=mysqli_fetch_array($qrylatfrws);
    //  var_dump($latstprnrws);

    $prod = mysqli_query($con1,"SELECT product_model FROM product_model where id='".$latstprnrws['name']."'");
    $product_name = mysqli_fetch_assoc($prod);
    $sqlimg23mn=mysqli_query($con1,"SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='".$pid."'");
    $frtu=mysqli_fetch_assoc($sqlimg23mn);


    $qry=mysqli_query($con1,"SELECT product_specification,specificationname from productspecification where product_id='".$pid."'");

                $amount = $latstprnrws['total_amt'];
                 $pro_name = $product_name['product_model'];
                $pro_img =  'https://allmart.world/ecom/'.$frtu['img'];

            
            ?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-product card">
                    <div class="product-img">
                        <a href="product_detail.php?pid=<?=$pid?>&catid=<?=$catid?>&prod_id=<?=$prod_id?>">
                            <img class="default-img" style="width: 100%;object-fit: contain;height: 256px;"
                                src="<?php echo $pro_img;?>" alt="">
                        </a>
                    </div>
                    <div class="product-content one">
                        <h3 style="text-align:center;">
                            <a href="">
                                <?php 
                    echo $pro_name;
               ?>
                            </a>
                        </h3>
                        <div class="product-price" style="text-align:center;">
                            <span>₹<?php echo $amount;?></span>
                            <br/>
                            <input type="text" value="<?=$quntity?>" readonly class="form-control" style="width:50%;text-align:center;">
                        </div>
                    </div>
                </div>
            </div>
            <?php
           }
            

            ?>

            <?php
         }
            else{ 
            ?>
            <div class="row">
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="shop-top">
                                <div class="shop-shorter mt-5">
								    <div class="single-shorter">
										<label>Sort By Price:</label>
										<select id='sort' name='sort'  onchange="getval(this);">
											<option id="1" value='1' selected = "selected">Higher to lower</option>
											<option id="2" value='2'>Lower to Higher</option>
										</select>
										<input type="hidden" name="filter_type" id="filter_type" value="0">
									</div>
									
									<div class="single-shorter" >
									    <label>Total products : <?php echo $total_records;?>
										<label id="total" style="display:none;"> <?php echo $total_records;?></label>
									</div>
									
								</div>

                            </div>
                        </div>
                    </div>
                    <?php include('config.php'); ?>
                    <form action="franchise_product_process.php" method="post">
                        <div class="row" id="results"> </div>
                        <div id="loader_message"></div>
                </div>
                <!--	<div class="col-lg-12" id="results"></div> -->
                <div id="loader_image">
                    <!--<img src="loader.gif" alt="" width="24" height="24">-->
                </div>
                <div class="margin10"></div>

                <input type="text" id="totalamt" readonly>
                <input type="hidden" id="payamount" value="<?=$payamount?>" placeholder="pay amount by franchise">
                <button type="Submit" id="sbmtbtn" class="btn btn-primary btn-lg">Submit</button>
                </form>
                <input type="hidden" name="total_record" id="total_record" value="0">

            </div>
            <?php 

                  }
                ?>
        </div>
    </section>
    <script type="text/javascript">
    var busy = false;
    var limit = 15
    var offset = 0;
    var catid = 803;

    function displayRecords(lim, off, filter) {
        var total_record = document.getElementById('total_record').value;
        $.ajax({
            type: "GET",
            async: false,
            url: "get_franchise_products.php",
            data: "limit=" + lim + "&offset=" + off + "&catid=" + catid + "&filter=" + filter +
                "&total_record=" + total_record,
            cache: false,
            beforeSend: function() {
                $("#loader_message").html("").hide();
                $('#loader_image').show();
            },
            success: function(html) {
                $("#results").append(html);
                $('#loader_image').hide();
                var total = document.getElementById('total_record').value;
                console.log(total);
                if (offset >= total) {
                    $("#loader_message").html(
                        '<button class="btn btn-default" type="button">No more records.</button>')
                    .show()
                } else {
                    $("#loader_message").html(
                            '<button class="btn btn-default" type="button">Loading please wait...</button>')
                        .show();
                }
                window.busy = false;
            }
        });
    }

    $(document).ready(function() {
        // start to load the first set of data
        filter = document.getElementById('filter_type').value;
        if (busy == false) {
            busy = true;
            // start to load the first set of data
            displayRecords(limit, offset, filter);
        }

        $(window).scroll(function() {
            // make sure u give the container id of the data to be loaded in.
            if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
                busy = true;
                offset = limit + offset;

                // this is optional just to delay the loading of data
                setTimeout(function() {
                    displayRecords(limit, offset, filter);
                });

                // you can remove the above code and can use directly this function
                // displayRecords(limit, offset);

            }
        });
        /*  var total_records = document.getElementById('total_record').value;
          alert(total_records);
          var totalloadrecord = document.getElementsByClassName("totalnorecord").value;
          alert(totalloadrecord);
          var total = total_records + totalloadrecord; */
        //  $('#total').text("Total Products : "+totalloadrecord);
    });

    function getval(id) {
        var filter = id.value;
        document.getElementById('filter_type').value = filter;
        displayRecords(15, 15, filter);
    }
    </script>

    <script>
    $('#results').change(function() {
        var values = 0.00; {
            $(".pricebox:checkbox:checked").each(function() {
                // console.log($(this).attr("id"));
                values = values + parseFloat($(this).data("price"));
            });
        }
        var totalamt = parseFloat(values);
        $("#totalamt").val(totalamt);
        
        var amt=$("#payamount").val();

        if(totalamt>amt)
        {
            alert("You Selected More Then You Pay");
            $('#sbmtbtn').prop('disabled', true);
        }
        else
        {
            $('#sbmtbtn').prop('disabled', false);

        }
    });
    </script>
</body>

</html>