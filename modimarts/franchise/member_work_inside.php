<?php session_start(); //Start the session

include ("config.php");


$state=$_POST['State'];
$city=$_POST['City'];
$district=$_POST['District'];
$pincode=$_POST['Pincode'];
$village=$_POST['village'];
$taluka=$_POST['talukaa'];
$zone=$_POST['Zone'];
$country=$_POST['country'];
$hdLevel=$_POST['hdLevel'];
$hdLoc=$_POST['hdLoc'];
$condition='';
$loc_id='';
$level_id='';
//echo 'state'.$State;
if($country!=''){
    $loc_id=$country;  
    $level_id=1;
}
if(($zone!='')){
    $loc_id=$zone;
    $level_id=2;
} 
if(($state!='')){
    $loc_id=$state;
    $level_id=3;
}
if(($city!='')){
    $loc_id=$city;
    $level_id=4;
} 
if(($district!='')){
    $loc_id=$district;
    $level_id=5;
} 
if(($taluka!='')){
    $loc_id=$taluka;
    $level_id=6;
} 
if(($pincode!='')){
    $loc_id=$pincode;
    $level_id=7;
} 
if(($village!='')){
    $loc_id=$village;
    $level_id=8;
} 
if(isset($_POST['edit'])){
    $query="select * from member where id=".$_POST['id'];
    $data=mysqli_query($conn,$query);
}

$View="select * from committee_structure where 1=1 order by id";
$table=mysqli_query($conn,$View);
$Num_Rows = mysqli_num_rows ($table);

?>
<form  method="post" action="member.php"  id="form_respons" style="width: 100%;">
    <?php if($hdLevel==1){
        $table1="country";
    }else if($hdLevel==2){
         $table1="zone";
    }else if($hdLevel==3){
         $table1="state";
    }else if($hdLevel==4){
         $table1="city";
    }else if($hdLevel==5){
         $table1="district";
    }else if($hdLevel==6){
         $table1="taluka";
    }else if($hdLevel==7){
         $table1="pincode";
    }else if($hdLevel==8){
         $table1="village";
    }
    
    $qryLevel1="select $table1 from $table1 where  id='".$hdLoc."' ";
    
    $run1=mysqli_query($conn,$qryLevel1);
    if($run1){
    $fetchloc1=mysqli_fetch_array($run1);
    
    }
