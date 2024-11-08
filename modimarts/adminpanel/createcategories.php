<?php

/*

session_start();

    ob_start();

        if(!isset($_SESSION['admin'])) {

        header('Location:index.php');    

        exit;

    }*/

include('config.php');



      // $city=$_GET['ccode'];

             $qry="select * from main_category";
               $result=mysql_query($qry);  
			  
		
			  

                

  $out="<h1 align='center'>NEW CATEGORY</h1>

<form action='processCreateCat.php' method='post'>


 
  <table align='center' border='0' width='50%'>

<tbody>

<tr height='30'>

<td align='center' width='30%'>Category Code</td>
   <td width='100%'><select name='cid' id='cid' style='width=80'>";
         
           while($row = mysql_fetch_row($result))
		{
             			  
      $out=$out."<option value=".$row[1].">".$row[1]."</option>";
                } 
				$out=$out."</select></td></tr>

<tr height='30'>

<td align='center'>Category Name</td>

<td><input name='cname' id='cname' size='50' type='text' /></td></tr>

<tr height='30'>

<td align='center'>Keywords</td>

<td><input name='add1' id='add1' size='50' type='text' /></td></tr>

<tr>

<td colspan='2' align='center'><input value='Create' type='submit' /></td></tr>";

                 



                   echo $out.'</tbody></table></form>';

?>