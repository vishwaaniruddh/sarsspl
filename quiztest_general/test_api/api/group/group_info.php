<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




$userid=$_POST['userid'];
// $userid=166;

$sql=mysql_query("SELECT CONCAT(member0,',',member1,',',member2,',',member3,',',created_by) as all_members,group_name,id,created_by FROM groups",$con);


while($sql_result=mysql_fetch_assoc($sql)){
    
    
    $all_members=$sql_result['all_members'];
    
    $member_arr=explode(',',$all_members);
    
  for($i=0;$i<count($member_arr);$i++){
    
            if($member_arr[$i]==$userid){
            
        
                    $group_name=$sql_result['group_name'];
                    
                    $group_members_all=$sql_result['all_members'];
                    
                    $group_members_all=explode(',',$group_members_all);
                    
                    
                
                    $id=$sql_result['id'];
                    $admin_id=$sql_result['created_by'];
                    $admin_name=get_name($admin_id,TRUE);
                
                
                    $get_group_info_sql=mysql_query("select CONCAT(member0,',',member1,',',member2,',',member3) as group_members from groups where group_name='".$group_name."'",$con);
                    
                                while($get_group_info_sql_result=mysql_fetch_assoc($get_group_info_sql)){
                                    
                                    $group_members=$get_group_info_sql_result['group_members'];
                                    
                                    $group_members=explode(',',$group_members);
                
                                    
                                    foreach($group_members as $key=>$value){
                                        
                                     
                                        if($value){
                                        $group_members_name[]=['id'=>$value,'status'=>get_status($value),'name'=>get_name($value,true)];                            
                                        }
                
                                     
                                    }        
                                }
                
                
                    $data[]=['data'=>['group_id'=>$id,'group_name'=>$group_name,'admin_id'=>$admin_id,'status'=>get_status($admin_id),'admin_name'=>$admin_name,'group_members_name'=>$group_members_name]];
                    $group_members_name='';
         }
  
    }
}

echo json_encode($data);

?>
