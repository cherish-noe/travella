<!--login-->
 <?php
session_start();
require('organization/admin/php/connect.php');

if(isset ($_POST['btnsignin']))
{
	$email=$_POST['txtemail'];
	$password=$_POST['txtpassword'];
	if ($email=="")
	{
		echo "<script>window.alert('Please Enter Your Email')</script>";
	}
	elseif ($password=="") 
	{
		echo "<script>window.alert('Please Enter Password')</script>";
	}
	else
	{
		$email=mysql_real_escape_string($email);
		$password=mysql_real_escape_string($password);
		
		$check="SELECT u.*,c.* FROM user u,company c
			    WHERE u.USERID=c.USERID
			    AND u.EMAIL='$email'
				AND u.PASSWORD='$password'
				AND c.STATUS='Approved'";

			$ret=mysql_query($check);
			$count=mysql_num_rows($ret);
			$row=mysql_fetch_array($ret);

		$checkadmin="SELECT * FROM admin
			    	 WHERE EMAIL='$email'
					 AND PASSWORD='$password'";
			$retadmin=mysql_query($checkadmin);
			$countrow=mysql_num_rows($retadmin);
			$row1=mysql_fetch_array($retadmin);

			if($count!==1 && $countrow!==1)
			{
				echo"<script> window.alert('Your Email or Password Incorrect Or Your Account Have not Accepted') </script>";
				echo"<script> window.location='user_login.php'</script>";

			}
			else
			{	
				$_SESSION['USERID']=$row['USERID'];
				$_SESSION['ROLE']=$row['ROLE'];
				$_SESSION['USERNAME']=$row['USERNAME'];
				$_SESSION['EMAIL']=$row['EMAIL'];
				$Role=$_SESSION['ROLE'];
				$UserName=$row['USERNAME'];
				switch ($Role) {
					case 'Company':
					echo"<script> window.alert('Welcome $UserName')</script>";
					echo "<script>window.location='organization/company/index.php'</script>";
						break;
					
					default:
					$_SESSION['ADMINID']=$row1['ADMINID'];
					$_SESSION['ADMIN_NAME']=$row1['ADMIN_NAME'];
					$_SESSION['ADMIN_EMAIL']=$row1['EMAIL'];
					$adminName=$row1['ADMIN_NAME'];
					echo"<script> window.alert('Welcome $adminName')</script>";
					echo "<script>window.location='organization/admin/index.php'</script>";
						break;
				}
			}	
	}	
}
?>
<!--login-->
<html class="no-js">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Travella</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="fonts/fontawesome-4.6.3.min.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<!-- CS Select -->
	<link rel="stylesheet" href="css/cs-select.css">
	<link rel="stylesheet" href="css/cs-skin-border.css">
	<link rel="stylesheet" href="css/style.css"> 
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/respond.min.js"></script>
	<style type="text/css">
	.textdisplay{display: none;}
	.textdisplay1{display: none;}
	</style>

	<script type="text/javascript">
		function display()
		{
			$(".textdisplay").show("fast");
			$(".textdisplay1").show("fast");
		}
		function display1()
		{
			$(".textdisplay").hide("fast");
			$(".textdisplay1").hide("fast");
		}
	</script>
	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<header id="fh5co-header-section" class="sticky-banner">  
			<div class="container">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<h1 id="fh5co-logo"><a href="home(index.php"><i class="fa fa-bus"></i>Travella</a></h1>
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active"><a href="index.php"><i class="fa fa-home" style="font-size:27px;margin-top:-6px;"></i></a></li>
							<li><a href="tourpackage.php">Tour Packages</a></li>
							<li><a href="#" onClick="document.getElementById('id02').style.display='block'" >Contact Us</a></li>
                            <li><a href="#">Sing Up</a></li>
                            <li><a href="#">|</a></li>
                            <li><button onClick="document.getElementById('id01').style.display='block'" style="width:100px;padding:10px;"class="btn btn-primary btn-block" >Login</button></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<!-- end:header-top -->
      
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/myanmar-burma-the-lost-town-4794.jpg);">
                <div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<div class="tabulation animate-box">
							  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist">
								      <li role="presentation" class="active">
								      	<a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Bus</a>
								      </li>
                                      <li role="presentation">
								    	   <a href="#packages" aria-controls="packages" role="tab" data-toggle="tab">Tour Packages</a>
								      </li>
								   </ul>                            
								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
                                        <form action="searchbus.php" method="post">
											<div class="col-xxs-12 col-xs-4 mt alternate">
												<div class="input-field">
													<input type="radio"  name="trip_type" value="one" onClick="display1()"  required/>
													<label style="margin-left:10px;"> One Way</label>
												</div>                                         
											</div>
											<div class="col-xxs-12 col-xs-5 mt alternate">
												<div class="input-field" >
													<input type="radio"name="trip_type" value="round" onClick="display()"  required/>
													<label style="margin-left:10px;">Round Trip</label>
												</div>                                          
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
												<section>
													<label>From:</label>
													<select class="cs-select cs-skin-border" name="from">
  															<option value="" disabled selected>Origin</option>
                                                            <?php
																$origin = "SELECT DISTINCT(ORIGIN) FROM TRIP";
																$ret=mysql_query($origin);
																$count=mysql_num_rows($ret);
																//$origins = connection_query($origin);
																for($i=0;$i<$count;$i++)
																{
																	$data=mysql_fetch_array($ret);
																	echo "<option>".$data['ORIGIN']."</option>";
															?>
                                                            <?php } ?>
													</select>
												</section>
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
												<section>
													<label>To:</label>
													<select class="cs-select cs-skin-border" name="to">
  															<option value="" disabled selected>Destination</option>
  															<?php
																$destination = "SELECT DISTINCT(DESTINATION) FROM TRIP";
																$ret=mysql_query($destination);
																$count=mysql_num_rows($ret);
																//$origins = connection_query($origin);
																for($i=0;$i<$count;$i++)
																{
																	$data=mysql_fetch_array($ret);
																	echo "<option>".$data['DESTINATION']."</option>";
															?>
                                                            <?php } ?>

													</select>
												</section>
									
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label>Dept Date:</label>
													<input type="date" class="form-control" name="txtdept_date" id="date-start" palceholder="mm/dd/yy" required/>
												</div>                                          
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate" >
												<div class="input-field">
													<label class='textdisplay'>Return Date:</label>
													<input type="date" class="form-control textdisplay1" name="txtreturn_date"  id="date-end" palceholder="mm/dd/yy"/>
												</div>
											</div>
											<div class="col-xs-12 mt">
												<div class="input-field">
													<label>No of Passenger:</label>
													<input type="number" name="noofpassenger" class="form-control" max="40" min="1" value="" required/> 
												</div>
											</div>
											<div class="col-xs-12">
                                            <div style="margin-top:3em;"></div>
                                           		<input type="submit" class="btn btn-primary btn-block" value="Search Bus">
											</div>
										</div>
									 </div>
									 <div role="tabpanel" class="tab-pane" id="packages">
									 	<div class="row">
											<div class="col-xxs-12 col-xs-6 mt">
												
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
												
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
												</div>
											</div>
											<div class="col-sm-12 mt">
												
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
											</div>
											<div class="col-xxs-12 col-xs-6 mt">
											</div>
											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" value="Search Packages">
											</div>
                                            
										</div>
									 </div>
									</div>
								</div>
							</div>
                            </form>
							<div class="desc2 animate-box">
								<div class="col-sm-7 col-sm-push-1 col-md-7 col-md-push-1">
									<p>Powered by <a href="http://frehtml5.co/" target="_blank" class="fh5co-site-name">uitstudents</a></p>
									<h2>Instant Booking Offer</h2>
									<h3> Online Bus ticket service in Myanmar</h3>
                                    <a href="about_us.php"><input type="button" class="aboutbtn" value="Learn More"></a>
									<!-- <p><a class="btn btn-primary btn-lg" href="#">Get Started</a></p> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

    <!---login box-->
