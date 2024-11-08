<?php
//connect to mysql and select db
$conn =  mysqli_connect("localhost","sarmicro_1click","Click123*","sarmicro_1click");

if( !empty($conn->connect_errno)) die("Error " . mysqli_error($conn));

//call the recursive function to print category listing
category_tree($_GET['mdi']);

//Recursive php function
function category_tree($catid){
global $conn;


$sql = "select * from main_cat where under ='".$catid."'";
$result = $conn->query($sql);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0) echo '<ul id="collapse_214945721881688183652" class="collapse accordion-body in" >';
 echo '<li class="collapse accordion-body in" class="active"> <a href="">'. $row->name.'</a>';
 category_tree($row->id);
 echo '</li>';
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}
//close the connection
//mysqli_close($conn);





/*
select  id,
        name,
        under 
from    (select * from main_cat
         order by under, id) products_sorted,
        (select @pv := '39') initialisation
where   find_in_set(under, @pv) > 0
and     @pv := concat(@pv, ',', id)




select cat.id , cat.name , subcat.id as SubID , subcat.name as SubCategory from main_cat as cat left join main_cat as subcat on cat.id = subcat.under where cat.under=0 order by cat.id , subcat.id 
*/
/*
$categories = array();

$sql = "SELECT id, name, under FROM main_cat where under=1";
$res = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($res)) {
    $parent = intval($row['under']);
    if (!isset($categories[$parent])) {
        $categories[$parent] = array();
    }
    $categories[$parent][] = $row;
}

//print_r($categories);
$category_string = "";
function build_categories_options($parent, $categories, $level) {
    global $category_string;
    if (isset($categories[$parent]) && count($categories[$parent])) {
        $level .= " - ";
        foreach ($categories[$parent] as $category) {
            $opt_value = substr($level.$category['name'],3);
            $category_string .= '<option value="'.$category['id'].'">'.$opt_value.'</option>';
            build_categories_options($category['id'], $categories, $level);
        }
        $level = substr($level, -3);
    }
    return $category_string;
}
$category_options = build_categories_options(0, $categories, '');
$category_options = '<select name="sel_category" id="sel_category">'.$category_options.'</select>';





echo $category_options;

*/
?>