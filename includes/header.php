<?php require_once ("includes/session.php");?>
<?php require_once ("includes/connection.php");?>
<?php require_once ("includes/functions.php");?>
<?php sidebar_navigation_id();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title>IGNOU</title>
  <meta name="description" content="website" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/image_slide.js"></script>
</head>

<body>
  <div id="main">
    <div id="header">
    <div id="banner">
      <div id="welcome">
        <h1>IGNOU</h1>
      </div><!--close welcome-->
      <div id="welcome_slogan">
        <h1>Online Admission System</h1>
      </div><!--close welcome_slogan-->
    </div><!--close banner-->
    </div><!--close header-->
    <?php $basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);?>
  <div id="menubar">
      <ul id="menu">
        <li <?php if ($basename == 'index') echo ' class="current"'; ?>><a href="index.php">Home</a></li>
        <li <?php if ($basename == 'programmes') echo ' class="current"'; ?>><a href="programmes.php">Programmes</a></li>
        <li <?php if ($basename == 'admissions') echo ' class="current"'; ?>><a href="admissions.php">Admissions</a></li>
        <li <?php if ($basename == 'signin') echo ' class="current"'; ?>><a href="signin.php">Sign In</a></li>
        <li <?php if ($basename == 'contact') echo ' class="current"'; ?>><a href="contact.php">Contact Us</a></li>
      </ul>
    </div><!--close menubar-->  
    
  <div id="site_content">   

<?php
  if (isset($_SESSION['user_id'])) {
  echo "<div class=\"sidebar_container\">       
        <div class=\"sidebar\">
        <div class=\"sidebar_item\">
        <h2>Students Dashboard</h2>
        </div><!--close sidebar_item--> 
        </div><!--close sidebar-->";

  $id = $_SESSION['user_id'];
  $query = "SELECT * FROM students WHERE id = {$id}";
  $result = mysql_query($query);
  confirm_query($result);
  $result_set = mysql_fetch_array($result);

  echo "<div class=\"sidebar\">
         <div class=\"sidebar_item\">
         <h3>Welcome  "; 
  echo $result_set['firstname']." ".$result_set['lastname'];
  echo "</h3>
         <p><ul>
         <li><a href=\"change_pass.php\">Change Password</a></li>
         <li>Update Profile</li>
         <li><a href=\"student.php?sid=";
         echo $_SESSION['user_id'];
         echo "\">My Account</a></li>
         <li><a href=\"logout.php\">Sign Out</a></li>
         </ul></p>
  </div><!--close sidebar_item-->
  </div><!--close sidebar-->";
  } else {
    echo "<div class=\"sidebar_container\">";
  }
?>
    <div class="sidebar">
      <div class="sidebar_item">
      <h2>Latest Update</h2>
    </div><!--close sidebar_item--> 
    </div><!--close sidebar-->
         <?php
              $page_set = get_all_page();
              while ($page = mysql_fetch_array($page_set)) {
                echo "<div class=\"sidebar\">
                      <div class=\"sidebar_item\">
                      <h3";
                      if($page['id'] == $sel_page) {
                        echo " class=\"selected\"";
                      }
                      
                      echo ">{$page['menu_name']}</h3>
                      <p>{$page['content']}</p>         
                  </div><!--close sidebar_item-->
                </div><!--close sidebar-->";
              }
            ?>
        <div class="sidebar">
          <div class="sidebar_item">
            <h2>Contact</h2>
            <p>Phone: +91 (0)1234 567891</p>
            <p>Email: <a href="mailto:info@youremail.co.in">info@ignou.co.in</a></p>
          </div><!--close sidebar_item--> 
        </div><!--close sidebar-->
       </div><!--close sidebar_container-->
