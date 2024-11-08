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

    $qry =mysql_query("SELECT * FROM merchant_offers where status=1");
   /* $result = mysql_fetch_array($qry);*/
    $num_rows = mysql_num_rows($qry);echo $num_rows;
    /*var_dump($result);exit;*/
   
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div class="container">
            <div class="">
                <div class="row">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Sr no</th>
                          <th scope="col">Type</th>
                          <th scope="col">Period</th>
                          <th scope="col">Rate</th>
                          <th scope="col">Discount</th>
                          <th scope="col">City</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                            $cnt = 1;
                            while($row=mysql_fetch_assoc($qry)) { 
                           /* var_dump($row);*/
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $cnt ;?>
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" >
                                </th>
                                <td>
                                    <?php echo $row['type'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['period'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['rate'] ;?>
                                </td>
                                <td>
                                    <?php echo $row['discount'] ;?>
                                </td>
                                <td>
                                    <?php 
                                        $get_city = mysql_query("select * from cities where code = ".$row['city']);
                                        $city = mysql_fetch_assoc($get_city); 
                                        echo $city['name'] ;
                                    ?>
                                </td>
                                <td>
                                    <?php /*<?php if($row['status'] == 1){ ?>
                                        <input type="hidden" name="status" id="status" value="">
                                        <a href="add_subscription_process.php?id=<?php echo $row['sid'];?>&st=0" >
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                        </a> 
                                    <?php } else { ?>
                                    <input type="hidden" name="status" id="status" value="">
                                    <a href="add_subscription_process.php?id=<?php echo $row['sid'];?>&st=1" > 
                                        <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                     </a> 
                                    <?php } ?> */ ?>
                                    <a href="add_offers.php"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    <a href="add_offers.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        <?php $cnt++; } ?>
                      </tbody>
                    </table>
                 </div>
             </div>
        </div>
    </body>
</html>