<?php 
    include('../config.php');
    

$id = $_GET['id'];

$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$mobile = $sql_result['mobile'];
$issue_date = $sql_result['full_pay_date'];

$_SESSION['visiting_mobile']=$mobile;

function get_image($id){
    
    global $con;
    

    $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];
}

function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_zone where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}

function get_division($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_division where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['division'];
}

function get_district($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}

function get_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_taluka where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}


function get_pincode($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}

function get_village($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_village where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['village'];
}


if($level==1){
    $level = 'Country';
    $level_id = 'India';
}
else if($level==2){
        $level = 'Zone';
        $level_id = $sql_result['zone'];
        $level_id = get_zone($level_id);
        
}
else if($level==3){
        $level = 'State';
        $level_id = $sql_result['state'];
        $level_id = get_state($level_id);
}
else if($level==4){
        $level = 'Division';
        $level_id = $sql_result['division'];
        $level_id = get_division($level_id);
}
else if($level==5){
        $level = 'District';
        $level_id = $sql_result['district'];
        $level_id = get_district($level_id);
}
else if($level==6){
        $level = 'Taluka';
        $level_id = $sql_result['taluka'];
        $level_id = get_taluka($level_id);
}
else if($level==7){
        $level = 'Pincode';
        $level_id = $sql_result['pincode'];
        $level_id = get_pincode($level_id);
}
else if($level==8){
        $level = 'Village';
        $level_id = $sql_result['village'];
        $level_id = get_village($level_id);
}



$image = get_image($id);

$image = str_replace('https://www.allmart.world/franchise/', '', $image);


 

    ?>
    
    
    <style>
            .member_position{
            background: #fcae007a;
        }

        .custom_table img{
            width: auto;
            height: 12px;
        }
    </style>



<div class="margin">
    
</div>




    <div  class="custom_body p-5 row">
        <div class="col-md-3">
            <div class="anoops">

            <div class="anoops-image">
                
            </div>	
            </div>

        

            <div class="name">
                <img src="img/certificate_0010_Anup-Ji-text.png" alt="">    
            </div>

        
        </div>


        <div class="col-md-6 custom_table">
                 <table  class="table-bordered" >
        
<tr class="heading-tr">
            <th style="width: 35%">Star</th>
            <th style="width: 20%">Place</th>
            <th style="width: 45%">Place Name</th>

        </tr>
        
            <tr <? if($lv_id ==1){ echo 'class="member_position"'; }?>> 
        <td>
            <?
            
            if($lv_id ==1){
            for($i=0;$i<8;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
            for($i=0;$i<8;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }
            }

            
            
            ?>
        </td>


             <td width="35%">Country</td>
             <td>India</td>
             
             
         </tr>
          <tr <? if($lv_id ==2){ echo 'class="member_position"'; }?>>
             <td>
            <? 
            if($lv_id ==2){
            for($i=0;$i<7;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }else{
            for($i=0;$i<7;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }            
            }
    
            ?>
        </td>
             <td >Zone</td>
             
             <td> <? echo get_zone($sql_result['zone']);?> </td>
          </tr>
          
          
          
          <tr  <? if($lv_id ==3){ echo 'class="member_position"'; }?> >
        <td>
            <? 
            if($lv_id ==3){
            for($i=0;$i<6;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
            for($i=0;$i<6;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }                
            }

            ?>
        </td>

             <td>State</td>
             <td> <? echo get_state($sql_result['state']);?> </td>
         </tr>
         
         
          <tr <? if($lv_id ==4){ echo 'class="member_position"'; }?>>
             <td>
            <? if($lv_id ==4){
                for($i=0;$i<5;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }
            }else{
                for($i=0;$i<5;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }
            }
            ?>
        </td>
        <td>Division</td>
             <td><? echo get_division($sql_result['division']);?></td>
          </tr>
          
          
          
          <tr <? if($lv_id ==5){ echo 'class="member_position"'; }?>>
             <td>
            <? 
            if($lv_id ==5){
            for($i=0;$i<4;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
            for($i=0;$i<4;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }
            }

            ?>
        </td>
             <td>District</td>
             <td><? echo get_district($sql_result['district']);?></td>
          </tr>
          
          
          <tr <? if($lv_id ==6){ echo 'class="member_position"'; }?> >
             <td>
            <? 
            if($lv_id ==6){
            for($i=0;$i<3;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }else{
            for($i=0;$i<3;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }
            }

            ?>
        </td>
             <td>Taluka</td>
             <td><? echo get_taluka($sql_result['taluka']);?></td>
          </tr>
          
          
          <tr <? if($lv_id ==7){ echo 'class="member_position"'; }?>>
                     <td>
            <? 
            if($lv_id ==7){
            for($i=0;$i<2;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }else{
            for($i=0;$i<2;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }
            }

            ?>
        </td>
             <td>Pincode</td>
             <td><? echo get_pincode($sql_result['pincode']);?></td>
          </tr>
          <tr <? if($lv_id ==8){ echo 'class="member_position"'; }?> >
    <td>
            <? 
            if($lv_id ==8){
            for($i=0;$i<1;$i++){ ?>
               <img src="../star_img/1%20star%20red.png"> 
            <? }                
            }
            else{
                for($i=0;$i<1;$i++){ ?>
               <img src="../star_img/blank.png"> 
            <? }
            }
            ?>
        </td>
    
             <td>Village</td>
             <td><? echo get_village($sql_result['village']);?></td>
          </tr>
          
     </table>


<div class="member-address">
<!--<p><?php echo $fetch['address']; ?></p>-->

</div>

        </div>
        <div class="col-md-3">
            <div class="member-praman">

        <div class="members-image" style="background:url('../<?php echo $image; ?>');background-size: cover; background-repeat: no-repeat; height: 100%; width: 100%;">

        </div>
                

            </div>

        
            <div class="name">
                <h3><?php echo ucwords($name);?></h3>
                <p class="committee_position">             Committee <?php echo $PositionFetch['dasignation_name']."-".$lev ; ?></p>
                <p class="committee_number"><?php echo $fetch['mobile']; ?></p>
                

                
                
            </div>
        </div>
    </div>
