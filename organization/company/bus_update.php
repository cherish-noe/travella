<?php 
session_start();
include('php/connect.php');
//Delete
if(isset($_POST['btndelete']))
{
	$BID=$_POST['txtbusID'];
	$Delete="DELETE FROM bus WHERE BUSID='$BID'";
	$execute=mysql_query($Delete);

	if ($execute) 
	{
		echo "<script>window.alert('Bus Info Deleted Successfully!')</script>";
		echo "<script>window.location='bus_list.php'</script>";
	}
	else
	{
		echo "<p>Error in Bus Info Deleting Process.".mysql_error()."</p>";
	}
}
//End of Delete
//update
if (isset($_POST['btnedit'])) 
{
	$bid=$_POST['txtbusID'];
	$select="SELECT * FROM bus WHERE BUSID='$bid'";
	$rets=mysql_query($select);
	$rows=mysql_fetch_array($rets);
	$bName=$rows['BUSNAME'];
	$bClass=$rows['BUS_CLASS'];
	$nseat=$rows['NO_OF_SEAT'];
	$bLicense=$rows['BUSLICENSE'];
}
if (isset($_POST['btnupdate']))
{
	$up_bID=$_POST['txtbusID'];
	$up_bName=$_POST['txtbusname'];
	$up_bClass=$_POST['txtbusclass'];
	switch ($up_bClass) {
		case 'Other':
			$up_bclass=$_POST['txtother'];
			break;
		
		default:
			$up_bclass=$_POST['txtbusclass'];
			break;
	}
	$up_nseat=$_POST['txtNoOfSeats'];
	$up_bLicense=$_POST['txtbuslicense'];

	$update="UPDATE bus
			  Set BUSNAME='$up_bName',
			   	 BUS_CLASS='$up_bclass',
			   	 NO_OF_SEAT='$up_nseat',
			   	 BUSLICENSE='$up_bLicense'
			  WHERE BUSID='$up_bID'";
	$retup=mysql_query($update);

	if($retup)
	{
		echo "<script>window.alert('Bus Information Successfully Updated.')</script>";
		echo "<script>window.location='bus_list.php'</script>";
	}
    else
	{
	 	echo "<p>Error in Bus Info Update:" .mysql_error()."</p>";
	}
}
//End of Update
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TRAVELLA:Bus Update</title>
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
<link href="../../css/company.css" rel="stylesheet">
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
        <!--register content-->
        <div class="register-align" style="margin-top:-5em;">
			<h3 style="padding-top:100px;">Bus Update</h3>
	<form action="bus_update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="txtbusID" value="<?php echo $bid; ?>">
  
   	  		<label><p>Bus Name:</p></label>
            <input type="text" placeholder="Enter Bus Name" value="<?php if(isset($bName)){echo $bName;} else{$bName= '';} ?>" class="form-control" name="txtbusname" required/><br>
            <div style="float:left">
     		<label><p>Bus Class:</p></label>
      		<select name="txtbusclass" class="form-control">
      			<option disabled selected><?php if(isset($bClass)){echo $bClass;} else{$bClass= '';} ?></option>
      		    <option>Scania</option>
      		    <option>Royal Class</option>
      		    <option>Business</option>
      		    <option>Economy</option>
      		    <option>Other</option>
      		</select>
      		</div>
            <div style="margin-left:160px;margin-top:10px;">
      		<label style="color:#008080;">Enter bus class if you choose Other option:</label> <input type="text" name="txtother" class="form-control"></div>
      			<br>
	 		<label><p>Bus License:</p></label>
      		<input type="text" placeholder="Enter Bus License" value="<?php if(isset($bLicense)){echo $bLicense;} else{$bLicense= '';} ?>" name="txtbuslicense" class="form-control" required><br>
      
     		<label><p>No. of Seats:</p></label><br>
      		<input type="number" value="<?php if(isset($nseat)){echo $nseat;} else{$nseat= '';} ?>" name="txtNoOfSeats" min=1 class="form-control" required> <br><br><br>
   			<br>  
        	<button type="reset" id="btcancel" class="btn btn-primary btn-block" name="btnclear">Cancel</button>
	    	<button type="submit" id="btsubmit" class="btn btn-primary btn-block" name="btnupdate">Update</button><div style="clear:both"></div>
		
  	</form>
    </div>
    </div>
    </div> 
    <div class="clearfix"> </div>
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