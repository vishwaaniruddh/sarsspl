<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shyam Committee Member</title>
    <!-- <link rel="stylesheet" href="css/normalize.css">-->
    <link rel="icon" href="images/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,700%7CRoboto+Slab:400,300,700">
    
    <link rel="stylesheet" href="css/sig.css">
    
    <!-- jQuery library -->
    <!-- ruchi -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Ruchi : select 2-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- Typahead -->
    <link rel="stylesheet" href="css/custom.css">
    <script  type="text/javascript" src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    
    <link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Amita:400,700&display=swap&subset=devanagari" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap&subset=devanagari" rel="stylesheet">
    <link rel="stylesheet" href="../css/css_new/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/css_new/slick.min.css">
    <script src="../js/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/css_new/style.css">
    <link rel="stylesheet" type="text/css" href="../css/css_new/hindi.css">
    
    <style>
        .mandir_plan h5:before{left: 40px;}
        .fa-at:before{content: "\f1fa";}
        h2:after{
            border:none;
        }
        .fade{
            opacity:1;
        }
    </style>
    <script>
        function viewProfile(mid){
            var mid = mid;
            console.log(mid);
            $.ajax({
                     type: "GET",
                     url: "getMobile.php",
                     data: 'id='+mid,     
                     success: function(msg){              
                      //alert(msg);
                      //alert(msg);
                      if(msg=='1'){
                          window.location = 'https://shyambabadham.com/account/member_account/account.php';
                      }
                        
                     },
                 });
            
        }
    </script>
    </head>
    <body>
        <?php 
            session_start(); //Start the session
            include ("config.php");
            include('agent_menu.php');
            
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
        ?>
        <h2 style="text-align:center;margin-top:60px;">Committee of - <span class="committee-of"></span></h2>
        <div class="container" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-12">
                    
        <?php 
            $IsAdmin = 1;
            $mobile = $_REQUEST["mobile"];
            $locationID=1;
            $levelID = 1;
            
            $CommitteeOfQ = 'select * from '.GetTableName($levelID).' where id='.$locationID;
            $CommitteeOfR = mysqli_query($conn, $CommitteeOfQ);
            while($CommitteeOfRow=mysqli_fetch_array($CommitteeOfR)){
                $CommitteeOf = $CommitteeOfRow[GetTableName($levelID)];
            }
            
            $committeeQ = "select * from committee_structure order by level";
            $committee = mysqli_query($conn, $committeeQ);
            
            $rowCount = 1;
            $html="";
            $displayPositionNo = 1;
            
            while($CommRow=mysqli_fetch_array($committee)){
                $memberQ = "select * from member where position_id=".$CommRow["id"]." and level_id=".$levelID." and loc_id=".$locationID." and (status=1 OR status=0) order by status desc";
                //$memberQ = "SELECT m.* FROM `member` as m JOIN `committee_structure` as c ON (m.position_id=c.id) WHERE position_id=".$CommRow["id"]." `loc_id`=".$row["loc_id"]." and `level_id`=".$row["level_id"]." and (m.status=0 OR m.status=1) order by c.level ASC, m.status DESC";
                $member = mysqli_query($conn, $memberQ);
                $LocationQ = 'select * from '.GetTableName($levelID).' where id='.$locationID;
                $LocationR = mysqli_query($conn, $LocationQ);
                $LocationName = null;
                while($LocationRow=mysqli_fetch_array($LocationR)){
                    $LocationName = $LocationRow[GetTableName($levelID)];
                }
                if($displayPositionNo != $CommRow["level"]){
                    $rowCount=1;
                }
                $displayPositionNo = $CommRow["level"];
                
                $RegisterLink = GetApplyLink($locationID,$levelID,$CommRow["id"]);
                if(mysqli_num_rows($member) > 0){
                    while($MemberRow=mysqli_fetch_array($member)){
                        $loginModal = LoginModalHtml($MemberRow["id"], $MemberRow["name"], $MemberRow["email"], $MemberRow["address"], $MemberRow["file"], $IsAdmin);
                        $html = $html . AddHtml($MemberRow["id"], $MemberRow["file"], $MemberRow["name"], $MemberRow["status"], $displayPositionNo, $CommRow["dasignation_name"], $rowCount, $IsAdmin, $RegisterLink, GetVisitingCardLink($MemberRow), $loginModal);
                        $rowCount++;
                    }
                } else {
                    $html = $html . EmptyRow($displayPositionNo, $CommRow["dasignation_name"], $rowCount, $IsAdmin, $RegisterLink);
                    $rowCount++;
                }
            }
            
            function AddHtml($ID, $file, $name, $status, $positionId, $positionName, $count, $IsAdmin, $RegisterLink, $VisitingCardLink, $loginModal){
                $Html = '<tr style="border-top: 5px solid #dfdfdf;">';
                $Html = $Html.'<td class="th-prop" rowspan="2">'.$positionId.$loginModal.'</td>';
                $Html = $Html.'<td class="th-prop" rowspan="2">'.$count.'</td>';
                $Html = $Html.'<td rowspan="2" style="text-align:center;">'.wordwrap($positionName,4,"<br>&nbsp;\n").'</td>';
                
                if($file!=''){
                    $Html = $Html.'<td rowspan="2"><img src="'.$file.'" width="90px" style="height:100px" /></td>';
                } else{
                    $Html = $Html.'<td rowspan="2"></td>';
                }
                //----------Name----------------------
                $Html = $Html.'<td><span data-toggle="modal" data-target="#viewModal'.$ID.'">';
                $Html = $Html.'<a href="#" data-toggle="tooltip" data-placement="top" title="View Details!">';
                $Html = $Html.ucwords(wordwrap($name,15,"<br>&nbsp;\n")).'</a></span></td>';
                //----------End Name----------------
                
                $Html = $Html.'<td colspan="2">'.
                                (($count==1)?'<div style="text-align:center;">
                                        <button class="btn btn-warning" onclick="window.open(\''.$RegisterLink.'\')" style="width:140px;" title="Apply for waitlist">Apply Waitlist</button>
                                    </div>':'').
                                '</td>';
                if($IsAdmin == 1){
                    $Html = $Html.'<td style="text-align:center;">
                                        <span data-toggle="modal" data-target="#myModal'.$ID.'">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                        </span>&nbsp;&nbsp;
                                        <span>
                                            <a href="member.php?id='.$ID.'&wait=false" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </span>
                                    </td>';
                }
                $Html = $Html.'</tr>';
                //-----------New Row------------------------------------
                $Html = $Html.'<tr>';
                if($status == 1){
                    $Html = $Html.'<td style="color:green; font-weight: 600; text-align:center;">Approved</td>';
                } elseif($status == 0){
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;">Waiting</td>';
                } else {
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;"></td>';
                }
                $Html = $Html.'<td><input type="button" class="btn btn-success btn-text btn-style"  onclick="window.open(\''.($status==1?'../membership.php\'':'payment_details.php\'').',\'_self\');" style="padding:0px 4px;font-size: 15px !important;height: 34px;background-color: #f17b00;border-color: #ac5700;" value="Contribute"></td>';
                if($status == 1){
                    $Html = $Html.'<td><input type="button" class="btn btn-success btn-text btn-style" style="padding:0px 4px;font-size: 15px !important;height: 34px;background-color: #f17b00;border-color: #ac5700;" onclick="window.open(\''.$VisitingCardLink.'\',\'_blank\');" value="Send Card"></td>';
                } else {$Html = $Html.'<td></td>';}
                if($IsAdmin == 1){
                    $Html = $Html.'<td><input type="button" class="btn btn-success btn-text btn-style" style="padding:0px 4px;font-size: 15px !important;height: 34px;background-color: #f17b00;border-color: #ac5700;" onclick="window.open(\''.$VisitingCardLink.'\',\'_blank\');" value="Praman Patra"> </td>';
                }
                $Html = $Html.'</tr>';
                return $Html;
            }
            function EmptyRow($positionId, $positionName, $count, $IsAdmin, $RegisterLink){
                $Html = '<tr style="border-top: 5px solid #dfdfdf;">';
                $Html = $Html.'<td class="th-prop" rowspan="2">'.$positionId.'</td>';
                $Html = $Html.'<td class="th-prop" rowspan="2">'.$count.'</td>';
                $Html = $Html.'<td rowspan="2" style="text-align:center;">'.wordwrap($positionName,4,"<br>&nbsp;\n").'</td>';
                $Html = $Html.'<td rowspan="2"></td>';
                //----------Name----------------------
                $Html = $Html.'<td></td>';
                //----------End Name----------------
                
                $Html = $Html.'<td colspan="2">
                                    <div style="text-align:center;">
                                        <button class="btn btn-warning" style="width:140px;" onclick="window.open(\''.$RegisterLink.'\')" title="Apply for waitlist">Apply</button>
                                    </div>
                                </td>';
                if($IsAdmin == 1){
                    $Html = $Html.'<td style="text-align:center;"></td>';
                }
                $Html = $Html.'</tr>';
                //-----------New Row------------------------------------
                $Html = $Html.'<tr>';
                $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;"></td>';
                
                $Html = $Html.'<td></td>';
                $Html = $Html.'<td></td>';
                if($IsAdmin == 1){
                    $Html = $Html.'<td></td>';
                }
                $Html = $Html.'</tr>';
                return $Html;
            }
            function LoginModalHtml($ID, $name, $email, $address, $file, $IsAdmin){
                $link = '<div class="modal fade" id="viewModal'.$ID.'" role="dialog">
                            <div class="modal-dialog" >
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
                                              <td>'.$ID.'</td>
                                              <td>'.$name.'</td>
                                              <td>'.$email.'</td>
                                              <td>'.$address.'</td>
                                              <td>';
                                                if(isset($file) && $file!=''){
                                                    $link = $link.'<img src="'.$file.'" width="40px" height="40px" />';
                                                }
                                              $link = $link.'</td>
                                          </tr>
                                        </tbody>
                                      </table> 
                                      </div>
                                 </div>
                                <div class="modal-footer">'.
                                    (($IsAdmin==1)?
                                    '<button type="button" style="width: 50% !important;height:1%" class="btn btn-info btn-style" onclick = "viewProfile(\''.$ID.'\');">View Profile</button>'
                                    :
                                    '<button type="button" style="width: 20% !important;height:1%" class="btn btn-info btn-style" onclick = "regi_modal(\''.$ID.'\');">Login</button>').
                                '</div>
                              </div>
                            </div>
                          </div>';
                return $link;
            }
            function GetTableName($levelNum){
                if($levelNum == 1){
                    return 'country';
                } elseif($levelNum == 2){
                    return 'zone';
                } elseif($levelNum == 3){
                    return 'state';
                } elseif($levelNum == 4){
                    return 'city';
                } elseif($levelNum == 5){
                    return 'district';
                } elseif($levelNum == 6){
                    return 'taluka';
                } elseif($levelNum == 7){
                    return 'pincode';
                } elseif($levelNum == 8){
                    return 'village';
                }
            }
            function GetVisitingCardLink($row){
                $idS = $row['id'];
                $level_idS = $row['level_id'];
                $loc_idS = $row['loc_id'];
                $position_idS = $row['position_id'];
                $nameS = $row['name'];
                $lastNameS = $row['LastName'];
                $state = $row['state'];
                $city = $row['city'];
                $district = $row['district'];
                $talukaa = $row['taluka'];
                $zone = $row['zone'];
                $country = $row['country'];
                $pincode = $row['pincode'];
                $village = $row['village'];
                $profile = $row['file'];
                //Link to generate visiting card
                $s = ($state==0?"":$state);
                $d = ($district==0?"":$district);
                $t = ($talukaa==0?"":$talukaa);
                $z = ($zone==0?"":$zone);
                $c = ($country==0?"":$country);
                $p = ($pincode==0?"":$pincode);
                $v = ($village==0?"":$village);
                
                $CreateVisitingCardSelf = "https://shyambabadham.com/Committee/visiting.php?state=".$s."&District=".$d."&talukaa=".$t."&Zone=".$z."&cnt=".$c."&p=".$p."&v=".$v."&position=".$position_idS."&Level=".$level_idS."&Loc=".$loc_idS;
                return $CreateVisitingCardSelf;
            }
            function GetApplyLink($locationId, $levelId, $positionId){
                //$link = "https://shyambabadham.com/Committee/member.php?loc=".$locationId."&lev=".$levelId."&pos=".$positionId;
                $link = 'https://shyambabadham.com/Committee/member.php?st='.$state.'&ci='.$city.'&Di='.$district.'&ta='.$taluka.'&Zo='.$zone.'&con='.$country.'&p='.$pincode.'&v='.$village.'&pos='.$positionId.'&Lev='.$levelId.'&Loc='.$locationId;
                return $link;
            }
        ?>
        
        <table cellpadding="5" class="table-bordered table-striped" style="margin: auto;margin-top: 28px;">
            <tr style="text-align:center;">
                <th>Position <br>No.</th>
                <th>Sr. <br>No.</th>
                <th>Position <br>Name</th>
                <th colspan="2">Profile</th>
                <th colspan="2">Action</th>
                <?php if($IsAdmin == 1){echo '<th>Admin</th>'; } ?>
            </tr>
            <?php
                echo $html;
            ?>
        </table>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $(".committee-of").html('<?php echo $CommitteeOf; ?>');
            });
        </script>
    </body>
</html>