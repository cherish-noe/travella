<?php 
session_start();
include('includes/connect.php');
require('includes/AutoID_Function.php');

//save button
if (isset($_POST['btnregister'])) 
{
  if(strcmp($_SESSION['code'],$_POST['code'])!=0)
  {
    echo"<script>window.alert('Security Does Not Match')</script>";
  }
  else
  {
      $companyID=$_POST['txtcompanyID'];
      $userName=$_POST['txtusername'];
      $companyName=$_POST['txtcompanyname'];
      $address=$_POST['txtlocation'];
      $email=$_POST['txtcompanyemail'];
      $password1=$_POST['password1'];
      $password2=$_POST['password2'];
      $phone=$_POST['txtphone'];
      $description=$_POST['txtdesc'];
      $acc_dob=date("Y-m-d");
      $Folder="photo/company_images/";
  
  //image--------------------------
  $image=$_FILES['Image']['name'];
  $size=$_FILES['Image']['size'];
  if ($size>7000000) 
  {
    echo "<p>The site does not allow image size greater than 7,000,000 bytes.</p>";
  }
  if ($image) 
  {
    $generateid=date('ymdhms');
    $filename=$Folder.$generateid."_".$image;
    $copied=copy($_FILES['Image']['tmp_name'],$filename);
    if(!$copied)
    {
      exit('Error in Image Upload.');
    }
  }
  //--------------------------------

  //checking the duplicate data
  $samecheck="SELECT * FROM company,user
              WHERE COMPANYNAME='$companyName'
              OR EMAIL='$email'
              OR USERNAME='$userName'";
  $retcheck=mysql_query($samecheck);
  $countrow=mysql_num_rows($retcheck);

  $check="SELECT * FROM admin
              WHERE EMAIL='$email'";
  $ret=mysql_query($check);
  $count=mysql_num_rows($ret);

  if($countrow!==0 || $count!==0)
  {
    echo "<script>window.alert('The Info of $companyName Or $userName Already Exist.')</script>";
    echo "<script>window.location='company_registration.php'</script>";
  }
  else
  {
    $insertcompany="INSERT INTO company
            (USERID,COMPANYNAME,ADDRESS,PROFILE_IMAGE,SHORT_DESCRIPTION,ACCOUNT_DOB,STATUS)
            VALUES
            ('$companyID','$companyName','$address','$filename','$description','$acc_dob','Pending')";
    $retcompany=mysql_query($insertcompany);

    $insertuser="INSERT INTO user
            (USERID,USERNAME,EMAIL,PASSWORD,PHONENO,ROLE)
            VALUES
            ('$companyID','$userName','$email','$password1','$phone','Company')";
    $retcompany=mysql_query($insertuser);

      if($retcompany)
      {
          echo "<script>window.alert('Company is successfully registered! Your account is submited for verification. You can use it within an hour.')</script>";
          echo "<script>window.location='company.php'</script>";
      }
      else
      {
        echo "<p>Error in Company Infomation Insert:" .mysql_error()."</p>";
      }
    }
  }
}
//End of save
?>
<html class="no-js">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Register</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<!-- CS Select -->
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">
	<link rel="stylesheet" href="fonts/fontawesome-4.6.3.min.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/company.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<style>
	 #tabs .tabs-nav > a {
  float: left;
  width: 50%;
  text-align: center;
  font-size: 13px;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #ccc;
  padding: 40px 0 20px 0;
  border-bottom: 1px solid transparent;
  margin-bottom: -1px;
  position: relative;
  -webkit-transition: 0.3s;
  -o-transition: 0.3s;
  transition: 0.3s;
}
	</style>
	</head> 
	<body> 
		<div id="fh5co-wrapper">   
		<div id="fh5co-page"> 
		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container"> 
				<div class="nav-header"> 
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="home(index.php"><i class="fa fa-bus"></i>Travella</a></h1>
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="home(index.php">Home</a></li>
							<li><a href="tourpackage.html">Tour Packages</a></li>
							<li><a href="#" onClick="document.getElementById('id02').style.display='block'" >Contact Us</a></li>
                            <li><a href="customer-register.html">SingUp</a></li>
                            <li><a href="#">|</a></li>
                            <li><button onClick="document.getElementById('id01').style.display='block'" style="width:100px;padding:10px;"class="btn btn-primary btn-block" >Login</button></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<!-- end:header-top -->
        </div> 
        </div> 
        <!--register-nav-->
        <div id="tabs">
        <nav class="tabs-nav">
					<a href="customer-register.html"  >
						<span>Customer Register</span>
					</a>
					<a href="#" class="active">
						<span>Company Register</span>
					</a>
				</nav>
        </div>
        </div>
        <!--end register-nav--->
        <div class="register-align"> 
 					<h3 style="padding-top:100px;color:#ff8000;">Register Your Company Account</h3>
                        <form action="company_registeration.php" method="post" enctype=""multipart/form-data">
                        <input type="hidden" name="txtcompanyID" value="<?php echo AutoID('User','UserID','U-',6) ?>">
                        <label><p>User Name:</p></label><br>
      					<input type="text" name="txtusername" class="form-control" required><br>
                        <label><p>Company Name:</p></label><br>
      					<input type="text" name="txtcompanyname" class="form-control" required><br>
                        <label>Location:</label><br>
      <input type="text" name="txtlocation" placeholder="Enter Company Address"  class="form-control" required><br>
                       	<label><p>Email Address:</p></label><br>
      					<input type="text" name="txtcompanyemail" class="form-control" required><br>
                        <label><p>Password:</p></label><br>
      					<input type="password" name="password1" class="form-control" required><br>
                        <label><p>Retype Passowrd:</p></label><br>
      					<input type="text" name="password2" class="form-control" required><br>
                        <label><p>Phone Number:</p></label><br>
      					<input type="text" name="txtphone" class="form-control" required><br>
                        <label><p>Short Description:</p></label><br>
                        <textarea name="txtdesc" class="form-control" rows="2" cols="20" class="form-control"></textarea><br><br>
                        <label><p>Profile Image:</p></label><br>
                        <div id="uploadbutton" class="btn btn-primary btn-block browse" style="background-color:#004d4d;">Upload&nbsp;&nbsp;<i class="fa fa-upload"></i></div>
      <input type="file" name="Image" id="upload" style="visibility:hidden">
      <br>
      <div style="border:1px solid #e0e0d1;border-radius:5px;padding:15px;background-color:#ebebe0">
      <img src="includes/generatecaptcha.php?rand=<?php echo rand();?>" id='captchaimg'/>
    <a href='javascript: refreshCaptcha();'>&nbsp;&nbsp;<i class="fa fa-refresh" style="font-size:19px;">&nbsp;&nbsp;Refresh</i></a>
    <script language='javascript' type='text/javascript'>
      function refreshCaptcha()
      {
        var img=document.images['captchaimg'];
        img.src=img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
      }
    </script>
    <label>Security Answer</label><br>
    <input type="text" class="tbox" name="code" id="code" placeholder="Enter Security Answer" required/>
  </div><br><br>
                        <input type="reset" name="btncancel" value="Cancel" id="btcancel" class="btn btn-primary btn-block">
                        <a href="index.html"><input type="submit" name="btnregister" value="Register" id="btsubmit" class="btn btn-primary btn-block"></a>
                        <div style="clear:both"></div>
                        <p>Account Already Exit? | <a href="user_login.php">Log-in</a></p>
                        </form>
						</div>
        <!--end company-register-->
       
         <!-- Footer -->
	<footer style="margin-top:80px;">
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="#"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
							<p>Copyright 2018 <a href="#">Travella</a>. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a href="http://freehtml5.co/" target="_blank">Freehtml5.co</a> / Desingned by <a href="https://unsplash.com/" target="_blank">W3layouts</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<!-- //Footer -->
        
        <!----login box----->