<div id="id01" class="modal">
  <form class="modal-content animate" action='home(index.php' method='post'>
<span class="close2">&times;</span>
	<div class="contact-titlecontainer">
      <h2>Login Here!</h2>
    </div>
    
    <div class="contact-container">
      <label>Email Address</label><br>
      <input type="email" name="txtemail" class="mail form-control" placeholder="Enter email address" required><br>
      <label>Password</label><br>
      <input type="password" name="txtpassword" class="lock form-control" placeholder="Enter password" required> <br>
	  <input type="checkbox" name="remember">&nbsp;&nbsp;&nbsp;Remember me
      <span style="float:right;">Forgot <a href="#">password?</a></span>
      <a href="company_profile.php"><button type="submit" class="btn btn-primary btn-block" name="btnsignin">Login</button></a>
       Don't have an account? Register <a href="company_registration.php">Here!</a>
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
<!--end-->

<!--contact box-->
<div id="id02" class="modal">
  <form class="modal-content animate" action="http://www.w3schools.com/howto/action_page.php">
<span class="close">&times;</span>
	<div class="contact-titlecontainer">
      <h2>Contact Us Here!</h2>
    </div>
    
    <div class="contact-container">
       <label>Name</label><br>
      <input type="text" name="txtcontact_name" class="user form-control" placeholder="Enter name" required> <br>
      <label>Email Address</label><br>
      <input type="email" name="txtcontact_email" class="mail form-control" placeholder="Enter email address" required><br>
  	  <label>Message</label><br>
      <textarea name="txtareamessage" class="form-control" rows="3" cols="20" required/></textarea><br>
      
      
    </div>
    <div class="contact-container2" style="margin-top:-1em;background-color:#e6e6e6;">
    <button type="reset" class="canclebtn" name="btncancel" >Cancel</button>
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


