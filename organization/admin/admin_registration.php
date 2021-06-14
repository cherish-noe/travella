<?php 
include("php/add_admin.php"); 
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TRAVELLA:Admin Registration and Update Profile</title>
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
<link href="../css/company-lists.css" rel="stylesheet">
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
    <title>TRAVELLA:Admin Registration and Profile Update</title>
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
                            <li>
								<a href="#"><i class="fa fa-pencil nav_icon"></i>Admin Registration</a>
							</li>
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
            <div class="lists">      
<form action="php/add_admin.php" method="post" enctype="multipart/form-data">
<div class="register-align">
<h2 style="color:#b3b300;font-weight:bold;">Admin Registration</h2>
  <input type="hidden" name="txtadminID" value="<?php echo $adminid ?>">
      <label>Admin Name:</label>
      <input type="text" style="height:40px" name="txtname" class="user form-control" placeholder="Enter Admin Name" value="<?php if(isset($adminName)){echo $adminName;} else{$adminName= '';} ?>" required>
      <label>Email Address:</label>
      <input type="email" style="height:40px" name="txtemail" class="mail form-control" placeholder="Enter Email" value="<?php if(isset($email)){echo $email;} else{$email= '';} ?>" required>
      <?php if (!isset($_GET['Mode'])) { ?>
      <label>Password:</label>
      <input type="password" style="height:40px" name="txtpassword" class="lock form-control" placeholder="Enter Password" required>
      <div style="border:1px solid #e0e0d1;border-radius:5px;padding:15px;background-color:#ebebe0">
      <img src="../../includes/generatecaptcha.php?rand=<?php echo rand();?>" id='captchaimg'/>
    <a href='javascript: refreshCaptcha();'>&nbsp;&nbsp;<i class="fa fa-refresh" style="font-size:19px;">&nbsp;&nbsp;Refresh</i></a><br>
    <script language='javascript' type='text/javascript'>
      function refreshCaptcha()
      {
        var img=document.images['captchaimg'];
        img.src=img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
      }
    </script>
    <label>Security Answer</label><br>
    <input type="text" class="form-control" name="code" id="code" placeholder="Enter Security Answer" required/></div>
    <?php } ?>  
  <br><br>
     <?php  
      if (isset($_GET['Mode'])) 
      {
		echo "<div style='margin-top:-4em;'></div>";
        echo "<a href='admin_registration.php'><input type='button' name='btncancel' value='Cancel' id='btcancel' class='btn btn-primary btn-block'></a>";
		echo "<input type='submit' name='btnupdate' value='Update' id='btadd' class='btn btn-primary btn-block'>";
      }
      else
      {
		echo "<div style='margin-top:-3em;'></div>";
        echo "<input type='reset' name='btncancel' value='Clear' id='btcancel' class='btn btn-primary btn-block'>";
        echo "<input type='submit' name='btnadd' value='Add' id='btadd' class='btn btn-primary btn-block' >";
      }
      ?>
</form>
</div>
<div class="admin-table">
<h3>Admin List:</h3>
<table align="center" cellpadding="4" cellspacing="7">
<tr>
     <th>Admin ID</th>
     <th>Admin Name</th>
     <th>E-mail</th>
     <th>Action</th>
</tr>
<?php displayAdmin(); ?>
</table>
</div>
<div style="clear:both;"></div>
</div>
</div>
<div class="copy-section">
		<hr style="width:74%;margin-top:60px;">
            <p>TRAVELLA&copy; 2018. All rights reserved | Code by Section-A(Group:4) </p>
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
</body>
</html>