<div id="id01" class="modal">
  <form class="modal-content animate" action="http://www.w3schools.com/howto/action_page.php">
<span class="close2">&times;</span>
	<div class="contact-titlecontainer">
      <h2>Login Here!</h2>
    </div>
    
    <div class="contact-container">
      <label>Email Address</label><br>
      <input type="text" name="txtemail" class="form-control" required><br>

      <label>Password</label><br>
      <input type="password" name="password" class="form-control" required> <br>

      <a href="company.html"><button type="submit" class="btn btn-primary btn-block" name="btnlogin">Login</button></a>
       <p style="text-align:center">Or</p>
    </div>
	<!---style="background-color:#f1f1f1"--->
    <div class="contact-container1" style="margin-top:-2em;">
    <button type="submit" class="facebook" name="btnfacebook">Facebook</button>
    <button type="submit" class="google" name="btngoogle">Google</button>
    </div>
    
    <div class="contact-container3" style="margin-left:15px;">
    <hr>
    <p style="font-size:12px;">By creating an account, you agree to <a href="#">our Terms and Conditions</a> and <a href="#">Privacy Statement</a>.</p>
    </div>
    
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');
var span2 = document.getElementsByClassName("close2")[0];
span2.onclick = function() {
    modal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == (modal || modal2) ) {
        modal.style.display = "none";
    }
}
</script>


<!----end----->



<!----contact box----->

<div id="id02" class="modal">
  <form class="modal-content animate" action="http://www.w3schools.com/howto/action_page.php">
<span class="close">&times;</span>
	<div class="contact-titlecontainer">
      <h2>Contact Us Here!</h2>
    </div>
    
    <div class="contact-container">
    
       <label>Name</label><br>
      <input type="text" name="txtcontact_name" class="form-control" required> <br>
      	
      <label>Email Address</label><br>
      <input type="text" name="txtcontact_email" class="form-control" required><br>

      <label>Phone Number</label><br>
      <input type="text" name="txtcontact_phone" class="form-control" required> <br>

  	  <label>Message</label><br>
      <textarea name="txtareamessage" class="form-control" rows="1" cols="20" required/></textarea><br>
      
      
    </div>
	<!---style="background-color:#f1f1f1"--->
    <div class="contact-container2" style="margin-top:-1em;background-color:#e6e6e6;">
    <button type="submit" class="canclebtn" name="btncancel" >Cancel</button>
    <button type="submit" class="submitbtn" name="btnsend">Send</button>
    </div>
    
    
    </div>
  </form>
</div>

<script>
var modal2=document.getElementById('id02');
var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
    modal2.style.display = "none";
}

</script>


<!----end----->


<!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	
	<!-- Main JS -->
	<script src="js/main.js"></script>
        
</body>
</html>
</body>
</html>