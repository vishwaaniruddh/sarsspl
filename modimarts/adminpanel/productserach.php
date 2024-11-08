<?php
include("config.php");
$search=$_POST['proname'];

$sql = "(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join electronics as pd on pm.id=pd.name where pm.product_model like '%".$search."%'  and pm.status=1  order by pd.price ) as p group by p.product_model) 

			UNION 

			(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join fashion as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1  order by pd.price ) as p group by p.product_model)
			UNION


			(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join grocery as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1 order by pd.price ) as p group by p.product_model)

			UNION

			(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join services as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1  order by pd.price ) as p group by p.product_model)


			UNION

			(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join products as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1  order by pd.price ) as p group by p.product_model)";


			$query=mysqli_query($con1,$sql);
			while ($prodata=mysqli_fetch_assoc($query)) {
			 		?>
				<option value="<?=$prodata['product_model']?>">
				<?php
		}
       ?>