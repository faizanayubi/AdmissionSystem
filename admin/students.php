<?php require_once ("../includes/session.php");?>
<?php confirm_logged_in(); ?>
<?php require_once ("../includes/connection.php");?>
<?php require_once ("../includes/functions.php");?>
<?php require ("header_admin.php");?>
	  <div id="content">
        <div class="content_item">
		  <h1>Welcome To Counselling Students List</h1>
	      <p><ol>
	      	<?php
	      		$query = "SELECT * 
	   				FROM students";
     			$student_set = mysql_query($query, $connection);
	      		confirm_query($student_set);

	      		while ($student = mysql_fetch_array($student_set)) {
	      			echo "<li>{$student['firstname']} {$student['lastname']}  |  {$student['gender']}  |  
	      			{$student['program']}  |  {$student['category']}  |  {$student['fee']}</li>";
	   			}
	   		?>
	      </ol></p>  
		</div><!--close content_item-->
      </div><!--close content-->   
	</div><!--close site_content--> 
<?php require ("footer_admin.php");?>