<?php 
session_start();
include('php/connect.php');
require('php/AutoID_Function.php');

//save button
if (isset($_POST['btnupload'])) 
{
  if(strcmp($_SESSION['code'],$_POST['code'])!=0)
  {
    echo"<script>window.alert('Security Does Not Match')</script>";
  }
  else
  {
  $from=$_POST['txtfrom'];
  $to=$_POST['txtto'];
  $dTime=$_POST['Hr'].':'.$_POST['Min'].$_POST['txttime'];
  $dDate=date("Y-m-d",strtotime($_POST['txtdepaturedate']));
  $venue=$_POST['txtvenue'];
  $Ttype=$_POST['rdotype'];
  $price=$_POST['txtPrice'].'MMK';
  $userid=$_SESSION['USERID'];
  switch ($Ttype) {
    case 'Tour':
    $tripID=AutoID('trip','TRIPID','TP-',4);
    $duration=$_POST['dDay'].' Day';
    $summary=$_POST['txtdescription'];
    $tourplaces=$_POST['txttourplaces'];
    $hotel=$_POST['txthotelname'];
    $services=$_POST['txtotherservices'];
    
    $Folder="photo/tour_images/";
  //image1--------------------------
  $image1=$_FILES['Image1']['name'];
  $size1=$_FILES['Image1']['size'];
  if ($size1>7000000) 
  {
    echo "<p>The site does not allow image size greater than 7,000,000 bytes.</p>";
  }
  if ($image1) 
  {
    $generateid=date('ymdhms');
    $filename1=$Folder.$generateid."_".$image1;
    $copied=copy($_FILES['Image1']['tmp_name'],$filename1);
    if(!$copied)
    {
      exit('Error in Tour Image 1 Upload.');
    }
  }
  //--------------------------------1

  //image2---------------------------
  $image2=$_FILES['Image2']['name'];
  $size2=$_FILES['Image2']['size'];
  if ($size2>7000000) 
  {
    echo "<p>The site does not allow image size greater than 7,000,000 bytes.</p>";
  }
  if ($image2) 
  {
    $generateid=date('ymdhms');
    $filename2=$Folder.$generateid."_".$image2;
    $copied2=copy($_FILES['Image2']['tmp_name'],$filename2);
    if(!$copied2)
    {
      exit('Error in Tour Image 2 Upload.');
    }
  }
  //----------------------------------------2

  //image3---------------------------
  $image3=$_FILES['Image3']['name'];
  $size3=$_FILES['Image3']['size'];
  if ($size3>7000000) 
  {
    echo "<p>The site does not allow image size greater than 7,000,000 bytes.</p>";
  }
  if ($image3) 
  {
    $generateid=date('ymdhms');
    $filename3=$Folder.$generateid."_".$image3;
    $copied3=copy($_FILES['Image3']['tmp_name'],$filename3);
    if(!$copied3)
    {
      exit('Error in Tour Image 3 Upload.');
    }
  }
  //----------------------------------------3

  //image4---------------------------
  $image4=$_FILES['Image4']['name'];
  $size4=$_FILES['Image4']['size'];
  if ($size4>7000000) 
  {
    echo "<p>The site does not allow image size greater than 7,000,000 bytes.</p>";
  }
  if ($image4 ) 
  {
    $generateid=date('ymdhms');
    $filename4=$Folder.$generateid."_".$image4;
    $copied4=copy($_FILES['Image4']['tmp_name'],$filename4);
    if(!$copied4)
    {
      exit('Error in Tour Image 4 Upload.');
    }
  }
  //----------------------------------------
  if ($filename2="") {$filename2="";}
  if ($filename3="") {$filename3="";}
  if ($filename4="") {$filename4="";}
    $inserttrip="INSERT INTO trip
          (TRIPID,ORIGIN,DESTINATION,TRIP_TYPE,DEPARTURE_DATE,DEPARTURE_TIME,VENUE,DURATION,PRICE,USERID)
          VALUES
          ('$tripID','$from','$to','$Ttype','$dDate','$dTime','$venue','$duration','$price','$userid')";
    $rettrip=mysql_query($inserttrip);

    $inserttrip="INSERT INTO tour_package
          (TRIPID,DESCRIPTION,TOUR_PLACES,HOTEL,OTHER_SERVICE,photo1,photo2,photo3,photo4)
          VALUES
          ('$tripID','$summary','$tourplaces','$hotel','$services','$filename1','$filename2','$filename3','$filename4')";
    $rettrip=mysql_query($inserttrip);

      if($rettrip)
      {
        echo "<script>window.alert('Tour Package Info Successfully Added.')</script>";
        echo "<script>window.location='trip_tour_list.php'</script>";
      }
      else
      {
        echo "<p>Error in Tour Package Info Insert:" .mysql_error()."</p>";
      }
      break;
    
    default:
    $tripID=AutoID('trip','TRIPID','T-',4);
    $duration=$_POST['dHour'].'H:'.$_POST['dMin'].'Min';

    $inserttrip="INSERT INTO trip
          (TRIPID,ORIGIN,DESTINATION,TRIP_TYPE,DEPARTURE_DATE,DEPARTURE_TIME,VENUE,DURATION,PRICE,USERID)
          VALUES
          ('$tripID','$from','$to','$Ttype','$dDate','$dTime','$venue','$duration','$price','$userid')";
    $rettrip=mysql_query($inserttrip);

      if($rettrip)
      {
        echo "<script>window.alert('Trip Info Successfully Added.')</script>";
        echo "<script>window.location='trip_tour_list.php'</script>";
      }
      else
      {
        echo "<p>Error in Trip Info Insert:" .mysql_error()."</p>";
      }
      break;
  }

  }
}

