<?php session_start();
include('function.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
thead {
    background: #3939bd;
    color: white;
}

.footer {
    background-image: url("download.jpg");
    color: #FFFFFF;
    font-size:.8em;
    margin-top:25px;
    padding-top: 15px;
    padding-bottom: 10px;
    position:fixed;
    left:0;
    bottom:0;
    width:100%;
}

</style>
    <style>
    
body {
    display: flex;
  flex-direction: column;
    
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #ffd942;
}

</style>
<title>Dash Board</title>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  



<?php include 'header.php'; ?>

<link rel="stylesheet" type="text/css" href="style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">
</head>



<body style="background-color: #e0fde0;" >
  <div class="container">  <div class="footer">
  <p align="left" style="margin-bottom: 2px;padding-left: 18px;">CSS</p>
</div></div>
<?php include('menu.php') ?>


<div style="margin:1%"></div>
<style>
    section{
            background: white;
                padding: 10px;
                margin: 2%;
    }
</style>
<section>
    
    <?
    $id=$_REQUEST['id'];
    $sql = mysqli_query($css,"select * from boq_raise where id='".$id."' and status=1");
    $sql_result = mysqli_fetch_assoc($sql);
    
        $atmid = $sql_result['atmid'];
        $atmid2 = $sql_result['atmid2'];
        $atmid3 = $sql_result['atmid3'];
        $serial_number = $sql_result['serial_number'];
        $bank = $sql_result['bank'];
        $customer = $sql_result['customer'];
        $address = $sql_result['address'];
        $city = $sql_result['city'];
        $state = $sql_result['state'];
        $pincode = $sql_result['pincode'];
        $engineer = $sql_result['engineer'];
        $engineer_number = $sql_result['engineer_number'];
        $bm_name = $sql_result['bm_name'];
        $selection_type = $sql_result['selection_type'];
        $status = $sql_result['status'];
        $created_at = $sql_result['created_at'];
        $created_by = $sql_result['created_by'];
        $updated_at = $sql_result['updated_at'];
        $updated_by = $sql_result['updated_by'];
        


    
    ?>

        <h4>PROJECT TRACKER</h4>
        <hr>                                        
        <div class="view-info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="general-info">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table" border="1">
                                        <tbody>
                                            <tr>
                                                <th scope="row">ATMID </th>
                                                <td><? echo $atmid;?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ATMID 2 </th>
                                                <td><? echo $atmid2;?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ATMID 3</th>
                                                <td><? echo $atmid3;?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">TRACKER NUMBER</th>
                                                <td><? echo $serial_number;?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">BANK</th>
                                                <td><? echo $bank?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">CUSTOMER</th>
                                                <td><? echo $customer; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end of table col-lg-6 -->
                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table" border="1">
                                        <tbody>
                                            <tr>
                                                <th scope="row">CITY</th>
                                                <td>
                                                    <span><? echo $city; ?></span>
                                                </td>
                                            </tr>
                                            
                                                <tr><th scope="row">STATE</th>
                                                <td><? echo $state; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">PINCODE </th>
                                                <td><? echo $pincode; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ADDRESS</th>
                                                <td><? echo $address; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ENGINEER NAME & NUMBER</th>
                                                <td><? echo $engineer .'( '. $engineer_number . ' )' ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">BM NAME</th>
                                                <td><? echo $bm_name; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end of table col-lg-6 -->
                        </div>
                        <!-- end of row -->
                    </div>
                    <!-- end of general info -->
                </div>
                <!-- end of col-lg-12 -->
            </div>
            <!-- end of row -->
        </div>
</section>

<section>
    <form action="prcesss_update_incoming_boq.php" method="POST">
        <input name="id" type="hidden" value="<? echo $id; ?>">
    
    <?
    $i = 1 ; 
    $info_sql = mysqli_query($css,"select * from boq_raise_detail where boq_id='".$id."' and status=1");
    while($info_sql_result = mysqli_fetch_assoc($info_sql)){
        $material = $info_sql_result['material'];
        $qty = $info_sql_result['qty'];
        $reamrk = $info_sql_result['remark'];
        $boq_id = $info_sql_result['id'];
        ?>
        <input name="boq_id[]" value="<? echo $boq_id; ?>" type="hidden">
        
        <div class="row highlight kacha_items">
        	<div class="col-sm-6 material">
        	<label><? echo $i; ?>. Material</label>
        	<input type="text" list="boq_list" name="material[]" class="form-control" value="<? echo $material; ?>" readonly>
        	</div>
        	
        	<div class="col-sm-2 serial_number">
        	<label>Serial Number</label>
        	<input type="text" name="serial_number[]" class="form-control">
        	</div>
        	
        	<div class="col-sm-1 qty">
        	<label> Quantity </label>
        	<input type="text" name="qty[]" class="form-control" value="<? echo $qty; ?>" readonly>
        	</div>
        	
        	<div class="col-sm-3  remark">
        	<label>Remark</label>
        	<input type="text" name="remark2[]" class="form-control" value="<? echo $remark; ?>">
        	</div>
        </div>
        
    <? $i++; } ?>
    <div class="col-sm-12">
        
        <label>Remark</label>
        <input type="text" name="not_remark" class="form-control">
        
        
        <br>
        
        <input type="submit" name="submit" class="btn btn-success">
    </div>
    </form>
</section>

<? } ?>


<style>
.footer{
    background:#002a5f;
    z-index:1000;
}
.highlight {
    position: relative;
}

.highlight {
    padding: 10px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    margin: 20px auto;
}
.form-control:focus {
    color: #55595c;
    background-color: #fff;
    border-color: #66afe9;
    outline: none;
    box-shadow: none;
    border: none;
}

.form-control:focus, input.form-control, input, select.form-control, select {
    background: transparent;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    outline: 0;
}
input:focus, select:focus {
    border-bottom: 1px solid red !important;
}

.form-control:focus, input.form-control, input, select.form-control, select {
    background: transparent;
}
input.form-control, input, select, select.form-control {
    border: none;
    ser: ;
    margin: 10px auto;
    border-bottom: 1px solid #ac9292;
}
.form-control {
    font-size: 16px;
    border-radius: 2px;
    border: 1px solid #ccc;
        box-shadow: none;
}
.form-control {
    font-size: 13px !important;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>

<script src="datatable/jquery.dataTables.js"></script>
<script src="datatable/dataTables.bootstrap.js"></script>
<script src="datatable/dataTables.buttons.min.js"></script>
<script src="datatable/buttons.flash.min.js"></script>
<script src="datatable/jszip.min.js"></script>

<script src="datatable/pdfmake.min.js"></script>
<script src="datatable/vfs_fonts.js"></script>
<script src="datatable/buttons.html5.min.js"></script>
<script src="datatable/buttons.print.min.js"></script>
<script src="datatable/jquery-datatable.js"></script>


</body>
</html>
