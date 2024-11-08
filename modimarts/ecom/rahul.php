<select id="pcat" name="pcat" class="form form-full">

<?php 









//===============================

$catarr="";

$maincat=mysqli_query($con1,"SELECT id FROM `main_cat` where under='".$clintctf[0]."'");

while($maincatf=mysqli_fetch_row($maincat))

{

    if($catarr==""){

    $catarr=$maincatf[0];

    }else{

        

      $catarr=$catarr.','.$maincatf[0];

        

    }

}

//==========================



<?php

    $querycat1=mysqli_query($con1,"SELECT * FROM `main_cat` where under ='".$querycatf[0]."' order by name ");

while($fechcat=mysqli_fetch_array($querycat1))

{

    if($catarr1==""){

    $catarr1=$fechcat[0];

    }else{

        

      $catarr1=$catarr1.','.$fechcat[0];

        

    }

	//==================================

	

	 $querycat2=mysqli_query($con1,"SELECT * FROM `main_cat` where under ='".$fechcat[0]."' order by name "); 

    $fechcatr=mysqli_num_rows($querycat2);

    

    if($fechcatr>0){

	while($fechcat2=mysqli_fetch_array($querycat2))

{

 if($catarr2==""){

    $catarr2=$fechcat2[0];

    }else{

        

      $catarr2=$catarr2.','.$fechcat2[0];

        

    }

}

	}

	

    ?>

  