<!--end-->


		</div>
		<!--tour package-->
		<div id="fh5co-tours" class="fh5co-section-gray">
			<div class="container">
				<div class="row">
                <form action="searchbus.php" method="post">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Hot Tours</h3>
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/bagan.png" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<h4 class="package_name">  Yangon-Mandalay-Sagaing-Bagan </h4>
								<h5 class="package_name"> 5 days  </h5>
								<h5 class="package_name">$1,100  </h5>
								
								<a class="btn btn-primary btn-outline" href="checkout.html">Book Now <i class="icon-arrow-right22"></i></a>
						      <a class="details"href="#">Details...  </a>
						        
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/ngapali.png" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<h4 class="package_name">Yangon-Pathein-Chaungtha-CoCo Islands</h4>
								<h5 class="package_name"> 4 days  </h5>
								<h5 class="package_name">$800  </h5>
								
								<a class="btn btn-primary btn-outline" href="checkout.html">Book Now <i class="icon-arrow-right22"></i></a>
						      <a class="details"href="#">Details...  </a>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="images/innlay.png" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive">
							<div class="desc">
								<h4 class="package_name">Mandaly-Amarapura-Taunggyi-Inle Lake-Pindaya Cave</h4>
								<h5 class="package_name"> 6 days  </h5>
								<h5 class="package_name">$1,150  </h5>
								
								<a class="btn btn-primary btn-outline" href="checkout.html">Book Now <i class="icon-arrow-right22"></i></a>
						      <a class="details"href="#">Details...  </a>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center animate-box">
						<p><a class="btn btn-primary btn-outline btn-lg" href="tourpackage.html">See All Offers <i class="icon-arrow-right22"></i></a></p>
					</div>
				</div>
			</div>
		</div>
		<!--end tour package-->
        
        <!-- Footer -->
	<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="fa fa-twitter-square" style="font-size:38px;"></i></a>
								<a href="#"><i class="fa fa-facebook-square" style="font-size:38px;"></i></a>
								<a href="#"><i class="fa fa-pinterest-square" style="font-size:38px;"></i></a>
								<a href="#"><i class="fa fa-google-plus-square" style="font-size:38px;"></i></a>
								<a href="#"><i class="fa fa-instagram" style="font-size:38px;"></i></a>
							</p>
							<p>Copyright 2018 <a href="#">@Travella</a>. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a href="http://freehtml5.co/" target="_blank">Freehtml5.co</a> / Desingned by <a href="https://unsplash.com/" target="_blank">W3layouts</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<!-- //Footer -->
	</div>
	<!-- END fh5co-page -->
	</div>
	<!-- END fh5co-wrapper -->
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

