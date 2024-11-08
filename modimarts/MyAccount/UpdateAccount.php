<?php
session_start();
include '../head.php';
if (!isset($_SESSION['gid'])) {
    ?>
  <script>
    alert('Login Please');
    window.location.href="https://allmart.world/login.php";
  </script>
  <?php
} else {
    $user_id = $_SESSION['gid'];

    function get_reg_details($parameter,$id){

    global $con1;
    
    $sql = mysqli_query($con1,"SELECT $parameter FROM `Registration` WHERE `id` ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}
}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" /> -->
<style>
  .nav-side-menu {
  overflow: auto;
  font-family: Poppins;

  font-weight: 200;
  background-color: white;
  /*position: absolute;*/
  /*top: 0px;*/
  width: 300px;
  /*height: 100%;*/
  color: black;
}
.nav-side-menu .brand {
  background-color:white;
  line-height: 50px;
  display: block;
  text-align: center;
  color: black;
  font-weight: bold;

}
.nav-side-menu .toggle-btn {
  display: none;
}
.nav-side-menu ul,
.nav-side-menu li {
      list-style: none;
    padding: 6px;
    margin: 6px;
    line-height: 35px;
    cursor: pointer;
    font-weight: bold;
    margin-left: 0;
    padding-left: 0;
    padding-right: 0;
    margin-right: 0;
  /*
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: FontAwesome;
  content: "\f078";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
}
.nav-side-menu ul .active,
.nav-side-menu li .active {
  border-left: 3px solid #d19b3d;
  background-color: #4f5b69;
}
.nav-side-menu ul .sub-menu li.active,
.nav-side-menu li .sub-menu li.active {
  color: #d19b3d;
}
.nav-side-menu ul .sub-menu li.active a,
.nav-side-menu li .sub-menu li.active a {
  color: #d19b3d;
}
.nav-side-menu ul .sub-menu li,
.nav-side-menu li .sub-menu li {
  background-color: white;
  border: none;
  line-height: 28px;
  border-bottom: 1px solid #23282e;
  margin-left: 0px;
}
.nav-side-menu ul .sub-menu li:hover,
.nav-side-menu li .sub-menu li:hover {
  background-color: gray;
}
.nav-side-menu ul .sub-menu li:before,
.nav-side-menu li .sub-menu li:before {
  font-family: FontAwesome;
  content: "\f105";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
}
.nav-side-menu li {
  padding-left: 0px;
  border-left: 3px solid #2e353d;
  border-bottom: 1px solid #23282e;
}
.nav-side-menu li a {
  text-decoration: none;
  color: black;
}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}
.nav-side-menu li:hover {
  border-left: 3px solid #d19b3d;
  background-color: whitw;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -o-transition: all 1s ease;
  -ms-transition: all 1s ease;
  transition: all 1s ease;
}
@media (max-width: 767px) {
  .nav-side-menu {
    position: absolute;
    width: 100%;
    margin-bottom: 10px;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    /*position: absolute;*/
    right: 10px;
    top: 10px;
    z-index:20 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;

    padding-left: 20px;
    line-height: 50px !important;
  }
}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}
body {
  color: #313131;
    letter-spacing: 0em;
    font-family: Poppins;
    font-weight: normal;
    font-size: 14px;
    line-height: 1.8;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
}