//End of save
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TRAVELLA:Trip & Tour Registration</title>
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
<link href="script/DatePicker/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="script/DatePicker/datepicker.js" type="text/jscript"></script>
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
	<style type="text/css">
  		#textdisplay{display: none;}
  		#textdisplay1{display: none;}
		#tabs .tabs-nav > a{
			width:50%;
		}
		.styled-select{
			background:url(images/) no-repeat -30% 0;
			height:39px;
			overflow:hidden;
			width:80px;
		}
		.styled-select select{
			background:transparent;
			border:none;
			font-size:14px;
			height:39px;
			padding:5px;
			width:97px;
		}
		.rounded{
			-webkit-border-radius:5px;
			moz-border-radius:5px;
			border-radius:5px;
		}
		.colors{
			background-color:#86b300;
		}
		.colors select{
			color:#fff;
			text-align:center;
			font-weight:bold;
		}
  	</style>
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
                <a href="trip_tour_list.php"><i class="fa fa-road nav_icon"></i>Trip & Tour Lists</a>
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
        <!--register-nav-->
        <div id="tabs">
				<nav class="tabs-nav">
					<a href="bus_registration.php">
						<span>Register Bus</span>
					</a>
					<a href="#" class="active">
						<span>Register Trip & Tour Package</span>
					</a>
				</nav>
        </div>
        <!--end register-nav-->
        <!--register content-->
        <div class="register-align" style="margin-top:-5em;">
			<h3 style="padding-top:100px;">Upload Trip & Tour Package</h3>
          <form action="trip_tour_registration.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="txtTripID">
          <label><p>Origin:</p></label>
     	  <input type="text" placeholder="Enter City Name" name="txtfrom" class="form-control" required ><br>
          <label><p>Destination:</p></label>
          <input type="text" placeholder="Enter City Name" name="txtto" class="form-control" required><br>
          <label><p>Price:</p></label>
          <input type="text" placeholder="Enter Price" name="txtPrice" class="form-control" required><br>
          <label><p>Depature Date:</p></label>
		  <input type="date" class="form-control" name="txtdepaturedate" onFocus="showCalender(calender,this)" required/><br>
	  	  <label><p>Depature Time:</p></label><br>
          <div class="styled-select colors rounded" style="float:left;">
          <select name="Hr">
          <option disabled selected>Hour</option> 
      <?php 
      for ($i=1; $i <24 ; $i++) { 
        echo "<option>$i</option>";
      }
      ?>
      </select></div>
      <div class="styled-select colors rounded"  style="margin-left:100px;">
      <select name="Min" >
       <option disabled selected>Min</option>
      <?php 
      for ($i=0; $i <60 ; $i++) { 
        echo "<option>$i</option>";
      }
      ?>
      </select> </div>
      <div class="styled-select colors rounded" style="margin-left:200px;margin-top:-40px;" >
      <select name="txttime" >
       <option value="">AM</option>
       <option value="">PM</option>
      </select> </div>
      <br><br>
          <label><p>Venue:</p></label>
          <input type="text" placeholder="Enter name of venue" name="txtvenue" class="form-control" required> <br>
          <label><p>Trip Type:</p></label><br>
      	  <p><input type="radio" name="rdotype" value="Trip" onClick="display1()" required>&nbsp;&nbsp;Normal Trip&nbsp;&nbsp;
          <input type="radio" name="rdotype" value="Tour" onClick="display()" required>&nbsp;&nbsp;Tour Package<p>
      <div id="textdisplay1">
      <label><p>Duration:</p></label><br>
      <div class="styled-select colors rounded" style="float:left;">
      <select name="dHour">
      <option disabled selected>Hour</option> 
      <?php 
      for ($i=0; $i <24 ; $i++) { 
        echo "<option>$i</option>";
      }
      echo "<option>About 1 Day</option>";
      ?>
      </select></div>
      <div class="styled-select colors rounded"  style="margin-left:100px;">
      <select name="dMin">
      <option disabled selected>Minute</option> 
      <?php 
      for ($i=0; $i <25 ; $i++) { 
        echo "<option>$i</option>";
      }
      ?>
      </select></div><br>
    </div>
      <br>
      <div id="textdisplay">
      <label><p>Duration:</p></label><br>
      <div class="styled-select colors rounded" >
      <select name="dDay">
      <option disabled selected>Day</option>
      <?php 
      for ($i=1; $i <=31 ; $i++) { 
        echo "<option>$i</option>";
      }
      ?>
      </select></div><br><br>
      <label><p>Description:</p></label><br>
      <textarea placeholder="Enter Brief Description(Summary)" name="txtdescription"  class="form-control"></textarea><br>

      <label><p>Tour Places:</p></label>
      <input type="text" placeholder="Place1-Place2-Place..." name="txttourplaces" class="form-control"><br>
     
      <label><p>Hotel:</p></label>
      <input type="text" placeholder="Enter Hotel Name" name="txthotelname" class="form-control"><br>
      
      <label><p>Other Services: (Please use <span style="font-size:35px;color:red;">,</span> if there are one more services Eg. Include Breakfast, Rent Bicycle,etc.)</p></label>
      <textarea placeholder="Enter Other Available Services" name="txtotherservices" class="form-control"></textarea><br> 
      <br>
      <label><p>Image Related with Tour Places(1):<p></label>
      <div id="uploadbutton" class="btn btn-primary btn-block browse" style="background-color:#004d4d;">Upload&nbsp;&nbsp;<i class="fa fa-upload"></i></div>
      <input type="file" name="Image1" id="upload" style="visibility:hidden">
      <br>
      <div style="border:1px solid #666633;border-radius:5px;padding:15px;">
      <p>For more than one images of tour places,</p>
      <div>
      <label>Image 2:</label>
      <div id="uploadbutton" class="btn btn-primary btn-block browse" style="background-color:#008080;">Upload&nbsp;&nbsp;<i class="fa fa-upload"></i></div>
      <input type="file" name="Image2" id="upload" style="visibility:hidden">
      <label>Image 3:</label>
      <div id="uploadbutton" class="btn btn-primary btn-block browse" style="background-color:#008080;">Upload&nbsp;&nbsp;<i class="fa fa-upload"></i></div>
      <input type="file" name="Image3" id="upload" style="visibility:hidden">
      <label>Image 4:</label>
      <div id="uploadbutton" class="btn btn-primary btn-block browse" style="background-color:#008080;">Upload&nbsp;&nbsp;<i class="fa fa-upload"></i></div>
      <input type="file" name="Image4" id="upload" style="visibility:hidden"></div></div>
      <br>
      </div>
	  <div style="border:1px solid #e0e0d1;border-radius:5px;padding:15px;background-color:#ebebe0">
      <img src="../../includes/generatecaptcha.php?rand=<?php echo rand();?>" id='captchaimg'/>
        <a href='javascript: refreshCaptcha();'>&nbsp;&nbsp;<i class="fa fa-refresh" style="font-size:19px;">&nbsp;&nbsp;Refresh</i></a>
        <label>Security Answer</label><br>
         <input type="text" name="code" id="code" placeholder="Enter Security Answer" required/></div><br><br>  
        <button type="button" id="btcancel" class="btn btn-primary btn-block" name="btncancel">Cancel</button>
	    <button type="submit" id="btsubmit" class="btn btn-primary btn-block" name="btnupload">Upload</button><div style="clear:both"></div>
          </form>                        
         </div>
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
  <!--recapture-->
  <script language='javascript' type='text/javascript'>
          function refreshCaptcha()
          {
            var img=document.images['captchaimg'];
            img.src=img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
          }
  </script>
  <!--recapture-->
  <!--tour package control-->
  <script type="text/javascript">
    function display()
    {
      $("#textdisplay").show("fast");
      $("#textdisplay1").hide("fast");
    }
    function display1()
    {
      $("#textdisplay1").show("fast");
      $("#textdisplay").hide("fast");
    }
  </script>
       </body>
      </html>
        