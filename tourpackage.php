<?php
require('connect.php');
?>
<!DOCTYPE html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TRAVELLA:Tour Package</title>
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
    <link rel="stylesheet" href="fonts/fontawesome-4.6.3.min.css">
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
	
	<link rel="stylesheet" href="css/style.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
	.fh5co-tours{
		padding-right:0px;
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
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="tourpackage.html">Tour Packages</a></li>
							<!---
                            <li><a href="#">Sing Up/Login</a>
                            <ul class="fh5co-sub-menu">
									<li><a href="#">Sing Up</a></li>
									<li><a href="#">Login</a></li>
								</ul>
                            </li>
                            -->
							<li><a href="#" onClick="document.getElementById('id02').style.display='block'" >Contact</a></li>
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
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->
    <form id="tour" method="post">
					<?php
						$tour_query = "SELECT t.ORIGIN, t.DESTINATION, t.DEPARTURE_DATE, t.DEPARTURE_TIME, t.DURATION, t.PRICE, tp.TRIPID,tp.TOUR_PLACES, tp.photo1, c.COMPANYNAME FROM trip t, tour_package tp, company c WHERE t.TRIPID=tp.TRIPID AND t.USERID=c.USERID";
						$tour = $connection->query($tour_query);
					?>
			<div class="row" >
            <?php foreach ($tour as $t)
			{
			?>
					<div class="col-md-4 col-sm-6 fh5co-tours animate-box" data-animate-effect="fadeIn">
						<div href="#"><img src="<?php echo 'organization/company/'.$t["photo1"];?>" alt="Free HTML5 Website Template by FreeHTML5.co" class="img-responsive"
						style="width:600px;height:300px;">
							<div class="desc">
                            	<h4 class="package_name">  <?php echo $t["ORIGIN"];?>,<?php echo $t["TOUR_PLACES"]?>,<?php echo $t["DESTINATION"];?> </h4>
								<h5 class="package_name"> <?php echo $t["DEPARTURE_DATE"]; ?> ,<?php echo $t["DEPARTURE_TIME"]; ?> ,<?php echo $t["DURATION"]; ?> </h5>
								<h5 class="package_name"><?php echo $t["PRICE"]; ?> </h5>
								
								<input type="submit" class="btn btn-primary btn-outline" value="Book Now" onClick="document.getElementById('tour').action='checkout.php'; document.getElementById('price').value='<?php echo $t["PRICE"]; ?>'; document.getElementById('deptDate').value='<?php echo $t["DEPARTURE_DATE"]; ?>'; document.getElementById('from').value='<?php echo $t["ORIGIN"]; ?>'; document.getElementById('TOUR_PLACES').value='<?php echo $t["TOUR_PLACES"]; ?>'; document.getElementById('to').value='<?php echo $t["DESTINATION"]; ?>'; document.getElementById('tripID').value='<?php echo $t["TRIPID"]; ?>';"><i class="icon-arrow-right22"></i>
						      <input type="submit" value="Details..." onClick="document.getElementById('tour').action='tripdetail.php'; document.getElementById('price').value='<?php echo $t["PRICE"]; ?>'; document.getElementById('deptDate').value='<?php echo $t["DEPARTURE_DATE"]; ?>'; document.getElementById('from').value='<?php echo $t["ORIGIN"]; ?>'; document.getElementById('TOUR_PLACES').value='<?php echo $t["TOUR_PLACES"]; ?>'; document.getElementById('to').value='<?php echo $t["DESTINATION"]; ?>'; document.getElementById('tripID').value='<?php echo $t["TRIPID"]; ?>'; document.getElementById('duration').value='<?php echo $t["DURATION"]; ?>';">
							</div>
						</div>
					</div>
                    <?php }?>
       
	</div>
   <input type="hidden" name="trip_type" value="tour">
   <input type="hidden" id="price" name="price">
   <input type="hidden" id="deptDate" name="deptDate">
   <input type="hidden" id="from" name="from">
   <input type="hidden" id="TOUR_PLACES" name="TOUR_PLACES">
   <input type="hidden" id="to" name="to">
   <input type="hidden" id="tripID" name="tripID">
   <input type="hidden" id="duration" name="duration">
</form>
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

	</body>
</html>

