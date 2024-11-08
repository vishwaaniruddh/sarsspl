<?php include('../config.php');

if(isset($_POST['category_id'])){

    $category = $_POST['category_id'];
    
    $sql_is_parent = mysqli_query($con,"select * from offline_category  where parent_id = '".$category."' and status=1 order by name ASC");
    
    $is_parent = mysqli_num_rows($sql_is_parent);
    
    $data = '';
    
    if(!$is_parent){
        $data = 'product';
        $sql = mysqli_query($con,"select * from offline_products  where category = '".$category."' and status=1 order by name ASC");
    } else {
        $data = 'subcategory';
        $sql = mysqli_query($con,"select * from offline_category  where parent_id = '".$category."' and status=1 order by name ASC");
    }
    
    $option = "<option value=''>".'Select'."</option>";
    
    while($sql_result = mysqli_fetch_assoc($sql)){
        
        $id = $sql_result['id'];
        $value = $sql_result['name'];
        
        $option=$option."<option value='".$sql_result['id']."'>".$sql_result['name']."</option>";
    }
    
    // echo $option;
    $result = array('data'=>$data,'option'=>$option);
    echo json_encode($result);
}
if(isset($_POST['product_id'])) {
    $pid = $_POST['product_id'];
    
    $sql = mysqli_query($con,"select * from offline_products where id = '".$pid."' ");
    while($result = mysqli_fetch_assoc($sql)){
        $id = $result['id'];
        $name = $result['name'];
        $rate = $result['rate'];
        $qty = $result['qty']; 
        $total_price = $result['total_price'];
        $courier_charge = $result['courier_charge'];
        $data = ['id'=>$id, 'name'=>$name, 'rate'=>$rate, 'total_price'=>$total_price, 'courier_charge'=>$courier_charge,'qty'=>$qty];
        
    }
    
    echo json_encode($data);
    
}
?>