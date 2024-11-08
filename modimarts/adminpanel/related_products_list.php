<?php
session_start();
include 'config.php';
include 'adminaccess.php';
  $group_id=$_GET['groupid'];
            $proopt=mysqli_query($con1,"SELECT * FROM `related_product_group` WHERE id='".$group_id."'")or die(mysqli_error($con1));
            $retresult=mysqli_fetch_assoc($proopt);
           $relatedname= $retresult['groupname'];

          
           function getproductsdata($cid,$pid)
          {
              global $con1;

              $qrya = "select * from main_cat where id='" . $cid . "'";

              $resulta = mysqli_query($con1, $qrya);
              $rowa    = mysqli_fetch_row($resulta);

              $aa = $rowa[2];

              if ($cid == 80) {
                      $maincatid = 5;

                  } else {
              if ($aa != 0) {
                  $qrya1    = "select * from main_cat where id='" . $aa . "'";
                  $resulta1 = mysqli_query($con1, $qrya1);
                  $rowa1    = mysqli_fetch_row($resulta1);
                  $Maincate = $rowa1[4];
              }
                      if ($Maincate == 1) {
                          $qrylatf = "SELECT * FROM `fashion` WHERE code='" . $pid . "'";
                      } else if ($Maincate == 190) {
                          $qrylatf = "SELECT * FROM `electronics` WHERE code='" . $pid . "'";
                      } else if ($Maincate == 218) {
                          $qrylatf = "SELECT * FROM `grocery` WHERE code='" . $pid . "'";
                      } else if ($Maincate == 760) {
                          $qrylatf = "SELECT * FROM `kits` WHERE code='" . $pid . "'";
                      }
                      else if ($Maincate == 767) {
                          $qrylatf = "SELECT  * FROM `promotion_product` WHERE code='" . $pid . "'";
                      } else {
                          $qrylatf = "SELECT  * FROM `products` WHERE code='" . $pid . "'";
                      }
              }
              $qrylatfrws = mysqli_query($con1, $qrylatf);

              $latstprnrws = mysqli_fetch_array($qrylatfrws);
              return $latstprnrws['offer_price'];

//               $prod         = mysqli_query($con1, "SELECT product_model FROM product_model where id='" . $latstprnrws['name'] . "'");
// $product_name = mysqli_fetch_assoc($prod);
              
          }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>


<!-- <![if !IE 7]>   -->

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>


<!-- <![endif]> -->

<!--  styled select box script version 2 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>


<!--  styled select box script version 3 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>


<!--  styled file upload script -->
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>


<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>

<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>


<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>

<style>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>
<body>

<!-- End: page-top-outer -->

<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php  include 'header.php';?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="container">
<h4>Related Product (<?=$relatedname?>)</h4>
    <div class="row">
        <div class="col-md-9">
          <input type="hidden" name="groupid" id="groupid" value="<?=$_GET['groupid']?>">
        <table class="table table-bordered">
            <tr>
                <th>S. No</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>price</th>
                <th>Option</th>
                <th>Option</th>
            </tr>
            <tbody id="getdata">
            <?php 
            $group_id=$_GET['groupid'];
            $proopt=mysqli_query($con1,"SELECT * FROM `related_group_products` WHERE group_id='".$group_id."'")or die(mysqli_error($con1));
            $cnt = 1;
            while($row=mysqli_fetch_assoc($proopt)) {
            ?>
            <tr>
                <td><?=$cnt?></td>
                <td><?=$row['product_name']?></td>
                <td><?=$row['cat_id']?></td>
                <td><?php echo getproductsdata($row['cat_id'],$row['pro_id'])?></td>
                <td><?=$row['product_status']?></td>
                <td><label class="switch">
                <input type="checkbox" id="<?=$row['id']?>" onchange="checkstatus(this)" <?php if($row['product_status']==1){ echo "checked";}?>>
                <span class="slider round"></span>
                </label></td>
            </tr>
            <?php $cnt++; } ?>
            </tbody>
        </table>
        </div>
        <div class="col-md-3">
        <input type="text" placeholder="Please Type of product name" class="form-control" onkeyup="featchpro(this.value)"> 
        <div >
        <ul id="searchresult">
        </ul>
        </div>
        </div>
    </div>
</div>

<script>
function featchpro(val)
{
    var minchar=1;
    if(val.length>=minchar)
    {

        $.ajax({
            url: "featchproduct.php",
            type: 'post',
            data: {search:val},
        success: function(response){
        // alert(response);
        $("#searchresult").html(response);

        }
        }) 
    }    
    }

</script>

<script>
function AddExtraOption(prodname,pid,catid,proid,price,pro_img,)
{
  var groupid = $("#groupid").val();
    $.ajax({
            url: "addrelated_option.php",
            type: 'post',
            data: {prodname:prodname,proid:proid,catid:catid,pid:pid,price:price,type:'1',pro_img:pro_img,groupid:groupid},
        success: function(response){
        // alert(response);
        if(response==1)
        {
            getdata(groupid);
            alert("Product Added Successfully");
        }
       else
        {
            getdata(groupid);
        }
        }
        }) 
    
}
</script>

<script>
function getdata(data)
{
    $.ajax({
            url: "get_pro_related.php?data="+data,
            type: 'post',
        success: function(response){
        // alert(response);
        $("#getdata").html(response);
        }
        }) 
    
}
</script>

<script>
function checkstatus(val)
{

  var groupid = $("#groupid").val();
    var id=$(val).attr('id');
    if(val.checked) {

        $.ajax({
            url: "related_product_status.php",
            type: 'post',
            data: {id:id,status:'1',type:'1'},
        success: function(response){
            getdata(groupid);
            alart(response);
        }
        }) 

        // alert("checked");
    }else{
        $.ajax({
            url: "related_product_status.php",
            type: 'post',
            data: {id:id,status:'0',type:'1'},
        success: function(response){
            getdata(groupid);
            alart(response);
        }
        }) 
        // alert("UNchecked");
    }

    // alert($(val).attr('id'));

}
</script>



</body>
</html>