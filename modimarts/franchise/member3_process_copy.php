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

/*$query = "select m.name,c.dasignation_name from member m join committee_structure c on m.position_id=c.id where m.loc_id=".$loc_id." and m.level_id=".$level_id;
$result = mysqli_query($conn,$query);
$Num_Rows = mysqli_num_rows ($result);
if($Num_Rows==0){*/
?>
<!--<span class="label label-danger">No result found</span>-->
<form  method="post" action="member.php"  id="form_respons">
    <!--<table align="center" class="table" style="width:100%" border='1'>-->
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
    
  //  echo $hdLevel."</br>".$table1;
    
 
       $qryLevel1="select $table1 from $table1 where  id='".$hdLoc."' ";
    
// echo    $qryLevel1;
    
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
<!--    <div id="commity_respons" class="table-responsive " style="" >-->
    <div id="commity_respons"  style="" >
        <div>
          <!--<ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#committee_list">See Committee List</a></li>
            <li><a data-toggle="tab" href="#waiting_list">See Waiting List</a></li>
          </ul>-->
          
     <!--   <a data-toggle="tab" href="#committee_list">See Committee List</a>-->
           
          
          <div class="tab-content">
            <div id="committee_list" class="">
              <h3 style="margin-top: 18px; font-family: serif;">Committee of - <? echo $fetchloc1[$table1];?></h3>
              <table align="center" class=" table-bordered table-striped" id="com_T">
                <tr>
                    <th class="th-prop" width="67px">Sr No</th>
                    <th class="th-prop" width="17%">Position Name</th>
                    
                    <th class="th-prop" width="250px">Profile</th>
                    <th class="th-prop" width="250px">Name</th>
            
                    <th class="th-prop" width="250px" >Status</th>
                    <th class="th-prop" width="250px" >Contribution Nights</th>
                    
                    
                    <th class="th-prop" width="9%">Apply committee</th>
                    <th class="th-prop" width="9%">Apply WaitList</th>
                    <!--<th class="th-prop">Donation Recd</th>-->
                <!--    <th class="th-prop" width="9%">Persons in waiting list</th>-->
                   <th class="th-prop" width="9%">Contribution</th>
                    <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){ ?>
                    <th class="th-prop" width="9%">Action</th>
                    <?php } ?>
                      <th class="th-prop" width="9%">Visiting Card</th>
               </tr>
                <?php 
                    $srn=1;
                    $cn=0;
                    while($_row=mysqli_fetch_array($table))
                    { 
                        //var_dump($_row);
                        $sql_final_committee="select id,name,file,status,mobile from member where position_id=".$_row['id']." and level_id= ".$level_id." and loc_id=".$loc_id." and Waiting='Y' and status=1";
                        $sql_waiting_committee="select id,name,file,status,mobile from member where position_id=".$_row['id']." and level_id= ".$level_id." and loc_id=".$loc_id." and Waiting='Y' and status=0";
                        $runsql2=mysqli_query($conn,$sql_final_committee);
                        $runnum2=mysqli_num_rows($runsql2); 
                        $runsql_waiting=mysqli_query($conn,$sql_waiting_committee);
                        $runnum_waiting=mysqli_num_rows($runsql_waiting);
                        $cn=$cn+$runnum2; 
                        
                       
                ?>
                <tr>
                    <td class="th-prop">  <?php echo $srn; ?></td>
                    <td class="" style="text-align:left">&nbsp;&nbsp;1. <?php echo $_row['dasignation_name']; ?></td>
                    <td class="" style="text-align:center">&nbsp;&nbsp;
                      <?php while($sql2fetch=mysqli_fetch_array($runsql2)){ if($sql2fetch['file']!=''){ ?>
                            <img src="<?php echo $sql2fetch['file']?>" width="90px" style="height:100px" />
                      <?php  } } ?>
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



                            <br>
                            
                            
                            
                            <!--<a href="link2.php?val=<?php echo $sql2fetch['id']; ?>"> Get Link-->
                            <!--    </a>-->
                                
                        </span>
                        <!--Edit  Modal -->
                         <div class="modal fade" id="viewModal<?php echo $sql2fetch['id']; ?>" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content" style="position:fixed !important; top:25vh !important">
                                <div class="modal-header">
                                  <button type="button" class="close " data-dismiss="modal" style="width: 20% !important;">&times;</button>
                                  <h4 class="modal-title">View Committe Details<?php echo $sql2fetch['id']; ?></h4>
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
                                <div class="modal-footer">
                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Login</button>
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
                    </td>
                    <td class="th-prop">
                        <?php if($runnum2!=0 && $runnum_waiting<5){?>
                            <input type="button" class="btn btn-warning btn-text btn-style" style="padding:0" onclick="window.open('member.php?st=<?php echo $state;?>&ci=<?php echo $city;?>&Di=<?php echo $district;?>&ta=<?php echo $taluka;?>&Zo=<?php echo $zone;?>&con=<?php echo $country?>&p=<?php echo $pincode;?>&v=<?php echo $village;?>&pos=<?php echo $_row['id']?>&Lev=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Apply"> </td>
                        <?php }?>
                    </td>
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
                   
                        <?php if($runnum2!=0 && isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){
                            $runsql2=mysqli_query($conn,$sql_final_committee);
                            $data = mysqli_fetch_assoc($runsql2);
                        ?> <td>
                       <div>
                          <!-- Trigger the modal with a button -->
                        <span style="white-space:nowrap;margin:6px;" class="text-center">
                        <!--<span data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>">
                                 <a data-toggle="tooltip" data-placement="top" title="My Tooltip text!">+</a>
                            </span>-->
                            <span data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </span>&nbsp;&nbsp;
                            <!--<span data-toggle="modal" data-target="#editModal<?php echo $data['id']; ?>">
                            <a data-toggle="tooltip" data-placement="top" title="Edit<?php echo $data['id']; ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            </span>-->
                            <span>
                        <a href="member.php?id=<?php echo $data['id']; ?>&wait=false" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        </span>
                        </span>
                          <!--<button type="button" class="btn btn-danger btn-text btn-style" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>" >Delete</button>-->
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
                       
                    </td>
                     <?php } ?>
                     <td>
                          <?php if($runnum2!=0){?>
                         <input type="button" class="btn btn-success btn-text btn-style" style="padding:0" onclick="window.open('visiting.php?state=<?php echo $state;?>&city=<?php echo $city;?>&District=<?php echo $district;?>&talukaa=<?php echo $taluka;?>&Zone=<?php echo $zone;?>&cnt=<?php echo $country;?>&p=<?php echo $pincode;?>&v=<?php echo $village;?>&position=<?php echo $_row['id']?>&Level=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Send Card"> 
                         </td>
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
                    
            
            
                
            //   echo '<tr>';
             //  echo '<td>'.$_row['id'].'</td>';
               ?>
               
               <!--<td  style='text-align:left'>
                  <?php echo $_row['dasignation_name'];?>&nbsp;&nbsp;
               </td>
               
               
               <td>-->
               
               <!--<table class="table-bordered table-striped">-->
               <?php
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
                                    
                                    
                            <!--Aniruddh-->
<!-- <div class="container">
            <h3>Profile</h3>
            
            <img src="https://shyambabadham.com/demo/sapna/image/logo.png" style="width:60px;" align="left"><br>
            Name   
            <input class="form-control" type="text" name="Name" placeholder="Name" >
            Email   
            <input class="form-control" type="email" name="Email" placeholder="Email"><br><br>
            Mobile Number 
            <input class="form-control" type="text" name="Mobile No." placeholder="Mobile Number"><br><br>
            Address 
            <input class="form-control" type="text" name="Address" placeholder="Address"> </center><br>
            Membership Type    
            <input class="form-control" type="text" name="Membership" placeholder="Membership Plan"></center><br>
            
            <input class="form-control" type="button" value="Login" style="background-color:#66b3ff; color:white;">   
              
</div> -->

                        
                            
                                <!--  <a href="https://shyambabadham.com/demo/sapna/myaccount.php?mobile=<?php echo $data['mobile']; ?>" title="getLink">Get Link</a>
                                <div class="modal-footer">

                                  <button type="button" data-dismiss="modal" style="width: 10% !important;" class="btn btn-danger btn-style">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div> -->
                          <!--end-->
                    </td>
                <?php /*<td class="th-prop">
                    <?php if($runnum_waiting!=0){?>
                        <input type="button" class="btn btn-success btn-text btn-style" onclick="window.open('member.php?state=<?php echo $state;?>&city=<?php echo $city;?>&District=<?php echo $district;?>&talukaa=<?php echo $taluka;?>&Zone=<?php echo $zone;?>&country=<?php echo $country?>&position=<?php echo $_row['id']?>&Level=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Apply"> </td>
                    <?php }?>
                </td> */ ?>
            <!--    <td class="th-prop">
                    <?php if($runnum2!=0){?>
                        <input type="button" class="btn btn-warning btn-text" style="height:22px;padding-top: 1px;width: 96%;" onclick="window.open('member.php?state=<?php echo $state;?>&city=<?php echo $city;?>&District=<?php echo $district;?>&talukaa=<?php echo $taluka;?>&Zone=<?php echo $zone;?>&country=<?php echo $country?>&position=<?php echo $_row['id']?>&Level=<?php echo $hdLevel?>&Loc=<?php echo $hdLoc?>','_self');" value="Apply"> </td>
                    <?php }?>
                </td>-->
                
                
                
                
                
               
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
                    <?php if($runnum2==0 && isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){
                            //$runsql2=mysqli_query($conn,$sql_final_committee);
                           // $data = mysqli_fetch_assoc($runsql2);
                     ?>
                     <div>
                    <span style="white-space:nowrap;margin:6px;" class="text-center">
                        <span data-toggle="modal" data-target="#waiting_delete<?php echo $data['id']; ?>">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </span>&nbsp;&nbsp;
                        <!--<span data-toggle="modal" data-target="#waiting_edit<?php echo $data['id']; ?>">-->
                        <!--<a data-toggle="tooltip" data-placement="top" title="Edit<?php echo $data['id']; ?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>-->
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
                 
                     
                </tr>
            <?php }
            //$srn++;
    //  } 
        ?>
                
                
                      
                
                
                
                
                
                
                <?php //}
                $srn++;
            } ?>
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
                            <?php if(isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){ ?>
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
                    <?php if($runnum2!=0 && isset($_SESSION['user_name']) && $_SESSION['user_name']=='Admin'){
                          
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




