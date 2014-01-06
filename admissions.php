<?php include 'includes/header.php';?>
<?php
	if (isset($_POST['submit'])) {
	$errors = array();
	$required_field = array('username', 'password', 'program', 'country', 'gender', 'mstatus', 'category', 
	'firstname', 'lastname', 'fathername', 'email', 'address', 'city', 'district', 'state', 'pincode', 'landline',
	  'mobile', 'qualification', 'bankname', 'branchname', 'cnumber', 'amount', 'fee', 'pay');
	foreach ($required_field as $filedname) {
		if (!isset($_POST[$filedname]) || empty($_POST[$filedname])) {
			$errors[] = $filedname;
		}
	}

	$field_with_length = array('username' => 30, 'password' => 40, 'firstname' => 30, 'lastname' => 30,
	'fathername' => 30, 'email' => 30,'address' => 50, 'city' => 30,'district' => 30, 'pincode' => 10,
	'landline' => 12, 'mobile' => 10,'qualification' => 30, 'bankname' => 30,'branchname' => 30, 'cnumber' => 10,
	'amount' => 10, 'fee' => 10);
	foreach ($field_with_length as $filedname => $max_length) {
		if (strlen(trim(mysql_prep($_POST[$filedname]))) > $max_length) {
			$errors[] = $filedname;
		}
	}

	$username = mysql_prep($_POST['username']); 
	$password = mysql_prep($_POST['password']);
	$c_password = mysql_prep($_POST['c_password']);
	$program = mysql_prep($_POST['program']);
	$country = mysql_prep($_POST['country']);
	$gender = $_POST['gender'];
	$mstatus = mysql_prep($_POST['mstatus']);
	$category = mysql_prep($_POST['category']);
	$firstname = mysql_prep($_POST['firstname']);
	$lastname = mysql_prep($_POST['lastname']);
	$fathername = mysql_prep($_POST['fathername']);
	$email = mysql_prep($_POST['email']);
	$address = mysql_prep($_POST['address']);
	$city = mysql_prep($_POST['city']);
	$district = mysql_prep($_POST['district']); 
	$state = mysql_prep($_POST['state']);
	$pincode = mysql_prep($_POST['pincode']);
	$landline = mysql_prep($_POST['landline']);
	$mobile = mysql_prep($_POST['mobile']);
	$qualification = mysql_prep($_POST['qualification']);
	$bankname = mysql_prep($_POST['bankname']);
	$branchname = mysql_prep($_POST['branchname']);
	$cnumber = mysql_prep($_POST['cnumber']);
	$amount = mysql_prep($_POST['amount']); 
	$fee = mysql_prep($_POST['fee']);
	$pay = $_POST['pay'];
	
	//file upload
	$upload_errors = array(UPLOAD_ERR_OK => "No Errors", 
						UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize", 
						UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE", 
						UPLOAD_ERR_PARTIAL => "Partial upload", 
						UPLOAD_ERR_NO_FILE => "No file", 
						UPLOAD_ERR_NO_TMP_DIR => "No temporary directory", 
						UPLOAD_ERR_CANT_WRITE => "Can't write to disk", 
						UPLOAD_ERR_EXTENSION => "File upload stopped by extension", );

	$name = basename($_FILES['file']['name']);
	$tmp_name = $_FILES['file']['tmp_name'];
	$type = $_FILES['file']['type'];
	$max_size = 2097152;
	$size = $_FILES['file']['size'];
	if (isset($name)) {
		$location = 'uploads/';
		$move = move_uploaded_file($tmp_name, $location.$name);
		if (!$move) {
			$fileerror = $_FILES['file']['error'];
			$message = $upload_errors[$fileerror];
		}
	}

	if (!isset($_POST['declaration'])) {
		$error[] = "Accept the declaration";
	}
	if (empty($errors)) {
	$query = "INSERT INTO students( 
	username, password, program, country, gender, mstatus, category, 
	firstname, lastname, fathername, email, address, city, district, state, pincode, landline, 
	mobile, qualification, bankname, branchname, cnumber, amount, fee, pay
	) VALUES(
	'{$username}', '{$password}', '{$program}', '{$country}', '{$gender}', '{$mstatus}', '{$category}', 
	'{$firstname}', '{$lastname}', '{$fathername}', '{$email}', '{$address}', '{$city}', '{$district}', 
	'{$state}', '{$pincode}', '{$landline}', '{$mobile}', '{$qualification}', '{$bankname}', '{$branchname}', 
	'{$cnumber}', '{$amount}', '{$fee}', '{$pay}')";
	$result = mysql_query($query, $connection);
	if ($result) {
		echo "admitted";
		redirect_to("signin.php?login=1");
	} else {
		echo "Subject Creation failed ".mysql_error();
	}
}
}
?>
      <div id="content">
        <div class="content_item">
            <h2><center>Online Admission System</center></h2>
            <p><strong><h3>Login Information</h3></strong></p>
            <?php if (!empty($message)) { echo "<p class=\"errors\">{$message}</p>"; } ?>
            <?php if (!empty($errors)) { echo "<p class=\"errors\">Please review the following field : <br />";
                                  foreach ($errors as $error) {echo "- {$error}<br />"; } echo "</p>";} ?>
            <form method="POST" action="admissions.php" enctype="multipart/form-data">
            <div style="width:200px; float:left;"><p>User Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="username" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Password</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="password" name="password" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Confirm Password</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="password" name="c_password" value="" /></p></div>
            <br style="clear:both;" />
            
            <p><strong><h3>Admission Information</h3></strong></p>
            <div style="width:200px; float:left;"><p>Name of the Program Applied</p></div>
			<div style="width:430px; float:right;"><p>
			<select style="width:155px;" name="program">
			<?php
				$program_result = mysql_query("SELECT name FROM programs");
				while ($array = mysql_fetch_array($program_result)) {
					echo "<option>{$array['name']}</option>";
				}
			?>
			</select>
			</p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Country</p></div>
			       <div style="width:430px; float:right;"><p>
			       <select style="width:155px;" name="country">
				       <option>India</option>
				       <option>Others</option>
			       </select>
			       </p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Gender</p></div>
			<div style="width:430px; float:right;"><p>
			<input class="contact" type="radio" name="gender" value="male" checked />Male
			&nbsp; &nbsp;
			<input class="contact" type="radio" name="gender" value="female" />Female
			</p></div>
            <br style="clear:both;" >
            <div style="width:200px; float:left;"><p>Maritial Status</p></div>
			<div style="width:430px; float:right;"><p>
			<select style="width:155px;" name="mstatus">
				<option>Married</option>
				<option>Unmarried</option>
			</select>
			</p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Category</p></div>
			<div style="width:430px; float:right;"><p>
			<select style="width:155px;" name="category">
				       <option>General</option>
				       <option>OBC</option>
				       <option>SC</option>
				       <option>ST</option>
			</select>
			</p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>First Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="firstname" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Last Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="lastname" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Father Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="fathername" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>E_mail Id</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="email" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Address</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="address" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>City</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="city" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>District</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="district" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>State</p></div>
			<div style="width:430px; float:right;"><p>
			<select style="width:155px;" name="state">
				<option>Delhi</option>
				<option>Others</option>
			</select>
			</p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>PinCode</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="pincode" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Landline Number</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="landline" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Mobile</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="mobile" value="" /></p></div>
            <br style="clear:both;" >
            <div style="width:200px; float:left;"><p>Educational Qualifications</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="qualification" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Upload Photograph</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="file" name="file" value="" /></p></div>
            <br style="clear:both;" />
            
            <p><strong><h3>Payment Confirmation</h3></strong></p>
            <div style="width:200px; float:left;"><p>Program Fee</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="fee" value="" /></p></div>
			<br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Pay By</p></div>
			<div style="width:430px; float:right;"><p>
			<input class="contact" type="radio" name="pay" value="challan" />Challan
			&nbsp; &nbsp;
			<input class="contact" type="radio" name="pay" value="checque" checked />Cheques
			</p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Bank Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="bankname" value="" /></p></div>
			<br style="clear:both;" />
			<div style="width:200px; float:left;"><p>Branch Name</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="branchname" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Challan/Cheque No.</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="cnumber" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p>Amount</p></div>
			<div style="width:430px; float:right;"><p><input class="contact" type="text" name="amount" value="" /></p></div>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p><input class="contact" type="checkbox" name="declaration" value="accept" />&nbsp;Declaration by Applicant</p></div>
            <br style="clear:both;" >
            <div style="width:430px; float:right;"><p style="padding-top: 15px"><input class="submit" type="submit" name="submit" value=" Submit " /></p></div>
            </form>
            <br style="clear:both;" />
            <div style="width:200px; float:left;"><p><a href="index.php">Cancel</a></p></div>
        </div><!--close content_item-->
      </div><!--close content-->  
    </div><!--close site_content-->  
<?php include 'includes/footer.php';?>