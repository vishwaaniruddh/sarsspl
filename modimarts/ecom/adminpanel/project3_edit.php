<?php
include ("config.php");

         $query="select * from project";
         $get=mysql_query($query);
         while($row=mysql_fetch_array($get))
         {
         echo ("anand");
         
<table border='1'>
    <tr><th>ID</th><th>FirstName</th><th>LastName</th></tr>
    <tr><td><?php echo $row[0];?></td><td></td><td></td></tr>
</table>



}?>
