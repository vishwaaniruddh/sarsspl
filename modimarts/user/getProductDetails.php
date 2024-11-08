<?php 
    session_start();
    include('config.php');
    // var_dump($_POST);
    $pid=$_POST['id'];
    $Maincate = $_POST['main_cat'];
    $imgdata = array();
if($Maincate==1)
{
    $qry2=mysqli_query($con1,"select f.*,p.product_model,p.brand_id,p.description as pdescription,p.price as pprice,p.others as pothers,p.discount as pdiscount,p.discount_type as pdiscount_type,p.long_desc as pLong_desc,p.status as pstatus from product_model p join fashion f on p.id=f.name where p.id='".$pid."'");
    //$qry2=mysqli_query($con1,"select *  from fashion where name='".$pid."'");
    $sql_statement =mysqli_query($con1,"SELECT * FROM fashion_img where product_id='".$pid."'");
}
else if($Maincate==190)
{
    //$qry2=mysqli_query($con1,"select *  from electronics where name='".$pid."'");
    $qry2=mysqli_query($con1,"select e.*,p.product_model,p.brand_id,p.description as pdescription,p.price as pprice,p.others as pothers,p.discount as pdiscount,p.discount_type as pdiscount_type,p.long_desc as pLong_desc,p.status as pstatus from product_model p join electronics e on p.id=e.name where p.id='".$pid."'");
    $sql_statement = mysqli_query($con1,"SELECT * FROM electronics_img where product_id='".$pid."'");
}
else if($Maincate==218)
{
    //$qry2=mysqli_query($con1,"select *  from grocery where name='".$pid."'");
    $qry2=mysqli_query($con1,"select g.*,p.product_model,p.brand_id,p.description as pdescription,p.price as pprice,p.others as pothers,p.discount as pdiscount,p.discount_type as pdiscount_type,p.long_desc as pLong_desc,p.status as pstatus from product_model p join grocery g on p.id=g.name where p.id='".$pid."'");
    echo "select g.*,p.product_model,p.brand_id,p.description as pdescription,p.price as pprice,p.others as pothers,p.discount as pdiscount,p.discount_type as pdiscount_type,p.long_desc as pLong_desc,p.status as pstatus from product_model p join grocery g on p.id=g.name where p.id='".$pid."'";
    $sql_statement = mysqli_query($con1,"SELECT * FROM grocery_img where product_id='".$pid."'");
}
else 
{
    // $qry2=mysqli_query($con1,"select *  from products where name='".$pid."'");
    $qry2=mysqli_query($con1,"select g.*,p.product_model,p.brand_id,p.description as pdescription,p.price as pprice,p.others as pothers,p.discount as pdiscount,p.discount_type as pdiscount_type,p.Long_desc as plong_desc,p.status as pstatus from product_model p join products g on p.id=g.name where p.id='".$pid."'");
    //echo "select g.*,p.product_model,p.brand_id,p.description as pdescription,p.price as pprice,p.others as pothers,p.discount as pdiscount,p.discount_type as pdiscount_type,p.Long_desc as plong_desc,p.status as pstatus from product_model p join products g on p.id=g.name where p.id='".$pid."'";
    $sql_statement = mysqli_query($con1,"SELECT * FROM product_img where product_id='".$pid."'");
}
    //$qry=mysqli_query($con1,"select *  from product_model where id='".$pid."'");
    //var_dump($qry2);
    $data =array(); 
    while ($rowa = mysqli_fetch_array($qry2)){
       // var_dump($sql_statement);
        while ($row = mysqli_fetch_assoc($sql_statement)){
            //var_dump($row);
            $imgdata[] = $row['img'];
        } 
        //var_dump($imgdata);
        $data[] = array(
            "name"=>$rowa['name'],"others"=>$rowa['pothers'],
            "description"=>$rowa['pdescription'], 
            "brand"=>$rowa['brand'], "category"=>$rowa['category'], 
            "status"=>$rowa['pstatus'],"size"=>$rowa['size'],
            "discnt"=>$rowa['pdiscount'],"color"=>$rowa['color'],
            "discount_type"=>$rowa['pdiscount_type'],"Long_desc"=>$rowa['pLong_desc'],
            "price"=>$rowa['pprice'],"image"=>$imgdata
        );
    }
    echo json_encode($data);
?>