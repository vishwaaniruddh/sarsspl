<?php

/*

session_start();

    ob_start();

        if(!isset($_SESSION['admin'])) {

        header('Location:index.php');    

        exit;

    }*/

include('config.php');



       $city=$_GET['ccode'];
       $clientc=$_GET['clientc'];
       $catarr=array();
       if($clientc!="")
       {
        $sql = mysql_query("select category from clients where code='".$clientc."'");
	    $row = mysql_fetch_array($sql);
	    
	        
	     $catarr=explode(",",$row[0]);  
	    
		//print_r($catarr);
        }
       

              $qry22="select id,name from main_cat where under='$city'";

//echo $qry22;
              $res22=mysql_query($qry22);                

              $num22=mysql_num_rows($res22);
			//echo $num;
$out="";
//$out="<select multiple='multiple' size='5' name='subcat[]' id='subcat' style='width: 22em'>

//<option value='0'>select</option>";

  

    for ($i=0; $i<$num22; $i++) 

                {

                 $cname22 = mysql_result($res22,$i,"name"); 

                 $ccode22 = mysql_result($res22,$i,"id"); 
                 
                 if (in_array($ccode22, $catarr))
                 {
				 				 
$out=$out."<input type='checkbox' name='subcat[]' id='subcat' value='$ccode22' checked/> $cname22<br/>";
}else
{
  $out=$out."<input type='checkbox' name='subcat[]' id='subcat' value='$ccode22' /> $cname22<br/>";  
}
 // $out=$out."=".$ccode;

               }

echo $out;  

?>