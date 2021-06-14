<?php
include('connect.php');

?>
<!doctype html>
<html>
<head>  

<style> 
select {
 width:20%;
 border: 2px solid #ff8000;
 padding: 8px;

}
 .sub {
  width: 6%;
  height: 5%;
   border: 2px solid #ff8000;
  }
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Bus</title>
<link rel="stylesheet" href="css/search_bus.css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fonts/fontawesome-4.6.3.min.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
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
							<li class="active"><a href="index.html">Home</a></li>
							<li><a href="tourpackage.php">Tour Packages</a></li>
							<li><a href="#" onClick="document.getElementById('id02').style.display='block'" >Contact Us</a></li>
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
<div class="backnav"><a href="home(index.php">Home</a><i class="fa fa-caret-right" style="color:#669900;font-size:18px;"></i><a href="#"><span class="activenav">Search Bus</span></a></div>
		<hr>
        <form id="gotoseat" method="post" action="seat.php">
        <div class="search-bus">
<table class="bus-header">
<tr>
<th><i class="icon-bus"></i>Bus</th>
<th><i class="icon-clock"></i>Dept Time</th>
<th><i class="icon-credit"></i>Price</th>
<th><i class="icon-credit"></i>Seat</th>
</tr>
</table>
<br>
<?php 
		$from = $_POST["from"];
			$to = $_POST["to"];
			$deptDate = date("Y-m-d",strtotime($_POST["deptDate"]));
			$trip_type = $_POST["trip_type"];	
			echo '<input type="hidden" name="from" value="'.$from.'">';
			echo '<input type="hidden" name="to" value="'.$to.'">';
			echo '<input type="hidden" name="deptDate" value="'.$deptDate.'">';
		echo '<input type="hidden" name="trip_type" value="'.$trip_type.'">';
		
			if($trip_type == "one")
			{
				 $searchBus = "SELECT td.TRIPDETAILID, b.BUSID, c.COMPANYNAME , b.BUS_CLASS, t.DEPARTURE_TIME, t.DURATION, t.PRICE FROM trip t, company c, trip_details td, bus b where t.USERID = c.USERID and td.TRIPID = t.TRIPID and b.BUSID = td.BUSID and t.ORIGIN ='".$from."' and t.DESTINATION = '".$to."' and t.DEPARTURE_DATE = '".$deptDate."';";
				 $returnBusInfo = null;
			}
			else
			{
				$returnDate = date("Y-m-d",strtotime($_POST["return_Date"]));
				echo '<input type="hidden" name="return_Date" value="'.$returnDate.'">';
				$searchBus = "SELECT td.TRIPDETAILID, b.BUSID, c.COMPANYNAME , b.BUS_CLASS, t.DEPARTURE_TIME, t.DURATION, t.PRICE FROM trip t, company c, trip_details td, bus b where t.USERID = c.USERID and td.TRIPID = t.TRIPID and b.BUSID = td.BUSID and t.ORIGIN ='".$from."' and t.DESTINATION = '".$to."' and t.DEPARTURE_DATE = '".$deptDate."'";

				$returnBus = "SELECT td.TRIPDETAILID, b.BUSID, c.COMPANYNAME , b.BUS_CLASS, t.DEPARTURE_TIME, t.DURATION, t.PRICE FROM trip t, company c, trip_details td, bus b where t.USERID = c.USERID and td.TRIPID = t.TRIPID and b.BUSID = td.BUSID and t.ORIGIN ='".$to."' and t.DESTINATION = '".$from."' and t.DEPARTURE_DATE = '".$returnDate."'";
$returnBusInfo = $connection->query($returnBus);
			}
			$searchBusInfo = $connection->query($searchBus);
			$count = mysqli_num_rows($searchBusInfo);
			echo '<p style="font-weight:bold">'.$from.'&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp;'.$to.'</p>';
