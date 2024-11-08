<?php 

$imgpath='/ecom/userfiles/570/img/2021/04/16190902131.jpg';
echo $imgpath;

echo "<br/>";

echo $path = $_SERVER['DOCUMENT_ROOT'].$imgpath;
 @chmod($path, 0777);

if (unlink($path)) {    
    echo "success";
} else {
    echo "fail";    
}

// @chmod($imgpath, 0777);
    	
//                     unlink($imgpath);
//             @chmod($htaccess, 0755);
                    // echo "Success";
 ?>