?>  
    <style>
        .fade{
            opacity:1;
        }
    </style>
    <div id="commity_respons"  style="width:100%;" >
        <div>
          <div class="tab-content" style="width:100%;">
            <div id="committee_list" class="">
              <h3 style="margin-top: 18px; font-family: serif;">Committee of - <? echo $fetchloc1[$table1];?></h3>
              
              <table align="center" class=" table-bordered table-striped" id="com_T" style="width: 100%;">
                <tr>
                    <th class="th-prop">Position No.</th>
                    <th class="th-prop">Sr. No.</th>
                    <th class="th-prop">Position Name</th>
                    
                    <th class="th-prop">Profile</th>
                    <th class="th-prop">Name</th>
            
                    <th class="th-prop">Status</th>
                    <th class="th-prop">Contribution Nights</th>
                    
                    
                    <th class="th-prop">Apply committee</th>
                    <th class="th-prop">Apply WaitList</th>
                   <th class="th-prop">Contribution</th>
                    <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){ ?>
                    <th class="th-prop">Action</th>
                    <?php } ?>
                      <th class="th-prop" style="background:white;">Visiting Card</th>
                    <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){ ?>
                      <th class="th-prop">Praman Patra</th>
                      <?php } ?>
               </tr>
                <?php 
                     $srn=1;
                    $cn=0;
                    $i = 1;
                    
                while($i<=11){ 
                    
                        $countSql = "select count(*) from committee_structure where level=$i and 1=1 order by id";
                        $countCon=mysqli_query($conn,$countSql);
                        
                        $count=mysqli_fetch_array($countCon);
                        
                ?>
                <tr>
                    
                    <td class="th-prop" rowspan="<?php echo $count[0];?>">  <?php echo $i;?> </td>
                    <?php
                    $view="select * from committee_structure where level=$i and 1=1 order by id";
                        $tab=mysqli_query($conn,$view);
                    while($_row=mysqli_fetch_array($tab))
                    { 
                        // var_dump($_row);
                        
                        $sql_final_committee="select id,name,file,status,mobile from member where position_id=".$_row['id']." and level_id= ".$level_id." and loc_id=".$loc_id." and Waiting='Y' and status=1";
                        $sql_waiting_committee="select id,name,file,status,mobile from member where position_id=".$_row['id']." and level_id= ".$level_id." and loc_id=".$loc_id." and Waiting='Y' and status=0";
                        $runsql2=mysqli_query($conn,$sql_final_committee);
                        $runnum2=mysqli_num_rows($runsql2); 
                        $runsql_waiting=mysqli_query($conn,$sql_waiting_committee);
                        $runnum_waiting=mysqli_num_rows($runsql_waiting);
                        $cn=$cn+$runnum2; 
                    if($i==$_row['level']){
                        

                    ?>
                    
                    
                    <td class="th-prop">  <?php echo $srn; $srn++;?></td>
                    <td class="" style="text-align:left">&nbsp;&nbsp; <?php echo $_row['dasignation_name']; ?></td>
                    <td class="" style="text-align:center">&nbsp;&nbsp;
                      <?php while($sql2fetch=mysqli_fetch_array($runsql2)){ if($sql2fetch['file']!=''){ ?>
                            <img src="<?php echo $sql2fetch['file']?>" width="90px" style="height:100px" />
                      <?php 
                      
                    //   var_dump($sql2fetch);
                      
                      } } ?>
                    </td>
                    <td class="" style="white-space: nowrap;">&nbsp;
                    <?php 
                        
                        $runsql2=mysqli_query($conn,$sql_final_committee);
                        while($sql2fetch=mysqli_fetch_array($runsql2)){  
                            
                       
                       
                        $queryFinalTransaction= mysqli_query($conn,"SELECT * FROM Transaction where `Mem_id` = '".$sql2fetch["id"]."'");
                        $FetchFinalTransaction=mysqli_fetch_array($queryFinalTransaction);
                        ?>
                        
                         
                        
                        <span data-toggle="modal" data-target="#viewModal<?php echo $sql2fetch['id']; ?>">
                        

                            <a href="#" data-toggle="tooltip" data-placement="top" title="View Details!">
                                <?php $n= wordwrap($sql2fetch['name'],15,"<br>&nbsp;\n");
                              echo  ucwords($n);
                                ?>
                            </a>
                                
                        </span>
                        <!--Edit  Modal -->
                         <div class="modal fade" id="viewModal<?php echo $sql2fetch['id']; ?>" role="dialog">
                         <!--<div class="modal fade" id="viewModal1" role="dialog">-->
                            <div class="modal-dialog" >
                              <!-- Modal content-->
                              <div class="modal-content" style="position:fixed !important; top:25vh !important">
                                <div class="modal-header">
                                  <button type="button" class="close " data-dismiss="modal" style="width: 20% !important;">&times;</button>
                                  
                                </div>
                                <div class="modal-body mx-3">
                                    <div id = "table_modal">
                                   
                                       <table class="table table-striped" id="tblGrid">
                                        <thead>
                                          <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-right">Address</th>
                                            <th>Picture</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                              <td><?php echo $sql2fetch['id']; ?></td>
                                              <td><?php echo $sql2fetch['name']; ?></td>
                                              <td><?php echo $sql2fetch['email']; ?></td>
                                              <td><?php echo $sql2fetch['address']; ?></td>
                                              <td>
                                                <?php if(isset($sql2fetch['file']) && $sql2fetch['file']!=''){?>
                                                    <img src="<?php echo $sql2fetch['file']?>" width="40px" height="40px" />
                                                <?php } ?>
                                              </td>
                                          </tr>
                                        </tbody>
                                      </table> 
                                      </div>
                                      
                                 </div>
                                 
                                 
                                <div class="modal-footer">
                                    
                                    <?php 
                                    if(isset($_SESSION["email"])){?>
                                    
                                    <button type="button" style="width: 50% !important;height:1%" class="btn btn-info btn-style" onclick = "viewProfile(<?php echo $sql2fetch['id']; ?>);">View Profile</button>
                                    
                                    <?php }else{?>
                                    
                                    <button type="button" style="width: 20% !important;height:1%" class="btn btn-info btn-style" onclick = "regi_modal(<?php echo $sql2fetch['id']; ?>);">Login</button>
                                    
                                    <?php
                                    }?>
                                    
                                    
                                    
                                    
                                    
                                    <!--<button type="button" style="width: 30% !important; height:1%" class="btn btn-info btn-style" onclick="regi_modal(<?php echo $sql2fetch['id']; ?>);">Register</button>-->
                                  <button type="button" id ="modal1<?php echo $sql2fetch['id']; ?>" data-dismiss="modal" style="width: 20% !important; height:1%" class="btn btn-danger btn-style" hidden>Cancel</button>
                                  <button type="button" id ="modal2<?php echo $sql2fetch['id']; ?>" data-dismiss="modal"  data-toggle="modal" data-target="#viewModalLogin<?php echo $sql2fetch['id']; ?>" hidden>Cancel</button>
                                  <button type="button" id ="modal3<?php echo $sql2fetch['id']; ?>" data-dismiss="modal"  data-toggle="modal" data-target="#viewModalRegi<?php echo $sql2fetch['id']; ?>"  hidden>Cancel <?php echo $sql2fetch['id']; ?></button>
                                </div>
                              </div>
                            </div>
                          </div><!--end-->
                          
                          
   <!--====================New Registration Modal============================================-->
                          <!--Edit  Modal -->
                        
                           <div class="modal fade" id="viewModalRegi<?php echo $sql2fetch['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                               Modal content
                              <div class="modal-content" style="position:fixed !important; top:25vh !important" >
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 20% !important;">&times;</button>
                                  <!--<h4 class="modal-title">View Committe Details<?php echo $sql2fetch['id']; ?></h4>-->
                                </div>
                                <div class="modal-body mx-3">
                                    <div id="otp_inputs<?php echo $sql2fetch['id']; ?>">
                                     <p class = "mt-5">Enter Mobile : <input type="number" name="mobile_no" id ="mobile_no<?php echo $sql2fetch['id']; ?>" style="width:70%"></p>
                                     <div class = "text-center"><button type="button"  style="width: 20% !important;height: auto;margin-top: -10%" class="btn btn-info btn-style" onclick ="send_otp(<?php echo $sql2fetch['id']; ?>);">Get OTP</button></div>
                                     </div>
                                     <div id="get_otp<?php echo $sql2fetch['id']; ?>">
                                     <br>Enter OTP : <input type="number" name="get_otp_user" id="get_otp_user<?php echo $sql2fetch['id']; ?>" style="width:70%" ></br>
                                     <div class = "text-center"><button type="button"  style="width: 20% !important;height: auto;margin-top: -5%" class="btn btn-info btn-style" onclick = "otp_match(<?php echo $sql2fetch['id']; ?>);">Submit</button></div>
                                     </div>
                                     <div id="password_inputs<?php echo $sql2fetch['id']; ?>">
                                         <p class="text-warning text-center" style="margin-top: 10%;" ></p>
                                     <br>Set Password : <input type="password" name="password" id="password<?php echo $sql2fetch['id']; ?>" style="width:70%" ></br>
                                     <br>Confirm Password : <input type="password" name="conf_password" id="conf_password<?php echo $sql2fetch['id']; ?>" style="width:70%" ></br>
                                      <div class = "row">
                            <div class = "col-md-4 text-right">
                                     <h6 >Enter Password :</h6></div> 
                                     <div class = "col-md-8" style="margin-top: -2.2%;"><input type="password" name="password" id="password<?php echo $sql2fetch['id']; ?>"  ></div></div>
                                     <div class = "row">
                                         <div class = "col-md-4">
                                     <h6>Confirm Password :</h6></div> 
                                     <div class = "col-md-8" style="margin-top: -2.2%;">
                                     <input type="password" name="conf_password"
                                     id="conf_password<?php echo $sql2fetch['id']; ?>"></div></div>
                                     <div class = "text-center"><button type="button"  style="width: 20% !important;height: auto;margin-top: -5%" class="btn btn-info btn-style" onclick = "submit_regi(<?php echo $sql2fetch['id']; ?>);">Submit</button></div>
                                     <p class = "mt-5" hidden> <input type="text" name="member_id" id ="member_id<?php echo $sql2fetch['id']; ?>" value = "<?php echo $sql2fetch['id']; ?>" style="width:70%"></p>
                                     </div>
                                     
                                         
                                 </div>
                                <div class="modal-footer">
                                    
                                  <button type="button" data-dismiss="modal" style="width: 20% !important; height:1%" class="btn btn-danger btn-style" hidden>Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div><!--end-->
                         
  <!--===========          Login Modal      =========================================================================-->
                          <div class="modal fade" id="viewModalLogin<?php echo $sql2fetch['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content" style="position:fixed !important; top:25vh !important" >
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 20% !important;">&times;</button>
                                  <!--<h4 class="modal-title">View Committe Details<?php echo $sql2fetch['id']; ?></h4>-->
                                </div>
                                <div class="modal-body mx-3">
                                    <p class="text-warning text-center" style="margin-top: 10%;" ></p>
                                    <div class="row">
                                        <div class="col-md-4">
                                     <h6>Enter Mobile :</h6></div>
                                     <div class="col-md-8" style="margin-top:-2.2%;"><input type="number" name="login_mobile_no" id ="login_mobile_no<?php echo $sql2fetch['id']; ?>"></div></div>
                                     <div class="row">
                                         <div class="col-md-4">
                                     <h6>Password :</h6></div>
                                     <div class="col-md-8" style="margin-top:-2.2%;"><input type="password" name="password" id="login_password<?php echo $sql2fetch['id']; ?>"></div></div>
                                     <div class = "text-center"><button type="button"  style="width: 20% !important;height: auto;margin-top: -5%" class="btn btn-info btn-style" onclick = "member_login(<?php echo $sql2fetch['id']; ?>);">Login</button></div>
                                     <p class = "mt-5" hidden> <input type="text" name="member_id" id ="member_id<?php echo $sql2fetch['id']; ?>" value = "<?php echo $sql2fetch['id']; ?>" style="width:70%"></p>
                                     
                                         
                                 </div>
                                <div class="modal-footer">
                                    
                                  <button type="button" data-dismiss="modal" style="width: 20% !important; height:1%" class="btn btn-danger btn-style" hidden>Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div><!--end-->




                        <?php } ?>
                    </td>
                    
                    <td class="th-prop">
                        <?php if($runnum2!=0){ ?>
                         
                         <div>
                          <h6 style="text-align:center"><span  style="color: #059b25;height: 22px;"><b><?php echo "Approved"; ?></b></span></h6>                            
                        </div>
                         
                       <?php  } ?>
                          </td>
                   
                    <td class="th-prop">
                        <?php if($runnum2!=0){ 
                        ?>
                         <div>
                         <input type="button" class="btn btn-success btn-text btn-style"  onclick="window.open('../membership.php','_self');" style="padding: 0;" value="Contribute">                    
                        </div>
                      <? }
                      ?>
                    </td>
                    
                    <td class="th-prop">
                        <?php if($runnum2==0 && $runnum_waiting<5){   ?>
                            <input type="button" class="btn btn-success btn-text btn-style" style="padding:0" onclick="window.open('member.php?st=<?php echo $state;?>&ci=<?php echo $city;?>&Di=<?php echo $district;?>&ta=<?php echo $taluka;?>&Zo=<?php echo $zone;?>&con=<?php echo $country?>&p=<?php echo $pincode;?>&v=<?php echo $village;?>&pos=<?php echo $_row['id']?>&Lev=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Apply"> </td>
                        <?php }?>
                    
                    <td class="th-prop">
                        <?php if($runnum2!=0 && $runnum_waiting<5){?>
                            <input type="button" class="btn btn-warning btn-text btn-style" style="padding:0" onclick="window.open('member.php?st=<?php echo $state;?>&ci=<?php echo $city;?>&Di=<?php echo $district;?>&ta=<?php echo $taluka;?>&Zo=<?php echo $zone;?>&con=<?php echo $country?>&p=<?php echo $pincode;?>&v=<?php echo $village;?>&pos=<?php echo $_row['id']?>&Lev=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Apply"> </td>
                        <?php }?>
                    
                    <!--<td></td>-->
                    <td>
                       <!--<?php if($runnum_waiting!=0){ 
                           $runsql_waiting=mysqli_query($conn,$sql_final_committee);
                       ?>
                       
                         <!-- <h6><span class="badge badge-info text-center" style="background-color: #f0ad4e;margin: 14px;"><?php //echo $runnum_waiting; ?></span></h6>-->
                        <!--</div>
                       <?php }?>-->
                       
                        <div>
                          <h6 style="text-align:center"><span style="color:black" ><b><?php if($FetchFinalTransaction["amount"] > "0"){  echo "Rs.". $FetchFinalTransaction["amount"];} ?>  </b></span></h6>                            
                        </div>
                    </td>
                   
                        <?php if($runnum2!=0 && isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){
                            $runsql2=mysqli_query($conn,$sql_final_committee);
                            $data = mysqli_fetch_assoc($runsql2);
                        ?> 
                    <td>
                            <?php if($runnum2!=0){ ?>
                       <div>
                          <!-- Trigger the modal with a button -->
                        <span style="white-space:nowrap;margin:6px;" class="text-center">
                            <span data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </span>&nbsp;&nbsp;
                            <span>
                        <a href="member.php?id=<?php echo $data['id']; ?>&wait=false" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        </span>
                        </span>
                          <!-- Delete Modal -->
                         <div class="modal fade" id="myModal<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">Delete Committe</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure, You want to delete this record?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning btn-style" data-dismiss="modal" style="width: 20% !important;" onclick="shiftCommittee(<?php echo $data['id']; ?>)">Put in Wait list</button>
                                  <button type="button" class="btn btn-success btn-style" data-dismiss="modal" style="width: 10% !important;" onclick="deleteCommittee(<?php echo $data['id']; ?>)">Ok</button>
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                            <?php  } ?>
                    </td>
                     <?php } ?>
                     <td style="background:white;">
                          <?php if($runnum2!=0){?>
                         <input type="button" class="btn btn-success btn-text btn-style" style="padding:0" onclick="window.open('visiting.php?state=<?php echo $state;?>&city=<?php echo $city;?>&District=<?php echo $district;?>&talukaa=<?php echo $taluka;?>&Zone=<?php echo $zone;?>&cnt=<?php echo $country;?>&p=<?php echo $pincode;?>&v=<?php echo $village;?>&position=<?php echo $_row['id']?>&Level=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Send Card"> </td>
                        <?php } ?>
                                            
                     <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){ ?>
                    <td>

                          <?php if($runnum2!=0){?>
                         <input type="button" class="btn btn-success btn-text btn-style" style="padding:0" onclick="window.open('praman_patr/index_test.php?state=<?php echo $state;?>&city=<?php echo $city;?>&District=<?php echo $district;?>&talukaa=<?php echo $taluka;?>&Zone=<?php echo $zone;?>&cnt=<?php echo $country;?>&p=<?php echo $pincode;?>&v=<?php echo $village;?>&position=<?php echo $_row['id']?>&Level=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="praman_patr"> </td>
                      <?php } ?>
                         
                   <?php } ?>
                

                </tr>
                
                
                
                
                
                
                
            <?php 
            //$srn=1;
            $cn=0;
            /*$result=mysqli_query($conn,$View);
            while($_row=mysqli_fetch_array($result))
            { */
                $sql_waiting_committee="select id,position_id,name,file,status,mobile from member where position_id=".$_row['id']." and level_id= ".$level_id." and loc_id=".$loc_id."  and Waiting='Y' and status=0";
                $runsql_waiting=mysqli_query($conn,$sql_waiting_committee);
                $runnum_waiting=mysqli_num_rows($runsql_waiting);
            //  echo $runnum_waiting;
                if($runnum_waiting>0 ){
                    
               $srn1=1;
                while($data = mysqli_fetch_array($runsql_waiting))
                {  


                    $srn1++;
                    if($srn1<=6){
                ?>
                
            
                
                  <tr>
                    
                       
                    <td class="th-prop" ><?php echo $srn1; ?></td>
                    <td  style='text-align:left'>&nbsp;&nbsp;
                  <?php echo $srn1.". ". $_row['dasignation_name'];?>&nbsp;&nbsp;
               </td>
                    <td  style="text-align:center">&nbsp;&nbsp;
                        <?php if(isset($data['file']) && $data['file']!=''){ ?>
                            <img src="<?php echo $data['file']?>" width="90px" style="height:100px" />
                        <?php } ?>
                    </td>
                   <td class="th-prop" width="250px" style="white-space: nowrap;">&nbsp;&nbsp;
                    <?php /*echo $_row['name']; */?>&nbsp;


                   <span data-toggle="modal" data-target="#viewWaiting<?php echo $data['id']; ?>">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="View The Details!">
                            <?php $n= wordwrap($data['name'],15,"<br>&nbsp;\n"); 
                            echo  ucwords($n);
                            ?>
                        </a>
                    </span>
                    

                        <!--Edit  Modal -->
             <div class="modal fade" id="viewWaiting<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog"> -->
                              <!-- Modal content-->
                       <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">View Committe Details</h4>
                                </div>
                                <div class="modal-body mx-3">
                                   <table class="table table-striped" id="tblGrid">
                                        <thead>
                                          <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-right">Address</th>
                                            <th>Picture</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                              <td><?php echo $data['id']; ?></td>
                                              <td><?php echo $data['name']; ?></td>
                                              <td><?php echo $data['']; ?></td>
                                              <td><?php echo $data['address']; ?></td>
                                              <td>
                                                <?php if(isset($data['file']) && $data['file']!=''){?>
                                                    <img src="<?php echo $data['file']?>" width="40px" height="40px" />
                                                <?php } ?>
                                              </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                 </div> 
                                 </div> 
                                 </div> 
                                 </div> 
                                    
                    </td>
                
                 <?php if($data['status']==0){?>
                  <td>
                         <div>
                          <h6 style="text-align:center"><span  style="color: red;height: 22px;"><b><?php  echo "Waiting";?></b></span></h6>                         
                        </div>
             </td>
            <?   } ?>
               
                
                
                 <td class="th-prop">
                        <?php if($data['status']==0){ ?>
                         <div>
                         <input type="button" class="btn btn-success btn-text btn-style"  onclick="window.open('payment_details.php','_self');" style="padding:0;" value="Contribute">                          
                        </div>
                      <? } ?>
                    </td>
                
                
                    <td></td>
                    <td></td>
                     <td></td>
                  
                
                <td>
                    <?php if($runnum2==0 && isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){
                     ?>
                     <div>
                    <span style="white-space:nowrap;margin:6px;" class="text-center">
                        <span data-toggle="modal" data-target="#waiting_delete<?php echo $data['id']; ?>">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </span>&nbsp;&nbsp;
                        <span>
                        <a href="member.php?id=<?php echo $data['id']; ?>&wait=true" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        </span>
                    </span>
                    <!-- Modal -->
                         <div class="modal fade" id="waiting_delete<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">Delete Committe</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure, You want to delete this record?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-success btn-style" data-dismiss="modal" style="width: 10% !important;" onclick="deleteCommittee(<?php echo $data['id']; ?>)">Ok</button>
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div></div>
                            </div><!-- Delete Modal-->
                            
                            <!--Edit  Modal -->
                         <div class="modal fade" id="waiting_edit<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal Edit-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">Edit Committe</h4>
                                </div>
                                <form id="myForm" enctype="multipart/form-data" method="post" action="viewmember.php">
                                    <div class="modal-body mx-3">
                                    <div class="md-form mb-5">
                                      <i class="fa fa-user"></i>
                                      <input type="text" id="wname<?php echo $data['id']; ?>" name="wname<?php echo $data['id']; ?>" class="form-control validate" value="<?php echo $_row['name']; ?>">
                                      <label data-error="wrong" data-success="right" for="defaultForm-email">Name</label>
                                    </div>
                                    <div class="md-form mb-4">
                                        <div class="custom-file">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <input type="file" class="custom-file-input" id="wprofile_pic<?php echo $data['id']; ?>" name="wprofile_pic<?php echo $data['id']; ?>">
                                            <label class="custom-file-label" for="wprofile_pic['id']">upload</label>
                                            <?php  if(isset($data['file']) && $data['file']!=''){ ?>
                                                <img src="<?php echo $data['file']?>" width="40px" />
                                            <?php  } ?>
                                        </div>
                                    </div> 
                                 <!--</div>-->
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success btn-style" data-dismiss="modal" style="width: 10% !important;" >Update</button>
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div> <!-- Edit Modal-->
                            </td>
                        <?php $srn1++; } ?>
                  
                    
                    
                   </tr>
                   <?php }} ?>
                 
                     <?php }
            //$srn++;
    //  } 
        ?>
        <?php //}
                //$srn++;
            ?>
            <?php }else{
                        $srn = 1;
                    }
                        
                    }
                ?>
                </tr>
                
                <?php
                $i++;
                $srn = 1;
                }
                
                ?>
        </table>
    </div>
    <!--<div id="waiting_list" class="tab-pane fade">
        <h3 style="margin-top: 0px;font-family: serif;">Waiting List of Committee of - <? echo $fetchloc1[$table1];?></h3>
        <table align="center" class=" table-bordered table-striped">
            <tr>
                <th class="th-prop"  width="67px">Position No</th>
                <th class="th-prop"  width="17%">Position Name</th>
                <th>
                   <table class=" table-bordered table-striped">
                        <tr>
                           <th class="th-prop" width="50px">Sr.No</th>
                           <th class="th-prop" width="210px">Profile</th>
                            <th class="th-prop" width="250px">Name</th>
                            <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){ ?>
                                <th class="th-prop" width="9%">Action</th>
                            <?php } ?> 
                        </tr>
                    </table>
                </th>
            
           </tr>
            <?php 
            
        /*  $cn=0;
            $result=mysqli_query($conn,$View);
            while($_row=mysqli_fetch_array($result))
            { */
               // $sql_waiting_committee="select id,position_id,name,file from member where position_id=".$_row['id']." and level_id= ".$level_id." and loc_id=".$loc_id."  and status=0";
            //  $runsql_waiting=mysqli_query($conn,$sql_waiting_committee);
            //  $runnum_waiting=mysqli_num_rows($runsql_waiting);
               /*echo '<tr>';
               echo '<td>'.$_row['id'].'</td>';*/
               ?>
               <td  style='text-align:left'>
                  <?php //echo $_row['dasignation_name'];?>&nbsp;&nbsp;
               </td>
               <td>
               <table class="table-bordered table-striped">
           <?php
               $srn1=1;
                while($data = mysqli_fetch_array($runsql_waiting))
                {  $srn1++;?>
                  <tr>
                    <td class="th-prop" width="50px"><?php echo $srn1; ?></td>
                    <td class="th-prop"  style="text-align:center">&nbsp;&nbsp;
                        <?php if(isset($data['file']) && $data['file']!=''){ ?>
                            <img src="<?php echo $data['file']?>" width="90px" style="height:100px"  />
                        <?php } ?>
                    </td>
                   <td class="th-prop" width="250px" style="white-space: nowrap;">&nbsp;&nbsp;
                    &nbsp;
                   <span data-toggle="modal" data-target="#viewWaiting<?php echo $data['id']; ?>">
                        <a href="#" data-toggle="tooltip" data-placement="top" title="View Details!">
                            <?php echo wordwrap($data['name'],15,"<br>&nbsp;\n"); ?>
                        </a>
                    </span>
                        
                         <div class="modal fade" id="viewWaiting<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                             
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">View Committe Details</h4>
                                </div>
                                <div class="modal-body mx-3">
                                   <table class="table table-striped" id="tblGrid">
                                        <thead>
                                          <tr>
                                            <th>Sr No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th class="text-right">Address</th>
                                            <th>Picture</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                              <td><?php echo $data['id']; ?></td>
                                              <td><?php echo $data['name']; ?></td>
                                              <td><?php echo $data['email']; ?></td>
                                              <td><?php echo $data['address']; ?></td>
                                              <td>
                                                <?php if(isset($data['file']) && $data['file']!=''){?>
                                                    <img src="<?php echo $data['file']?>" width="40px" height="40px" />
                                                <?php } ?>
                                              </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                 </div>
                                <div class="modal-footer">
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
              
           
                <td>
                    <?php if($runnum2!=0 && isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'||isset($_SESSION["email"])){
                          
                     ?>
                     <div>
                    <span style="white-space:nowrap;margin:6px;" class="text-center">
                        <span data-toggle="modal" data-target="#waiting_delete<?php echo $data['id']; ?>">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </span>&nbsp;&nbsp;
                        
                        <span>
                        <a href="member.php?id=<?php echo $data['id']; ?>&wait=true" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        </span>
                    </span>
                    
                         <div class="modal fade" id="waiting_delete<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                              
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">Delete Committe</h4>
                                </div>
                                <div class="modal-body">
                                  Are you sure, You want to delete this record?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-success btn-style" data-dismiss="modal" style="width: 10% !important;" onclick="deleteCommittee(<?php echo $data['id']; ?>)">Ok</button>
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div></div>
                            </div>
                         <div class="modal fade" id="waiting_edit<?php echo $data['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                             
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close btn-style" data-dismiss="modal" style="width: 10% !important;">&times;</button>
                                  <h4 class="modal-title">Edit Committe</h4>
                                </div>
                                <form id="myForm" enctype="multipart/form-data" method="post" action="viewmember.php">
                                    <div class="modal-body mx-3">
                                    <div class="md-form mb-5">
                                      <i class="fa fa-user"></i>
                                      <input type="text" id="wname<?php echo $data['id']; ?>" name="wname<?php echo $data['id']; ?>" class="form-control validate" value="<?php echo $_row['name']; ?>">
                                      <label data-error="wrong" data-success="right" for="defaultForm-email">Name</label>
                                    </div>
                                    <div class="md-form mb-4">
                                        <div class="custom-file">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            <input type="file" class="custom-file-input" id="wprofile_pic<?php echo $data['id']; ?>" name="wprofile_pic<?php echo $data['id']; ?>">
                                            <label class="custom-file-label" for="wprofile_pic['id']">upload</label>
                                            <?php  if(isset($data['file']) && $data['file']!=''){ ?>
                                                <img src="<?php echo $data['file']?>" width="40px" />
                                            <?php  } ?>
                                        </div>
                                    </div> 
                                
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success btn-style" data-dismiss="modal" style="width: 10% !important;" >Update</button>
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div> 
                        <?php $srn1++; } ?>
                    </td>
                   </tr>
                   <?php } ?>
                   </table>
                   </td>
                </tr>
            <?php 
    //  } ?>
        </table>
            </div>    
          </div>
        </div>-->
        </div>
    <!--<div align="center"><button id="myButtonControlID" onClick="expfunc();">Delegate</button></div>-->
    </form>
<script> 
