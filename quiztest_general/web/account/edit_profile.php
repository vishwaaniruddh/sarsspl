<?php session_start();

include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php');  ?>
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

      <div class="custom_margin"></div>

        <h2 class="profile_head">Edit Profile
        
     
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
 
 
 <form method="POST" action="update_profile.php">
     

 
            <div class="row">
			    <img class="avatar" src="<? echo $result->data->avatar; ?>">
			</div>
            
            
            <div class="custom_margin"></div>

        <div class="row">
                
        <div class="fname col-md-6 form-group">
        			<span>First Name</span>
        			<input type="text" name="fname" value="<? echo ucfirst($result->data->fname);?>">

                        </label>
        		</div>

        		<div class="lname col-md-6 form-group">
        			<span>Last Name</span>
                    <input type="text" name="lname" value="<? echo ucfirst($result->data->lname); ?>">
        		</div>

        </div>
    	
    	
    	<div class="row">
        		<div class="fname col-md-6 form-group">
        			<span>Email</span>
                
                <input type="text" value="<? echo ucfirst($result->data->email);?>" readonly> 
                
        		</div>

    		<div class="lname col-md-6 form-group">
                <span>School</span>
                    <input type="text" name="school" value="<? echo ucfirst($result->data->school);?>">
    		</div>

    	</div>
    	
    	
    	
    	    	<div class="row">
    		<div class="fname col-md-6 form-group">
			<span>Standard</span>

			      <input type="text" name="class1" value="<? echo $result->data->class;?>">
                

    		</div>
    		
    			<div class="fname col-md-6 form-group">
		
    		</div>

    	

    	</div>
    	
        <input type="submit" class="btn btn-success">
    	
    	 </form>
    	 
    	 
    </div>











<? include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php');?>