</style>
      <main class="main-content">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="z-index:2">
            <div class="nav-side-menu">
          <div class="brand">My Account</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li >
                  <a href="https://allmart.world/MyAccount/index.php">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                  </a>
                </li>
                 <li class="active">
                  <a href="https://allmart.world/MyAccount/UpdateAccount.php">
                  <i class="fa fa-dashboard fa-lg"></i>Update Profile
                  </a>
                </li>
                <li>
                  <a href="https://allmart.world/MyAccount/UpdatePassword.php">
                  <i class="fa fa-dashboard fa-lg"></i>Update Password
                  </a>
                </li>
                 <li>
                  <a href="https://allmart.world/MyAccount/MyOrder.php">
                  <i class="fa fa-dashboard fa-lg"></i>My Order
                  </a>
                </li>
                 <li>
                  <a href="../My_cart.php">
                  <i class="fa fa-dashboard fa-lg"></i>Go To Cart
                  </a>
                </li>
                <li>
                  <a href="https://allmart.world/MyAccount/EditAddress.php">
                  <i class="fa fa-dashboard fa-lg"></i>Update Shipping Details
                  </a>
                </li><li>
                  <a href=".,/logout.php">
                  <i class="fa fa-dashboard fa-lg"></i>Logout
                  </a>
                </li>


            </ul>
       </div>
      </div>
    </div>
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="margin-top: 100px;position: unset">
        <div class="container">
          <h3>Primary Billing address</h3>
          <?php
                            $user_id=$_SESSION['gid'];
                            $address_sql = mysqli_query($con1,"select * from address where userid = '".$user_id."'");
                            $address_sql_result = mysqli_fetch_assoc($address_sql);
                          $fname = get_reg_details('Firstname',$userid); 
                            $lname = get_reg_details('Lastname',$userid);
                            $email = get_reg_details('email',$userid);
                            $mobile = get_reg_details('mobile',$userid);
                            $address = $address_sql_result['address'];
                            $pincode = $address_sql_result['pincode'];
                            $landmark = $address_sql_result['landmark'];
                            $state = $address_sql_result['state'];
                            $city = $address_sql_result['city'];
                            $is_primary = $address_sql_result['is_primary'];
                            
          ?>
          <form action="UpdateAccountProcess.php" method="post">
                      <div class="row form-group">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>First name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" value="<?=$fname?>" name="fname" id="" required>                           
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Last name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control"  value="<?=$lname?>" name="lname" id="" required>                           
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Phone Number <span class="text-danger">*</span></label>
                              <input type="Number" class="form-control"  value="<?=$mobile?>" name="phone" id="mob" required>                           
                          </div>
                        </div>
                         <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Email <span class="text-danger">*</span></label>
                              <input type="email" class="form-control"  value="<?=$email?>" name="email" id="" readonly required>                           
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Street address <span class="text-danger">*</span></label>
                              <textarea name="address" id="" cols="30" rows="10"  class="form-control" required><?=$address?></textarea>
                          </div>
                        </div>

                        
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>State <span class="text-danger">*</span> </label>
                              <select name="state" class="form-control" required>
                                    <option>Select State</option>
                                    <?php $state_sql = mysqli_query($con1,"SELECT * FROM `states` ORDER BY `states`.`state_name` ASC");
                                    while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
                                      <option value="<? echo $state_sql_result['state_name'];?>" <? if($state_sql_result['state_name'] == $state){ echo 'selected'; }?>>
                                            <?=$state_sql_result['state_name'];?>
                                        </option>
                                    <? } ?>
                                    </select>                                                        
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>City <span class="text-danger">*</span></label>
                              <input type="text" class="form-control"  value="<?=$city?>" name="city" id="" required>                           
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Landmark <span class="text-danger">*</span></label>
                              <input type="text" class="form-control"  value="<?=$landmark?>" name="landmark" id="" required>                           
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label>Pincode/Zipcode <span class="text-danger">*</span></label>
                              <input type="text" class="form-control"  value="<?=$pincode?>" name="postcode" id="pincode" required>                           
                          </div>
                        </div> 
                        <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group">                              
                              <input type="submit" class="btn btn-primary" onclick="return check()" name="UpdateAccount" value="Submit" >                           
                          </div>
                        </div>

                      </div> 
                      </form>                  
               </div>
      </div>
          </div>
        </div>
        
        <script>
          function check()
          {
            var mobNum=$('#mob').val();

          var filter = /^\d*(?:\.\d{1,2})?$/;

          if (filter.test(mobNum)) {
            if(mobNum.length==10){
              var pincode=$('#pincode').val();
              if (pincode.length==6) {
                 return true;
              }
              else
              {
               alert('Please enter valid Pincode');
               return false; 
              }
             
                  
             } else {
                alert('Please put 10  digit mobile number');
               return false;
              }
            }
            else {
              alert('Not a valid number');              
              return false;
           }
          }
        </script>
                 
        <!-- /#page-content-wrapper -->



        <!-- <div class="dt-sc-hr-invisible-large"></div> -->

      </main>

<?php include '../footer.php';?>