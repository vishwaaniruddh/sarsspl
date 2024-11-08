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
    </style>
    </head>
    <body>
        <?php 
            session_start(); //Start the session
            include ("config.php");
            include('agent_menu.php');
        ?>
        <h2 style="text-align:center;margin-top:60px;">Committee of - <span class="committee-of"></span></h2>
        <div class="container" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-12">
                    <table cellpadding="5" class="table-bordered table-striped" style="margin: auto;margin-top: 28px;">
            <tr style="text-align:center;">
                <th>Position <br>No.</th>
                <th>Sr. <br>No.</th>
                <th>Position <br>Name</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        <?php 
            
            $mobile = $_REQUEST["mobile"];
            $visitorQ="select * from member where mobile=".$mobile.' and (status=1 OR status=0)';
            $visitor=mysqli_query($conn,$visitorQ);
            $rowCount = 1;
            $html="";
            $previousPositionNo=0;
            $displayPositionNo = 1;
            while($row=mysqli_fetch_array($visitor)){
                $CommitteeOfQ = 'select * from '.GetTableName($row["level_id"]).' where id='.$row["loc_id"];
                $CommitteeOfR = mysqli_query($conn, $CommitteeOfQ);
                while($CommitteeOfRow=mysqli_fetch_array($CommitteeOfR)){
                    $CommitteeOf = $CommitteeOfRow[GetTableName($row["level_id"])];
                }
                
                $committeeQ = "select * from committee_structure order by level";
                $committee = mysqli_query($conn, $committeeQ);
                $MemberRow = "";
                while($CommRow=mysqli_fetch_array($committee)){
                    if(true){//if($CommRow["level"] != $row["position_id"]){
                        $memberQ = "select * from member where position_id=".$CommRow["id"]." and level_id=".$row["level_id"]." and loc_id=".$row["loc_id"]." and (status=1 OR status=0) order by status desc";
                        //$memberQ = "SELECT m.* FROM `member` as m JOIN `committee_structure` as c ON (m.position_id=c.id) WHERE position_id=".$CommRow["id"]." `loc_id`=".$row["loc_id"]." and `level_id`=".$row["level_id"]." and (m.status=0 OR m.status=1) order by c.level ASC, m.status DESC";
                        $member = mysqli_query($conn, $memberQ);
                        if($previousPositionNo == $CommRow["level"]){
                            //$displayPositionNo = '';
                        }else{
                            $rowCount=1;
                            $previousPositionNo = $CommRow["level"];
                            $displayPositionNo = $CommRow["level"];
                        }
                        if(mysqli_num_rows($member) > 0){
                            while($MemberRow=mysqli_fetch_array($member)){
                                $html = $html . AddHtml($MemberRow["file"], $MemberRow["name"], $MemberRow["status"], $displayPositionNo, $CommRow["dasignation_name"], $rowCount);
                                $rowCount++;        
                                //break;
                            }
                        } else {
                            $html = $html . AddHtml('', '', '-1', $displayPositionNo, $CommRow["dasignation_name"], $rowCount);
                            $rowCount++;
                        }
                    } elseif($CommRow["id"] == $row["position_id"]) {
                        $rowCount=1;
                         $html = $html . AddHtml($row["file"], $row["name"], $row["status"], $CommRow["id"], $CommRow["dasignation_name"], $rowCount);
                         $rowCount++;
                    }
                }
                //break;
            }
            function AddHtml($file, $name, $status, $positionId, $positionName, $count){
                $Html = 
                    '<tr>
                    <td class="th-prop">'.$positionId.'</td>
                    <td class="th-prop">'.$count.'</td>
                    <td>'.$positionName.'</td>';
                
                if($file!=''){
                    $Html = $Html.'<td><img src="'.$file.'" width="90px" style="height:100px" /></td>';
                } else{
                    $Html = $Html.'<td></td>';
                }
                $Html = $Html.'<td>'.$name.'</td>';
                if($status == 1){
                    $Html = $Html.'<td style="color:green; font-weight: 600; text-align:center;">Approved</td>';
                } elseif($status == 0){
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;">Waiting</td>';
                } else {
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;"></td>';
                }
                $Html = $Html.'</tr>';
                return $Html;
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