?>

       <table class="bus-search-list">
        <?php
			if($count!=0){
				foreach($searchBusInfo as $sbi)
{ 

?>
<tr>
<?php echo '<td><i class="fa fa-bus" style="color:#f56c0a;font-size:30px;"></i>&nbsp;&nbsp;<span>'.$sbi["COMPANYNAME"].'</span><p>&nbsp;['.$sbi["BUS_CLASS"].']</p></td>';?>
<?php echo '<td><i class="fa fa-clock-o" style="color:#f56c0a;font-size:25px;"></i>&nbsp;&nbsp;<span>'.$sbi["DEPARTURE_TIME"].'<p>Duration: '.$sbi["DURATION"].'</p></td>';?>
<?php echo '<td><span>'.$sbi["PRICE"].'</span><p>MMK / Person</p></td>';?>
<td><input type="submit" id="btngo" onClick="document.getElementById('bid').value='<?php echo $sbi["BUSID"];?>'; document.getElementById('cname').value='<?php echo $sbi["COMPANYNAME"];?>'; document.getElementById('price').value='<?php echo $sbi["PRICE"];?>';document.getElementById('tripDetail').value='<?php echo $sbi["TRIPDETAILID"];?>'; document.getElementById('trip').value='go';"  value="View Seat" class="submitbtn"></td>
</tr>
<?php }}
else echo '<p style="color:red;"><center>Result Not Found!</center></p>';
?>

</table>
<br>
<br>
<hr class="bus-hr">
<?php 
if($returnBusInfo!=null)
{
	echo '<p style="font-weight:bold">'.$to.'&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i>&nbsp;&nbsp;'.$from.'</p>';
?>
<table class="bus-search-list">
<?php foreach($returnBusInfo as $ri){?>
<tr>
<?php echo '<td><i class="fa fa-bus" style="color:#f56c0a;font-size:30px;"></i>&nbsp;&nbsp;<span>'.$ri["COMPANYNAME"].'</span><p>&nbsp;['.$ri["BUS_CLASS"].']</p></td>';?>
<?php echo '<td><i class="fa fa-clock-o" style="color:#f56c0a;font-size:25px;"></i>&nbsp;&nbsp;<span>'.$ri["DEPARTURE_TIME"].'<p>Duration: '.$ri["DURATION"].'</p></td>';?>
<?php echo '<td><span>'.$ri["PRICE"].'</span><p>MMK / Person</p></td>';?>
<td><input type="submit" id="btnreturn" onClick="document.getElementById('bid').value='<?php echo $ri["BUSID"];?>'; document.getElementById('cname').value='<?php echo $ri["COMPANYNAME"];?>'; document.getElementById('price').value='<?php echo $ri["PRICE"];?>';document.getElementById('tripDetail').value='<?php echo $ri["TRIPDETAILID"];?>'; document.getElementById('trip').value='return';" value="View Seat" class="submitbtn"></td>
</tr>
<?php }?>
</table>
<?php }?>
</div>
<input type="hidden" id="bid" name="bid">
<input type="hidden" id="cname" name="cname">
<input type="hidden" id="price" name="price">
<input type="hidden" id="tripDetail" name="tripDetail">
<input type="hidden" name="noofpassenger" value="<?php echo $_POST["noofpassenger"];?>">
<input type="hidden" id="trip" name="trip">
</div>
</span>
</div>
<br>
<br>
<br>
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
		</footer>
        <!---login box-->

<div id="id01" class="modal">
  <form class="modal-content animate" action='home(index.php' method='post'>
<span class="close2">&times;</span>
	<div class="contact-titlecontainer">
      <h2>Login Here!</h2>
    </div>
    
    <div class="contact-container">
      <label>Email Address</label><br>
      <input type="email" name="txtemail" class="mail form-control" placeholder="Enter email address" ><br>
      <label>Password</label><br>
      <input type="password" name="txtpassword" class="lock form-control" placeholder="Enter password" > <br>
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
      <input type="text" name="txtcontact_name" class="user form-control" placeholder="Enter name" > <br>
      <label>Email Address</label><br>
      <input type="email" name="txtcontact_email" class="mail form-control" placeholder="Enter email address" ><br>
  	  <label>Message</label><br>
      <textarea name="txtareamessage" class="form-control" rows="3" cols="20" /></textarea><br>
      
      
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
    <?php 
        if(isset($_POST["checkout"])){
            if($_POST["trip"]=="go"){
                ?>
        <script>
        	document.getElementById("btngo").disabled="true";</script>
  <?php 
            }else{?>
            	<script type="text/javascript">document.getElementById("btnreturn").disabled="true";</script>
            <?php 
            }
}
        ?>
</body>
</html>
