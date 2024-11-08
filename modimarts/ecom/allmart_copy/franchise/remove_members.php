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
            $p = $_REQUEST["p"];
            if(!$p && $p == 0){
                $p=1;
            } else {
                $p=$_REQUEST["p"];
            }
            if(isset($_REQUEST["m"])){
                $m = $_REQUEST["m"];
                if($m && $m > 0){
                    $deleteQ = "DELETE FROM member where id="+$m;
                    $delete = mysqli_query($conn,$deleteQ);
                    if($delete && $delete > 0){
                        echo '<script>alert("record deleted successfully");</script>';
                    }
                }
            }
            $totalQ = "select count(mobile) as mycount from member where status<>1";
            $total=mysqli_query($conn,$totalQ);
            while($fetchs=mysqli_fetch_array($total)){
                $totalr=$fetchs["mycount"];
            }
            //$total = $total-> fetch_assoc();
            $htmlPage = "";
            $total  =floor($totalr/100);
            if($total < $totalr/100){$total++;} 
            for($i=1;$i<=($total);$i++){
                
                $htmlPage = $htmlPage.'<input type="button" value="'.$i.'" class="btn pagination-btn" '.($i==$p?'style="background-color: gray;"':"").' />&nbsp;';
            }
            echo '<input type="hidden" name="hdn_paginate" class="hdn_paginate" value="'.$p.'">';
        ?>
        <h2 style="text-align:center;margin-top:60px;">Remove invalid members<span class="committee-of"></span></h2>
        
        <div class="container" style="overflow-x: scroll;">
            <div class="row">
                <div class="col-12">
                    <?php echo '<div style="text-align:center;">'.$htmlPage.'</div>'; ?>
        <?php
            $offset = ($p-1) * 100;
            $visitorQ="SELECT m.id as id, m.file as file, m.name as name, m.mobile as mobile, m.status as status, c.dasignation_name as dasignation_name FROM `member` as m LEFT JOIN `committee_structure` as c ON (m.position_id=c.id) WHERE (m.status<>1) order by m.mobile limit 100 offset ".$offset;
            
            $visitor=mysqli_query($conn,$visitorQ);
            $rowCount = $offset+1;
            $html="";
            $preID = 0; 
            $preMobile = "0"; 
            $IsIDAddedinStyle = false; 
            $Style="";
            while($row=mysqli_fetch_array($visitor)){
                $html = $html . AddHtml($row["id"], $row["file"], $row["name"], $row["mobile"], $preMobile, $IsIDAddedinStyle, $preID, $Style, $row["status"], $row["dasignation_name"], $rowCount);
                $preMobile = $row["mobile"];
                $preID = $row["id"];
                $rowCount++;
            }
            
            function AddHtml($ID, $file, $name, $mobile, &$preMobile, &$IsIDAddedinStyle, &$preID, &$Style, $status, $positionName, $count){
                $shouldPrint = 'NO';
                if($mobile == $preMobile) {
                    $SID = ".c-".$ID;
                    $SpreID = ".c-".$preID;
                    $Style = $Style.($Style!=""?",":"").$SID.", ".$SpreID;
                    $shouldPrint = $SpreID;
                    /*if(!$IsIDAddedinStyle){
                        //$Style=".myred-1";
                        $Style = $Style.($Style!=""?",":"")." .c-".$ID.", .c-".$preID;
                        $IsIDAddedinStyle = true;
                    } else {
                        $Style = $Style.", .c-".$ID;
                    }*/
                } else {
                    $IsIDAddedinStyle = false;
                }
                $Html = 
                    '<tr class="c-'.$ID.'">
                    <td class="th-prop">'.$count.'</td>
                    <td><input type="checkbox" class="chk" value="'.$ID.'"></td>
                    <td>'.$positionName.'</td>';
                
                if($file!=''){
                    $Html = $Html.'<td><img src="'.$file.'" width="90px" style="height:100px" /></td>';
                } else{
                    $Html = $Html.'<td></td>';
                }
                $Html = $Html.'<td>'.$name.'</td>';
                $Html = $Html.'<td>'.$mobile.'</td>';
                if($status == 1){
                    $Html = $Html.'<td style="color:green; font-weight: 600; text-align:center;">Approved</td>';
                } elseif($status == 0){
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;">Waiting</td>';
                } elseif($status == 2){
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;">Disapproved</td>';
                } elseif($status == 3){
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;">Removed</td>';
                } else {
                    $Html = $Html.'<td style="color:red; font-weight: 600; text-align:center;"></td>';
                }
                $Html = $Html.'<td><button class="remove-single" value="'.$ID.'">Remove<button></td>';
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
            echo '<style>'.$Style.'{background-color: #ffbf49 !important;}.chk{width:18px; height:18px;}</style>';
        ?>
        <br/><button type="button" style="width:100px !important; float:right;" class="btn btn-danger MultipleRemove">Delete</button>
        <br/>
        <table cellpadding="5" class="table-bordered table-striped" style="margin: auto;margin-top: 28px;">
            <tr style="text-align:center;">
                <th colspan="2">Sr. <br>No.</th>
                <th>Position <br>Name</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php 
            echo $html; ?>
        </table>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                var members = [];
                var newm={};
                $(".remove-single").on("click", function(){
                    var id = $(this).val();
                    var r = confirm("Delete the member? " + id);
                    if (r == true) {
                        members = [];
                        members.push(id);
                        DeleteMultipleRecord();
                    }
                });
                function DeleteMultipleRecord(){
                    newm = {m:members};
                    $.ajax({
                        type: 'POST',
                        url: "/Committee/delete_members.php",
                        data: newm,
                        dataType: "text/json",
                        success: function(resultData) { 
                            alert("members deleted."); 
                            console.log(resultData);
                            window.location.reload();
                        },
                        error: function(e){
                            console.log(e.responseText);
                                window.location.reload();
                            //alert("Error");
                        }
                    });
                }
                $(".committee-of").html('<?php echo $CommitteeOf; ?>');
                $(".chk").on("change", function(){
                    if($(this).prop("checked")==true){
                        members.push($(this).val());
                    }
                    
                    if($(this).prop("checked")==false){
                        var removeItem = $(this).val();
                        members = jQuery.grep(members, function(value) {
                            return value != removeItem;
                        });
                    }
                });
                
                $(".MultipleRemove").on("click", function(){
                    var r = confirm("Delete the member?");
                    if (r == true) {
                        DeleteMultipleRecord()
                    }
                });
                $(".pagination-btn").on("click",function(){
                    window.location.replace("/Committee/remove_members.php?p="+$(this).val());
                })
                function Remove(id){
                    var r = confirm("Delete the member? " + id);
                    if (r == true) {
                        window.location.replace("/Committee/remove_members.php?m="+id+"&p=".$(".hdn_paginate").val());
                    }
                }
            });
        </script>
    </body>
</html>