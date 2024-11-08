<?php 

function add_video($_filename,$_filesize,$_filetmpname,$dir,$product_id,$con1){
   
           $maxsize = 5242880; // 5MB
           if(isset($_filename) && $_filename != ''){
               $name = $_filename;
               //$target_dir = "videos/";
               //$target_file = $target_dir . $_filename;
        
               // Select file type
               $extension = strtolower(pathinfo($_filename,PATHINFO_EXTENSION));
        
               // Valid file extensions
               $extensions_arr = array("mp4","avi","3gp","mov","mpeg");
        
               // Check extension
               if( in_array($extension,$extensions_arr) ){
                     $time=time();
                     $video_name=$time.'.'.$extension;
                     $videopath=$dir.$video_name;
                     $target_video = "../ecom/".$videopath;
                  // Check file size
                  if(($_filesize >= $maxsize) || ($_filesize == 0)) {
                     $_SESSION['message'] = "File too large. File must be less than 5MB.";
                  }else{
                     // Upload
                     if(move_uploaded_file($_filetmpname,$target_video)){
                       // Insert record
                       $query = "INSERT INTO product_videos(productid,filename,videopath) VALUES('.$product_id.','".$name."','".$videopath."')";
        
                       mysqli_query($con1,$query);
                       $_SESSION['message'] = "Upload successfully.";
                     }
                  }
        
               }else{
                  $_SESSION['message'] = "Invalid file extension.";
               }
           }else{
               $_SESSION['message'] = "Please select a file.";
           }
           
}