<?php
session_start();
include 'config.php';
include 'adminaccess.php';


if (isset($_POST['review_id'])) {

        $review_id=$_POST['review_id'];
        $status=$_POST['status'];
        $description=$_POST['description'];
        $rating_count=$_POST['rating_count'];
        mysqli_query($con1,"UPDATE `product_review` SET`status`='".$status."',description='".$description."',rating_count='".$rating_count."' WHERE review_id='".$review_id."'");

        ?>
			<script>
			   alert("Review updated successfully!");    
			    setTimeout(function(){
			        window.location.href='/adminpanel/ManageReview.php';        
			    }, 1500);
			</script>

			<?php

    }
    else
    {
    	?>
		<script>
		       alert("Review Not updated ");    
		    
		    setTimeout(function(){
		        window.location.href='/adminpanel/ManageReview.php';        
		    }, 3000);
		</script>
		<?php
    }

