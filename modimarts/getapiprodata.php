<?php
include_once 'apidata.php';
$range=$_POST['Range'] ;
// var_dump($range);
 ?>


<div class="table-wrapper">
    <table class="fl-table" border="1">
      <thead>
              <tr>
                   <th><a href="https://allmart.world/catalog-product">Total Product</a></th>
                         <th><a href="https://allmart.world/catalog-product?category_id=5&range=<?=$range?>"> Backpack &amp; Travel Bag</a></th>
                    <th><a href="https://allmart.world/catalog-product?category_id=55&range=<?=$range?>"> Electronics &amp; Home</a></th>
                    <th><a href="https://allmart.world/catalog-product?category_id=58&range=<?=$range?>"> Health Care</a></th>
                    <th><a href="https://allmart.world/catalog-product?category_id=1&range=<?=$range?>"> Kid's</a></th>
                    <th><a href="https://allmart.world/catalog-product?category_id=2&range=<?=$range?>"> Men</a></th>
                    <th><a href="https://allmart.world/catalog-product?category_id=6&range=<?=$range?>"> Sports Club</a></th>
                    <th><a href="https://allmart.world/catalog-product?category_id=3&range=<?=$range?>"> Women</a></th>
                               
      <th><a href="https://allmart.world/list/value-offer/803">Value Offer</a></th>
        </tr>
        </thead>
        <tbody>
        	<?php 
        	$cat5=GetTotalRecordsByrange(5,$range);
        	$cat55=GetTotalRecordsByrange(55,$range);
        	$cat58=GetTotalRecordsByrange(58,$range);
        	$cat1=GetTotalRecordsByrange(1,$range);
        	$cat2=GetTotalRecordsByrange(2,$range);
        	$cat6=GetTotalRecordsByrange(6,$range);
        	$cat3=GetTotalRecordsByrange(3,$range);
        	$totalpro=$cat5+$cat55+$cat58+$cat1+$cat2+$cat6+$cat3;
        	
        	 ?>
         
        <tr>
            <td><a href="https://allmart.world/catalog-product?range=<?=$range?>"><?=$totalpro?></a></td>
            
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=5&range=<?=$range?>"><?=$cat5?></a></td>
     
     
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=55&range=<?=$range?>"><?=$cat55?></a></td>
     
     
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=58&range=<?=$range?>"><?=$cat58?></a></td>
     
     
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=1&range=<?=$range?>"><?=$cat1?></a></td>
     
     
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=2&range=<?=$range?>"><?=$cat2?></a></td>
     
     
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=6&range=<?=$range?>"><?=$cat6?></a></td>
     
     
          
          
          <td><a href="https://allmart.world/catalog-product?category_id=3&range=<?=$range?>"><?=$cat3?></a></td>
     
          <td><a href="https://allmart.world/list/value-offer/803">68</a></td> 
        </tr>
       
        <tbody>
    </table>
</div>