<? include('config.php'); ?>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<? $id = $_GET['id'];

$member_sql = mysqli_query($con,"select * from new_member where id = '".$id."' and status=1");
$member_sql_result = mysqli_fetch_assoc($member_sql);

 $join_date = $member_sql_result['created_at'];



?>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Joining Date</th>
      <th scope="col">Position Level</th>
      <th scope="col">Position Name</th>
    </tr>
  </thead>
  <tbody>
      
      <?
      
      if($date > '2020-08-21' ){
          
          $sql = mysqli_query($con,"SELECT * FROM new_member WHERE  created_at < '2020-09-1' and created_at > '2020-08-20' and status=1 and intro_id ='".$id."' and id <> '".$id."'");          
      }
      else{
          $till_date = date('Y-m-d', strtotime($join_date . '+10 days'));
        
        $sql = mysqli_query($con,"SELECT * FROM `new_member` WHERE  created_at <= '".$till_date."' and status=1 and intro_id ='".$id."' and id <> '".$id."'");
        
        
      }

      $i=1;
      while($sql_result = mysqli_fetch_assoc($sql)){ 
      
      $mem_id = $sql_result['id'];
      $name = $sql_result['name'];
      $date = $sql_result['created_at'];
      $level = $sql_result['level_id'];
      $star = $sql_result['star'];
      ?>
          
      <td scope="col"><? echo $i; ?></td>
      <td scope="col"><? echo $mem_id;?></td>
      <td scope="col"><? echo $name; ?></td>
      <td scope="col"><? echo date('d-m-Y',strtotime($date)); ?></td>
      <td scope="col"><? echo $level; ?></td>
      <td scope="col"><? echo $star; ?></td>
    </tr>
    
    
      <? $i++; } ?>
      