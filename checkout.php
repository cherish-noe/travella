<?php
require('connect.php');
if(isset($_POST["purchasebtn"]))
{
	$name = $_POST["cuname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$nrc = $_POST["nrc"];
	$gender = $_POST["gender"];
	
	$insertCustomerQuery = "INSERT INTO `customer` (`CUSTOMER_ID`, `CUSTOMER_NAME`, `EMAIL`, `PHONENO`, `NRC`, `REVIEW`, `gender`) VALUES (NULL, '".$name."', '".$email."', '".$phone."', '".$nrc."', NULL, '".$gender."');";
		$connection->query($insertCustomerQuery);
	$expire = date("Y-m-d",strtotime($_POST["cvv"]."-".$_POST["mm"]));
	$insertPayment = "INSERT INTO `payment` (`PAYMENT_TYPE`, `CARD_HOLDER`, `CARD_NUMBER`, `EXPIRE_DATE`, `CVV_NUMBER`, `TOTAL_PRICE`, `STATUS`) VALUES ('credit', '".$_POST['cardname']."', '".$_POST["cardno"]."', '".$expire."', ".$_POST["cvv"].", ".$_POST["price"].", 'pending');";
		$connection->query($insertPayment);
		
		$cidQuery = "SELECT CUSTOMER_ID FROM customer";
		$cid = $connection->query($cidQuery);
		foreach($cid as $c){ $cuid = $c['CUSTOMER_ID'];}

		$pidQuery = "SELECT PAYMENTID FROM payment";
		$pid = $connection->query($pidQuery);
		foreach($pid as $p){ $payid = $p['PAYMENTID'];}
		$sid = ($_POST["trip_type"]=="tour")?null:$_POST["sid"];
		if($_POST["trip_type"]!="tour")
		{
		    $insertBooking = "INSERT INTO `booking` (`CUSTOMER_ID`, `PAYMENTID`, `TRIPDETAILID`, `NO_OF_PASSENGER`, `CHOOSE_SEAT_NO`, `STATUS`) VALUES (".$cuid.", ".$payid.", ".$_POST["tripDetail"].", ".$sid.", '".$_POST["seatID"]."', 'pending');";}
		    else {
		    $insertBooking = "INSERT INTO `booking` (`CUSTOMER_ID`, `PAYMENTID`, `TRIPDETAILID`, `NO_OF_PASSENGER`, `CHOOSE_SEAT_NO`, `STATUS`) VALUES (".$cuid.", ".$payid.", ".$_POST["tripID"].", null, null, 'pending');";}
	$connection->query($insertBooking);
	
	if($_POST["trip_type"]!="tour")
	{
	$seatID  = preg_split("/,/",$_POST["seatID"]);
	
	for($i=0; $i<$sid; $i++)
	{
		$insertSeatDetail = "UPDATE seat_detail SET `SEAT_STATUS`='booked' WHERE BUSID ='".$_POST["bid"]."' AND SEATID=".$seatID[$i];
	}
	}
	if($connection->query($insertBooking) ){ echo "<script>alert('successful');</script>";}
	else {echo "<script>alert('fail');</script>";}
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TRAVELLA:Customer Checkout</title>
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
	<link rel="shortcut icon" href="../../Tour_Bus_Service Project/PHP file/favicon.ico">

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


	<!-- Modernizr JS -->
	<script src="../../Tour_Bus_Service Project/PHP file/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
<!--
	<script>
	function purchase()
	{
		var insertCustomer = "INSERT INTO `customer` (`CUSTOMER_ID`, `CUSTOMER_NAME`, `EMAIL`, `PHONENO`, `NRC`, `REVIEW`, `gender`) VALUES (NULL, '"+document.getElementById("cuname").value;+"', '"+document.getElementById("email").value;+"', '"+document.getElementById("phone").value;+"', '"+document.getElementById("nrc").value;+"', NULL, '"+document.getElementById("gender").value;+"');";
	}
	</script>-->
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
        
        <br>
        <?php if($_POST['trip_type']=="trip"){?>
        <div class="backnav"><a href="home(index.php">Home</a><i class="fa fa-caret-right" style="color:#669900;font-size:18px;"></i><a href="searchbus.php">Search Bus</a><i class="fa fa-caret-right" style="color:#669900;font-size:18px;"></i><a href="seat.php">Choose Seat</a><i class="fa fa-caret-right" style="color:#669900;font-size:18px;"></i><a href="#"><span class="activenav">Checkout</span></a></div>
        <?php }else{?>
        <div class="backnav"><a href="home(index.php">Home</a><i class="fa fa-caret-right" style="color:#669900;font-size:18px;"></i><a href="tourpackage.php">Tour Package</a></div>
        <?php }?>
    <div class="checkout-container">
    <h3 style="color:#394d00">Ticket Collector Info</h3>
    <form action="checkout.php" method="post">
    <hr class="form-hr">
      <div class="table-container">
<table cellspacing="10">
<tr>
<td>
</tr>
<tr>
<td><b>Name</b></td>
<td><input type="text" name="cuname" required /></td>
</tr>
<tr>
<td><b>Email</b></td>
<td><input type="text" name="email" required /></td>
</tr>
<tr>
<td><b>Contact No</b></td>
<td><input type="text" name="phone" required /></td>
</tr>
<tr>
<td><b>NRC</b></td>
<td><input type="text" name="nrc" required /></td>
</tr>
<tr>
<td><b>Gender</b></td>
<td>
<section>
												
													<select class="nationality" name="gender" >
                                                    	<option disabled selected ></option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</section>
</td>
</tr>
</table>
<br>
<br>
<br>
<p style="border:1px solid #c2d6d6;background:#e0ebeb;font-size:13px;border-radius:5px;padding:10px;width:auto;">Having your own tour bus account will be automatically created for you to enjoy faster ticket and tour packages booking services</p>
</div>
<hr> 
<div class="table-container3">
<table cellspacing="10" style="border:1px solid  #d9d9d9;">
<tr>
<th>Choose Payment Type</th>
</tr>
<tr>
<td>
<table style="margin-left:50px;margin-top:20px;margin-right:50px;">
<tr>
<td>
<button class="accordion"><span class="card">CREDIT CARD / DEBIT CARD</span></button>
<div class="panel"><br>
  <h4 style="color:#000;font-weight:560">Credit / Debit Card</h4>
  <input type="text" placeholder="Card number" name="cardno" class="form-control" required><br>
  <label>Expiration Date:</label><br>
  <input type="text" placeholder="MM" name="mm" class="form-control" id="mm" required>
  <input type="text" placeholder="YY" name="yy" class="form-control"  id="yy" required>
  <input type="text" placeholder="CVV" name="cvv" class="form-control" id="cvv" required><br><br>
  <input type="text" placeholder="Name on card" name="cardname" class="form-control" required>
</div>

<button class="accordion"><span class="card">INTERNET BANKING (DIRECT CARD)</span></button>
<div class="panel">
  <p>You can transfer the ticket fee to the following bank accounts:</p>
  <ul type="circle">
  <li>KBZ Bank Acc: 27730427700122501</li>
  <li>AYA Bank Acc: 00993293100032193</li>
  <li>CB Bank Acc:  00861005000080179</li>
  </ul>
</div>

<button class="accordion"><span class="card">CONVENIENT STORES</span></button>
<div id="foo" class="panel">
  <p>Generate code and pay at our convinence partner stores.</p>
  <p>Our partner stores:</p>
  <ul type="square">
  <li>Grab & Go</li>
  <li>1-Stop</li>
  <li>Pay Here</li>
  <li>abc Convinent Store</li>
  </ul>
</div>
</td>
</tr>
</table>
</td>
</tr>

</table>
</div>

</br>
<input type="checkbox"><span style="color:#4d6600">   I agree on Tour Bus's ticketing policy. Please at the pick-up point at least 30 minutes before schedule depature.</span>
</div>
<br>
<div class="detail-container">
<div class="table-container2">
<table cellspacing="10" style="border:1px solid  #d9d9d9;">
<tr>
<th colspan="2">Trip Info</th>
</tr>
<tr>
<td><b>Trip <?php if(isset($_POST["from1"])&& $_POST["from1"]!=null)echo "1";?>:</b></td>
<td><?php echo $_POST["from"];?>,<?php if($_POST["trip_type"]=="tour"){echo $_POST["TOUR_PLACES"].",";}?><?php echo $_POST["to"]?></td>
</tr>
<?php if(isset($_POST["from1"])&& $_POST["from1"]!=null){?>
<tr>
<td><b>Trip 2:</b></td>
<td><?php echo $_POST["from1"];?>,<?php echo $_POST["to1"]?></td>
</tr>
<?php }?>
<tr>
<td><b>Depature Date:</b></td>
<td><?php echo $_POST["deptDate"];?></td>
</tr>
<?php if($_POST["trip_type"]=="trip"){?>
<tr>
<td><b>Bus:</b></td>
<td><?php echo $_POST["cname"];?></td>
</tr>
<?php
$sid  = preg_split("/,/",$_POST["seatID"]);
?>
<tr>
<td><b>Number of Seats:</b></td>
<td><?php echo sizeof($sid);?></td>
</tr>
<tr>
<td><b>Ticket Unit Price:</b></td>
<td><?php echo $_POST["price"];?></td>
</tr>
<tr>
<td><b>Package Unit Price:</b></td>
<td><?php echo sizeof($sid)*$_POST["price"];?></td>
</tr>
<?php }else {?>
<tr>
<td><b>Package Unit Price:</b></td>
<td><?php echo $_POST["price"];?></td>
</tr>
<?php }?>

</table>
</div>
<!----payment info------->
<br><br><br>
<div class="table-container2">
<table cellspacing="10" style="border:1px solid  #d9d9d9;">
<tr>
<th colspan="2">Payment Info</th>
</tr>
<?php if($_POST["trip_type"]=="trip"){?>
<tr>
<td><b>Subtotal Fare:</b></td>
<td><?php echo sizeof($sid)*$_POST["price"];?></td>
</tr>
<?php }else{?>
<tr>
<td><b>Subtotal Fare:</b></td>
<td><?php echo $_POST["price"];?></td>
</tr>

<?php }?>
<tr>
<td><b>Processing Fare:</b></td>
<td>0.0</td>
</tr>
<tr>
<td><b>Discount:</b></td>
<td>0.0</td>
</tr>
<tr>
<td><span style="font-size:16px;font-weight:600;color:#000;">Total</span></td>
<td><?php if($_POST["trip_type"]=="trip"){echo sizeof($sid)*$_POST["price"];} else {echo $_POST["price"];}?></td>
</tr>
</table>
<!----end----->
</div>
<br><br><br>
<input type="hidden" name="from" value="<?php echo $_POST["from"];?>">
<input type="hidden" name="to" value="<?php echo $_POST["to"];?>">
<input type="hidden" name="deptDate" value="<?php echo $_POST["deptDate"];?>">
<input type="hidden" name="cname" value="<?php echo $_POST["cname"];?>">
<?php if(isset($_POST["from1"])){?>
<input type="hidden" name="from1" value="<?php echo $_POST["from1"];?>">
<input type="hidden" name="to1" value="<?php echo $_POST["to1"];?>">
<input type="hidden" name="deptDate1" value="<?php echo $_POST["deptDate1"];?>">
<input type="hidden" name="cname1" value="<?php echo $_POST["cname1"];?>">
<?php }?>

<input type="hidden" name="seatID" value="<?php echo $_POST["seatID"];?>">
<input type="hidden" name="sid" value="<?php echo sizeof($sid)?>">
<input type="hidden" name="price" value="<?php echo $_POST["price"];?>">
<input type="hidden" name="tripDetail" value="<?php echo $_POST["tripDetail"]?>">
<input type="hidden" name="tripID" value="<?php echo $_POST["tripID"]?>">
<input type="hidden" id="TOUR_PLACES" name="TOUR_PLACES" value="<?php echo $_POST["TOUR_PLACES"]?>">
<input type="hidden" name="bid" value="<?php echo $_POST["bid"];?>">
<input type="hidden" name="trip_type" value="<?php echo $_POST['trip_type']?>">
<input type="submit" name="purchasebtn" value="Purchase" style="width:auto;padding:15px;float:right;margin-right:80px;"class="btn btn-primary btn-block">
</div>
</form>
<div style="clear:both"></div>
</div>
	<!-- END fh5co-page -->
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
		
	<!-- END fh5co-wrapper -->
    
    <!-- jQuery -->

	<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>

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