<?php
session_start();
include("php/connect.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TRAVELLA:Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ultra Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="../fonts/fontawesome-4.6.3.min.css">
<!-- //font-awesome icons -->
<!--skycons-icons-->
<script src="../js/skycons.js"></script>
<!--//skycons-icons-->

 <!-- js-->
  <script src="j../s/bootstrap.js"></script>
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Comfortaa:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Muli:400,300,300italic,400italic' rel='stylesheet' type='text/css'>
<!--//webfonts-->  
<!-- Metis Menu -->
<script src="../js/metisMenu.min.js"></script>
<script src="../js/custom.js"></script>
<link href="../css/custom.css" rel="stylesheet">
<link href="../../css/style.css" rel="stylesheet">
<!--//Metis Menu -->
<link href="../css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="../js/jquery.sparkline.min.js"></script>
<script type="text/javascript">
    /* <![CDATA[ */
    $(function() {
        /** This code runs when everything has been loaded on the page */
        /* Inline sparklines take their values from the contents of the tag */
        $('.inlinesparkline').sparkline(); 

        /* Sparklines can also take their values from the first argument passed to the sparkline() function */
        var myvalues = [10,8,5,7,4,4,1];
        $('.dynamicsparkline').sparkline(myvalues);

        /* The second argument gives options such as specifying you want a bar chart11 */
        $('.dynamicbar').sparkline(myvalues, {type: 'bar', barColor: '#fff'} );

        /* Use 'html' instead of an array of values to pass options to a sparkline with data in the tag */
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: '#fff'} );

    });
    /* ]]> */
    </script>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class="sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right dev-page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" id="cbp-spmenu-s1">
					<div class="scrollbar scrollbar1">
						<ul class="nav" id="side-menu">
							<li>
								<a href="index.php" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
							</li>
							<li>
								<a href="booking_list.php"><i class="glyphicon glyphicon-list-alt nav_icon"></i>Booking Lists</a>
							</li>
							<li>
								<a href="company_list.php"><i class="fa fa-list-ul nav_icon"></i>Company Lists</a>
							</li>
							<li>
								<a href="manage_issue.php"><i class="fa fa-bug nav_icon"></i>Manage Issues</a>
							</li>
                             <?php if($_SESSION['ADMINID']==='AD-001'){?>
                            <li>
								<a href="admin_registration.php"><i class="fa fa-pencil nav_icon"></i>Admin Registration</a>
							</li>
                            <?php } ?>
						</ul>
					</div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--logo -->
					<h1 id="fh5co-logo"><a href="#"><i class="fa fa-bus"></i>Travella</a></h1>
				<!--//logo-->
				<div class="user-right">
					<div class="profile_details_left"><!--notifications of menu start -->
						<div class="profile_details">		
							<ul>
								<li class="dropdown profile_details_drop">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<div class="profile_img">
											<i class="fa fa-reddit" style="font-size:35px;color:#239023"></i>
                                            <div class="profile_content">
                                            <span style="font-size:16px;font-style:oblique;font-weight:bold;color:#196619"><?php echo $_SESSION["ADMIN_NAME"]; ?></span>
                                            <p style="font-size:13px;font-style:italic;color:#77773c"><?php echo $_SESSION["ADMIN_EMAIL"]; ?></p>
                                            </div>
											<div class="clearfix"></div>	
										</div>	
									</a>
									<ul class="dropdown-menu drp-mnu">
										<li> <a href="#" onClick="document.getElementById('id01').style.display='block'"><i class="fa fa-user" style="color:#239023"></i> Profile</a></li>
                                        <li> <a href="change_psw.php"><i class="fa fa-key" style="color:#e6b800"></i> Change Password</a> </li> 
										<li> <a href="../logout.php"><i class="fa fa-power-off" style="color:red;"></i> Logout</a> </li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
            
                <div class="header-right">
				<button id="showLeftPush"><i class="fa fa-bars" style="color:#ff8000"></i></button>
				<div class="clearfix"> </div>
				<!--toggle button end-->
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<div id="page-wrapper">
			<div class="main-page">
            		<div class="four-grids">
					<div class="col-md-3 four-grid">
                    <a href="booking_list.php"> 
						<div class="four-grid1">
							<div class="icon">
								<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Booking Lists</h3>
								<?php 
									$view="SELECT * FROM booking WHERE STATUS='Pending'";
									$ret=mysql_query($view);
									$countbook=mysql_num_rows($ret);
									echo "<h4>$countbook</h4>";
								?>
                                <br>
							</div>
						</div>
					</div></a>
					<div class="col-md-3 four-grid">
                    <a href="company_list.php">
						<div class="four-grid3">
							<div class="icon">
								<i class="glyphicon glyphicon-th-list" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Manage Company<br><br>& <br><br>Company List</h3>
                                <br>
							</div>
						</div></a>
					</div>
					<div class="col-md-3 four-grid">
                    <a href="manage_issue.php">
						<div class="four-grid4" style="background: #e60000;">
							<div class="icon">
								<i class="fa fa-bug" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Manage Issues</h3>
								<?php 
									$view="SELECT * FROM feedbacks WHERE STATUS='Pending'";
									$ret=mysql_query($view);
									$countissue=mysql_num_rows($ret);
									echo "<h4>$countissue</h4>";
								?>
                                <br>
							</div>
						</div>
                        </a>
					</div>
					
               
                <div class="col-md-3 four-grid">
                <?php if($_SESSION['ADMINID']==='AD-001'){?>
                <a href="admin_registration.php">
						<div class="four-grid5" style="background-color:#8f246b;">
							<div class="icon">
								<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Admin Registration<br><br>& <br><br>Profile Update</h3>
                                <br>
							</div>
						</div></a>
                         <?php } ?>
					</div>
                    <div class="clearfix"></div>
               
			</div>
			<div class="clearfix"></div>
			</div>
			<div class="copy-section">
		<hr style="width:74%;margin-top:60px;">
			<p>TRAVELLA&copy; 2018. All rights reserved | Code by Section-A (Group:4) </p>
			<p style="margin-top:-14px;margin-bottom:-10px;">Design Reference by <a href="http://w3layouts.com">W3layouts</a></p>
		</div>
	</div>
			<!-- Classie -->
				<script src="../js/classie.js"></script>
				<script>
					var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
						showLeftPush = document.getElementById( 'showLeftPush' ),
						body = document.body;
						
					showLeftPush.onclick = function() {
						classie.toggle( this, 'active' );
						classie.toggle( body, 'cbp-spmenu-push-toright' );
						classie.toggle( menuLeft, 'cbp-spmenu-open' );
						disableOther( 'showLeftPush' );
					};
					

					function disableOther( button ) {
						if( button !== 'showLeftPush' ) {
							classie.toggle( showLeftPush, 'disabled' );
						}
					}
				</script>
			<!-- Bootstrap Core JavaScript --> 
				
				<script type="text/javascript" src="../js/bootstrap.min.js"></script>
				<!--scrolling js-->
				<script src="../js/jquery.nicescroll.js"></script>
				<script src="../js/scripts.js"></script>
				<link href="../css/bootstrap.min.css" rel="stylesheet">
               	<!--//scrolling js-->
                    <!---profile box-->
<div id="id01" class="modal">
  <form class="modal-content animate" action='index.php' method='post'>
<span class="close2">&times;</span>
	<div class="contact-titlecontainer">
      <h2>Company Profile!</h2>
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
</body>
</html>
