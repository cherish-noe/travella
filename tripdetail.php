<?php require('connect.php');?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<style>
.trip-detail{
	margin-left: 20%;
	margin-right: 20%;
}
.trip-detail table {
    border-collapse: collapse;
	width: 80%;
    height: 30%;
    margin:auto;
    text-decoration:bold; 
}
.trip-detail th  {
    text-align: center;
   
}
.trip-detail td {
    text-align: center;
    padding : 10px;
   
}
.trip-detail tr:nth-child(even){background-color: #fff5cc;}
</style>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Travel &mdash; 100% Free Fully Responsive HTML5 Template by FREEHTML5.co</title>
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
							<li class="active"><a href="home(index.html">Home</a></li>
							<li><a href="tourpackage.php">Tour Packages</a></li>
							<li><a href="#" onClick="document.getElementById('id02').style.display='block'" >Contact</a></li>
                            <li><a href="register.html">SingUp</a></li>
                            <li><a href="#">|</a></li>
                            <li><button onClick="document.getElementById('id01').style.display='block'" style="width:100px;padding:10px;"class="btn btn-primary btn-block" >Login</button></li>
						</ul>
					</nav>
				</div>
			</div>
		</header>

		<!-- end:header-top -->
		<form action="checkout.php" method="post">
		<?php 
		
		$tour_package = "SELECT DESCRIPTION, TOUR_PLACES, HOTEL, OTHER_SERVICE, PHOTO1, PHOTO2, PHOTO3, PHOTO4 FROM tour_package where TRIPID='".$_POST["tripID"]."'";
		$tripDetail = $connection->query($tour_package);
		foreach($tripDetail as $td){
		?>
        <br><br>
        <div class="trip-detail">
<img  class="detail_img" src="<?php echo 'organization/company/'.$td['PHOTO1'];?>" alt="Mountain View" style="width:650px;height:400px;">
<?php if(isset($td['PHOTO2'])||isset($td['PHOTO3'])||isset($td['PHOTO4'])){ ?>
<img  class="detail_img" src="<?php echo $td['PHOTO2'];?>" alt="" style="width:320px;height:200px;margin-right:8px;" >
<img  class="detail_img" src="<?php echo $td['PHOTO3'];?>" alt="" style="width:320px;height:200px;">
<img  class="detail_img" src="<?php echo $td['PHOTO4'];?>" alt="" style="width:320px;height:200px;margin-right:8px;" >
<div style="clear:both"></div>
<?php } ?>
<table>  
<tr> 
<th colspan="2" > &nbsp &nbsp  &nbsp &nbsp  <h2 style="color:#F78536;
	font-weight:bold;
	font-family:"Open Sans", Arial, sans-serif;"><?php echo $_POST["from"];?>,<?php echo $_POST["TOUR_PLACES"].",";?><?php echo $_POST["to"]?></h2> </th>
</tr> 

<tr>
   <td>Price</td>
    <td><?php echo $_POST["price"];?></td>
  </tr>
  <tr>
    <td>From_To</td>
    <td><?php echo $_POST["from"]?> </td>
  </tr>
  <tr>
    <td>Duration</td>
    <td><?php echo $_POST["duration"]?> </td>
  </tr>
  <tr>
    <td>Day 1 </td>
    <td> <?php echo $_POST["from"]?> </td>
  </tr>
  <?php
  $places = preg_split("/,/",$_POST["TOUR_PLACES"]);
  for($day=0;$day<sizeof($places);$day++){
  ?>
   <tr>
    <td>Day <?php echo $day+2;?></td>
    <td><?php echo $places[$day];?> </td>
  </tr>
  <?php }?>
  <tr>
    <td>Day <?php echo $day+3;?></td>
    <td><?php echo $_POST["to"];?> </td>
  </tr>
</table>
<br> <br>
<dt>Summary </dt>
<dd><?php echo $td["DESCRIPTION"]?></dd>
 </dl>  
  <h1 style="margin-left:200px; color:#ff8000"> Included Activies </h1>
  <dl class="dlist" > 
  <dt>ACCOMMODATION</dt>
<dd><?php echo $td["HOTEL"]?> </dd><br>
<dt> OTHERS </dt>
<dd><?php echo $td["OTHER_SERVICE"]?></dd> 
  </dl>
  </div>
<?php }?>
	<a class="btn btn-primary btn-outline" id="back" href="tourpackage.php"><i class="icon-arrow-left22"></i>Back </a>
  <input class="btn_style" type="submit" value="BOOK NOW"  onClick="document.getElementById('price').value='<?php echo $_POST["price"]; ?>'; document.getElementById('deptDate').value='<?php echo $_POST["deptDate"]; ?>'; document.getElementById('from').value='<?php echo $_POST["from"]; ?>'; document.getElementById('TOUR_PLACES').value='<?php echo $td["TOUR_PLACES"]; ?>'; document.getElementById('to').value='<?php echo $_POST["to"]; ?>';"></a>
  <input type="hidden" name="trip_type" value="tour">
   <input type="hidden" id="price" name="price">
   <input type="hidden" id="deptDate" name="deptDate">
   <input type="hidden" id="from" name="from">
   <input type="hidden" id="TOUR_PLACES" name="TOUR_PLACES">
   <input type="hidden" id="to" name="to">
   <input type="hidden" id="tripID" name="tripID">
   <input type="hidden" id="duration" name="duration">
<br>
<br>
<br>
<br>
</form>
</div>
</div>
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
      <h2>Welcome again!</h2>
    </div>
    
    <div class="contact-container">
      <label>Email Address</label><br>
      <input type="text" name="email" class="form-control" required><br>

      <label>Password</label><br>
      <input type="password" name="password" class="form-control" required> <br>

      <button type="submit" class="btn btn-primary btn-block">Get Started</button>
       <p style="text-align:center">Or</p>
    </div>
	<!---style="background-color:#f1f1f1"--->
    <div class="contact-container1" style="margin-top:-2em;">
    <button type="submit" class="facebook">Facebook</button>
    <button type="submit" class="google">Google</button>
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
      <h2>Contact Us Here</h2>
    </div>
    
    <div class="contact-container">
    
       <label>Name</label><br>
      <input type="text" name="contactname" class="form-control" required> <br>
      	
      <label>Email Address</label><br>
      <input type="text" name="email" class="form-control" required><br>

      <label>Phone Number</label><br>
      <input type="text" name="contactphone" class="form-control" required> <br>

  	  <label>Message</label><br>
      <input type="textarea" name="message" style="height:50px;"class="form-control" required> <br>
      
    </div>
	<!---style="background-color:#f1f1f1"--->
    <div class="contact-container2" style="margin-top:-1em;background-color:#e6e6e6;">
    <button type="submit" class="canclebtn">Cancle</button>
    <button type="submit" class="submitbtn">Submit</button>
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

