<?php 
session_start();
include('php/connect.php');
if(!isset($_SESSION['USERID']))
{
	echo "<script>window.alert('Please Login First to Continue.')</script>";
	echo "<script>window.location='user_login.php'</script>";
}

//Delete
if(isset($_POST['btndelete']))
{
  $ID=$_POST['txtid'];
  $Delete="DELETE FROM feedbacks WHERE ID='$ID'";
  $execute=mysql_query($Delete);

  if ($execute) 
  {
    echo "<script>window.alert('Your Issue Deleted Successfully!')</script>";
    echo "<script>window.location='issue_list.php'</script>";
  }
  else
  {
    echo "<p>Error in Deleting Issue.".mysql_error()."</p>";
  }
}
//End of Delete
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TRAVELLA:Issue List</title>
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
<style type="text/css">
	#j_btndelete{
		border: 1px #800000 solid;
		background-color:#800000; 
		width: 80px;
		height: 30px;
		color: #fff;
		border-radius: 7px;
		box-shadow: 2px 2px 4px #262626;
	}
</style>
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
								<a href="bus_list.php"><i class="fa fa-list-ul nav_icon"></i>Bus Lists</a>
							</li>
                            <li>
								<a href="booking_list.php"><i class="glyphicon glyphicon-list-alt nav_icon"></i>Booking Lists</a>
							</li>
							<li>
								<a href="#"><i class="fa fa fa-check-square-o nav_icon"></i>Register <span class="fa arrow"></span></a>
								<ul class="nav nav-second-level collapse">
									<li>
										<a href="bus_registration.php"><i class="fa fa-bus nav_icon"></i>Bus Register </a>
									</li>
									<li>
										<a href="trip_tour_registration.php"><i class="fa fa-suitcase nav_icon"></i>Trip & Tour Register </a>
									</li>
								</ul>
								<!-- /nav-second-level -->
							</li>
							<li>
								<a href="issue_list.php"><i class="fa fa-bug nav_icon"></i>Issues Lists</a>
								<!-- /nav-second-level -->
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
                                            <span style="font-size:16px;font-style:oblique;font-weight:bold;color:#196619"><?php echo $_SESSION["USERNAME"]; ?></span>
                                            <p style="font-size:13px;font-style:italic;color:#77773c"><?php echo $_SESSION["EMAIL"]; ?></p>
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
            <h3>Your Issues Lists:</h3>
	<div class='alert pending2'>
  <span class='closebtn'>&times;</span><strong>Information!</strong> The admins will remark the issues within 24 hour!</div>
<form action="issue_list.php" method="post">
<?php 
$userid=$_SESSION['USERID'];
$view="SELECT * FROM feedbacks WHERE USERID='$userid'";
$ret=mysql_query($view);
$count=mysql_num_rows($ret);

if ($count==0) 
{
	echo "<div class='alert approved'>
  <span class='closebtn'>&times;</span><strong>Information!</strong> No issue found!</div>";
}
else
{
		echo "<table align='center'>";
		echo "<tr>";
		echo "<th>User Name</th>";
		echo "<th>Issue</th>";
		echo "<th>Description</th>";
		echo "<th>Post Date</th>";
		echo "<th>Remarked Date</th>";
		echo "<th>Remark Message</th>";
		echo "<th>Action</th>";
		echo "</tr>";

	for ($i=0; $i < $count; $i++) 
	{ 
		$data=mysql_fetch_array($ret);
		$id=$data['ID'];
		echo "<input type='hidden' name='txtid' value='$id'>";
		echo "<tr>";
		echo "<td>".$data['USER_NAME']."</td>";
		echo "<td>".$data['ISSUE']."</td>";
		echo "<td>".$data['DESCRIPTION']."</td>";
		echo "<td>".$data['POST_DATE']."</td>";
		echo "<td>".$data['SOLVED_DATE']."</td>";
		echo "<td>".$data['ADMIN_REMARK']."</td>";
		echo "<td><input type='submit' value='Delete' name='btndelete' id='j_btndelete'></td>";
		echo "</tr>";
	}
	echo "</table>";
}
?>
</form>
        </div>
        <div class="copy-section">
        	<hr style="width:74%;margin-top:40px;">
			<p class="fh5co-social-icons">
				<a href="#"><i class="fa fa-twitter-square" style="font-size:38px;color:#00ace6;"></i></a>
				<a href="#"><i class="fa fa-facebook-square" style="font-size:38px;color:#004d99;"></i></a>
				<a href="#"><i class="fa fa-pinterest-square" style="font-size:38px;color:#b30000;"></i></a>
				<a href="#"><i class="fa fa-google-plus-square" style="font-size:38px;color:#e60000;"></i></a>
				<a href="#"><i class="fa fa-wechat" style="font-size:38px;color:#33cc33"></i></a>
			</p>
			<p>TRAVELLA&copy; 2018. All rights reserved | Code by Section-A (Group:4) </p>
			<p style="margin-top:-14px;margin-bottom:-10px;">Design Reference by <a href="http://w3layouts.com">W3layouts</a></p>
		</div>
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
				
      <!--alarm message-->
      <script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>
<!--alert message-->
</body>
</html>
