<?php
session_start();
include('config.php');

//$banner=$_POST['banner'];
//$pos=$_POST['pid'];
//$cnt=$_POST['count'];
$cid=$_POST['cid'];

$uplpth=$ocimagepath."catalog/demo/slider2/";

//echo "werfewt".$cid;
          //  echo " ".$code."-".$cname."-".$key;            
if(basename( $_FILES['banner']['name']) )
 {//echo "image";
 $target1 = basename( $_FILES['banner']['name']); 
 $t1=$uplpth.$target1;
 if(!move_uploaded_file($_FILES['banner']['tmp_name'], $t1)) 
 {
 echo "The file ". basename( $_FILES['banner']['name']). " has not uploaded";
 
 } 
	//insert into banners(position,name,count) values('".$pos."','".$path."',".$cnt.")		

             $path="catalog/demo/slider2/".$target1;
			 
			 $params2='O:8:"stdClass":1:{s:6:"layers";a:4:{i:0;a:20:{s:16:"layer_video_type";s:7:"youtube";s:14:"layer_video_id";s:0:"";s:18:"layer_video_height";s:3:"200";s:17:"layer_video_width";s:3:"300";s:17:"layer_video_thumb";s:0:"";s:8:"layer_id";i:1;s:13:"layer_content";s:12:"no_image.png";s:10:"layer_type";s:4:"text";s:11:"layer_class";s:8:"softred1";s:13:"layer_caption";s:12:"Electronics ";s:15:"layer_animation";s:4:"fade";s:12:"layer_easing";s:11:"easeOutExpo";s:11:"layer_speed";s:3:"350";s:9:"layer_top";s:3:"143";s:10:"layer_left";s:3:"174";s:13:"layer_endtime";s:1:"0";s:14:"layer_endspeed";s:3:"300";s:18:"layer_endanimation";s:4:"auto";s:15:"layer_endeasing";s:7:"nothing";s:10:"time_start";s:3:"400";}i:1;a:20:{s:16:"layer_video_type";s:7:"youtube";s:14:"layer_video_id";s:0:"";s:18:"layer_video_height";s:3:"200";s:17:"layer_video_width";s:3:"300";s:17:"layer_video_thumb";s:0:"";s:8:"layer_id";i:2;s:13:"layer_content";s:12:"no_image.png";s:10:"layer_type";s:4:"text";s:11:"layer_class";s:14:"softred2 green";s:13:"layer_caption";s:7:"creuset";s:15:"layer_animation";s:4:"fade";s:12:"layer_easing";s:11:"easeOutExpo";s:11:"layer_speed";s:3:"350";s:9:"layer_top";s:3:"189";s:10:"layer_left";s:3:"112";s:13:"layer_endtime";s:1:"0";s:14:"layer_endspeed";s:3:"300";s:18:"layer_endanimation";s:4:"auto";s:15:"layer_endeasing";s:7:"nothing";s:10:"time_start";s:3:"800";}i:2;a:20:{s:16:"layer_video_type";s:7:"youtube";s:14:"layer_video_id";s:0:"";s:18:"layer_video_height";s:3:"200";s:17:"layer_video_width";s:3:"300";s:17:"layer_video_thumb";s:0:"";s:8:"layer_id";i:3;s:13:"layer_content";s:12:"no_image.png";s:10:"layer_type";s:4:"text";s:11:"layer_class";s:8:"softred3";s:13:"layer_caption";s:19:"looks of the season";s:15:"layer_animation";s:4:"fade";s:12:"layer_easing";s:11:"easeOutExpo";s:11:"layer_speed";s:3:"350";s:9:"layer_top";s:3:"285";s:10:"layer_left";s:3:"175";s:13:"layer_endtime";s:1:"0";s:14:"layer_endspeed";s:3:"300";s:18:"layer_endanimation";s:4:"auto";s:15:"layer_endeasing";s:7:"nothing";s:10:"time_start";s:4:"1200";}i:3;a:20:{s:16:"layer_video_type";s:7:"youtube";s:14:"layer_video_id";s:0:"";s:18:"layer_video_height";s:3:"200";s:17:"layer_video_width";s:3:"300";s:17:"layer_video_thumb";s:0:"";s:8:"layer_id";i:4;s:13:"layer_content";s:12:"no_image.png";s:10:"layer_type";s:4:"text";s:11:"layer_class";s:10:"btn-detail";s:13:"layer_caption";s:93:"    &lt;a href=&quot;#&quot; class=&quot;btn btn-default radius-x&quot;&gt;shop now&lt;/a&gt;";s:15:"layer_animation";s:4:"fade";s:12:"layer_easing";s:11:"easeOutExpo";s:11:"layer_speed";s:3:"350";s:9:"layer_top";s:3:"352";s:10:"layer_left";s:3:"178";s:13:"layer_endtime";s:1:"0";s:14:"layer_endspeed";s:3:"300";s:18:"layer_endanimation";s:4:"auto";s:15:"layer_endeasing";s:7:"nothing";s:10:"time_start";s:4:"1600";}}}';
			 
			         $qry="INSERT INTO `oc_pavosliderlayers`(`title`, `parent_id`, `group_id`, `params`, `layersparams`, `image`, `status`, `position`, `language_id`) VALUES('',0,19,'','".$params2."','".$path."',1,'".$_POST['pos']."',1)";
			// echo $qry;
			  $res=mysqli_query($con3,$qry);
			  
			 $subid=mysqli_insert_id($con3);
			    $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add carousel slider Image ','".$curr_dt."','".$_SESSION['lastSubID']."','". $subid." ','oc_pavosliderlayers') ");
		
	
			  
			  
                if($res!=""){
	 header('location:viewBanners.php?');
//  echo $pos;

 	
				}else
				{
             echo mysqli_error($con3);	    
             echo "Error Occured";
}
  
 header("location:viewBanners.php");	
                          
 }
?>
