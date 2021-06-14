<?php  
include('connect.php');
session_start();
//company approve
if (isset($_POST['btnaccept'])) 
{
	$cid=$_POST['txtid'];
	
	$update="UPDATE booking
		     SET STATUS='Accepted'
			 WHERE CUSTOMER_ID='$cid'";
	$upret=mysql_query($update);
	if ($upret) 
	{
		echo "<script>window.alert('Accept Payment Successfully!')</script>";
		echo "<script>window.location='booking_list.php'</script>";
	}
	else
	{
		echo "<p>Error in Accepting Payment:" .mysql_error()."</p>";
	}
}
//end of approve
//Decline
if(isset($_POST['btndecline']))
{
  $id=$_POST['txtid'];
  $Delete="DELETE FROM Company WHERE USERID='$id'";
  $execute=mysql_query($Delete);

  $delete="DELETE FROM user WHERE USERID='$id'";
  $execute=mysql_query($delete);
  if ($execute) 
  {
    echo "<script>window.alert('Decline Company Successfully!')</script>";
    echo "<script>window.location='../company_list.php'</script>";
  }
  else
  {
    echo "<p>Error in Decline.".mysql_error()."</p>";
  }
}
//End of Decline
//ban company 
if (isset($_POST['btnban'])) 
{
	$AdminID=$_SESSION['ADMINID'];
	$cid=$_POST['txtcmpid'];
	$updateban="UPDATE company
		     SET STATUS='Banned',
			 	 ADMINID='$AdminID'
			 WHERE USERID='$cid'";
	$retban=mysql_query($updateban);

	if ($retban) 
	{
		echo "<script>window.alert('Banned Company Successfully!')</script>";
		echo "<script>window.location='../company_list.php'</script>";
	}
	else
	{
		echo "<p>Error in Banning the Company:" .mysql_error()."</p>";
	}
}
//end_of_ban

function displayBooking()
{
	$viewbooking="SELECT bk.*,c.*,td.*,t.*,s.*,b.*,p.*
				  FROM booking bk,customer c,trip_details td,trip t,seat_detail s,bus b,payment p
				  WHERE c.CUSTOMER_ID=bk.CUSTOMER_ID
				  AND bk.PAYMENTID=p.PAYMENTID
				  AND bk.TRIPDETAILID=td.TRIPDETAILID
				  AND td.TRIPID=t.TRIPID
				  AND td.BUSID=b.BUSID
				  AND s.BUSID=b.BUSID
				  AND bk.STATUS='Pending'";
	$rets=mysql_query($viewbooking);
	$count=mysql_num_rows($rets);
	
	if ($count==0) 
	{	
		echo " <div class='alert pending'>
	  <span class='closebtn'>&times;</span><strong>Success!</strong>No Booking Found Yet!</div>";
	}
	else
	{
			echo "<table align='center' class='pending'>";
			echo "<tr>";
			echo "<th>Booking ID</th>";
			echo "<th><a href='#'>Customer Name</a></th>";
			echo "<th>Payment Type</th>";
			echo "<th><a href='#'>Trip ID</a></th>";
			echo "<th>No of Passenger</th>";
			echo "<th>Seat No</th>";
			echo "<th>Status</th>";
			echo "<th>Action</th>";
			echo "</tr>";
	
		for ($i=0; $i < $count; $i++) 
		{ 
			$data=mysql_fetch_array($rets);
			$id=$data['CUSTOMER_ID'];
			echo "<input type='hidden' name='txtid' value='$id'>";
			echo "<input type='hidden' name='txtid' value='$id'>";
			echo "<tr>";
			echo "<td>".$data['BOOKINGID']."</td>";
			echo "<td>".$data['CUSTOMER_NAME']."</td>";
			echo "<td>".$data['PAYMENT_TYPE']."</td>";
			echo "<td>".$data['TRIPID']."</td>";
			echo "<td>".$data['NO_OF_PASSENGER']."</td>";
			echo "<td>".$data['CHOOSE_SEAT_NO']."</td>";
			echo "<td>".$data['STATUS']."</td>";
			echo "<td><input type='submit' value='Accept Payment' name='btnaccept' class='j_btnsubmit j_accept'></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
//accepted company list
function displayAcceptedBooking()
{
	$viewbooking="SELECT bk.*,c.*,td.*,t.*,s.*,b.*,p.*
				  FROM booking bk,customer c,trip_details td,trip t,seat_detail s,bus b,payment p
				  WHERE c.CUSTOMER_ID=bk.CUSTOMER_ID
				  AND bk.PAYMENTID=p.PAYMENTID
				  AND bk.TRIPDETAILID=td.TRIPDETAILID
				  AND td.TRIPID=t.TRIPID
				  AND td.BUSID=b.BUSID
				  AND s.BUSID=b.BUSID
				  AND bk.STATUS='Accepted'";
	$rets=mysql_query($viewbooking);
	$count=mysql_num_rows($rets);
	
	if ($count==0) 
	{	
		echo " <div class='alert pending'>
	  <span class='closebtn'>&times;</span><strong>Success!</strong>No Booking Have Not Accepted Yet!</div>";
	}
	else
	{
			echo "<table align='center' class='pending'>";
			echo "<tr>";
			echo "<th>Booking ID</th>";
			echo "<th><a href='#'>Customer Name</a></th>";
			echo "<th>Payment Type</th>";
			echo "<th><a href='#'>Trip ID</a></th>";
			echo "<th>No of Passenger</th>";
			echo "<th>Seat No</th>";
			echo "<th>Status</th>";
			echo "<th>Action</th>";
			echo "</tr>";
	
		for ($i=0; $i < $count; $i++) 
		{ 
			$data=mysql_fetch_array($rets);
			$id=$data['CUSTOMER_ID'];
			echo "<input type='hidden' name='txtid' value='$id'>";
			echo "<tr>";
			echo "<td>".$data['BOOKINGID']."</td>";
			echo "<td>".$data['CUSTOMER_NAME']."</td>";
			echo "<td>".$data['PAYMENT_TYPE']."</td>";
			echo "<td>".$data['TRIPID']."</td>";
			echo "<td>".$data['NO_OF_PASSENGER']."</td>";
			echo "<td>".$data['CHOOSE_SEAT_NO']."</td>";
			echo "<td>".$data['STATUS']."</td>";
			echo "<td><input type='submit' value='Send' name='btnsend' class='j_btnsubmit j_accept'></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
}
?>