<?php session_start();
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/menu.php'); 

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
?>


<style>
    section{
        padding:5%;
    }
   section:hover{
        background: #f0eded;
    }
    /*section:hover h3, section:hover p,section:hover td,section:hover li,.note{*/
    /*    color:white;*/
    /*}*/
    h1,h3{
    	text-align: center;
    }
</style>

<section>
    <div class="container">
	<h1>LEADERBOARD RULES</h1>	
	
	<p>Each subject will have an individual leaderboard under 3 categories</p>

	<ul>
		<li>Friends</li>
		<li>Groups</li>
		<li>Other players</li>
		<li>There will also be an overall leaderboard under each category wherein leaderboard scores of all subjects will be
combined</li>
	</ul>
</div>
</section>



<section>

<div class="container">
	<h3>Rules for Individual Quizzes</h3>
	<ul>
	<li>
 Send invitations to friends through email, sms or whats app	
</li>

<li>
 Play with friends, artificial intelligence or other people who may be online	
</li>

<li>
 Each quiz will be of 10 mcq’s with 4 options	
</li>

<li>
 Time limit per mcq. Will be 30 seconds	
</li>

<li>
 A maximum of 3 wins will be counted for each topic in a calendar month	
</li>

<li>
 There will be no negative marking	
</li>

</ul>

</div>

</section>
<div class="custom_margin"></div>



<section>
	<div class="container">
		<h3>Point system- Individual quizzes</h3>

	 <table class="table">
    <thead>
      <tr>
        <th>Correct answer</th>
        <th>1 point for each correct answer</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Completion of quiz</td>
        <td>1 point</td>
       
      </tr>
      <tr>
        <td>Winner of quiz</td>
        <td>5 points in addition to the above</td>
       
      </tr>
      <tr>
        <td>Refer a friend</td>
        <td>25 points</td>
       
      </tr>
    </tbody>
  </table>

 
 
 
 
<span class="note"><span>Note:  </span>In case of a tie, the total time taken to complete the quiz will be considered to declare the winner.</span> 
	</div>
</section>
<div class="custom_margin"></div>


<section>
<div class="container">
	<h3>Rules for Group quizzes</h3>

<ul>
		<li>Send invitations to friends and create groups.</li>
		<li>A maximum of 5 and a minimum of 2 players can form a group.</li>
		<li>Each quiz will be of 10 mcq’s with 4 options.</li>
		<li>Time limit per mcq. Will be 30 seconds.</li>
		<li>A maximum of 3 wins will be counted for each topic in a calendar month</li>
		<li>There will be no negative marking.</li>
		<li>Any member of the group can click the submit button.</li>
		<li>After submit button is pressed, the option that has the most clicks will be chosen</li>
		<li>If all answers are different, i.e. all participants have chosen different options, the answer of the last person will be considered.</li>
		<li>If it’s a tie between group members, e.g. if there are 4 members in a group who have answered and two have chosen option A and two have chosen option B, the answer of the pair that answers last will be considered.</li>
	</ul>	
</div>
</section>
<div class="custom_margin"></div>

<section>
	<div class="container">
		
<h3>Point system-Group quizzes</h3>

 <table class="table">
    <thead>
      <tr>
        <th>Correct answer</th>
        <th>1 point for each correct answer</th>
       
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Completion of quiz</td>
        <td>1 point</td>
       
      </tr>
      <tr>
        <td>Winner of quiz</td>
        <td>5 points in addition to the above</td>
       
      </tr>
    </tbody>
  </table>

	</div>
</section>
<div class="custom_margin"></div>
<? include($_SERVER['DOCUMENT_ROOT'].'/quiztest/web/footer.php'); ?>