<?php session_start();
include_once('header.php');?>
<?php include_once('menu.php');?>

<style>
    .module{
        background: 
        linear-gradient(
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.6)
        ),
        url(http://sarmicrosystems.in/quiztest/web/asset/laptop.jpg);
        background-size: cover;
        width: 100%;
        height: 700px;
        /*margin: 10px 0 0 10px;*/
        position: relative;
        float: left;
    }
.heading h2 {
  font-family: 'Roboto', sans-serif;
  font-weight: 900;
  color: white;
  text-transform: uppercase;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 2rem;
  transform: translate(-50%, -50%);
}
    
</style>   

<div class="banner">
    
    <div class="module">
        
    
    
    <h2 class="heading">My Profile</h2>
    </div>
</div>






    <div class="container">
        <div class"margin" style="margin:2%;">
    
</div>

        <h2 class="profile_head">My Profile
        
        <span class="edit_btn">
            <a href="account/edit_profile.php">
            <img src="http://sarmicrosystems.in/quiztest/web/asset/edit.png">
            </a>
            </span>
            </h2>
            
            
            
           <?

$nodes ='http://sarmicrosystems.in/quiztest_general/api/account/show_account.php';



$node_count = count($nodes);


$userid=$_SESSION['userid'];



$data = array('userid' => $userid,);

for($i=0;$i<$node_count;$i++){
    
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

 $context  = stream_context_create($options);

$result = file_get_contents($nodes, false, $context);

$result=json_decode($result);




  

    
    



    

}
 ?>
 
 <style>
     .avatar{
            height: 150px;
            border: 1px solid #1584ed;
            border-radius: 100px;
            padding: 1%;
            background: #1586ef;
     }
 </style>
            <div class="row">
			    <img class="avatar" src="<? echo $result->data->avatar; ?>">
			</div>
            
            
<div class="custom_margin"></div>
          
    	<div class="row">
    		<div class="fname col-md-6 form-group">
			<span>First Name</span>
			<label><? echo ucfirst($result->data->fname);     ?></label>
    		</div>

    		<div class="lname col-md-6 form-group">
			<span>Last Name</span>
			<label><? echo ucfirst($result->data->lname);       ?></label>
    		</div>

    	</div>
    	
    	
    	    	<div class="row">
    		<div class="fname col-md-6 form-group">
    			<span>Email</span>
    			<label><? echo ucfirst($result->data->email);         ?></label>
    		</div>

    		<div class="lname col-md-6 form-group">
                			<span>School</span>
			<label><? echo ucfirst($result->data->school);     ?></label>
			
    		</div>

    	</div>
    	
    	
    	
    	    	<div class="row">
    		<div class="fname col-md-6 form-group">
			<span>Standard</span>
			<label><? echo ucfirst($result->data->class);    ?></label>
    		</div>
    		
    			<div class="fname col-md-6 form-group">
		
    		</div>

    	

    	</div>
    	
    </div>

















<?php include_once('footer.php');?>