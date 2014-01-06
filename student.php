<?php require_once ("includes/header.php");?>

	<div id="content">
        <div class="content_item">
        <h2>Student's Dashboard</h2>
            <br style="clear:both;" />
            <?php
            $student_fields = array('firstname', 'lastname' , 'program', 'country', 'gender', 'mstatus', 'category', 
            	'fathername', 'email', 'address', 'city', 'district', 'state', 'pincode', 'landline', 'mobile', 
            	'qualification', 'bankname', 'branchname', 'cnumber', 'amount', 'fee', 'pay');
            foreach ($student_fields as $fieldname) {
            	echo "<div style=\"width:120px; float:left;\"><p><h3><b>{$fieldname}</b></h3></p></div>
            		<div style=\"width:430px; float:right;\"><p>{$result_set[$fieldname]}</p></div>
            		<br style=\"clear:both;\" />";
            }
	  		?>
            
        </div><!--close content_item-->
    </div><!--close content-->  
</div><!--close site_content-->
<?php include 'includes/footer.php';?>